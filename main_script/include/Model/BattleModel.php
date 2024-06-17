<?php

namespace Model;

use function array_sum;
use Core\Config;
use Core\Database\DB;
use Game\AllianceBonus\AllianceBonus;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\Helpers\HeroHealthHelper;
use Game\Helpers\LoyaltyHelper;
use Game\Hero\HeroHelper;
use Game\Hero\HeroItems;
use Game\NoticeHelper;
use Game\ResourcesHelper;
use Game\SpeedCalculator;
use Game\Starvation;
use Game\TruceDay;
use function array_filter_units;
use function getCustom;
use function logError;
use function unitIdToNr;
use function unitIdToTribe;

class BattleModel
{
    const BASE_VILLAGE_DEF = 10;
    const SCOUT_DEF = 20;
    const SCOUT_OFF = 35;
    const LONE_ATTACKER_THRESHOLD = 84;
    protected $off = [
        1 => [1 => 40, 30, 70, 0, 120, 180, 60, 75, 50, 0],
        2 => [1 => 40, 10, 60, 0, 55, 150, 65, 50, 40, 10],
        3 => [1 => 15, 65, 0, 90, 45, 140, 50, 70, 40, 0],
        4 => [1 => 10, 20, 60, 80, 50, 100, 250, 450, 200, 600],
        5 => [1 => 20, 65, 100, 0, 155, 170, 250, 60, 80, 30],
        6 => [1 => 10, 30, 65, 0, 50, 110, 55, 65, 40, 0],
        7 => [1 => 35, 50, 0, 120, 115, 180, 65, 45, 40, 0],
    ];
    protected $def_i = [
        1 => [1 => 35, 65, 40, 20, 65, 80, 30, 60, 40, 80],
        2 => [1 => 20, 35, 30, 10, 100, 50, 30, 60, 60, 80],
        3 => [1 => 40, 35, 20, 25, 115, 50, 30, 45, 50, 80],
        4 => [1 => 25, 35, 40, 66, 70, 80, 140, 380, 170, 440],
        5 => [1 => 35, 30, 90, 10, 80, 140, 120, 45, 50, 40],
        6 => [1 => 30, 55, 50, 20, 110, 120, 30, 55, 50, 80],
        7 => [1 => 40, 30, 20, 30, 80, 60, 30, 55, 50, 80],
    ];
    protected $def_c = [
        1 => [1 => 50, 35, 25, 10, 50, 105, 75, 10, 30, 80],
        2 => [1 => 5, 60, 30, 5, 40, 75, 80, 10, 40, 80],
        3 => [1 => 50, 20, 10, 40, 55, 165, 105, 10, 50, 80],
        4 => [1 => 20, 40, 60, 50, 33, 70, 200, 240, 250, 520],
        5 => [1 => 50, 10, 75, 0, 50, 80, 150, 10, 50, 40],
        6 => [1 => 20, 40, 20, 10, 50, 150, 95, 10, 50, 80],
        7 => [1 => 30, 10, 10, 15, 70, 40, 90, 10, 50, 80],
    ];
    protected $wall_durability = [1 => 1, 2 => 5, 3 => 2, 4 => 1, 5 => 1, 6 => 5, 7 => 1];
    protected $wall_base = [1 => 1.03, 2 => 1.02, 3 => 1.025, 4 => 1, 5 => 1.03, 6 => 1.025, 7 => 1.015];
    protected $wall_extra = [
        1 => 10,
        2 => 6,
        3 => 8,
        4 => 0,
        5 => 10,
        6 => 8,
        7 => 6,
    ]; //TODO: Huns wall needs update
    protected $administrator_effect = [
        1 => [20, 30],
        2 => [20, 25],
        3 => [20, 25],
        4 => [0, 0],
        5 => [200, 200],
        6 => [20, 25],
        7 => [20, 25],
    ];
    protected $upkeep = [
        1 => [1 => 1, 1, 1, 2, 3, 4, 3, 6, 5, 1, 6],
        2 => [1 => 1, 1, 1, 1, 2, 3, 3, 6, 4, 1, 6],
        3 => [1 => 1, 1, 2, 2, 2, 3, 3, 6, 4, 1, 6],
        4 => [1 => 1, 1, 1, 1, 2, 2, 3, 3, 3, 5, 0],
        5 => [1 => 1, 1, 1, 1, 2, 3, 6, 5, 0, 0, 6],
        6 => [1 => 1, 1, 1, 2, 2, 3, 3, 6, 4, 1, 6],
        7 => [1 => 1, 1, 2, 2, 2, 3, 3, 6, 4, 1, 6],
    ];
    protected $is_cavalary = [
        1 => [4 => 1, 5 => 1, 6 => 1],
        2 => [4 => 1, 5 => 1, 6 => 1],
        3 => [3 => 1, 4 => 1, 5 => 1, 6 => 1],
        4 => [],
        5 => [5 => 1, 6 => 1],
        6 => [4 => 1, 5 => 1, 6 => 1],
        7 => [4 => 1, 5 => 1, 6 => 1],
    ];
    /** @var BattleSetter */
    private $model;
    private $isTopOff = false, $isTopDef = false;
    private $attacker = [
        'uid' => null,
        'kid' => null,
        'hasBonus' => false,
        'player' => ['aid' => 0, 'name' => ''],
        'total_pop' => 0,
        'wave' => [
            'race' => 1,
            'units' => [],
            'hero' => [],
        ],
        'buildings' => [],
    ];
    private $defender = [
        'hasBonus' => false,
        'uid' => null,
        'kid' => null,
        'player' => [
            'aid' => 0,
            'name' => '',
            'escape' => false,
            'hasGoldClub' => false,
        ],
        'isOasis' => false,
        'isOccupied' => false,
        'total_pop' => 500,
        'stone' => 0,
        'wall' => 0,
        'rp' => 0,
        'traps' => 0,
        'wave' => [],
        'buildings' => [],
        'total_net_def_point' => 0,
    ];
    private $heroItemsModel;
    private $info = [];
    private $cataWorks = false;
    private $row = [];
    private $isFarm = false;
    private $atkBonusRate = 1;
    private $defBonusRate = 1;

    protected $profile = [];
    protected $profilingEnabled = true;

    public function isInsider()
    {
        if ($this->attacker['player']['aid'] == $this->defender['player']['aid'] && $this->attacker['player']['aid'] > 0) {
            return $this->attacker['uid'] != $this->defender['uid'];
        }
        return false;
    }

    private function startProfile($name)
    {
        if (!$this->profilingEnabled)
            return;
        $this->profile[$name] = microtime(true);
    }

    private function endProfile($name)
    {
        if (!$this->profilingEnabled)
            return;
        $this->profile[$name] = (microtime(true) - $this->profile[$name]) * 1000;
    }

    private function profileOutput()
    {
        if (!$this->profilingEnabled)
            return false;
        $this->endProfile('__construct');
//        if ($this->profile['__construct'] < 500) {
//            return;
//        }
//        logError(print_r($this->profile, true));
        return true;
    }

