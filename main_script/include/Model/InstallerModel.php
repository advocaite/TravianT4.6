<?php

namespace Model;

use Core\Database\DB;
use Game\Formulas;
use const INCLUDE_PATH;
use function json_decode;

class InstallerModel
{
    public $map     = [];
    public $layouts = [
        "wald" => [
            1  => [//fixed
                   "every"  => [3, 7],
                   "needle" => ["x" => 1, "y" => 1],
                   "layout" => [
                       '0|0' => '-', //empty space
                   ],
            ],
            2  => [//fixed
                   "every"  => [3, 7],
                   "needle" => ["x" => 1, "y" => 3],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-ns',
                       '0|2' => '-n',
                   ],
            ],
            3  => [//fixed
                   "needle" => ["x" => 2, "y" => 4],
                   "layout" => [
                       '1|0' => '-s',
                       '0|1' => '-e',
                       '1|1' => '-nws',
                       '1|2' => '-ns',
                       '1|3' => '-n',
                   ],
            ],
            4  => [//fixed
                   "needle" => ["x" => 1, "y" => 2],
                   "layout" => ['0|0' => '-s', '0|1' => '-n',],
            ],
            5  => [//fixed
                   "needle" => ["x" => 2, "y" => 1],
                   "layout" => ['0|0' => '-e', '1|0' => '-w',],
            ],
            6  => [//fixed
                   "needle" => ["x" => 2, "y" => 2],
                   "layout" => [
                       '1|0' => '-s',
                       '0|1' => '-e',
                       '1|1' => '-nw',
                   ],
            ],
            7  => [//fixed
                   "needle" => ["x" => 2, "y" => 2],
                   "layout" => [
                       '0|0' => '-se',
                       '0|1' => '-ne',
                       '1|0' => '-ws',
                       '1|1' => '-nw',
                   ],
            ],
            8  => [//fixed
                   "needle" => ["x" => 3, "y" => 1],
                   "layout" => [
                       '0|0' => '-e',
                       '1|0' => '-we',
                       '2|0' => '-w',
                   ],
            ],
            9  => [//fixed
                   "needle" => ["x" => 2, "y" => 2],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-ne',
                       '1|1' => '-w',
                   ],
            ],
            10 => [//fixed
                   "needle" => ["x" => 3, "y" => 4],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-ns',
                       '0|2' => '-ne',
                       '1|2' => '-ws',
                       '1|3' => '-ne',
                       '2|3' => '-w',
                   ],
            ],
            11 => [//fixed
                   "needle" => ["x" => 2, "y" => 2],
                   "layout" => [
                       '0|0' => '-se',
                       '1|0' => '-w',
                       '0|1' => '-n',
                   ],
            ],
            12 => [//fixed
                   "needle" => ["x" => 2, "y" => 3],
                   "layout" => [
                       '0|0' => '-e',
                       '1|0' => '-ws',
                       '1|1' => '-ns',
                       '1|2' => '-n',
                   ],
            ],
            13 => [//fixed
                   "needle" => ["x" => 2, "y" => 3],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-nse',
                       '0|2' => '-n',
                       '1|1' => '-w',
                   ],
            ],
            14 => [//fixed
                   "needle" => ["x" => 1, "y" => 4],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-ns',
                       '0|2' => '-ns',
                       '0|3' => '-n',
                   ],
            ],
            15 => [//fixed
                   "needle" => ["x" => 3, "y" => 2],
                   "layout" => [
                       '2|0' => '-s',
                       '2|1' => '-nw',
                       '0|1' => '-e',
                       '1|1' => '-we',
                   ],
            ],
            16 => [//fixed
                   "needle" => ["x" => 3, "y" => 3],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-nse',
                       '0|2' => '-n',
                       '1|1' => '-w',
                   ],
            ],
            17 => [//fixed
                   "needle" => ["x" => 3, "y" => 2],
                   "layout" => [
                       '2|0' => '-w',
                       '1|0' => '-se',
                       '0|1' => '-e',
                       '1|1' => '-nw',
                   ],
            ],
            18 => [//fixed
                   "needle" => ["x" => 3, "y" => 4],
                   "layout" => [
                       '0|0' => '-s',
                       '0|1' => '-nse',
                       '1|1' => '-w',
                       '0|2' => '-ns',
                       '0|3' => '-n',
                   ],
            ],
            19 => [//fixed
                   "needle" => ["x" => 3, "y" => 3],
                   "layout" => [
                       '2|0' => '-s',
                       '0|1' => '-e',
                       '1|1' => '-wse',
                       '2|1' => '-nw',
                       '1|2' => '-n',
                   ],
            ],
            20 => [//fixed
                   "needle" => ["x" => 5, "y" => 2],
                   "layout" => [
                       '0|0' => '-e',
                       '1|0' => '-wse',
                       '2|0' => '-we',
                       '3|0' => '-we',
                       '4|0' => '-w',
                       '1|1' => '-n',
                   ],
            ],
            21 => [//fixed
                   "needle" => ["x" => 4, "y" => 3],
                   "layout" => [
                       '1|0' => '-s',
                       '1|1' => '-ns',
                       '4|0' => '-nwe',
                       '3|2' => '-w',
                       '0|2' => '-e',
                       '1|2' => '-nwe',
                       '2|2' => '-we',
                   ],
            ],
            22 => [//fixed
                   "needle" => ["x" => 6, "y" => 2],
                   "layout" => [
                       '0|0' => '-se',
                       '1|0' => '-we',
                       '2|0' => '-we',
                       '3|0' => '-we',
                       '4|0' => '-we',
                       '5|0' => '-w',
                       '0|1' => '-n',
                   ],
            ],
            23 => [
                "needle" => ["x" => 6, "y" => 2],
                "layout" => [
                    '0|0' => '-se',
                    '1|0' => '-we',
                    '2|0' => '-we',
                    '3|0' => '-we',
                    '4|0' => '-we',
                    '5|0' => '-w',
                    '0|1' => '-n',
                ],
            ],
            24 => [
                "needle" => ["x" => 6, "y" => 2],
                "layout" => [
                    '0|0' => '-se',
                    '1|0' => '-we',
                    '2|0' => '-we',
                    '3|0' => '-wse',
                    '4|0' => '-we',
                    '5|0' => '-ws',
                    '0|1' => '-n',
                    '5|1' => '-n',
                    '3|1' => '-n',
                ],
            ],
            25 => [
                "needle" => ["x" => 3, "y" => 3],
                "layout" => [
                    '0|0' => '-e',
                    '1|0' => '-wse',
                    '2|0' => '-w',
                    '1|1' => '-ns',
                    '0|2' => '-e',
                    '1|2' => '-nwe',
                    '2|2' => '-w',
                ],
            ],
        ],
        'clay' => [
            3 => ['1|0', '2|0'],
            4 => ['1|0'],
            5 => ['1|1'],
            6 => ['1|0', '1|2'],
            7 => ['1|1'],
        ],
        'iron' => [
            0 => ['0|0', '1|0', '2|0', '1|0', '1|2'],
            1 => ['0|0', '0|1', '3|0', '3|1'],
            2 => ['0|0', '0|1', '3|0', '3|1'],
            3 => [
                '0|0',
                '0|1',
                '0|2',
                '0|3',
                '1|0',
                '2|0',
                '3|0',
                '2|1',
                '3|0',
                '3|1',
                '3|2',
                '3|3',
                '0|3',
                '1|3',
                '2|3',
            ],
            4 => [
                '0|0',
                '0|1',
                '0|2',
                '1|0',
                '2|0',
                '3|0',
                '2|1',
                '3|1',
                '2|2',
                '3|3',
            ],
            5 => ['0|0', '0|1', '4|0', '4|1'],
            6 => [
                '0|0',
                '1|0',
                '2|0',
                '0|1',
                '0|2',
                '0|3',
                '2|0',
                '2|1',
                '2|2',
                '2|3',
            ],
            7 => [],
        ],
        'lake' => [
            0 => [],
            1 => [],
            2 => ['0|0', '1|2', '2|2', '3|0'],
            3 => ['0|0', '3|0', '0|4', '1|4'],
            4 => ['2|0', '2|2'],
            5 => ['0|0', '0|1', '2|5', '3|5', '4|5', '3|4', '4|4', '4|3'],
            6 => [],
            7 => ['0|0', '3|0', '3|2', '3|3', '2|3'],
        ],
    ];
    public $crops   = [];

    public function pushMapToDB()
    {
        $db = DB::getInstance();
        $queryBatch = [];
        $queryBatchUnits = [];
        $queryBatchOases = [];
        $queryBatchVillages = [];
        $oasisId = 0;
        $fields = 0;
        $oh2 = (2 * MAP_SIZE + 1);

        foreach ($this->map as $id => $values) {
            if (!isset($values['y'])) {
                continue;
            }
            if (!$values['fieldtype'] && !$values['oasistype'] && !$values['landscape']) {
                $this->getFieldType($id, $values['fieldtype']);
            }
            $percent = 0;
            if ($values['fieldtype'] == 1 || $values['fieldtype'] == 6) {
                $percent = $this->getNearByFieldOasisPercent($id, 4.9497474683058326708059105347339);
            }
            $percent = min($percent, 150);
            $angle = Formulas::getAngleByXY($values['x'], $values['y']);
            $queryBatch[] = vsprintf("('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                [
                    $id,
                    $values['x'],
                    $values['y'],
                    $values['fieldtype'],
                    $values['oasistype'],
                    $values['landscape'],
                    $percent,
                    0,
                    $this->implodeParams($values['map']),
                ]);
            if ($values['fieldtype']) {
                ++$fields;
                $queryBatchVillages[] = sprintf("(%s, %s, %s, %s, %s)",
                    $id,
                    $values['fieldtype'],
                    hypot($values['x'], $values['y']),
                    $angle,
                    mt_rand(10000000, 99999999));
            }
            if ($fields >= $oh2) {
                $db->query("INSERT INTO available_villages (kid, fieldtype, r, angle, rand) VALUES " . implode(",",
                        $queryBatchVillages));
                $fields = 0;
                $queryBatchVillages = [];
            }
            if ($id % $oh2 == 0) {
                $db->query("INSERT INTO wdata (id, x, y, fieldtype, oasistype, landscape, crop_percent, occupied, map) VALUES " . implode(",",
                        $queryBatch));
                $queryBatch = [];
            }
            if ($values['oasistype']) {
                $maxStore = Formulas::getOasisStorage($values['oasistype']);
                $min = ceil($maxStore * 0.9375);
                ++$oasisId;
                //We switch type of oasis and instert record with apropriate infomation.
                $queryBatchOases[] = vsprintf("(%s, %s, %s, %s, %s, %s, %s)",
                    [
                        $id,
                        $values['oasistype'],
                        $min,
                        $min,
                        $min,
                        $min,
                        miliseconds(),
                    ]);
                $queryBatchUnits[] = "({$id}, 4)";
            }
            if ($oasisId >= $oh2) {
                $db->query("INSERT INTO units (kid, race) VALUES " . implode(",", $queryBatchUnits));
                $db->query("INSERT INTO odata (`kid`, `type`, `wood`, `iron`, `clay`, `crop`, `lastmupdate`) VALUES " . implode(",",
                        $queryBatchOases));
                $queryBatchOases = $queryBatchUnits = [];
                $oasisId = 0;
            }
        }
        if (sizeof($queryBatch)) {
            $db->query("INSERT INTO wdata (id, x, y, fieldtype, oasistype, landscape, crop_percent, occupied, map) VALUES " . implode(",",
                    $queryBatch));
        }
        if (sizeof($queryBatchUnits)) {
            $db->query("INSERT INTO units (kid, race) VALUES " . implode(",", $queryBatchUnits));
        }
        if (sizeof($queryBatchOases)) {
            $db->query("INSERT INTO odata (`kid`, `type`, `wood`, `iron`, `clay`, `crop`, `lastmupdate`) VALUES " . implode(",",
                    $queryBatchOases));
        }
        if (sizeof($queryBatchVillages)) {
            $db->query("INSERT INTO available_villages (kid, fieldtype, r, angle, rand) VALUES " . implode(",",
                    $queryBatchVillages));
        }
    }

    public function getFieldType($kid, &$fieldtype)
    {
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
            Formulas::xy2kid(1, 0),
        ];
        $cap_kid = Formulas::xy2kid(0, 0);
        if ($kid == $cap_kid) {
            $fieldtype = 1;
        } else if (in_array($kid, $locations)) {
            $fieldtype = 3;
        } else if (isset($this->crops[$kid])) {
            $fieldtype = $this->crops[$kid]['typ'];
        } else {
            $rand = mt_rand(1, 1000);
            /*if ($rand <= 10) {
                $fieldtype = 1;
            } else */
            if ($rand <= 90) {
                $fieldtype = 2;
            } else if ($rand <= 400) {
                $fieldtype = 3;
            } else if ($rand <= 480) {
                $fieldtype = 4;
            } else if ($rand <= 560) {
                $fieldtype = 5;
            }/* else if ($rand <= 570) {
                $fieldtype = 6;
            }*/ else if ($rand <= 600) {
                $fieldtype = 7;
            } else if ($rand <= 630) {
                $fieldtype = 8;
            } else if ($rand <= 660) {
                $fieldtype = 9;
            } else if ($rand <= 740) {
                $fieldtype = 10;
            } else if ($rand <= 820) {
                $fieldtype = 11;
            } else {
                $fieldtype = 12;
            }
        }
    }

    public function getNearByFieldOasisPercent($kid, $distance)
    {
        $xy = ['x' => $this->map[$kid]['x'], 'y' => $this->map[$kid]['y']];
        $ruler_x = $ruler_y = 7;
        $i = $xy['y'] + floor($ruler_y / 2);
        $percent = 0;
        $percents = [];
        while ($i >= $xy['y'] - floor($ruler_y / 2)) {
            $current_y = Formulas::coordinateFixer($i);
            $j = $xy['x'] - floor($ruler_x / 2);
            while ($j <= $xy['x'] + floor($ruler_x / 2)) {
                $current_x = Formulas::coordinateFixer($j);
                if (Formulas::getDistance([
                        'x' => $current_x,
                        'y' => $current_y,
                    ],
                        $xy) <= $distance
                ) {
                    $current_kid = Formulas::xy2kid($current_x, $current_y);
                    if($this->map[$current_kid]['oasistype'] > 0){
                        $effect = Formulas::getOasisEffect($this->map[$current_kid]['oasistype']);
                        if (array_key_exists(4, $effect)) {
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

    public function implodeParams($data)
    {
        return $data['parent']['x'] . '|' . $data['parent']['y'] . '|' . $data['parent']['img'] . '=' . $data['child']['x'] . '|' . $data['child']['y'] . '|' . $data['child']['img'];
    }

    public function mapToArray()
    {
        $crops = json_decode(file_get_contents(INCLUDE_PATH . '/schema/crops.json'), true);
        foreach ($crops as $crop) {
            $kid = Formulas::xy2kid($crop['coordinates']['x'], $crop['coordinates']['y']);
            $this->crops[$kid] = $crop;
        }
        $map = $this->explodeParams('||=||');
        $max = 1;
        $oh = (2 * MAP_SIZE + 1) * (2 * MAP_SIZE + 1);
        while ($max <= $oh) {
            $xy = Formulas::kid2xy($max);
            $this->map[$max] = [
                'id'        => $max,
                "x"         => $xy['x'],
                "y"         => $xy['y'],
                "fieldtype" => 0,
                "oasistype" => 0,
                "landscape" => 0,
                "map"       => $map,
            ];

            if (isset($this->crops[$max])) {
                $this->map[$max]['fieldtype'] = $this->crops[$max]['typ'];
            }

            $max++;
        }
    }

    public function explodeParams($data)
    {
        //||=||
        list($parent, $child) = explode("=", $data);
        $parent = explode('|', $parent);
        $child = explode('|', $child);

        return [
            'parent' => [
                "x"   => $parent[0],
                "y"   => $parent[1],
                'img' => $parent[2],
            ],
            'child'  => [
                "x"   => $child[0],
                "y"   => $child[1],
                'img' => $child[2],
            ],
        ];
    }

    public function createRestOfTheMap()
    {
        $this->createVulcanoArea();
        $max = (2 * MAP_SIZE + 1) * (2 * MAP_SIZE + 1);
        for ($id = 1; $id <= $max; ++$id) {
            $rand = mt_rand(1, 8);
            if ($rand > 6) {
                $rand = mt_rand(1, 40);
                if ($rand <= 8) {
                    $this->createWald();
                } else if ($rand <= 13) {
                    $this->createClay();
                } else if ($rand <= 18) {
                    $this->createHill();
                } else if ($rand <= 21) {
                    $this->createLake();
                }
            }
        }
    }

    public function createVulcanoArea()
    {
        $x = 6;
        $y = 4;
        $rel_x = -2;
        $rel_y = 1;
        $i = 1;
        $dst_x = $dst_y = 0;
        while ($i <= $y) {
            $j = 1;
            $rel_y = Formulas::coordinateFixer($rel_y);
            while ($j <= $x) {
                $rel_x = Formulas::coordinateFixer($rel_x);
                $kid = Formulas::xy2kid($rel_x, $rel_y);
                $this->map[$kid]['fieldtype'] = $this->map[$kid]['oasistype'] = $this->map[$kid]['landscape'] = 0;
                $isOut = $this->isOutOfRange(1, 0, $dst_x, $dst_y);
                $isNear = $this->isNearRange(1, 0, $dst_x, $dst_y);
                if ($isOut && $isNear) {
                    $isOut = mt_rand(1, 10) <= 4;
                }
                $this->setProperties($kid, $isOut, $dst_x, $dst_y, '0_0');
                $rel_x = $this->map[$kid]['x'];
                $rel_y = $this->map[$kid]['y'];
                if ($this->getVulcanoFieldMapsId($rel_x, $rel_y) == 0) {
                    $this->map[$kid]['landscape'] = 5;
                } else if ($this->getVulcanoFieldMapsId($rel_x, $rel_y) == NULL) {
                    $this->getFieldType($kid, $this->map[$kid]['fieldtype']);
                } else {
                    $this->map['kid']['fieldtype'] = $this->getVulcanoFieldMapsId($rel_x, $rel_y);
                }
                ++$j;
                ++$dst_x;
                ++$rel_x;
            }
            $rel_x = -2;
            $dst_x = 0;
            --$rel_y;
            ++$dst_y;
            ++$i;
        }
    }

    public function isOutOfRange($imgType, $imgId, $dst_x, $dst_y)
    {
        switch ($imgType) {
            case 1:
                //6*4
                if ($dst_y == 0 && $dst_x == 0) {
                    return TRUE;
                }
                if ($dst_y <= 2 && $dst_x == 4) {
                    return TRUE;
                }
                if ($dst_x > 4) {
                    return TRUE;
                }

                return FALSE;
                break;
            case 3:
                switch ($imgId) {
                    case 0:
                    case 1:
                    case 2:
                        return FALSE;
                        break;
                    case 3://2x3
                        if ($dst_y == 0 && $dst_x == 1) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 0) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 4:
                        if ($dst_y == 0 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 5:
                        if ($dst_y == 1 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 6:
                        if ($dst_y == 0 && $dst_x == 1) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 7:
                        if ($dst_x == 0 && $dst_y == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                }
                break;
            case 4:
                switch ($imgId) {
                    case 0://3*2
                        if ($dst_y == 0) {
                            return TRUE;
                        }
                        if ($dst_x == 0 || $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 1://4*2
                        if ($dst_x == 0 || $dst_x >= 3) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && ($dst_x == 0 || $dst_x == 3)) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 2://4*2
                        if ($dst_x == 0 || $dst_x == 3) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 3://4*4//fuck this
                        if ($dst_y == 0 || $dst_y == 3) {
                            return TRUE;
                        }
                        if ($dst_x == 0) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && ($dst_x == 0 || $dst_x >= 2)) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x > 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 4://4*3
                        if ($dst_y == 0) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && ($dst_x <> 1 && $dst_x <> 2)) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && ($dst_x <> 1)) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 5://5*2
                        if ($dst_x == 0 || $dst_x == 4) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 6://3*4
                        if ($dst_y == 0 || $dst_x == 0 || $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 7://1*1
                        return FALSE;
                        break;
                }
                break;
            case 5:
                switcH ($imgId) {
                    case 0:
                        return FALSE;
                        break;
                    case 1:
                        return FALSE;
                        break;
                    case 2:
                        if ($dst_y == 0 && $dst_x == 0) {
                            return TRUE;
                        }
                        if ($dst_y == 0 && $dst_x == 3) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && ($dst_x == 1 || $dst_x == 2)) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 3:
                        if ($dst_y == 0 && $dst_x == 0) {
                            return TRUE;
                        }
                        if ($dst_y == 3 && ($dst_x == 0 || $dst_x == 1)) {
                            return TRUE;
                        }
                        if ($dst_y == 0 && $dst_x >= 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 4:
                        if ($dst_x == 3 && $dst_y == 1) {
                            return FALSE;
                        }
                        if ($dst_y == 0 && $dst_x == 2) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 5:
                        if ($dst_y == 0 && ($dst_x == 0 || $dst_x == 4)) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && ($dst_x == 0 || $dst_x == 4)) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 4) {
                            return TRUE;
                        }
                        if ($dst_y == 3 && ($dst_x >= 3)) {
                            return TRUE;
                        }
                        if ($dst_y == 4 && ($dst_x <> 1)) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 6:
                        return FALSE;
                        break;
                    case 7:
                        if ($dst_y == 0 && ($dst_x == 0 || $dst_x == 3)) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && ($dst_x == 3)) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && ($dst_x >= 2)) {
                            return TRUE;
                        }
                        if ($dst_y == 3 && ($dst_x <> 1)) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                }
                break;
        }
    }

    public function isNearRange($imgType, $imgId, $dst_x, $dst_y)
    {
        switch ($imgType) {
            case 1:
                //6*4
                if ($dst_y == 3 && $dst_x == 4) {
                    return TRUE;
                }

                return FALSE;
                break;
            case 3:
                switch ($imgId) {
                    case 0:
                    case 1:
                    case 2:
                    case 4:
                    case 3://4x4
                        return FALSE;
                        break;
                    case 5:
                        if ($dst_y == 1 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 6:
                        if ($dst_y == 0 && $dst_x == 1) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 7:
                        if ($dst_x == 0 && $dst_y == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                }
                break;
            case 4:
                switch ($imgId) {
                    case 0://3*2
                    case 2://4*2
                    case 3://4*4
                    case 6://3*4
                    case 7://1*1
                        return FALSE;
                        break;
                    case 1://4*2
                        if ($dst_y == 0 && $dst_x == 1 && $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 4://4*3
                        if ($dst_y == 1 && $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 5://5*2
                        if ($dst_y == 1 && $dst_x == 3) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                }
                break;
            case 5:
                switcH ($imgId) {
                    case 0:
                    case 1:
                    case 6:
                    case 7:
                        return FALSE;
                        break;
                    case 2:
                        if ($dst_y == 2 && $dst_x == 1) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 2) {
                            return TRUE;
                        }
                        if ($dst_y == 2 && $dst_x == 3) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 3:
                        if ($dst_y == 0 && $dst_x == 2) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 4:
                        if ($dst_y == 2 && $dst_x == 1) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                    case 5:
                        if ($dst_y == 4 && $dst_x == 0) {
                            return TRUE;
                        }
                        if ($dst_y == 1 && $dst_x == 4) {
                            return TRUE;
                        }
                        if ($dst_y == 3 && $dst_x == 3) {
                            return TRUE;
                        }

                        return FALSE;
                        break;
                }
                break;
        }
    }

    public function setProperties($kid, $isOut, $x, $y, $img)
    {
        if ($isOut && $this->setAsParentOrNot($kid) === TRUE) {
            $mode = 'parent';
        } else {
            $mode = 'child';
        }
        /*
        $mode = $this->setAsParentOrNot($kid);
        if($mode === -1) return false;
        $mode = $mode ? 'parent' : 'child';
        */
        $this->map[$kid]['map'][$mode]['x'] = $x;
        $this->map[$kid]['map'][$mode]['y'] = $y;
        $this->map[$kid]['map'][$mode]['img'] = $img;

        return TRUE;
    }

    public function setAsParentOrNot($kid)
    {
        if ($this->map[$kid]['map']['parent']['img'] == '') {
            return TRUE;
        } else if ($this->map[$kid]['map']['child']['img'] == '') {
            return FALSE;
        }

        return -1;
    }

    public function getVulcanoFieldMapsId($rel_x, $rel_y)
    {
        if ($rel_y == 0 AND $rel_x == 0) {
            return 1;
        } else if ($rel_y == 0 AND $rel_x == 1) {
            return 3;
        } else if ($rel_y == 0 AND $rel_x == 1) {
            return 3;
        } else if (($rel_y == -1 OR $rel_y == -2) AND ($rel_x > -2 AND $rel_x < 2)) {
            return 0;
        }

        return NULL;
    }

    private function createWald()
    {
        if (sizeof($this->layouts['wald']) != 25) {
            echo 'walds are not available due change of layout sizes.';
            exit();
        }
        $r = mt_rand(10, 250);
        if ($r <= 16 || $r > 89) {
            $r = 1;
        } else if ($r <= 22) {
            $r = 2;
        } else if ($r <= 26) {
            $r = 3;
        } else if ($r <= 30) {
            $r = 4;
        } else if ($r <= 33) {
            $r = 5;
        } else if ($r <= 36) {
            $r = 6;
        } else if ($r <= 40) {
            $r = 7;
        } else if ($r <= 44) {
            $r = 8;
        } else if ($r <= 49) {
            $r = 9;
        } else if ($r <= 52) {
            $r = 10;
        } else if ($r <= 55) {
            $r = 11;
        } else if ($r <= 59) {
            $r = 12;
        } else if ($r <= 62) {
            $r = 13;
        } else if ($r <= 64) {
            $r = 14;
        } else if ($r <= 66) {
            $r = 15;
        } else if ($r <= 69) {
            $r = 16;
        } else if ($r <= 72) {
            $r = 17;
        } else if ($r <= 75) {
            $r = 18;
        } else if ($r <= 77) {
            $r = 19;
        } else if ($r <= 79) {
            $r = 20;
        } else if ($r <= 81) {
            $r = 21;
        } else if ($r <= 83) {
            $r = 22;
        } else if ($r <= 85) {
            $r = 23;
        } else if ($r <= 87) {
            $r = 24;
        } else if ($r <= 89) {
            $r = 25;
        }
        $layout = $this->layouts['wald'][$r];
        $find = $this->findFree($layout['needle']['x'], $layout['needle']['y']);
        if (!is_array($find)) {
            return FALSE;
        }
        $rel_x = $find['x'];
        $rel_y = $find['y'];
        $dst_x = $dst_y = 0;
        $i = 1;
        while ($i <= $layout['needle']['y']) {
            $j = 1;
            $rel_y = Formulas::coordinateFixer($rel_y);
            while ($j <= $layout['needle']['x']) {
                $rel_x = Formulas::coordinateFixer($rel_x);
                if (isset($layout['layout'][$dst_x . '|' . $dst_y])) {
                    $kid = Formulas::xy2kid($rel_x, $rel_y);
                    $this->map[$kid]['fieldtype'] = $this->map[$kid]['oasistype'] = $this->map[$kid]['landscape'] = 0;
                    $imgId = $layout['layout'][$dst_x . '|' . $dst_y];
                    $this->setProperties($kid, FALSE, 0, 0, '1_' . $imgId);//dst_x|dst_y for wald is always 0
                    $this->getOasesType($kid, 1);
                }
                $rel_x++;
                $dst_x++;
                ++$j;
            }
            $rel_x = $find['x'];
            $dst_x = 0;
            $rel_y--;
            $dst_y++;
            ++$i;
        }
    }

    public function findFree($xCount, $yCount)
    {
        //best: 8000
        $maxTries = 800;//increase this for more capacity.
        $found = FALSE;
        while (!$found && $maxTries) {
            $row = $this->map[$this->getRandId()];
            if (!$this->hasValidProperties($row['id'], $maxTries)) {
                --$maxTries;
                continue;
            }
            $x = $xCount;
            $y = $yCount;
            $i = 1;
            $rel_x = $row['x'];
            $rel_y = $row['y'];
            $found = TRUE;
            while ($i <= $y) {
                $j = 1;
                $rel_y = Formulas::coordinateFixer($rel_y);
                while ($j <= $x) {
                    $rel_x = Formulas::coordinateFixer($rel_x);
                    $find = $this->map[Formulas::xy2kid($rel_x, $rel_y)];
                    if (!$this->hasValidProperties($find['id'], $maxTries)) {
                        $found = FALSE;
                        break;
                    }
                    $rel_x++;
                    ++$j;
                }
                if (!$found) {
                    $found = FALSE;
                    break;
                }
                $rel_x = $row['x'];
                $rel_y--;
                ++$i;
            }
            if ($found) {
                return ["x" => $row['x'], 'y' => $row['y']];
            } else {
                $maxTries--;
            }
        }

        return 0;
    }

    public function getRandId()
    {
        $max = (2 * MAP_SIZE + 1) * (2 * MAP_SIZE + 1);
        $half_4 = floor($max / 8);
        $rand = mt_rand(1, 70);
        if ($rand <= 5) {
            return mt_rand(1, $max);
        } else if ($rand <= 15) {
            return mt_rand(1, $half_4);
        } else if ($rand <= 23) {
            return mt_rand($half_4, $half_4 * 2);
        } else if ($rand <= 30) {
            return mt_rand($half_4 * 2, $half_4 * 3);
        } else if ($rand <= 36) {
            return mt_rand($half_4 * 3, $half_4 * 4);
        } else if ($rand <= 40) {
            return mt_rand($half_4 * 4, $half_4 * 5);
        } else if ($rand <= 45) {
            return mt_rand($half_4 * 5, $half_4 * 6);
        } else if ($rand <= 50) {
            return mt_rand($half_4 * 6, $half_4 * 7);
        } else if ($rand <= 56) {
            return mt_rand($half_4 * 7, $half_4 * 8 + 1);
        }
        return mt_rand(1, $max);
    }

    public function hasValidProperties($kid, &$maxTries)
    {
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
            Formulas::xy2kid(1, 0),
        ];

        if (!($this->map[$kid]['fieldtype'] == 0)) {
            --$maxTries;
            return false;
        }
        //wald doesn't access any other parent or child.
        if (strpos($this->map[$kid]['map']['parent']['img'], '1_') != 0) {
            --$maxTries;

            return FALSE;
        } else if ($this->map[$kid]['map']['child']['img'] != '') {
            --$maxTries;

            return FALSE;
        } else if (in_array($kid, $locations)) {
            --$maxTries;

            return FALSE;
        }

        return TRUE;
    }

    public function getOasesType($kid, $type)
    {
        $r = mt_rand(1000, 13000);
        $r /= 1000;
        $isGrayArea = Formulas::isGrayArea($kid);
        switch ($type) {
            case 1:
                if ($isGrayArea) {
                    if ($r <= 3) {
                        $this->map[$kid]['oasistype'] = mt_rand(3, 4);
                    } else {
                        $this->map[$kid]['landscape'] = 1;
                    }
                    break;
                }
                if ($r <= 3) {
                    $this->map[$kid]['oasistype'] = 2;
                } else if ($r <= 5) {
                    $this->map[$kid]['oasistype'] = 3;
                } else {
                    $this->map[$kid]['landscape'] = 1;
                }
                break;
            case 2:
                if ($isGrayArea) {
                    if ($r <= 3) {
                        $this->map[$kid]['oasistype'] = mt_rand(7, 8);
                    } else {
                        $this->map[$kid]['landscape'] = 2;
                    }
                    break;
                }
                if ($r <= 3) {
                    $this->map[$kid]['oasistype'] = 6;
                } else if ($r <= 5) {
                    $this->map[$kid]['oasistype'] = 7;
                } else {
                    $this->map[$kid]['landscape'] = 2;
                }
                break;
            case 3:
                if ($isGrayArea) {
                    if ($r <= 3) {
                        $this->map[$kid]['oasistype'] = mt_rand(11, 12);
                    } else {
                        $this->map[$kid]['landscape'] = 3;
                    }
                    break;
                }
                if ($r <= 3) {
                    $this->map[$kid]['oasistype'] = 10;
                } else if ($r <= 5) {
                    $this->map[$kid]['oasistype'] = 11;
                } else {
                    $this->map[$kid]['landscape'] = 3;
                }
                break;
            case 4:
                if ($isGrayArea) {
                    if ($r <= 10) {
                        $this->map[$kid]['oasistype'] = 15;
                    } else {
                        $this->map[$kid]['landscape'] = 4;
                    }
                    break;
                }
                if ($r <= 2.5) {
                    $this->map[$kid]['oasistype'] = 15;
                } else if ($r <= 7) {
                    $this->map[$kid]['oasistype'] = 14;
                } else {
                    $this->map[$kid]['landscape'] = 4;
                }
                break;
        }
    }

    private function createClay()
    {
        $r = mt_rand(1, 30);
        if ($r <= 8) {
            $imgId = 0;
        } else if ($r <= 13) {
            $imgId = 1;
        } else if ($r <= 15) {
            $imgId = 2;
        } else if ($r <= 18) {
            $imgId = 3;
        } else if ($r <= 22) {
            $imgId = 4;
        } else if ($r <= 26) {
            $imgId = 5;
        } else if ($r <= 28) {
            $imgId = 6;
        } else {
            $imgId = 7;
        }
        $img = imagecreatefrompng(PUBLIC_PATH . "img/map/clay/60x60/clay{$imgId}.png");
        $needle = ["x" => imagesx($img) / 60, "y" => imagesy($img) / 60];
        $find = $this->findFree($needle['x'], $needle['y']);
        if (!is_array($find)) {
            return FALSE;
        }
        $rel_x = $find['x'];
        $rel_y = $find['y'];
        $dst_x = $dst_y = 0;
        $i = 1;
        while ($i <= $needle['y']) {
            $j = 1;
            $rel_y = Formulas::coordinateFixer($rel_y);
            while ($j <= $needle['x']) {
                $rel_x = Formulas::coordinateFixer($rel_x);
                $kid = Formulas::xy2kid($rel_x, $rel_y);
                $this->map[$kid]['fieldtype'] = $this->map[$kid]['oasistype'] = $this->map[$kid]['landscape'] = 0;
                $isOut = $this->isOutOfRange(3, $imgId, $dst_x, $dst_y);
                $isNear = $this->isNearRange(3, $imgId, $dst_x, $dst_y);
                if ($isOut && $isNear) {
                    $isOut = mt_rand(1, 10) <= 4;
                }
                $this->setProperties($kid, $isOut, $dst_x, $dst_y, '2_' . $imgId);
                if (!$isOut) {
                    $this->getOasesType($kid, 2);
                } else {
                    $this->getFieldType($kid, $this->map[$kid]['fieldtype']);
                }
                $rel_x++;
                $dst_x++;
                ++$j;
            }
            $rel_x = $find['x'];
            $dst_x = 0;
            $rel_y--;
            $dst_y++;
            ++$i;
        }
    }

    private function createHill()
    {
        $r = mt_rand(1, 35);
        if ($r <= 5) {
            $imgId = 0;
        } else if ($r <= 9) {
            $imgId = 1;
        } else if ($r <= 16) {
            $imgId = 2;
        } else if ($r <= 24) {
            $imgId = 3;
        } else if ($r <= 27) {
            $imgId = 4;
        } else if ($r <= 30) {
            $imgId = 5;
        } else if ($r <= 33) {
            $imgId = 6;
        } else {
            $imgId = 7;
        }
        $img = imagecreatefrompng(PUBLIC_PATH . "img/map/hill/60x60/hill{$imgId}.png");
        $needle = ["x" => imagesx($img) / 60, "y" => imagesy($img) / 60];
        $find = $this->findFree($needle['x'], $needle['y']);
        if (!is_array($find)) {
            return FALSE;
        }
        $rel_x = $find['x'];
        $rel_y = $find['y'];
        $dst_x = $dst_y = 0;
        $i = 1;
        while ($i <= $needle['y']) {
            $j = 1;
            $rel_y = Formulas::coordinateFixer($rel_y);
            while ($j <= $needle['x']) {
                $rel_x = Formulas::coordinateFixer($rel_x);
                $kid = Formulas::xy2kid($rel_x, $rel_y);
                $this->map[$kid]['fieldtype'] = $this->map[$kid]['oasistype'] = $this->map[$kid]['landscape'] = 0;
                $isOut = $this->isOutOfRange(4, $imgId, $dst_x, $dst_y);
                $isNear = $this->isNearRange(4, $imgId, $dst_x, $dst_y);
                if ($isOut && $isNear) {//near areas need fix later ;)
                    $isOut = mt_rand(1, 10) === 2;
                }
                $this->setProperties($kid, $isOut, $dst_x, $dst_y, '3_' . $imgId);
                if (!$isOut) {
                    $this->getOasesType($kid, 3);
                } else {
                    $this->getFieldType($kid, $this->map[$kid]['fieldtype']);
                }
                $rel_x++;
                $dst_x++;
                ++$j;
            }
            $rel_x = $find['x'];
            $dst_x = 0;
            $rel_y--;
            $dst_y++;
            ++$i;
        }
    }

    /**
     * @return bool
     */
    private function createLake()
    {
        $r = mt_rand(1, 38);
        if ($r <= 6) {
            $imgId = 0;
        } else if ($r <= 12) {
            $imgId = 6;
        } else if ($r <= 16) {
            $imgId = 1;
        } else if ($r <= 19) {
            $imgId = 2;
        } else if ($r <= 23) {
            $imgId = 3;
        } else if ($r <= 26) {
            $imgId = 4;
        } else if ($r <= 27) {
            $imgId = 5;
        } else if ($r <= 30) {
            $imgId = 6;
        } else if ($r <= 32) {
            $imgId = 7;
        } else {
            $imgId = 1;
        }
        $img = imagecreatefrompng(PUBLIC_PATH . "img/map/lake/60x60/lake{$imgId}.png");
        $needle = ["x" => imagesx($img) / 60, "y" => imagesy($img) / 60];
        $find = $this->findFree($needle['x'], $needle['y']);
        if (!is_array($find)) {
            return FALSE;
        }
        $rel_x = $find['x'];
        $rel_y = $find['y'];
        $dst_x = $dst_y = 0;
        $i = 1;
        while ($i <= $needle['y']) {
            $j = 1;
            $rel_y = Formulas::coordinateFixer($rel_y);
            while ($j <= $needle['x']) {
                $rel_x = Formulas::coordinateFixer($rel_x);
                $kid = Formulas::xy2kid($rel_x, $rel_y);
                $this->map[$kid]['fieldtype'] = $this->map[$kid]['oasistype'] = $this->map[$kid]['landscape'] = 0;
                $isOut = $this->isOutOfRange(5, $imgId, $dst_x, $dst_y);
                $isNear = $this->isNearRange(5, $imgId, $dst_x, $dst_y);
                if ($isOut && $isNear) {
                    $isOut = mt_rand(1, 10) <= 4;
                }
                $this->setProperties($kid, $isOut, $dst_x, $dst_y, '4_' . $imgId);
                if (!$isOut) {
                    $this->getOasesType($kid, 4);
                } else {
                    $this->getFieldType($kid, $this->map[$kid]['fieldtype']);
                }
                $rel_x++;
                $dst_x++;
                ++$j;
            }
            $rel_x = $find['x'];
            $dst_x = 0;
            $rel_y--;
            $dst_y++;
            ++$i;
        }
    }

    public function finalize($password)
    {
        $db = DB::getInstance();
        $register = new RegisterModel();
        $register->addUser("Support", sha1($password), '', 0, 0, TRUE, false, true);
        $random_multihunter_password = substr(sha1(get_random_string(12)), 0, 12);
        $natar_kid = Formulas::xy2kid(0, 0);

        $natars = $register->addUser(T("Global", "NatarsName"),
            sha1(time() . get_random_string(5)),
            '',
            5,
            $natar_kid,
            1,
            false,
            TRUE);
        $db->query("UPDATE users SET protection=0, kid=$natar_kid, desc1='[#natars]' WHERE id=$natars");

        $multihunter = $register->addUser("Multihunter",
            sha1($random_multihunter_password),
            '',
            1,
            Formulas::xy2kid(1, 0),
            0,
            false,
            true);

        $db->query("UPDATE users SET kid=" . Formulas::xy2kid(1,
                0) . ", protection=" . time() . " WHERE id=$multihunter");
        $db->query("UPDATE users SET id=0 WHERE id=1");
        $db->query("UPDATE users SET id=1 WHERE id=2");
        $db->query("UPDATE users SET id=2 WHERE id=3");

        $register->addHero(1, Formulas::xy2kid(0, 0));
        $register->addHeroFace(1);
        $register->addHeroInventory(1);

        $register->addHero(2, Formulas::xy2kid(1, 0));
        $register->addHeroFace(2);
        $register->addHeroInventory(2);
        $db->query("DELETE FROM infobox WHERE uid <= 2");
        //natars
        $register->createNatarsBaseVillage($natar_kid);
        $WonderOfTheWorld = new \Model\WonderOfTheWorldModel();
        $WonderOfTheWorld->createWWVillages();
        //multihunter
        $register->createBaseVillage(2, "Multihunter", 1, Formulas::xy2kid(1, 0));
        $db->query("UPDATE config SET installed=1, installationTime=" . time());
        /*
        $newsletter_subject = sprintf(T("Global", "Newsletter_NewServer_subject"), Config::getProperty("settings", "serverName"), getGameSpeed());
        $newsletter_message = T("Global", "Newsletter_NewServer_content");
        $order = ['[REGISTRATION_URL]', '[INDEX_URL]'];
        $order_values = [
            'http://' . WebService::getJustDomain() . '/index.php?server=' . getWorldId() . "#register",
            'http://' . WebService::getJustDomain() . '/',
        ];
        $newsletter_message = str_replace($order, $order_values, $newsletter_message);
        $dev_array = [
            'test', 'dev', 'devel', 'developer', 'testing', 'tester'
        ];
        if (in_array(Config::getProperty("settings", "worldId"), $dev_array)) {
            Mailer::sendAdminReport($newsletter_subject, $newsletter_message);
            return;
        }
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM newsletter");
        $emails = [];
        $x = 0;
        while ($row = $result->fetch_assoc()) {
            ++$x;
            $emails[] = $row['email'];
            if ($x % 200) {
                Mailer::sendBatch($emails, $newsletter_subject, $newsletter_message);
                $emails = [];
            }
        }
        if (sizeof($emails)) {
            Mailer::sendBatch($emails, $newsletter_subject, $newsletter_message);
            $emails = [];
        }*/
    }
}
