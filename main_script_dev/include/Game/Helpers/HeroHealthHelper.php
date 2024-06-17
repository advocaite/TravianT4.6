<?php

namespace Game\Helpers;

use Core\Database\DB;
use Game\Hero\HeroHelper;

class HeroHealthHelper
{
    public static function updateUserHeroHealth($uid)
    {
        $now = time();
        $db = DB::getInstance();
        $result = $db->query("SELECT uid, health, lastupdate, itemHealth FROM hero WHERE uid=$uid AND health>0");
        $helper = new HeroHelper();
        while ($row = $result->fetch_assoc()) {
            $healthRate = $helper->calcHealth() + $row['itemHealth'];
            self::updateHeroHealth($row['uid'],
                min($row['health'] + $healthRate / 86400 * ($now - $row['lastupdate']), 100),
                time());
        }
    }

    public static function getHeroItemHealth($uid)
    {
        $helper = new HeroHelper();
        $db = DB::getInstance();
        $inventory = $db->query("SELECT helmet, body, shoes FROM inventory WHERE uid=$uid");
        if (!$inventory->num_rows) {
            return false;
        }
        $inventory = $inventory->fetch_assoc();
        return $helper->calcItemHealth($inventory['helmet'], $inventory['body'], $inventory['shoes']);
    }

    public static function updateHeroHealth($uid, $health, $time)
    {
        $db = DB::getInstance();
        $db->query("UPDATE hero SET health=$health, lastupdate=$time WHERE uid=$uid AND health>0 AND health<100");
    }
}