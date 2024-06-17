<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Game\SpeedCalculator;
use Model\AdventureModel;
use Model\ArtefactsModel;
use Model\MovementsModel;
use Model\Quest;
use Model\VillageModel;
use resources\View\GameView;
use resources\View\PHPBatchView;
use function miliseconds;

class StartAdventure extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $quest = Quest::getInstance();
        $successAdventures = Session::getInstance()->get("success_adventures_count");
        if($successAdventures > 0){
            if ($successAdventures >= 1 && $quest->getTutorial() == '11-0') {
                $quest->setTutorial('11-1');
            } else if ($successAdventures >= 2 && !$quest->isFullyCompleted()) {
                $quest->setQuestBitwise("battle", 1, Quest::QUEST_FINISHED);
            }
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'universal';
        if (!isset($_REQUEST['kid']) || !isset($_REQUEST['from'])) {
            $this->redirect("hero.php?t=3");
        }
        $m = new AdventureModel();
        $kid = abs((int)$_REQUEST['kid']);
        $from = $_REQUEST['from'] == 'list' ? $_REQUEST['from'] : 'tile';
        if (!$m->checkForAdventure(Session::getInstance()->getPlayerId(), $kid)) {
            $this->redirect("hero.php?t=3");
        }
        $adventure = $m->getAdventure(Session::getInstance()->getPlayerId(), $kid);
        $this->view->vars['titleInHeader'] = '<img src="img/x.gif" class="adventureDifficulty' . (1 - $adventure['dif']) . '" alt="1">' . ' ' . T("HeroAdventure", $adventure['dif'] ? "adventure_dif_hard" : "adventure_dif_normal");
        $view = new PHPBatchView("hero/startAdventure");
        $view->vars['kid'] = $kid;
        $view->vars['from'] = $from;
        $view->vars['status'] = $this->session->hero->getHeroStatus();
        $view->vars['hasRallyPoint'] = $m->getHeroVillageRallyPoint($this->session->hero->hero['kid']);
        if ($view->vars['hasRallyPoint']) {
            $view->vars['statusMessage'] = $this->session->hero->getInventoryStatus();
        }
        $view->vars['tileClass'] = '';
        $view->vars['dead'] = $this->session->hero->getHeroStatus() == SessionHero::STATUS_DEAD || $this->session->hero->getHeroStatus() == SessionHero::STATUS_REVIVING;
        $wdata = DB::getInstance()->query("SELECT fieldtype, oasistype, landscape, occupied FROM wdata WHERE id={$kid}")->fetch_assoc();
        if ($wdata['landscape']) {
            $view->vars['tileClass'] = 'landscape landscape-' . [
                    'forest',
                    'clay',
                    'hill',
                    'lake',
                    'vulcano',
                ][$wdata['landscape'] - 1];
        } else if ($wdata['fieldtype']) {
            $view->vars['tileClass'] = 'landscape landscape-grassland';
        } else if ($wdata['oasistype']) {
            $view->vars['tileClass'] = 'landscape landscape-' . [
                    2 => 'forest',
                    'forest',
                    'forest',
                    6 => 'clay',
                    'clay',
                    'clay',
                    10 => 'hill',
                    'hill',
                    'hill',
                    14 => 'lake',
                    'lake',
                ][$wdata['oasistype']];
        }
        $db = DB::getInstance();
        $inventory = $db->query("SELECT horse, shoes, leftHand, rightHand FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        $view->vars['arrival_text'] = sprintf(
            T("HeroAdventure", "Arrival in: %s hrs | Return in: %s hrs"),
            secondsToString($go = $this->getTime($inventory, $kid, FALSE)),
            secondsToString($go + $this->getTime($inventory, $kid, TRUE)) . '&nbsp;'
        );
        if (((getDisplay("clickToAdventure") && isset($_GET['skip']) && $_GET['skip'] == 1 && $view->vars['status'] == 100 && $view->vars['hasRallyPoint']) || WebService::isPost()) && $view->vars['hasRallyPoint'] && $view->vars['status'] == 100) {
            if (Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if (Session::getInstance()->isInVacationMode()) {
                $this->redirect('options.php?s=4');
            }
            if ($db->query("UPDATE units SET u11=0 WHERE kid=" . $this->session->hero->hero['kid'])) {
                $move = new MovementsModel();
                $move->addMovement($this->session->hero->hero['kid'], $kid, Session::getInstance()->getRace(), [
                    1 => 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1,
                ], 0, 0, 0, 0, 0, MovementsModel::ATTACKTYPE_ADVENTURE, miliseconds(), miliseconds() + $this->getTime($inventory, $kid, FALSE) * 1000);
            }
            $this->session->hero->findHero();
            $view->vars['status'] = $this->session->hero->getHeroStatus();
            $view->vars['statusMessage'] = $this->session->hero->getInventoryStatus();
            if ($quest->getTutorial() == '11-0') {
                $quest->setTutorial('11-1');
            } else if (!$quest->isFullyCompleted()) {
                $quest->setQuestBitwise("battle", 1, Quest::QUEST_FINISHED);
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function getTime($inventory, $kid, $isReturn)
    {
        $helper = new HeroHelper();
        $calc = new SpeedCalculator();
        $calc->setFrom($this->session->hero->hero['kid']);
        $calc->setTo($kid);
        $calc->setLeftHand($inventory['leftHand']);
        $calc->setShoes($inventory['shoes']);
        $calc->setMinSpeed($helper->calcTotalSpeed(Session::getInstance()->getRace(), $inventory['horse'], $inventory['shoes']));
        $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), $this->session->hero->hero['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $calc->setTournamentSqLvl(VillageModel::getTournamentSquireLevel($this->session->hero->hero['kid']));
        $calc->hasHero();
        if ($isReturn) {
            $calc->isReturn();
        }
        return $calc->calc();
    }
} 