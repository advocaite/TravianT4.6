<?php

namespace Game\Buildings;

use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use Model\ArtefactsModel;
use Model\WonderOfTheWorldModel;
use function getCustom;

class BuildingHelper
{
    // @return:
    //  1: can be build
    //  0: available soon
    // -1: can not be build
    public function canCreateNewBuild($capital, $tribe, $item_id, $buildings, $isMaster = FALSE)
    {
        $buildingMetaData = Formulas::$data['buildings'];
        if (!isset($buildingMetaData[$item_id - 1])) {
            return -1;
        }
        $buildMetadata = $buildingMetaData[$item_id - 1];
        //capital and non capital
        if (isset($buildMetadata['req']['capital'])) {
            if ($buildMetadata['req']['capital'] == -1 && $capital) {
                return -1;
            } else if ($buildMetadata['req']['capital'] == 1 && !$capital) {
                return -1;
            }
        }
        if (isset($buildMetadata['req']['race'])) {
            if ($tribe <> $buildMetadata['req']['race'] && !($item_id == 31 && $tribe == 5)) {
                return -1;
            }
        }
        // check for support multiple
        $alreadyBuilt = FALSE;
        $alreadyBuiltWithMaxLevel = FALSE;
        foreach ($buildings as $villageBuild) {
            $villageBuild['item_id'] = (int)$villageBuild['item_id'];
            $villageBuild['level'] = (int)$villageBuild['level'];
            if ($villageBuild['item_id'] == $item_id) {
                $alreadyBuilt = $isMaster ? $villageBuild['level'] > 0 : TRUE;
                if ($villageBuild['level'] == Formulas::buildingMaxLvl($item_id, $capital)) {
                    $alreadyBuiltWithMaxLevel = TRUE;
                    break;
                }
            }
        }
        if ($alreadyBuilt) {
            $multi = FALSE;
            if (isset($buildMetadata['req']) && isset($buildMetadata['req']['multi'])) {
                $multi = $buildMetadata['req']['multi'] == 'true';
            }
            if (!$multi) {
                return -1;
            } else {
                if (!$alreadyBuiltWithMaxLevel) {
                    return -1;
                }
                if ($item_id == 36 && Config::getProperty("game", "maxTrapperCount") > 0) {
                    $count = 0;
                    foreach ($buildings as $villageBuild) {
                        if ($villageBuild['item_id'] == $item_id) {
                            $count++;
                        }
                    }
                    if ($count >= Config::getProperty("game", "maxTrapperCount")) {
                        return -1;
                    }
                }
            }
        }
        if (isset($buildMetadata['breq'])) {
            // check for none pre-request
            foreach ($buildMetadata['breq'] as $req_item_id => $level) {
                if ($level == -1) {
                    foreach ($buildings as $villageBuild) {
                        $villageBuild['item_id'] = (int)$villageBuild['item_id'];
                        if ($villageBuild['item_id'] == $req_item_id) {
                            return -1;
                        }
                    }
                }
            }
            // check for pre-request
            foreach ($buildMetadata['breq'] as $req_item_id => $level) {
                if ($level == -1) {
                    continue;
                }
                $result = FALSE;
                foreach ($buildings as $villageBuild) {
                    if (($villageBuild['item_id'] == $req_item_id && $villageBuild['level'] >= $level) || $req_item_id == 40) {
                        $result = TRUE;
                        break;
                    }
                }
                if (!$result) {
                    return 0;
                }
            }
        }

        return 1;
    }

