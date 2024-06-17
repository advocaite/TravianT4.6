<?php

namespace Game\Map;

use Core\Caching\Caching;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Model\BerichteModel;
use Model\KarteModel;

class MapLowRes
{
    public static function render($x, $y, $ruler_x, $ruler_y)
    {
        $key = "lowRes_{$x}_{$y}_{$ruler_x}_{$ruler_y}";
        $cache = Caching::getInstance();
        if ($_cache = $cache->get($key)) {
            return ['isCache' => TRUE, 'HTML' => $_cache];
        }
        $rulers = ['x' => [], 'y' => []];
        $HTML = '';
        $i = $y + floor($ruler_y / 2) + ($ruler_y > 7 ? -1 : 0);
        while ($i >= $y - floor($ruler_y / 2)) {
            $rulers['y'][] = Formulas::coordinateFixer($i);
            $j = $x - floor($ruler_x / 2);
            $HTML .= '<div class="tileRow">';
            $c = 0;
            while ($j <= $x + floor($ruler_x / 2)) {
                $rulers['x'][] = Formulas::coordinateFixer($j);
                $HTML .= self::getTile(Formulas::coordinateFixer($j), Formulas::coordinateFixer($i), $c);
                $j++;
                $c++;
            }
            $HTML .= '<div class="clear"></div></div>';
            --$i;
        }
        //rendering rulers.
        $HTML .= '<div class="ruler x">';
        $HTML .= '<div class="rulerContainer">';
        foreach ($rulers['x'] as $x) {
            $HTML .= '<div class="coordinate zoom1">' . $x . '</div>';
        }
        $HTML .= '<div class="clear"></div>';
        $HTML .= '</div>';
        $HTML .= '</div>';
        $HTML .= '<div class="ruler y">';
        $HTML .= '<div class="rulerContainer">';
        foreach ($rulers['y'] as $y) {
            $HTML .= '<div class="coordinate zoom1">' . $y . '</div>';
        }
        $HTML .= '<div class="clear"></div>';
        $HTML .= '</div>';
        $HTML .= '</div>';
        $cache->set($key, $HTML, 1800);
        return ['isCache' => FALSE, 'HTML' => $HTML];
    }

    private static function getTile($x, $y, $c)
    {
        $kid = Formulas::xy2kid($x, $y);
        $class = [Formulas::isGrayArea($kid) ? 'ash' : 'grassland'];
        $db = DB::getInstance();
        $current = $db->query("SELECT * FROM wdata WHERE id=$kid LIMIT 1")->fetch_assoc();
        $m = new KarteModel();
        if ($x == $y && $x == 0) {
            $current['occupied'] = 0;
        }
        if ($current['fieldtype'] && $current['occupied']) {
            array_push($class, 'village', 'village' . $m->getPlayerTribe($m->getVillageOwner($kid)));
        } else if ($current['oasistype']) {
            $oasis = [
                2 => 'forest',
                3 => 'forest',
                4 => 'forest',
                6 => 'clay',
                7 => 'clay',
                8 => 'clay',
                10 => 'hill',
                11 => 'hill',
                12 => 'hill',
            ];
            $oasis = isset($oasis[$current['oasistype']]) ? $oasis[$current['oasistype']] : 'lake';
            array_push($class,
                $oasis,
                'oasis',
                'oasis' . $current['oasistype'],
                !$current['occupied'] ? 'free' : 'occupied');
        } else if ($current['landscape']) {
            if ($current['landscape'] < 5) {
                array_push($class,
                    [
                        1 => 'forest',
                        'clay',
                        'hill',
                        'lake',
                        'vulcano',
                    ][$current['landscape']]);
            }
        }
        return '<div class="tile tile-' . $c . ' x{' . $x . '} y{' . $y . '} ' . implode("-",
                $class) . '" title="' . self::getTitle($current) . '"></div>';
    }

    private static function getTitle($row)
    {
        $cap_kid = Formulas::xy2kid(0, 0);
        if ($row['id'] == $cap_kid) {
            $row['occupied'] = FALSE;
        }
        $title = '';
        $m = new KarteModel();
        if ($row['fieldtype'] && !$row['occupied']) {
            $title .= '{k.vt} {k.f' . $row['fieldtype'] . '}||';
            $title .= '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;‬‎';
        } else if ($row['fieldtype'] && $row['occupied']) {
            $tile['u'] = $m->getVillageOwner($row['id']);
            if ($alliance = $m->getPlayerAllianceId($tile['u'])) {
                $tile['a'] = $alliance;
            }
            $title .= '{k.dt} ' . $m->getVillageName($row['id']) . '||';
            $report = self::getReport($row['id']);
            $allianceTag = $alliance ? $m->getAllianceTag($alliance) : '';
            $title .= '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>{k.spieler} ' . $m->getPlayerName($tile['u']) . '<br>{k.einwohner} ' . $m->getVillagePop($row['id']) . '<br>{k.allianz} ' . $allianceTag . '<br>{k.volk} {a.v' . $m->getPlayerTribe($tile['u']) . '}' . $report;
        } else if ($row['oasistype']) {
            $tile['d'] = $row['id'];
            if ($row['occupied']) {
                $title .= '{k.fo}||';
            } else {
                $title .= '{k.bt}||';
            }
            $oasisEffect = '';
            $eff = Formulas::getOasisEffect($row['oasistype']);
            foreach ($eff as $k => $v) {
                if (!$v) {
                    continue;
                }
                if (!empty($oasisEffect)) {
                    $oasisEffect .= '<br>';
                }
                $oasisEffect .= '{a:r' . $k . '}' . ' {a.r' . $k . '} ' . ($v * 25) . '%';
            }
            $report = self::getReport($row['id']);
            if (!$row['occupied']) {
                $title .= '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>' . $oasisEffect . $report;
            } else {
                $owner = $m->getOasisOwner($row['id']);
                $allianceTag = '';
                if ($alliance = $m->getPlayerAllianceId($owner)) {
                    $allianceTag = $alliance ? $m->getAllianceTag($alliance) : '';
                }
                $title .= '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>' . $oasisEffect . '<br>{k.spieler} ' . $m->getPlayerName($owner) . '<br>{k.allianz} ' . $allianceTag . '<br>{k.volk} {a.v' . $m->getPlayerTribe($owner) . '}' . $report;
            }
        } else if ($row['landscape']) {
            $tile['c'] = NULL;
            $title .= '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;';
        }

        return htmlspecialchars($title);
    }

    private static function getReport($kid)
    {
        $m = new BerichteModel();
        $notice = $m->getJustOnReportForPositionData($kid, Session::getInstance()->getPlayerId());
        if (!is_array($notice)) {
            return NULL;
        }
        $report = '<br>{b:ri' . $notice['type'] . '} ' . TimezoneHelper::autoDateString($notice['time'],
                TRUE) . ' {b.ri' . $notice['type'] . '}';
        $bounty = explode(',', $notice['bounty']);
        if (isset($bounty[4]) && $bounty[4]) {
            $totalBounty = array_sum($bounty) - $bounty[4];
            if ($totalBounty == 0) {
                $class = 0;
            } else if ($totalBounty == $bounty[4]) {
                $class = 2;
            } else {
                $class = 1;
            }
            $report .= '<br>{b:bi' . $class . '} ' . $totalBounty . '/' . $bounty[4];
        }

        return $report;
    }
} 