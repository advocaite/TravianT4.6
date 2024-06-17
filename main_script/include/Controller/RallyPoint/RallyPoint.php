<?php

namespace Controller\RallyPoint;

use Core\Database\DB;
use Core\Helper\Notification;
use Core\Helper\PageNavigator;
use Core\Helper\WebService;
use Core\Log;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Hero\HeroHelper;
use Game\ResourcesHelper;
use Game\SpeedCalculator;
use function miliseconds;
use Model\ArtefactsModel;
use Model\MovementsModel;
use Model\OasesModel;
use Model\Quest;
use Model\RallyPoint\RallyPointModel;
use Model\VillageModel;
use Model\WonderOfTheWorldModel;
use resources\View\PHPBatchView;

class RallyPoint extends RallyPointHTML
{
    protected $rallyPointLvl;
    protected $artifact;
    protected $dietArtefactEffect = 1;
    private $oases;

    public function __construct()
    {
        $village = Village::getInstance();
        $this->rallyPointLvl = $village->getField(39)['level'];
        $session = Session::getInstance();
        $this->artifact = ArtefactsModel::getArtifactEffectByType($session->getPlayerId(), $session->getKid(), ArtefactsModel::ARTIFACT_SPY);
        if ($this->artifact == 1) {
            $this->artifact = false;
        }

        if (Village::getInstance()->isWW() && ArtefactsModel::wwPlansReleased()) {
            $this->dietArtefactEffect = 1 / 2;
        }
        $this->dietArtefactEffect *= ArtefactsModel::getArtifactEffectByType($session->getPlayerId(), $session->getKid(), ArtefactsModel::ARTIFACT_DIET);
        $this->oases = [];
        $db = DB::getInstance();
        $res = $db->query("SELECT kid FROM odata WHERE did=" . $session->getKid() . " LIMIT 3");
        while ($row = $res->fetch_assoc()) {
            $this->oases[] = $row;
        }
    }

