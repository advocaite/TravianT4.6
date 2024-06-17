<?php

namespace Controller\RallyPoint;

use Core\Config;
use Game\Formulas;

class Simulator
{
    const BASE_VILLAGE_DEF = 10;
    const SCOUT_DEF = 20;
    const SCOUT_OFF = 35;
    const LONE_ATTACKER_THRESHOLD = 84;
    protected $off                  = [
        [0 => 40, 30, 70, 0, 120, 180, 60, 75, 50, 0], //Roman
        [0 => 40, 10, 60, 0, 55, 150, 65, 50, 40, 10], //Teuten
        [0 => 15, 65, 0, 90, 45, 140, 50, 70, 40, 0], // Gual
        [0 => 10, 20, 60, 80, 50, 100, 250, 450, 200, 600],
        [0 => 20, 65, 100, 0, 155, 170, 250, 60, 80, 30],
        [0 => 10, 30, 65, 0, 50, 110, 55, 65, 40, 0],
        [0 => 35, 50, 0, 120, 115, 180, 65, 45, 40, 0],
    ];
    protected $def_i                = [
        [0 => 35, 65, 40, 20, 65, 80, 30, 60, 40, 80],
        [0 => 20, 35, 30, 10, 100, 50, 30, 60, 60, 80],
        [0 => 40, 35, 20, 25, 115, 50, 30, 45, 50, 80],
        [0 => 25, 35, 40, 66, 70, 80, 140, 380, 170, 440],
        [0 => 35, 30, 90, 10, 80, 140, 120, 45, 50, 40],
        [0 => 30, 55, 50, 20, 110, 120, 30, 55, 50, 80],
        [0 => 40, 30, 20, 30, 80, 60, 30, 55, 50, 80],
    ];
    protected $def_c                = [
        [0 => 50, 35, 25, 10, 50, 105, 75, 10, 30, 80],
        [0 => 5, 60, 30, 5, 40, 75, 80, 10, 40, 80],
        [0 => 50, 20, 10, 40, 55, 165, 105, 10, 50, 80],
        [0 => 20, 40, 60, 50, 33, 70, 200, 240, 250, 520],
        [0 => 50, 10, 75, 0, 50, 80, 150, 10, 50, 40],
        [0 => 20, 40, 20, 10, 50, 150, 95, 10, 50, 80],
        [0 => 30, 10, 10, 15, 70, 40, 90, 10, 50, 80],
    ];
    private   $mode                 = 4; // 9 is special server | 4 is T4 | 3 is T3 | 2 is T2
    protected $wall_durability      = [0 => 1, 1 => 5, 2 => 2, 3 => 1, 4 => 1, 5 => 5, 6 => 1];
    protected $wall_base            = [0 => 1.03, 1 => 1.02, 2 => 1.025, 3 => 1, 4 => 1.03, 5 => 1.025, 6 => 1.015];
    protected $wall_extra           = [
        0 => 10,
        1 => 6,
        2 => 8,
        3 => 0,
        4 => 10,
        5 => 8,
        6 => 6
    ]; //TODO: Huns wall needs update
    protected $administrator_effect = [
        0 => [20, 30],
        1 => [20, 25],
        2 => [20, 25],
        3 => [0, 0],
        4 => [200, 200],
        5 => [20, 25],
        6 => [20, 25]
    ];
    protected $upkeep               = [
        [0 => 1, 1, 1, 2, 3, 4, 3, 6, 5, 1, 6],
        [0 => 1, 1, 1, 1, 2, 3, 3, 6, 4, 1, 6],
        [0 => 1, 1, 2, 2, 2, 3, 3, 6, 4, 1, 6],
        [0 => 1, 1, 1, 1, 2, 2, 3, 3, 3, 5, 0],
        [0 => 1, 1, 1, 1, 2, 3, 6, 5, 0, 0, 6],
        [0 => 1, 1, 1, 2, 2, 3, 3, 6, 4, 1, 6],
        [0 => 1, 1, 2, 2, 2, 3, 3, 6, 4, 1, 6],
    ];
    protected $is_cavalary          = [
        [3 => 1, 4 => 1, 5 => 1],
        [3 => 1, 4 => 1, 5 => 1],
        [2 => 1, 3 => 1, 4 => 1, 5 => 1],
        [],
        [4 => 1, 5 => 1],
        [3 => 1, 4 => 1, 5 => 1],
        [3 => 1, 4 => 1, 5 => 1],
    ];

