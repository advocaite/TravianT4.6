<?php

namespace Game\Buildings;

use Core\Database\DB;
use Game\Formulas;
use Game\Helpers\CulturePointsHelper;
use Game\Helpers\LoyaltyHelper;
use Game\Map\Map;
use Game\ResourcesHelper;
use Model\AllianceModel;
use Model\AutomationModel;
use Model\DailyQuestModel;
use Model\MarketModel;
use Model\MasterBuilder;
use Model\SummaryModel;
use Model\VillageModel;
use Model\WonderOfTheWorldModel;
use function miliseconds;

class BuildingAction
{
    public static function upgrade($kid, $building_field, $levels = 1, $force = FALSE, $modifyPopCP = true)
    {
        $m = new AutomationModel();
        $master = new MasterBuilder();
        $db = DB::getInstance();
        list($item_id, $level) = self::getBuildingsByField($kid, $building_field);
        $item_id = (int)$item_id;
        $level = (int)$level;
        if (!$item_id) {
            return;
        }
        $villageRow = $m->getVillage($kid, 'kid, owner, isWW, pop, maxcrop, maxstore, extraMaxstore, extraMaxcrop, capital');
        if (!$villageRow) return;
        $isWW = $villageRow['isWW'] == 1;
        $maxLevel = Formulas::buildingMaxLvl($item_id, $villageRow['capital'] == 1);
        if (($level + $levels) > $maxLevel && !$force) {
            return;
        }
        if ($item_id == 25 || $item_id == 26) {
            LoyaltyHelper::updateVillageLoyalty($kid);
        }
        $dailyQuest = new DailyQuestModel();
        $dailyQuest->setQuestAsCompleted($villageRow['owner'], 6);
        if ($item_id <= 4) {
            $dailyQuest->setQuestAsCompleted($villageRow['owner'], 7);
        }
        list($pop, $cp) = Formulas::buildingCpPop($item_id, $level, $level + $levels, $isWW || Formulas::isGrayArea($kid));
        if ($modifyPopCP) {
            self::updateVillagePopCP($villageRow['owner'], $kid, $pop, $cp);
        }
        self::increaseFieldLevel($kid, $building_field, $levels);
        if($item_id == 37){
            $newLevel = $level + $levels;
            $db->query("UPDATE fdata SET heroMansion=$newLevel WHERE kid=$kid");
        } else if ($item_id == 18) {
            self::updateEmbassyLevel($kid, $level + $levels);
            $aid = $m->getUser($villageRow['owner'], 'aid')['aid'];
            if ($aid) {
                $max = Formulas::getEmbassyMembersCount($level + $levels);
                $db->query("UPDATE alidata SET max=IF(max>{$max}, max, {$max}) WHERE id=$aid");
            }
        } else if ($item_id == 10 || $item_id == 11 || $item_id == 38 || $item_id == 39) {
            $nextLevel = $level + $levels;
            $big = $item_id == 38 || $item_id == 39;
            $type = $item_id == 10 || $item_id == 38 ? 'maxstore' : 'maxcrop';
            $max = $villageRow[$type];
            $extraCapacity = $villageRow[$item_id == 10 || $item_id == 38 ? 'extraMaxstore' : 'extraMaxcrop'] * Formulas::storeCAP(20);
            $real_storage_capacity = $max - $extraCapacity;
            if ($nextLevel >= 1 && $real_storage_capacity == Formulas::storeCAP(0)) {
                $max -= Formulas::storeCAP(0);
            }
            if ($nextLevel > 1) {
                $max -= ($big ? Formulas::bigStoreCAP($level) : Formulas::storeCAP($level));
            }
            $max += ($big ? Formulas::bigStoreCAP($nextLevel) : Formulas::storeCAP($nextLevel));
            $db->query("UPDATE vdata SET {$type}=$max WHERE kid={$kid}");
        } else if ($item_id == 40 && ($level + $levels) >= 100) {
            $finish = true;
        } else if ($item_id == 40) {
            (new SummaryModel())->setFirstWWUser($db->fetchScalar('SELECT name FROM users WHERE id=' . $villageRow['owner']));
            $to_level = $level + $levels;
            if ($to_level > 95) {
                $WonderOfTheWorld = new WonderOfTheWorldModel();
                for ($i = 1; $i <= $levels; ++$i) {
                    $WonderOfTheWorld->attackWWVillage($kid, $to_level);
                }
            } else if ($to_level % 5 == 0) {
                $WonderOfTheWorld = new WonderOfTheWorldModel();
                $WonderOfTheWorld->attackWWVillage($kid, $to_level);
            }
            $db->query("UPDATE fdata SET lastWWUpgrade=" . miliseconds() . " WHERE kid={$kid}");
        }
        if (in_array($item_id, [1, 2, 3, 4, 5, 6, 7, 8, 9, 45])) {
            ResourcesHelper::updateVillageResources($kid, false);
        }
        if ($item_id == 41) {
            ResourcesHelper::updateVillageUpkeep($villageRow['owner'], $villageRow['kid'], $isWW, ($level + $levels));
        }
        $master->updateCommence($kid, true);
        Map::popChangeMapUpdate($kid, $villageRow['pop'], $villageRow['pop'] + $pop);
        if (isset($finish)) {
            $m->finishTheGame(1);
        }
    }

