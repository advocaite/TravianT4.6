<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Game\Formulas;
use function getCustom;
use function getGameSpeed;
use const MAP_SIZE;

class WonderOfTheWorldModel
{
    public function attackWWVillage($kid, $level)
    {
        if (!getCustom("attackWWOnLevelUp")) return;
        $miliseconds = miliseconds();
        $speed = ceil(getGameSpeed() / (isInstantFinishEnabled() ? 250 : 350));
        if ($speed == 1) {
            $speed = 1;
        } else if ($speed <= 3) {
            $speed = 2;
        } else if ($speed <= 10) {
            $speed = 5;
        }
        // bad, but should work :D
        // I took the data from my first ww (first .org world)
        // TODO: get the algorithm from the real travian with the 100 biggest offs and so on
        $troops = [
            5 => [
                [1 => 0, 3412, 2814, 0, 4156, 3553, 9, 0],
                [1 => 0, 35, 0, 0, 77, 33, 17, 10]
            ],

            10 => [
                [1 => 0, 4314, 3688, 0, 5265, 4621, 13, 0],
                [1 => 0, 65, 0, 0, 175, 77, 28, 17]
            ],

            15 => [
                [1 => 0, 4645, 4267, 0, 5659, 5272, 15, 0],
                [1 => 0, 99, 0, 0, 305, 134, 40, 25]
            ],

            20 => [
                [1 => 0, 6207, 5881, 0, 7625, 7225, 22, 0],
                [1 => 0, 144, 0, 0, 456, 201, 56, 36]
            ],

            25 => [
                [1 => 0, 6004, 5977, 0, 7400, 7277, 23, 0],
                [1 => 0, 152, 0, 0, 499, 220, 58, 37]
            ],

            30 => [
                [1 => 0, 7073, 7181, 0, 8730, 8713, 27, 0],
                [1 => 0, 183, 0, 0, 607, 268, 69, 45]
            ],

            35 => [
                [1 => 0, 7090, 7320, 0, 8762, 8856, 28, 0],
                [1 => 0, 186, 0, 0, 620, 278, 70, 45]
            ],

            40 => [
                [1 => 0, 7852, 6967, 0, 9606, 8667, 25, 0],
                [1 => 0, 146, 0, 0, 431, 190, 60, 37]
            ],

            45 => [
                [1 => 0, 8480, 8883, 0, 10490, 10719, 35, 0],
                [1 => 0, 223, 0, 0, 750, 331, 83, 54]
            ],

            50 => [
                [1 => 0, 8522, 9038, 0, 10551, 10883, 35, 0],
                [1 => 0, 224, 0, 0, 757, 335, 83, 54]
            ],

            55 => [
                [1 => 0, 8931, 8690, 0, 10992, 10624, 32, 0],
                [1 => 0, 219, 0, 0, 707, 312, 84, 54]
            ],

            60 => [
                [1 => 0, 12138, 13013, 0, 15040, 15642, 51, 0],
                [1 => 0, 318, 0, 0, 1079, 477, 118, 76]
            ],

            65 => [
                [1 => 0, 13397, 14619, 0, 16622, 17521, 58, 0],
                [1 => 0, 345, 0, 0, 1182, 522, 127, 83]
            ],

            70 => [
                [1 => 0, 16323, 17665, 0, 20240, 21201, 70, 0],
                [1 => 0, 424, 0, 0, 1447, 640, 157, 102]
            ],

            75 => [
                [1 => 0, 20739, 22796, 0, 25746, 27288, 91, 0],
                [1 => 0, 529, 0, 0, 1816, 803, 194, 127]
            ],

            80 => [
                [1 => 0, 21857, 24180, 0, 27147, 28914, 97, 0],
                [1 => 0, 551, 0, 0, 1898, 839, 202, 132]
            ],

            85 => [
                [1 => 0, 22476, 25007, 0, 27928, 29876, 100, 0],
                [1 => 0, 560, 0, 0, 1933, 855, 205, 134]
            ],

            90 => [
                [1 => 0, 31345, 35053, 0, 38963, 41843, 141, 0],
                [1 => 0, 771, 0, 0, 2668, 1180, 281, 184]
            ],

            95 => [
                [1 => 0, 31720, 35635, 0, 39443, 42506, 144, 0],
                [1 => 0, 771, 0, 0, 2671, 1181, 281, 184]
            ],

            96 => [
                [1 => 0, 32885, 37007, 0, 40897, 44130, 150, 0],
                [1 => 0, 795, 0, 0, 2757, 1219, 289, 190]
            ],

            97 => [
                [1 => 0, 32940, 37099, 0, 40968, 44235, 150, 0],
                [1 => 0, 794, 0, 0, 2755, 1219, 289, 190]
            ],
            98 => [
                [1 => 0, 33521, 37691, 0, 41686, 44953, 152, 0],
                [1 => 0, 812, 0, 0, 2816, 1246, 296, 194]
            ],
            99 => [
                [1 => 0, 36251, 40861, 0, 45089, 48714, 165, 0],
                [1 => 0, 872, 0, 0, 3025, 1338, 317, 208]
            ]
        ];
        $move = new MovementsModel();
        $cap_kid = Formulas::xy2kid(0, 0);
        foreach ($troops[$level] as $units) {
            $units = [
                1  => $units[1] * $speed,
                2  => $units[2] * $speed,
                3  => $units[3] * $speed,
                4  => $units[4] * $speed,
                5  => $units[5] * $speed,
                6  => $units[6] * $speed,
                7  => $units[7] * $speed,
                8  => $units[8] * $speed,
                9  => 0,
                10 => 0,
                11 => 0,
            ];
            $units = array_map("ceil", $units);
            $time = max(24 * 3600 / getGameSpeed(), 300);
            $move->addMovement($cap_kid,
                $kid,
                5,
                $units,
                40,
                40,
                0,
                0,
                0,
                MovementsModel::ATTACKTYPE_NORMAL,
                $miliseconds,
                $miliseconds + 1000 * $time);
        }
    }

