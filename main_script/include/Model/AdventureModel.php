<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use function getCustom;
use function getGameElapsedSeconds;
use function getGameSpeed;
use function make_seed;

class AdventureModel
{
    /*
     * Adventures spawn randomly around capital and the villages that have an hero's mansion. It is not bound to the hero's home village or to the location where hero is currently situated.
     * */
    public function getAdventureCountAndFirstExpire($uid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT COUNT(id) AS `count`, time FROM adventure WHERE uid=$uid AND end=0 AND time >= " . time() . " ORDER BY id ASC LIMIT 1");
        $result = $result->fetch_assoc();
        return $result;
    }

    public function getHeroVillageRallyPoint($kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT f39 FROM fdata WHERE kid=$kid") > 0;
    }

    public function getAdventures($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM adventure WHERE uid=$uid AND end=0 AND time>" . time() . " ORDER BY id ASC");
    }

    public function getAdventure($uid, $kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM adventure WHERE uid=$uid AND kid=$kid AND end=0 AND time>" . time())->fetch_assoc();
    }

    public function getHeroVillageTsq($kid)
    {
        return VillageModel::getTournamentSquireLevel($kid);
    }

    public function checkForNewAdventures()
    {
        $db = DB::getInstance();
        $interval = 1 * 3600;
        $now = time();
        if(getGameSpeed() <= 2){
            $expire = 144 * 3600;
        } else if(getGameSpeed() <= 10) {
            $expire = 72 * 3600;
        } else {
            $expire = max(432000 / getGameSpeed(), 18000);
        }
        $expire_interval = max(86400 / getGameSpeed(), 1800);
        $find = $db->query("SELECT id, total_adventures, last_adventure_time, signupTime FROM users WHERE id>1 AND access=1 AND last_adventure_time <= " . (time() - $interval) . " ORDER BY last_adventure_time ASC LIMIT 100");
        while ($row = $find->fetch_assoc()) {
            $db->query("UPDATE users SET last_adventure_time=" . time() . " WHERE id={$row['id']}");
            $adventures_until_now = $this->calcAdventuresUntilNow($now - $row['signupTime']);
            $total = min($adventures_until_now - $row['total_adventures'], 10);
            if ($total > 0) {
                $time = $now + $expire;
                $countAdventures = $db->fetchScalar("SELECT COUNT(id) FROM adventure WHERE end=0 AND time >= " . time() . " AND uid={$row['id']}");
                if ($countAdventures <= 15) {
                    while ($total) {
                        $this->addAdventure($row['id'], $row['total_adventures'], $time);
                        $time += $expire_interval;
                        --$total;
                    }
                }
            }
        }
    }

    private function calcAdventuresUntilNow($seconds_past)
    {
        $adventures = 0;
        if (getGameSpeed() > 20) {
            //392 per round
            //$adventures = 392 / Config::getProperty("game", "round_length") * ($seconds_past / 86400);
            if (getGameSpeed() <= 50) {
                $adventures = 48 * ($seconds_past / 86400);
            } else if (getGameSpeed() <= 100) {
                $adventures = 24 * ($seconds_past / 86400);
            } else if (getGameSpeed() <= 1000) {
                $adventures = 48 * ($seconds_past / 86400);
            } else if (getGameSpeed() <= 10000) {
                $adventures = 60 * ($seconds_past / 86400);
            } else {
                $adventures = 80 * ($seconds_past / 86400);
            }
        } else {
            $intervals = $this->getAdventureIntervals();
            $size = sizeof($intervals);
            for ($i = $size; $i >= 1; --$i) {
                $previous = isset($intervals[$i - 1]['time']) ? $intervals[$i - 1]['time'] : 0;
                if ($seconds_past > $previous) {
                    $duration = $seconds_past - $previous;
                    $days = $duration / 86400;
                    $adventures += $days * $intervals[$i]['rate'];
                    $seconds_past -= $duration;
                }
            }
        }
        return Config::getProperty("custom", "startAdventures") + floor($adventures);
    }

    private function getAdventureIntervals()
    {
        $config = Config::getInstance();
        return [
            1 => ['time' => $config->game->round_length * 0.0057142857142857 * 86400, 'rate' => 3 * getGameSpeed()],
            2 => ['time' => $config->game->round_length * 0.048571428571429 * 86400, 'rate' => 2 * getGameSpeed()],
            3 => ['time' => $config->game->round_length * 0.18285714285714 * 86400, 'rate' => 1.5 * getGameSpeed()],
            4 => ['time' => 1000 * 86400, 'rate' => 1 * getGameSpeed()],
        ];
    }

    function addAdventure($uid, &$adventure_id, $time, $bought = false, $hard = null)
    {
        $db = DB::getInstance();
        $mainKid = $db->fetchScalar("SELECT kid FROM hero WHERE uid=$uid");
        if($db->fetchScalar("SELECT heroMansion FROM fdata WHERE kid=$mainKid") <= 0){
            $mainKid = $db->fetchScalar("SELECT kid FROM vdata WHERE owner=$uid AND (capital=1 OR ((SELECT heroMansion FROM fdata WHERE kid=vdata.kid) > 0)) ORDER BY RAND() LIMIT 1");
        }
        if (!$mainKid) {
            return;
        }
        make_seed();
        $xy = Formulas::kid2xy($mainKid);
        $r = mt_rand(1, 6);
        $max_distance = $r * mt_rand(0, 7);
        $adventure_found = false;
        $tries = 0;
        while (!$adventure_found && $tries < 45) {
            ++$tries;
            $max_distance += mt_rand(4, 5);
            $location = Formulas::getNearbyXY($xy['x'], $xy['y'], $max_distance);
            $locationKID = Formulas::xy2kid($location['x'], $location['y']);
            $occupied = $db->fetchScalar("SELECT occupied FROM wdata WHERE id=$locationKID") == 1;
            if ($occupied) continue;
            $existing_adventure = $db->fetchScalar("SELECT COUNT(id) FROM adventure WHERE end=0 AND time >= " . time() . " AND uid=$uid AND kid=$locationKID") > 0;
            if ($existing_adventure) continue;
            $adventure_found = true;
            break;
        }
        if ($adventure_found) {
            $dif = $hard === true || ($hard === null && (++$adventure_id) % 4 == 1) ? 1 : 0;
            $db->query("INSERT INTO adventure (`uid`, `kid`, `dif`, `time`, `end`) values ('$uid', '$locationKID', '$dif', '$time', 0)");
            if (!$bought) {
                $db->query("UPDATE users SET total_adventures=total_adventures+1 WHERE id=$uid");
            }
        }
    }

    public function checkForAdventure($uid, $kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM adventure WHERE end=0 AND time >= " . time() . " AND uid=$uid AND kid=$kid");
    }

    public function getAdventureExpireTime()
    {
        return max(7 * 86400 / getGameSpeed(), 18000);
    }

    public function addNewUserAdventures($uid)
    {
        $total = getCustom('startAdventures');
        $time = time() + $this->getAdventureExpireTime();
        $adventure_id = 0;
        $i = 1;
        while ($total) {
            $this->addAdventure($uid, $adventure_id, $time, false, $i == 2);
            --$total;
            $i++;
        }
    }
} 