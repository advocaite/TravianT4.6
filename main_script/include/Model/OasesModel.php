<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use Game\Map\Map;
use function array_filter_units;
use Game\ResourcesHelper;
use function getGameElapsedSeconds;
use function getGameSpeed;

class OasesModel
{
    public static function oasesTrainV3($kid)
    {
        $db = DB::getInstance();
        $oases = $db->query("SELECT type, lasttrain, lastfarmed, owner FROM odata WHERE kid=$kid")->fetch_assoc();

        $cycleCount = 0;

        if($oases['lasttrain'] == Config::getProperty('game', 'start_time')){
            $cycleCount = 7;
        }

        if ((time() - $oases['lastfarmed']) < 7200) {
            return;
        }
        $units = $db->query("SELECT * FROM units WHERE kid={$kid}");
        if (!$units->num_rows) {
            return;
        }

        $units = $units->fetch_assoc();

        $gameProgress = (time() - getGame('start_time')) / (getGame('round_length') * 86400);
        $maximum = 15;
        $sum = 0;
        for ($i = 1; $i <= 10; ++$i) {
            $sum += $units['u' . $i];
        }
        if ($sum >= $maximum) {
            return;
        }
        $troops = [
            2 => [5, 6, 7],
            3 => [5, 6, 7],
            4 => [5, 6, 7, 8],
            6 => [1, 2, 5],
            7 => [1, 2, 5],
            8 => [1, 2, 5, 8],
            10 => [1, 2, 4],
            11 => [1, 2, 4],
            12 => [1, 2, 4, 7],
            14 => [1, 3, 7, 9],
            15 => [1, 3, 7, 9],
        ][$oases['type']];
        if($cycleCount > 0){
            $num = $cycleCount;
        } else {
            $num = floor((time() - max($oases['lasttrain'], $oases['lastfarmed'])) / 7200);
        }
        for($i = 1; $i <= $num; ++$i){
            shuffle($troops);
            $unitId = $troops[mt_rand(0, sizeof($troops) - 1)];
            $amount = mt_rand(1, 3);
            $db->query("UPDATE units SET u{$unitId}=u{$unitId}+$amount WHERE kid=$kid");

            $sum += $amount;
            if ($sum >= $maximum) {
                break;
            }
        }

        if($num > 0){
            $db->query("UPDATE odata SET lasttrain=" . time() . " WHERE kid=$kid");
        }
    }

    public static function oasesTrainV2($kid)
    {
        $db = DB::getInstance();
        $oases = $db->query("SELECT type, lasttrain, lastfarmed, owner FROM odata WHERE kid=$kid")->fetch_assoc();
        $time = time();
        $tdiff = ($time - getGame('start_time')) / (getGame('round_length') * 86400);
        $tm = pow(getGameSpeed() * getGame('movement_speed_increase'), 1 / 5);
        $htc = round(500 * $tdiff * $tm);
        $htc = min($htc, 1100);
        //$htc = min(max($htc, 15), 1100);
        $tm = min(max($htc, 2), 3);
        $units = $db->query("SELECT * FROM units WHERE kid={$kid}");
        if (!$units->num_rows) {
            return;
        }
        $units = $units->fetch_assoc();
        $totc = 0;
        for ($i = 1; $i <= 10; $i++) {
            $totc += $units['u' . $i];
        }

        $cycleInterval = max(300, (28800 / (getGameSpeed()/* + getGame('movement_speed_increase')*/)));
        if ($totc < $htc) {
            $train = max($oases['lasttrain'], $oases['lastfarmed']);
            if ($train == 0)
                $train = time() - 2 * $cycleInterval;

            $trcount = round(($time - $train) / $cycleInterval);
            if ($trcount > 1) {
                $i = rand(1, 6);
                if ($units['u' . ($i)] < 10) {
                    $units['u' . ($i)] += rand(1, 3) * $trcount;
                } else if ($units['u' . ($i)] < 25 * $tm) {
                    $units['u' . ($i)] += rand(3, 5) * $trcount;
                } else {
                    $units['u' . ($i)] += 1 * $trcount;
                }
                for (; $i <= 10; $i++) {
                    if (isset($units['u' . ($i - 1)])) {
                        if ($units['u' . ($i - 1)] > 35 * $tm) {
                            $units['u' . $i] += round($units['u' . ($i - 1)] / 10);
                        } else if ($units['u' . ($i - 1)] > 25 * $tm) {
                            $units['u' . $i] += rand(1, 2);
                        } else if ($units['u' . ($i - 1)] > 10 * $tm) {
                            $units['u' . $i] += rand(0, 1);
                        }
                        $randShift = rand(10, 80) * $tm;
                        $rsh = rand(1, 40) * $tm;
                        if ($units['u' . ($i - 1)] > $randShift) {
                            $rsv = abs(round(($units['u' . ($i - 1)] - ($randShift + $rsh)) / 5));
                            $units['u' . $i] += $rsv;
                            $units['u' . ($i - 1)] -= ($randShift + $rsh);
                            $units['u' . ($i - 1)] = max(0, $units['u' . ($i - 1)]);
                        }
                    }
                }
                $q = null;
                for ($i = 1; $i <= 10; $i++) {
                    if (!empty($q))
                        $q .= ',';
                    $q .= "u{$i}={$units['u'. $i]}";
                }
                $db->query("UPDATE units SET $q WHERE kid=$kid");
                $db->query("UPDATE odata SET lasttrain=" . time() . " WHERE kid=$kid");
            }
        }
    }


