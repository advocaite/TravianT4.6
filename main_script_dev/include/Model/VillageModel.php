<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\Map\Map;
use Game\ResourcesHelper;
use Game\Starvation;
use function is_numeric;

class VillageModel
{
    public static function calculateVillageCulturePointsAndPopulation($kid, $isWW = null)
    {
        $buildings = (new self())->getBuildingsAssoc($kid);
        $db = DB::getInstance();
        if (is_null($isWW)) {
            $isWW = (int)$db->fetchScalar("SELECT isWW FROM vdata WHERE kid=$kid") == 1;
        }
        $total_cp = $total_pop = 0;
        foreach ($buildings as $index => $building) {
            $item_id = $building['item_id'];
            $level = $building['level'];
            if ($item_id == 0) continue;
            list($pop, $cp) = Formulas::buildingCpPop($item_id, 0, $level, $isWW || Formulas::isGrayArea($kid));
            $total_cp += $cp;
            $total_pop += $pop;
        }
        return [
            'cp' => $total_cp,
            'pop' => $total_pop,
        ];
    }

    public function punishPlayer($uid, $kid, $resources, $Troops, $punishResourcesBuildings, $punishBuildings)
    {
        $resources = min(abs($resources), 100);
        $Troops = min(abs($Troops), 100);
        $punishBuildings = min(abs($punishBuildings), 20);
        ignore_user_abort(TRUE);
        set_time_limit(600);
        $db = DB::getInstance();
        if ($resources) {
            if ($kid > 0) {
                $result = $db->query("SELECT kid FROM vdata WHERE owner=$uid AND kid=$kid");
            } else {
                $result = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
            }
            while ($row = $result->fetch_assoc()) {
                ResourcesHelper::updateVillageResources($row['kid']);
            }
            if ($kid > 0) {
                $result = $db->query("SELECT kid, wood, clay, iron, crop FROM vdata WHERE owner=$uid AND kid=$kid");
            } else {
                $result = $db->query("SELECT kid, wood, clay, iron, crop FROM vdata WHERE owner=$uid");
            }
            while ($row = $result->fetch_assoc()) {
                $wood = max($row['wood'] - ceil($row['wood'] * $resources / 100), 0);
                $clay = max($row['clay'] - ceil($row['clay'] * $resources / 100), 0);
                $iron = max($row['iron'] - ceil($row['iron'] * $resources / 100), 0);
                $crop = max($row['crop'] - ceil($row['crop'] * $resources / 100), 0);
                $db->query("UPDATE vdata SET wood=$wood, clay=$clay, iron=$iron, crop=$crop WHERE kid={$row['kid']}");
            }
        }
        if ($Troops) {
            //Starvation
            $result = $db->query("SELECT u.* FROM units u, vdata v WHERE u.kid=v.kid AND v.owner={$uid}");
            while ($row = $result->fetch_assoc()) {
                $modify = [];
                for ($i = 1; $i <= 10; ++$i) {
                    $num = $row['u' . $i] - ceil($row['u' . $i] * $Troops / 100);
                    $modify[] = "u{$i}=$num";
                }
                $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid={$row['kid']}");
                ResourcesHelper::updateVillageResources($row['kid'], FALSE);
            }
            $result = $db->query("SELECT e.* FROM enforcement e, vdata v WHERE e.kid=v.kid AND v.owner={$uid}");
            while ($row = $result->fetch_assoc()) {
                $modify = [];
                $total = $row['u11'];
                for ($i = 1; $i <= 10; ++$i) {
                    $num = $row['u' . $i] - ceil($row['u' . $i] * $Troops / 100);
                    $modify[] = "u{$i}=$num";
                    $total += $num;
                }
                if ($total) {
                    $db->query("UPDATE enforcement SET " . implode(",", $modify) . " WHERE id={$row['id']}");
                } else {
                    $db->query("DELETE FROM enforcement WHERE id={$row['id']}");
                }
                //TODO: update upkeep
            }
            $result = $db->query("SELECT t.* FROM trapped t, vdata v WHERE t.kid=v.kid AND v.owner={$uid}");
            while ($row = $result->fetch_assoc()) {
                $modify = [];
                $total = $row['u11'];
                for ($i = 1; $i <= 10; ++$i) {
                    $num = $row['u' . $i] - ceil($row['u' . $i] * $Troops / 100);
                    $modify[] = "u{$i}=$num";
                    $total += $num;
                }
                if ($total) {
                    $db->query("UPDATE trapped SET " . implode(",", $modify) . " WHERE id={$row['id']}");
                } else {
                    $db->query("DELETE FROM trapped WHERE id={$row['id']}");
                }
                //TODO: update upkeep
            }
        }
        if (($punishBuildings + $punishResourcesBuildings) > 0) {
            if ($kid > 0) {
                $result = $db->query("SELECT owner, kid, isWW, capital FROM vdata WHERE owner=$uid AND kid=$kid");
            } else {
                $result = $db->query("SELECT owner, kid, isWW, capital FROM vdata WHERE owner=$uid");
            }
            $accountDeleter = new AccountDeleter();
            while ($row = $result->fetch_assoc()) {
                $buildings = $this->getBuildingsAssoc($row['kid']);
                foreach ($buildings as $index => $build) {
                    $level = $index <= 18 ? $punishResourcesBuildings : $punishBuildings;
                    if ($level > 0 && $build['item_id'] && $build['level']) {
                        BuildingAction::downgrade($row['kid'], $index, $level);
                    }
                }
                $cpPop = self::calculateVillageCulturePointsAndPopulation($row['kid'], $row['isWW']);
                if ($cpPop['pop'] <= 0 && true === $accountDeleter->isVillageDestroyAble(0, $row['kid'], $row['owner'])) {
                    $accountDeleter->deleteVillage($row['kid']);
                } else {
                    ResourcesHelper::updateVillageResources($row['kid'], FALSE);
                }
            }
        }
        return true;
    }