    public function procEnforcement($d)
    {
        $session = Session::getInstance();
        $village = Village::getInstance();
        $db = DB::getInstance();
        $m = new RallyPointModel();
        $row = $m->getEnforcement($d);
        if (!$row) {
            return FALSE;
        }
        $miliseconds = miliseconds(true);
        $result = [
            "error" => FALSE,
            "errorMsg" => NULL,
            "showSendTroops" => FALSE,
            "a" => 3,
            "d" => $d,
            "troops_details" => '',
            "submitButton" => '',
            "id" => 39,
        ];
        if ($row['kid'] == $village->getKid()) {
            //own reinforcements
            $speeds = [];
            $units = array_fill(1, 11, 0);
            $wholeCount = 0;
            $units_id = [];
            for ($i = 1; $i <= 11; $i++) {
                if (isset($_POST['t'][$i])) {
                    $units[$i] = (int)$_POST['t'][$i];
                } else {
                    $units[$i] = (int)$row['u' . $i];
                }
                $units[$i] = abs($units[$i]);
                if ($units[$i] > $row['u' . $i]) {
                    $units[$i] = (int)$row['u' . $i];
                }
                $wholeCount += max($row['u' . $i], 0);
                if ($i <= 10 && $units[$i]) {
                    $speeds[] = Formulas::uSpeed(nrToUnitId($i, $session->getRace()));
                    $units_id[] = nrToUnitId($i, $session->getRace());
                }
            }
            $calculator = new SpeedCalculator();
            $calculator->setFrom($row['to_kid']);
            $calculator->setTo($row['kid']);
            $calculator->hasCata($units[8] > 0);
            if ($units[11] > 0) {
                $calculator->hasHero();
                $heroHelper = new HeroHelper();
                $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
                $inventory = $db->query("SELECT * FROM inventory WHERE uid={$uid}")->fetch_assoc();
                $calculator->setLeftHand($inventory['leftHand']);
                $calculator->setShoes($inventory['shoes']);
                $speeds[] = $heroHelper->calcTotalSpeed($row['race'], $inventory['horse'], $inventory['shoes'], $calculator->isCavalryOnly($units_id));
                if (array_sum($units) > 1) $calculator->troopsWithHero();
            }
            $calculator->setMinSpeed($speeds);
            for ($i = 19; $i <= 38; ++$i) {
                if ($village->getField($i)['item_id'] == 14) {
                    $calculator->setTournamentSqLvl($village->getField($i)['level']);
                    break;
                }
            }
            if (ArtefactsModel::artifactsReleased()) {
                $calculator->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($session->getPlayerId(), $session->getKid(), ArtefactsModel::ARTIFACT_INCREASE_SPEED));
            }
            $timeTaken = $calculator->calc();
            if (WebService::isPost()) {//withdraw
                $total = array_sum($units);
                if ($total) {
                    //process here
                    $move = new MovementsModel();
                    if (($wholeCount - $total) <= 0) {
                        if ($m->enforcementExists($d) && $m->deleteEnforce($d)) {
                            $move->addMovement($row['to_kid'], $row['kid'], $session->getRace(), $units, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $miliseconds, $miliseconds + $timeTaken * 1000);
                        }
                    } else {
                        $modify = [];
                        for ($i = 1; $i <= 11; ++$i) {
                            if ($units[$i]) {
                                $modify[] = "u{$i}=u{$i}-" . $units[$i];
                            }
                        }
                        if ($m->enforcementExists($d) && $m->modifyEnforce($modify, $d)) {
                            $move->addMovement($row['to_kid'], $row['kid'], $session->getRace(), $units, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $miliseconds, $miliseconds + $timeTaken * 1000);
                        }
                    }
                    if ($row['race'] <> 4) {
                        $o = new OasesModel();
                        {
                            $isOasis = $o->isOasis($row['to_kid']);
                            $targetKid = $isOasis ? $o->getOasisCaptureKid($row['to_kid']) : $row['to_kid'];
                            $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$targetKid");
                            $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($targetKid, $row['race']));
                            ResourcesHelper::modifyUpkeep($uid, $targetKid, $upkeep, 1);
                        }
                        $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
                        $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($row['kid'], $row['race']));
                        ResourcesHelper::modifyUpkeep($uid, $row['kid'], $upkeep);
                    }
                    redirect("build.php?id=39&tt=1");
                }
            }
            $row = [
                "owner" => [
                    "kid" => "",
                    "uid" => $session->getPlayerId(),
                    "playerName" => $session->getName(),
                    "villageName" => $village->getName(),
                ],
                "units" => $this->sortUnitsAssociated($units, $session->getRace()),
            ];
            $settings = [
                "noCoordinates" => TRUE,
                "noVillageLink" => TRUE,
                "troopHeadline" => '<a href="spieler.php?d=' . $session->getPlayerId() . '">' . T("RallyPoint",
                        "ownTroops") . '</a>',
                //maybe show coordinates
                "info" => [
                    [
                        "type" => "Arrival",
                        "ArrivalTime" => round(($miliseconds + 1000 * $timeTaken) / 1000),
                        "countUp" => TRUE,
                    ],
                ],
                "showTroopsNum" => TRUE,
                "showTroopsType" => TRUE,
                "unitsAreEditable" => TRUE,
            ];
            $result['troops_details'] = $this->getMovementTable($row, $settings);
            $result['submitButton'] = getButton([
                "id" => "s1_ok",
                "name" => 's1',
                "type" => "submit",
                "class" => 'green ',
                "title" => T("RallyPoint", "withdraw"),
            ],
                [
                    "data" => [
                        "class" => 'green ',
                        "value" => T("RallyPoint", "withdraw"),
                    ],
                ],
                T("RallyPoint", "withdraw"));
        } else {
            if ($row['race'] == 4) {
                $villageData = $player = [];
            } else {
                //others reinforcement
                $villageData = $db->query("SELECT owner, name FROM vdata WHERE kid={$row['kid']}")->fetch_assoc();
                $player = $db->query("SELECT name FROM users WHERE id={$villageData['owner']}")->fetch_assoc();
            }
            $speeds = [];
            $units = array_fill(1, 11, 0);
            $wholeCount = 0;
            $units_id = [];
            for ($i = 1; $i <= 11; $i++) {
                if ($i === 11 && $row['race'] == 4) {
                    continue;
                }
                if (isset($_POST['t'][$i])) {
                    $units[$i] = (int)$_POST['t'][$i];
                } else {
                    $units[$i] = (int)$row['u' . $i];
                }
                $units[$i] = abs($units[$i]);
                if ($units[$i] > $row['u' . $i]) {
                    $units[$i] = (int)$row['u' . $i];
                }
                $wholeCount += (int)max($row['u' . $i], 0);
                if ($i <= 10 && $units[$i]) {
                    $speeds[] = Formulas::uSpeed(nrToUnitId($i, $session->getRace()));
                    $units_id[] = nrToUnitId($i, $session->getRace());
                }
            }
            $calculator = new SpeedCalculator();
            $calculator->setFrom($row['to_kid']);
            $calculator->setTo($row['kid']);
            $calculator->hasCata($units[8] > 0);
            if (isset($units[11]) && $units[11] > 0) {
                $calculator->hasHero();
                $heroHelper = new HeroHelper();
                $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
                $inventory = $db->query("SELECT * FROM inventory WHERE uid={$uid}")->fetch_assoc();
                $calculator->setLeftHand($inventory['leftHand']);
                $calculator->setShoes($inventory['shoes']);
                $speeds[] = $heroHelper->calcTotalSpeed($row['race'],
                    $inventory['horse'],
                    $inventory['shoes'],
                    $calculator->isCavalryOnly($units_id));
                if (array_sum($units) > 1) $calculator->troopsWithHero();
            }
            if ($row['race'] <> 4) {
                $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$row['kid']}")->fetch_assoc();
                for ($i = 18; $i <= 38; ++$i) {
                    if ($buildings['f' . $i . 't'] == 14) {
                        $calculator->setTournamentSqLvl($buildings['f' . $i]);
                        break;
                    }
                }
            }
            $total = array_sum($units);
            $calculator->setMinSpeed($speeds);
            $timeTaken = $calculator->calc();
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {//withdraw
                if ($total) {
                    $move = new MovementsModel();
                    //process here
                    if (($wholeCount - $total) <= 0) {
                        if ($m->deleteEnforce($d) && $row['race'] <> 4) {
                            $move->addMovement($row['to_kid'], $row['kid'], $row['race'], $units, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $miliseconds, $miliseconds + $timeTaken * 1000);
                        }
                    } else {
                        $modify = [];
                        for ($i = 1; $i <= 11; ++$i) {
                            if (isset($units[$i]) && $units[$i]) {
                                $modify[] = "u{$i}=u{$i}-" . $units[$i];
                            }
                        }
                        if ($m->modifyEnforce($modify, $d) && $row['race'] <> 4) {
                            $move->addMovement($row['to_kid'], $row['kid'], $row['race'], $units, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $miliseconds, $miliseconds + $timeTaken * 1000);
                        }
                    }
                    if ($row['race'] <> 4) {
                        $o = new OasesModel();
                        {
                            $isOasis = $o->isOasis($row['to_kid']);
                            $targetKid = $isOasis ? $o->getOasisCaptureKid($row['to_kid']) : $row['to_kid'];
                            $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$targetKid");
                            $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($targetKid, $row['race']));
                            ResourcesHelper::modifyUpkeep($uid, $targetKid, $upkeep, 1);
                        }
                        $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
                        $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($row['kid'], $row['race']));
                        ResourcesHelper::modifyUpkeep($uid, $row['kid'], $upkeep);
                    }
                    redirect("build.php?id=39&tt=1");
                }
            }
            $trow = [
                "owner" => [
                    "kid" => "",
                    "uid" => $row['race'] == 4 ? 0 : $villageData['owner'],
                    "playerName" => $row['race'] == 4 ? T("Global", "NatureName") : $player['name'],
                    "villageName" => $row['race'] == 4 ? '<string>' . T("Global",
                            "NatureName") . '</string>' : $villageData['name'],
                ],
                "units" => $this->sortUnitsAssociated($units, $row['race']),
            ];
            $info = [];
            if ($row['race'] <> 4) {
                $info[] = [
                    "type" => "Arrival",
                    "ArrivalTime" => round(($miliseconds + 1000 * $timeTaken) / 1000),
                    "countUp" => TRUE,
                ];
            }
            $settings = [
                "noCoordinates" => TRUE,
                "noVillageLink" => TRUE,
                "troopHeadline" => '<a href="spieler.php?uid=' . ($row['race'] == 4 ? 0 : $villageData['owner']) . '">' . sprintf(T("RallyPoint",
                        "reinforcementForPlayerName"),
                        $row['race'] == 4 ? T("Global", "NatureName") : $player['name']) . '</a>',
                //maybe show coordinates
                "info" => $info,
                "showTroopsNum" => TRUE,
                "showTroopsType" => TRUE,
                "unitsAreEditable" => TRUE,
            ];
            $result['troops_details'] = $this->getMovementTable($trow, $settings);
            $result['submitButton'] = getButton([
                "id" => "s1_ok",
                "name" => 's1',
                "type" => "submit",
                "class" => 'green ',
                "title" => T("RallyPoint", "sendBack"),
            ],
                [
                    "data" => [
                        "class" => 'green ',
                        "value" => T("RallyPoint", "sendBack"),
                    ],
                ],
                T("RallyPoint", "sendBack"));
        }
        $view = new PHPBatchView("rallypoint/baseSend");
        $view->vars['process'] = $result;
        return $view->output();
    }

    public function sortUnitsAssociated($units, $race = 0)
    {
        $sorted = [];
        if (isset($units['race']) && $race == 0) {
            $race = $units['race'];
        }
        for ($i = 1; $i <= 11; ++$i) {
            if ($i == 11 && $race == 4) {
                continue;
            }
            if (!isset($units[$i])) {
                $units[$i] = 0;
            }
            $sorted[nrToUnitId($i, $race)] = $units[$i];
        }
        return $sorted;
    }

    public function procSettlers()
    {
        if (!isset($_POST['timestamp'])) {
            $_POST['timestamp'] = '';
        }
        if (!isset($_POST['timestamp_checksum'])) {
            $_POST['timestamp_checksum'] = '';
        }
        $baseResource = round(750 / 800 * Formulas::storeCAP(0));
        $resources = [$baseResource, $baseResource, $baseResource, $baseResource];


        $a2b = $this->getA2b($_POST['timestamp'], $_POST['timestamp_checksum']);
        $village = Village::getInstance();
        if (!Session::getInstance()->banned() && !Session::getInstance()->isInVacationMode() && !isServerFinished() && $a2b->num_rows && $village->isResourcesAvailable($resources)) {
            $a2b = $a2b->fetch_assoc();
            $this->removeA2b($a2b['timestamp'], $a2b['timestamp_checksum']);
            $db = DB::getInstance();
            $total = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId());
            $settlers = $db->fetchScalar("SELECT u10 FROM units WHERE kid=" . Village::getInstance()->getKid());
            if (Session::getInstance()->getCP() < Formulas::newVillageCP($total + 1)) {
                //$result['error'] = true;
                //$result['errorMsg'] = sprintf(T("RallyPoint", "Settlers", "notEnoughCulturePoints"), $session->cp, Metadata::getInstance()->get_new_village_cp_needed(sizeof($session->villages)));
                return;
            } else if ($settlers < 3) {
                //$result['error'] = true;
                //$result['errorMsg'] = sprintf(T("RallyPoint", "Settlers", "notEnoughSettlers"), $village->unitarray['u' . $settler], 3);
                //return $result;
                return;
            }
            $kid = $a2b['to_kid'];
            $db = DB::getInstance();
            $wdata = $db->query("SELECT fieldtype, occupied FROM wdata WHERE id=" . (int)$kid);
            if ($wdata->num_rows) {
                $wdata = $wdata->fetch_assoc();
            } else {
                $wdata = FALSE;
            }
            if ($kid == NULL || $kid == Formulas::xy2kid(0, 0)) {
                return FALSE;
            } else if ($wdata === FALSE || $wdata['occupied'] || !$wdata['fieldtype']) {//village is captured!
                return FALSE;
            } else if (isServerFinished() || Session::getInstance()->banned()) {
                return FALSE;
            } else if (Session::getInstance()->isInVacationMode()) {
                redirect("options.php?s=4");
                return FALSE;
            }
            $village->modifyResources($resources);
            $db = DB::getInstance();
            $stmtSuccess = $db->query("UPDATE units SET u10=u10-3 WHERE kid=" . $village->getKid());
            if ($stmtSuccess && $db->affectedRows() > 0) {
                $move = new MovementsModel();
                $units = array_fill(1, 10, 0);
                $units[10] = 3;
                $calc = new SpeedCalculator();
                $calc->setFrom($village->getKid());
                $calc->setTo($kid);
                $calc->setMinSpeed(Formulas::uSpeed(nrToUnitId(10, Session::getInstance()->getRace())));
                $time = $calc->calc();
                $quest = Quest::getInstance();
                $quest->setQuestBitwise('world', 16, 1);
                $move->addMovement($village->getKid(),
                    $a2b['to_kid'],
                    Session::getInstance()->getRace(),
                    $units,
                    0,
                    0,
                    0,
                    0,
                    0,
                    MovementsModel::ATTACKTYPE_SETTLERS,
                    miliseconds(true),
                    miliseconds(true) + $time * 1000);
            } else {
                Notification::notify("Bug bug bug!",
                    "Settlers () Troops double bug in player " . Session::getInstance()->getName());
            }
            redirect("build.php?id=39&tt=1");
            exit();
        } else {
            //type 6
            $kid = isset($_GET['kid']) && is_numeric($_GET['kid']) ? $_GET['kid'] : NULL;
            $db = DB::getInstance();
            $wdata = $db->query("SELECT fieldtype, occupied FROM wdata WHERE id=" . (int)$kid);
            if ($wdata->num_rows) {
                $wdata = $wdata->fetch_assoc();
            } else {
                $wdata = FALSE;
            }
            if ($kid == NULL || $kid == Formulas::xy2kid(0, 0)) {
                return FALSE;
            } else if ($wdata === FALSE || $wdata['occupied'] || !$wdata['fieldtype']) {//village is captured!
                return FALSE;
            }
            //let's send em =>
            $result = [
                "kid" => $kid,
                "error" => FALSE,
                'newVillage' => true,
                'neededResources' => $baseResource,
                "errorMsg" => NULL,
                "showSendTroops" => FALSE,
                "troops_details" => '',
                "attack_type" => 6,
                "timestamp_checksum" => get_random_string(6),
                "timestamp" => time(),
                "submitButton" => getButton([
                    "class" => "green",
                    "type" => "submit",
                    "name" => "s1",
                    "id" => "btn_ok",
                    "value" => T("RallyPoint", "send"),
                    "title" => T("RallyPoint", "send"),
                ],
                    [],
                    T("RallyPoint", "send")),
            ];
            $db = DB::getInstance();
            $total = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId());
            $settlers = $db->fetchScalar("SELECT u10 FROM units WHERE kid=" . Village::getInstance()->getKid());
            if (Session::getInstance()->getCP() < Formulas::newVillageCP($total + 1)) {
                //$result['error'] = true;
                //$result['errorMsg'] = sprintf(T("RallyPoint", "Settlers", "notEnoughCulturePoints"), $session->cp, Metadata::getInstance()->get_new_village_cp_needed(sizeof($session->villages)));
                return;
            } else if ($settlers < 3) {
                //$result['error'] = true;
                //$result['errorMsg'] = sprintf(T("RallyPoint", "Settlers", "notEnoughSettlers"), $village->unitarray['u' . $settler], 3);
                //return $result;
                return;
            }
            if (Formulas::isGrayArea($kid)) {
                $result['greyAreaCaution'] = true;
            }
            $rh = new RallyPointHTML();
            $units = array_fill(1, 10, 0);
            $units[10] = 3;
            $row = [
                "owner" => [
                    "kid" => "",
                    "uid" => Session::getInstance()->getPlayerId(),
                    "playerName" => Session::getInstance()->getName(),
                    "villageName" => Village::getInstance()->getName(),
                ],
                "units" => $this->sortUnits($units, Session::getInstance()->getRace()),
            ];
            $village = Village::getInstance();
            $calc = new SpeedCalculator();
            $calc->setFrom($village->getKid());
            $calc->setTo($kid);
            $calc->setMinSpeed(Formulas::uSpeed(nrToUnitId(10, Session::getInstance()->getRace())));
            $time = $calc->calc();
            $xy = Formulas::kid2xy($kid);
            $settings = [
                "noCoordinates" => TRUE,
                "noVillageLink" => TRUE,
                "troopHeadline" => '<a href="karte.php?d=' . $kid . '">' . T("RallyPoint",
                        "createNewVillage") . ' ‎<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a></a>',
                //maybe show coordinates
                "info" => [
                    [
                        "type" => "resources",
                        "resources" => $resources,
                        "noCarry" => TRUE,
                    ],
                    [
                        "type" => "Arrival",
                        "ArrivalTime" => time() + $time,
                        "countUp" => TRUE,
                    ],
                ],
                "showTroopsNum" => TRUE,
                "showTroopsType" => TRUE,
                "unitsAreEditable" => FALSE,
            ];
            $view = new PHPBatchView("rallypoint/baseSend");
            $result['troops_details'] = $rh->getMovementTable($row, $settings);
            if (!$village->isResourcesAvailable($resources)) {
                $result['error'] = TRUE;
                $result['errorMsg'] = T("RallyPoint", "Settlers.notEnoughResources");
                $view->vars['process'] = $result;
                return $view->output();
            } else if (Session::getInstance()->banned()) {
                $result['error'] = TRUE;
                $result['errorMsg'] = T("RallyPoint", "Errors.youAreBanned");
                $view->vars['process'] = $result;
                return $view->output();
            } else if (isServerFinished()) {
                $result['error'] = TRUE;
                $result['errorMsg'] = T("RallyPoint", "Errors.serverFinished");
                $view->vars['process'] = $result;
                return $view->output();
            } else if (Session::getInstance()->isInVacationMode()) {
                redirect("options.php?s=4");
            }
            $this->addA2b($result['timestamp'],
                $result['timestamp_checksum'],
                $kid,
                $units,
                MovementsModel::ATTACKTYPE_SETTLERS,
                0);
            $view->vars['process'] = $result;
            $view->vars['extra'] = '&a=6';
            return $view->output();
        }
    }

    public function getA2b($timestamp, $timestamp_checksum)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM a2b WHERE timestamp='{$timestamp}' AND timestamp_checksum='{$timestamp_checksum}'");
    }

    function removeA2b($timestamp, $timstamp_checksum)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM a2b WHERE timestamp='$timestamp' AND timestamp_checksum='$timstamp_checksum' LIMIT 1");
    }

    public function sortUnits($units, $race = 0)
    {
        $sorted = [];
        if (isset($units['race']) && $race == 0) {
            $race = $units['race'];
        }
        for ($i = 1; $i <= 11; ++$i) {
            if ($race == 4 && $i == 11) {
                continue;
            }
            if (!isset($units['u' . $i])) {
                $units['u' . $i] = 0;
            }
            $sorted[nrToUnitId($i, $race)] = isset($units[$i]) ? $units[$i] : $units['u' . $i];
        }
        return $sorted;
    }

    //process evasion settings.(On | Off)

    function addA2b($timestamp, $timestamp_checksum, $to_kid, $units, $attack_type, $redeployHero = 0)
    {
        if (!isset($units[11])) {
            $units[11] = 0;
        }
        $db = DB::getInstance();
        $query = vsprintf("INSERT INTO a2b (`timestamp`, `timestamp_checksum`, `to_kid`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `attack_type`, `redeployHero`) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            [
                $timestamp,
                $timestamp_checksum,
                $to_kid,
                $units[1],
                $units[2],
                $units[3],
                $units[4],
                $units[5],
                $units[6],
                $units[7],
                $units[8],
                $units[9],
                $units[10],
                $units[11],
                $attack_type,
                (int)$redeployHero,
            ]);
        $db->query($query);
        return $db->lastInsertId();
    }

    //incoming attacks table.

    public function procContent(&$l, $tt = 1)
    {
        $filter = $l['filter'];
        $subFiltersArray = $l['subFilters'];
        $session = Session::getInstance();
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        switch ($filter) {
            case 0:
                $page = 1;
                $inComing = $this->getIncomingMovements($page);
                if ($inComing['count']) {
                    $l['content'] .= '<h4 class="spacer">' . T("RallyPoint",
                            "filters.1") . ' (' . $inComing['count'] . ')</h4>';
                    $l['content'] .= $inComing['results'];
                    if ($inComing['count'] > $session->getRallyPointRecordsPerPage()) {
                        $l['content'] .= '<p class="switch"><a class="openedClosedSwitch switchClosed" href="?gid=16&amp;tt=1&amp;filter=1" title="' . T("RallyPoint",
                                "filters.1") . ' (' . $inComing['count'] . ')">' . T("RallyPoint",
                                "showAll") . '</a></p>';
                    }
                }
                $outGoing = $this->getOutgoingMovements($page);
                if ($outGoing['count']) {
                    $l['content'] .= '<h4 class="spacer">' . T("RallyPoint",
                            "filters.2") . ' (' . $outGoing['count'] . ')</h4>';
                    $l['content'] .= $outGoing['results'];
                    if ($outGoing['count'] > $session->getRallyPointRecordsPerPage()) {
                        $l['content'] .= '<p class="switch"><a class="openedClosedSwitch switchClosed" href="?gid=16&amp;tt=1&amp;filter=2" title="' . T("RallyPoint",
                                "filters.2") . ' (' . $inComing['count'] . ')">' . T("RallyPoint",
                                "showAll") . '</a></p>';
                    }
                }
                $inVillage = $this->processInVillageTroops($page, 3);
                if ($inVillage['count']) {
                    $l['content'] .= '<h4 class="spacer">' . T("RallyPoint",
                            "filters.3") . ' (' . $inVillage['count'] . ')</h4>';
                    $l['content'] .= $inVillage['results'];
                    if ($inVillage['count'] > $session->getRallyPointRecordsPerPage()) {
                        $l['content'] .= '<p class="switch"><a class="openedClosedSwitch switchClosed" href="?gid=16&amp;tt=1&amp;filter=3" title="' . T("RallyPoint",
                                "filters.3") . ' (' . $inVillage['count'] . ')">' . T("RallyPoint",
                                "showAll") . '</a></p>';
                    }
                }

                foreach ($this->oases as $kid) {
                    $kid = $kid['kid'];
                    $xy = Formulas::kid2xy($kid);
                    $inVillageOasis = $this->processInVillageTroops($page, 3, $kid);
                    if ($inVillageOasis['count']) {
                        $l['content'] .= '<h4 class="spacer">';
                        $l['content'] .= '<a style="color: #000;" href="karte.php?d=' . $kid . '">';
                        $l['content'] .= sprintf('%s (%s|%s)', T('RallyPoint', 'myOasis'), $xy['x'], $xy['y']) . ' (' . $inVillageOasis['count'] . ')</a></h4>';
                        $l['content'] .= $inVillageOasis['results'];
                        if ($inVillageOasis['count'] > $session->getRallyPointRecordsPerPage()) {
                            $l['content'] .= '<p class="switch"><a class="openedClosedSwitch switchClosed" href="?gid=16&amp;tt=1&amp;filter=3" title="' . T("RallyPoint", "filters.3") . ' (' . $inVillageOasis['count'] . ')">' . T("RallyPoint", "showAll") . '</a></p>';
                        }
                    }
                }

                $ouVillage = $this->processInVillageTroops($page, 4);
                if ($ouVillage['count']) {
                    $l['content'] .= '<h4 class="spacer">' . T("RallyPoint", "filters.4") . ' (' . $ouVillage['count'] . ')</h4>';
                    $l['content'] .= $ouVillage['results'];
                    if ($ouVillage['count'] > $session->getRallyPointRecordsPerPage()) {
                        $l['content'] .= '<p class="switch"><a class="openedClosedSwitch switchClosed" href="?gid=16&amp;tt=1&amp;filter=4" title="' . T("RallyPoint",
                                "filters.4") . ' (' . $ouVillage['count'] . ')">' . T("RallyPoint",
                                "showAll") . '</a></p>';
                    }
                }
                break;
            case 1:
                $inComing = $this->getIncomingMovements($page, $subFiltersArray);
                $l['content'] .= '<h4 class="spacer">' . T("RallyPoint", "filters.1") . ' (' . $inComing['count'] . ')</h4>';
                if ($inComing['count']) {
                    $p = new PageNavigator($page, $inComing['count'], $session->getRallyPointRecordsPerPage(), [
                        "id" => 39,
                        "tt" => $tt,
                        "filter" => $filter,
                    ], "build.php");
                    $l['content'] .= '<div class="paginatorTop">' . $p->get() . '<div class="clear"></div></div>';
                    $l['content'] .= $inComing['results'];
                    $l['content'] .= $p->get();
                } else {
                    $l['content'] .= T("RallyPoint", "no_incoming_troops_error");
                }
                break;
            case 2:
                $outGoing = $this->getOutgoingMovements($page, $subFiltersArray);
                $l['content'] .= '<h4 class="spacer">' . T("RallyPoint", "filters.2") . ' (' . $outGoing['count'] . ')</h4>';
                if ($outGoing['count']) {
                    $p = new PageNavigator($page, $outGoing['count'], $session->getRallyPointRecordsPerPage(), [
                        "id" => 39,
                        "tt" => $tt,
                        "filter" => $filter,
                    ], "build.php");
                    $l['content'] .= '<div class="paginatorTop">' . $p->get() . '<div class="clear"></div></div>';
                    $l['content'] .= $outGoing['results'];
                    $l['content'] .= $p->get();
                } else {
                    $l['content'] .= T("RallyPoint", "no_outgoing_troops_error");
                }
                break;
            case 3:
                $inVillage = $this->processInVillageTroops($page, 3);
                $l['content'] .= '<h4 class="spacer">' . T("RallyPoint", "filters.3") . ' (' . $inVillage['count'] . ')</h4>';
                if ($inVillage['count']) {
                    $p = new PageNavigator($page, $inVillage['count'], $session->getRallyPointRecordsPerPage(), [
                        "id" => 39,
                        "tt" => $tt,
                        "filter" => $filter
                    ], "build.php");
                    $l['content'] .= '<div class="paginatorTop">' . $p->get() . '<div class="clear"></div></div>';
                    $l['content'] .= $inVillage['results'];
                    if ($page == 1) {
                        $l['content'] .= <<<HTML
<script type="text/javascript">
    jQuery(function()
    {
        var c = 0;
        var last = -1;
        document.addEvent('click', function() {c = 0;last = -1;});
        jQuery('#unitRowAtTown .uniticon img').each(function(i, element)
        {
            jQuery(element).on('click', function(e)
            {
                c = (i > last ? c + 1 : 0);
                last = i;
                (c == 2 ? Travian.insertScript(
                    {
                        src: '/js/Game/Logout/Ee.js',
                        onLoad: function()
                        {
                            last = 100;
                            new Ee();
                        }
                    }) : {} );
                e.stop();
            });
        });
    });
</script>
HTML;
                    }
                    $l['content'] .= $p->get();
                }

                foreach ($this->oases as $kid) {
                    $kid = $kid['kid'];

                    $xy = Formulas::kid2xy($kid);
                    $inVillageOasis = $this->processInVillageTroops($page, 3, $kid);
                    $l['content'] .= '<h4 class="spacer"><a style="color: #000;" href="karte.php?d=' . $kid . '">' . sprintf('%s (%s|%s)', T('RallyPoint', 'myOasis'), $xy['x'], $xy['y']) . ' (' . $inVillage['count'] . ')</a></h4>';
                    if ($inVillageOasis['count']) {
                        $p = new PageNavigator($page, $inVillageOasis['count'], $session->getRallyPointRecordsPerPage(), [
                            "id" => 39,
                            "tt" => $tt,
                            "filter" => $filter
                        ], "build.php");
                        $l['content'] .= '<div class="paginatorTop">' . $p->get() . '<div class="clear"></div></div>';
                        $l['content'] .= $inVillageOasis['results'];
                    }
                }
                break;
            case 4:
                $ouVillage = $this->processInVillageTroops($page, 4);
                $l['content'] .= '<h4 class="spacer">' . T("RallyPoint", "filters.4") . ' (' . $ouVillage['count'] . ')</h4>';
                if ($ouVillage['count']) {
                    $p = new PageNavigator($page, $ouVillage['count'], $session->getRallyPointRecordsPerPage(), [
                        "id" => 39,
                        "tt" => $tt,
                        "filter" => $filter,
                    ], "build.php");
                    $l['content'] .= '<div class="paginatorTop">' . $p->get() . '<div class="clear"></div></div>';
                    $l['content'] .= $ouVillage['results'];
                    $l['content'] .= $p->get();
                } else {
                    $l['content'] .= T("RallyPoint", "no_outvillage_troops_error");
                }
                break;
        }
        return $l;
    }

    public function getIncomingMovements(&$page, $subFilters = [
        1 => 1,
        2 => 2,
        3 => 1,
    ])
    {
        $session = Session::getInstance();
        $village = Village::getInstance();
        $m = new RallyPointModel();
        $total_count = $m->getIncomingMovementsCount($subFilters);
        $total_pages = ceil($total_count / $session->getRallyPointRecordsPerPage());
        if ($page <= 0) {
            $page = 1;
        }
        if ($page > $total_pages) {
            $page = 1;
        }
        $return = [
            'count' => $total_count,
            "results" => '',
        ];
        $db = DB::getInstance();
        $all = $m->getIncomingMovementsByLimit($page, $subFilters);
        $o = new OasesModel();
        while ($row = $all->fetch_assoc()) {
            $row['start_time_seconds'] = round($row['start_time'] / 1000);
            $row['end_time_seconds'] = round($row['end_time'] / 1000);
            if ($row['mode'] == 1) {
                $mode = 'inReturn';
            } else {
                $mode = [
                            'inSpy',
                            'inSupply',
                            'inAttack',
                            'inRaid',
                            'inSettlers',
                            'inEscape',
                            'inAdventure',
                        ][$row['attack_type'] - 1];
                if (in_array($row['to_kid'], $this->oases)) {
                    $mode .= 'Oasis';
                }
            }
            $info = [];
            if ($mode == 'inReturn' && !empty($row['data'])) {
                //loots
                $carryAndLoot = explode(",", $row['data']);
                if ($carryAndLoot[4] > 0 || ($carryAndLoot[0] + $carryAndLoot[1] + $carryAndLoot[2] + $carryAndLoot[3]) > 0) {
                    $info[] = [
                        "type" => "resources",
                        "resources" => [
                            $carryAndLoot[0],
                            $carryAndLoot[1],
                            $carryAndLoot[2],
                            $carryAndLoot[3],
                        ],
                        "carry" => $carryAndLoot[4],
                    ];
                }
            }
            $info[] = [
                "type" => "Arrival",
                "ArrivalTime" => $row['end_time_seconds'],
                "countDown" => TRUE,
            ];
            switch ($mode) {
                case 'inReturn':
                    if ((int)$row['kid'] == 0) {
                        //escape
                        $troopHeadline = '<a href="karte.php?d=0">' . T("RallyPoint", "return") . ' ' . T("RallyPoint",
                                "from") . ' ' . T("RallyPoint", "CrannyForest") . '</a>';
                        break;
                    }
                    if ($row['kid'] == $row['to_kid']) {
                        $troopHeadline = T("RallyPoint", "reviving");
                        break;
                    }
                    if ((int)$row['attack_type'] == MovementsModel::ATTACKTYPE_ADVENTURE) {
                        $xy = Formulas::kid2xy($row['kid']);
                        $troopHeadline = '<a href="karte.php?d=' . $row['kid'] . '">' . T("RallyPoint",
                                "return") . ' ' . T("RallyPoint", "from") . ' ' . T("RallyPoint",
                                "adventure") . ' ‎<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a></a>';
                        break;
                    }
                    if ($o->isOasis($row['kid'])) {
                        $dname = T("RallyPoint",
                            $o->isOasisConqured($row['kid']) ? "occupiedOasis" : "unoccupiedOasis");
                        $xy = Formulas::kid2xy($row['kid']);
                        $dname .= ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a';
                    } else {
                        $dname = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$row['kid']} LIMIT 1");
                        if (empty($dname)) {
                            $xy = Formulas::kid2xy($row['kid']);
                            $dname .= T("Global",
                                    "Abandoned valley") . ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a';

                        }
                    }
                    $troopHeadline = '<a href="karte.php?d=' . $row['kid'] . '">' . T("RallyPoint",
                            "return") . ' ' . T("RallyPoint", "from") . ' ' . $dname . '</a>';
                    break;
                default:
                    if ($o->isOasis($row['to_kid'])) {
                        $dname = T("RallyPoint",
                            $o->isOasisConqured($row['to_kid']) ? "occupiedOasis" : "unoccupiedOasis");
                        $xy = Formulas::kid2xy($row['to_kid']);
                        $dname .= ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a';
                    } else {
                        $dname = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$row['to_kid']} LIMIT 1");
                    }
                    if (strpos($mode, "Supply") == 0) {
                        $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint",
                                $mode) . ' ' . T("RallyPoint", "against") . ' ' . $dname . '</a>';
                    } else {
                        $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint",
                                $mode) . ' ' . T("RallyPoint", "for") . ' ' . $dname . '</a>';
                    }
                    break;
            }
            $units = $this->sortUnits($row, $row['race']);
            if ($row['mode'] == 1) {
                $uid = $session->getPlayerId();
                $villageName = $village->getName();
                $username = $session->getName();
            } else {
                $player = $db->query("SELECT users.id, users.name FROM users, vdata WHERE users.id=vdata.owner AND vdata.kid={$row['kid']}")->fetch_assoc();
                $uid = $player['id'];
                $username = $row['race'] == 4 ? '<span class="none2">' . T("Global",
                        "NatureName") . '</span>' : $player['name'];
                if ($row['race'] == 4) {
                    $villageName = T("RallyPoint", "unoccupiedOasis");
                } else {
                    $villageName = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$row['kid']}");
                }
            }
            $data = [
                "row" => [
                    'id' => $row['id'],
                    "owner" => [
                        "kid" => $row['mode'] == 1 ? $row['to_kid'] : $row['kid'],
                        "uid" => $uid,
                        "playerName" => $username,
                        "villageName" => $villageName,
                    ],
                    "units" => $units,
                ],
                "settings" => [
                    'movementId' => $row['id'],
                    'markState' => $row['markState'],
                    'showMarkState' => ($row['attack_type'] == 3 || $row['attack_type'] == 4) && $row['mode'] == 0,
                    "noCoordinates" => FALSE,
                    "troopDetailsClass" => $mode,
                    "troopHeadline" => $troopHeadline,
                    "info" => $info,
                    "showTroopsNum" => $row['mode'] == 1 || $uid == Session::getInstance()->getPlayerId() || Session::getInstance()->isAdmin(),
                    "showTroopsType" => ($mode != "inSupply" && $mode != "inSupplyOasis") ? ($this->artifact || array_sum($units) < $this->rallyPointLvl) : FALSE,
                ],
            ];
            $return['results'] .= $this->getMovementTable($data['row'], $data['settings']);
            $return['results'] .= '<a name="at"></a>';
        }
        return $return;
    }

    public function getOutgoingMovements(&$page, $subFilters = [
        4 => 1,
        5 => 1,
        6 => 0,
    ])
    {
        $session = Session::getInstance();
        $village = Village::getInstance();
        $m = new RallyPointModel();
        $total_count = $m->getOutgoingMovementsCount($subFilters);
        $total_pages = ceil($total_count / $session->getRallyPointRecordsPerPage());
        if ($page <= 0) {
            $page = 1;
        }
        if ($page > $total_pages) {
            $page = 1;
        }
        $return = [
            'count' => $total_count,
            "results" => '',
        ];
        $db = DB::getInstance();
        $o = new OasesModel();
        $all = $m->getOutgoingMovementsByLimit($page, $subFilters);
        while ($row = $all->fetch_assoc()) {
            $row['start_time_seconds'] = round($row['start_time'] / 1000);
            $row['end_time_seconds'] = round($row['end_time'] / 1000);
            $mode = [
                        'outSpy',
                        'outSupply',
                        'outAttack',
                        'outRaid',
                        'outSettlers',
                        'outEscape',
                        'outHero',
            ][$row['attack_type'] - 1];
            $cata = $targets = $info = [];
            if ($row['attack_type'] == MovementsModel::ATTACKTYPE_SPY) {
                $targets[] = [
                    "type" => "spy",
                    "targetId" => $row['spyType']
                ];
            }
            if ((int)$row['attack_type'] === MovementsModel::ATTACKTYPE_NORMAL) {
                if ($row['u8'] > 0) {
                    $cata[] = [
                        "type" => "targets",
                        'lvl' => $this->rallyPointLvl,
                        "ctar1" => $row['ctar1'],
                        "ctar2" => $row['ctar2'],
                    ];
                }
            }
            if (getCustom("realCancelAttack")) {
                $max_time_past = 90;
            } else {
                $max_time_past = round(($row['end_time_seconds'] - $row['start_time_seconds']) / 3);
            }
            $time_past = time() - $row['start_time_seconds'];
            $canAbort = $time_past <= $max_time_past;
            $info[] = [
                "type" => "Arrival",
                "ArrivalTime" => $row['end_time_seconds'],
                "countDown" => TRUE,
                "taskId" => $row['id'],
                "abort" => $row['attack_type'] == MovementsModel::ATTACKTYPE_EVASION || $canAbort
            ];
            if ((int)$row['to_kid'] == 0) {
                //escape
                $troopHeadline = '<a href="karte.php?d=0">' . T("RallyPoint", "outEscape") . '</a>';
                goto afterSwitch;
            }
            switch ($mode) {
                case 'outHero': //adventure
                    $xy = Formulas::kid2xy($row['to_kid']);
                    $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint", "adventure") . ' ‎<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a></a>';
                    break;
                default:
                    if ($o->isOasis($row['to_kid'])) {
                        $dname = T("RallyPoint",
                            ($o->isOasisConqured($row['to_kid']) ? "occupiedOasis" : "unoccupiedOasis"));
                        $xy = Formulas::kid2xy($row['to_kid']);
                        $dname .= ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a';
                    } else {
                        $dname = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$row['to_kid']} LIMIT 1");
                    }
                    if ($row['attack_type'] != MovementsModel::ATTACKTYPE_REINFORCEMENT) {
                        if ($mode == 'outSettlers') {
                            $xy = Formulas::kid2xy($row['to_kid']);
                            $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint", $mode) . '</a> <span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $xy['y'] . ')</span></span>‎</a>';
                        } else {
                            $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint", $mode) . ' ' . T("RallyPoint", $row['attack_type'] == MovementsModel::ATTACKTYPE_SPY || $row['attack_type'] == MovementsModel::ATTACKTYPE_RAID ? "of" : "against") . ' ' . $dname . '</a>';
                        }
                    } else {
                        $troopHeadline = '<a href="karte.php?d=' . $row['to_kid'] . '">' . T("RallyPoint", $mode) . ' ' . T("RallyPoint", "for") . ' ' . $dname . '</a>';
                    }
                    break;
            }
            afterSwitch:
            $data = [
                "row" => [
                    'id' => $row['id'],
                    "owner" => [
                        "kid" => $row['kid'],
                        "uid" => $session->getPlayerId(),
                        "playerName" => $session->getName(),
                        "villageName" => $village->getName(),
                    ],
                    "units" => $this->sortUnits($row, $row['race'])
                ],
                "settings" => [
                    "troopDetailsClass" => strpos($mode, "Settlers") != 0 ? "" : $mode,
                    "troopHeadline" => $troopHeadline,
                    "info" => $info,
                    "targets" => $targets,
                    "cata" => $cata,
                    "showTroopsNum" => TRUE,
                    "showTroopsType" => TRUE
                ]
            ];
            $return['results'] .= $this->getMovementTable($data['row'], $data['settings']);
            $return['results'] .= '<a name="tu"></a>';
        }
        return $return;
    }

    public function processInVillageTroops(&$page, $filter = 0, $oasis = false)
    {
        $village = Village::getInstance();
        $session = Session::getInstance();
        //to own village
        $return = [
            'count' => 0,
            "results" => '',
        ];
        //oasis reinforcements
        $m = new RallyPointModel();
        $trappedCount = $oasis ? 0 : $m->getTrappedCount($filter == 4 ? 1 : 0);
        $enforcesCount = $oasis ? $m->getOasisEnforcesCount($oasis) : $m->getEnforcesCount($filter == 4 ? 1 : 0);
        $return['count'] = ($filter == 3 ? 1 : 0) + $enforcesCount + $trappedCount + ($oasis ? -1 : 0);
        if ($page > ceil($return['count'] / $session->getRallyPointRecordsPerPage())) {
            $page = 1;
        }
        if ($page == 1 && $filter == 3) {
            $units = [];
            if ($oasis) {
                $result = $m->getMyOasisEnforce(Village::getInstance()->getKid(), $oasis);
                while ($row = $result->fetch_assoc()) {
                    for ($i = 1; $i <= 11; ++$i) {
                        $id = nrToUnitId($i, $row['race']);
                        $units[$id] = $row['u' . $i];
                    }
                    $data = [
                        "row" => [
                            "owner" => [
                                "kid" => $village->getKid(),
                                "uid" => $session->getPlayerId(),
                                "playerName" => $session->getName(),
                                "villageName" => $village->getName(),
                            ],
                            "units" => $units,
                        ],
                        "settings" => [
                            "unitsRowId" => "unitRowAtTown",
                            "troopDetailsClass" => '',
                            "troopHeadline" => T("RallyPoint", "ownTroops"),
                            "info" => [
                                [
                                    "type" => "Consumption",
                                    "consumption" => $this->getTotalCropConsumption($row['race'], $units, $village->getHorseDrinkingPoolLvl(), $this->dietArtefactEffect),
                                ],
                            ],
                            "showTroopsNum" => TRUE,
                            "showTroopsType" => $this->artifact,
                        ],
                    ];
                    $return['results'] .= $this->getMovementTable($data['row'], $data['settings']);
                    $return['results'] .= '<a name="td"></a>';
                }
            } else {
                $row = $m->getUnits(Village::getInstance()->getKid());
                for ($i = 1; $i <= 11; ++$i) {
                    $id = nrToUnitId($i, $session->getRace());
                    $units[$id] = $row['u' . $i];
                }
                $data = [
                    "row" => [
                        "owner" => [
                            "kid" => $village->getKid(),
                            "uid" => $session->getPlayerId(),
                            "playerName" => $session->getName(),
                            "villageName" => $village->getName(),
                        ],
                        "units" => $units,
                    ],
                    "settings" => [
                        "unitsRowId" => "unitRowAtTown",
                        "troopDetailsClass" => '',
                        "troopHeadline" => T("RallyPoint", "ownTroops"),
                        "info" => [
                            [
                                "type" => "Consumption",
                                "consumption" => $this->getTotalCropConsumption($session->getRace(), $units, $village->getHorseDrinkingPoolLvl(), $this->dietArtefactEffect),
                            ],
                        ],
                        "showTroopsNum" => TRUE,
                        "showTroopsType" => $this->artifact,
                    ],
                ];
                $return['results'] .= $this->getMovementTable($data['row'], $data['settings']);
                $return['results'] .= '<a name="td"></a>';
            }
        }
        //village and oasis of course :D
        $this->getVillageEnforces($page, $filter, 1, $enforcesCount, $return, $oasis);
        if (!$oasis)
            $this->getVillageTrapped($page, $filter, 1 + $enforcesCount, $trappedCount, $return);
        //oasis reinforcements!
        return $return;
    }

    private function getTotalCropConsumption($race, $units, $hdp, $effect = 1)
    {
        if ($race == 4) {
            return 0;
        }
        $total = 0;
        foreach ($units as $nr => $amount) {
            $nr = unitIdToNr($nr);
            if ($nr <= 10) {
                $unitId = nrToUnitId($nr, $race);
            } else {
                $unitId = 98;
            }
            $total += $amount * Formulas::uUpkeep($unitId, $hdp);
        }
        return $total * $effect;
    }

    public function getVillageEnforces(&$page, $filter, $lastResults, $enforcesCount, &$result, $oasis = false)
    {
        $village = Village::getInstance();
        $session = Session::getInstance();
        $db = DB::getInstance();
        $end = ceil($lastResults / $session->getRallyPointRecordsPerPage()); //finish of the last results
        $usedOnEnd = $session->getRallyPointRecordsPerPage() - (($end * $session->getRallyPointRecordsPerPage()) - $lastResults);
        $free = $page == $end ? ($end * $session->getRallyPointRecordsPerPage()) - $lastResults : $session->getRallyPointRecordsPerPage();//free results the last page /** $end * $limit - $total */
        $pageFrom = ($page - $end) * $session->getRallyPointRecordsPerPage();
        if ($page > $end) {
            $pageFrom -= $usedOnEnd; //page from -results shown!
        }
        $o = new OasesModel();
        if ($page >= $end && $enforcesCount) {
            $m = new RallyPointModel();
            $enforces = $oasis ? $m->getOasisEnforcesByLimit($village->getKid(), $oasis, $pageFrom, $free) : $m->getEnforcesByLimit($pageFrom, $free, $filter == 4 ? 1 : 0);
            foreach ($enforces as $trap) {
                if ($trap['race'] == 4) {
                    $player = [
                        "name" => T("Global", "NatureName"),
                        'race' => 4,
                    ];
                    $trappedFromVillage = [];
                } else {
                    $trappedFromVillage = $db->query("SELECT owner, name FROM vdata WHERE kid={$trap['kid']}")->fetch_assoc();
                    $player = $db->query("SELECT name, race FROM users WHERE id={$trappedFromVillage['owner']}")->fetch_assoc();
                }
                $hdp = 0;
                $units = $this->sortUnits($trap, $player['race']);
                if ($trap['to_kid'] == $village->getKid()) {
                    $hdp = $village->getHorseDrinkingPoolLvl();
                    $effect = $this->dietArtefactEffect;
                } else {
                    if($oasis){
                        $hdp = $village->getHorseDrinkingPoolLvl();;
                    } else {
                        if($o->isOasis($trap['to_kid'])){
                            $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid=" . $o->getOasisCaptureKid($trap['to_kid']))->fetch_assoc();
                            for ($i = 18; $i <= 38; ++$i) {
                                if ($buildings['f' . $i . 't'] == 41) {
                                    $hdp = $buildings['f' . $i];
                                    break;
                                }
                            }
                        }
                    }
                    $effect = 1;
                    if (ArtefactsModel::artifactsReleased()) {
                        if ($o->isOasis($trap['to_kid'])) {
                            $uid = $db->fetchScalar("SELECT owner FROM odata WHERE kid={$trap['to_kid']}");
                        } else {
                            $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$trap['to_kid']}");
                        }
                        $effect = ArtefactsModel::getArtifactEffectByType($uid, $trap['to_kid'], ArtefactsModel::ARTIFACT_DIET);
                    }
                }
                if ($trap['kid'] == $village->getKid()) {//own reinforcements in other villages
                    $villageName = $this->getVillageName($trap['to_kid']);
                    $troopHeadline = '<a href="karte.php?d=' . $trap['to_kid'] . '">' . sprintf(T("RallyPoint", "reinforcementForVillageName"), $villageName) . '</a>';
                } else {//others reinforcements
                    if ($trap['race'] == 4) {
                        $troopHeadline = sprintf(T("RallyPoint", "reinforcementForPlayerName"), $player['name']);
                    } else {
                        $troopHeadline = '<a href="karte.php?d=' . $trap['kid'] . '">' . sprintf(T("RallyPoint", "reinforcementForPlayerName"), $player['name']) . '</a>';
                    }
                }
                $data = [
                    "row" => [
                        'id' => $trap['id'],
                        "owner" => [
                            "kid" => $trap['kid'],
                            "uid" => $trap['race'] == 4 ? 0 : $trappedFromVillage['owner'],
                            "playerName" => $player['name'],
                            "villageName" => $player['race'] == 4 ? '<strong>' . T("Global", "NatureName") . '</strong>' : $trappedFromVillage['name'],
                        ],
                        "units" => $units,
                    ],
                    "settings" => [
                        'noCoordinates' => $player['race'] == 4,
                        'noVillageLink' => $player['race'] == 4,
                        "troopDetailsClass" => '',
                        "troopHeadline" => $troopHeadline,
                        "info" => [
                            [
                                "type" => "Consumption",
                                "consumption" => $this->getTotalCropConsumption($trap['race'], $units, $hdp, $effect),
                                "taskId" => $trap['id'],
                                "back" => !($trap['kid'] == $village->getKid()),
                                "withdraw" => $trap['kid'] == $village->getKid(),
                            ],
                        ],
                        "showTroopsNum" => TRUE,
                        "showTroopsType" => TRUE,
                    ],
                ];
                $result['results'] .= $this->getMovementTable($data['row'], $data['settings']);
                $result['results'] .= '<a name="td"></a>';
            }
        }
    }

    private function getVillageName($kid)
    {
        $db = DB::getInstance();
        $status = $db->query("SELECT oasistype, occupied FROM wdata WHERE id=$kid");
        if (!$status->num_rows) {
            return '<span class="none2">[?]</span>';
        }
        $status = $status->fetch_assoc();
        if ($status['oasistype']) {
            $xy = Formulas::kid2xy($kid);
            return ($status['occupied'] ? T("Reports", "occupiedOasis") : T("Reports",
                    "unoccupiedOasis")) . ' <span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span>';
        }
        $name = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
        if (empty($name)) {
            return '<span class="none2">[?]</span>';
        }
        return $name;
    }

    public function getVillageTrapped(&$page, $filter, $lastResults, $trappedCount, &$result)
    {
        $mySessionVillage = Village::getInstance();
        $session = Session::getInstance();
        $db = DB::getInstance();
        //others trapped units!
        $end = ceil($lastResults / $session->getRallyPointRecordsPerPage()); //finish of the last results
        $usedOnEnd = $session->getRallyPointRecordsPerPage() - (($end * $session->getRallyPointRecordsPerPage()) - $lastResults);
        $free = $page == $end ? ($end * $session->getRallyPointRecordsPerPage()) - $lastResults : $session->getRallyPointRecordsPerPage();//free results the last page /** $end * $limit - $total */
        $pageFrom = ($page - $end) * $session->getRallyPointRecordsPerPage();
        if ($page > $end) {
            $pageFrom -= $usedOnEnd; //page from -results shown!
        }
        if ($page >= $end && $trappedCount) {
            $m = new RallyPointModel();
            $trapped = $m->getTrappedByLimit($pageFrom, $free, $filter == 4 ? 1 : 0);
            foreach ($trapped as $trap) {
                $trappedFromVillage = $db->query("SELECT kid, owner, name FROM vdata WHERE kid={$trap['kid']}")->fetch_assoc();
                $player = $db->query("SELECT name, race FROM users WHERE id={$trappedFromVillage['owner']}")->fetch_assoc();
                if ($trap['kid'] == $mySessionVillage->getKid()) {
                    $hdp = $mySessionVillage->getHorseDrinkingPoolLvl();
                    $effect = $this->dietArtefactEffect;
                } else {
                    $hdp = 0;
                    $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$trappedFromVillage['kid']}")->fetch_assoc();
                    for ($i = 18; $i <= 38; ++$i) {
                        if ($buildings['f' . $i . 't'] == 41) {
                            $hdp = $buildings['f' . $i];
                            break;
                        }
                    }
                    $arts = new ArtefactsModel();
                    $effect = ArtefactsModel::getArtifactEffectByType($trappedFromVillage['owner'], $trap['kid'], ArtefactsModel::ARTIFACT_DIET);
                }
                if ($trap['kid'] == $mySessionVillage->getKid()) {//own imprisend unuts
                    $villageName = $db->fetchScalar("SELECT name FROM vdata WHERE kid={$trap['to_kid']}");
                    $troopHeadline = '<a href="karte.php?d=' . $trap['to_kid'] . '">' . sprintf(T("RallyPoint",
                            "imprisendInVillage"),
                            $villageName) . '</a>';
                } else {
                    $villageName = $trappedFromVillage['name'];
                    $troopHeadline = '<a href="karte.php?d=' . $trap['kid'] . '">' . sprintf(T("RallyPoint", "imprisendPlayer"),
                            $player['name']) . '</a>';
                }
                $units = $this->sortUnits($trap, $player['race']);
                $param = $filter == 4 ? 'kill' : 'free';
                $data = [
                    "row" => [
                        'id' => $trap['id'],
                        "owner" => [
                            "kid" => $trap['kid'],
                            "uid" => $trappedFromVillage['owner'],
                            "playerName" => $player['name'],
                            "villageName" => $villageName,
                        ],
                        "units" => $units,
                    ],
                    "settings" => [
                        "troopDetailsClass" => '',
                        "troopHeadline" => $troopHeadline,
                        "info" => [
                            [
                                "type" => "Consumption",
                                "consumption" => $this->getTotalCropConsumption($trap['race'], $units, $hdp, $effect),
                                "taskId" => $trap['id'],
                                $param => TRUE,
                                "filter" => $filter,
                            ],
                        ],
                        "showTroopsNum" => TRUE,
                        "showTroopsType" => $this->artifact,
                    ],
                ];
                $result['results'] .= $this->getMovementTable($data['row'], $data['settings']);
                $result['results'] .= '<a name="td"></a>';
            }
        }
    }

    public function procEvasion()
    {
        $session = Session::getInstance();
        if (!Session::getInstance()->hasGoldClub()) {
            return FALSE;
        }
        if (strtolower($_SERVER['REQUEST_METHOD']) == "post") {
            $troopEscape = isset($_POST['troop_escape_active']) ? 1 : 0;
            $session->setEvasionStatus((int)$troopEscape);
            return TRUE;
        }
        return FALSE;
    }
}