    public static function oasesTrain($kid)
    {
        self::oasesTrainV3($kid);
        return true;
        if (getGameSpeed() <= 10) {
            return;
        }
        $db = DB::getInstance();
        $oases = $db->query("SELECT type, lasttrain, totalTrainCycles, owner FROM odata WHERE kid=$kid")->fetch_assoc();

        $rate = getGame('movement_speed_increase') * array_sum(Formulas::getOasisEffect($oases['type']));

        $rate = 1;

        $cycleInterval = max(50, 28800 / getGameSpeed());
        $baseCycle = 4;
        $totalCyclesPerRound = 1100;

        $passRate = max(getGameElapsedSeconds(), 0) / (getGame("round_length") * 86400);
        //cycles (3 times per day for 365 days) 9 times per day for 3x
        $currentCycle = $htc = max(floor($totalCyclesPerRound * $passRate), $baseCycle);
        if ($oases['totalTrainCycles'] == 0) {
            $htc = $baseCycle;
        }
        $tm = getGame('movement_speed_increase');

        $z = 1 / 365 * getGame("round_length");
        if (getGameSpeed() <= 10) {
            $z = 365 / getGameSpeed();
        }

        if (getGameElapsedSeconds() <= 10 * $z * 86400) {
            $tm *= 0.25;
        } else if (getGameElapsedSeconds() <= 20 * $z * 86400) {
            $tm *= 0.5;
        } else if (getGameElapsedSeconds() <= 30 * $z * 86400) {
            $tm *= 0.75;
        }
        if ((time() - $oases['lasttrain']) < $cycleInterval) {
            return false;
        }
        $total_cycles_count = $oases['totalTrainCycles'];
        $currentTroops = $db->query("SELECT * FROM units WHERE kid={$kid}");
        if (!$currentTroops->num_rows) {
            return false;
        }
        $currentTroops = array_filter_units($currentTroops->fetch_assoc());
        $trainCount = max($htc - $total_cycles_count, 0);
        $trained = false;
        if ($oases['owner'] == 0 && $trainCount >= 1) {
            $trained = true;
            $units = array_fill(1, 10, 0);
            $troops = [
                2 => [5, 6, 7],
                3 => [5, 6, 7],
                4 => [5, 6, 7, 8],
                6 => [1, 2, 5],
                7 => [1, 2, 5],
                8 => [1, 2, 5, 8],
                10 => [1, 2, 4],
                11 => [1, 2, 4],
                12 => [1, 2, 4, 7],
                14 => [1, 3, 7, 9],
                15 => [1, 3, 7, 9],
            ];
            for ($cycles = 0; $cycles <= $trainCount; ++$cycles) {
//                $totalTroops = mt_rand(3, 5);
//                foreach ($troops[$oases['type']] as $index => $nr) {
//                    $num = $currentTroops[$nr] + $units[$nr];
//                    if ($nr == 0 && $num <= 3 * $tm) {
//                        $units[$nr] += $totalTroops;
//                    } else if ($nr == 1 && $num <= 3 * $tm) {
//                        $units[$nr] += $totalTroops;
//                    }
//                }

                $i = $troops[$oases['type']][mt_rand(0, sizeof($troops[$oases['type']]) - 1)];
                $troopsCount = array_sum($currentTroops) + array_sum($units);
                if ($troopsCount < 12 * $tm) {
                    $units[$i] += $rate * mt_rand(1, 3);
                } else if ($troopsCount < 40 * $tm) {
                    $units[$i] += $rate * mt_rand(3, 5);
                }
                // Too many troops!
            }
            if (array_sum($units)) {
                $db->query("UPDATE units SET u1=u1+{$units[1]}, u2=u2+{$units[2]}, u3=u3+{$units[3]}, u4=u4+{$units[4]}, u5=u5+{$units[5]}, u6=u6+{$units[6]}, u7=u7+{$units[7]}, u8=u8+{$units[8]}, u9=u9+{$units[9]}, u10=u10+{$units[10]} WHERE kid=$kid");
            }
        }

        $db->query("UPDATE odata SET totalTrainCycles=$currentCycle, lasttrain=" . ($trained ? time() : $oases['lasttrain']) . " WHERE kid={$kid}");
        return true;
    }

