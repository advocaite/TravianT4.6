<?php
namespace Controller;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\ExtraModules;
use Game\Formulas;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Game\SpeedCalculator;
use Core\Locale;
use Model\AdventureModel;
use Model\ArtefactsModel;
use Model\Quest;
use resources\View\GameView;
use resources\View\PHPBatchView;
class HeroAdventureCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $quest = Quest::getInstance();
        $successAdventures = $this->session->get("success_adventures_count");
        if($successAdventures > 0){
            if ($successAdventures >= 1 && $quest->getTutorial() == '11-0') {
                $quest->setTutorial('11-1');
            } else if ($successAdventures >= 2 && !$quest->isFullyCompleted()) {
                $quest->setQuestBitwise("battle", 1, Quest::QUEST_FINISHED);
            }
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'hero hero_adventure';
        $this->view->vars['titleInHeader'] = $this->session->getName() . ' - ' . T("Buildings", "level") . ' ';
        $this->view->vars['titleInHeader'] .= $this->session->hero->getLevel();
        $view = new PHPBatchView("hero/menus");
        $view->vars['selectedTab'] = 3;
        $view->vars['favorText'] = sprintf(T("Global", "Select tab %s as favourite"), T("HeroGlobal", "Adventure"));
        $this->view->vars['content'] = $view->output();
        $view = new PHPBatchView("hero/HeroAdventure");
        $view->vars['status'] = (string)$this->session->hero->getHeroStatus();
        $view->vars['extraButton'] = ExtraModules::showButton('buyAdventure');
        $m = new AdventureModel();
        $view->vars['noRallyPoint'] = $m->getHeroVillageRallyPoint($this->session->hero->hero['kid']) <= 0;
        $view->vars['heroStatusMessage'] = $this->session->hero->getInventoryStatus();
        $view->vars['tbody'] = '';
        $view->vars['villageCount'] = 0;
        $view->vars['villages'] = '';
        $db = DB::getInstance();
        $find = $db->query("SELECT kid, name FROM vdata WHERE owner=" . $this->session->getPlayerId());
        while($row = $find->fetch_assoc()) {
            $view->vars['villageCount']++;
            $view->vars['villages'] .= '<option value="' . $row['kid'] . '-148135" ' . ($row['kid'] == $this->session->village->getKid() ? "selected" : "") . '>' . $row['name'] . '</option>';
        }
        $adventures = $m->getAdventures($this->session->getPlayerId());
        while($row = $adventures->fetch_assoc()) {
            $view->vars['tbody'] .= $this->renderAdventure($row);
        }
        $view->vars['adventureCount'] = $adventures->num_rows;

        if(!$adventures->num_rows) {
            $view->vars['tbody'] = '<tr><td colspan="6" class="noData">' . T("HeroAdventure", "no adventures") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private $inventory = NULL;
    private $tsq = 0;
    private $artEffect = 1;
    private function renderAdventure($row)
    {
        $heroOnHisWay = false;
        if($this->session->hero->getHeroStatus() == SessionHero::STATUS_ON_ADVENTURE){
            $heroOnHisWay = $row['kid'] == $this->session->hero->hero['toKidAdventure'];
        }
        $db = DB::getInstance();
        if(is_null($this->inventory)) {
            $this->inventory = $db->query("SELECT * FROM inventory WHERE uid=" . $this->session->getPlayerId())->fetch_assoc();
            $this->artEffect = ArtefactsModel::getArtifactEffectByType($this->session->getPlayerId(), $this->session->hero->hero['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED);
            $m = new AdventureModel();
            $this->tsq = $m->getHeroVillageTsq($this->session->hero->hero['kid']);
        }
        $helper = new HeroHelper();
        $calc = new SpeedCalculator();
        $calc->setFrom($this->session->hero->hero['kid']);
        $calc->setTo($row['kid']);
        $calc->hasHero();
        $calc->setMinSpeed($helper->calcTotalSpeed($this->session->getRace(), $this->inventory['horse'], $this->inventory['shoes']));
        $calc->setLeftHand($this->inventory['leftHand']);
        $calc->setShoes($this->inventory['shoes']);
        $calc->setArtefactEffect($this->artEffect);
        $calc->setTournamentSqLvl($this->tsq);
        $need = $calc->calc();
        $HTML = '<tr id="adventure' . $row['id'] . '">';
        $HTML .= '<td class="location">';
        $wdata = $db->query("SELECT fieldtype, oasistype, landscape, occupied FROM wdata WHERE id={$row['kid']}")->fetch_assoc();
        if($wdata['landscape']) {
            if($wdata['landscape'] == 5) {
                $name = T("HeroAdventure", "natarsLandscape");
            } else {
                $name = T("HeroAdventure", ['wald', 'clay', 'hill', 'lake'][$wdata['landscape'] - 1]);
            }
        } else if($wdata['fieldtype'] && !$wdata['occupied']) {
            $name = T("Global", "Abandoned valley");
        } else if($wdata['fieldtype']) {
            $name = T("HeroAdventure", "natars");
        } else {
            $name = T("HeroAdventure", "unOccupiedOasis");
        }
        $direction = strtolower(getDirection());
        $HTML .= $name;
        $HTML .= '<input type="hidden" name="adventureKid[]" value="' . $row['kid'] . '">';
        $HTML .= '<input type="hidden" name="adventureWalktimeOriginalVillage[]" value="' . $row['kid'] . '-' . $need . '">';
        $HTML .= '</td>';
        $HTML .= '<td class="coords">';
        $xy = Formulas::kid2xy($row['kid']);
        $HTML .= '<a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‬‎</a>';
        $HTML .= '</td>';
        $HTML .= '<td class="moveTime" id="walktime' . $row['kid'] . '">';
        $HTML .= secondsToString($need);
        $HTML .= '</td>';
        $HTML .= '<td class="difficulty">';
        $HTML .= '<img alt="' . T("HeroAdventure", $row['dif'] == 1 ? "hard" : "normal") . '" title="' . T("HeroAdventure", $row['dif'] == 0 ? "normal" : "hard") . '" class="adventureDifficulty' . (1 - $row['dif']) . '" src="img/x.gif">';
        $HTML .= '</td>';
        $HTML .= '<td class="timeLeft">';
        if($heroOnHisWay){
            $HTML .= T("HeroAdventure", "Hero on his way");
        } else {
            $HTML .= appendTimer($row['time'] - time());
        }
        $HTML .= '</td>';
        $HTML .= '<td class="goTo" id="goToAdventure' . $row['kid'] . '">';
        $HTML .= '<a class="gotoAdventure arrow" href="start_adventure.php?skip=1&from=list&amp;kid=' . $row['kid'] . '">' . T("HeroAdventure", "gotoAdventure") . '</a>';
        $HTML .= '</td>';
        return $HTML;
    }
}