    private static function getBuildingsByField($kid, $building_field)
    {
        $db = DB::getInstance();
        $fields = $db->query("SELECT f{$building_field}t `item_id`, f{$building_field} `level`, embassy FROM fdata WHERE kid=$kid");
        if (!$fields->num_rows) {
            return false;
        }
        return $fields->fetch_row();
    }

    private static function updateVillagePopCP($uid, $kid, $pop, $cp, $mode = 0)
    {
        CulturePointsHelper::updateUserCP($uid);
        $db = DB::getInstance();
        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
        if (!$mode) {
            $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1, total_pop=total_pop+$pop, cp_prod=cp_prod+$cp WHERE id=$uid");
            if ($aid) {
                $db->query("UPDATE alidata SET week_pop_changes=week_pop_changes+{$pop} WHERE id=$aid");
            }
            $db->query("UPDATE vdata SET cp=cp+$cp, pop=pop+$pop WHERE kid=$kid");
        } else {
            $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1, total_pop=total_pop-$pop, cp_prod=cp_prod-$cp WHERE id=$uid");
            if ($aid) {
                $db->query("UPDATE alidata SET week_pop_changes=week_pop_changes-{$pop} WHERE id=$aid");
            }
            $db->query("UPDATE vdata SET cp=cp-$cp, pop=pop-$pop WHERE kid=$kid");
        }
    }

    private static function increaseFieldLevel($kid, $building_field, $levels = 1)
    {
        $db = DB::getInstance();
        $db->query("UPDATE fdata SET f{$building_field} = f{$building_field}+$levels WHERE kid=$kid");
    }

    private static function updateEmbassyLevel($kid, $embassy)
    {
        $db = DB::getInstance();
        $db->query("UPDATE fdata SET embassy=$embassy WHERE kid=$kid");
    }

