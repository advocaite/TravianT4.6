<?php
/**
 * Created by PhpStorm.
 * User: Deckard-
 * Date: 7/29/2015
 * Time: 7:27 PM
 */

namespace Model;

use function array_key_exists;
use Core\Config;
use Core\Database\DB;
use Core\Log;
use function getCustom;

class MedalsModel
{
    const TOP_ATTACKER = 'topAttacker';
    const TOP_DEFENDER = 'topDefender';
    const TOP_RAIDER = 'topRaider';
    const TOP_CLIMBER = 'topClimber';

    private function handlePrizeBonus($type, $uid, $rank)
    {
        $config = Config::getInstance();
        $bonus = $config->bonus->top10->{$type};
        if (!($bonus->enabled && array_key_exists($rank, $bonus->ranks) && $bonus->ranks[$rank] > 0)) {
            return;
        }
        $gold = $bonus->ranks[$rank];
        if ($gold > 0) {
            $db = DB::getInstance();
            $db->query("UPDATE users SET gift_gold=gift_gold+{$gold} WHERE id=$uid");
            $m = new MessageModel();
            $m->sendMessage(0, $uid, $type, $gold, 5);
        }
    }

    public function resetMedals()
    {
        $db = DB::getInstance();
        $config = Config::getInstance();
        $lastMedalsGiven = $db->fetchScalar("SELECT lastMedalsGiven FROM config");
        if ($lastMedalsGiven == 0 || $lastMedalsGiven <= (getGame("start_time") - 7 * 86400)) {
            if (getCustom("startMedalsAtStartOfWeek")) {
                $lastMedalsGiven = strtotime("Tuesday 00:00", $config->game->start_time);
                if ($lastMedalsGiven > time()) {
                    $lastMedalsGiven = strtotime("next Tuesday -1 week 00:00", $config->game->start_time);
                }
            } else {
                $lastMedalsGiven = $config->game->start_time;
            }
            $db->query("UPDATE config SET lastMedalsGiven=$lastMedalsGiven");
        }
        if ((($lastMedalsGiven + $config->game->medals_interval)) > time()) {
            return FALSE;
        }
        if (getCustom("refillFarmsOnTop10Reset")) {
            $db->query("UPDATE vdata SET wood=wood+woodp*2, clay=clay+clayp*2, iron=iron+ironp*2, crop=crop+cropp*2 WHERE isFarm=1");
        }
        $now = $lastMedalsGiven + $config->game->medals_interval;
        //StatisticsCache::reCacheTop10Normal(TRUE);
        //StatisticsCache::reCacheTop10Climbers(TRUE);
        $db->query("UPDATE config SET lastMedalsGiven=" . $now);
        $week = $db->query("SELECT week FROM medal ORDER BY week DESC LIMIT 1");
        $week = $week->num_rows ? $week->fetch_assoc()['week'] + 1 : 1;
        $statistics = new StatisticsModel();
        $result = $statistics->getTop10(TRUE, "week_attack_points");
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "t2_{$rank}";
            $this->addMedal(FALSE, $row['id'], 1, $week, $rank, $row['points'], $img);
            $this->handlePrizeBonus(self::TOP_ATTACKER, $row['id'], $rank);
        }
        //defenders
        $result = $statistics->getTop10(TRUE, "week_defense_points");
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "t3_{$rank}";
            $this->addMedal(FALSE, $row['id'], 2, $week, $rank, $row['points'], $img);
            $this->handlePrizeBonus(self::TOP_DEFENDER, $row['id'], $rank);
        }
        $result = $statistics->getTop10Climbers(TRUE);
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "t1_{$rank}";
            $this->addMedal(FALSE, $row['id'], 3, $week, $rank, $row['points'], $img);
            $this->handlePrizeBonus(self::TOP_CLIMBER, $row['id'], $rank);
        }
        $rank = 0;
        $result = $statistics->getTop10(TRUE, 'week_robber_points');
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "t4_{$rank}";
            $this->addMedal(FALSE, $row['id'], 4, $week, $rank, $row['points'], $img);
            $this->handlePrizeBonus(self::TOP_RAIDER, $row['id'], $rank);
        }
        //share bonus for attack + defense from top 10
        //Grab the top10 attackers
        $result = $statistics->getTop10(TRUE, "week_attack_points");
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            //Get the top 10 defenders
            $result2 = $statistics->getTop10(TRUE, "week_defense_points");
            foreach ($result2 as $row2) {
                if ($row['id'] == $row2['id']) {
                    $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=5");
                    //look what color the ribbon must have
                    if ($count <= 2) {
                        $img = "t22{$count}_1";
                        $row['points'] = $count + 1;//look up!
                        $this->addMedal(FALSE, $row['id'], 5, $week, $rank, $row['points'], $img);
                    }
                }
            }
        }
        //you stand for 3rd / 5th / 10th time in the top 3 strikers
        //Grab the top10 attackers
        $result = $statistics->getTop10(TRUE, "week_attack_points");
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=1 AND rank<=3");
                $img = [3 => 't120_1', 5 => 't121_1', 10 => 't122_1'];
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 6, $week, $rank, $count, $img);
            } while (FALSE);
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=1 AND rank<=10");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't130_1', 5 => 't131_1', 10 => 't132_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 12, $week, $rank, $count, $img);
            } while (FALSE);
        }
        //you stand for 3rd / 5th / 10th time in the top 3 defenders
        //grab defenders.
        $result = $statistics->getTop10(TRUE, "week_defense_points");
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=2 AND rank<=3");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't140_1', 5 => 't141_1', 10 => 't142_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 7, $week, $rank, $count, $img);
            } while (FALSE);
            do {//you stand for 3rd / 5th / 10th time in the top 10 defenders
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=2 AND rank<=10");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't150_1', 5 => 't151_1', 10 => 't152_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 13, $week, $rank, $count, $img);
            } while (FALSE);
        }
        //you stand for 3rd / 5th / 10th time in the top 3 climbers
        $result = $statistics->getTop10Climbers(TRUE);
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=3 AND rank<=3");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't100_1', 5 => 't101_1', 10 => 't102_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 8, $week, $rank, $count, $img);
            } while (FALSE);
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=3 AND rank<=10");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't110_1', 5 => 't111_1', 10 => 't112_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 14, $week, $rank, $count, $img);
            } while (FALSE);
        }
        $result = $statistics->getTop10(TRUE, "week_robber_points");
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=4 AND rank<=3");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't160_1', 5 => 't161_1', 10 => 't162_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 9, $week, $rank, $count, $img);
            } while (FALSE);

            do {
                $count = $db->fetchScalar("SELECT COUNT(id) FROM medal WHERE uid={$row['id']} AND category=4 AND rank<=10");
                //2x in standing, it is therefore ribbon 3rd (bronze)
                //4x been included, so this is 5th medal (silver)
                //9x in standing, it is so 10th ribbon (gold)
                $img = [3 => 't170_1', 5 => 't171_1', 10 => 't172_1'];
                if (!isset($img[$count])) {
                    break;
                }
                $img = $img[$count];
                $this->addMedal(FALSE, $row['id'], 15, $week, $rank, $count, $img);
            } while (FALSE);
        }
        if (getCustom("usePopulationAsClimbersRank")) {
            $db->query("UPDATE users SET week_attack_points=0, week_defense_points=0, week_robber_points=0, oldRank=cast(total_pop AS SIGNED)");
        } else {
            $players = $db->query("SELECT id FROM users");
            while ($row = $players->fetch_assoc()) {
                $oldRank = $statistics->getPlayerRankById($row['id'], TRUE);
                $db->query("UPDATE users SET week_attack_points=0, week_defense_points=0, week_robber_points=0, oldRank=$oldRank WHERE id={$row['id']}");
            }
        }
        $db->query("UPDATE users SET week_alliance_training_contributions=0, week_alliance_armor_contributions=0, week_alliance_cp_contributions=0, week_alliance_trade_contributions=0");
        //alliance medals
        $result = $statistics->getTop10(FALSE, "week_attack_points");
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "a2_{$rank}";
            $this->addMedal(TRUE, $row['id'], 1, $week, $rank, $row['points'], $img);
        }
        //defenders
        $result = $statistics->getTop10(FALSE, "week_defense_points");
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "a3_{$rank}";
            $this->addMedal(TRUE, $row['id'], 2, $week, $rank, $row['points'], $img);
        }
        $result = $statistics->getTop10Climbers(FALSE);
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "a1_{$rank}";
            $this->addMedal(TRUE, $row['id'], 3, $week, $rank, $row['points'], $img);
        }
        $result = $statistics->getTop10(FALSE, 'week_robber_points');
        $rank = 0;
        foreach ($result as $row) {
            if ($row['points'] <= 0) continue;
            ++$rank;
            $img = "a4_{$rank}";
            $this->addMedal(TRUE, $row['id'], 4, $week, $rank, $row['points'], $img);
        }
        $alliances = $db->query("SELECT id FROM alidata");
        while ($row = $alliances->fetch_assoc()) {
            $oldPop = (int)$db->fetchScalar("SELECT SUM(total_pop) FROM users WHERE users.aid={$row['id']}");
            $db->query("UPDATE alidata SET week_attack_points=0, week_defense_points=0, week_robber_points=0, week_pop_changes=0, oldPop=$oldPop WHERE id={$row['id']}");
        }
        //StatisticsCache::reCacheTop10Normal(TRUE);
        //StatisticsCache::reCacheTop10Climbers(TRUE);
        Log::addLog(0, "Top10Reset", "Top10 has been reseted.");
    }

    private function addMedal($alliance, $uid, $category, $week, $rank, $points, $img)
    {
        $db = DB::getInstance();
        if ($alliance) {
            $db->query("INSERT INTO allimedal (aid, category, week, rank, points, img) VALUES ('$uid', '$category', '$week', '$rank', '$points', '$img')");
        } else {
            $db->query("INSERT INTO medal (uid, category, week, rank, points, img) VALUES ('$uid', '$category', '$week', '$rank', '$points', '$img')");
        }
    }

}