<?php

namespace Model;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use function getWorldUniqueId;

class SummaryModel
{
    public function getSummary()
    {
        $memcached = Caching::getInstance();
        if ($_cache = $memcached->get("Statistics:General:Tribes")) {
            return $_cache;
        }
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM summary LIMIT 1")->fetch_assoc();
        $memcached->add("Statistics:General:Tribes", $result, 86400);
        return $result;
    }

    public function setFirstVillageUser($playerName)
    {
        $db = DB::getInstance();
        $playerName = $db->real_escape_string($playerName);
        $db->query("UPDATE summary SET first_village_player_name='$playerName', first_village_time=" . time() . " WHERE first_village_time=0");
    }

    public function setFirstArtifactUser($playerName)
    {
        $db = DB::getInstance();
        $playerName = $db->real_escape_string($playerName);
        $db->query("UPDATE summary SET first_art_player_name='$playerName', first_art_time=" . time() . " WHERE first_art_time=0");
    }

    public function setFirstWWUser($playerName)
    {
        $db = DB::getInstance();
        $playerName = $db->real_escape_string($playerName);
        $db->query("UPDATE summary SET first_ww_player_name='$playerName', first_ww_time=" . time() . " WHERE first_ww_time=0");
    }

    public function setFirstWWPlanUser($playerName)
    {
        $db = DB::getInstance();
        $playerName = $db->real_escape_string($playerName);
        $db->query("UPDATE summary SET first_ww_plan_player_name='$playerName', first_ww_plan_time=" . time() . " WHERE first_ww_plan_time=0");
    }

    public function getTotalSummary()
    {
        $memcached = Caching::getInstance();
        if ($_cache = $memcached->get("Statistics:General:Players")) {
            return $_cache;
        }
        $db = DB::getInstance();
        $globalDB = GlobalDB::getInstance();
        $online_timeout = Config::getProperty("settings", "online_timeout");
        $result = $db->query("SELECT
        (SELECT COUNT(id) FROM users WHERE id>1) `active`,
        (SELECT COUNT(id) FROM users WHERE access=3) `fakeCount`,
        (SELECT COUNT(id) FROM users WHERE id>1 AND access!=3 AND email_verified=1) `verified`,
        (SELECT COUNT(id) FROM users WHERE id>1 AND last_login_time >= " . (time() - $online_timeout) . ") `real_online`,
        (SELECT COUNT(id) FROM activation) `activating`")->fetch_assoc();
        $not_activated = $globalDB->fetchScalar("SELECT COUNT(id) FROM activation WHERE used=0 AND worldId=" . getWorldUniqueId());
        $result['not_activated'] = $not_activated;
        $result['registered'] = ($result['active'] + $result['activating'] + $result['not_activated']);
        $result['online'] = $result['real_online'];
        $result['real_players'] = $result['active'] - $result['fakeCount'];
        if (!isServerFinished()) {
            $result['online'] += mt_rand(40, 60);
            if ($result['online'] >= $result['active']) {
                $result['online'] *= 0.65;
            }
        }
        $result['online'] = min(floor($result['online']), $result['active']);
        $memcached->add("Statistics:General:Players", $result, 60);
        return $result;
    }

    public function addPlayerToSummary($race)
    {
        $db = DB::getInstance();
        $edit = [1 => 'roman', 2 => 'teuton', 3 => 'gaul', 6 => 'egyptians', 7 => 'huns'][$race];
        $db->query("UPDATE summary SET players_count=players_count+1, {$edit}_players_count={$edit}_players_count+1");
        $memcached = Caching::getInstance();
        $memcached->delete("Statistics:General:Players");
        $memcached->delete("Statistics:General:Tribes");
    }

    public function deletePlayerFromSummary($race)
    {
        $db = DB::getInstance();
        $edit = [1 => 'roman', 2 => 'teuton', 3 => 'gaul', 6 => 'egyptians', 7 => 'huns'][$race];
        $db->query("UPDATE summary SET players_count=players_count-1, {$edit}_players_count={$edit}_players_count-1");
        $memcached = Caching::getInstance();
        $memcached->delete("Statistics:General:Players");
        $memcached->delete("Statistics:General:Tribes");
    }
} 