    public static function downgrade($kid, $building_field, $levels, $complete = false)
    {
        $m = new AutomationModel();
        $master = new MasterBuilder();
        $db = DB::getInstance();
        list($item_id, $level) = self::getBuildingsByField($kid, $building_field);
        if (!$level || !$item_id) {
            return;
        }
        if ($levels == 0 && !$complete) {
            return;
        }
        if ($levels >= $level) {
            $complete = true;
        }
        if ($item_id == 25 || $item_id == 26 || $item_id == 44) {
            LoyaltyHelper::updateVillageLoyalty($kid);
        }
        $villageRow = $m->getVillage($kid, 'kid, owner, isWW, pop, maxcrop, maxstore, extraMaxstore, extraMaxcrop');
        $isWW = $villageRow['isWW'] == 1;
        list($pop, $cp) = Formulas::buildingCpPop($item_id, $level, $complete ? 0 : $level - $levels, $isWW || Formulas::isGrayArea($kid));
        self::updateVillagePopCP($villageRow['owner'], $kid, $pop, $cp, 1);
        if (!$complete) {
            $db->query("UPDATE fdata SET f{$building_field}=f{$building_field}-$levels WHERE kid = " . $kid);
        } else {
            if ($building_field > 18 && $building_field <> 99 && !self::building_upgrade_state($kid, $building_field)) {
                $db->query("UPDATE fdata SET f{$building_field}=0, f{$building_field}t=0 WHERE kid=" . $kid);
            } else {
                $db->query("UPDATE fdata SET f{$building_field}=0 WHERE kid = " . $kid);
            }
        }
        $db->query("DELETE FROM demolition WHERE kid=$kid AND building_field=$building_field");
        if($item_id == 37){
            $newLevel = $complete ? 0 : ($level - $levels);
            $db->query("UPDATE fdata SET heroMansion=$newLevel WHERE kid=$kid");
        } else if ($item_id == 18) {
            self::updateEmbassyLevel($kid, $complete ? 0 : ($level - $levels));
            $aid = $m->getUser($villageRow['owner'], 'aid')['aid'];
            if ($aid) {
                $m = new AllianceModel();
                $m->recalculateMaxUsers($aid);
            }
        } else if ($item_id == 10 || $item_id == 11 || $item_id == 38 || $item_id == 39) {
            $base = Formulas::storeCAP(0);
            $type = $item_id == 10 || $item_id == 38 ? 'maxstore' : 'maxcrop';
            $max = $villageRow[$type];
            $extraCapacity = $villageRow[$item_id == 10 || $item_id == 38 ? 'extraMaxstore' : 'extraMaxcrop'] * Formulas::storeCAP(20);
            $newStorage = $max == $base ? 0 : $max;
            $nextLevel = $complete ? 0 : $level - $levels;
            $big = $item_id == 38 || $item_id == 39;
            $value_inc = ($big ? Formulas::bigStoreCAP($level) : Formulas::storeCAP($level)) - ($nextLevel <= 0 ? 0 : ($big ? Formulas::bigStoreCAP($nextLevel) : Formulas::storeCAP($nextLevel)));
            $newStorage = $newStorage - $value_inc;
            $real_new_storage = $newStorage - $extraCapacity;
            if ($real_new_storage < $base) {
                $newStorage += $base;
            }
            $db->query("UPDATE vdata SET {$type}=$newStorage WHERE kid={$kid}");
        } else if ($item_id == 17 || $item_id == 28) {
            (new MarketModel())->cancelAllOffers($kid);
        }
        if ($building_field > 18 && $building_field <> 99 && !$complete && ((int)$level - 1) === 0 && !self::building_upgrade_state($kid, $building_field)) {
            $db->query("UPDATE fdata SET f{$building_field}t=0 WHERE kid={$kid}");
        }
        if (in_array($item_id, [1, 2, 3, 4, 5, 6, 7, 8, 9, 45])) {
            ResourcesHelper::updateVillageResources($kid, false);
        }
        if ($item_id == 41) {
            ResourcesHelper::updateVillageUpkeep($villageRow['owner'], $villageRow['kid'], $villageRow['isWW'] == 1, $complete ? 0 : ($level - $levels));
        }
        $master->updateCommence($kid, true);
        Map::popChangeMapUpdate($kid, $villageRow['pop'], $villageRow['pop'] - $pop);
    }

    public static function building_upgrade_state($kid, $building_field)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM building_upgrade WHERE kid=$kid AND building_field=$building_field");
    }

    public static function removeDemolitionsOnField($kid, $building_field)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM demolition WHERE kid=$kid AND building_field=$building_field");
    }

    public static function removeUpgradeConstructOnField($kid, $building_field)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM building_upgrade WHERE kid=$kid AND building_field=$building_field");
    }

    public static function fixUnUpgradedBuildings($kid)
    {
        $buildings = (new VillageModel())->getBuildingsAssoc($kid);
        $db = DB::getInstance();
        foreach ($buildings as $index => $build) {
            if ($build['item_id'] == 0 || $build['level'] > 0) continue;
            if ($index <= 18) continue;
            if ($index == 99) continue;
            if (self::building_upgrade_state($kid, $index)) continue;
            //it's probably bugged
            $db->query("UPDATE fdata SET f{$index}t=0 WHERE kid={$kid}");
        }
    }

}