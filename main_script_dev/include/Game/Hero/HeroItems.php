<?php

namespace Game\Hero;

use Core\Config;
use Game\Formulas;

class HeroItems
{
    public function getRandomItem()
    {
        mt_srand(make_seed());
        $btypes = [
            1 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            2 => [82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93],
            3 => [
                61,
                62,
                63,
                64,
                65,
                66,
                67,
                68,
                69,
                73,
                74,
                75,
                76,
                77,
                78,
                79,
                80,
                81,
            ],
            4 => [
                16,
                17,
                18,
                19,
                20,
                21,
                22,
                23,
                24,
                25,
                26,
                27,
                28,
                29,
                30,
                31,
                32,
                33,
                34,
                35,
                36,
                37,
                38,
                39,
                40,
                41,
                42,
                43,
                44,
                45,
                46,
                47,
                48,
                49,
                50,
                51,
                52,
                53,
                54,
                55,
                56,
                57,
                58,
                59,
                60,
            ],
            5 => [94, 95, 96, 97, 98, 99, 100, 101, 102],
            6 => [103, 104, 105],
            7 => [112],
            8 => [113],
            9 => [114],
            10 => [107],
            11 => [106],
            12 => [108],
            13 => [110],
            14 => [109],
            15 => [111],
        ];
        if (getGame("allowNewTribes")) {
            $btypes[4] = array_merge($btypes[4],
                [
                    115,
                    116,
                    117,
                    118,
                    119,
                    120,
                    121,
                    122,
                    123,
                    124,
                    125,
                    126,
                    127,
                    128,
                    129,
                    130,
                    131,
                    132,
                    133,
                    134,
                    135,
                    136,
                    137,
                    138,
                    139,
                    140,
                    141,
                    142,
                    143,
                    144
                ]);
        }
        $btype = mt_rand(1, 15);
        $type = $btypes[$btype][mt_rand(0, sizeof($btypes[$btype]) - 1)];
        $consume = FALSE;
        if ($btype >= 7 && $btype != 12 && $btype != 13) {
            $consume = TRUE;
        }
        return ["btype" => $btype, "type" => $type, "consume" => $consume];
    }

