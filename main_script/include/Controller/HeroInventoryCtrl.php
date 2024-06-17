<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Model\AuctionModel;
use Model\Quest;
use function number_format_x;
use resources\View\GameView;
use resources\View\PHPBatchView;
use const JSON_PRETTY_PRINT;

class HeroInventoryCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $quest = Quest::getInstance();
        if ($quest->getTutorial() == '6-0') {
            $quest->setTutorial("6-1");
        }
        if ($quest->getTutorial() == '13-0') {
            $quest->setTutorial("13-1");
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = '';
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'hero hero_inventory';
        $this->view->vars['titleInHeader'] = Session::getInstance()->getName() . ' - ' . T("HeroInventory", "level") . ' ';
        $hero = $this->session->hero;
        $this->view->vars['titleInHeader'] .= number_format_x(Formulas::heroLevel($hero->getHeroExp()));
        $config = Config::getInstance();
        if (isset($_POST['a']) && $_POST['a'] == 1 && $hero->getHeroStatus() == SessionHero::STATUS_DEAD) {
            //revive Hero
            $costs = Formulas::heroRegenerateCost($hero->getLevel(), Session::getInstance()->getRace());
            if ($config->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if (Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if (Village::getInstance()->isResourcesAvailable($costs)) {
                $hero->trainHero();
                Village::getInstance()->modifyResources($costs);
            }
        }
        $view = new PHPBatchView("hero/menus");
        $view->vars['selectedTab'] = 1;
        $view->vars['favorText'] = sprintf(T("Global", "Select tab %s as favourite"), T("HeroGlobal", "Attributes"));
        $this->view->vars['content'] .= $view->output();
        $view = new PHPBatchView("hero/hero_inventory");
        $db = DB::getInstance();
        $inventory = $db->query("SELECT * FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        $gender = $db->fetchScalar("SELECT gender FROM face WHERE uid=" . Session::getInstance()->getPlayerId());
        $m = new AuctionModel();
        $helper = new HeroHelper();
        $rate = Config::getInstance()->heroConfig->resourcesMultiplier;
        if (Session::getInstance()->getRace() == 6) {
            $rate *= 2;
        }
        $view->vars['hero'] = array_merge($hero->hero,
            [
                'health' => $hero->getHeroHealth(),
                "gender" => $gender,
                "points" => $hero->getAvailablePoints(),
                "heroBodyHash" => sha1($inventory['lastupdate']),
                "heroStatusMessage" => $hero->getInventoryStatus(),
                "vname" => $hero->hero['kid'] == Village::getInstance()->getKid() ? Village::getInstance()->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$hero->hero['kid']}"),
                "reachedExperience" => $hero->getHeroExpPercent(),
                "allResourcesProduct" => $hero->hero['production'] * 6 * $rate,
                "eachResourceProduct" => $hero->hero['production'] * 20 * $rate,
                "totalPower" => $helper->calcTotalPower(Session::getInstance()->getRace(),
                    $hero->hero['power'],
                    $inventory['rightHand'],
                    $inventory['leftHand'],
                    $inventory['body']),
                "status" => (string)$hero->getHeroStatus(),
                "regenerating" => $hero->getHeroStatus() == SessionHero::STATUS_REVIVING,
                "regeneratedHealth" => $hero->getRegeneratedHealth(),
                "fsperpoint" => Session::getInstance()->getRace() == 1 ? 100 : 80,
                "itemfs" => $helper->calcItemPower($inventory['rightHand'], $inventory['leftHand'], $inventory['body']),
                "speed" => $helper->calcTotalSpeed(Session::getInstance()->getRace(),
                    $inventory['horse'],
                    $inventory['shoes']),
                'r0' => $hero->hero['productionType'] == 0,
                'r1' => $hero->hero['productionType'] == 1,
                'r2' => $hero->hero['productionType'] == 2,
                'r3' => $hero->hero['productionType'] == 3,
                'r4' => $hero->hero['productionType'] == 4,
            ]);
        $view->vars['session'] = [
            "checker" => Session::getInstance()->getChecker(),
            "cp" => Session::getInstance()->getCP(),
        ];
        $view->vars['inventorySize'] = max($m->getMaxPlaceId(Session::getInstance()->getPlayerId()), 12);
        if ($hero->getHeroStatus() == SessionHero::STATUS_DEAD) {
            $helper = new GoldHelper();
            $costs = Formulas::heroRegenerateCost($hero->getLevel(), Session::getInstance()->getRace());
            $contract = Village::getInstance()->contractResourcesLink($costs);
            $village = Village::getInstance();
            $villageName = $hero->hero['kid'] == $village->getKid() ? $village->getName() : $db->fetchScalar("SELECT name FROM vdata WHERE kid={$hero->hero['kid']}");
            $npcButton = $helper->getExchangeResourcesButtonByCost($costs);
            if (!Village::getInstance()->isResourcesAvailable($costs)) {
                $npcButton .= Village::getInstance()->calcWhenResourcesAreAvailable($costs, true);
            }
            $view->vars['regenerate'] = [
                "neededTime" => Formulas::heroRegenerationTime($hero->getLevel()),
                "costs" => $costs,
                "isResourcesAvailable" => FALSE,
                "needUpgrade" => 0,
                "enoughResourcesAvailable" => FALSE,
                "regenerateButton" => '',
                "npc" => $npcButton,
                "none" => $contract['text'],
                "showButton" => $contract['code'] == 0,
                'heroReviveDesc' => sprintf(T("HeroInventory", "HeroReviveInVillageDescription"),
                    $hero->hero['kid'],
                    $villageName,
                    $village->getKid(),
                    $village->getName()),
            ];
        }
        $view->vars['heroProductBonusTitle'] = $hero->getHeroProductionTitle(TRUE);
        $view->vars['DefBonusTitle'] = $hero->getHeroDefBonusTitle();
        $view->vars['HeroOffBonusTitle'] = $hero->getHeroOffBonusTitle();
        $view->vars['HeroFightingStrengthTitle'] = $hero->getHeroFightingStrengthTitle($inventory);
        $view->vars['ExperienceTitle'] = $hero->getExperienceTitle($inventory);
        $view->vars['HealthTitle'] = $hero->getHealthTitle($inventory);
        $view->vars['SpeedTitle'] = $hero->getSpeedTitle($inventory);
        $view->vars['production_tooltip_title'] = $hero->getHeroProductionTitle(TRUE);
        $view->vars['production_tooltip'] = $hero->getHeroProductionTitle(FALSE);
        $view->vars['HeroItems'] = json_encode($hero->getHeroItems(), JSON_PRETTY_PRINT);
        $view->vars['useOneDialogTitleCallbacks'] = $hero->useOneDialogTitleCallbacks($inventory);
        $this->view->vars['content'] .= $view->output();
    }
} 