    public static function getHDP($kid, $race = null)
    {
        if ($race !== null && $race <> 1)
            return 0;
        
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$kid}");
        if (!$buildings->num_rows) {
            return 0;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 41) {
                return $buildings['f' . $i];
            }
        }
        return 0;
    }

    public function getBuildingsAssoc($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid=$kid");
        if (!$buildings->num_rows) {
            logError("No buildings found in getBuildingsAssoc VillageModel for kid $kid");
            return [];
        }
        $buildings = $buildings->fetch_assoc();
        $assoc = [];
        for ($i = 1; $i <= 40; ++$i) {
            $assoc[$i] = [
                "item_id" => (int)$buildings['f' . $i . 't'],
                'level' => (int)$buildings['f' . $i],
            ];
        }
        $assoc[99] = [
            "item_id" => (int)$buildings['f99t'],
            'level' => (int)$buildings['f99'],
        ];
        return $assoc;
    }

    public function updateUserVillageResources($uid, $simple = true)
    {
        $uid = (int)$uid;
        $db = DB::getInstance();
        $stmt = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
        while ($row = $stmt->fetch_assoc()) {
            ResourcesHelper::updateVillageResources($row['kid'], $simple);
        }
    }

    public function getCapBrewery($uid)
    {
        $db = DB::getInstance();
        if ($uid == 1) return 0;
        $capVillage = $db->query("SELECT kid, festival FROM vdata WHERE owner=$uid AND capital=1");
        if (!$capVillage->num_rows) {
            return 0;
        }
        $capVillage = $capVillage->fetch_assoc();
        if (!($capVillage['festival'] > time())) {
            return 0;
        }
        $capWref = $capVillage['kid'];
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$capWref}");
        if (!$buildings->num_rows) {
            return 0;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 35) {
                return $buildings['f' . $i];
            }
        }
        return 0;
    }

    public function changeCapital($uid, $new_capital_kid)
    {
        $db = DB::getInstance();
        $capital_kid = $db->fetchScalar("SELECT kid FROM vdata WHERE owner=$uid AND capital=1");
        if(!$capital_kid){
            return false;
        }
        $buildings = $this->getBuildingsAssoc($new_capital_kid);
        for ($i = 19; $i <= 40; ++$i) {
            if (in_array($buildings[$i]['item_id'], [29, 30])) {
                BuildingAction::downgrade($new_capital_kid, $i, 0, true);
            }
        }
        ResourcesHelper::updateVillageResources($new_capital_kid, FALSE);
        $buildings = $this->getBuildingsAssoc($capital_kid);
        for ($i = 19; $i <= 40; ++$i) {
            if (in_array($buildings[$i]['item_id'], [34, 35])) {
                BuildingAction::downgrade($capital_kid, $i, 0, true);
            }
        }
        for ($i = 1; $i <= 18; ++$i) {
            if ($buildings[$i]['level'] > 10) {
                BuildingAction::downgrade($capital_kid, $i, $buildings[$i]['level'] - 10);
            }
        }
        $db->query("UPDATE vdata SET capital=0 WHERE kid=$capital_kid");
        $db->query("UPDATE vdata SET capital=1 WHERE kid=$new_capital_kid");
        ResourcesHelper::updateVillageResources($capital_kid, FALSE);
        ResourcesHelper::updateVillageResources($new_capital_kid, FALSE);
        Map::villageDestroyOrCaptureOrNewVillageUpdate($capital_kid);
        Map::villageDestroyOrCaptureOrNewVillageUpdate($new_capital_kid);
        $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1 WHERE id=$uid");
        return TRUE;
    }

    public function removeTribeSpecificBuildings($kid)
    {
        $buildings = $this->getBuildingsAssoc($kid);
        if (sizeof($buildings) == 0) {
            logError("No building. removeTribeSpecificBuildings");
            return;
        }
        $tribeSpecificArray = [31, 32, 33, 42, 43, 35, 36, 41, 44, 45];
        for ($i = 19; $i <= 40; ++$i) {
            if (isset($buildings[$i]['item_id']) && in_array($buildings[$i]['item_id'], $tribeSpecificArray)) {
                BuildingAction::downgrade($kid, $i, 0, true);
            }
        }
    }

    public function captureVillage($uid, $kid, $pop, $newUid, $newUidPop, $newRace, $expandedFrom)
    {
        $db = DB::getInstance();
        if(getCustom('removeVillageFromFarmListOnCapture')){
            $db->query("DELETE FROM raidlist WHERE kid=$kid");
        }
        $helper = new AccountDeleter();
        $db->query("UPDATE vdata SET evasion=0, loyalty=0, last_loyalty_update=" . time() . " WHERE kid=$kid");
        $db->query("DELETE FROM training WHERE kid=$kid");
        $db->query("DELETE FROM traderoutes WHERE (kid=$kid OR to_kid=$kid)");
        $db->query("DELETE FROM movement WHERE ((kid=$kid AND mode=0) OR (to_kid=$kid AND mode=1)) OR (race=4 AND to_kid={$kid})");
        $db->query("DELETE FROM enforcement WHERE kid=$kid");
        $db->query("DELETE FROM trapped WHERE kid=$kid");
        $db->query("DELETE FROM research WHERE kid=$kid");
        $db->query("DELETE FROM smithy WHERE kid=$kid");
        $db->query("DELETE FROM market WHERE kid=$kid");
        $db->query("DELETE FROM units WHERE kid=$kid");
        $db->query("DELETE FROM tdata WHERE kid=$kid");
        $db->query("DELETE FROM building_upgrade WHERE kid=$kid");
        $db->query("DELETE FROM demolition WHERE kid=$kid");
        $db->query("DELETE FROM send WHERE kid=$kid OR (to_kid=$kid AND mode=1)");
        $db->query("UPDATE odata SET owner=$newUid WHERE did=$kid");
        $farmLists = $db->query("SELECT id FROM farmlist WHERE kid=$kid");
        while ($list = $farmLists->fetch_assoc()) {
            $db->query("DELETE FROM raidlist WHERE lid={$list['id']}");
        }
        $db->query("DELETE FROM farmlist WHERE kid=$kid");
        $traps = $db->query("SELECT * FROM trapped WHERE to_kid=$kid");
        while ($trapped = $traps->fetch_assoc()) {
            $helper->returnTrappedOrEnforcementRow($trapped, FALSE);
        }
        //removing tribe specific buildings.
        $buildings = $this->getBuildingsAssoc($kid);
        if (sizeof($buildings) == 0) {
            logError("No building. while capture village");
        }
        $tribeSpecificArray = [31, 32, 33, 42, 43, 44, 45, 35, 36, 41];
        for ($i = 19; $i <= 40; ++$i) {
            if (!isset($buildings[$i])) {
                continue;
            }
            if (in_array($buildings[$i]['item_id'], $tribeSpecificArray)) {
                BuildingAction::downgrade($kid, $i, 0, true);
                $buildings[$i]['item_id'] = 0;
                $buildings[$i]['level'] = 0;
            }
        }
        if ($newUidPop > $pop) {
            foreach ($buildings as $index => $build) {
                if ($build['item_id'] && $build['level']) {
                    if ($build['item_id'] > 4 && ($build['level'] - 1) == 0) {
                        $build['item_id'] = 0;
                    }
                    $build['level']--;
                    BuildingAction::downgrade($kid, $index, 1);
                }
            }
        }
        BuildingAction::fixUnUpgradedBuildings($kid);
        $db->query("UPDATE hero SET health=0 WHERE kid=$kid");
        if ($db->affectedRows()) {
            $heroNewKid = $db->fetchScalar("SELECT kid FROM vdata WHERE capital=1 AND owner=$uid");
            $db->query("UPDATE hero SET kid=$heroNewKid WHERE kid=$kid");
        }
        $village = $db->query("SELECT maxstore, maxcrop, extraMaxstore, extraMaxcrop, pop, cp FROM vdata WHERE kid=$kid")->fetch_assoc();
        $maxstore = $village['maxstore'];
        $maxcrop = $village['maxcrop'];
        if ($village['extraMaxstore']) $maxstore -= $village['extraMaxstore'] * Formulas::storeCAP(20);
        if ($village['extraMaxcrop']) $maxcrop -= $village['extraMaxcrop'] * Formulas::storeCAP(20);
        $db->query("UPDATE users SET total_pop=total_pop-{$village['pop']}, cp_prod=cp_prod-{$village['cp']}, total_villages=total_villages-1 WHERE id=$uid");
        $db->query("UPDATE users SET total_pop=total_pop+{$village['pop']}, cp_prod=cp_prod+{$village['cp']}, total_villages=total_villages+1 WHERE id=$newUid");
        $db->query("UPDATE vdata SET isFarm=0, extraMaxstore=0, extraMaxcrop=0, maxstore=$maxstore, maxcrop=$maxcrop, owner=$newUid, expandedfrom=$expandedFrom WHERE kid=$kid");


        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
        if ($aid) {
            $db->query("UPDATE alidata SET week_pop_changes=week_pop_changes-{$village['pop']} WHERE id=$aid");
        }

        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$newUid");
        if ($aid) {
            $db->query("UPDATE alidata SET week_pop_changes=week_pop_changes+{$village['pop']} WHERE id=$aid");
        }


        $register = new RegisterModel();
        $register->addUnits($kid, $newRace);
        $register->addSmithy($kid);
        $register->addTech($kid);
        Map::villageDestroyOrCaptureOrNewVillageUpdate($kid);
        $find = $db->query("SELECT * FROM artefacts WHERE kid={$kid}");
        $m = new ArtefactsModel();
        while ($row = $find->fetch_assoc()) {
            $m->arteIsMine($row['id'], $row['kid'], $newUid);
        }
        //restoring village id to capital
        $user = $db->query("SELECT id FROM users WHERE kid=$kid");
        if ($user->num_rows) {
            $user = $user->fetch_assoc();
            $capital = $db->query("SELECT kid FROM vdata WHERE capital=1 AND owner={$user['id']}");
            if ($capital->num_rows) {
                $capital = $capital->fetch_assoc();
                $db->query("UPDATE users SET kid={$capital['kid']} WHERE id={$user['id']}");
            }
        }
        (new AccountDeleter())->rematchExpands($kid);
        $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1 WHERE id=$uid");
        $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1 WHERE id=$newUid");
        return TRUE;
    }

    public function removeUnavailableCapitalBuildings($owner, $kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid=$kid");
        if (!$buildings->num_rows) {
            return FALSE;
        }
        $buildings = $buildings->fetch_assoc();
        $tribeSpecificArray = [34, 29, 30, 35];
        for ($i = 19; $i <= 40; $i++) {
            if (in_array($buildings['f' . $i . 't'], $tribeSpecificArray)) {
                BuildingAction::downgrade($kid, $i, 0, true);
            }
        }
    }

    public static function getTournamentSquireLevel($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid=$kid")->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 14) {
                return (int)$buildings['f' . $i];
            }
        }
        return 0;
    }

    public static function getEmptyFields($kid)
    {
       return array_keys(
            array_filter($this->getBuildingsAssoc($kid), function($elem, $index){
               return $elem['item_id']===0 && $index >18 && $index < 39;
            },ARRAY_FILTER_USE_BOTH));
    }
}