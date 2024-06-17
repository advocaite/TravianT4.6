<?php

namespace Model;

use function array_values;
use Core\Database\DB;
use Game\Formulas;

class AllianceBonusModel
{
    const TYPE_TRAINING = 1;
    const TYPE_ARMOR = 2;
    const TYPE_CP = 3;
    const TYPE_TRADE = 4;
    const LEVEL_PARAMS = [
        self::TYPE_TRAINING => 'training_bonus_level',
        self::TYPE_ARMOR    => 'armor_bonus_level',
        self::TYPE_CP       => 'cp_bonus_level',
        self::TYPE_TRADE    => 'trade_bonus_level',
    ];
    const ALLIANCE_CONTRIBUTION_PARAMS = [
        self::TYPE_TRAINING => 'training_bonus_contributions',
        self::TYPE_ARMOR    => 'armor_bonus_contributions',
        self::TYPE_CP       => 'cp_bonus_contributions',
        self::TYPE_TRADE    => 'trade_bonus_contributions',
    ];
    const USER_WEEK_CONTRIBUTION_PARAMS = [
        self::TYPE_TRAINING => 'week_alliance_training_contributions',
        self::TYPE_ARMOR    => 'week_alliance_armor_contributions',
        self::TYPE_CP       => 'week_alliance_cp_contributions',
        self::TYPE_TRADE    => 'week_alliance_trade_contributions',
    ];
    const USER_TOTAL_CONTRIBUTION_PARAMS = [
        self::TYPE_TRAINING => 'total_alliance_training_contributions',
        self::TYPE_ARMOR    => 'total_alliance_armor_contributions',
        self::TYPE_CP       => 'total_alliance_cp_contributions',
        self::TYPE_TRADE    => 'total_alliance_trade_contributions',
    ];
    const USER_UNLOCK_PENDING_ANIMATION = [
        self::TYPE_TRAINING => 'pending_training_alliance_bonus_unlock_animation',
        self::TYPE_ARMOR    => 'pending_armor_alliance_bonus_unlock_animation',
        self::TYPE_CP       => 'pending_cp_alliance_bonus_unlock_animation',
        self::TYPE_TRADE    => 'pending_trade_alliance_bonus_unlock_animation',
    ];

    public function isUnlockingNextLevel($aid, $type)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM alliance_bonus_upgrade_queue WHERE aid=$aid AND type=$type") > 0;
    }

    public function getUnlockTime($aid, $type)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT time FROM alliance_bonus_upgrade_queue WHERE aid=$aid AND type=$type");
    }

    public function setAnimationAsFinished($uid, $type)
    {
        $column = self::USER_UNLOCK_PENDING_ANIMATION[$type];
        $db = DB::getInstance();
        $db->query("UPDATE users SET $column=0 WHERE id=$uid");
    }

    public function levelUpBonus($aid, $type)
    {
        $db = DB::getInstance();
        $pending = self::USER_UNLOCK_PENDING_ANIMATION[$type];
        $type = self::LEVEL_PARAMS[$type];
        $db->query("UPDATE alidata SET $type=$type+1 WHERE id=$aid");
        $db->query("UPDATE users SET $pending=1 WHERE aid=$aid");
    }

    public function getMaxAllianceBonusLevel($aid)
    {
        $db = DB::getInstance();
        $alliance = $db->query("SELECT " . implode(",",
                array_values(self::LEVEL_PARAMS)) . " FROM alidata WHERE id=$aid")->fetch_assoc();
        return max(array_values($alliance));
    }

    public function getMinAllianceBonusLevel($aid)
    {
        $db = DB::getInstance();
        $alliance = $db->query("SELECT " . implode(",",
                array_values(self::LEVEL_PARAMS)) . " FROM alidata WHERE id=$aid")->fetch_assoc();
        return min(array_values($alliance));
    }

    public function getAllianceBonusTypeParams($aid, $type)
    {
        $db = DB::getInstance();
        $params = [
            self::LEVEL_PARAMS[$type],
            self::ALLIANCE_CONTRIBUTION_PARAMS[$type],
        ];
        $alliance = $db->query("SELECT " . implode(",", $params) . " FROM alidata WHERE id=$aid");
        if (!$alliance->num_rows) {
            return false;
        }
        $alliance = $alliance->fetch_assoc();
        return [
            'level' => $alliance[$params[0]],
            'contributions' => $alliance[$params[1]],
        ];
    }

    public function unlockNextLevel($aid, $type, $currentLevel)
    {
        $db = DB::getInstance();
        $time = time() + Formulas::getAllianceBonusUpgradeDuration($currentLevel + 1);
        $db->query("INSERT INTO alliance_bonus_upgrade_queue (aid, type, time) VALUES ($aid, $type, $time)");
    }

    public function contribute($aid, $uid, $type, $resources)
    {
        $db = DB::getInstance();
        $week_type = self::USER_WEEK_CONTRIBUTION_PARAMS[$type];
        $overall_type = self::USER_TOTAL_CONTRIBUTION_PARAMS[$type];
        $type = self::ALLIANCE_CONTRIBUTION_PARAMS[$type];
        $db->query("UPDATE alidata SET $type=$type+$resources WHERE id=$aid");
        $db->query("UPDATE daily_quest SET alliance_contribution=alliance_contribution+$resources WHERE uid=$uid");
        $db->query("UPDATE users SET alliance_contributions=alliance_contributions+$resources, $week_type=$week_type+$resources, $overall_type=$overall_type+$resources WHERE id=$uid");
    }

    public function getContributorsOfTheWeek($aid, $type)
    {
        $db = DB::getInstance();
        $type = self::USER_WEEK_CONTRIBUTION_PARAMS[$type];
        return $db->query("SELECT id, name, $type `points` FROM users WHERE aid=$aid AND $type > 0 ORDER BY $type DESC LIMIT 5");
    }

    public function getAllianceBonusesLevel($aid)
    {
        $db = DB::getInstance();
        $aid = (int)$aid;
        return $db->query("SELECT " . implode(",", self::LEVEL_PARAMS) . " FROM alidata WHERE id=$aid")->fetch_assoc();
    }

    public function getAllTimeContributors($aid, $type)
    {
        $db = DB::getInstance();
        $type = self::USER_TOTAL_CONTRIBUTION_PARAMS[$type];
        return $db->query("SELECT id, name, $type `points` FROM users WHERE aid=$aid AND $type > 0 ORDER BY $type DESC LIMIT 5");
    }
}