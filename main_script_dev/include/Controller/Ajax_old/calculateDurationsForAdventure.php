<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Game\SpeedCalculator;
use Model\AdventureModel;
use Model\ArtefactsModel;

class calculateDurationsForAdventure extends AjaxBase
{
    public function dispatch()
    {
        if (!isset($_POST['currentKidAndDid']) || !isset($_POST['adventureKids'])) {
            return;
        }
        $helper = new HeroHelper();
        $kid = (int)explode("-", $_POST['currentKidAndDid'])[0];
        $adventureKids = $_POST['adventureKids'];
        $this->response['data']['allNewDurations'] = [];
        $this->response['data']['allGoToLinks'] = [];
        $this->response['data']['infoMoveHero'] = '';
        $this->response['data']['heroInVillageInfo'] = '';
        $this->response['data']['rallyPointNeeded'] = '';
        $this->response['data']['sendHeroToVillage'] = '';
        $this->response['data']['noAdventures'] = FALSE;
        $this->response['data']['responseArray'] = [
            "heroInVillageInfo" => "",
            "rallyPointNeeded" => "",
            "infoMoveHero" => "",
        ];
        $m = new AdventureModel();
        $db = DB::getInstance();
        $rallyPoint = $m->getHeroVillageRallyPoint((int)$kid);
        $inventory = $db->query("SELECT * FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        if ($this->session->hero->getHeroStatus() === SessionHero::STATUS_DEAD) {
            $this->response['data']['responseArray']['heroInVillageInfo'] = T("HeroAdventure", "Hero not available");
            $this->response['data']['responseArray']['infoMoveHero'] = T("HeroAdventure", "Revive hero first");
        } else if ($this->session->hero->getHeroStatus() != SessionHero::STATUS_HOME) {
            $this->response['data']['responseArray']['heroInVillageInfo'] = T("HeroAdventure", "Hero not available");
            $this->response['data']['responseArray']['infoMoveHero'] = T("HeroAdventure",
                "The Hero must be stationed in the selected village first in order to start an adventure from there");
        } else {
            if ($this->session->hero->hero['kid'] == $kid) {
                $this->response['data']['responseArray']['heroInVillageInfo'] = T("HeroAdventure",
                    "Hero is stationed in village");
            } else {
                if (!$rallyPoint) {
                    $this->response['data']['responseArray']['rallyPointNeeded'] = T("HeroAdventure", "rallyPointNeeded");
                    $this->response['data']['responseArray']['infoMoveHero'] = T("HeroAdventure",
                        "The Hero must be stationed in the selected village first in order to start an adventure from there");
                } else {
                    $calc = new SpeedCalculator();
                    $calc->setFrom($this->session->hero->hero['kid']);
                    $calc->setTo($kid);
                    $calc->setMinSpeed($helper->calcTotalSpeed(Session::getInstance()->getRace(),
                        $inventory['horse'],
                        $inventory['shoes']));
                    $calc->setLeftHand($inventory['leftHand']);
                    $calc->setShoes($inventory['shoes']);
                    $calc->hasHero();
                    $artEffect = ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), $this->session->hero->hero['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED);
                    $calc->setArtefactEffect($artEffect);
                    $calc->setTournamentSqLvl($m->getHeroVillageTsq($kid));
                    $xy = Formulas::kid2xy($kid);
                    $this->response['data']['responseArray']['heroInVillageInfo'] = '<img src="img/x.gif" class="clock inlineblock" /><span class="walkingDurationToImage">' . T("HeroAdventure",
                            "Travel time to village") . ' ' . secondsToString($calc->calc()) . '.</span><span class="moveHeroLink"><a class="arrow" href="build.php?id=39&amp;tt=2&amp;newdid=' . $this->session->hero->hero['kid'] . '&t11=1&x=' . $xy['x'] . '&y=' . $xy['y'] . '">' . T("HeroAdventure",
                            "Send hero to village") . '</a></span><div class="clear"></div>';
                    $this->response['data']['responseArray']['infoMoveHero'] = T("HeroAdventure",
                        "The Hero must be stationed in the selected village first in order to start an adventure from there");
                }
            }
        }
        $calc = new SpeedCalculator();
        $calc->setFrom($kid);
        $calc->setMinSpeed($helper->calcTotalSpeed(Session::getInstance()->getRace(),
            $inventory['horse'],
            $inventory['shoes']));
        $calc->setLeftHand($inventory['leftHand']);
        $calc->setShoes($inventory['shoes']);
        $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), $kid, ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $calc->setTournamentSqLvl($m->getHeroVillageTsq($kid));
        $calc->hasHero();
        $to_kid = $kid;
        foreach ($adventureKids as $key => $kid) {
            $calc->setTo($kid);
            $last = explode("-", $_POST['originalWalkTimes'][$key])[1];
            $need = $calc->calc();
            if ($need == $last) {
                $class = '';
            } else if ($need < $last) {
                $class = 'faster';
            } else {
                $class = 'slower';
            }
            $this->response['data']['responseArray']['walktime' . $kid] = '<span class="' . $class . '">' . (secondsToString($need)) . '</span>';
        }
        foreach ($adventureKids as $key => $kid) {
            if ($to_kid != $this->session->hero->hero['kid']) {
                $this->response['data']['responseArray']['goToAdventure' . $kid] = '<a class="arrow disabled" title="' . T("HeroAdventure",
                        "Hero is not in selected village at the moment") . '">' . T("HeroAdventure",
                        "gotoAdventure") . '</a>';
            } else {
                $this->response['data']['responseArray']['goToAdventure' . $kid] = '<a class="gotoAdventure arrow" href="start_adventure.php?from=list&kid=' . $kid . '">' . T("HeroAdventure",
                        "gotoAdventure") . '</a>';
            }
        }
    }
}