<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Model\ArtefactsModel;
use Model\BerichteModel;
use Model\KarteModel;
use Model\WonderOfTheWorldModel;

class mapPositionData extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid()) {
            return;
        }
        if (!isset($_POST['data']) || !isset($_POST['data']['zoomLevel']) || !isset($_POST['data']['x']) || !isset($_POST['data']['y'])) {
            return;
        }
        $data = $_POST['data'];
        $zoomLevel = isset($data['zoomLevel']) && $data['zoomLevel'] <= 3 && $data['zoomLevel'] >= 1 ? $data['zoomLevel'] : 1;
        $areaAroundPosition = [
            1 => [
                'left' => -5,
                'top' => -4,
                'right' => 5,
                'bottom' => 4,
            ],
            2 => [
                'left' => -10,
                'top' => -8,
                'right' => 10,
                'bottom' => 8,
            ],
            3 => [
                'left' => -15,
                'top' => -15,
                'right' => 15,
                'bottom' => 15,
            ],
        ];
        $x1 = $data['x'] + $areaAroundPosition[$zoomLevel]['top'];
        $x2 = $data['x'] + $areaAroundPosition[$zoomLevel]['bottom'];
        $y1 = $data['y'] + $areaAroundPosition[$zoomLevel]['left'];
        $y2 = $data['y'] + $areaAroundPosition[$zoomLevel]['right'];
        if ($x1 < -MAP_SIZE) {
            $x1 = -MAP_SIZE;
        }
        if ($x2 > MAP_SIZE) {
            $x2 = MAP_SIZE;
        }
        if ($y1 < -MAP_SIZE) {
            $y1 = -MAP_SIZE;
        }
        if ($y2 > MAP_SIZE) {
            $y2 = MAP_SIZE;
        }
        $db = DB::getInstance();
        $m = new KarteModel();
        $return = $db->query("SELECT * FROM `wdata` WHERE (x BETWEEN '" . $x1 . "' AND '" . $x2 . "') AND (y BETWEEN '" . $y1 . "' AND '" . $y2 . "') ORDER BY id ASC");
        $cap_kid = Formulas::xy2kid(0, 0);
        $wwPlansReleased = ArtefactsModel::wwPlansReleased();
        while ($row = $return->fetch_assoc()) {
            if ($row['id'] == $cap_kid && !$wwPlansReleased) {
                $row['occupied'] = FALSE;
            }
            $tile =& $this->response['data']['tiles'][];
            $tile['position']['x'] = $row['x'];
            $tile['position']['y'] = $row['y'];
            if ($row['fieldtype'] && !$row['occupied']) {
                $tile['title'] = '{k.vt} {k.f' . $row['fieldtype'] . '}';
                $tile['text'] = '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;‬‎';
            } else if ($row['fieldtype'] && $row['occupied']) {
                $tile['uid'] = $m->getVillageOwner($row['id']);
                if ($alliance = $m->getPlayerAllianceId($tile['uid'])) {
                    $tile['aid'] = $alliance;
                }
                $tile['did'] = $row['id'];
                $tile['title'] = '{k.dt} ' . $m->getVillageName($row['id']);
                $report = $this->getReport($row['id']);
                $allianceTag = $alliance ? $m->getAllianceTag($alliance) : '';
                $tile['text'] = '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>{k.spieler} ' . $m->getPlayerName($tile['uid']) . '<br>{k.einwohner} ' . $m->getVillagePop($row['id']) . '<br>{k.allianz} ' . $allianceTag . '<br>{k.volk} {a.v' . $m->getPlayerTribe($tile['uid']) . '}' . $report;
            } else if ($row['oasistype']) {
                $tile['did'] = $row['id'];
                if ($row['occupied']) {
                    $tile['title'] = '{k.fo}';
                } else {
                    $tile['title'] = '{k.bt}';
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
                $report = $this->getReport($row['id']);
                if (!$row['occupied']) {
                    $tile['text'] = '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>' . $oasisEffect . $report;
                } else {
                    $owner = $m->getOasisOwner($row['id']);
                    $allianceTag = '';
                    if ($alliance = $m->getPlayerAllianceId($owner)) {
                        $allianceTag = $alliance ? $m->getAllianceTag($alliance) : '';
                    }
                    $tile['text'] = '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;<br>' . $oasisEffect . '<br>{k.spieler} ' . $m->getPlayerName($owner) . '<br>{k.allianz} ' . $allianceTag . '<br>{k.volk} {a.v' . $m->getPlayerTribe($owner) . '}' . $report;
                }
            } else if ($row['landscape']) {
                $tile['did'] = NULL;
                $tile['text'] = '&#x202d;<span class="coordinates coordinatesWrapper"><span class="coordinateX">(&#x202d;&#x202d;' . $row['x'] . '&#x202c;&#x202c;</span><span class="coordinatePipe">|</span><span class="coordinateY">&#x202d;&#x202d;' . $row['y'] . '&#x202c;&#x202c;)</span></span>&#x202d;';
            }
        }
        $return->free();
    }

    public function getReport($kid)
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
            $report .= '<br>{b:bi' . $class . '} ' . number_format_x($totalBounty) . '/' . number_format_x($bounty[4]);
        }
        return $report;
    }
}