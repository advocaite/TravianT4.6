<?php

namespace Controller\Build;

use function appendTimer;
use Controller\AnyCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\ExtraModules;
use Game\Formulas;
use Game\GoldHelper;
use Game\Hero\HeroHelper;
use Game\Hero\SessionHero;
use Game\TrainingHelper;
use function getDisplay;
use Model\ArtefactsModel;
use Model\DailyQuestModel;
use Model\Quest;
use Model\TrainingModel;
use resources\View\PHPBatchView;

class TroopBuilding extends AnyCtrl
{
    private $hero_percents = [0, 0];
    private $building_id = 19;
    private $building_level = 1;
    private $art_eff = 1;
    private $units = [];
    private $alliance_bonus = 1;

    public function __construct($index)
    {
        parent::__construct();
        $session = Session::getInstance();
        $this->view = new PHPBatchView("build/TroopBuildingLayout");
        $this->building_id = Village::getInstance()->getField($index)['item_id'];
        $this->building_level = Village::getInstance()->getField($index)['level'];
        $this->art_eff = ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), Village::getInstance()->getKid(), ArtefactsModel::ARTIFACT_INCREASE_TRAINING_SPEED);
        $m = new TrainingModel();
        if (!in_array($this->building_id, [25, 26, 44, 36]) && $this->session->hero->getHeroHealth() > 0) {
            //hero items here.
            if (
                Config::getProperty('heroConfig', 'allowHeroTrainingHelmetsInAllVillages') ||
                $this->session->hero->hero['kid'] == Village::getInstance()->getKid()) {
                $db = DB::getInstance();
                $helper = new HeroHelper();
                $this->hero_percents = $helper->calcTrainEffect($db->fetchScalar("SELECT helmet FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId()));
            }
        }
        if ($session->getAllianceId() > 0) {
            $this->alliance_bonus = AllianceBonus::getTrainingBonus($session->getAllianceId(), $session->getAllianceJoinTime());
        }
        $technology = $m->getTechnology(Village::getInstance()->getKid());
        if (WebService::isPost()) {
            if (Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if (Session::getInstance()->isInVacationMode()) {
                redirect('options.php?s=4');
            } else {
                $this->procTraining($technology);
            }
        }
        $helper = new TrainingHelper();
        if (in_array($this->building_id, [25, 26, 44])) {
            $this->view->vars['canTrain'] = array_sum($helper->getAvailableExpansionTraining(0, TRUE)) > 0;
        }
        $this->units = $m->getUnits(Session::getInstance()->getKid());
        if ($this->building_id == 36) {
            $this->view->vars['trap_desc'] = '<p>' . sprintf(T("inGame", "trap_desc"),
                    "<b>" . $this->units['u99'] . "</b>",
                    "<b>" . $m->getFilledTrapCount(Village::getInstance()->getKid()) . "</b>");
        }
        $troopsCanTrain = $this->_getTroopBuildingTroops();
        foreach ($troopsCanTrain as $k => $tid) {
            $troopsCanTrain[$k] = $tid = unitIdToNr($tid);
            if ($tid == 1 || $tid == 10 || $tid == 99) {
                continue;
            }
            if (!$technology['u' . $tid]) {
                unset($troopsCanTrain[$k]);
            }
        }
        if (!isset($this->view->vars['canTrain'])) {
            $this->view->vars['canTrain'] = sizeof($troopsCanTrain);
        }
        $this->view->vars['item_id'] = $this->building_id;
        $this->view->vars['index'] = $index;
        $this->view->vars['finishTraining_button'] = null;
        $this->view->vars['checker'] = Session::getInstance()->getChecker();
        $this->view->vars['wrappers'] = '';
        foreach ($troopsCanTrain as $k => $v) {
            $this->view->vars['wrappers'] .= $this->getTroopWrapper($v);
        }
        $training = $m->getTraining(Village::getInstance()->getKid(), $this->building_id);
        $this->view->vars['isTraining'] = $training->num_rows;
        $this->view->vars['training'] = '';
        if ($training->num_rows) {
            $nextTroopTime = 0;
            $_f = TRUE;
            $milSecond = Config::getProperty("game", "useMilSeconds");
            $nanoseconds = Config::getProperty("game", "useNanoseconds");
            $rate = $nanoseconds ? 1e9 : ($milSecond ? 1000 : 1);
            while ($train = $training->fetch_assoc()) {
                $train['end_time'] = ceil($train['end_time'] / $rate);
                $train['commence'] = ceil($train['commence'] / $rate);

                $troopTime = $train['commence'] - time();
                if ($troopTime < $nextTroopTime || $_f) {
                    $_f = FALSE;
                    $nextTroopTime = $troopTime;
                }
                $unitId = nrToUnitId($train['nr'], Session::getInstance()->getRace());
                if ($train['end_time'] >= TimezoneHelper::real_strtotime("tomorrow 00:00")) {
                    $end = TimezoneHelper::autoDateString($train['end_time'], TRUE);
                } else {
                    $end = TimezoneHelper::date("H:i", $train['end_time']);
                }
                $this->view->vars['training'] .= '<tr><td class="desc">
				<img class="unit u' . $unitId . '" src="img/x.gif" alt="' . T("Troops",
                        "{$unitId}.title") . '" title="' . T("Troops", "$unitId.title") . '" />
				' . number_format_x($train['num']) . '
				' . T("Troops", $unitId . ".title") . '
                </td>
			<td class="dur">' . appendTimer($train['end_time'] - time()) . '</td>
			<td class="fin"><span>' . $end . '</span><span> </span></td>
		</tr>';
            }
            $nextTrain = sprintf(T("inGame", $this->building_id == 36 ? "next_creating" : "next_training"),  appendTimer($nextTroopTime));
            $this->view->vars['training'] .= '<tr class="next"><td colspan="3">' . $nextTrain . '</td></tr>';
            $this->view->vars['training'] .= '<div class="clear"></div>';
        }
        if (!empty($this->view->vars['training']) && $this->view->vars['canTrain']) {
            $this->view->vars['finishTraining_button'] = ' ' . ExtraModules::finishTrainingButton();
        }
    }

    private function procTraining($technology)
    {
        $m = new TrainingModel();
        $troopsCanTrain = $this->_getTroopBuildingTroops();
        foreach ($troopsCanTrain as $k => &$tid) {
            $troopsCanTrain[$k] = $tid = unitIdToNr($tid);
            if ($tid == 1 || $tid == 10 || $tid == 99) {
                continue;
            }
            if (!$technology['u' . $tid]) {
                unset($troopsCanTrain[$k]);
            }
        }
        ksort($troopsCanTrain, SORT_NUMERIC);
        if (isset($_REQUEST['z']) && $_REQUEST['z'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $helper = new TrainingHelper();
            $great = $this->building_id == 30 || $this->building_id == 29;
            $dailyQuest = new DailyQuestModel();
            $quest = Quest::getInstance();
            foreach ($troopsCanTrain as $u) {
                if (isset($_REQUEST['t' . $u])) {
                    $num = min($helper->getMaxUnitByNr($u, $great), abs((int)$_REQUEST['t' . $u]));
                    if ($num <= 0) {
                        continue;
                    }
                    if ($num >= 20 && ($this->building_id == 19 || $this->building_id == 29)) {
                        $dailyQuest->setQuestAsCompleted(Session::getInstance()->getPlayerId(), 8);
                    } else if ($num >= 20 && ($this->building_id == 20 || $this->building_id == 30)) {
                        $dailyQuest->setQuestAsCompleted(Session::getInstance()->getPlayerId(), 9);
                    }
                    if ($this->building_id == 19 && $num >= 2) {
                        $quest->setQuestBitwise('battle', 5, 1);
                    }
                    $cost = Formulas::uTrainingCost(nrToUnitId($u, Session::getInstance()->getRace()), $great);
                    foreach ($cost as &$v) {
                        $v *= $num;
                    }
                    if (!Village::getInstance()->isResourcesAvailable($cost)) {
                        continue;
                    }
                    if (Village::getInstance()->modifyResources($cost)) {
                        $m->addTraining(Village::getInstance()->getKid(),
                            $this->building_id,
                            $u,
                            $num,
                            $this->_getTroopTrainingTime(nrToUnitId($u, Session::getInstance()->getRace())));
                    }
                }
            }
        }
    }

    public function _getTroopBuildingTroops()
    {
        return self::_getTroopBuildingTroopsStatic(Session::getInstance()->getRace(), $this->building_id);
    }

    public static function _getTroopBuildingTroopsStatic($race, $building_id)
    {
        if ($building_id == 25 || $building_id == 26) {
            return [9, 10];
        }
        switch ($race) {
            case 1:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [1, 2, 3];
                        break;
                    case 20:
                    case 30:
                        return [4, 5, 6];
                        break;
                    case 21:
                        return [7, 8];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [9, 10];
                        break;
                }
                break;
            case 2:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [11, 12, 13, 14];
                        break;
                    case 20:
                    case 30:
                        return [15, 16];
                        break;
                    case 21:
                        return [17, 18];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [19, 20];
                        break;
                }
                break;
            case 3:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [21, 22];
                        break;
                    case 20:
                    case 30:
                        return [23, 24, 25, 26];
                        break;
                    case 21:
                        return [27, 28];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [29, 30];
                        break;
                    case 36:
                        return [99];
                        break;
                }
                break;
            case 5:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [41, 42, 42, 43, 44];
                        break;
                    case 20:
                    case 30:
                        return [45, 46];
                        break;
                    case 21:
                        return [47, 78];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [49, 50];
                        break;
                    case 36:
                        return [];
                        break;
                }
                break;
            case 6:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [51, 52, 53];
                        break;
                    case 20:
                    case 30:
                        return [54, 55, 56];
                        break;
                    case 21:
                        return [57, 58];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [59, 60];
                        break;
                }
                break;
            case 7:
                switch ($building_id) {
                    case 19:
                    case 29:
                        return [61, 62];
                        break;
                    case 20:
                    case 30:
                        return [63, 64, 65, 66];
                        break;
                    case 21:
                        return [67, 68];
                        break;
                    case 25:
                    case 26:
                    case 44:
                        return [69, 70];
                        break;
                }
                break;
        }
    }

    public function _getTroopTrainingTime($u)
    {
        $percent = Session::getInstance()->get("fasterTraining") > time() ?
            Config::getInstance()->extraSettings->generalOptions->fasterTraining->percent : 0;
        $time = Formulas::uTrainingTime($u,
            $this->building_level,
            Village::getInstance()->getHorseDrinkingPoolLvl(),
            $this->hero_percents,
            $this->art_eff,
            $percent,
            $this->alliance_bonus);
        return $time;
    }

    public function getTroopWrapper($nr)
    {
        $helper = new GoldHelper();
        $training = new TrainingHelper();
        $view = new PHPBatchView("build/trainingWrapper");
        $view->vars['index'] = $nr;
        $view->vars['nr'] = $nr;
        $view->vars['available'] = $this->units['u' . $nr];

        $view->vars['durationClass'] = [
            20 => 'cavalryBonusTime_medium',
            30 => 'cavalryBonusTime_medium',
            19 => 'infantryBonusTime_medium',
            29 => 'infantryBonusTime_medium',
            21 => 'siegeTime_small',
            36 => 'maxTraps_medium',
            25 => 'clock_medium',
            26 => 'clock_medium',
        ][$this->building_id];

        $view->vars['unitId'] = nrToUnitId($nr, Session::getInstance()->getRace());
        $view->vars['cost'] = Formulas::uTrainingCost($view->vars['unitId'], $this->building_id == 30 || $this->building_id == 29);
        $view->vars['upkeep'] = Formulas::uUpkeep($view->vars['unitId'], Village::getInstance()->getHorseDrinkingPoolLvl());
        $view->vars['max'] = $training->getMaxUnitByNr($nr, $this->building_id == 30 || $this->building_id == 29);
        $view->vars['duration'] = secondsToString($this->_getTroopTrainingTime($view->vars['unitId']), true);
        $view->vars['npc'] = $helper->getExchangeResourcesButtonByNr($nr, $this->building_id == 30 || $this->building_id == 29);
        $view->vars['none_status'] = '';
        if (!$view->vars['max']) {
            $contract = Village::getInstance()->contractResourcesLink($view->vars['cost']);
            if ($contract['code'] == -1) {
                $view->vars['none_status'] = $contract['text'];
            }
        }
        return $view->output();
    }
}