    public function __construct($row)
    {
        $this->startProfile('__construct');
        $this->heroItemsModel = new HeroItems();
        $this->atkBonusRate = 1 + (Config::getProperty("extraSettings", "power", "atkBonus", "percent") / 100);
        $this->defBonusRate = 1 + (Config::getProperty("extraSettings", "power", "defBonus", "percent") / 100);
        $this->row = $row;
        $this->row['end_time_seconds'] = ceil($row['end_time'] / 1000);

        if (getGame("catapultAvailableTime") > 0) {
            $this->cataWorks = time() >= getGame("catapultAvailableTime");
        } else {
            $this->cataWorks = true;
        }
        $this->model = new BattleSetter();
        $this->startProfile("assocAttacker");
        $this->assocAttacker();
        $this->endProfile("assocAttacker");

        //Checking if there is a village or not
        if (!$this->model->getVillageState($this->row['to_kid'])) {
            $this->sendVillageDoesNotExistsReport();
            $this->returnTroops();
            return $this->profileOutput();
        }

        $this->startProfile("assocDefender");
        $resultDefender = $this->assocDefender();
        $this->endProfile("assocDefender");


        // Checking for unknown defender
        if (!$this->defender['uid'] && !$this->defender['isOasis'] || !$resultDefender) {
            $this->sendVillageDoesNotExistsReport();
            $this->returnTroops();
            return $this->profileOutput();
        }
        // Checking for multi account
        if (isset($this->attacker['uid'], $this->defender['uid']) &&
            $this->defender['uid'] > 2 && $this->attacker['uid'] > 2 &&
            $this->defender['uid'] != $this->attacker['uid']) {
            MultiAccount::addMultiAccountLog($this->attacker['uid'], $this->defender['uid'], 3);
        }
        if ($this->row['attack_type'] != MovementsModel::ATTACKTYPE_SPY && TruceDay::isActive()) {
            /*$doPeace = $this->defender['isOasis'] && $this->defender['isOccupied'];
            $doPeace = $doPeace || (isset($this->attacker['uid']) && isset($this->defender['uid']) && $this->defender['uid'] > 2 && $this->attacker['uid'] > 2 && $this->attacker['uid'] != $this->defender['uid']);*/
            //$doPeace = true;
            $doPeace = false;
            if (isset($this->attacker['uid'], $this->defender['uid'])) {
                if ($this->defender['uid'] > 2 && $this->attacker['uid'] > 2) {
                    if ($this->attacker['uid'] != $this->defender['uid']) {
                        $doPeace = true;
                    }
                }
            }
            if ($doPeace) {
                $this->sendTruceReport(true);
                //attacker report
                if (!$this->defender['isOasis'] || $this->defender['isOccupied']) {
                    //defender report
                    $this->sendTruceReport(false);
                }
                $move = new MovementsModel();
                $move->addMovement($this->row['to_kid'],
                    $this->row['kid'],
                    $this->row['race'],
                    array_filter_units($this->row),
                    0,
                    0,
                    0,
                    0,
                    1,
                    $this->row['attack_type'],
                    $this->row['end_time'],
                    2 * $this->row['end_time'] - $this->row['start_time']);
                return false;
            }
        }
        $helper = new HeroHelper();
        if ($this->attacker['wave']['units']['num'][11] && $this->defender['isOasis'] && !$this->defender['isOccupied'] && array_sum($this->defender['wave'][0]['units']['num'])) {
            $this->startProfile('cagedAttack');
            //checking for cages.
            $cages = $helper->getCages($this->attacker['wave']['heroItems']['bag']);
            if ($cages) {
                //caged attack :>
                $caged = array_fill(1, 10, 0);
                $this->model->move_to_cages($this->defender['wave'][0]['units']['num'], $cages, $caged);
                $this->finalize_caged_attack($caged);
                $this->endProfile('cagedAttack');
                return $this->profileOutput();
            }
            $this->endProfile('cagedAttack');
        }
        $no_morale = $this->defender['isWW'] || isset($this->defender['uid']) && $this->defender['uid'] == 1;
        $wall_b = $this->wall_base[$this->defender['wave'][0]['race']];
        $pop_ratio = $this->attacker['total_pop'] / $this->defender['total_pop'];
        if (getGame("ignoreMoralPointsInAttacks")) {
            $pop_ratio = 1;
        }
        $sui = Formulas::getSpyId($this->row['race']);
        if ($sui && array_sum($this->attacker['wave']['units']['num']) == $this->attacker['wave']['units']['num'][$sui]) {
            //spy attack
            $this->startProfile('processScoutAttack');
            $this->processScoutAttack($no_morale, $pop_ratio, $sui, $wall_b);
            $this->endProfile('processScoutAttack');
            return $this->profileOutput();
        }
        $this->startProfile('checkingTraps');
        if ($this->defender['traps']) {
            $units = $this->attacker['wave']['units']['num'];
            $trapped = $this->model->move_to_traps($units, $this->defender['traps']);
            foreach ($trapped as $key => $v) {
                $this->attacker['wave']['units']['trapped'][$key] = $v;
            }
        }
        $this->endProfile('checkingTraps');
        $this->startProfile('FinalizingAtkDefBonus');
        $stone = 1 + $this->defender['stone'] / 10;
        $brewery = (new VillageModel())->getCapBrewery($this->attacker['uid']);
        $offense = $this->calc_offense($brewery);
        if (isset($this->defender['uid']) && $this->defender['uid'] == 1) {
            if ($this->attacker['wave']['units']['num'][11] && isset($offense['n'])) {
                $offense['b'] *= 1 + $offense['n'] / 100; // natarian horns
            }
            $offense['b'] *= 1.015; // correction factor of unknown origin
        }
        $this->finalize_stats($offense);
        if ($this->attacker['hasBonus'] && !$this->defender['isWW']) {
            $offense['t'] *= $this->atkBonusRate;
        }
        if ($this->attacker['player']['aid'] > 0) {
            $offense['t'] *= AllianceBonus::getArmorBonus($this->attacker['player']['aid'],
                $this->attacker['player']['alliance_join_time']);
        }
        $defense = $this->calc_total_defense($offense);

        $this->finalize_stats($defense);

        $total = array_sum($this->attacker['wave']['units']['num']);
        $total -= array_sum($this->attacker['wave']['units']['trapped']);
        foreach ($this->defender['wave'] as &$army) {
            $total += array_sum($army['units']['num']);
        }

        $immensity = $this->model->calc_diffusion($total);
        $defense['t'] = $this->model->adduced_def($defense['i'], $defense['c'], $offense['i'], $offense['c']);
        $this->defender['total_net_def_point'] = $defense['t'];
        if (!$this->defender['isOasis']) {
            $defense['t'] += 2 * pow($this->defender['rp'], 2);
        }

        //MARK I
        $defense['t'] += self::BASE_VILLAGE_DEF;
        $defense['t'] += $this->wall_extra[$this->defender['wave'][0]['race']] * $this->defender['wall'];
        if ($this->defender['hasBonus'] && !$this->defender['isWW']) {
            $defense['t'] *= $this->defBonusRate;
        }
        if ($this->defender['player']['aid'] > 0) {
            $defense['t'] *= AllianceBonus::getArmorBonus($this->defender['player']['aid'],
                $this->defender['player']['alliance_join_time']);
        }

        $wall_bonus = round(pow($wall_b, $this->defender['wall']), 3);
        $pts_ratio = $this->model->remorale($offense['t'], $defense['t'], $no_morale ? 1 : $pop_ratio, $wall_bonus);
        $x = pow($pts_ratio, $immensity);
        $lone_attacker = array_sum($this->attacker['wave']['units']['num']) === 1;
        $this->endProfile('FinalizingAtkDefBonus');

        if (!$offense['t']) {
            $this->startProfile('FinalizeRaidAttackNoOffense');
            $this->finalize_attack($no_morale, $pop_ratio, [1, 0], $offense['t'], $defense['t']);
            $this->endProfile('FinalizeRaidAttackNoOffense');
            return $this->profileOutput();
        }

        if ($this->row['attack_type'] == MovementsModel::ATTACKTYPE_RAID) {
            $this->startProfile('FinalizeRaidAttack');
            $off_losses = 1 / (1 + $x);
            $def_losses = $x / (1 + $x);
            if ($lone_attacker && $this->lone_dies($offense, $pop_ratio)) {
                $off_losses = 1;
            }
            $this->finalize_attack($no_morale, $pop_ratio, [$off_losses, $def_losses], $offense['t'], $defense['t']);
            $this->endProfile('FinalizeRaidAttack');
            return $this->profileOutput();
        }

        $off_losses = $x ? min(1 / $x, 1) : 1;
        $def_losses = min($x, 1);
        $siege_percent = $this->model->sigma(pow($pts_ratio, 1.5));
        $art_dur = $this->model->art_effect(ArtefactsModel::getArtifactEffectByType($this->defender['uid'], $this->row['to_kid'], ArtefactsModel::ARTIFACT_INCREASE_BUILDINGS_STABILITY), 10);
        $d = $stone * $art_dur;
        $wall_dur = $this->wall_durability[$this->defender['wave'][0]['race']];
        $info =& $this->info;
        if (!$this->isFarm() && $this->attacker['wave']['units']['num'][7] && $this->defender['wall']) {
            $up = $this->attacker['wave']['units']['smithy'][7];
            $rams = $this->attacker['wave']['units']['num'][7];
            $mwl = $this->model->early_ramming($this->defender['wall'], $rams, $siege_percent, $up, $d, $wall_dur);
            $wall_bonus = round(pow($wall_b, $mwl), 3);
            $pts_ratio = $this->model->remorale($offense['t'], $defense['t'], $no_morale ? 1 : $pop_ratio, $wall_bonus);
            $siege_percent = $this->model->sigma(pow($pts_ratio, 1.5));
            $x = pow($pts_ratio, $immensity);
            $rams = $this->model->sigma(pow($pts_ratio, $immensity)) * $this->attacker['wave']['units']['num'][7];
            $rams = $this->fixSpeedCataRamEffect($rams, $off_losses, $def_losses);
            $off_losses = min(1 / $x, 1);
            $def_losses = min($x, 1);
            $wl = $this->model->demolish($this->defender['wall'], $rams, $up, $wall_dur, $d);
            $info['rams'] = [
                $this->defender['buildings'][40]['item_id'],
                $this->defender['wall'],
                $wl,
            ];
            $this->finalize_ram_damage();
        }
        $supporting_artifacts = $this->model->getProtectingArtifacts($this->defender['uid'], $this->row['to_kid']);
        if ($supporting_artifacts) {
            $info['protectedByArtifact'] = [];
            foreach ($supporting_artifacts as $protecting_artifact) {
                $info['protectedByArtifact'][] = [
                    'type' => $protecting_artifact['type'],
                    'size' => $protecting_artifact['size'],
                    'num' => $protecting_artifact['num'],
                ];
            }
        }
        if ($this->isFarm() || ($this->attacker['wave']['units']['num'][8] && !$this->defender['isOasis'] && !$this->cataWorks)) {
            $info['cata_is_disabled'] = true;
        }
        if (!$this->isFarm() && $this->attacker['wave']['units']['num'][8] && !$this->defender['isOasis'] && $this->cataWorks) {
            $targets = [[0, 0, 0]];
            $selected = [0];
            if ($this->row['ctar2'] <> 0) {
                $targets[] = [0, 0, 0];
                $selected[] = 0;
            }
            $random_artifact = $this->model->randomTargetArtifact($this->defender['uid'], $this->row['to_kid']);
            $village = new VillageModel();
            $cap = $village->getCapBrewery($this->attacker['uid']);
            for ($i = 0; $i < sizeof($targets); ++$i) {
                if ($random_artifact) {
                    $ignore = $random_artifact < 3 ? [27, 40] : [40];
                    if (in_array($this->row['ctar' . ($i + 1)], $ignore)) {
                        $selected[$i] = $this->find_building_by_gid($cap ? 99 : $this->row['ctar' . ($i + 1)], $this->defender['buildings']);
                    }
                    $selected[$i] = $this->find_building_by_gid(99, $this->defender['buildings']);
                    continue;
                }
                $selected[$i] = $this->find_building_by_gid($cap ? 99 : $this->row['ctar' . ($i + 1)], $this->defender['buildings']);
            }
            $info['cata'] = [];

            $up = $this->attacker['wave']['units']['smithy'][8];

            $moral = $no_morale ? 1 : $this->model->limit(0.333, pow($pop_ratio, -0.3), 1);
            $cats = $this->attacker['wave']['units']['num'][8] * $siege_percent * $moral;
            //some fixes for speed servers
            $cats = $this->fixSpeedCataRamEffect($cats, $off_losses, $def_losses);
            if (isset($selected[1]) && $selected[1] and $this->attacker['wave']['units']['num'][8] >= 20) { // two targets
                $cats /= 2;
                if (!$selected[1] || !$this->defender['buildings'][$selected[1]]['level']) {
                    unset($targets[1]); //no building with this target exists!
                    //maybe village totally destroyed!
                } else {
                    $info['cata'][1] = [
                        $this->defender['buildings'][$selected[1]]['item_id'],
                        $this->defender['buildings'][$selected[1]]['level'],
                        $this->model->demolish($this->defender['buildings'][$selected[1]]['level'], $cats, $up, 1, $d / ($this->defender['buildings'][$selected[1]]['item_id'] == 40 ? $art_dur : 1)),
                        $this->row['ctar2'] == $this->defender['buildings'][$selected[1]]['item_id'] ? 0 : 1,
                    ];
                    $this->finalize_cata_damage($selected[1], $info['cata'][1]);
                }
            }
            if ($no_morale) {
//                $d /= $art_dur;
            }
            if (!$selected[0] || !$this->defender['buildings'][$selected[0]]['level']) {
                $selected[0] = $this->find_building_by_gid($cap ? 99 : $this->row['ctar1'], $this->defender['buildings']);
            }
            if (!$selected[0] || !$this->defender['buildings'][$selected[0]]['level']) {
                unset($targets[0]); //no building with this target exists!
                if (isset($targets[1])) {
                    array_unshift($targets, $targets[1]);
                    unset($targets[1]);
                }
                //maybe village totally destroyed!
            } else {
                $info['cata'][0] = [
                    $this->defender['buildings'][$selected[0]]['item_id'],
                    $this->defender['buildings'][$selected[0]]['level'],
                    $this->model->demolish($this->defender['buildings'][$selected[0]]['level'], $cats, $up, 1, $d / ($this->defender['buildings'][$selected[0]]['item_id'] == 40 ? $art_dur : 1)),
                    $this->row['ctar1'] == $this->defender['buildings'][$selected[0]]['item_id'] ? 0 : 1,
                ];
                $this->finalize_cata_damage($selected[0], $info['cata'][0]);
            }
            $this->checkIfVillageIsDestroyed();
        }
        if ($lone_attacker && $this->lone_dies($offense, $pop_ratio)) {
            $off_losses = 1;
        }

        $this->finalize_attack($no_morale,
            $pop_ratio,
            [
                $off_losses,
                $def_losses,
            ],
            $offense['t'],
            $defense['t']);

        return $this->profileOutput();
    }

    private function assocAttacker()
    {
        new Starvation($this->row['kid']);

        $this->startProfile('assocAttacker:getOwner');
        $owner = $this->model->getOwner($this->row['kid']);
        $this->endProfile('assocAttacker:getOwner');
        $this->startProfile('assocAttacker:getUser');
        $user = $this->model->getUser($owner);
        $this->endProfile('assocAttacker:getUser');
        $this->startProfile('assocAttacker:getFullUnits');
        $units = $this->model->getFullUnits($this->row['kid'], array_filter_units($this->row), true);
        $this->endProfile('assocAttacker:getFullUnits');

        $this->startProfile('assocAttacker:getAttackerNeededBuildings');
        $buildings = $this->model->getAttackerNeededBuildings($this->row['kid']);
        $this->endProfile('assocAttacker:getAttackerNeededBuildings');

        $this->startProfile('assocAttacker:populatingData');
        $this->attacker = [
            'hasBonus' => $user['atkBonusExpireTime'] > time(),
            'uid' => $owner,
            'kid' => $this->row['kid'],
            'player' => [
                'aid' => $user['aid'],
                'name' => $user['name'],
                'cp' => $user['cp'],
                'alliance_join_time' => $user['alliance_join_time'],
            ],
            'total_pop' => max($user['total_pop'], 1),
            'wave' => [
                'race' => $this->row['race'],
                'units' => $units,
                'hero' => [],
                'heroItems' => [],
            ],
            'buildings' => $buildings,
        ];
        $this->endProfile('assocAttacker:populatingData');
        if ($this->attacker['wave']['units']['num'][11]) {
            $this->startProfile('assocAttacker:hero');
            HeroHealthHelper::updateUserHeroHealth($owner);
            $inventory = $this->model->getInventory($owner);
            $helper = new HeroHelper();
            $this->attacker['wave']['hero'] = $this->model->getHero($owner);
            $this->attacker['wave']['heroItems'] = [
                'leftHand' => $helper->procInput($inventory['leftHand']),
                'rightHand' => $helper->procInput($inventory['rightHand']),
                'body' => $helper->procInput($inventory['body']),
                'shoes' => $helper->procInput($inventory['shoes']),
                'bag' => $helper->procInput($inventory['bag']),
                'horse' => $helper->procInput($inventory['horse']),
                'helmet' => $helper->procInput($inventory['helmet']),
            ];
            $this->endProfile('assocAttacker:hero');
        }
    }

    public function sendVillageDoesNotExistsReport()
    {
        $data = [
            'attacker' => [
                'kid' => $this->attacker['kid'],
                'uid' => $this->attacker['uid'],
                'uname' => $this->attacker['player']['name'],
                'race' => $this->attacker['wave']['race'],
                'num' => $this->attacker['wave']['units']['num'],
                'dead' => null,
                'trapped' => null,
            ],
            'no_village' => true,
        ];
        $reportType = NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES;
        NoticeHelper::addNotice($this->attacker['player']['aid'],
            $this->attacker['uid'],
            $this->row['kid'],
            $this->row['to_kid'],
            $reportType,
            null,
            $data,
            $this->row['end_time_seconds']);
    }

    private function returnTroops()
    {
        $move = new MovementsModel();
        $move->addMovement($this->row['to_kid'], $this->row['kid'], $this->row['race'], array_filter_units($this->row), 0, 0, 0, 0, 1, $this->row['attack_type'], $this->row['end_time'], 2 * $this->row['end_time'] - $this->row['start_time']);
    }