    public function createWWVillages()
    {
        $count = Config::getProperty("custom", "wwCount");
        $max = ceil(MAP_SIZE / (MAP_SIZE > 100 ? 4 : 2));
        $locations = [
            Formulas::xy2kid($max, -$max),
            Formulas::xy2kid(-5, -11),
            Formulas::xy2kid($max, 0),
            Formulas::xy2kid(0, -$max),
            Formulas::xy2kid(-$max, $max),
            Formulas::xy2kid(9, -8),
            Formulas::xy2kid(-12, 2),
            Formulas::xy2kid(11, 6),
            Formulas::xy2kid(0, $max),
            Formulas::xy2kid(-$max, -$max),
            Formulas::xy2kid($max, $max),
            Formulas::xy2kid(-$max, 0),
            Formulas::xy2kid(-2, 12),
        ];
        for ($i = 1; $i <= min(13, $count); ++$i) {
            $this->createWWVillage($locations[$i - 1]);
        }
    }

    public function createWWVillage($kid)
    {
        $register = new RegisterModel();
        if ($kid < 0) {
            $kid = $register->generateWWNatarsVillage();
            if (!$kid) return;
        }
        if ($kid > 0) {
            $register->createWWVillage($kid);
        }
    }

    public function findPositionsForWWPlan($count)
    {
        $locations = [
            'nw' => [[-18, 30], [-35, 4], [-45, 37]],
            'sw' => [[-26, -25], [-10, -57], [-55, -20]],
            'ne' => [[33, 12], [12, 33], [10, 56], [55, 20]],
            'se' => [[30, -20], [4, -35], [44, -37]],
        ];
        $eachSide = max(1, floor($count / 4));
        $return = [];
        $register = new RegisterModel();
        foreach ($locations as $side_name => $side_locations) {
            $current = 0;
            $max = $eachSide + ($side_name == 'ne' && ($count % 2 == 1) ? 1 : 0);
            foreach ($side_locations as $coordinate) {
                if (($kid = $register->getBestPosition(Formulas::xy2kid($coordinate[0], $coordinate[1]), 0))) {
                    array_push($return, $kid);
                }
                ++$current;
                if ($current >= $max) break;
            }
        }
        return $return;
    }

    public static function getWWTroops($isGrayArea)
    {
        if (getGameSpeed() <= 10) {
            $multiplier = getGameSpeed();
            if ($multiplier <= 3) $multiplier = 2;
            else if ($multiplier <= 10) $multiplier = 5;
        } else {
            $multiplier = ceil(getGameSpeed() / (isInstantFinishEnabled() ? 50 : 60));
        }
        /*
         * $units_inner = [1 => 11842, 29476, 11852, 71, 19984, 14104, 2989, 2714, 0, 0, 0];
         * $units_outer = [1 => 16578, 38785, 15154, 88, 26403, 18566, 5392, 2325, 0, 0, 0];
         */
        if ($isGrayArea) {
            $units = [
                1 => mt_rand(11000, 12000),
                mt_rand(28000, 30000),
                mt_rand(11000, 13000),
                mt_rand(70, 150),
                mt_rand(19000, 21000),
                mt_rand(14000, 16000),
                mt_rand(2000, 4000),
                mt_rand(2000, 3500),
                0,
                0,
                0
            ];
        } else {
            $units = [
                1 => mt_rand(16000, 18000),
                mt_rand(38000, 41000),
                mt_rand(15000, 17000),
                mt_rand(80, 260),
                mt_rand(26000, 30000),
                mt_rand(18000, 20000),
                mt_rand(5000, 7000),
                mt_rand(2000, 4000),
                0,
                0,
                0
            ];
        }
        return array_map(function ($x) use ($multiplier) {
            return round($x * $multiplier);
        },  $units);
    }
}