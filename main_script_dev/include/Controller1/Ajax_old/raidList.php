<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Core\FarmlistTracker;
use Core\Helper\SessionVar;
use Core\Session;
use Game\Formulas;
use Game\NoticeHelper;
use Game\SpeedCalculator;
use Core\Locale;
use function getDisplay;
use function miliseconds;
use Model\ArtefactsModel;
use Model\FarmListModel;
use Model\MovementsModel;
use Model\RallyPoint\RallyPointModel;
use resources\View\PHPBatchView;

class raidList extends AjaxBase
{
    public function dispatch()
    {
        $_POST['context'] = null;
        $action = $_POST['method'];
        if (isset($_POST['context']) && in_array($_POST['context'], ['raidList', 'RallyPoint', 'map'])) {
            $this->response['data']['html'] = '';
        }
        switch ($action) {
            case 'actionAddListForm':
                $view = new PHPBatchView("farmlist/newList");
                $this->response['data']['html'] = $view->output();
                break;
            case 'ActionAddSlotForm':
            case 'actionEditSlotForm':
                $this->actionAddSlotForm();
                break;
            case 'ActionEditAllSlotsForm':
                $this->actionEditAllSlotsForm();
                break;
            case 'loading':
                $this->loading();
                break;
            case 'attackFarmList':
                if (getDisplay("farmListHelperIconActions")) {
                    $this->attackFarmList();
                }
                break;
            case 'actionDeleteSlot':
                $m = new FarmListModel();
                $m->deleteSlot((int)$_POST['slotId'], Session::getInstance()->getPlayerId());
                break;
            case 'ActionCheckForForeignSlotEntry':
                $m = new FarmListModel();
                $this->response['data']['entryExists'] = $m->entryExists((int)$_REQUEST['listId'], Formulas::xy2kid($_REQUEST['x'], $_REQUEST['y']), Session::getInstance()->getPlayerId());
                break;
            case 'actionEditAllSlots':
                if (getDisplay("displayFarmlistEditAll")) {
                    $m = new FarmListModel();
                    $listId = (int)$_POST['listId'];
                    $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
                    if ($list === FALSE) {
                        return;
                    }
                    $units = [];
                    for ($i = 1; $i <= 10; ++$i) {
                        $units[$i] = $i == Formulas::getSpyId(Session::getInstance()->getRace()) ? 0 : abs((int)$_POST['t' . $i]);
                    }
                    if (!array_sum($units)) {
                        $this->response['error'] = TRUE;
                        $this->response['errorMsg'] = T("FarmList", "noTroopsSelected");
                        return;
                    }
                    DB::getInstance()->query("UPDATE raidlist SET u1={$units[1]}, u2={$units[2]}, u3={$units[3]}, u4={$units[4]}, u5={$units[5]}, u6={$units[6]}, u7={$units[7]}, u8={$units[8]}, u9={$units[9]}, u10={$units[10]} WHERE lid=$listId");
                }
                break;
            case 'ActionAddSlot':
                $this->response['data']['updatedSlotId'] = 0;
                $this->response['data']['updatedFarmListId'] = 0;
                $this->response['data']['html'] = null;
                $m = new FarmListModel();
                $listId = (int)$_POST['listId'];
                $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
                if ($list === FALSE) {
                    return;
                }
                if(isset($_REQUEST['slotId'])){
                    $slot = $m->getSlot((int) $_REQUEST['slotId']);
                    if($slot && $slot['lid'] != $listId){
                        $this->response['data']['updatedFarmListId'] = (int)$slot['lid'];
                        $m->deleteSlot($slot['id'], Session::getInstance()->getPlayerId());
                    }
                }
                $kid = Formulas::xy2kid($_POST['x'], $_POST['y']);
                if (!$m->isThereAnyThing($kid)) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "noVillageInTarget");
                    return;
                }
                $cap_kid = Formulas::xy2kid(0, 0);
                if ($kid == $cap_kid) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "errorWorldWonderVillage");
                    return;
                }
                if ($kid == $list['kid']) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "sameVillageEntered");
                    return;
                }
                $slotId = $m->slotExistsByKid($kid, $listId);
                $units = [];
                for ($i = 1; $i <= 10; ++$i) {
                    $units[$i] = $i == Formulas::getSpyId(Session::getInstance()->getRace()) ? 0 : abs((int)$_POST['t' . $i]);
                }
                if (!array_sum($units)) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "noTroopsSelected");
                    return;
                }
                if ($slotId !== FALSE) {
                    $this->response['data']['updatedSlotId'] = $slotId;
                    $m->editSlot($slotId, $units);
                } else {
                    if ($m->getFarmListSlotsCount($listId) >= 100) {
                        $this->response['error'] = TRUE;
                        $this->response['errorMsg'] = T("FarmList", "slotsFull");
                        return;
                    }
                    $distance = Formulas::getDistance($kid, $list['kid']);
                    $m->addSlot($listId, $distance, $kid, $units);
                }
                break;
            case 'actionCheckSlotExists':
                $m = new FarmListModel();
                $listId = (int)$_POST['listId'];
                $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
                if ($list === FALSE) {
                    return;
                }
                $this->response['data']['slotExists'] = FALSE;
                $this->response['data']['html'] = '';
                $kid = Formulas::xy2kid($_POST['x'], $_POST['y']);
                if (($slot = $m->slotExistsByKid($kid, $listId)) !== FALSE) {
                    $this->response['data']['slotExists'] = TRUE;
                    $_POST['slotId'] = $slot;
                    $this->actionAddSlotForm();
                }
                break;
            case 'actionUpdateListForm':
                $m = new FarmListModel();
                $list = $m->getMyFarmListById((int)$_POST['listId'], Session::getInstance()->getPlayerId());
                if ($list !== FALSE) {
                    $view = new PHPBatchView("farmlist/actionUpdateListForm");
                    $view->vars['lid'] = $list['id'];
                    $view->vars['name'] = $list['name'];
                    $this->response['data']['html'] = $view->output();
                }
                break;
            case 'actionAddList':
                $m = new FarmListModel();
                $listName = filter_var($_POST['listName'], FILTER_SANITIZE_STRING);
                if ($m->isVillageMine(Session::getInstance()->getPlayerId(), (int)$_POST['did'])) {
                    if (empty($listName)) {
                        $this->response['error'] = TRUE;
                        $this->response['errorMsg'] = T("FarmList", "enterListName");
                        break;
                    } else if (!$m->isListNameUnique($listName,
                        (int)$_POST['did'],
                        Session::getInstance()->getPlayerId())) {
                        $this->response['error'] = TRUE;
                        $this->response['errorMsg'] = T("FarmList", "nameIsNotUnique");
                        break;
                    } else if (strlen($listName) >= 45) {
                        $this->response['error'] = TRUE;
                        $this->response['errorMsg'] = T("FarmList", "nameTooLong");
                        break;
                    }
                    $m->addFarmList(Session::getInstance()->getPlayerId(), (int)$_POST['did'], $listName);
                }
                break;
            case 'actionUpdateList':
                $m = new FarmListModel();
                $listName = filter_var($_POST['listName'], FILTER_SANITIZE_STRING);
                $list = $m->getMyFarmListById((int)$_POST['listId'], Session::getInstance()->getPlayerId());
                if ($list === FALSE) {
                    return;
                }
                if (empty($listName)) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "enterListName");
                    break;
                } else if (!$m->isListNameUnique($listName, $list['kid'], Session::getInstance()->getPlayerId())) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "nameIsNotUnique");
                    break;
                } else if (strlen($listName) >= 45) {
                    $this->response['error'] = TRUE;
                    $this->response['errorMsg'] = T("FarmList", "nameTooLong");
                    break;
                }
                $m->changeFarmListName((int)$_POST['listId'], $listName);
                break;
        }
    }

    private function actionEditAllSlotsForm()
    {
        if (!getDisplay("displayFarmlistEditAll")) return;
        $listId = (int)$_POST['listId'];
        $m = new FarmListModel();
        $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
        if ($list === FALSE) {
            return;
        }
        $view = new PHPBatchView("farmlist/actionEditAllSlotsForm");
        $view->vars['lid'] = $listId;
        $this->response['data']['html'] = $view->output();
    }

    private function loading()
    {
        $view = new PHPBatchView('ajax/loading');
        $this->response['data']['html'] = $view->output();
    }

    private function actionAddSlotForm()
    {
        $listId = (int)$_REQUEST['listId'];
        $m = new FarmListModel();
        $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
        if ($list === FALSE) {
            return;
        }
        $view = new PHPBatchView("farmlist/actionAddSlotForm");
        if (isset($_REQUEST['x']) && isset($_REQUEST['y'])) {
            $view->vars['x'] = Formulas::coordinateFixer($_REQUEST['x']);
            $view->vars['y'] = Formulas::coordinateFixer($_REQUEST['y']);
            if ($slotId = $m->slotExistsByKid(Formulas::xy2kid($view->vars['x'], $view->vars['y']), $list['id'])) {
                $_POST['slotId'] = $slotId;
            }
        }
        if (isset($_REQUEST['slotId'])) {
            $slotId = (int)$_REQUEST['slotId'];
            $slot = $m->getSingleRaidList($slotId, $listId);
            if ($slot !== FALSE) {
                $view->vars['units'] = [];
                for ($i = 1; $i <= 10; ++$i) {
                    $view->vars['units'][$i] = $slot['u' . $i];
                }
                $xy = Formulas::kid2xy($slot['kid']);
                $view->vars['x'] = $xy['x'];
                $view->vars['y'] = $xy['y'];
                $view->vars['slotId'] = $slotId;
            }
        }
        $view->vars['targets'] = [];
        $view->vars['target_id'] = '';
        $lastTargets = $m->getLastTargets(Session::getInstance()->getPlayerId());
        while ($row = $lastTargets->fetch_assoc()) {
            if (!$m->isThereAnyThing($row['to_kid'])) {
                continue;
            }
            $xy = Formulas::kid2xy($row['to_kid']);
            if ($m->isOasis($row['to_kid'])) {
                $name = T("FarmList", $m->isOasisConqured($row['to_kid']) ? "occupiedOasis" : "unoccupiedOasis");
                $name .= ' &#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(' . $xy['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $xy['y'] . '&#x202c;&#x202c;)</span></span>&#x202c;‎</a';
            } else {
                $name = $m->getVillage($row['to_kid'], 'name')['name'];
            }
            $name = addslashes($name);
            $view->vars['target_id'] .= '<option value="' . $row['to_kid'] . '">' . $name . '</option>';
            $view->vars['targets'][] = [
                'did' => $row['to_kid'],
                'name' => $name,
                'x' => $xy['x'],
                'y' => $xy['y'],
            ];
        }
        $view->vars['lid'] = $listId;
        $this->response['data']['html'] = $view->output();
    }

    private function attackFarmList()
    {
        if (Session::getInstance()->banned() || Config::getInstance()->dynamic->serverFinished) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
            return;
        }
        if (Session::getInstance()->isInVacationMode()) {
            return;
        }
        $listId = (int)$_POST['lid'];
        $m = new FarmListModel();
        $list = $m->getMyFarmListById($listId, Session::getInstance()->getPlayerId());
        if(!(new RallyPointModel())->checkMaxAttacks($list['kid'])){
            $this->response['data']['html'] = 'Maximum attack limit reached.';
            return;
        }
        if ($list === FALSE || $list['auto'] == 1) {
            return;
        }
        if (FarmlistTracker::isLocked()) {
            $this->response['data']['functionToCall'] = 'reloadUrl';
            return;
        }
        $this->response['data']['ajaxToken'] = Session::getInstance()->getAjaxToken();
        FarmlistTracker::addTry();
        $nextRaid = $list['lastRaid'] + Config::getInstance()->game->farmListInterval;
        if ($nextRaid > time()) {
            $this->response['data']['html'] = sprintf(T("FarmList",
                "You attacked %s seconds ago, you need to wait %s seconds before sending another raid"),
                time() - $list['lastRaid'],
                $nextRaid - time());
            return;
        }
        $type = (int)$_POST['type'];
        if ($type > 4 || $type < 1) {
            return;
        }
        $db = DB::getInstance();
        if ($type == 4) {
            $result = $db->query("SELECT * FROM raidlist WHERE lid=$listId ORDER BY RAND()");
        } else {
            $result = $db->query("SELECT * FROM raidlist WHERE lid=$listId");
        }
        $sentCount = 0;
        $speedCalculate = new SpeedCalculator();
        $speedCalculate->setTournamentSqLvl($m->getTournamentSqLvl($list['kid']));
        $speedCalculate->setArtefactEffect(ArtefactsModel::getArtifactEffectByType(Session::getInstance()->getPlayerId(), $list['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $speedCalculate->setFrom($list['kid']);
        $move = new MovementsModel();
        while ($row = $result->fetch_assoc()) {
            $modified_units = [];
            $lastReportType = $this->checkReportState($row['kid']);
            if (($lastReportType != $type && ($type != 1 && $type != 4)) || $lastReportType == 4) continue;
            $speedCalculate->hasCata($row['u8'] > 0);
            $canRaid = TRUE;
            $speeds = [];
            if (!$m->checkToFarmListPermissions($row['kid'], Session::getInstance()->hasProtection())) {
                continue;
            }
            if (Session::getInstance()->hasProtection() && !$m->isNatarOrUnOccupiedOasis($row['kid'])) {
                continue;
            }
            $units = $m->getVillageUnits($list['kid']);
            $unitsToSend = array_fill(1, 11, 0);
            for ($i = 1; $i <= 10; ++$i) {
                $v = $row['u' . $i];
                if ($units['u' . $i] < $v) {
                    $canRaid = FALSE;
                    break;
                }
            }
            if (!$canRaid) {
                continue;
            }
            for ($i = 1; $i <= 10; ++$i) {
                $v = $row['u' . $i];
                if (!$v) {
                    continue;
                }
                $unitsToSend[$i] = $v;
                $units['u' . $i] -= $v;
                if (!isset($modified_units[$i])) {
                    $modified_units[$i] = 0;
                }
                $modified_units[$i] += $v;
                $speeds[] = Formulas::uSpeed(nrToUnitId($i, Session::getInstance()->getRace()));
            }
            if (array_sum($modified_units)) {
                if (!$m->modifyUnits($list['kid'], $modified_units)) continue;
            }
            $sentCount++;
            $speedCalculate->setTo($row['kid']);
            $speedCalculate->setMinSpeed($speeds);
            $move->addMovement($list['kid'],
                $row['kid'],
                Session::getInstance()->getRace(),
                $unitsToSend,
                0,
                0,
                0,
                0,
                0,
                MovementsModel::ATTACKTYPE_RAID,
                miliseconds(),
                miliseconds() + $speedCalculate->calc() * 1000);
        }
        if ($sentCount > 0) {
            $m->setLastRaid($list['id'], $list['owner'], $list['kid'], time());
        }
        $this->response['data']['html'] = sprintf(T("FarmList", "nRaidsMade"), $sentCount);
        return;
    }

    private function checkReportState($kid)
    {
        $m = new FarmListModel();
        $report = $m->getLastReport(Session::getInstance()->getPlayerId(), $kid);
        if ($report == FALSE) return 0;
        switch ($report['type']) {
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
                return 2;
                break;
            case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
                return 3;
                break;
            case NoticeHelper::TYPE_LOST_AS_ATTACKER:
                return 4;
                break;
        }
        return 0;
    }
}