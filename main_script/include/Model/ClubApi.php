<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;

class ClubApi
{
    public static function addMedal($nickname, $tribe, $email, $points, $type, $hidden)
    {
        if (is_array($points)) $points = implode("|", $points);
        $db = GlobalDB::getInstance();
        $serverName = Config::getInstance()->settings->serverName;
        $hidden = $hidden ? 1 : 0;
        if (empty($email)) return false;
        $db->query("INSERT INTO clubMedals (worldId, nickname, email, tribe, params, type, time, hidden) VALUES ('$serverName', '$nickname', '$email', '$tribe', '$points', '$type', '" . time() . "', $hidden)");
        return $db->lastInsertId();
    }

    public static function getPlayerEmailMedalById($email, $id)
    {
        $db = GlobalDB::getInstance();
        return $db->query("SELECT * FROM clubMedals WHERE id='$id' AND hidden=0 AND email='$email' LIMIT 1");
    }

    public static function getPlayerEmailMedals($email, $includeHidden = false)
    {
        $db = GlobalDB::getInstance();
        if ($includeHidden) {
            return $db->query("SELECT * FROM clubMedals WHERE email='$email' ORDER BY time DESC");
        }
        return $db->query("SELECT * FROM clubMedals WHERE hidden=0 AND email='$email' ORDER BY time DESC");
    }
}