    private function assocDefender()
    {
        $oasis = new OasesModel();
        $this->defender = [
            'hasBonus' => false,
            'uid' => null,
            'kid' => $this->row['to_kid'],
            'hdp' => 0,
            'player' => [
                'aid' => 0,
                'name' => '',
                'escape' => false,
                'hasGoldClub' => false,
                'alliance_join_time' => 0,
            ],
            'isOasis' => $oasis->isOasis($this->row['to_kid']),
            'isOccupied' => false,
            'total_pop' => 500,
            'stone' => 0,
            'wall' => 0,
            'rp' => 0,
            'traps' => 0,
            'wave' => [],
            'isWW' => false,
            'buildings' => [],
            'total_net_def_point' => 0,
        ];
        if ($this->defender['isOasis']) {
            $this->defender['isOccupied'] = $oasis->getOasisCaptureKid($this->row['to_kid']);
            if (!$this->defender['isOccupied']) {
                $this->startProfile('assocDefender:oasesTrain');
                OasesModel::oasesTrain($this->row['to_kid']);
                $this->endProfile('assocDefender:oasesTrain');
                $this->startProfile('assocDefender:getOasisUnits');
                $units = $this->model->getFullUnits($this->row['to_kid'], $this->model->getUnits($this->row['to_kid'], true));
                $this->endProfile('assocDefender:getOasisUnits');
                $this->defender['wave'][] = [
                    'uid' => 0,
                    'race' => 4,
                    'uniqueId' => $this->row['to_kid'],
                    'isEnforce' => false,
                    'isForeign' => false,
                    'units' => $units,
                    'hero' => [],
                    'heroItems' => [],
                ];
            } else {
                $this->startProfile('assocDefender:oasisOwnerStarvation');
                new Starvation($this->defender['isOccupied']);
                $this->startProfile('assocDefender:oasisOwnerStarvation');
                $this->startProfile('assocDefender:getOasisOwner');
                $this->defender['uid'] = $this->model->getOwner($this->defender['isOccupied']);
                $this->endProfile('assocDefender:getOasisOwner');
                $this->startProfile('assocDefender:getOasisUser');
                $user = $this->model->getUser($this->defender['uid']);
                $this->endProfile('assocDefender:getOasisUser');
                $this->defender['hasBonus'] = $user['defBonusExpireTime'] > time();
                $this->defender['player'] = [
                    'aid' => $user['aid'],
                    'name' => $user['name'],
                    'race' => $user['race'],
                    'escape' => false,
                    'hasGoldClub' => $user['goldclub'] == 1,
                    'alliance_join_time' => $user['alliance_join_time'],
                ];
                $this->defender['total_pop'] = max($user['total_pop'], 1);
                $this->startProfile('assocDefender:getVillageFullUnits');
                $units = $this->model->getFullUnits($this->row['to_kid'], array_fill(1, 11, 0));
                $this->endProfile('assocDefender:getVillageFullUnits');
                $this->defender['wave'][] = [
                    'uid' => $this->defender['uid'],
                    'kid' => $this->defender['isOccupied'],
                    'uniqueId' => $this->row['to_kid'],
                    'isEnforce' => false,
                    'isForeign' => false,
                    'race' => $this->defender['player']['race'],
                    'units' => $units,
                    'hero' => [],
                    'heroItems' => [],
                ];
            }
        } else {
            new Starvation($this->row['to_kid']);
            $this->startProfile('assocDefender:getVillageOwner');
            $this->defender['uid'] = $this->model->getOwner($this->row['to_kid']);
            $this->endProfile('assocDefender:getVillageOwner');
            $user = $this->model->getUser($this->defender['uid']);
            $this->defender['hasBonus'] = $user['defBonusExpireTime'] > time();
            $this->defender['player'] = [
                'aid' => $user['aid'],
                'name' => $user['name'],
                'alliance_join_time' => $user['alliance_join_time'],
                'race' => $user['race'],
                'escape' => $user['escape'] == 1,
                'hasGoldClub' => $user['goldclub'] == 1,
            ];
            $this->defender['total_pop'] = max($user['total_pop'], 1);
            $this->startProfile('assocDefender:getVillageTroops');
            $units = $this->model->getFullUnits($this->row['to_kid'], $this->model->getUnits($this->row['to_kid']));
            $this->endProfile('assocDefender:getVillageTroops');
            $wave = [
                'uid' => $this->defender['uid'],
                'kid' => $this->row['to_kid'],
                'uniqueId' => $this->row['to_kid'],
                'isEnforce' => false,
                'isForeign' => false,
                'race' => $user['race'],
                'units' => $units,
                'hero' => [],
                'heroItems' => [],
            ];
            $this->defender['traps'] = max($this->defender['traps'], 0);
            $this->defender['isWW'] = $this->isFarm = false;
            $db = DB::getInstance();
            $this->startProfile('assocDefender:getVillageInfo');
            $find = $db->query("SELECT isWW, isFarm, pop FROM vdata WHERE kid={$this->row['to_kid']}");
            $isZeroPop = false;
            if ($find->num_rows) {
                $resultRow = $find->fetch_assoc();
                $this->defender['isWW'] = $resultRow['isWW'];
                $this->isFarm = $resultRow['isFarm'];
                $isZeroPop = $resultRow['pop'] <= 5;
            }
            $this->endProfile('assocDefender:getVillageInfo');

            $this->startProfile('assocDefender:getDefenderBuildings');
            $totalTraps = $this->model->getDefenderBuildings($this->row['to_kid'], $this->defender, $wave['race']);
            $this->endProfile('assocDefender:getDefenderBuildings');


            if ($this->defender['player']['escape'] && $this->defender['player']['hasGoldClub'] && !$this->defender['isOasis'] && $this->row['attack_type'] <> MovementsModel::ATTACKTYPE_SPY) {
                if ($this->defender['rallyPoint']) {
                    $this->startProfile('assocDefender:escape_units');
                    $this->info['escape'] = $this->model->escape_units($this->defender['kid'], $this->row['end_time'], $wave, $isZeroPop);
                    $this->endProfile('assocDefender:escape_units');
                } else {
                    $this->info['escape'] = 5;
                }
            }
            if ($wave['units']['num'][11]) {
                $this->startProfile('assocDefender:hero');
                HeroHealthHelper::updateUserHeroHealth($this->defender['uid']);
                $inventory = $this->model->getInventory($this->defender['uid']);
                $helper = new HeroHelper();
                $wave['hero'] = $this->model->getHero($this->defender['uid']);
                if ($wave['hero']['hide'] == 1) {
                    $wave['hero'] = [];
                    $wave['units']['num'][11] = 0;
                } else {
                    $wave['heroItems'] = [
                        'leftHand' => $helper->procInput($inventory['leftHand']),
                        'rightHand' => $helper->procInput($inventory['rightHand']),
                        'body' => $helper->procInput($inventory['body']),
                        'shoes' => $helper->procInput($inventory['shoes']),
                        'bag' => $helper->procInput($inventory['bag']),
                        'horse' => $helper->procInput($inventory['horse']),
                        'helmet' => $helper->procInput($inventory['helmet']),
                    ];
                }
                $this->endProfile('assocDefender:hero');
            }
            $this->defender['wave'][] = $wave;
            if ($totalTraps > 0 && $this->defender['wave'][0]['race'] == 3) {
                $this->startProfile('assocDefender:fillTraps');
                $this->defender['traps'] = min($this->model->getTraps($this->row['to_kid']), $totalTraps);
                $this->defender['traps'] = max($this->defender['traps'], 0);
                $this->defender['traps'] -= $this->model->getFilledTrapCount($this->row['to_kid']);
                $this->endProfile('assocDefender:fillTraps');
            }
        }

        $this->startProfile('assocDefender:populatingEnforcements');

        $enforcement = $this->model->getEnforcement($this->row['to_kid']);
        while (($enforce = $enforcement->fetch_assoc())) {
            $wave = [
                'uid' => $enforce['uid'],
                'kid' => $enforce['kid'],
                'uniqueId' => $enforce['id'],
                'isEnforce' => true,
                'isForeign' => $enforce['kid'] <> $this->defender['isOccupied'],
                'race' => $enforce['race'],
                'units' => $this->model->getFullUnits($enforce['kid'], array_filter_units($enforce)),
                'hero' => [],
                'heroItems' => [],
            ];
            if ($wave['units']['num'][11]) {
                HeroHealthHelper::updateUserHeroHealth($wave['uid']);
                $inventory = $this->model->getInventory($wave['uid']);
                $helper = new HeroHelper();
                $wave['hero'] = $this->model->getHero($wave['uid']);
                $wave['heroItems'] = [
                    'leftHand' => $helper->procInput($inventory['leftHand']),
                    'rightHand' => $helper->procInput($inventory['rightHand']),
                    'body' => $helper->procInput($inventory['body']),
                    'shoes' => $helper->procInput($inventory['shoes']),
                    'bag' => $helper->procInput($inventory['bag']),
                    'horse' => $helper->procInput($inventory['horse']),
                    'helmet' => $helper->procInput($inventory['helmet']),
                ];
            }
            $this->defender['wave'][] = $wave;
        }
        $this->endProfile('assocDefender:populatingEnforcements');
        return true;
    }

    public function sendTruceReport($isAttacker)
    {
        $data = [
            'attacker' => [
                'kid' => $this->attacker['kid'],
                'uid' => $this->attacker['uid'],
                'uname' => $this->attacker['player']['name'],
                'race' => $this->attacker['wave']['race'],
                'num' => $this->attacker['wave']['units']['num'],
                'smithy' => $this->attacker['wave']['units']['smithy'],
                'dead' => null,
                'trapped' => null,
            ],
            'truceActive' => true,
            'truceReason' => TruceDay::getReasonId(),
        ];
        $reportType = 0;
        if ($isAttacker) {
            NoticeHelper::addNotice($this->attacker['player']['aid'], $this->attacker['uid'], $this->row['kid'], $this->row['to_kid'], $reportType, null, $data, $this->row['end_time_seconds']);
        } else {
            NoticeHelper::addNotice($this->defender['player']['aid'], $this->defender['uid'], $this->row['kid'], $this->row['kid'], $reportType, null, $data, $this->row['end_time_seconds']);
        }
    }