    // @return:
    // 0: no dependencies needed
    // 1: need to increase crop production
    // 2: need to increase warehouse level
    // 22: create warehouse
    // 3: need to increase granny level
    // 33: create granny
    //crop production contains free crop! (CROP + $upkeep - $cropLoading - $cropLoadingMaster)
    public function checkDependencies($item_id, $level, $natar, $cropProduction, $maxstore, $maxcrop)
    {
        $natar ? true : false;
        $resRequiredPop = Formulas::buildingCropConsumption($item_id, $level);
        //ignore WW here.
        if (getGame("starvation")) {
            if (($cropProduction - $resRequiredPop) <= 0 && $item_id <> 4) {
                return 1;
            }
        }
        $costs = Formulas::buildingUpgradeCosts($item_id, $level);
        if ($costs[0] > $maxstore || $costs[1] > $maxstore || $costs[2] > $maxstore) {
            if ($maxstore <= Formulas::storeCAP(0)) {
                return 22;
            }
            return 2;
        }
        if ($costs[3] > $maxcrop) {
            if ($maxcrop <= Formulas::storeCAP(0)) {
                return 33;
            }

            return 3;
        }

        return 0;
    }
    // @return:
    // 0: nothing needed
    // 1: Great Warehouse Artifact Needed
    // 2: WW Building Plan 1 Needed
    // 3: WW Building Plan 2 Needed (in Alliance)
    public function checkArtifactDependencies($aid, $uid, $kid, $item_id, $isWW, $wwLevel)
    {
        if($uid == 1){
            return 0;
        }
        if ($item_id == 38 || $item_id == 39) {
            //check great ware house plan
            //artifact type 9 is for Great Warehouse or Granny
            if (!$isWW && ArtefactsModel::getArtifactEffectByType($uid, $kid, ArtefactsModel::ARTIFACT_GREAT_STORE) <= 0) {
                return 1;
            }
        } //great warehouse
        if ($item_id == 40) {
            $m = new WonderOfTheWorldModel();
            if (getCustom("wwPlansEnabled")) {
                $artEffBP = $this->checkIfPlayerHasWWBuildingPlan($uid);
                if (!$artEffBP) return 2;
                if (Config::getProperty("custom", "needAllianceWWPlan")) {
                    $wwLevel = (int)$wwLevel;
                    if ($wwLevel >= 50) {
                        $artEffAllyBP = $aid == 0 ? FALSE : $this->checkIfPlayerAllianceHasWWBuildingPlan($aid, $uid);
                        if ($artEffAllyBP <= 0) {
                            return 3;
                        }
                    }
                }
                return 0;
            } else {
                return ArtefactsModel::wwPlansReleased() ? 0 : 2;
            }
        } // WW
        return 0;
    }

    public function checkIfPlayerHasWWBuildingPlan($uid)
    {
        $db = DB::getInstance();
        return 0 < $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE uid=$uid AND active=1 AND type=12 LIMIT 1");
    }

    //or maybe conf alliances :|
    public function checkIfPlayerAllianceHasWWBuildingPlan($aid, $uid)
    {
        if (!$aid) {
            return FALSE;
        }
        $db = DB::getInstance();
        $diplos = $db->query("SELECT aid1, aid2 FROM diplomacy WHERE (aid1=$aid OR aid2=$aid) AND accepted<>0");
        $al = [];
        $al[] = $aid;
        while ($row = $diplos->fetch_assoc()) {
            $al[] = $row['aid1'];
            $al[] = $row['aid2'];
        }
        $members = [];
        $aidArray = implode(",", array_unique($al));
        $find = $db->query("SELECT id FROM users WHERE aid IN ($aidArray) AND id <> $uid");
        while ($row = $find->fetch_assoc()) {
            $members[] = $row['id'];
        }
        if (!sizeof($members)) {
            return FALSE;
        }
        $members = implode(",", $members);
        return 0 < $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE uid IN($members) AND type=12 AND active=1 LIMIT 1");
    }


    public function hasPalaceAnywhere($uid)
    {
        $db = DB::getInstance();
        $fields = $db->query("SELECT f.* FROM fdata f, vdata v WHERE f.kid=v.kid AND v.owner=$uid");
        while ($row = $fields->fetch_assoc()) {
            for ($i = 19; $i <= 38; ++$i) {
                if ($row['f' . $i . 't'] == 26) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    public function checkWarehouseDependencies($max_warehouse, $max_granny, $cost)
    {
        if ($cost[0] > $max_warehouse || $cost[1] > $max_warehouse || $cost[2] > $max_warehouse) {
            if ($max_warehouse <= Formulas::storeCAP(0))
                return 22;
            return 2;
        }
        if ($cost[3] > $max_granny) {
            if ($max_granny <= Formulas::storeCAP(0))
                return 33;
            return 3;
        }
        return 0;
    }
}