<?php

namespace Core\Helper;

use Core\Config;
use Core\Database\GlobalDB;
use Core\Session;

class Voting
{
    const MAX_VOTES = 15;

    public static function getTotalVotes()
    {
        $db = GlobalDB::getInstance();
        $playerId = Session::getInstance()->getPlayerId();
        $wid = Config::getInstance()->settings->worldUniqueId;
        $time = time();
        $result = (int)$db->fetchScalar("SELECT COUNT(id) FROM voting_log WHERE (wid=$wid AND uid={$playerId}) AND time > IF(type=3, $time-86400, $time-43200)");
        return $result;
    }

    public static function getVotes()
    {
        $playerId = Session::getInstance()->getPlayerId();
        $wid = Config::getInstance()->settings->worldUniqueId;
        $ip = ip2long(WebService::ipAddress());
        $time = time();
// Multi IP capable
        $result = GlobalDB::getInstance()->query("SELECT * FROM voting_log WHERE ((wid=$wid AND uid={$playerId} AND ip=$ip) OR ip=$ip) AND $time-time < IF(type=3, 86400, 43200)");
        // One account capable
        return $result;
    }

    public static function getVotingCoolDown($type)
    {
        return $type == 3 ? 86400 : 43200;
    }
}