    /**
     * @param $btype
     * @param $type
     *
     * @return array
     */
    public function getHeroItemProperties($btype, $type)
    {
        $result = ["name" => "", "title" => "",];
        $heroItemsSettings = (array)Config::getProperty("heroConfig", "heroItemsSettings");
        $result['name'] = T("HeroItems", "{$btype}.{$type}.name");
        if ($btype == 1) {
            $result['slot'] = "helmet";
        } elseif ($btype == 2) {
            $result['slot'] = "body";
        } elseif ($btype == 3) {
            $result['slot'] = "leftHand";
        } elseif ($btype == 4) {
            $result['slot'] = "rightHand";
        } elseif ($btype == 5) {
            $result['slot'] = "shoes";
        } elseif ($btype == 6) {
            $result['slot'] = "horse";
        } elseif ($btype >= 7) {
            $result['slot'] = "bag";
        }
        $result['instant'] = !($btype <= 9 || $btype == 10);
        if ($btype < 7 || $btype == 10 || $btype == 11) {
            $result['isUsableIfDead'] = FALSE;
        } else {
            $result['isUsableIfDead'] = TRUE;
        }
        $result['attributes'] = T("HeroItems", "{$btype}.{$type}.title");
        switch ($btype) {
            case 1:
                if ($type <= 3) {
                    $result['exp'] = (10 + ($type * 5)) * $heroItemsSettings['heroExtraExperienceGainRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['exp']);
                } else if ($type <= 6) {
                    $result['reg'] = (5 + (($type - 3) * 5)) * $heroItemsSettings['heroRegenerationRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['reg']);
                } else if ($type <= 9) {
                    $result['cp'] = ($type == 7 ? 100 : ($type == 8 ? 400 : 800)) * $heroItemsSettings['heroExtraCulturePointsRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['cp']);
                } else if ($type <= 12) {
                    $result['cav'] = (10 + (($type - 10) * 5)) * $heroItemsSettings['heroTrainingSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['cav']);
                } else if ($type <= 15) {
                    $result['inf'] = (10 + (($type - 13) * 5)) * $heroItemsSettings['heroTrainingSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['inf']);
                }
                break;
            case 2:
                if ($type <= 84) {
                    $result['reg'] = (20 + (($type - 82) * 10)) * $heroItemsSettings['heroRegenerationRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['reg']);
                } else if ($type <= 87) {
                    $result['reg'] = (10 + (($type - 84) * 5)) * $heroItemsSettings['heroRegenerationRate'];
                    $result['resist'] = (4 + (($type - 84) * 2)) * $heroItemsSettings['heroResistantRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['reg'], $result['resist']);
                } else if ($type <= 90) {
                    $result['hero_power'] = (500 + (($type - 88) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['attributes'] = sprintf($result['attributes'], $result['hero_power']);
                } else if ($type <= 93) {
                    $result['hero_power'] = (250 + (($type - 91) * 250)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['resist'] = (2 + (($type - 90))) * $heroItemsSettings['heroResistantRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['hero_power'], $result['resist']);
                }
                break;
            case 3:
                if ($type <= 63) {
                    $result['return_speed'] = (30 + (($type - 61) * 10)) * $heroItemsSettings['heroIncreaseSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['return_speed']);
                } else if ($type <= 66) {
                    $result['speed_own'] = (30 + (($type - 64) * 10)) * $heroItemsSettings['heroIncreaseSpeedOwnRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['speed_own']);
                } else if ($type <= 69) {
                    $result['speed_alliance'] = (10 + (($type - 66) * 5)) * $heroItemsSettings['heroIncreaseSpeedAllianceRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['speed_alliance']);
                } else if ($type <= 75) {
                    $result['raid'] = (10 + (($type - 73) * 5)) * $heroItemsSettings['heroRaidBagRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['raid']);
                } else if ($type <= 78) {
                    $result['hero_power'] = (500 + (($type - 76) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['attributes'] = sprintf($result['attributes'], $result['hero_power']);
                } else if ($type <= 81) {
                    $result['powerAgainstNatars'] = (15 + (($type - 78) * 5)) * $heroItemsSettings['natarsIncreasePowerAgainstPercent'];
                    $result['attributes'] = sprintf($result['attributes'], $result['powerAgainstNatars']);
                }
                break;
            case 4:
                //roman tribe
                if ($type <= 18) {
                    $result['unitId'] = 1;
                    $result['hero_power'] = (500 + (($type - 16) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 16)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 21) {
                    $result['unitId'] = 2;
                    $result['hero_power'] = (500 + (($type - 19) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 19)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 24) {
                    $result['unitId'] = 3;
                    $result['hero_power'] = (500 + (($type - 22) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 22)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 27) {
                    $result['unitId'] = 5;
                    $result['hero_power'] = (500 + (($type - 25) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 25) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 30) {
                    $result['unitId'] = 6;
                    $result['hero_power'] = (500 + (($type - 28) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (12 + ($type - 28) * 4) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                    //tribe 2
                } else if ($type <= 33) {
                    $result['unitId'] = 21;
                    $result['hero_power'] = (500 + (($type - 31) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 31)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 36) {
                    $result['unitId'] = 22;
                    $result['hero_power'] = (500 + (($type - 34) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 34)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 39) {
                    $result['unitId'] = 24;
                    $result['hero_power'] = (500 + (($type - 37) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (6 + ($type - 37) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 42) {
                    $result['unitId'] = 25;
                    $result['hero_power'] = (500 + (($type - 40) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 40) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 45) {
                    $result['unitId'] = 26;
                    $result['hero_power'] = (500 + (($type - 43) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 43) * 3) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                    //tribe 3
                } else if ($type <= 48) {//
                    $result['unitId'] = 11;
                    $result['hero_power'] = (500 + (($type - 46) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 46)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 51) {
                    $result['unitId'] = 12;
                    $result['hero_power'] = (500 + (($type - 49) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 49)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 54) {
                    $result['unitId'] = 13;
                    $result['hero_power'] = (500 + (($type - 52) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 52)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 57) {
                    $result['unitId'] = 15;
                    $result['hero_power'] = (500 + (($type - 55) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (6 + ($type - 55) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 60) {
                    $result['unitId'] = 16;
                    $result['hero_power'] = (500 + (($type - 58) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 58) * 3) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 117) {
                    $result['unitId'] = 51;
                    $result['hero_power'] = (500 + (($type - 115) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 115)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 120) {
                    $result['unitId'] = 52;
                    $result['hero_power'] = (500 + (($type - 118) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 118)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 123) {
                    $result['unitId'] = 53;
                    $result['hero_power'] = (500 + (($type - 121) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 121)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 126) {
                    $result['unitId'] = 55;
                    $result['hero_power'] = (500 + (($type - 124) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (6 + ($type - 124) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 129) {
                    $result['unitId'] = 56;
                    $result['hero_power'] = (500 + (($type - 127) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 127) * 3) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 132) {
                    $result['unitId'] = 61;
                    $result['hero_power'] = (500 + (($type - 130) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 130)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 135) {
                    $result['unitId'] = 62;
                    $result['hero_power'] = (500 + (($type - 133) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (3 + ($type - 133)) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 138) {
                    $result['unitId'] = 64;
                    $result['hero_power'] = (500 + (($type - 136) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (6 + ($type - 136) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 141) {
                    $result['unitId'] = 65;
                    $result['hero_power'] = (500 + (($type - 139) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (6 + ($type - 139) * 2) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                } else if ($type <= 144) {
                    $result['unitId'] = 66;
                    $result['hero_power'] = (500 + (($type - 142) * 500)) * $heroItemsSettings['heroIncreaseHeroPower'];
                    $result['unit_power'] = (9 + ($type - 142) * 3) * $heroItemsSettings['heroIncreaseUnitPower'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['hero_power'],
                        $result['unit_power'],
                        $result['unit_power']);
                }
                break;
            case 5:
                if ($type <= 96) {
                    $result['reg'] = (10 + (($type - 94) * 5)) * $heroItemsSettings['heroRegenerationRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['reg']);
                } else if ($type <= 99) {
                    $result['min_distance'] = 20 * $heroItemsSettings['heroMinDistanceRate'];
                    $result['speed_distance'] = (25 + (($type - 97) * 25)) * $heroItemsSettings['heroDistanceSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'],
                        $result['speed_distance'],
                        $result['min_distance']);
                } else if ($type <= 102) {
                    $result['hero_cav_speed'] = (3 + (($type - 100))) * $heroItemsSettings['heroIncreaseSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['hero_cav_speed']);
                }
                break;
            case 6:
                if ($type <= 105) {
                    $result['speed_horse'] = (14 + (($type - 103) * 3)) * $heroItemsSettings['heroIncreaseSpeedRate'];
                    $result['attributes'] = sprintf($result['attributes'], $result['speed_horse']);
                }
                break;
            case 7:
                $result['revive'] = 25 * $heroItemsSettings['heroReviveRate'];
                $result['arrival_time'] = 24 / $heroItemsSettings['heroReviveArrivalTimeRate'];
                $result['attributes'] = sprintf($result['attributes'], $result['revive'], $result['arrival_time']);
                break;
            case 8:
                $result['revive'] = 33 * $heroItemsSettings['heroReviveRate'];
                $result['arrival_time'] = 24 / $heroItemsSettings['heroReviveArrivalTimeRate'];
                $result['attributes'] = sprintf($result['attributes'], $result['revive'], $result['arrival_time']);
                break;
            case 9:
                break;
            case 10:
                $result['exp'] = 10 * $heroItemsSettings['heroExtraExperienceGainRate'] * Formulas::getHeroExpLevelMultiplier();
                break;
            case 11:
                $result['reg'] = 1;
                $result['attributes'] = sprintf($result['attributes'], 100);
                break;
            case 12:
                break;
            case 13:
                break;
            case 14:
                $result['loyalty'] = 1;
                $result['attributes'] = sprintf($result['attributes'], $result['loyalty'], 125);
                break;
            case 15:
                $result['cp'] = 2000 / $heroItemsSettings['heroArtWorkRate'];
                //current account total cp or if higher just value of this.
                $result['attributes'] = sprintf($result['attributes'], 3, 2000 / $heroItemsSettings['heroArtWorkRate']);
                break;
        }
        $result['attributes'] = str_replace("&#37;", "%", $result['attributes']);
        $result['title'] = $result['attributes'];
        $result['attributes'] = explode("<br />", $result['attributes']);

        return $result;
    }
}