    public static function getNearByFieldCropPercent($kid, $distance = 4.9497474683058326708059105347339)
    {
        $db = DB::getInstance();
        $xy = Formulas::kid2xy($kid);
        $ruler_x = $ruler_y = 7;
        $i = $xy['y'] + floor($ruler_y / 2);
        $percent = 0;
        $percents = [];
        while ($i >= $xy['y'] - floor($ruler_y / 2)) {
            $current_y = Formulas::coordinateFixer($i);
            $j = $xy['x'] - floor($ruler_x / 2);
            while ($j <= $xy['x'] + floor($ruler_x / 2)) {
                $current_x = Formulas::coordinateFixer($j);
                if (Formulas::getDistance(['x' => $current_x, 'y' => $current_y], $xy) <= $distance) {
                    $current_kid = Formulas::xy2kid($current_x, $current_y);
                    $oasisType = $db->fetchScalar("SELECT oasistype FROM wdata WHERE id=$current_kid");
                    if ($oasisType > 0) {
                        $effect = Formulas::getOasisEffect($oasisType);
                        if (is_array($effect) && array_key_exists(4, $effect)) {
                            $percents[] = 25 * $effect[4];
                        }
                    }
                }
                $j++;
            }
            --$i;
        }
        rsort($percents, SORT_NUMERIC);
        $x = 0;
        foreach ($percents as $p) {
            $x++;
            if ($x <= 3) {
                $percent += $p;
            }
        }
        return min($percent, 150);
    }

    public static function captureOasis($kid, $uid, $did)
    {
        $db = DB::getInstance();
        if(getCustom('removeVillageFromFarmListOnCapture')){
            $db->query("DELETE FROM raidlist WHERE kid=$kid");
        }
        $db->query("UPDATE odata SET did=$did, owner=$uid, loyalty=100, conquered_time=" . time() . ", last_loyalty_update=" . time() . " WHERE kid=$kid");
        $db->query("UPDATE wdata SET occupied=1 WHERE id=$kid");
        Map::OccupyOrLeaveOasisCacheRemove($kid);
        ResourcesHelper::updateVillageResources($did, false);
    }

    public static function releaseOasis($kid, $did)
    {
        $db = DB::getInstance();
        $db->query("UPDATE odata SET owner=0, did=0, lasttrain=" . time() . ", last_loyalty_update=" . time() . " WHERE kid=$kid");
        $db->query("UPDATE wdata SET occupied=0 WHERE id=$kid");
        Map::OccupyOrLeaveOasisCacheRemove($kid);
        ResourcesHelper::updateVillageResources($did, false);
    }

    public function updateResources($kid)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT lastmupdate, kid, type, wood, clay, iron, crop, did FROM odata WHERE kid=$kid");
        if (!$row->num_rows) {
            return false;
        }
        $row = $row->fetch_assoc();
        if ($row['did']) {
            return false;
        }
        $cur_res = [$row['wood'], $row['clay'], $row['iron'], $row['crop']];
        $production = Formulas::getOasisProduction($row['type']);
        $lastmupdate = miliseconds();
        $diff_time = $lastmupdate - $row['lastmupdate'];
        $resources = [
            ($production[0] / 3600000) * $diff_time,
            ($production[1] / 3600000) * $diff_time,
            ($production[2] / 3600000) * $diff_time,
            ($production[3] / 3600000) * $diff_time,
        ];
        $maxStore = Formulas::getOasisStorage($row['type']);
        foreach ($resources as $key => $res) {
            $nextValue = $res + $cur_res[$key];
            if ($nextValue >= $maxStore) {
                $resources[$key] = $maxStore - $cur_res[$key];
            }
            $resources[$key] = round($resources[$key], 4);
        }
        $db->query("UPDATE odata SET wood=wood+{$resources[0]}, clay=clay+{$resources[1]}, iron=iron+{$resources[2]}, crop=crop+{$resources[3]}, lastmupdate=$lastmupdate WHERE kid={$row['kid']}");
        return true;
    }

    public function isOasis($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT oasistype FROM wdata WHERE id=$kid") > 0;
    }

    public function isOasisConqured($kid)
    {
        return $this->getOasisCaptureKid($kid) > 0;
    }

    public function getOasisCaptureKid($kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT did FROM odata WHERE kid=$kid");
    }


} 