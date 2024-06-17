<?php

namespace Model;

use Core\AI;
use Core\Config;
use Core\Database\DB;
use function getGameElapsedSeconds;
use function getGameSpeed;
use function make_seed;


class FakeUserModel
{
    public function handleFakeUsers()
    {
        if (!$this->canRun()) return;
        $db = DB::getInstance();
        $interval = mt_rand(3600, 10800);
        $stmt = $db->query("SELECT id FROM users WHERE access=3 AND lastHeroExpCheck <= " . (time() - $interval) . " LIMIT 10");
        while ($row = $stmt->fetch_assoc()) {
            $db->query("UPDATE users SET lastHeroExpCheck=" . time() . " WHERE id={$row['id']}");
            $exp = mt_rand(10, 50) * ceil(getGameSpeed() / 100);
            $db->query("UPDATE hero SET exp=exp+$exp WHERE uid={$row['id']}");
        }
        if (getGameSpeed() <= 10) {
            $interval = mt_rand(600, 3600);
        } else if (getGameSpeed() <= 100) {
            $interval = mt_rand(200, 400);
        } else if (getGameSpeed() <= 1000) {
            $interval = mt_rand(100, 250);
        } else {
            $interval = mt_rand(50, 150);
        }
        $limit = 10;
        $checkInterval = 200;
        $time = time() - $checkInterval;
        $now = time();
        $results = $db->query("SELECT kid, lastVillageCheck FROM vdata v WHERE lastVillageCheck < $time AND (SELECT access FROM users WHERE id=v.owner)=3 LIMIT $limit");
        while ($row = $results->fetch_assoc()) {
            $db->query("UPDATE vdata SET lastVillageCheck=$now WHERE kid={$row['kid']}");
            if ($row['lastVillageCheck'] <= 10) continue;
            $count = ceil(($now - $row['lastVillageCheck']) / $interval);
            AI::doSomethingRandom($row['kid'], $count);
        }
    }

    private function canRun()
    {
        if (getGameElapsedSeconds() <= 0 || !Config::getProperty("dynamic", "fakeAccountProcess")) return false;
        make_seed();
        return true;
    }

    public function handleFakeUserExpands()
    {
        if (!$this->canRun()) return;
        if (getGameSpeed() <= 10) {
            $elapsedSeconds = getGameElapsedSeconds();
            if ($elapsedSeconds <= 4 * 86400) {
                $interval = 3 * 86400;
            } else if ($elapsedSeconds <= 15 * 86400) {
                $interval = 7 * 86400;
            } else if ($elapsedSeconds <= 45 * 86400) {
                $interval = 5 * 86400;
            } else {
                $interval = 15 * 86400;
            }
        } else {
            $interval = (mt_rand(65, 165) / 100) * 86400;
        }
        $limit = 5;
        $time = time() - $interval;
        $db = DB::getInstance();
        $register = new RegisterModel();
        $result = $db->query("SELECT id, race, lastVillageExpand FROM users WHERE access=3 AND lastVillageExpand<=$time LIMIT $limit");
        while ($row = $result->fetch_assoc()) {
            $db->query("UPDATE users SET lastVillageExpand=" . ($time + $interval) . " WHERE id={$row['id']}");
            if ($row['lastVillageExpand'] == 0) {
                continue;
            }
            $count = ceil((time() - $row['lastVillageExpand']) / $interval);
            $find = $register->generateFakeUserVillage($count);
            if (!empty($find)) {
                $villages = explode(",", $find);
                $db->query("UPDATE available_villages SET occupied=1 WHERE kid IN($find)");
                foreach ($villages as $kid) {
                    $register->createNewVillage($row['id'], $row['race'], $kid);
                }
            }
        }
    }
}

