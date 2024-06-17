<?php

use Controller\Build\TreasuryCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Game\Buildings\BuildingAction;
use Game\ResourcesHelper;
use Model\AccountDeleter;
use Model\ArtefactsModel;
use Model\VillageModel;
use resources\View\PHPBatchView;

class EditVillageCtrl
{
    private $db;

    public function __construct()
    {
        if (!isset($_REQUEST['kid'])) return;
        set_time_limit(0);
        ignore_user_abort(true);
        $this->db = DB::getInstance();
        $dispatcher = Dispatcher::getInstance();
        $kid = (int)$_REQUEST['kid'];
        ResourcesHelper::updateVillageResources($kid);
        $villageData = $this->db->query("SELECT * FROM vdata WHERE kid=$kid");
        if (!$villageData->num_rows) {
            $dispatcher->appendContent("<hr><p class='error center'>Village does not exists!</p><hr>");
            return;
        }
        $villageData = $villageData->fetch_assoc();
        if (isset($_GET['r'])) {
            switch ($_GET['r']) {
                case 'fillResources':
                    if (getCustom('allowInterruptionInGame')) {
                        $this->db->query("UPDATE vdata SET wood=maxstore, clay=maxstore, iron=maxstore, crop=maxcrop WHERE kid=$kid");
                        WebService::redirect("admin.php?action=editVillage&kid=$kid");
                    } else {
                        $dispatcher->appendContent("<hr><p class='error center'>Access denied.</p><hr>");
                    }
                    return;
                    break;
                case 'arriveOwnMovements':
                    if (getCustom('allowInterruptionInGame')) {
                        $this->db->query("UPDATE movement SET end_time=" . miliseconds() . " WHERE (kid=$kid) OR (to_kid=$kid AND mode=1)");
                        WebService::redirect("admin.php?action=editVillage&kid=$kid");
                    } else {
                        $dispatcher->appendContent("<hr><p class='error center'>Access denied.</p><hr>");
                    }
                    return;
                    break;
                case 'deleteVillage':
                    if(IS_DEV){
                        if (getCustom('allowInterruptionInGame')) {
                            $m = new AccountDeleter();
                            if (true === $m->isVillageDestroyAble(1, $villageData['kid'], $villageData['owner'])) {
                                $m->deleteVillage((int)$_REQUEST['kid']);
                                WebService::redirect("admin.php?action=editPlayer&uid={$villageData['owner']}");
                            }
                        } else {
                            $dispatcher->appendContent("<hr><p class='error center'>Access denied.</p><hr>");
                        }
                    }
                    break;
            }
        }
        if (!isServerFinished() && WebService::isPost() && Session::validateChecker()) {
            if(getCustom('allowInterruptionInGame')){
                $resources = [
                    $this->absVal($_POST['r1']),
                    $this->absVal($_POST['r2']),
                    $this->absVal($_POST['r3']),
                    $this->absVal($_POST['r4']),
                ];
                $lastResources = explode(",", $_POST['lastResources']);
                $modify_resources = [0, 0, 0, 0];
                for ($i = 0; $i <= 3; $i++) {
                    $modify_resources[$i] = $resources[$i] - $lastResources[$i];
                }
                $vname = $this->db->real_escape_string(empty($_POST['villageName']) ? $villageData['name'] : filter_var($_POST['villageName']));
                $this->db->query("UPDATE vdata SET name='{$vname}', wood=wood+{$modify_resources[0]}, clay=clay+{$modify_resources[1]}, iron=iron+{$modify_resources[2]}, crop=crop+{$modify_resources[3]} WHERE kid=$kid");
            }
            $newTroops = [];
            $troops = $this->getWholeVillageTroops($kid);
            $currentTroops = array_fill(1, 11, 0);
            for ($i = 1; $i <= 10; ++$i) {
                if (!isset($_POST['u' . $i])) {
                    $currentTroops[$i] = $troops['total'][$i];
                    continue;
                }
                $currentTroops[$i] = $this->absVal((int)$_POST['oldTroops'][$i]);
            }
            for ($i = 1; $i <= 11; ++$i) {
                if ($i == 11 || !isset($_POST['u' . $i])) {
                    $newTroops[$i] = $currentTroops[$i];
                    continue;
                }
                $newTroops[$i] = $this->absVal($_POST['u' . $i]);
            }
            $diff = array_sum($newTroops) <> array_sum($currentTroops);
            if ($diff && !getCustom('allowInterruptionInGame')) {
                $dispatcher->appendContent("<hr><p class='error center'>Access denied.</p><hr>");
                return;
            } else if ($diff) {
                for ($i = 1; $i <= 10; ++$i) {
                    if ($newTroops[$i] > $currentTroops[$i]) {
                        $diff = $newTroops[$i] - $currentTroops[$i];
                        $this->db->query("UPDATE units SET u{$i}=u{$i}+$diff WHERE kid=$kid");
                    } else if ($newTroops[$i] < $currentTroops[$i]) {
                        //loop though whole system
                        $failed = false;
                        $this->db->mysqli->begin_transaction();
                        $diff = $currentTroops[$i] - $newTroops[$i];
                        $units = $this->db->query("SELECT kid, u{$i} FROM units WHERE kid=$kid AND u{$i} > 0");
                        while ($row = $units->fetch_assoc()) {
                            $count = min($row['u' . $i], $diff);
                            $query = $this->db->query("UPDATE units SET u{$i}=u{$i}-$count WHERE kid={$row['kid']}");
                            if ($query && $this->db->affectedRows()) {
                                $diff -= $count;
                            } else {
                                $failed = true;
                                break;
                            }
                            if ($diff <= 0) break;
                        }
                        if ($diff > 0 && !$failed) {
                            $enforcements = $this->db->query("SELECT * FROM enforcement WHERE kid=$kid AND u{$i} > 0");
                            while ($row = $enforcements->fetch_assoc()) {
                                $troops_in_row = array_filter_units($row);
                                $count = min($row['u' . $i], $diff);
                                $query = $this->db->query("UPDATE enforcement SET u{$i}=u{$i}-$count WHERE id={$row['id']}");
                                if ($query && $this->db->affectedRows()) {
                                    $diff -= $count;
                                    $troops_in_row[$i] -= $count;
                                    if (array_sum($troops_in_row) <= 0) {
                                        $this->db->query("DELETE FROM enforcement WHERE id={$row['id']}");
                                    }
                                } else {
                                    $failed = true;
                                    break;
                                }
                                if ($diff <= 0) break;
                            }
                        }
                        if ($diff > 0 && !$failed) {
                            $trapped = $this->db->query("SELECT * FROM trapped WHERE kid=$kid AND u{$i} > 0");
                            while ($row = $trapped->fetch_assoc()) {
                                $count = min($row['u' . $i], $diff);
                                $troops_in_row = array_filter_units($row);
                                $query = $this->db->query("UPDATE trapped SET u{$i}=u{$i}-$count WHERE id={$row['id']}");
                                if ($query && $this->db->affectedRows()) {
                                    $diff -= $count;
                                    $troops_in_row[$i] -= $count;
                                    if (array_sum($troops_in_row) <= 0) {
                                        $this->db->query("DELETE FROM trapped WHERE id={$row['id']}");
                                    }
                                } else {
                                    $failed = true;
                                    break;
                                }
                                if ($diff <= 0) break;
                            }
                        }
                        if ($diff > 0 && !$failed) {
                            $movements = $this->db->query("SELECT * FROM movement WHERE ((kid=$kid AND mode=0) OR (to_kid=$kid AND mode=1)) AND u{$i} > 0");
                            while ($row = $movements->fetch_assoc()) {
                                $count = min($row['u' . $i], $diff);
                                $troops_in_row = array_filter_units($row);
                                $query = $this->db->query("UPDATE movement SET u{$i}=u{$i}-$count WHERE id={$row['id']}");
                                if ($query && $this->db->affectedRows()) {
                                    $diff -= $count;
                                    $troops_in_row[$i] -= $count;
                                    if (array_sum($troops_in_row) <= 0) {
                                        $this->db->query("DELETE FROM movement WHERE id={$row['id']}");
                                    }
                                } else {
                                    $failed = true;
                                    break;
                                }
                                if ($diff <= 0) break;
                            }
                        }
                        if (!$failed && $diff == 0) {
                            $this->db->mysqli->commit();
                        } else {
                            $this->db->mysqli->rollback();
                        }

                    }
                }
            }
            $smithy = $this->getSmithy($kid);
            for ($i = 1; $i <= 8; ++$i) {
                if (isset($_POST['ul' . $i]) && $_POST['ul' . $i] >= 0) {
                    $smithy['u' . $i] = min((int)$_POST['ul' . $i], 20);
                }
            }
            $db = DB::getInstance();
            $db->query("UPDATE smithy SET 
                                u1={$smithy['u1']}, u2={$smithy['u2']}, u3={$smithy['u3']}, u4={$smithy['u4']}, 
                                u5={$smithy['u5']}, u6={$smithy['u6']}, u7={$smithy['u7']}, u8={$smithy['u8']} WHERE kid=$kid");
            ResourcesHelper::updateVillageUpkeep($villageData['owner'], $kid, $villageData['isWW'] == 1);
            $villageData = $this->db->query("SELECT * FROM vdata WHERE kid=$kid");
            $villageData = $villageData->fetch_assoc();
            AdminLog::getInstance()->addLog("Edited a village({$kid}).");
        }
        $params['kid'] = $kid;
        $params['villageName'] = $villageData['name'];
        $params['cp'] = $villageData['cp'];
        $params['owner'] = $villageData['owner'];
        $params['lastResources'] = implode(",", [$villageData['wood'], $villageData['clay'], $villageData['iron'], $villageData['crop']]);
        $params['ownerName'] = $this->db->fetchScalar("SELECT name FROM users WHERE id={$villageData['owner']}");
        $params['pop'] = $villageData['pop'];
        $params['troops'] = null;
        $params['resources'] = null;
        $troops = $this->getWholeVillageTroops($kid);
        $smithy = $this->getSmithy($kid);
        $params['troopsArray'] = $troops['total'];
        for ($i = 1; $i <= 10; ++$i) {
            $unitId = nrToUnitId($i, $troops['race']);
            $params['troops'] .= '<tr>';
            $params['troops'] .= '<td><img class="unit u' . $unitId . '" src="img/x.gif"> ' . T("Troops",
                    "$unitId.title") . '</td>';
            $params['troops'] .= '<td><input class="addTroops" name="u' . $i . '" id="u' . $i . '" value="' . $troops['total'][$i] . '" maxlength="10"></td>';
            if ($i > 8) {
                $params['troops'] .= '<td></td>';
            } else {
                $params['troops'] .= '<td><input class="addTroops" name="ul' . $i . '" id="ul' . $i . '" value="' . $smithy['u' . $i] . '" maxlength="10"></td>';
            }
            $params['troops'] .= '</tr>';
        }
        for ($i = 1; $i <= 4; ++$i) {
            $params['resources'] .= '<tr>';
            $params['resources'] .= '<td><img src="img/admin/r/' . $i . '.gif"> ' . ['Lumber', 'Clay', 'Iron', 'Clay'][$i - 1] . '</td>';
            $params['resources'] .= '<td><input class="addTroops" name="r' . $i . '" id="r' . $i . '" value="' . floor($villageData[['wood', 'clay', 'iron', 'crop'][$i - 1]]) . '" maxlength="10"></td>';
            $params['resources'] .= '</tr>';
        }
        $params['artifacts'] = $params['trainings'] = $params['researches'] = $params['buildings'] = $params['demolishes'] = $params['celebrations'] = null;
        $db = DB::getInstance();
        if (isset($_REQUEST['deleteTraining']) && getCustom('allowInterruptionInGame')) {
            //delete Training
            $id = (int)$_REQUEST['deleteTraining'];
            $db->query("DELETE FROM training WHERE id=$id AND kid=$kid");
        } else if (isset($_REQUEST['finishTraining']) && getCustom('allowInterruptionInGame')) {
            //delete Training
            $id = (int)$_REQUEST['finishTraining'];
            $db->query("UPDATE training SET commence=0, end_time=0 WHERE id=$id AND kid=$kid");
        }
        $artModel = new ArtefactsModel();
        if (isset($_REQUEST['releaseArtifact'])) {
            $id = (int)$_REQUEST['releaseArtifact'];
            $row = $artModel->getArtefactDetails($id);
            if ($row) $artModel->clearArtifactFromVillage($row);
        } else if (isset($_REQUEST['activateArtifact']) && getCustom('allowInterruptionInGame')) {
            $id = (int)$_REQUEST['activateArtifact'];
            $row = $artModel->getArtefactDetails($id);
            if ($row) $artModel->activateArtifact($row);
        } else if (isset($_REQUEST['updateFoolArt']) && getCustom('allowInterruptionInGame')) {
            $artModel->updateFoolArtifact((int)$_REQUEST['updateFoolArt']);
        }
        $artifacts = $db->query("SELECT * FROM artefacts WHERE kid=$kid");
        while ($row = $artifacts->fetch_assoc()) {
            $params['artifacts'] .= '<tr>';
            $params['artifacts'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&releaseArtifact=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['artifacts'] .= '<td>' . TreasuryCtrl::getArtifactName($row['type'], $row['size'], $row['num']) . '</td>';
            $params['artifacts'] .= '<td>' . TimezoneHelper::autoDateString($row['conquered'], TRUE) . '</td>';
            if ($row['active']) {
                $params['artifacts'] .= '<td>Active</td>';
                $params['artifacts'] .= '<td>';
                if($row['type'] == ArtefactsModel::ART_FOOL){
                    $params['artifacts'] .= '<a href="?action=editVillage&kid=' . $kid . '&updateFoolArt=' . $row['id'] . '"  onclick="return confirmAction();">» Update effect</a>';
                }
                $params['artifacts'] .= '</td>';
            } else {
                $params['artifacts'] .= '<td>' . TimezoneHelper::autoDateString($row['conquered'] + ArtefactsModel::getArtifactActivationTime(), TRUE) . '</td>';
                $params['artifacts'] .= '<td>';
                $params['artifacts'] .= '<a href="?action=editVillage&kid=' . $kid . '&activateArtifact=' . $row['id'] . '"  onclick="return confirmAction();">» Activate</a>';
                if($row['type'] == ArtefactsModel::ART_FOOL){
                    $params['artifacts'] .= ' | <a href="?action=editVillage&kid=' . $kid . '&updateFoolArt=' . $row['id'] . '"  onclick="return confirmAction();">» Update effect</a>';
                }
                $params['artifacts'] .= '</td>';
            }
            $params['artifacts'] .= '</tr>';
        }
        if (is_null($params['artifacts'])) {
            $params['artifacts'] .= '<tr><td colspan="5" class="noData">No artifacts.</td></tr>';
        }
        $trainings = $db->query("SELECT * FROM training WHERE kid=$kid ORDER BY end_time ASC");
        $rate = 1;
        $now = time();
        if (Config::getInstance()->game->useNanoseconds) {
            $rate = 1e9;
            $now = nanoseconds();
        } else if (Config::getInstance()->game->useMilSeconds) {
            $rate = 1e3;
            $now = miliseconds();
        }

        while ($row = $trainings->fetch_assoc()) {
            $unitId = nrToUnitId($row['nr'], $troops['race']);
            $params['trainings'] .= '<tr>';
            $params['trainings'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&deleteTraining=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['trainings'] .= '<td><img  class="unit u' . $unitId . '" src="img/x.gif"> ' . T("Troops", "$unitId.title") . '</td>';
            $params['trainings'] .= '<td style="' . (getDisplay("smallTroopsNumFontSize") ? 'font-size: 11px;' : '') . '">' . number_format_x($row['num']) . '</td>';
            $params['trainings'] .= '<td>' . secondsToString($row['end_time'] - $now, TRUE) . '</td>';
            $params['trainings'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishTraining=' . $row['id'] . '" onclick="return confirmAction();">Finish</a></td>';
            $params['trainings'] .= '</tr>';
        }
        if (is_null($params['trainings'])) {
            $params['trainings'] .= '<tr><td colspan="5" class="noData">No training.</td></tr>';
        }
        if (isset($_REQUEST['deleteResearch'])) {
            //delete Training
            $id = (int)$_REQUEST['deleteResearch'];
            $db->query("DELETE FROM research WHERE id=$id AND kid=$kid");
        } else if (isset($_REQUEST['finishResearch'])) {
            //delete Training
            $id = (int)$_REQUEST['finishResearch'];
            $db->query("UPDATE research SET end_time=0 WHERE id=$id AND kid=$kid");
        }
        $researches = $db->query("SELECT * FROM research WHERE kid=$kid ORDER BY end_time ASC");
        while ($row = $researches->fetch_assoc()) {
            $unitId = nrToUnitId($row['nr'], $troops['race']);
            $params['researches'] .= '<tr>';
            $params['researches'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&deleteResearch=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['researches'] .= '<td><img src="img/un/u/' . $unitId . '.gif"> ' . T("Troops",
                    "$unitId.title") . '</td>';
            $params['researches'] .= '<td>' . TimezoneHelper::autoDateString($row['end_time'], TRUE) . '</td>';
            $params['researches'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishResearch=' . $row['id'] . '" onclick="return confirmAction();">Finish</a></td>';
            $params['researches'] .= '</tr>';
        }
        if (is_null($params['researches'])) {
            $params['researches'] .= '<tr><td colspan="5" class="noData">No research.</td></tr>';
        }

        $village_buildings = (new VillageModel())->getBuildingsAssoc($kid);

        if (isset($_REQUEST['deleteBuilding'])) {
            //delete Training
            $id = (int)$_REQUEST['deleteBuilding'];
            $db->query("DELETE FROM building_upgrade WHERE id=$id AND kid=$kid");
            BuildingAction::fixUnUpgradedBuildings($kid);
        } else if (isset($_REQUEST['finishBuilding'])) {
            //delete Training
            $id = (int)$_REQUEST['finishBuilding'];
            $db->query("UPDATE building_upgrade SET commence=0 WHERE id=$id AND kid=$kid");
        }
        $buildings = $db->query("SELECT * FROM building_upgrade WHERE kid=$kid AND isMaster=0 ORDER BY commence ASC");
        while ($row = $buildings->fetch_assoc()) {
            $item_id = $village_buildings[$row['building_field']]['item_id'];
            $params['buildings'] .= '<tr>';
            $params['buildings'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&deleteBuilding=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';

            $params['buildings'] .= '<td>' . T("Buildings", "$item_id.title") . '</td>';

            $params['buildings'] .= '<td>' . TimezoneHelper::autoDateString($row['commence'], TRUE) . '</td>';
            $params['buildings'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishBuilding=' . $row['id'] . '" onclick="return confirmAction();">Finish</a></td>';
            $params['buildings'] .= '</tr>';
        }
        if (is_null($params['buildings'])) {
            $params['buildings'] .= '<tr><td colspan="5" class="noData">No building in queue.</td></tr>';
        }

        if (isset($_REQUEST['deleteDemolish'])) {
            //delete Training
            $id = (int)$_REQUEST['deleteDemolish'];
            $db->query("DELETE FROM demolition WHERE id=$id AND kid=$kid");
        } else if (isset($_REQUEST['finishDemolish'])) {
            //delete Training
            $id = (int)$_REQUEST['finishDemolish'];
            $db->query("UPDATE demolition SET end_time=0 WHERE id=$id AND kid=$kid");
        }
        $buildings = $db->query("SELECT * FROM demolition WHERE kid=$kid ORDER BY end_time ASC");
        while ($row = $buildings->fetch_assoc()) {
            $item_id = $village_buildings[$row['building_field']]['item_id'];
            $params['demolishes'] .= '<tr>';
            $params['demolishes'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&deleteDemolish=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';

            $params['demolishes'] .= '<td>' . T("Buildings", "$item_id.title") . '</td>';

            $params['demolishes'] .= '<td>' . TimezoneHelper::autoDateString($row['end_time'], TRUE) . '</td>';
            $params['demolishes'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishDemolish=' . $row['id'] . '" onclick="return confirmAction();">Finish</a></td>';
            $params['demolishes'] .= '</tr>';
        }
        if (is_null($params['demolishes'])) {
            $params['demolishes'] .= '<tr><td colspan="5" class="noData">No demolishes.</td></tr>';
        }
        if ($villageData['festival'] > time() && isset($_REQUEST['finishFestival'])) {
            $db->query("UPDATE vdata SET festival=0 WHERE kid=$kid");
            $villageData['festival'] = 0;
        }
        if ($villageData['festival'] > time()) {
            $params['celebrations'] .= '<tr>';
            $params['celebrations'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishFestival=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['celebrations'] .= '<td>Festival</td>';
            $params['celebrations'] .= '<td>' . TimezoneHelper::autoDateString($villageData['festival'],
                    TRUE) . '</td>';
            $params['celebrations'] .= '</tr>';
        }

        if ($villageData['celebration'] > time() && isset($_REQUEST['finishCelebration'])) {
            $db->query("UPDATE vdata SET celebration=0 WHERE kid=$kid");
            $villageData['celebration'] = 0;
        }

        if ($villageData['celebration'] > time()) {
            $params['celebrations'] .= '<tr>';
            $params['celebrations'] .= '<td><a href="?action=editVillage&kid=' . $kid . '&finishCelebration=' . $row['id'] . '"  onclick="return confirmAction();"><img src="img/x.gif" class="del" title="delete"></a></td>';
            $params['celebrations'] .= '<td>Celebration ' . ($villageData['type'] == 1 ? 'small' : 'big') . '</td>';
            $params['celebrations'] .= '<td>' . TimezoneHelper::autoDateString($villageData['celebration'], TRUE) . '</td>';
            $params['celebrations'] .= '</tr>';
        }
        if (is_null($params['celebrations'])) {
            $params['celebrations'] .= '<tr><td colspan="3" class="noData">No celebration or festival.</td></tr>';
        }

        $output = PHPBatchView::render('admin/editVillage', $params);
        $dispatcher->appendContent($output);
    }

    private function absVal($i)
    {
        return (int)max(0, $i);
    }

    public function getWholeVillageTroops($kid)
    {
        $db = DB::getInstance();
        $units = $db->query("SELECT * FROM units WHERE kid=$kid")->fetch_assoc();
        $result = [
            'race'           => $units['race'],
            'inVillage'      => array_filter_units($units),
            'outEnforcement' => array_filter_units($db->query("SELECT SUM(u1) as `u1`, SUM(u2) as `u2`, SUM(u3) as `u3`, SUM(u4) as `u4`, SUM(u5) as `u5`, SUM(u6) as `u6`, SUM(u7) as `u7`, SUM(u8) as `u8`, SUM(u9) as `u9`, SUM(u10) as `u10`, SUM(u11) as `u11` FROM enforcement WHERE kid=$kid")->fetch_assoc()),
            'outTrapped'     => array_filter_units($db->query("SELECT SUM(u1) as `u1`, SUM(u2) as `u2`, SUM(u3) as `u3`, SUM(u4) as `u4`, SUM(u5) as `u5`, SUM(u6) as `u6`, SUM(u7) as `u7`, SUM(u8) as `u8`, SUM(u9) as `u9`, SUM(u10) as `u10`, SUM(u11) as `u11` FROM trapped WHERE kid=$kid")->fetch_assoc()),
            'outMovement'    => array_filter_units($db->query("SELECT SUM(u1) as `u1`, SUM(u2) as `u2`, SUM(u3) as `u3`, SUM(u4) as `u4`, SUM(u5) as `u5`, SUM(u6) as `u6`, SUM(u7) as `u7`, SUM(u8) as `u8`, SUM(u9) as `u9`, SUM(u10) as `u10`, SUM(u11) as `u11` FROM movement WHERE (kid=$kid AND mode=0) OR (to_kid=$kid AND mode=1)")->fetch_assoc()),
        ];
        $result['total'] = array_fill(1, 11, 0);
        foreach ($result['inVillage'] as $index => $num) {
            $result['total'][$index] += $num;
        }
        foreach ($result['outEnforcement'] as $index => $num) {
            $result['total'][$index] += $num;
        }
        foreach ($result['outTrapped'] as $index => $num) {
            $result['total'][$index] += $num;
        }
        foreach ($result['outMovement'] as $index => $num) {
            $result['total'][$index] += $num;
        }
        return $result;
    }

    private function getSmithy($kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM smithy WHERE kid=$kid")->fetch_assoc();
    }
}