    public function __construct()
    {
    }

    public function init($data)
    {
        /*$data = array(
            "R" => false, //is Raid
        "attacker" => array("kid" => "")
            "trapped2killed" => array(),
            "defender" => array(
                "r" => 1-1, //race - 1
                "t" => 86400, //traps
                "p" => 100, //pop
                "rpLevel" => 20, //residence palace level
                "wLevel" => 0, //wall level
                "stone" => 0, //stemez level
                "artifacts" => array(
                    "durability" => 0, //Durability artifact effect ;)
                    "scout" => 0, //Durability artifact effect ;)
                ),
            ),
            "waves" => array() //$no_morale isWW
        );*/
        $pob = $this->int_check_limit($data['defender'], 'r', 0, 7);
        if ($pob == 3) {
            $data['defender']['t'] = $this->int_check_limit($data['defender'],
                "t",
                0,
                8400 * Config::getProperty("game", "trap_multiplier"));
        } else {
            $data['defender']['t'] = 0;
        }
        $trapped2killed = isset($data['trapped2killed']) ? $data['trapped2killed'] : [];
        $def_pop = $this->int_check_limit($data['defender'], "p", 1, 1e8);
        if ($pob == 4) $def_pop = 500;
        $rp_lvl = $this->int_check_limit($data['defender'], 'rpLevel', 0, 20);
        $wl = $this->int_check_limit($data['defender'], 'wLevel', 0, 20);
        $wall_dur = $this->wall_durability[$pob];
        $wall_b = $this->wall_base[$pob];
        $stone = 1 + $this->int_check_limit($data['defender'], 'stone', 0, 20) / 10;
        if (!isset($data['defender']['artifacts'])) {
            $data['defender']['artifacts'] = ["durability" => 0, 'scout' => 0];
        }
        $art_dur = $this->art_effect($data['defender']['artifacts'], 'durability', 10);
        $art_scout_def = $this->art_effect($data['defender']['artifacts'], 'scout', 10);
        if ($art_dur < 0) {
            $art_dur = -1 / $art_dur;
        }
        if ($art_dur == 0) {
            $art_dur = 1;
        }
        //Natars in v < 4 does not have wall :|
        if ($pob == 4 and $this->mode < 4) {
            $wl = 0;
            $stone = min($data['defender']['stone'], 1);
        }
        $def_nature_only = TRUE;
        foreach ($data['waves'] as $idx => $wave) {
            if ($wave['r'] <> 3 && $wave['side'] == "def") {
                $def_nature_only = FALSE;
                break;
            }
        }
        $report = [];
        $def_armies = [];
        foreach ($data['waves'] as $idx => $wave) {
            $no_morale = isset($wave['isWW']);
            for ($u = 0; $u < 10; $u++) {
                $wave['u'][$u] = $this->int_check_limit($wave['u'], $u, 0, 1e99);
            }
            if ($wave['side'] == "off") { // no more than
                $wave['u'][8] = min($wave['u'][8], 3); // 3 senators
                $wave['u'][9] = min($wave['u'][9], 9); // 9 settlers
            }
            // add hero to units
            if (!isset($wave['u'][10]) || !$wave['u'][10]) {//fixed.
                $wave['u'][10] = isset($wave['h']) && $wave['h'] ? 1 : 0;
            }
            $wave['r'] = $r = $this->int_check_limit($wave, 'r', 0, 7);
            // no hero for nature or T2.5
            if ($r > 2 or $this->mode == 2) {
                $wave['u'][10] = 0;
            }
            if ($wave['side'] == "def") {
                $def_armies[$idx] = $wave;
            }
            //last one is always offense units process over here
            if ($wave['side'] == "off") {
                $tr = array_fill(0, 11, 0);
                // cages
                //if is cage attack to an unoccupied oasis let's capture units and let the process free
                if ($data['defender']['r'] == 3 && $def_nature_only && $wave['u'][10] > 0 && $this->mode == 4 && $wave['hero']['cages']) {
                    $cages = $this->int_check_limit($wave['hero']['cages'], 3, 0, 1e8); //actually no limit :|
                    $caged = array_fill(0, 10, 0);
                    $total = array_fill(0, 10, 0);
                    foreach ($def_armies as $army) {
                        for ($u = 0; $u < 10; $u++) {
                            $total[$u] += $army['u'][$u];
                        }
                    }
                    $this->move_to_cages($total, $cages, $caged);
                    $this->finalize_losses($report, $def_armies, 0, 0, $wave, $tr, [], ['caged' => $caged]);
                    for ($u = 0; $u < 10; $u++) {
                        if (!$caged[$u]) {
                            continue;
                        }
                        foreach ($def_armies as $idxx => &$army) {
                            if ($caged[$u] < $army['u'][$u]) {
                                $army['u'][$u] -= $caged[$u];
                                $caged[$u] = 0;
                                break;
                            } else {
                                $caged[$u] -= $army['u'][$u];
                                $army['u'][$u] = 0;
                            }
                        }
                    }
                    continue;
                }
                $off_pop = $this->int_check_limit($wave, 'p', 1, 199999);
                $def_pop = max($def_pop, 1);
                $pop_ratio = $off_pop / $def_pop;
                if (getGame("ignoreMoralPointsInAttacks")) {
                    $pop_ratio = 1;
                }
                // check for recon. operation
                $sui = Formulas::getSpyId($r + 1) - 1;
                if ($sui > 0 and array_sum($wave['u']) == $wave['u'][$sui]) {
                    $offense = $wave['u'][$sui] * $this->stat_with_upg(self::SCOUT_OFF,
                            $this->upkeep[$r][$sui],
                            $wave['U'][$sui]);
                    $offense *= $this->art_effect($wave, 'S', 10) * ($no_morale ? 1 : $this->common_morale($pop_ratio));
                    $defense = 0;
                    foreach ($def_armies as $army) {
                        $r = $army['r'];
                        $sui = Formulas::getSpyId($r + 1) - 1;
                        if ($sui < 0) {
                            continue;
                        }
                        $defense += $army['u'][$sui] * $this->stat_with_upg(self::SCOUT_DEF,
                                $this->upkeep[$r][$sui],
                                $army['U'][$sui]);
                    }
                    $defense *= $art_scout_def * round(pow($wall_b, $wl), 3); // wall
                    if ($defense == 0) {
                        $off_losses = 0;
                    } else {
                        $x = pow($offense / $defense, 1.5);
                        $off_losses = $x ? min(1 / $x, 1) : 1;
                    }
                    $this->finalize_losses($report, $def_armies, $off_losses, 0, $wave, $tr, ["isSpy" => TRUE]);
                    continue;
                }
                // init
                $b_lvls = $this->target_levels($wave);
                $info = [];
                $lone_attacker = array_sum($wave['u']) == 1;
                $wave['x'] = $this->int_check_limit($wave, 'x', 1, 21);
                /*
                if ($wave['x'] > 1) {
                    $wave['x']--;
                    $w--;
                }
                */
                //offense troops got trapped buddy :|
                if ($data['defender']['t'] and $this->mode >= 3) {
                    $tr = $this->move_to_traps($wave['u'], $data['defender']['t']);
                }
                if (array_sum($tr)) {
                    ///a little change here for unique IDs in freeing trapped
                    $trapped2killed[($data['attacker']['kid'])] = $tr;
                }
                $offense = $this->calc_offense($wave);
                if ($pob == 4) {
                    $offense['b'] *= 1 + $offense['n'] / 100; // natarian horns
                    $offense['b'] *= 1.015; // correction factor of unknown origin
                }
                /*
                if ($w == 2) { $offense['b'] *= 1.01518367; } // 1.015182-4
                if ($w == 3) { $offense['b'] *= 1.015327; } // 1.015323-31
                if ($w == 4) { $offense['b'] *= 1.015782; }  // 1.015781-4
                if ($w == 5) { $offense['b'] *= 1.0151; }  // 1.0149-53
                */
                $this->finalize_stats($offense);
                if (!$offense['t']) {
                    //no offense power :|
                    if (array_sum($tr)) {
                        $this->finalize_losses($report, $def_armies, 0, 0, $wave, $tr, ['none_return' => ['']]);
                        continue;
                    }
                    //trigger_error("zero offense", E_USER_ERROR);
                }
                $defense = $this->calc_total_defense($def_armies);
                $this->finalize_stats($defense);
                $total = array_sum($wave['u']);
                foreach ($def_armies as $army) {
                    $total += array_sum($army['u']);
                }
                $immensity = $this->calc_diffusion($total);
                // adduced defense
                $ip = round($offense['i'] / $offense['t'], 4);
                $cp = round($offense['c'] / $offense['t'], 4);
                $defense['t'] = ($defense['i'] * $ip + $defense['c'] * $cp);
                if ($pob != 3) {
                    $defense['t'] += 2 * pow($rp_lvl, 2);
                }
                $defense['t'] += 10;
                if ($this->mode == 4) {
                    $defense['t'] += $this->wall_extra[$pob] * $wl;
                }
                $wall_bonus = round(pow($wall_b, $wl), 3);
                // si-si, russo matroso, oblique amorale
                $pts_ratio = $this->remorale($offense['t'], $defense['t'], $no_morale ? 1 : $pop_ratio, $wall_bonus);
                $x = pow($pts_ratio, $immensity);
                // raid
                if ($data['R'] == TRUE) {
                    $off_losses = 1 / (1 + $x);
                    $def_losses = $x / (1 + $x);
                    if ($lone_attacker && $this->lone_dies($offense, $pop_ratio)) {
                        $off_losses = 1;
                    }
                    $this->finalize_losses($report, $def_armies, $off_losses, $def_losses, $wave, $tr);
                    continue;
                }
                // normal losses
                $off_losses = $x ? min(1 / $x, 1) : 1;
                $def_losses = min($x, 1);

                $siege_percent = $this->sigma(pow($pts_ratio, 1.5));
                $d = $stone * $art_dur;
                // using rams
                if ($wave['u'][6] && $wl) { //if attacker has ram and defender had wall
                    $up = $wave['U'][6];
                    $rams = $wave['u'][6];
                    $mwl = $this->early_ramming($wl, $rams, $siege_percent, $up, $d, $wall_dur);
                    // recalc wall effect
                    $wall_bonus = round(pow($wall_b, $mwl), 3);
                    $pts_ratio = $this->remorale($offense['t'],
                        $defense['t'],
                        $no_morale ? 1 : $pop_ratio,
                        $wall_bonus);
                    $siege_percent = $this->sigma(pow($pts_ratio, 1.5));
                    $x = pow($pts_ratio, $immensity);
                    // get final wall level
                    $rams = $this->sigma(pow($pts_ratio, $immensity)) * $wave['u'][6];
                    $off_losses = min(1 / $x, 1);
                    $def_losses = min($x, 1);
                    $info['wall'] = [$wl]; //from level
                    $wl = $this->demolish($wl, $rams, $up, $wall_dur, $d);
                    $info['wall'][1] = $wl; //to level
                }
                // using cats
                if ($wave['u'][7] && $b_lvls[0]) { //if has ram and target is selected
                    $info['bl'] = [];
                    $up = $wave['U'][7];
                    $moral = $no_morale ? 1 : $this->limit(0.333, pow($pop_ratio, -0.3), 1);
                    $cats = $wave['u'][7] * $siege_percent * $moral;
                    if ($b_lvls[1] and $wave['u'][7] >= 20) { // two targets
                        $cats /= 2;
                        $info['bl'] = [0, 0, $b_lvls[1], $this->demolish($b_lvls[1], $cats, $up, 1, $d),];
                    }
                    // one target always
                    $info['bl'][0] = $b_lvls[0]; //from level
                    // WW ignores durability artifacts effect
                    if (isset($wave['isWW'])) {
                        $d /= $art_dur;
                    }
                    $info['bl'][1] = $this->demolish($b_lvls[0], $cats, $up, 1, $d); //to level
                }
                $alive_admins = round($wave['u'][8] * (1 - $off_losses));
                //just if not have palace or residence :|
                //get residence level in outher battle ;)
                if ($alive_admins && $r < 3) {
                    $af = $this->administrator_effect[$r];
                    $moral_bonus = $no_morale ? 1 : $this->common_morale($pop_ratio);
                    $ld = (empty($data['defender']['bigParty']) ? 0 : 5) - (empty($data['defender']['bigParty']) ? 0 : 5);
                    $c = $moral_bonus * $alive_admins / (empty($wave["B"]) || ($r != 1) ? 1 : 2);
                    $info['loy'] = [
                        round(($af[0] + $ld) * $c), //min
                        round(($af[1] + $ld) * $c) //max
                    ];
                }
                if ($lone_attacker and $this->lone_dies($offense, $pop_ratio)) {
                    $off_losses = 1;
                }
                //free own or alliance trapped units :|
                if (!empty($trapped2killed) and $off_losses < 1) {
                    $info['free'] = [];
                    if ($this->mode == 4) {
                        foreach ($trapped2killed as $trapped_unique => $trapped_wave) {
                            $info['free'][$trapped_unique] = ["sum" => array_sum($trapped_wave), "free" => [],];
                            //I added hero here :|
                            for ($u = 0; $u < ($trapped_wave[10] ? 11 : 10); $u++) {
                                if (!$trapped_wave[$u]) {
                                    continue;
                                }
                                //freed num
                                if (!isset($info['free'][$trapped_unique]['free'][$u])) {
                                    $info['free'][$trapped_unique]['free'][$u] = 0;
                                }
                                $info['free'][$trapped_unique]['free'][$u] += ceil($trapped_wave[$u] * 0.75);
                            }
                        }
                    }
                    $trapped2killed = [];
                }
                $this->finalize_losses($report, $def_armies, $off_losses, $def_losses, $wave, $tr, $info);
            }
        }
        return $report;
    }

