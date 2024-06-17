<?php

use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Types;

function add_gold($type, $ip, $worldUniqueId, $playerId, $votingName)
{
    $playerId = (int)$playerId;
    $db = GlobalDB::getInstance();
    $serverDetails = GlobalDB::getGameServer($worldUniqueId);
    if ($serverDetails !== false) {
        try {
            $ip = ip2long($ip);
            $serverDB = ServerDB::getInstance($serverDetails['configFileLocation']);
            $time = time();
            $interval = $type == Types::G_TOP_100 ? 43200 : 86400;
            $totalVotes = (int)$db->query("SELECT COUNT(id) FROM voting_log WHERE (wid=$worldUniqueId AND uid={$playerId}) AND time > IF(type=3, $time-86400, $time-43200)")->fetch_row()[0];
            $alreadyVoted = (int)$db->query("SELECT COUNT(id) FROM voting_log WHERE ((wid=$worldUniqueId AND uid=$playerId AND ip=$ip) OR ip=$ip) AND type=$type AND $time-time < $interval")->fetch_row()[0];
            if (!$alreadyVoted && $totalVotes < 15) {
                $db->query("INSERT INTO `voting_log`(`wid`, `uid`, `ip`, `type`, `time`) VALUES ($worldUniqueId, {$playerId}, $ip, $type, " . time() . ")");
                $serverDB->query("INSERT INTO `voting_reward_queue`(`uid`, `votingName`) VALUES ($playerId, '{$votingName}')");
                return true;
            }
        } catch (Exception $e) {
        }
    }
    return false;
}