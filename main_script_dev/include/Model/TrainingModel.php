<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 9/19/14
 * Time: 7:51 PM
 */

namespace Model;

use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use Game\ResourcesHelper;
use function nanoseconds;
use function var_dump;

class TrainingModel
{
    public function getTraining($kid, $item_id)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM training WHERE item_id=$item_id AND kid=$kid");
    }

    public function addTraining($kid, $item_id, $nr, $num, $training_time)
    {
        $time = getGame("useNanoseconds") ? nanoseconds() : (getGame("useMilSeconds") ? miliseconds() : time());
        $db = DB::getInstance();
        $commence = $db->fetchScalar("SELECT end_time FROM training WHERE item_id=$item_id AND kid=$kid ORDER BY end_time DESC LIMIT 1");
        $commence = $commence > $time ? $commence : $time;
        $commence = $commence + $training_time;
        $end_time = $commence + (($num - 1) * $training_time);
        $db->query("INSERT INTO training(`kid`, `nr`, `num`, `item_id`, `training_time`, `commence`, `end_time`) VALUES ($kid, $nr, $num, $item_id, $training_time, $commence, $end_time)");
    }

    public function getTotalTrainingTime($kid, $item_id)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT SUM(training_time*num) FROM training WHERE item_id=$item_id AND kid=$kid");
    }

    public function getTechnology($kid)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT * FROM tdata WHERE kid=$kid")->fetch_assoc();

        return $row;
    }

    public function getUnits($kid)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT * FROM units WHERE kid=$kid")->fetch_assoc();

        return $row;
    }

    public function getFilledTrapCount($kid)
    {
        $db = DB::getInstance();

        return (int)$db->fetchScalar("SELECT SUM(u1)+SUM(u2)+SUM(u3)+SUM(u4)+SUM(u5)+SUM(u6)+SUM(u7)+SUM(u8)+SUM(u9)+SUM(u10)+SUM(u11) FROM trapped WHERE to_kid=$kid");
    }

    public function calculatePriceForInstantTraining($kid)
    {
        $db = DB::getInstance();
        $rate = 1;
        if (Config::getProperty("game", "useNanoseconds")) {
            $rate = 1e9;
        } else if (Config::getProperty("game", "useMilSeconds")) {
            $rate = 1000;
        }
        $totalTrainingTime = $db->fetchScalar("SELECT SUM(training_time*num) FROM training WHERE kid=$kid");
        $totalTrainingTime = (int)$totalTrainingTime / $rate;
        $threshold = Config::getProperty("extraSettings", "generalOptions", "finishTraining", "threshold");
        return max(1, ceil($totalTrainingTime / $threshold));
    }

    public function handleTrainingCompleteResult(array $row)
    {
        $db = DB::getInstance();
        $useMilSeconds = getGame("useMilSeconds");
        $useNanoseconds = getGame("useNanoseconds");
        $current = $useNanoseconds ? nanoseconds() : ($useMilSeconds ? miliseconds() : time());
        if ($row['commence'] > $current) return;
        if ($row['nr'] == 11) {
            $trained = 1;
        } else {
            if ($row['training_time'] == 0 || $row['end_time'] == 0 || $row['commence'] == 0) {
                $trained = $row['num'];
            } else {
                $trained = floor(($current - ($row['commence'] - $row['training_time'])) / $row['training_time']);
            }
            if ($trained >= $row['num']) $trained = $row['num'];
        }
        $trained = abs($trained);
        if ($trained >= $row['num'] || ($row['num'] - $trained) <= 0) {
            $db->query("DELETE FROM training WHERE id={$row['id']}");
        } else {
            $leftOnTraining = abs((int)$row['num'] - $trained);
            $newCommence = $row['end_time'] - (($leftOnTraining - 1) * $row['training_time']);
            $db->query("UPDATE training SET num=$leftOnTraining, commence=$newCommence WHERE id={$row['id']}");
        }
        if ($row['nr'] == 11) {
            $this->regenerateHero(-1, $row['kid']);
            return;
        }
        $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
        $db->query("UPDATE units SET u{$row['nr']}=u{$row['nr']}+$trained WHERE kid={$row['kid']}");
        {
            $race = $db->fetchScalar("SELECT race FROM units WHERE kid={$row['kid']}");
            $upkeep = Formulas::uUpkeep(nrToUnitId($row['nr'], $race), VillageModel::getHDP($row['kid'], $race)) * $trained;
            ResourcesHelper::modifyUpkeep($uid, $row['kid'], $upkeep);
        }
    }

    public function regenerateHero($uid, $kid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE units SET u11=1 WHERE kid=$kid");
        if ($uid < 0) {
            $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
        }
        $db->query("UPDATE hero SET kid=$kid, health=100 WHERE uid=$uid");
        ResourcesHelper::modifyUpkeep($uid, $kid, 6);
        ResourcesHelper::updateVillageResources($kid, FALSE);
    }
}