    private function int_check_limit($arr, $name, $low, $high)
    {
        if (!array_key_exists($name, $arr)) {
            return $low;
        }
        return $this->limit($low, $high, (int)$arr[$name]);
    }

    private function limit($low, $value, $high)
    {
        if ($value < $low) {
            return $low;
        }
        if ($value > $high) {
            return $high;
        }
        return $value;
    }

    private function art_effect($arr, $name, $limit)
    {
        if (!array_key_exists($name, $arr)) {
            return 1;
        }
        $value = $this->limit(-$limit, (int)$arr[$name], $limit);
        if ($value < 0) {
            return -1 / $value;
        }
        if ($value == 0) {
            return 1;
        }
        return $value;
    }

    private function move_to_cages($units, $cages, &$caged)
    {
        $UNITS = count($units)/* - isset($units["hero"]) ? 1 : 0*/
        ;
        $total = array_sum($units);
        if ($cages >= $total) {
            $cages = $total;
            $caged = $units;
            return;
        }
        $remainder = [];
        for ($u = 0; $u < $UNITS; $u++) {
            if ($units[$u]) {
                $remainder[$u] = $units[$u];
            }
        }
        $len = count($remainder);
        $min = min($remainder);
        while ($len and $len * $min < $cages) {
            $cages -= $len * $min;
            foreach ($remainder as $idx => $value) {
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

    private function finalize_losses(&$report, &$def_armies, $off_l, $def_l, $offWave, $trapped, $info = [], $extra = [])
    {
        $revived = [];
        $dead_heroes = ["off" => 0, "def" => []];
        $off_units = $offWave['u']; // copy to save whether there was a hero
        foreach ($def_armies as $idx => &$army) {
            /*if ($_revived = get_revived($army, $def_l)) {
                $r = $army['r'];
                if (!isset($revived[$r])) $revived[$r] = array_fill(0, 10, 0);
                for ($u = 0; $u < 10; $u++) $revived[$r][$u] += $_revived[$u];
            }*/ //revive does not work for defenses.
            $a =& $army['u'];
            for ($u = 0; $u < 10; $u++) {
                $a[$u] = round((1 - $def_l) * $a[$u]);
            }
            if (!isset($dead_heroes['def'][$idx])) {
                $dead_heroes['def'][$idx] = 0;
            }
            $dead_heroes['def'][$idx] += $this->hero_check_kill($army, $def_l);
        }
        //for($u = 0; $u < 11; $u++) $offWave['u'][$u] += $trapped[$u];
        if ($_revived = $this->get_revived($offWave, $off_l)) {
            $revived['off'] = $_revived;
        }
        $dead_heroes['off'] = $this->hero_check_kill($offWave, $off_l);
        $arr = [
            'trapped'     => $trapped,
            'revived'     => $revived,
            'losses'      => [$off_l, $def_l],
            'dead_heroes' => $dead_heroes,
            'info'        => $info,
        ];
        foreach ($extra as $field => $value) {
            $arr[$field] = $value;
        }
        $report [] = $arr;
    }

    private function hero_check_kill(&$wave, $losses)
    {
        if (empty($wave['u'][10])) {
            return 0;
        }
        if (!isset($wave['hero']['health'])) {
            //trigger_error("health is not defined in hero", E_USER_WARNING);
        }
        if (!isset($wave['hero']['arm'])) {
            //trigger_error("armor is not defined in hero", E_USER_WARNING);
        }
        $lossPercent = max($losses * 100 - $wave['hero']['arm'], 0);
        if ($lossPercent >= min(90, $wave['hero']['health'])) {
            $wave['u'][10] = 0;
            return 1;
        } else {
            $wave['hero']['health'] -= $lossPercent;
            return 0;
        }
    }

    private function get_revived(&$army, $loss)
    {
        if (empty($army['h'])) {
            $bandages = 0;
        } else {
            if (!isset($army['hero']['bandage'])) {
                //trigger_error("bandages are not defined in hero", E_USER_WARNING);
            }
            if (!isset($army['hero']['bandage']['num'])) {
                //trigger_error("num are not defined in bandages", E_USER_WARNING);
            }
            if (!isset($army['hero']['bandage']['eff'])) {
                //trigger_error("eff are not defined in bandage", E_USER_WARNING);
            }
            $dead = array_fill(0, 10, 0);
            for ($u = 0; $u < 10; $u++) {
                $un = $army['u'][$u];
                $dead[$u] = $un - round($un * (1 - $loss));
            }
            $total = array_sum($dead);
            $bandages = min($army['hero']['bandage']['num'], ceil($total * $army['hero']['bandage']['eff'] / 100));
            $army['hero']['bandage']['num'] -= $bandages;
        }
        if (!$bandages) {
            return FALSE;
        }
        return $this->move_to_traps($dead, $bandages);
    }

    private function move_to_traps(&$units, &$traps)
    {
        $len = count($units);
        $atkrs_total = array_sum($units);
        $used_traps = min($traps, $atkrs_total);
        $trapped = [];
        $tr = 0;
        for ($u = 0; $u < $len; $u++) {
            $tr += $trapped[$u] = floor($units[$u] * $used_traps / $atkrs_total);
        }
        for ($u = 0; $u < $len; $u++) {
            if ($tr == $used_traps) {
                break;
            }
            if ($units[$u]) {
                $trapped[$u]++;
                $tr++;
            }
        }
        for ($u = 0; $u < $len; $u++) {
            $units[$u] -= $trapped[$u];
        }
        $traps -= array_sum($trapped);
        return $trapped;
    }

    private function stat_with_upg($stat, $upkeep, $lvl)
    {
        if ($this->mode == 4) {
            $upkeep /= 1.007;
            return round($stat + ($stat + 300 * $upkeep / 7) * (pow(1.007, $lvl) - 1) + $upkeep * 0.0021, 4);
        } else {
            return round($stat + ($stat + 300 * $upkeep / 7) * (pow(1.007, $lvl) - 1), 4);
        }
    }

    private function common_morale($pop)
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

    private function target_levels($wave)
    {
        $bl = [0, 0];
        if (isset($wave['b'])) {
            if ($wave['b'][0]) {
                $bl = $wave['b'];
            } elseif ($wave['b'][1]) {
                $bl[0] = $wave['b'][1];
            }
        }
        return $bl;
    }

    private function calc_offense(&$wave)
    {
        // init
        $offense = ['i' => 0, 'c' => 0, 'b' => 1];
        // units
        $item_bonus = $this->item_unit_bonus($wave);
        $this->unit_offense($wave, $item_bonus, $offense);
        // hero
        if (!empty($wave['u'][10])) {
            $this->hero_boni($wave, $offense);
        }
        //plus offense in T2.5
        if ($this->mode == 2 and isset($wave['P'])) {
            $offense['b'] *= 1.1;
        }
        // brewery
        if (!isset($wave['B'])) {
            //trigger_error("brewery(B) is not defined offense wave", E_USER_WARNING);
        }
        if ($wave['r'] == 1 and isset($wave['B']) and $this->mode >= 3) {
            $offense['b'] *= 1 + (int)$wave['B'] * 0.01;
        }
        return $offense;
    }

    private function item_unit_bonus($wave)
    {
        $item_bonus = array_fill(0, 10, 0);
        if ($wave['r'] >= 3) {
            return $item_bonus;
        }
        // set weapon unit bonus
        /*//right hand
        if(isset($wave['i']) and ($this->mode == 4) and $id = $wave['hero']['rightHand']) {
            $item =& $this->item_stats[$id];
            foreach($item['unit'] as $u => $value) {
                $this->item_stats[$u % 10] = $value;
            }
        }*/
        return $item_bonus;
    }

    private function unit_offense($wave, $item_bonus, &$offense)
    {
        $r = $this->int_check_limit($wave, 'r', 0, 7);
        for ($u = 0; $u < 10; $u++) {
            //changed r<=0 and $u<=7
            $up_level = $r == 3 ? 0 : (($u <= 7) ? $wave['U'][$u] : 0);
            $value = $this->stat_with_upg($this->off[$r][$u], $this->upkeep[$r][$u], $up_level);
            $value += $item_bonus[$u];
            $type = isset($this->is_cavalary[$r][$u]) ? 'c' : 'i';
            $offense[$type] += $value * $wave['u'][$u];
        }
    }

    private function hero_boni(&$wave, &$stats)
    {
        if ($this->mode == 2) {
            return;
        }
        $arm = 0;
        $str = 0;
        // items
        if ($this->mode == 4 and $wave['hero']) {
            /*for($i = 0; $i < 3; $i++){
                if ($id = $wave['i'][$i]) {
                    if (isset($item_stats[$id]['hero'])) {
                        $str += $item_stats[$id]['hero'];
                    }
                    if (isset($item_stats[$id]['arm'])) {
                        $arm += $item_stats[$id]['arm'];
                    }
                }
            }
            // natarian horns
            if ($id = $wave['i'][1]) {
                $item =& $item_stats[$id];
                if (isset($item['nat'])) {
                    $stats['n'] = $item['nat'];
                }
            }
            */
            if (!isset($wave['hero']['arm'])) {
                //trigger_error("armor is not defined in hero", E_USER_WARNING);
                $wave['hero']['arm'] = 0;
            }
            if (!isset($wave['hero']['str'])) { //streth
                //trigger_error("armor is not defined in hero", E_USER_WARNING);
                $wave['hero']['str'] = 0;
            }
            if (!isset($wave['hero']['n'])) { //streth
                //trigger_error("n is not defined in hero", E_USER_WARNING);
                $wave['hero']['n'] = 0;
            }
            $str += $wave['hero']['str'];
            $arm += $wave['hero']['arm'];
            $stats['n'] = $wave['hero']['n'];
        }
        $wave['a'] = $arm;
        $this->set_hero_stats($wave, $this->mode, $str, $stats);
    }

    private function set_hero_stats($wave, $mode, $str, &$stats)
    {
        if ($this->mode == 2) {
            return;
        }
        $r = $wave['r'];
        if (!isset($wave['hero']['power']) || $wave['hero']['power'] > 100) {
            ///trigger_error("power is not defined in hero in T4", E_USER_WARNING);
        }
        $s = isset($wave['hero']['total_power']) ? 0 : $wave['hero']['power'];
        if ($this->mode == 4) { // T4 > 0
            if (!isset($wave['hero'][($wave['side']) . 'Bonus'])) { //nr musts be unitIdtoNr - 1
                //trigger_error((($wave['side']).'Bonus')." is not defined in hero in T4", E_USER_WARNING);
            }
            $st = $this->hero_str4($wave, $s, $r, $str);
        } else { // T3
            if (!isset($wave['hero']['nr'])) { //nr musts be unitIdtoNr - 1
                //trigger_error("nr is not defined in hero in T3", E_USER_WARNING);
            }
            $st = $this->hero_str3($wave['side'], $s, $r, $wave['hero']['nr'] % 10);
        }
        $stats['i'] += $st[0];
        $stats['c'] += $st[1];
        $stats['b'] *= 1 + $wave['hero'][($wave['side'] . 'Bonus')] * 0.002;
    }

    private function hero_str4($wave, $s, $r, $str_add)
    {
        $str = isset($wave['hero']['total_power']) ? $wave['hero']['total_power'] : (100 + $s * ($r ? 80 : 100) + $str_add);
        if ($wave['side'] == 'off') {
            if (!isset($wave['hero']['isCavalry'])) {
                //trigger_error("isCavalry is not defined in hero", E_USER_WARNING);
            }
            $stats = [0, 0];
            $stats[isset($wave['hero']['isCavalry']) && $wave['hero']['isCavalry'] ? 1 : 0] += $str;
            return $stats;
        }
        return [$str, $str];
    }

    private function hero_str3($side, $s, $r, $u)
    {
        if ($side == 'off') {
            $atk = $this->off[$r][$u];
            $stats = [0, 0];
            $type = isset($this->is_cavalary[$r][$u]) ? 1 : 0;
            $stats[$type] += round5((2 * $atk / 3 + 27.5) * $s + 5 * $atk / 4);
            return $stats;
        }
        $di = $this->def_i[$r][$u];
        $dc = $this->def_c[$r][$u];
        $corr = pow($di / $dc, 0.2);
        return [
            round5((2 * $di / 3 + 27.5 * $corr) * $s + 5 * $di / 3),
            round5((2 * $dc / 3 + 27.5 / $corr) * $s + 5 * $dc / 3),
        ];
    }

    private function finalize_stats(&$stats)
    {
        $stats['i'] *= $stats['b'];
        $stats['c'] *= $stats['b'];
        $stats['t'] = $stats['i'] + $stats['c'];
    }

    private function calc_total_defense(&$def_armies)
    {
        $defense = ['i' => 0, 'c' => 0, 'b' => 1];
        foreach ($def_armies as $idx => &$army) {
            $this->calc_defense($army, $defense);
        }
        return $defense;
    }

    private function calc_defense(&$wave, &$defense)
    {
        $def = ['i' => 0, 'c' => 0, 'b' => 1];
        $item_bonus = $this->item_unit_bonus($wave);
        $this->unit_defense($wave, $item_bonus, $def);
        if (!empty($wave['u'][10])) {
            $this->hero_boni($wave, $def);
        }
        if (isset($wave['P'])) {
            $def['b'] *= 1.1;
        }
        $defense['i'] += $def['i'] * $def['b'];
        $defense['c'] += $def['c'] * $def['b'];
    }

    private function unit_defense($wave, $item_bonus, &$def)
    {
        $r = $this->int_check_limit($wave, 'r', 0, 7);
        for ($u = 0; $u < 10; $u++) {
            $up_level = ($r <= 2 and $u <= 8) ? $wave['U'][$u] : 0;
            $cu = $this->upkeep[$r][$u];
            $def['i'] += $wave['u'][$u] * ($this->stat_with_upg($this->def_i[$r][$u],
                        $cu,
                        $up_level) + $item_bonus[$u]);
            $def['c'] += $wave['u'][$u] * ($this->stat_with_upg($this->def_c[$r][$u],
                        $cu,
                        $up_level) + $item_bonus[$u]);
        }
    }

    private function calc_diffusion($troops_amount)
    {
        $n = 2 * round(1.8592 - pow($troops_amount, 0.015), 4);
        return $this->limit(1.2578, $n, 1.5);
    }

    private function remorale($off, $def, $pop, $wall)
    {
        $pts = round($off) / round($def * $wall);
        $morale = round(pow($pop, -0.2 * min($pts, 1)), 3);
        return $pts * $this->limit(0.667, $morale, 1.0);
    }

    private function lone_dies($offense, $pop_ratio)
    {
        return round($offense['t'] * $this->common_morale($pop_ratio)) <= self::LONE_ATTACKER_THRESHOLD;
    }

    private function sigma($x)
    {
        return $x >= 1 ? 1 - 0.5 / $x : 0.5 * $x;
    }

    private function early_ramming($lvl, $units, $percent, $upg_lvl, $durability, $race_dur)
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

    private function bonusCatsRams($lvl)
    {
        return round(2 * pow(1.0205, $lvl), 2) / 2;
    }

    private function demolish($lvl, $units, $upg_lvl, $race_durab, $durability_other)
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
}