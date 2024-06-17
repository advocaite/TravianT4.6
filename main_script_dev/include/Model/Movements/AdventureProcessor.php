<?php

namespace Model\Movements;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\Formulas;
use Game\Helpers\HeroHealthHelper;
use Game\Hero\HeroHelper;
use Game\NoticeHelper;
use Game\ResourcesHelper;
use Game\SpeedCalculator;
use Model\AdventureModel;
use Model\ArtefactsModel;
use Model\AuctionModel;
use Model\DailyQuestModel;
use Model\MovementsModel;
use Model\VillageModel;
use function game_progress;
use function getGameSpeed;

class AdventureProcessor
{
    public function __construct($row)
    {
        $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
        $row['end_time_seconds'] = ceil($row['end_time'] / 1000);

        $db = DB::getInstance();
        $owner = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
        if ($owner === false) {
            return;
        }
        $m = new AdventureModel();
        if (!$m->checkForAdventure($owner, $row['to_kid'])) {
            $this->returnHero($owner, $row);
            return;
        }
        $config = Config::getInstance();
        (new DailyQuestModel())->setQuestAsCompleted($owner, 1);
        $stmt = $db->query("SELECT dif, id FROM adventure WHERE uid=$owner AND end=0 AND kid={$row['to_kid']} AND time >" . time());
        if (!$stmt->num_rows) {
            $this->returnHero($owner, $row);
            return;
        }
        $adventureRow = $stmt->fetch_assoc();
        $db->query("UPDATE adventure SET end=1 WHERE id={$adventureRow['id']}");
        $diff = $adventureRow['dif'];
        $user = $db->query("SELECT name, success_adventures_hex, success_adventures_count, signupTime FROM users WHERE id=$owner")->fetch_assoc();
        $success_adventures = $user['success_adventures_count'];
        $success_adventures_hex = $user['success_adventures_hex'];
        $helper = new HeroHelper();
        HeroHealthHelper::updateUserHeroHealth($owner);
        $hero = $db->query("SELECT * FROM hero WHERE uid=$owner")->fetch_assoc();
        $inventory = $db->query("SELECT * FROM inventory WHERE uid=$owner")->fetch_assoc();
        $total_power = $helper->calcTotalPower($row['race'],
            $hero['power'],
            $inventory['rightHand'],
            $inventory['leftHand'],
            $inventory['body']);
        $heroPureExp = 8 + mt_rand($success_adventures, $success_adventures * 2);
        if ($diff) {
            $heroPureExp *= 2;
        }
        $sgh = $diff ? mt_rand(800, 1200) : mt_rand(500, 800);
        $rate = 3.007;
        if ($success_adventures < 20) {
            $rate /= 2.7;
        }
        $sgh *= abs((time() - $user['signupTime']) / ($config->game->round_length * 86400)) + 1;
        $exp = round(($heroPureExp * ((100 + $helper->calcMoreExp($inventory['helmet'])) / 100)));
        $expMul = Formulas::getHeroExpLevelMultiplier();
        if ($expMul > 1) {
            $exp = round($exp * mt_rand(floor($expMul / 2), $expMul));
        }
        $total_power *= 1 + $helper->calcOffBonus($hero['offBonus']) / 100;
        $sgh *= 1 + ($total_power / 500);
        $resist = $helper->calcResist($inventory['body']);
        $damage = round($rate * $sgh / $total_power - $resist);
        if ($damage < 0) {
            $damage = 0;
        }
        $report = [
            "kid" => $row['kid'],
            "uid" => $owner,
            "uname" => $db->fetchScalar("SELECT name FROM users WHERE id={$owner}"),
            'race' => $row['race'],
        ];
        if ($damage >= min(90, $hero['health'])) {
            $report['dead'] = true;
            $db->query("UPDATE adventure SET end=0 WHERE id={$adventureRow['id']}");
            $db->query("UPDATE hero SET exp=exp+$exp, health=0 WHERE uid=$owner");
            ResourcesHelper::updateVillageResources($row['to_kid'], false);
            NoticeHelper::addNotice(0,
                $owner,
                $row['kid'],
                $row['to_kid'],
                NoticeHelper::TYPE_ADVENTURE,
                '-1',
                $report,
                $row['end_time_seconds']);
            return;
        }
        $db->query("UPDATE users SET success_adventures_count=success_adventures_count+1 WHERE id=$owner");
        $report['damage'] = $damage;
        $report['exp'] = $exp;
        $db->query("UPDATE hero SET exp=exp+$exp, health=health-$damage WHERE uid=$owner");
        $bag = $helper->procInput($inventory['bag']);
        if (is_array($bag) && isset($bag['btype']) && $bag['btype'] == 11) {
            $health = min($bag['num'], abs(100 - $hero['health'] - $damage));
            if ($health) {
                $db->query("UPDATE hero SET health=health+$health WHERE uid={$owner}");
                $auction = new AuctionModel();
                $auction->decreaseCageOrientItem($bag['uid'], $bag['id'], $bag['num'], $health);
                if ($bag['num'] == $health) {
                    $inventory['bag'] = 0;
                }
            }
        }
        if ($success_adventures < 9) {
            $randGive = [1, 2, 4, 8, 16, 32, 64, 128, 256, 512];
            foreach ($randGive as $giveKey => $give) {
                if ($success_adventures_hex & $give) {
                    unset($randGive[$giveKey]);
                }
            }
            shuffle($randGive);
            sort($randGive);
            if (sizeof($randGive) == 1) {
                $randP = $randGive[0];
            } else {
                $randP = $randGive[mt_rand(0, sizeof($randGive) - 1)];
            }
            if($success_adventures == 2 && in_array(4, $randGive)){
                $randP = 4;
            }
            switch ($randP) {
                case 1://pomad
                    $num = mt_rand(20, 25);
                    $auction = new AuctionModel();
                    $auction->addItemToUser($owner, 11, 106, $num);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            1,
                            11,
                            106,
                            $num,
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
                case 2://troop 3x
                    $troop = $this->getTroops($row['race'], true);
                    $this->sendTroops($owner, $row, $troop['nr'], $troop['num']);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            4,
                            $row['race'],
                            $troop['nr'],
                            $troop['num'],
                        ],
                        $report,
                        $row['end_time_seconds']);
                    ResourcesHelper::updateVillageResources($row['kid'], false);
                    break;
                case 4://asb
                    $auction = new AuctionModel();
                    $auction->addItemToUser($owner, 6, 103, 1);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            1,
                            6,
                            103,
                            1,
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
                case 8://ghafas
                    $num = 6 * $config->game->cage_multiplier;
                    $auction = new AuctionModel();
                    $auction->addItemToUser($owner, 9, 114, $num);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            1,
                            9,
                            114,
                            $num,
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
                case 16://resources
                case 32://resources
                    $rPerType = $this->calculateResourcesPerType();
                    $row['data'] = implode(",", [$rPerType[1], $rPerType[2], $rPerType[3], $rPerType[4], 0]);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            2,
                            $rPerType[1],
                            $rPerType[2],
                            $rPerType[3],
                            $rPerType[4],
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
                case 64://none or resources
                    if (mt_rand(1, 3) == 2) {
                        $rPerType = $this->calculateResourcesPerType();
                        $row['data'] = implode(",", [$rPerType[1], $rPerType[2], $rPerType[3], $rPerType[4], 0]);
                        NoticeHelper::addNotice(0,
                            $owner,
                            $row['kid'],
                            $row['to_kid'],
                            NoticeHelper::TYPE_ADVENTURE,
                            [
                                2,
                                $rPerType[1],
                                $rPerType[2],
                                $rPerType[3],
                                $rPerType[4],
                            ],
                            $report,
                            $row['end_time_seconds']);
                    } else {
                        NoticeHelper::addNotice(0,
                            $owner,
                            $row['kid'],
                            $row['to_kid'],
                            NoticeHelper::TYPE_ADVENTURE,
                            '0',
                            $report,
                            $row['end_time_seconds']);
                    }
                    break;
                case 128://silver
                case 256://silver
                    $silver = mt_rand(100 - mt_rand(1, 50), 400 + mt_rand(1, 50));
                    $m = new AuctionModel();
                    $m->addBooking($owner,
                        1,
                        +$silver,
                        +$silver + $db->fetchScalar("SELECT silver FROM users WHERE id=$owner"),
                        $row['end_time_seconds']);
                    $db->query("UPDATE users SET silver=silver+$silver WHERE id=$owner");
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            3,
                            $silver,
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
                case 512:
                    //ketab
                    $auction = new AuctionModel();
                    $auction->addItemToUser($owner, 13, 110, 1);
                    NoticeHelper::addNotice(0,
                        $owner,
                        $row['kid'],
                        $row['to_kid'],
                        NoticeHelper::TYPE_ADVENTURE,
                        [
                            1,
                            13,
                            110,
                            1,
                        ],
                        $report,
                        $row['end_time_seconds']);
                    break;
            }
            $success_adventures_hex |= $randP;
            $db->query("UPDATE users SET success_adventures_hex=$success_adventures_hex WHERE id=$owner");
            $this->returnHero($owner, $row);
            return;
        }
        $rand = mt_rand(1, 14);
        if ($rand <= 8) {
            if ($success_adventures <= 10) {
                $bonus = mt_rand(1, 15);
            } else if ($success_adventures <= 20) {
                $bonus = mt_rand(1, 20);
            } else {
                $bonus = mt_rand(1, max(18, 30 - $success_adventures));
            }
            $tearNum = Formulas::getCurrentHeroItemsTier();
            do {
                if($db->fetchScalar("SELECT COUNT(id) FROM items WHERE uid=$owner AND btype=6 AND type=" . (102+$tearNum))){
                    $bonus = mt_rand(1, max(18, 30 - $success_adventures));
                } else {
                    break;
                }
            } while($bonus == 6);
            switch ($bonus) {
                case 1:
                    $rand = [
                        1 => [1 => 1, 4, 7, 10, 13],
                        2 => [1 => 2, 5, 8, 11, 14],
                        3 => [1 => 3, 6, 9, 12, 15],
                    ][$tearNum];
                    break;
                case 2:
                    $rand = [
                        1 => [1 => 82, 85, 88, 91],
                        2 => [1 => 83, 86, 89, 92],
                        3 => [1 => 84, 87, 90, 93],
                    ][$tearNum];
                    break;
                case 3:
                    $rand = [
                        1 => [1 => 61, 64, 67, 73, 79],
                        2 => [1 => 62, 65, 68, 74, 77, 80],
                        3 => [1 => 63, 66, 69, 75, 78, 81],
                    ][$tearNum];
                    break;
                case 4:
                    $rand = [
                        1 => [
                            1 => [1 => 16, 19, 22, 25, 28],
                            2 => [1 => 17, 20, 23, 26, 29],
                            3 => [1 => 18, 21, 24, 27, 30],
                        ],
                        2 => [
                            1 => [1 => 46, 49, 52, 55, 58],
                            2 => [1 => 47, 50, 53, 56, 59],
                            3 => [1 => 48, 51, 54, 57, 60],
                        ],
                        3 => [
                            1 => [1 => 31, 34, 37, 40, 43],
                            2 => [1 => 32, 35, 38, 41, 44],
                            3 => [1 => 33, 36, 39, 42, 45],
                        ],
                        6 => [
                            1 => [1 => 115, 118, 121, 124, 127],
                            2 => [1 => 116, 119, 122, 125, 128],
                            3 => [1 => 117, 120, 123, 126, 129],
                        ],
                        7 => [
                            1 => [1 => 130, 133, 136, 139, 142],
                            2 => [1 => 131, 134, 137, 140, 143],
                            3 => [1 => 132, 135, 138, 141, 144],
                        ],
                    ][$row['race']][$tearNum];
                    break;
                case 5:
                    $rand = [
                        1 => [1 => 94, 97, 100],
                        2 => [1 => 95, 98, 101],
                        3 => [1 => 96, 99, 102],
                    ][$tearNum];
                    break;
                case 6:
                    $rand = [
                        1 => [1 => 103],
                        2 => [1 => 104],
                        3 => [1 => 105],
                    ][$tearNum];
                    break;
                case 7:
                    $rand = [1 => 112];
                    break;
                case 8:
                    $rand = [1 => 113];
                    break;
                case 9:
                    $rand = [1 => 114];
                    break;
                case 10:
                    $rand = [1 => 107];
                    break;
                case 11:
                    $rand = [1 => 106];
                    break;
                case 12:
                    $rand = [1 => 108];
                    break;
                case 13:
                    $rand = [1 => 110];
                    break;
                case 14:
                    $rand = [1 => 109];
                    break;
                case 15:
                    $rand = [1 => 111];
                    if (time() < Formulas::getArtworkReleaseTime()) {
                        $rand = 0;
                    } //no art work till 14days. in T4.4
                    $rand = 0;
                    break;
                default:
                    $rand = 0;
                    break;
            }
            if ($rand == 0) {
                NoticeHelper::addNotice(0,
                    $owner,
                    $row['kid'],
                    $row['to_kid'],
                    NoticeHelper::TYPE_ADVENTURE,
                    '0',
                    $report,
                    $row['end_time_seconds']);
            } else {
                $base = 1;
                if ($bonus <= 6 || ($bonus >= 12 && $bonus <= 15)) {
                    $base = 1;
                } else if ($bonus <= 11 || $bonus == 14) {
                    $base = mt_rand(20, 50);
                } else if ($bonus == 9) {
                    $base = mt_rand(6, 20);
                }
                if ($bonus == 7 || $bonus == 8 || $bonus == 9) {
                    $base *= $config->game->cage_multiplier;
                }
                $rand = $rand[mt_rand(1, sizeof($rand))];
                $tolerance = 3 * game_progress();
                if ($bonus <= 6 || ($bonus >= 12 && $bonus <= 15)) {
                    $tolerance = 0;
                }
                $num = $base + ($base * $tolerance);
                $num = ceil($num);
                $auction = new AuctionModel();
                $auction->addItemToUser($owner, $bonus, $rand, $num);
                NoticeHelper::addNotice(0,
                    $owner,
                    $row['kid'],
                    $row['to_kid'],
                    NoticeHelper::TYPE_ADVENTURE,
                    [
                        1,
                        $bonus,
                        $rand,
                        $num,
                    ],
                    $report,
                    $row['end_time_seconds']);
            }
            $this->returnHero($owner, $row);
        } else if ($rand <= 10) {
            //resources
            $rPerType = $this->calculateResourcesPerType();
            $row['data'] = implode(",", [$rPerType[1], $rPerType[2], $rPerType[3], $rPerType[4], 0]);
            NoticeHelper::addNotice(0,
                $owner,
                $row['kid'],
                $row['to_kid'],
                NoticeHelper::TYPE_ADVENTURE,
                [
                    2,
                    $rPerType[1],
                    $rPerType[2],
                    $rPerType[3],
                    $rPerType[4],
                ],
                $report,
                $row['end_time_seconds']);
            $this->returnHero($owner, $row);
        } else if ($rand <= 12) {
            $base = mt_rand(200, 400);
            $tolerance = 4 * game_progress();
            $silver = ceil($base + ($base * $tolerance));
            $m = new AuctionModel();
            $m->addBooking($owner,
                1,
                +$silver,
                +$silver + $db->fetchScalar("SELECT silver FROM users WHERE id=$owner"),
                $row['end_time_seconds']);
            $db->query("UPDATE users SET silver=silver+$silver WHERE id=$owner");
            NoticeHelper::addNotice(0,
                $owner,
                $row['kid'],
                $row['to_kid'],
                NoticeHelper::TYPE_ADVENTURE,
                [
                    3,
                    $silver,
                ],
                $report,
                $row['end_time_seconds']);
            $this->returnHero($owner, $row);
        } else {
            //units.
            $troop = $this->getTroops($row['race']);
            $this->sendTroops($owner, $row, $troop['nr'], $troop['num']);
            NoticeHelper::addNotice(0,
                $owner,
                $row['kid'],
                $row['to_kid'],
                NoticeHelper::TYPE_ADVENTURE,
                [
                    4,
                    $row['race'],
                    $troop['nr'],
                    $troop['num'],
                ],
                $report,
                $row['end_time_seconds']);
            $this->returnHero($owner, $row);
            ResourcesHelper::updateVillageResources($row['kid'], false);
        }
    }

    private function returnHero($owner, $row)
    {
        $db = DB::getInstance();
        $inventory = $db->query("SELECT * FROM inventory WHERE uid=$owner")->fetch_assoc();
        $artifact_effect = ArtefactsModel::getArtifactEffectByType($owner, $row['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED);
        $heroSpeed = (new HeroHelper())->calcTotalSpeed($row['race'], $inventory['horse'], $inventory['shoes']);
        $calc = new SpeedCalculator();
        $calc->setFrom($row['to_kid']);
        $calc->setTo($row['kid']);
        $calc->isReturn();
        $calc->hasHero();
        $calc->setTournamentSqLvl(VillageModel::getTournamentSquireLevel($row['kid']));
        $calc->setMinSpeed($heroSpeed);
        $calc->setLeftHand($inventory['leftHand']);
        $calc->setShoes($inventory['shoes']);
        $calc->setArtefactEffect($artifact_effect);
        $units = array_fill(1, 11, 0);
        $units[11] = 1;
        $timeNeeded = $calc->calc();
        (new MovementsModel())->addMovement($row['to_kid'],
            $row['kid'],
            $row['race'],
            $units,
            0,
            0,
            0,
            0,
            1,
            $row['attack_type'],
            $row['end_time'],
            $row['end_time'] + 1000 * $timeNeeded,
            $row['data']);
    }

    private function getTroops($race, $default = false)
    {
        $nr = $default ? 1 : mt_rand(1, 6);
        if ($default && getGameSpeed() <= 10) {
            $num = 3;
        } else {
            if ($nr <= Formulas::getSpyId($race)) {
                $base = getGameSpeed() <= 10 ? mt_rand(3, 12) : mt_rand(12, 48);
            } else {
                $base = getGameSpeed() <= 10 ? mt_rand(2, 8) : mt_rand(8, 32);
            }
            if (getGameSpeed() > 20) {
                $base *= ceil(Config::getProperty("game", "speed") / 10);
            }
            $tolerance = 10 * game_progress();
            $num = $base + ceil($base * $tolerance);
        }
        return ['nr' => $nr, 'num' => $num];
    }

    private function sendTroops($owner, $row, $nr, $num)
    {
        $calc = new SpeedCalculator();
        $calc->setFrom($row['to_kid']);
        $calc->setTo($row['kid']);
        $calc->isReturn();
        $units = array_fill(1, 11, 0);
        $units[$nr] = $num;
        $speeds[] = Formulas::uSpeed(nrToUnitId($nr, $row['race']));
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid={$row['kid']}")->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 14) {
                $calc->setTournamentSqLvl($buildings['f' . $i]);
                break;
            }
        }
        $calc->setMinSpeed($speeds);
        $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($owner, $row['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        (new MovementsModel())->addMovement(
            $row['to_kid'],
            $row['kid'],
            $row['race'],
            $units,
            0,
            0,
            0,
            0,
            1,
            $row['attack_type'],
            $row['end_time'],
            $row['end_time'] + 1000 * $calc->calc(),
            null
        );
    }

    private function calculateResourcesPerType()
    {
        $speed = getGameSpeed();
        $arr = [];
        $tolerance = 15 * game_progress();
        $base = mt_rand(450, 700) * $speed;
        for ($i = 1; $i <= 4; $i++) {
            $arr[$i] = $base + ceil($base * $tolerance);
        }
        return $arr;
    }
}