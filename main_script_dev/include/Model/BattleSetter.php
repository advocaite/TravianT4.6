<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\Formulas;
use Game\ResourcesHelper;
use Game\Starvation;
use function logError;

class BattleSetter
{
    public function getUnits($kid, $oasis = false)
    {
        $db = DB::getInstance();
        $smithy = $db->query("SELECT * FROM units WHERE kid=$kid");
        if (!$smithy->num_rows) {
            return array_fill(1, 11, 0);
        }
        return array_filter_units($smithy->fetch_assoc());
    }

    public function getOwner($kid)
    {
        $db = DB::getInstance();
        $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
        if (!$uid) {
            return 0;
        }
        return $uid;
    }

    public function getUser($uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT id, aid, goldclub, alliance_join_time, race, cp, name, escape, total_pop, atkBonusExpireTime, defBonusExpireTime FROM users WHERE id=$uid");
        if (!$find->num_rows) {
            return [
                "id"     => NULL,
                "aid"    => NULL,
                "race"   => NULL,
                "name"   => NULL,
                "escape" => FALSE,
            ];
        }
        return $find->fetch_assoc();
    }

    public function getVillageState($kid)
    {
        $db = DB::getInstance();
        $status = $db->query("SELECT fieldtype, oasistype, landscape, occupied FROM wdata WHERE id={$kid} AND (occupied=1 OR oasistype>0)");
        if (!$status->num_rows) {
            return false;
        }
        return $status->fetch_assoc();
    }

    public function is_great_celebration_running($kid)
    {
        $db = DB::getInstance();
        $village = $db->query("SELECT celebration, type FROM vdata WHERE kid=$kid")->fetch_assoc();
        if ($village['celebration'] > time() && $village['type'] == 2) {
            return TRUE;
        }

        return FALSE;
    }

    public function demolish($lvl, $units, $upg_lvl, $race_durab, $durability_other)
    {
        if ($durability_other != 1) {
            $units = floor($units / $durability_other);
        }
        $units *= $this->bonusCatsRams($upg_lvl);
        $effective_number = (8 * $units - 1) / $race_durab;
        if ($effective_number <= 0) {
            return $lvl;
        } else if ($effective_number > $lvl * ($lvl + 1)) {
            return 0;
        } else {
            return round(sqrt(pow($lvl + 0.5, 2) - $effective_number));
        }
    }

    function bonusCatsRams($lvl)
    {
        return round(2 * pow(1.0205, $lvl), 2) / 2;
    }

    function early_ramming($lvl, $units, $percent, $upg_lvl, $durability, $race_dur)
    {
        if ($durability != 1) {
            $units = floor($units / $durability);
        } // crazy stone
        $points = $units * $this->bonusCatsRams($upg_lvl) * 4 * $percent - 0.5;
        $lvl2 = floor($lvl / 2);
        $pt = [0];
        for ($i = 1; $i <= $lvl2; $i++) {
            $pt[$i] = $pt[$i - 1] + 3 + $lvl * 2 - $i * 4;
        }
        $pt[(int)$lvl2 + 1] = $pt[(int)$lvl2] + 20 + $lvl - 2 * $lvl2;
        $delta = 51;
        for ($i = $lvl2 + 2; $i <= $lvl; $i++) {
            $pt[(int)$i] = $pt[(int)$i - 1] + $delta;
            $delta += 2.5;
        }
        for ($i = 1; $i <= $lvl; $i++) {
            $pt[$i] = floor($pt[$i] * $race_dur);
        }
        $pt [] = 1E99; // some very large number
        $idx = 1;
        while ($points >= $pt[$idx]) {
            $idx++;
        }

        return $lvl - $idx + 1;
    }

    public function sigma($x)
    {
        return $x >= 1 ? 1 - 0.5 / $x : 0.5 * $x;
    }

    public function remorale($off, $def, $pop, $wall)
    {
        $pts = round($off) / round($def * $wall);
        $morale = round(pow($pop, -0.2 * min($pts, 1)), 3);
        return $pts * $this->limit(0.667, $morale, 1.0);
    }

    public function limit($low, $value, $high)
    {
        if ($value < $low) {
            return $low;
        }
        if ($value > $high) {
            return $high;
        }

        return $value;
    }

    public function calc_diffusion($troops_amount)
    {
        $n = 2 * round(1.8592 - pow($troops_amount, 0.015), 4);
        return $this->limit(1.2578, $n, 1.5);
    }