    private function finalize_caged_attack($caged)
    {
        $modify = [];
        foreach ($caged as $nr => $num) {
            if (!$num) {
                continue;
            }
            $modify[] = "u{$nr}=u{$nr}-" . $num;
        }
        $db = DB::getInstance();
        if (sizeof($modify)) {
            $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid={$this->row['to_kid']}");
        }
        $num = $this->attacker['wave']['heroItems']['bag']['num'];
        $total = array_sum($caged);
        $auction = new AuctionModel();
        $auction->decreaseCageOrientItem($this->attacker['uid'], $this->attacker['wave']['heroItems']['bag']['id'], $num, $total);
        if ($num == $total) {
            $this->attacker['wave']['heroItems']['bag'] = 0;
        }
        //send reinforcement of nature units to village.
        $calculator = new SpeedCalculator();
        $calculator->setFrom($this->row['to_kid']);
        $calculator->setTo($this->row['kid']);
        $speeds = [];
        foreach ($caged as $nr => $value) {
            if (!$value) {
                continue;
            }
            $speeds[] = Formulas::uSpeed(nrToUnitId($nr, 4));
        }
        $calculator->setMinSpeed($speeds);
        $neededTime = $calculator->calc();
        $move = new MovementsModel();
        $move->addMovement($this->row['to_kid'], $this->row['kid'], 4, $caged, 0, 0, 0, 0, 0, MovementsModel::ATTACKTYPE_REINFORCEMENT, $this->row['end_time'], $this->row['end_time'] + 1000 * $neededTime);
        //send hero back and send report.
        $helper = new HeroHelper();
        $calculator = new SpeedCalculator();
        $calculator->isReturn();
        $calculator->setFrom($this->row['to_kid']);
        $calculator->setTo($this->row['kid']);
        $calculator->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($this->attacker['uid'], $this->row['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $calculator->setTournamentSqLvl($this->attacker['buildings'][14]);
        $units = array_fill(1, 11, 0);
        for ($i = 1; $i <= 10; ++$i) {
            if ($this->attacker['wave']['units']['num'][$i] <= 0) {
                continue;
            }
            $units[$i] = $this->attacker['wave']['units']['num'][$i];
            $speeds[] = Formulas::uSpeed(nrToUnitId($i, $this->attacker['wave']['race']));
        }
        $units[11] = 1;
        $speeds[] = $helper->calcTotalSpeed($this->attacker['wave']['race'], $this->attacker['wave']['heroItems']['horse'], $this->attacker['wave']['heroItems']['shoes']);
        $calculator->setMinSpeed($speeds);
        $calculator->hasHero();
        $calculator->setLeftHand($this->attacker['wave']['heroItems']['leftHand']);
        $calculator->setShoes($this->attacker['wave']['heroItems']['shoes']);
        $end_time = $this->row['end_time'] + $calculator->calc() * 1000;
        $move = new MovementsModel();
        $move->addMovement($this->row['to_kid'], $this->row['kid'], $this->row['race'], $units, 0, 0, 0, 0, 1, $this->row['attack_type'], $this->row['end_time'], $end_time);
        $report = [
            'uid' => 0,
            'uname' => '<span class="errorMessage">' . T("Global", "NatureName") . '</span>',
            'kid' => $this->row['kid'],
            "caged" => $caged,
        ];
        NoticeHelper::addNotice(0, $this->attacker['uid'], $this->row['kid'], $this->row['to_kid'], NoticeHelper::TYPE_CAGED_ATTACK, null, $report, $this->row['end_time_seconds'], 0);
        $now = time();
        $db->query("UPDATE odata SET lastfarmed=$now WHERE kid={$this->row['to_kid']}");
    }

    private function finalize_spy_attack($off_losses)
    {
        $attacker = $this->finalize_attacker_states($off_losses);
        $defender = $this->finalize_defender_states($attacker, 0);

        $this->setAttackerPoints(0, 0);
        $this->setDefenderPoints(0, $attacker['total_dead_upkeep'], $defender['def_points_share']);
        $this->setCasualties($attacker['total_dead'], $defender['total_dead']);

        $spyType = $this->row['spyType'];
        $report = [
            'losses' => [$off_losses, 0],
            'attacker' => [
                'kid' => $this->attacker['kid'],
                'uid' => $this->attacker['uid'],
                'uname' => $this->attacker['player']['name'],
                'race' => $this->attacker['wave']['race'],
                'num' => $this->attacker['wave']['units']['num'],
                'dead' => $this->attacker['wave']['units']['dead'],
                'smithy' => $this->attacker['wave']['units']['smithy'],
                'trapped' => null,
            ],
            'defender' => $this->getDefenderUnitsForReport(),
            'info' => [],
        ];
        //populate info here.
        if ($attacker['total_left'] <= 0) {
            $reportType = NoticeHelper::TYPE_LOST_AS_SPY;
            $tmp = $report;
            $report['info']['none_return'] = $tmp['info']['none_return'] = true;
            $tmp['defender'] = [$tmp['defender'][0]];
            foreach ($tmp['defender'] as &$val) {
                $val['num'] = array_fill(1, 11, '?');
                $val['dead'] = null;
            }
            NoticeHelper::addNotice($this->attacker['player']['aid'], $this->attacker['uid'], $this->row['kid'], $this->row['to_kid'], $reportType, null, $tmp, $this->row['end_time_seconds']);
        } else {
            $reportType = $attacker['total_dead'] > 0 ? NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES : NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES;
            if ($spyType == 1) {//resources | cranny.
                $report['info']['res'] = $this->getAvailableResources();
                $report['info']['cranny'] = $this->getTotalCranny();
            } else {
                $gid = Formulas::getWallID($this->defender['wave'][0]['race']);
                $report['info']['wall'] = [
                    $gid,
                    $this->defender['buildings'][40]['level'],
                ];
                $gid = $level = 0;
                foreach ($this->defender['buildings'] as $build) {
                    if (in_array($build['item_id'], [25, 26, 44])) {
                        $gid = $build['item_id'];
                        $level = $build['level'];
                        break;
                    }
                }
                if ($gid <> 0) {
                    $report['info']['rp'] = [$gid, $level];
                }
            }
            NoticeHelper::addNotice($this->attacker['player']['aid'], $this->attacker['uid'], $this->row['kid'], $this->row['to_kid'], $reportType, null, $report, $this->row['end_time_seconds']);
        }
        //report defender.
        if ($attacker['total_dead'] > 0) {
            if ((!$this->defender['isOasis'] || $this->defender['isOccupied']) && $this->defender['uid'] > 0 && $this->attacker['uid'] <> $this->defender['uid']) {
                $reportType = $reportType == NoticeHelper::TYPE_LOST_AS_SPY ? NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY : NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY;
                NoticeHelper::addNotice($this->defender['player']['aid'], $this->defender['uid'], $this->row['kid'], $this->row['to_kid'], $reportType, null, $report, $this->row['end_time_seconds']);
            }
        }
        if ($attacker['total_left'] > 0) {
            $this->finalize_troops_return(implode(",", isset($this->info['bounty']) ? $this->info['bounty'] : []));
        }
    }

    private function setAttackerPoints($total_bounty, $def_total_upkeep)
    {
        $total_bounty_percent = 1;
        if ($this->getAlive($this->attacker['wave'], 11)) {
            $helper = new HeroHelper();
            $heroBonusRob = $helper->calcRobPoints($this->attacker['wave']['heroItems']['leftHand']);
            $total_bounty_percent = 1 + $heroBonusRob / 100;
        }
        if (isset($this->attacker['player']['aid']) && $this->attacker['player']['aid']) {
            $m = new AllianceModel();
            $m->setAlliancePoints($this->attacker['player']['aid'], $def_total_upkeep, 0, +$total_bounty * $total_bounty_percent);
        }
        if ($this->attacker['uid'] > 2) {
            $m = new PlayerModel();
            $m->setPlayerPoints($this->attacker['uid'], $def_total_upkeep, 0, +$total_bounty * $total_bounty_percent);
        }
    }

    private function setDefenderPoints($total_bounty, $atk_total_upkeep, $def_points_share)
    {
        $playerModel = new PlayerModel();
        $allianceModel = new AllianceModel();

        foreach ($def_points_share as $uid => $share) {
            if ($uid > 2) {
                $bounty = $uid == $this->defender['uid'] ? -$total_bounty : 0;
                $playerModel->setPlayerPoints($uid, 0, $share, $bounty);
                $allianceModel->setAlliancePointsByUid($uid, 0, $share, $bounty);
            }
        }
    }

    private function setCasualties($atk_total_dead, $def_total_dead)
    {
        $m = new CasualtiesModel();
        $m->setTodayCasualties($atk_total_dead + $def_total_dead);
    }

    private function getAlive($wave, $i)
    {
        return $wave['units']['num'][$i] - $wave['units']['trapped'][$i] - $wave['units']['dead'][$i];
    }

    private function getDefenderUnitsForReport()
    {
        $assoc = [];
        $assoc[0] = [
            'kid' => $this->defender['wave'][0]['uniqueId'],
            'race' => $this->defender['wave'][0]['race'],
            'num' => $this->defender['wave'][0]['units']['num'],
            'dead' => $this->defender['wave'][0]['units']['dead'],
            'smithy' => $this->defender['wave'][0]['units']['smithy'],
        ];
        if (!$this->defender['isOasis'] || $this->defender['isOccupied']) {
            $assoc[0]['uid'] = $this->defender['uid'];
            $assoc[0]['uname'] = $this->defender['player']['name'];
        }
        foreach ($this->defender['wave'] as $key => $army) {
            if ($key == 0) {
                continue;
            }
            if (!$army['isEnforce'] || !array_sum($army['units']['num'])) {
                continue;
            }
            if (!$army['isForeign']) {
                for ($i = 1; $i <= ($army['race'] == 4 ? 10 : 11); ++$i) {
                    $assoc[0]['num'][$i] += $army['units']['num'][$i];
                    $assoc[0]['dead'][$i] += $army['units']['dead'][$i];
                }
                continue;
            }
            if (!isset($assoc[$army['race']])) {
                $assoc[$army['race']]['race'] = $army['race'];
                $assoc[$army['race']]['num'] = array_fill(1, $army['race'] == 4 ? 10 : 11, 0);
                $assoc[$army['race']]['dead'] = array_fill(1, $army['race'] == 4 ? 10 : 11, 0);
            }
            for ($i = 1; $i <= ($army['race'] == 4 ? 10 : 11); ++$i) {
                $assoc[$army['race']]['num'][$i] += $army['units']['num'][$i];
                $assoc[$army['race']]['dead'][$i] += $army['units']['dead'][$i];
            }
        }
        return $assoc;
    }

    private function getAvailableResources()
    {
        $db = DB::getInstance();
        if ($this->defender['isOasis']) {
            if (!$this->defender['isOccupied']) {
                (new OasesModel())->updateResources($this->row['to_kid']);
                $resources = $db->query("SELECT wood, clay, iron, crop FROM odata WHERE kid={$this->row['to_kid']}")->fetch_assoc();
                $resources = [1 => $resources['wood'], $resources['clay'], $resources['iron'], $resources['crop'],];
            } else {
                ResourcesHelper::updateVillageResources($this->defender['isOccupied'], true);
                $village = $db->query("SELECT woodp, clayp, ironp, cropp, wood, clay, iron, crop FROM vdata WHERE kid={$this->defender['isOccupied']}")->fetch_assoc();
                $resources = [1 => $village['wood'], $village['clay'], $village['iron'], $village['crop']];
                $lastFarmed = $db->fetchScalar("SELECT lastfarmed FROM odata WHERE kid={$this->row['to_kid']}");
                $rate = min(10, ceil((time() - $lastFarmed) / 60)) / 100;
                $resources = array_map(function ($x) use ($rate) {
                    return $x * $rate;
                }, $resources);
            }
        } else {
            ResourcesHelper::updateVillageResources($this->row['to_kid'], true);
            $resources = $db->query("SELECT wood, clay, iron, crop FROM vdata WHERE kid={$this->row['to_kid']}")->fetch_assoc();
            $resources = [1 => $resources['wood'], $resources['clay'], $resources['iron'], $resources['crop']];
        }
        return array_map(function ($x) {
            return floor(max($x, 0));
        }, $resources);
    }

    private function getTotalCranny()
    {
        if ($this->defender['isOasis']) {
            return 0;
        }
        if (isset($this->defender['modifyCranny']) && $this->defender['modifyCranny']) {
            $total_cranny = 0;
            foreach ($this->defender['crannyIds'] as $i) {
                $build = $this->defender['buildings'][$i];
                if ($build['item_id'] != 36) continue;
                $total_cranny += Formulas::crannyCAP($build['level'], $this->defender['wave'][0]['race']);
            }
        } else {
            $total_cranny = $this->defender['totalCranny'];
        }
        if ($total_cranny) {
            $total_cranny *= ArtefactsModel::getArtifactEffectByType($this->defender['uid'], $this->row['to_kid'], ArtefactsModel::ARTIFACT_CRANNY);
            //*20% for version 3.5 and above. *20% for version 4, but MUST have the hero in the army
            $alive = $this->attacker['wave']['units']['num'][11] - $this->attacker['wave']['units']['trapped'][11] - $this->attacker['wave']['units']['dead'][11];
            $total_cranny *= ($alive && $this->attacker['wave']['race'] == 2) ? (4 / 5) : 1; //attacker teuton bonus
        }

        return $total_cranny;
    }

    private function calc_offense($brewery)
    {
        // init
        $offense = ['i' => 0, 'c' => 0, 'b' => 1];
        // units
        $item_bonus = $this->item_unit_bonus($this->attacker['wave']);
        $this->unit_offense($this->attacker['wave']['race'], $this->attacker['wave']['units'], $item_bonus, $offense);
        // hero // added trapped.
        if ($this->attacker['wave']['units']['num'][11] - $this->attacker['wave']['units']['trapped'][11]) {
            $this->hero_boni($this->attacker['wave'], $offense, true);
        }
        // brewery
        if ($brewery) {
            $offense['b'] *= 1 + (int)$brewery * 0.01;
        }

        return $offense;
    }

    private function item_unit_bonus($wave)
    {
        $item_bonus = array_fill(1, 10, 0);
        if (!in_array($wave['race'], [1, 2, 3, 6, 7])) {
            return $item_bonus;
        }
        // set weapon unit bonus
        //right hand
        //process right hand item bonus for units.
        if ($wave['units']['num'][11] && is_array($wave['heroItems']['rightHand'])) {
            $item = $this->heroItemsModel->getHeroItemProperties($wave['heroItems']['rightHand']['btype'],
                $wave['heroItems']['rightHand']['type']);
            if (isset($item['unit_power']) && isset($item['unitId'])) {
                $race = unitIdToTribe($item['unitId']);
                $nr = unitIdToNr($item['unitId']);
                if ($race == $wave['race']) {
                    $item_bonus[$nr] += $item['unit_power'];
                }
            }
        }

        return $item_bonus;
    }

    private function hero_boni(&$wave, &$stats, $isOffense)
    {
        $arm = 0;
        $str = 0;
        // items
        if ($wave['units']['num'][11]) {
            $items = [
                $wave['heroItems']['leftHand'],
                $wave['heroItems']['rightHand'],
                $wave['heroItems']['body'],
            ];
            for ($i = 0; $i < 3; $i++) {
                if (!is_array($items[$i])) {
                    continue;
                }
                $item = $this->heroItemsModel->getHeroItemProperties($items[$i]['btype'], $items[$i]['type']);
                if (isset($item['resist'])) {
                    $arm += $item['resist'];
                }
                if (isset($item['hero_power'])) {
                    $str += $item['hero_power'];
                }
            }
            // natarian horns
            $leftHand = $wave['heroItems']['leftHand'];
            if (is_array($leftHand)) {
                $item = $this->heroItemsModel->getHeroItemProperties($leftHand['btype'], $leftHand['type']);
                if (isset($item['powerAgainstNatars'])) {
                    $stats['n'] = $item['powerAgainstNatars'];
                }
            }
        }
        $wave['hero']['resist'] = $arm;
        $this->set_hero_stats($wave, $str, $stats, $isOffense);
    }

    private function set_hero_stats($wave, $str, &$stats, $isOffense)
    {
        $r = $wave['race'];
        $s = $wave['hero']['power'];
        $st = $this->hero_str4($wave, $s, $r, $str, $isOffense);
        $stats['i'] += $st[0];
        $stats['c'] += $st[1];
        $stats['b'] *= 1 + $wave['hero'][(($isOffense ? "off" : "def") . 'Bonus')] * 0.002;
    }

    private function hero_str4($wave, $s, $r, $str_add, $isOffense)
    {
        $str = 100 + $s * ($r ? 80 : 100) + $str_add;
        if ($isOffense) {
            $stats = [0, 0];
            $stats[is_array($wave['heroItems']['horse']) ? 1 : 0] += $str;

            return $stats;
        }

        return [$str, $str];
    }

    private function finalize_stats(&$stats)
    {
        $stats['i'] *= $stats['b'];
        $stats['c'] *= $stats['b'];
        $stats['t'] = $stats['i'] + $stats['c'];
    }

    private function calc_total_defense($offense)
    {
        $defense = ['i' => 0, 'c' => 0, 'b' => 1];
        foreach ($this->defender['wave'] as &$army) {
            $this->calc_defense($army, $defense, $offense);
        }

        return $defense;
    }

    private function calc_defense(&$wave, &$defense, $offense)
    {
        $wave['net_def_point'] = 0;
        $def = ['i' => 0, 'c' => 0, 'b' => 1];
        $item_bonus = $this->item_unit_bonus($wave);
        $this->unit_defense($wave, $item_bonus, $def);

        if (!empty($wave['units']['num'][11])) {
            $this->hero_boni($wave, $def, false);
        }
        //if (isset($wave['P'])) $def['b'] *= 1.1;
        $defense['i'] += $def['i'] * $def['b'];
        $defense['c'] += $def['c'] * $def['b'];


        $wave['net_def_point'] = $this->model->adduced_def($def['i'], $def['c'], $offense['i'], $offense['c']);
    }

    private function unit_offense($r, $wave, $item_bonus, &$offense)
    {
        for ($u = 1; $u <= 10; $u++) {
            $up_level = (in_array($r, [1, 2, 3, 6, 7, 8]) and $u <= 8) ? $wave['smithy'][$u] : 0;
            $value = $item_bonus[$u] + $this->model->stat_with_upg($this->off[$r][$u],
                    $this->upkeep[$r][$u],
                    $up_level);

            $type = isset($this->is_cavalary[$r][$u]) ? 'c' : 'i';

            $offense[$type] += $value * ($wave['num'][$u] - $wave['trapped'][$u]);
        }
    }

    private function unit_defense($wave, $item_bonus, &$def)
    {
        $r = $this->model->int_check_limit($wave, 'race', 1, 7);
        $wave = $wave['units'];
        for ($u = 1; $u <= 10; $u++) {
            $up_level = (in_array($r, [1, 2, 3, 6, 7, 8]) && $u <= 8) ? $wave['smithy'][$u] : 0;
            $cu = $this->upkeep[$r][$u];

            $def_i = $this->model->stat_with_upg($this->def_i[$r][$u], $cu, $up_level);
            $def_c = $this->model->stat_with_upg($this->def_c[$r][$u], $cu, $up_level);

            $def['i'] += $wave['num'][$u] * $def_i + $item_bonus[$u];
            $def['c'] += $wave['num'][$u] * $def_c + $item_bonus[$u];

        }
    }

    private function finalize_attack($no_morale, $pop_ratio, $losses, $total_off_point, $total_def_point)
    {
        $artifactCaptured = false;
        $this->startProfile('finalize_attack:finalize_attacker_states');
        $attacker = $this->finalize_attacker_states($losses[0]);
        $this->endProfile('finalize_attack:finalize_attacker_states');
        $this->startProfile('finalize_attack:finalize_defender_states');
        $defender = $this->finalize_defender_states($attacker, $losses[1]);
        $this->endProfile('finalize_attack:finalize_defender_states');
        $captured = false;

        $this->startProfile('finalize_attack:handleHeroExperienceAndDamage');
        $this->handleHeroExperienceAndDamage($losses, $defender);
        $this->endProfile('finalize_attack:handleHeroExperienceAndDamage');

        if (!$attacker['total_left']) {
            $this->startProfile('finalize_attack:handlePointsAndBounty');
            $this->handlePointsAndBounty($attacker, $defender, $total_off_point, $total_def_point);
            $this->endProfile('finalize_attack:handlePointsAndBounty');
            $this->info['none_return'] = true;
            unset($this->info['bounty']);
            goto finalize;
        }
        if ($this->getAlive($this->attacker['wave'], 11)) {
            $this->startProfile('finalize_attack:handleOasisCapture');
            $this->handleOasisCapture($defender);
            $this->endProfile('finalize_attack:handleOasisCapture');
        }
        if ($this->row['attack_type'] == MovementsModel::ATTACKTYPE_NORMAL) {
            if (ArtefactsModel::artifactsReleased() && $this->getAlive($this->attacker['wave'], 11)) {
                $this->startProfile('finalize_attack:handleArtefactCapture');
                $artifactCaptured = $this->handleArtefactCapture();
                $this->endProfile('finalize_attack:handleArtefactCapture');
            }
            $this->startProfile('finalize_attack:handleVillageCapture');
            if (!isset($this->info['totally_destroyed']) || !$this->info['totally_destroyed']) {
                $captured = $this->handleVillageCapture($no_morale, $pop_ratio);
            }
            $this->endProfile('finalize_attack:handleVillageCapture');
        }
        $this->startProfile('finalize_attack:handlePointsAndBounty');
        $this->handlePointsAndBounty($attacker, $defender, $total_off_point, $total_def_point, $captured);
        $this->endProfile('finalize_attack:handlePointsAndBounty');
        if ($this->row['attack_type'] == MovementsModel::ATTACKTYPE_NORMAL) {
            $this->startProfile('finalize_attack:handleTrapFreeOnNormalAttack');
            $this->handleTrapFreeOnNormalAttack($attacker);
            $this->endProfile('finalize_attack:handleTrapFreeOnNormalAttack');
        }
        if (!$captured && $this->attacker['uid'] <> 1) {
            $this->startProfile('finalize_attack:finalize_troops_return');
            $this->finalize_troops_return(implode(",", isset($this->info['bounty']) ? $this->info['bounty'] : []));
            $this->endProfile('finalize_attack:finalize_troops_return');
        }
        finalize:
        $db = DB::getInstance();
        $now = floor($this->row['end_time'] / 1000);
        if ($this->defender['isOasis'] && !$this->defender['isOccupied']) {
            $this->startProfile('finalize_attack:addSurrounding');
            $xy = Formulas::kid2xy($this->row['to_kid']);
            NoticeHelper::addSurrounding($xy['x'], $xy['y'], NoticeHelper::SURROUNDING_OASIS_RAID, null, $this->row['end_time_seconds']);
            $this->endProfile('finalize_attack:addSurrounding');
        }
        if ($this->defender['isOasis']) {
            $db->query("UPDATE odata SET lastfarmed=$now WHERE kid={$this->row['to_kid']}");
        }
        $this->startProfile('finalize_attack:sendBattleReports');
        $this->sendBattleReports($attacker, $defender, $losses[0], $losses[1]);
        $this->endProfile('finalize_attack:sendBattleReports');
        if (isset($this->defender['uid']) && $this->defender['uid'] == 1 && $artifactCaptured) {
            $this->startProfile('finalize_attack:deleteVillage');
            (new AccountDeleter())->deleteVillage($this->row['to_kid']);
            $this->endProfile('finalize_attack:deleteVillage');
        }
    }

    private function finalize_attacker_states($off_losses)
    {
        $db = DB::getInstance();
        $upkeep = $modifiedUpkeep = 0;
        $this->attacker['total_bounty'] = 0;
        $helper = new HeroHelper();


        for ($i = 1; $i <= 11; ++$i) {
            $num = $this->attacker['wave']['units']['num'][$i] - $this->attacker['wave']['units']['trapped'][$i];
            if ($i == 11 && $this->attacker['wave']['units']['num'][11]) {
                if ($this->attacker['wave']['units']['trapped'][11] == 0) {
                    $lossPercent = $off_losses * 100 - $helper->calcResist($this->attacker['wave']['heroItems']['body']);
                    if ($lossPercent < 0) {
                        $lossPercent = 0;
                    }
                    if ($lossPercent >= min(90, $this->attacker['wave']['hero']['health']) || ($this->attacker['wave']['hero']['health'] - $lossPercent < 1)) {
                        //updating resources to now.
                        $this->attacker['wave']['units']['dead'][$i] = 1;
                        $upkeep += 6;
                        $db->query("UPDATE hero SET health=0 WHERE uid=" . $this->attacker['uid']);

                        // Update hero resources on kill
                        ResourcesHelper::updateVillageResources($this->row['kid'], false);

                        $modifiedUpkeep += 6;

                    } else if ($lossPercent) {
                        $lossPercent = min($this->attacker['wave']['hero']['health'], $lossPercent);
                        $db->query("UPDATE hero SET health=health-$lossPercent WHERE uid=" . $this->attacker['uid']);
                    }
                } else {
                    $this->attacker['wave']['units']['dead'][$i] = $dead = 0;
                }
            } else {
                $this->attacker['wave']['units']['dead'][$i] = $dead = min($num, round($num * $off_losses));
                $upkeep += $dead * Formulas::uUpkeep(nrToUnitId($i, $this->attacker['wave']['race']), 0, true);
                $modifiedUpkeep += $dead * Formulas::uUpkeep(nrToUnitId($i, $this->attacker['wave']['race']), $this->attacker['buildings'][41], true);
            }
            if ($i < 11) {
                $alive = $this->attacker['wave']['units']['num'][$i] - $this->attacker['wave']['units']['trapped'][$i] - $this->attacker['wave']['units']['dead'][$i];
                if ($alive) {
                    $this->attacker['total_bounty'] += $alive * Formulas::uCarry(nrToUnitId($i, $this->attacker['wave']['race']));
                }
            }
        }
        $move = new MovementsModel();
        $total_trapped = array_sum($this->attacker['wave']['units']['trapped']);
        if ($total_trapped) {//auto move to traps!
            $trappedId = $move->isSameVillageTrappedExists($this->row['kid'], $this->row['to_kid']);
            if ($trappedId !== false) {
                $modify = [];
                for ($i = 1; $i <= 11; ++$i) {
                    $trapped = $this->attacker['wave']['units']['trapped'][$i];
                    if ($trapped) {
                        $modify[] = "u{$i}=u{$i}+" . $trapped;
                    }
                }
                $db->query("UPDATE trapped SET " . implode(",", $modify) . " WHERE id=$trappedId");
            } else {
                $move->addTrapped($this->row['kid'], $this->row['to_kid'], $this->row['race'], $this->attacker['wave']['units']['trapped']);
            }
        }
        if ($this->attacker['wave']['units']['num'][11] > 0) {
            $_revived = $this->get_revived($this->attacker['wave']);
            if (0 < ($bandages = array_sum($_revived))) {
                $neededTime = 1000 * max(86400 / getGame('movement_speed_increase'), 300);
                $move->addMovement($this->row['kid'], $this->row['kid'], $this->row['race'], $_revived, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $this->row['end_time'], $this->row['end_time'] + $neededTime, null);
                $m = new AuctionModel();
                $m->decreaseCageOrientItem($this->attacker['uid'], $this->attacker['wave']['heroItems']['bag']['id'], $this->attacker['wave']['heroItems']['bag']['num'], $bandages);
            }
        }
        $total = array_sum($this->attacker['wave']['units']['num']);
        $totalDead = array_sum($this->attacker['wave']['units']['dead']);

        if ($modifiedUpkeep > 0) {
            ResourcesHelper::modifyUpkeep($this->attacker['uid'], $this->row['kid'], $modifiedUpkeep, 1);
        }
        return [
            'total_dead' => array_sum($this->attacker['wave']['units']['dead']),
            'total_dead_upkeep' => $upkeep,//for top 10 points.
            'total_trapped' => $total_trapped,
            'total_left' => $total - $totalDead - $total_trapped,
        ];
    }

    private function get_revived($army)
    {
        if (empty($army['units']['num'][11])) {
            $bandages = 0;
        } else {
            $dead = array_fill(1, 10, 0);
            for ($u = 1; $u <= 10; $u++) {
                $un = $army['units']['dead'][$u];
                $dead[$u] = $un;
            }
            $helper = new HeroHelper();
            $total = array_sum($dead);
            $bandages = $helper->getBandages($army['heroItems']['bag']);
            $bandages = min($bandages['num'], ceil($total * $bandages['eff'] / 100));
        }
        if (!$bandages) {
            return [];
        }

        return $this->model->move_to_traps($dead, $bandages);
    }

    private function finalize_defender_states($attacker, $def_losses)
    {
        $def_points_share = [];
        $db = DB::getInstance();
        $total_dead = $upkeep = $modifiedUpkeep = 0;
        $total_num = 0;
        $move = new MovementsModel();
        $helper = new HeroHelper();

        $heroCount = 0;
        foreach ($this->defender['wave'] as &$value) {
            if ($value['units']['num'][11] > 0) {
                ++$heroCount;
            }
        }
        $heroShare = $heroCount > 0 ? $attacker['total_dead_upkeep'] / $heroCount : 0;

        foreach ($this->defender['wave'] as &$value) {
            if ($this->defender['total_net_def_point'] == 0) {
                $share = 0;
            } else {
                $share = $attacker['total_dead_upkeep'] * ($value['net_def_point'] / $this->defender['total_net_def_point']);
            }
            if (isset($value['uid'])) {
                if (!isset($def_points_share[$value['uid']])) {
                    $def_points_share[$value['uid']] = 0;
                }
                $def_points_share[$value['uid']] += $share;
            }
            //logError('Share: %s: %s, net_def=%s', [$value['uid'], $share, $value['net_def_point']]);
            $total = array_sum($value['units']['num']);
            $total_num += $total;
            $modify = [];
            for ($i = 1; $i <= ($value['race'] == 4 ? 10 : 11); ++$i) {
                if ($i == 11 && $value['units']['num'][11]) {
                    $lossPercent = $def_losses * 100 - $helper->calcResist($value['heroItems']['body']);
                    if ($lossPercent < 0)
                        $lossPercent = 0;
                    if ($lossPercent >= min(90, $value['hero']['health']) || ($value['hero']['health'] - $lossPercent < 1)) {
                        $dead = 1;
                        $upkeep += 6;
                        $modifiedUpkeep += 6;
                        $total_dead++;
                        //updating resources to now.
                        $db->query("UPDATE hero SET health=0, exp=exp+$heroShare WHERE health>0 AND uid=" . $value['uid']);

                        // Update hero resources on kill
                        ResourcesHelper::updateVillageResources($value['kid'], false);
                    } else {
                        $dead = 0;
                        if ($lossPercent) {
                            if (is_array($value['heroItems']['bag']) && $value['heroItems']['bag'] == 11) {
                                $health = min($value['heroItems']['bag']['num'], $lossPercent);
                                $health = min($health, abs(100 - $value['hero']['health'] - $lossPercent));
                                if ($health) {
                                    $db->query("UPDATE hero SET health=health+$health WHERE uid={$value['hero']['uid']}");
                                    $auction = new AuctionModel();
                                    $auction->decreaseCageOrientItem($value['heroItems']['bag']['uid'], $value['heroItems']['bag']['id'], $value['heroItems']['bag']['num'], $health);
                                    if ($value['heroItems']['bag']['num'] == $health) {
                                        $value['heroItems']['bag'] = 0;
                                    }
                                }
                            }
                            $db->query("UPDATE hero SET health=health-$lossPercent, exp=exp+$heroShare WHERE uid={$value['uid']}");
                        }
                    }
                } else {
                    $dead = min($value['units']['num'][$i], round($value['units']['num'][$i] * $def_losses));
                    $total_dead += $dead;
                    $upkeep += $dead * Formulas::uUpkeep(nrToUnitId($i, $value['race']), 0, true);
                    $modifiedUpkeep += $dead * Formulas::uUpkeep(nrToUnitId($i, $value['race']), $this->defender['hdp'], true);
                }
                if ($dead > 0) {
                    $modify[] = "u{$i}=u{$i}-" . $dead;
                }
                $value['units']['dead'][$i] = $dead;
            }

            if ($value['units']['num'][11]) {
                $_revived = $this->get_revived($value);
                $bandages = array_sum($_revived);
                if ($bandages > 0) {
                    $neededTime = 1000 * max(86400 / getGame('movement_speed_increase'), 300);
                    if ($value['isEnforce']) {
                        $move->addMovement($value['kid'], $value['kid'], $value['race'], $_revived, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $this->row['end_time'], $this->row['end_time'] + $neededTime, null);
                    } else {
                        $move->addMovement($this->row['to_kid'], $this->row['to_kid'], $value['race'], $_revived, 0, 0, 0, 0, 1, MovementsModel::ATTACKTYPE_REINFORCEMENT, $this->row['end_time'], $this->row['end_time'] + $neededTime, null);
                    }
                    $m = new AuctionModel();
                    $m->decreaseCageOrientItem($value['hero']['uid'], $value['heroItems']['bag']['id'], $value['heroItems']['bag']['num'], $bandages);
                }
            }
            if ($value['isEnforce']) {
                if (!($total - array_sum($value['units']['dead']))) {
                    $db->query("DELETE FROM enforcement WHERE id=" . $value['uniqueId']);
                } else if (sizeof($modify)) {
                    $set = implode(",", $modify);
                    $db->query("UPDATE enforcement SET $set WHERE id=" . $value['uniqueId']);
                }
            } else if (sizeof($modify)) {
                $set = implode(",", $modify);
                $db->query("UPDATE units SET $set WHERE kid=" . $value['uniqueId']);
            }
        }
        $this->startProfile('finalize_defender_states:modifyUpkeep');
        if ($this->defender['isOasis']) {
            if ($this->defender['isOccupied']) {
                ResourcesHelper::modifyUpkeep($this->defender['uid'], $this->defender['isOccupied'], $modifiedUpkeep, 1);
            }
        } else {
            ResourcesHelper::modifyUpkeep($this->defender['uid'], $this->row['to_kid'], $modifiedUpkeep, 1);
        }
        $this->endProfile('finalize_defender_states:modifyUpkeep');
        return [
            'total_dead' => $total_dead,
            'total_dead_upkeep' => $upkeep,
            'total_num' => $total_num,
            'total_left' => $total_num - $total_dead,
            'def_points_share' => $def_points_share,
        ];
    }

    /**
     * @param $losses
     * @param $defender
     */
    private function handleHeroExperienceAndDamage($losses, $defender)
    {
        $db = DB::getInstance();
        if ($this->attacker['wave']['units']['num'][11]) {
            $helper = new HeroHelper();
            $effectRate = ((100 + $helper->calcMoreExp($this->attacker['wave']['heroItems']['helmet'])) / 100);
            $exp = $defender['total_dead_upkeep'] * $effectRate;
            $db->query("UPDATE hero SET exp=exp+$exp WHERE uid={$this->attacker['uid']}");
        }
        $helper = new HeroHelper();
        if ($this->getAlive($this->attacker['wave'], 11) && is_array($this->attacker['wave']['heroItems']['bag'])) {
            if (isset($this->attacker['wave']['heroItems']['bag']['btype']) && $this->attacker['wave']['heroItems']['bag']['btype'] == 11) {
                $lossPercent = max(min($losses[0] * 100 - $helper->calcResist($this->attacker['wave']['heroItems']['body']),
                    $this->attacker['wave']['hero']['health']),
                    0);
                if ($lossPercent) {
                    $health = min($this->attacker['wave']['heroItems']['bag']['num'], $lossPercent);
                    $health = min($health, abs(100 - $this->attacker['wave']['hero']['health'] - $lossPercent));
                    $db->query("UPDATE hero SET health=health+$health WHERE uid={$this->attacker['uid']}");
                    $auction = new AuctionModel();
                    $auction->decreaseCageOrientItem($this->attacker['uid'], $this->attacker['wave']['heroItems']['bag']['id'], $this->attacker['wave']['heroItems']['bag']['num'], $health);
                    if ($this->attacker['wave']['heroItems']['bag']['num'] == $health) {
                        $this->attacker['wave']['heroItems']['bag'] = 0;
                    }
                }
            }
        }
    }

    private function handlePointsAndBounty($attacker, $defender, $total_off_point, $total_def_point, $captured = false)
    {
        $total_bounty = 0;
        if (!$captured) {
            $this->startProfile('handlePointsAndBounty:modifyBounty');
            $this->modifyBounty();
            $total_bounty = array_sum($this->info['bounty']) - $this->info['bounty'][5];
            $this->endProfile('handlePointsAndBounty:modifyBounty');
        }
        if (getDisplay('topHammers')) {
            $this->handleTopDefTopOffHammerStatistics($total_off_point, $total_def_point);
        }
        $this->startProfile('handlePointsAndBounty:setAttackerPoints');
        $this->setAttackerPoints($total_bounty, $defender['total_dead_upkeep']);
        $this->endProfile('handlePointsAndBounty:setAttackerPoints');
        $this->startProfile('handlePointsAndBounty:setDefenderPoints');
        $this->setDefenderPoints($total_bounty, $attacker['total_dead_upkeep'], $defender['def_points_share']);
        $this->endProfile('handlePointsAndBounty:setDefenderPoints');
        $this->startProfile('handlePointsAndBounty:setCasualties');
        $this->setCasualties($attacker['total_dead'], $defender['total_dead']);
        $this->endProfile('handlePointsAndBounty:setCasualties');
        $this->startProfile('handlePointsAndBounty:handleDailyQuestAchivements');
        $this->handleDailyQuestAchivements();
        $this->endProfile('handlePointsAndBounty:handleDailyQuestAchivements');
    }

    private function modifyBounty()
    {
        //modify bounty.
        $total_bounty = $maxCarryLoad = $this->attacker['total_bounty'];
        $resources = $this->get_available_resources_to_raid();
        if ($this->isFarm || isset($this->defender['uid']) && $this->defender['uid'] == 1) {
            $resources = array_map(function ($x) {
                return floor($x * 0.5);
            }, $resources);
        }
        if ($total_bounty >= array_sum($resources)) {
            $this->info['bounty'] = $resources;
        } else {
            $this->info['bounty'] = [1 => 0, 0, 0, 0];
            $x = 0;
            $divFactor = 4;
            while ($maxCarryLoad > 0) {
                ++$x;
                $curTotalRes = 0;
                $div = floor($maxCarryLoad / $divFactor);
                for ($i = 1; $i <= 4; ++$i) {
                    $take = min($div, $resources[$i], $maxCarryLoad);
                    $maxCarryLoad -= $take;
                    $resources[$i] -= $take;
                    $this->info['bounty'][$i] += $take;
                    $curTotalRes += $take;
                }
                if ($curTotalRes <= 0 && $divFactor == 1) {
                    break;
                }
                $divFactor = 1;
            }
        }
        $this->set_village_or_oasis_resources($this->info['bounty']);
        $this->info['bounty'][] = $total_bounty;
    }

    private function get_available_resources_to_raid()
    {
        $resources = $this->getAvailableResources();
        $cranny = $this->getTotalCranny();
        for ($i = 1; $i <= 4; ++$i) {
            $resources[$i] = max(0, $resources[$i] - $cranny);
        }
        return $resources;
    }

    function set_village_or_oasis_resources($steal)
    {
        if (!array_sum($steal)) {
            return true;
        }
        if ($this->defender['isOasis']) {
            if (!$this->defender['isOccupied']) {
                $this->model->modifyOasisResources($this->row['to_kid'], [$steal[1], $steal[2], $steal[3], $steal[4]]);
            } else {
                $this->model->modifyVillageResources($this->defender['isOccupied'], [
                    $steal[1],
                    $steal[2],
                    $steal[3],
                    $steal[4],
                ]);
            }
        } else {
            $this->model->modifyVillageResources($this->row['to_kid'], [$steal[1], $steal[2], $steal[3], $steal[4]]);
        }
        return true;
    }

    /**
     * @param $total_off_point
     * @param $total_def_point
     */
    private function handleTopDefTopOffHammerStatistics($total_off_point, $total_def_point)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET max_off_point=GREATEST(max_off_point, $total_off_point) WHERE id={$this->attacker['uid']}");
        if ($db->affectedRows()) {
            $this->isTopOff = true;
            $db->query("UPDATE users SET max_off_time=" . $this->row['end_time_seconds'] . " WHERE id={$this->attacker['uid']}");
        }
        if (isset($this->defender['uid']) && $this->defender['uid'] > 2) {
            $db->query("UPDATE users SET max_def_point=GREATEST(max_def_point, $total_def_point) WHERE id={$this->defender['uid']}");
            if ($db->affectedRows()) {
                $this->isTopDef = true;
                $db->query("UPDATE users SET max_def_time=" . $this->row['end_time_seconds'] . " WHERE id={$this->defender['uid']}");
            }
        }
    }

    private function handleDailyQuestAchivements()
    {
        if ($this->defender['isOasis'] && !$this->defender['isOccupied']) {
            (new DailyQuestModel())->setQuestAsCompleted($this->attacker['uid'], 2);
        }
        if (!$this->defender['isOasis'] && isset($this->defender['uid']) && $this->defender['uid'] == 1) {
            (new DailyQuestModel())->setQuestAsCompleted($this->attacker['uid'], 3);
        }
    }

    /**
     * @param $defender
     */
    private function handleOasisCapture($defender)
    {
        $db = DB::getInstance();
        $oasis = new OasesModel();
        $heroMansion = (int)$this->attacker['buildings'][37];

        if ($heroMansion <= 0) {
            return;
        }

        if ($this->defender['isOasis'] && $oasis->getOasisCaptureKid($this->row['to_kid']) != $this->row['kid'] && !$defender['total_left']) {
            $distance = Formulas::getDistance($this->row['kid'], $this->row['to_kid']);
            if ($distance < 4.9497474683058326708059105347339) {
                $oasesCount = (int)$db->fetchScalar("SELECT COUNT(kid) FROM odata WHERE did={$this->row['kid']}");
                $slots = max(0, floor(($heroMansion - 5) / 5)) - $oasesCount;
                if ($this->row['attack_type'] == MovementsModel::ATTACKTYPE_RAID) {
                    if ($slots > 0 && !$this->defender['isOccupied']) {
                        $this->info['oasisCapture'] = 0;
                        OasesModel::captureOasis($this->row['to_kid'], $this->attacker['uid'], $this->row['kid']);
                    } else if ($slots <= 0 && !$this->defender['isOccupied']) {
                        $this->info['oasisCapture'] = -1;
                    }
                } else {
                    LoyaltyHelper::updateOasisLoyalty($this->row['to_kid']);
                    $oasis = $db->query("SELECT loyalty, did FROM odata WHERE kid={$this->row['to_kid']}")->fetch_assoc();
                    if ($oasis['did'] != $this->row['kid']) {
                        if (!$slots) {
                            $this->info['oasisCapture'] = -1;
                        } else {
                            $loyaltyChange = max(0, min(floor(100 / max(1, min(3, (4 - $oasesCount)))), $oasis['loyalty']));
                            if ($loyaltyChange >= $oasis['loyalty']) {
                                OasesModel::releaseOasis($this->row['to_kid'], $oasis['did']);
                                OasesModel::captureOasis($this->row['to_kid'], $this->attacker['uid'], $this->row['kid']);
                                $this->info['oasisCapture'] = 0;
                            } else {
                                $this->info['oasisCapture'] = [
                                    $oasis['loyalty'],
                                    ceil($oasis['loyalty'] - $loyaltyChange),
                                ];
                                $db->query("UPDATE odata SET loyalty=loyalty-$loyaltyChange WHERE kid={$this->row['to_kid']}");
                            }
                        }
                    }
                }
            }
        }
    }

    private function handleArtefactCapture()
    {
        $db = DB::getInstance();
        $arts = new ArtefactsModel();
        if (!$this->defender['isOasis'] && $this->getAlive($this->attacker['wave'], 11)) {
            $villageArtifacts = $db->query("SELECT * FROM artefacts WHERE kid={$this->row['to_kid']}");
            while (($artifact = $villageArtifacts->fetch_assoc())) {
                $result = $arts->canClaimArtifact($artifact['type'],
                    $artifact['size'],
                    $this->attacker['uid'],
                    $this->defender['uid'],
                    $this->row['kid'],
                    $this->attacker['buildings'],
                    $this->defender['buildings']
                );
                if ($result === true) {
                    $arts->captureArtefact($artifact, $this->row['kid'], $this->attacker['uid']);
                    if ($artifact['type'] == 12) {
                        $this->info['heroPlanCapture'] = true;
                    } else {
                        $this->info['heroArtifactCapture'] = true;
                    }
                    return true;
                } else {
                    $this->info['captureError'] = $result;
                }
            }
        }
        return false;
    }

    /**
     * @param $no_morale
     * @param $pop_ratio
     * @return bool
     */
    private function handleVillageCapture($no_morale, $pop_ratio)
    {
        $db = DB::getInstance();
        if ($this->row['attack_type'] == MovementsModel::ATTACKTYPE_NORMAL && !$this->defender['isOasis'] && $this->getAlive($this->attacker['wave'], 9)) {
            //king.
            if ($this->model->is_capital($this->row['to_kid'])) {
                $this->info['captureResult'] = -1;
            } else {
                //Only 1 WW village can be captured at a time
                if (getCustom("allowOnlyOneWWVillagePerAccount") && $this->defender['isWW'] && ($db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE isWW=1 AND owner={$this->attacker['uid']}")) >= 1) {
                    $this->info['captureResult'] = -4;
                } else {
                    return $this->handleVillageCaptured($no_morale, $pop_ratio);
                }
            }
        }
        return false;
    }

    /**
     * @param $no_morale
     * @param $pop_ratio
     * @return bool
     */
    private function handleVillageCaptured($no_morale, $pop_ratio)
    {
        $captured = false;
        $db = DB::getInstance();
        $total_villages = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner={$this->attacker['uid']}");
        if (!($this->attacker['uid'] == $this->defender['uid']) &&
            $this->attacker['player']['cp'] < Formulas::newVillageCP($total_villages + 1)) {
            $this->info['captureResult'] = -2;
        } else {
            if ($this->model->get_building_lvl(-1, 25, $this->defender['buildings']) > 0 ||
                $this->model->get_building_lvl(-1, 26, $this->defender['buildings']) > 0 ||
                $this->model->get_building_lvl(-1, 44, $this->defender['buildings']) > 0) {
                $this->info['captureResult'] = -3;
            } else {
                $alive_admins = $this->getAlive($this->attacker['wave'], 9);
                $af = $this->administrator_effect[$this->row['race']];
                $moral_bonus = $no_morale ? 1 : $this->model->common_morale($pop_ratio);
                $ld = (!$this->model->is_great_celebration_running($this->row['kid']) ? 0 : 5) - (!$this->model->is_great_celebration_running($this->row['to_kid']) ? 0 : 5);
                $B = false;
                if ($this->row['race'] == 2) {
                    $p = new VillageModel();
                    $B = $p->getCapBrewery($this->attacker['uid']) > 0;
                }
                $c = $moral_bonus / ($B ? 2 : 1);
                $loy = [
                    round(($af[0] + $ld) * $c),
                    round(($af[1] + $ld) * $c),
                ];
                $loyaltyChange = 0;
                for ($i = 1; $i <= $alive_admins; ++$i) {
                    $loyaltyChange += mt_rand($loy[0], $loy[1]);
                }
                LoyaltyHelper::updateVillageLoyalty($this->row['to_kid']);
                $village = $db->query("SELECT loyalty FROM vdata WHERE kid={$this->row['to_kid']}")->fetch_assoc();
                if ($loyaltyChange >= floor($village['loyalty'])) {
                    $this->info['captureResult'] = 0;
                    $p = new VillageModel();
                    $captured = $p->captureVillage($this->defender['uid'], $this->row['to_kid'], $this->defender['total_pop'], $this->attacker['uid'], $this->attacker['total_pop'], $this->row['race'], $this->row['kid']);
                    if ($captured) {
                        $move = new MovementsModel();
                        $units = [];
                        for ($i = 1; $i <= 11; ++$i) {
                            $units[$i] = $this->getAlive($this->attacker['wave'], $i);
                            if ($i == 9) {
                                $units[$i]--;
                            }
                        }
                        $move->addEnforce($this->attacker['uid'], $this->row['kid'], $this->row['to_kid'], $this->row['race'], $units);
                        {
                            ResourcesHelper::updateVillageUpkeep($this->attacker['uid'], $this->row['kid']);
                            ResourcesHelper::updateVillageUpkeep($this->attacker['uid'], $this->row['to_kid']);
                        }
                    }
                } else {
                    $this->info['captureResult'] = [
                        $village['loyalty'],
                        $village['loyalty'] - $loyaltyChange,
                    ];
                    $db->query("UPDATE vdata SET loyalty=loyalty-$loyaltyChange WHERE kid={$this->row['to_kid']}");
                }
            }
            return $captured;
        }
        return false;
    }

    /**
     * @param $attacker
     */
    private function handleTrapFreeOnNormalAttack($attacker)
    {
        if (!($attacker['total_left'] && !$this->defender['isOasis'] && $this->row['attack_type'] == MovementsModel::ATTACKTYPE_NORMAL)) {
            return;
        }
        $db = DB::getInstance();
        $this->info['free'] = [0, 0];

        $total_all = 0;
        $helper = new AccountDeleter();
        $traps = $db->query("SELECT * FROM trapped WHERE to_kid={$this->row['to_kid']}");
        while (($trappedRow = $traps->fetch_assoc())) {
            $owner = $this->model->getOwner($trappedRow['kid']);
            $isMine = $owner == $this->attacker['uid'];
            $isAlliance = false;
            if (!$isMine && $this->attacker['player']['aid']) {
                $isAlliance = $this->model->getUser($owner)['aid'] == $this->attacker['player']['aid'];
            }
            if (!$isMine && !$isAlliance) {
                continue;
            }
            $total_sum = 0;
            for ($i = 1; $i <= 10; ++$i) {
                $total_all += $trappedRow['u' . $i];
                $trappedRow['u' . $i] = ceil($trappedRow['u' . $i] * 0.75);
                $total_sum += $trappedRow['u' . $i];
            }
            if ($trappedRow['u11']) {
                $health = $db->fetchScalar("SELECT health FROM hero WHERE kid={$trappedRow['kid']}");
                if ($health <= 75) {
                    $trappedRow['u11'] = 0;
                    $db->query("UPDATE hero SET health=0 WHERE kid={$trappedRow['kid']}");
                } else {
                    $total_sum += 1;
                    $db->query("UPDATE hero SET health=health-75 WHERE kid={$trappedRow['kid']}");
                }
            }
            $helper->returnTrappedOrEnforcementRow($trappedRow, false, $this->row['end_time']);
            $this->info['free'][$isMine ? 0 : 1] += $total_sum;
        }
        if (!array_sum($this->info['free'])) {
            unset($this->info['free']);
        }
        if ($total_all) {
            // Remove traps
            $db->query("UPDATE units SET u99=IF(u99-$total_all>0, u99-$total_all, 0) WHERE kid={$this->row['to_kid']}");
        }
    }

    private function finalize_troops_return($data = null)
    {
        //need to return units.
        $calculator = new SpeedCalculator();
        $calculator->setFrom($this->row['to_kid']);
        $calculator->setTo($this->row['kid']);
        $calculator->isReturn();
        $calculator->setTournamentSqLvl($this->attacker['buildings'][14]);
        $speeds = $alive = $units_id = [];
        $alive = array_fill(1, 11, 0);
        for ($i = 1; $i <= 11; ++$i) {
            $alive[$i] = $this->getAlive($this->attacker['wave'], $i);
            if ($i == 11) {
                continue;
            }
            if ($alive[$i]) {
                $speeds[] = Formulas::uSpeed(nrToUnitId($i, $this->attacker['wave']['race']));
                $units_id[] = (nrToUnitId($i, $this->attacker['wave']['race']));
            }
        }
        $calculator->hasCata($alive[8] > 0);
        $helper = new HeroHelper();
        $calculator->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($this->attacker['uid'], $this->row['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        if ($alive[11]) {
            $calculator->hasHero();
            $calculator->setLeftHand($this->attacker['wave']['heroItems']['leftHand']);
            $calculator->setShoes($this->attacker['wave']['heroItems']['shoes']);
            if (isset($this->attacker['player']['aid'], $this->defender['player']['aid']) && $this->attacker['player']['aid'] > 0) {
                if ($this->attacker['player']['aid'] == $this->defender['player']['aid']) {
                    $calculator->isAlliance();
                } else {
                    $db = DB::getInstance();
                    $aid = $this->attacker['player']['aid'];
                    $to_aid = $this->defender['player']['aid'];
                    $diplomacy = $db->fetchScalar("SELECT COUNT(id) FROM diplomacy WHERE accepted=1 AND type=1 AND ((aid1=$aid AND aid2=$to_aid) OR (aid1=$to_aid AND aid2=$aid))");
                    if ($diplomacy > 0) {
                        $calculator->isAlliance();
                    }
                }
            }
            if ($this->attacker['uid'] == $this->defender['uid']) {
                $calculator->isOwn();
            }
            $speeds[] = $helper->calcTotalSpeed($this->attacker['wave']['race'], $this->attacker['wave']['heroItems']['horse'], $this->attacker['wave']['heroItems']['shoes'], $calculator->isCavalryOnly($units_id));
            if (array_sum($alive) > 1) {
                $calculator->troopsWithHero();
            }
        }
        $calculator->setMinSpeed($speeds);
        $move = new MovementsModel();
        $move->addMovement($this->row['to_kid'], $this->row['kid'], $this->row['race'], $alive, 0, 0, 0, 0, 1, $this->row['attack_type'], $this->row['end_time'], $this->row['end_time'] + $calculator->calc() * 1000, $data);
        return true;
    }

    private function sendBattleReports($attacker, $defender, $atk_losses, $def_losses)
    {
        $this->startProfile("getDefenderUnitsForReport");
        $defenderReport = $this->getDefenderUnitsForReport();
        $this->endProfile('getDefenderUnitsForReport');
        $report = [
            'losses' => [$atk_losses, $def_losses],
            'attacker' => [
                'kid' => $this->row['kid'],
                'uid' => $this->attacker['uid'],
                'uname' => $this->attacker['player']['name'],
                'race' => $this->attacker['wave']['race'],
                'num' => $this->attacker['wave']['units']['num'],
                'dead' => $this->attacker['wave']['units']['dead'],
                'smithy' => $this->attacker['wave']['units']['smithy'],
                'trapped' => array_sum($this->attacker['wave']['units']['trapped']) ? $this->attacker['wave']['units']['trapped'] : null,
            ],
            'defender' => $defenderReport,
            'info' => $this->info,
        ];
        $bounty = '';
        if (isset($report['info']['bounty'])) {
            $bounty = implode(',', array_values($report['info']['bounty']));
            unset($report['info']['bounty']);
        }
        if ($attacker['total_dead'] <= 0 && $attacker['total_left'] > 0) {
            $reportType = NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES;
        } else if ($attacker['total_left']) {
            $reportType = NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES;
        } else {
            $reportType = NoticeHelper::TYPE_LOST_AS_ATTACKER;
        }
        $tmp = $report;
        //get a temp to save attacker report.
        if ($def_losses < 0.25 && !$attacker['total_left'] && !IS_DEV) {
            if (!isset($this->defender['uid'])) {
                $tmp['defender'] = [$tmp['defender'][0]];//hiding reinforces.
                $tmp['defender'][0]['num'] = array_fill(1, $tmp['defender'][0]['race'] == 4 ? 10 : 11, '?');
                $tmp['defender'][0]['dead'] = null;
            } else if ($this->attacker['uid'] == $this->defender['uid']) {

            } else {
                $tmp['defender'] = [$tmp['defender'][0]];//hiding reinforces.
                $tmp['defender'][0]['num'] = array_fill(1, $tmp['defender'][0]['race'] == 4 ? 10 : 11, '?');
                $tmp['defender'][0]['dead'] = null;
            }
        }
        $this->startProfile("sendBattleReports:sendAttackerReport");
        $noticeId = NoticeHelper::addNotice($this->attacker['player']['aid'],
            $this->attacker['uid'],
            $this->row['kid'],
            $this->row['to_kid'],
            $reportType,
            $bounty,
            $tmp,
            $this->row['end_time_seconds'],
            false,
            $atk_losses * 100,
            $this->isTopOff);
        if ($this->isTopOff) {
            $db = DB::getInstance();
            $db->query("UPDATE users SET max_off_nid=$noticeId WHERE id={$this->attacker['uid']}");
        }
        $this->endProfile("sendBattleReports:sendAttackerReport");
        unset($tmp);
        if ($this->defender['uid'] <= 1) {
            return false;
        }
        $this->startProfile("sendBattleReports:sendDefendersReport");
        if (!$attacker['total_left'] && !$defender['total_dead']) {
            $reportType = NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES;
        } else if ($defender['total_left'] && $defender['total_num'] && $defender['total_dead']) {
            $reportType = NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES;
        } else if (!$defender['total_left'] && !$defender['total_dead']) {
            $reportType = NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES;
        } else {
            $reportType = NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES;
        }
        //sending reinforces owners a report.
        $uid = [];
        foreach ($this->defender['wave'] as $k) {
            if ($k['race'] == 4 || !$k['isEnforce'] || !$k['isForeign'] || $k['uid'] == $this->defender['uid']) {
                continue;
            }
            $uid[] = $k['uid'];
        }
        $uid = array_unique($uid);
        $tmp = $report;
        unset($tmp['info']['escape']);
        if (sizeof($uid) >= 20 && $reportType == NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES) {
            //do nothing
        } else {
            foreach ($uid as $u) {
                $tmp['defender'] = $this->filter_units_for_player($u);
                NoticeHelper::addNotice(0,
                    $u,
                    $this->row['kid'],
                    $this->row['to_kid'],
                    $reportType,
                    '',
                    $tmp,
                    $this->row['end_time_seconds'],
                    true,
                    ($reportType == NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES ? 0 : $def_losses) * 100);
            }
        }
        if ($this->defender['uid'] > 1) {
            if ($this->attacker['uid'] != $this->defender['uid']) {
                $noticeId = NoticeHelper::addNotice($this->defender['player']['aid'],
                    $this->defender['uid'],
                    $this->row['kid'],
                    $this->row['to_kid'],
                    $reportType,
                    $bounty,
                    $report,
                    $this->row['end_time_seconds'],
                    false,
                    ($reportType == NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES ? 0 : $def_losses) * 100,
                    $this->isTopDef);
                if ($this->isTopDef) {
                    $db = DB::getInstance();
                    $db->query("UPDATE users SET max_def_nid=$noticeId WHERE id={$this->defender['uid']}");
                }
            }
        }
        $this->endProfile("sendBattleReports:sendDefendersReport");
        return true;
    }

    private function filter_units_for_player($uid)
    {
        $assoc[] = [
            'kid' => $this->defender['wave'][0]['uniqueId'],
            'race' => $this->defender['wave'][0]['race'],
            'num' => array_fill(1, $this->defender['wave'][0]['race'] == 4 ? 10 : 11, '?'),
            'dead' => null,
            'smithy' => $this->defender['wave'][0]['units']['smithy'],
        ];
        if (!$this->defender['isOasis']) {
            $assoc[0]['uid'] = $this->defender['uid'];
            $assoc[0]['uname'] = $this->defender['player']['name'];
        }
        foreach ($this->defender['wave'] as $row) {
            if (!$row['isEnforce'] || !$row['isForeign'] || !array_sum($row['units']['num']) || $row['uid'] != $uid) {
                continue;
            }
            $assoc[] = [
                'uid' => $uid,
                'uname' => $this->model->getUser($uid)['name'],
                'kid' => $row['kid'],
                'race' => $row['race'],
                'num' => $row['units']['num'],
                'dead' => $row['units']['dead'],
                'smithy' => $row['units']['smithy'],
            ];
        }
        return $assoc;
    }

    private function lone_dies($offense, $pop_ratio)
    {
        return round($offense['t'] * $this->model->common_morale($pop_ratio)) <= self::LONE_ATTACKER_THRESHOLD;
    }

    private function isFarm()
    {
        return $this->isFarm;
    }

    private function fixSpeedCataRamEffect($value, $off_losses, $def_losses)
    {
        if (getGameSpeed() <= 50) {
            return $value;
        }
        if ($def_losses > 0) {
            if ($off_losses == 1) {
                if ($def_losses < 0.5) {
                    $value *= 0.003;
                } else if ($def_losses < 0.6) {
                    $value *= 0.005;
                } else if ($def_losses < 0.7) {
                    $value *= 0.008;
                } else if ($def_losses < 0.8) {
                    $value *= 0.01;
                } else if ($def_losses < 0.9) {
                    $value *= 0.015;
                }
            }
            if ($def_losses < 0.33) {
                $value = 0;
            }
        }
        return $value;
    }

    private function finalize_ram_damage()
    {
        $damage = $this->info['rams'];
        if ($damage[2] == $damage[1]) {
            return false;
        }
        BuildingAction::downgrade($this->row['to_kid'], 40, $damage[1] - $damage[2], $damage[2] == 0);
        $def =& $this->defender;
        $def['wall'] = $damage[2];
        $def['buildings'][40]['level'] = $damage[2];
        if ($damage[2] == 0 && !BuildingAction::building_upgrade_state($this->row['to_kid'], 40)) {
            $def['buildings'][40]['item_id'] = 0;
        }
        $this->checkIfVillageIsDestroyed();
        return true;
    }

    private function checkIfVillageIsDestroyed()
    {
        $db = DB::getInstance();
        $pop = $db->fetchScalar("SELECT pop FROM vdata WHERE kid={$this->row['to_kid']}");
        if ($pop > 0) return;
        $deleter = new AccountDeleter();
        $reason = $deleter->isVillageDestroyAble($this->attacker['uid'], $this->row['to_kid'], $this->defender['uid']);
        if (true === $reason) {
            $deleter->deleteVillage($this->row['to_kid'], false);
            $this->info['totally_destroyed'] = true;
        } else {
            $this->info['not_destroyed_reason'] = $reason;
        }
    }

    function find_building_by_gid($gid, $buildings)
    {
        if ($gid != 99) {
            $targets = [];
            foreach ($buildings as $key => $build) {
                if (!$build['level'] || in_array($gid, [31, 32, 33, 42, 43])) {
                    continue;
                }
                if ($build['item_id'] == $gid) {
                    $targets[] = $key;
                }
            }
            $size = sizeof($targets);
            if ($size) {
                shuffle($targets);
                if ($size == 1) {
                    return $targets[0];
                }
                return $targets[mt_rand(0, $size - 1)];
            }
        }
        $free = [];
        foreach ($buildings as $k => $build) {
            if ($build['item_id'] && $build['level'] && !in_array($build['item_id'], [31, 32, 33, 42, 43])) {
                $free[] = $k;
            }
        }
        if (!sizeof($free)) {
            return 0;
        }
        shuffle($free);
        $find = $free[mt_rand(0, sizeof($free) - 1)];
        return $find ? $find : 0;
    }

    private function finalize_cata_damage($field, &$damage)
    {
        if ($damage[2] == $damage[1]) {
            return false;
        }
        $def =& $this->defender;
        BuildingAction::downgrade($this->row['to_kid'], $field, $damage[1] - $damage[2], $damage[2] == 0);
        $def['buildings'][$field]['level'] = $damage[2];
        if (($field > 18 && $field < 99) && $damage[2] == 0 && !BuildingAction::building_upgrade_state($this->row['to_kid'], $field)) {
            $def['buildings'][$field]['item_id'] = 0;
            BuildingAction::removeDemolitionsOnField($this->row['to_kid'], $field);
        }

        if ($def['buildings'][$field]['item_id'] == 41) {
            $def['hdp'] = $def['buildings'][$field]['level'];
        }

        return true;
    }

    /**
     * @param $no_morale
     * @param $pop_ratio
     * @param $sui
     * @param $army
     * @param $wall_b
     * @return mixed
     */
    private function processScoutAttack($no_morale, $pop_ratio, $sui, $wall_b)
    {
        $offense = ($no_morale ? 1 : $this->model->common_morale($pop_ratio)) * $this->attacker['wave']['units']['num'][$sui] * $this->model->stat_with_upg(self::SCOUT_OFF, Formulas::uUpkeep(nrToUnitId($sui, $this->row['race'])), $this->attacker['wave']['units']['smithy'][$sui]);
        $atkArtifactEffect = $this->model->art_effect(ArtefactsModel::getArtifactEffectByType($this->attacker['uid'], $this->row['kid'], ArtefactsModel::ARTIFACT_SPY), 10);
        $offense *= $atkArtifactEffect;
        if ($this->attacker['hasBonus'] && !$this->defender['isWW']) {
            $offense *= $this->atkBonusRate;
        }
        $defense = 0;
        foreach ($this->defender['wave'] as &$army) {
            $army['net_def_point'] = 0;
            if ($army['race'] == 4) {
                continue;
            }
            $r = $army['race'];
            $sui = Formulas::getSpyId($r);
            $total_this = $army['units']['num'][$sui] * $this->model->stat_with_upg(self::SCOUT_DEF, Formulas::uUpkeep(nrToUnitId($sui, $r), 0, true), $army['units']['smithy'][$sui]);
            $spyArtifactEffect = $army['isEnforce'] ? 1 : $this->model->art_effect(ArtefactsModel::getArtifactEffectByType($army['uid'], $army['kid'], ArtefactsModel::ARTIFACT_SPY), 10);
            $this->defender['total_net_def_point'] += $total_this;
            $army['net_def_point'] = $total_this;
            $defense += $total_this * $spyArtifactEffect;
        }
        $defense *= round(pow($wall_b, $this->defender['wall']), 3); // wall
        if ($this->defender['hasBonus'] && !$this->defender['isWW']) {
            $defense *= $this->defBonusRate;
        }
        if ($defense == 0) {
            $off_losses = 0;
        } else {
            $x = pow($offense / $defense, 1.5);
            $off_losses = $x ? min(1 / $x, 1) : 1;
        }
        $this->finalize_spy_attack($off_losses);
        return $army;
    }
}