    public function adduced_def($def_i, $def_c, $off_i, $off_c)
    {
        $off = $off_i + $off_c;
        if ($off) {
            $ip = round($off_i / $off, 4);
            $cp = round($off_c / $off, 4);
        } else {
            $ip = 0.5;
            $cp = 0.5;
        }
        return ($def_i * $ip + $def_c * $cp);
    }

    public function getHero($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM hero WHERE uid=$uid LIMIT 1")->fetch_assoc();
    }

    public function get_building_lvl($kid, $gid, $buildings = NULL)
    {
        if (is_array($buildings)) {
            for ($i = 19; $i <= 38; ++$i) {
                if ($buildings[$i]['item_id'] == $gid) {
                    return $buildings[$i]['level'];
                }
            }

            return 0;
        }
        $db = DB::getInstance();
        $buildings = $db->query("SELECT f19, f19t, f20, f20t, f21, f21t, f22, f22t, f23, f23t, f24, f24t, f25, f25t, f26, f26t, f27, f27t, f28, f28t, f29, f29t, f30, f30t, f31, f31t, f32, f32t, f33, f33t, f34, f34t, f35, f35t, f36, f36t, f37, f37t, f38, f38t FROM fdata WHERE kid=$kid")->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == $gid) {
                return $buildings['f' . $i];
                break;
            }
        }

        return 0;
    }

    public function common_morale($pop)
    {
        $value = round(pow($pop, -0.2), 3);
        if ($value < 0.667) {
            $value = 0.667;
        }
        if ($value > 1.0) {
            $value = 1.0;
        }

        return $value;
    }

    public function int_check_limit($arr, $name, $low, $high)
    {
        if (!array_key_exists($name, $arr)) {
            return $low;
        }

        return $this->limit($low, $high, (int)$arr[$name]);
    }

    public function move_to_traps(&$units, &$traps)
    {
        $len = count($units);
        $atkrs_total = array_sum($units);
        $used_traps = min($traps, $atkrs_total);
        $trapped = [];
        $tr = 0;
        for ($u = 1; $u <= $len; $u++) {
            if (!isset($units[$u])) {
                continue;
            }
            $tr += $trapped[$u] = floor($units[$u] * $used_traps / $atkrs_total);
        }
        for ($u = 1; $u <= $len; $u++) {
            if ($tr == $used_traps) {
                break;
            }
            if ($units[$u]) {
                $trapped[$u]++;
                $tr++;
            }
        }
        for ($u = 1; $u <= $len; $u++) {
            if (!isset($units[$u])) {
                continue;
            }
            $units[$u] -= $trapped[$u];
        }
        $traps -= array_sum($trapped);

        return $trapped;
    }

    public function art_effect($value, $limit)
    {
        $value = $this->limit(-$limit, $value, $limit);
        if ($value == 0) {
            return 1;
        }

        return $value;
    }

    public function stat_with_upg($stat, $upkeep, $lvl)
    {
        if ($lvl <= 0) return $stat;
        $upkeep /= 1.007;

        return round($stat + ($stat + 300 * $upkeep / 7) * (pow(1.007, $lvl) - 1) + $upkeep * 0.0021, 4);
    }

    public function move_to_cages($units, $cages, &$caged)
    {
        $UNITS = isset($units[11]) ? 11 : 10;
        $total = array_sum($units);
        if ($cages >= $total) {
            $caged = $units;

            return;
        }
        $remainder = [];
        for ($u = 1; $u <= $UNITS; $u++) {
            if (isset($units[$u]) && $units[$u]) {
                $remainder[$u] = $units[$u];
            }
        }
        $len = count($remainder);
        $min = min($remainder);
        while ($len and $len * $min < $cages) {
            $cages -= $len * $min;
            foreach ($remainder as $idx => $value) {
                if (!isset($remainder[$idx])) {
                    continue;
                }
                $remainder[$idx] -= $min;
                $caged[$idx] += $min;
            }
            $key = array_search(0, $remainder);
            do {
                unset($remainder[$key]);
                $len--;
                $key = array_search(0, $remainder);
            } while ($key !== FALSE);
            //echo "$cages, $len, $min<br/>";
            $min = min($remainder);
        }
        if ($cages > 0 and $min != 0) {
            $n = floor($cages / $len);
            $d = $cages - $len * $n;
            foreach ($remainder as $idx => $value) {
                $nn = $n;
                if (--$d >= 0) {
                    $nn++;
                }
                $remainder[$idx] -= $nn;
                $caged[$idx] += $nn;
            }
        }
    }

    public function escape_units($kid, $end_time, &$wave, $isZeroPop)
    {
        $return = false;
        $db = DB::getInstance();
        $escape = -1;
        if (!array_sum($wave['units']['num'])) {
            return $escape;
        }
        $info = $db->query("SELECT lastReturn, capital FROM vdata WHERE kid=$kid")->fetch_assoc();
        if (getGame('checkLastReturnForEvasion')) {
            $return = !($info['lastReturn'] == 0) && abs(($end_time / 1000) - $info['lastReturn']) <= 10;
            //check for last troop return.
        }
        if (!$info['capital'] && !Config::getProperty("custom", "allowEvasionForAllVillages")) {
            return 1;
            //no escape because it's not ur capital village!.
        } else if ($return) {
            return 2;
            //you have returning troops within 10 seconds.
        } else if (!$this->checkEscapeState($kid)) {
            return 3; // escape was not enabled
        } else if ($isZeroPop && getCustom("disableEscapeOnVillageZeroPop")) {
            return 4; // your pop is 0
        }
        $move = new MovementsModel();
        $seconds = Config::getInstance()->game->evasion_time;
        $move->addMovement($kid,
            0,
            $wave['race'],
            $wave['units']['num'],
            0,
            0,
            0,
            0,
            0,
            MovementsModel::ATTACKTYPE_EVASION,
            $end_time,
            $end_time + $seconds * 1000);
        $wave['units']['num'] = array_fill(1, 11, 0);
        $modify = [];
        for ($i = 1; $i <= 11; ++$i) {
            $modify[] = "u{$i}=0";
        }
        $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid={$kid}");
        //no report!
        return 0;
    }

    public function checkEscapeState($kid)
    {
        if (!Config::getProperty("custom", "allowEvasionForAllVillages")) {
            return true;
        }
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT evasion FROM vdata WHERE kid=$kid") == 1;
    }

    public function is_capital($kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT capital FROM vdata WHERE kid=$kid") == 1;
    }

    public function getTraps($kid)
    {
        $db = DB::getInstance();
        $smithy = $db->query("SELECT u99 FROM units WHERE kid=$kid");
        if (!$smithy->num_rows) {
            return 0;
        }

        return $smithy->fetch_assoc()['u99'];
    }

    public function getFilledTrapCount($kid)
    {
        $db = DB::getInstance();

        return (int)$db->fetchScalar("SELECT SUM(u1)+SUM(u2)+SUM(u3)+SUM(u4)+SUM(u5)+SUM(u6)+SUM(u7)+SUM(u8)+SUM(u9)+SUM(u10)+SUM(u11) FROM trapped WHERE to_kid=$kid");
    }

    public function getDefenderBuildings($kid, &$defender, $race)
    {
        $totalTraps = 0;
        $defender['totalCranny'] = 0;
        $defender['hdp'] = 0;
        $defender['rallyPoint'] = 0;
        $defender['storeIds'] = [];
        $defender['crannyIds'] = [];
        $defender['buildings'] = (new VillageModel())->getBuildingsAssoc($kid);
        if (!sizeof($defender['buildings'])) {
            logError("No defender buildings.");
        }
        for ($i = 19; $i <= 40; ++$i) {
            if (!isset($defender['buildings'][$i])) return FALSE;
            $build = $defender['buildings'][$i];
            if ($build['item_id'] == 34) {
                $defender['stone'] = $build['level'];
            } else if (in_array($build['item_id'], [25, 26, 44])) {
                $defender['rp'] = $build['level'];
            } else if ($i == 40) {
                $defender['wall'] = $build['level'];
            } else if ($race == 3 && $build['item_id'] == 36) {
                $totalTraps += Formulas::trapperValue($build['level']);
            } else if ($build['item_id'] == 23) {
                $defender['crannyIds'][] = $i;
                $defender['totalCranny'] += Formulas::crannyCAP($build['level'], $race);
            } else if ($build['item_id'] == 10 || $build['item_id'] == 38 || $build['item_id'] == 11 || $build['item_id'] == 39) {
                $defender['storeIds'][] = $i;
            } else if ($build['item_id'] == 41) {
                $defender['hdp'] = $build['level'];
            } else if ($build['item_id'] == 16) {
                $defender['rallyPoint'] = $build['level'];
            }
        }
        return $totalTraps;
    }

    public function modifyVillageResources($kid, $cost, $mode = 0)
    {
        $db = DB::getInstance();
        if ($mode == 0) {
            $db->query("UPDATE vdata SET wood=wood-{$cost[0]}, clay=clay-{$cost[1]}, iron=iron-{$cost[2]}, crop=crop-{$cost[3]} WHERE kid=$kid");
        } else {
            $db->query("UPDATE vdata SET wood=wood+{$cost[0]}, clay=clay+{$cost[1]}, iron=iron+{$cost[2]}, crop=crop+{$cost[3]} WHERE kid=$kid");
        }
    }

    public function modifyOasisResources($kid, $cost, $mode = 0)
    {
        $db = DB::getInstance();
        if ($mode == 0) {
            $db->query("UPDATE odata SET wood=wood-{$cost[0]}, clay=clay-{$cost[1]}, iron=iron-{$cost[2]}, crop=crop-{$cost[3]} WHERE kid=$kid");
        } else {
            $db->query("UPDATE odata SET wood=wood+{$cost[0]}, clay=clay+{$cost[1]}, iron=iron+{$cost[2]}, crop=crop+{$cost[3]} WHERE kid=$kid");
        }
    }

    public function getInventory($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT leftHand, rightHand, body, shoes, horse, bag, helmet FROM inventory WHERE uid=" . $uid)->fetch_assoc();
    }

    public function getAttackerNeededBuildings($kid)
    {
        $result = [14 => 0, 37 => 0, 27 => 0, 41 => 0];
        $count = 4;
        $db = DB::getInstance();
        $buildings = $db->query("SELECT f19, f19t, f20, f20t, f21, f21t, f22, f22t, f23, f23t, f24, f24t, f25, f25t, f26, f26t, f27, f27t, f28, f28t, f29, f29t, f30, f30t, f31, f31t, f32, f32t, f33, f33t, f34, f34t, f35, f35t, f36, f36t, f37, f37t, f38, f38t FROM fdata WHERE kid=$kid")->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            $item_id = $buildings['f' . $i . 't'];
            $level = $buildings['f' . $i];
            if ($item_id == 14 || $item_id == 37 || $item_id == 27 || $item_id == 41) {
                $result[$item_id] = $level;
                --$count;
            }
            if (!$count) break;
        }
        return $result;
    }

    public function getFullUnits($kid, $units, $isAttacker = FALSE)
    {
        $tmp['num'] = $units;
        $tmp['smithy'] = $this->getSmithy($kid);
        $tmp['dead'] = array_fill(1, 11, 0);
        if ($isAttacker) {
            $tmp['trapped'] = array_fill(1, 11, 0);
        }
        return $tmp;
    }

    public function getSmithy($kid)
    {
        $db = DB::getInstance();
        $smithy = $db->query("SELECT * FROM smithy WHERE kid=$kid");
        if (!$smithy->num_rows) {
            return array_fill(1, 10, 0);
        }

        return array_filter_units($smithy->fetch_assoc());
    }

    public function getEnforcement($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM enforcement WHERE to_kid=$kid");
    }

    public function getProtectingArtifacts($uid, $kid)
    {
        $result = [];
        if (!ArtefactsModel::artifactsReleased()) {
            return $result;
        }
        $db = DB::getInstance();
        $stmt = $db->query("SELECT num, type, size FROM artefacts WHERE uid=$uid AND IF(size=1, kid=$kid, true) AND active=1 AND status=1 AND effecttype=" . ArtefactsModel::ARTIFACT_CRANNY . " ORDER BY size ASC LIMIT 1");
        if ($stmt->num_rows) {
            $artifact = $stmt->fetch_assoc();
            $result[] = ['type' => $artifact['type'], 'size' => $artifact['size'], 'num' => $artifact['num']];
        }
        $stmt = $db->query("SELECT num, type, size FROM artefacts WHERE uid=$uid AND IF(size=1, kid=$kid, true) AND active=1 AND status=1 AND effecttype=" . ArtefactsModel::ARTIFACT_INCREASE_BUILDINGS_STABILITY . " ORDER BY size ASC LIMIT 1");
        if ($stmt->num_rows) {
            $artifact = $stmt->fetch_assoc();
            $result[] = ['type' => $artifact['type'], 'size' => $artifact['size'], 'num' => $artifact['num']];
        }
        return $result;
    }

    public function randomTargetArtifact($uid, $kid)
    {
        if (!ArtefactsModel::artifactsReleased()) {
            return false;
        }
        $db = DB::getInstance();
        $size = $db->fetchScalar("SELECT size FROM artefacts WHERE uid=$uid AND IF(size=1, kid=$kid, true) AND active=1 AND status=1 AND type=" . ArtefactsModel::ARTIFACT_CRANNY . " ORDER BY size ASC LIMIT 1");
        if (!$size) {
            return false;
        }
        return $size;
    }
}