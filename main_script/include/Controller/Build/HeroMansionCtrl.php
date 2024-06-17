<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Core\Config;
use Core\Caching\Caching;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Core\Locale;
use Game\Helpers\LoyaltyHelper;
use Model\OasesModel;
use resources\View\PHPBatchView;

class HeroMansionCtrl extends AnyCtrl
{
    private $oases      = [];
    private $abandoning = [];

    public function __construct()
    {
        parent::__construct();

        $this->view = new PHPBatchView("build/HeroMansion");
        $this->view->vars = [
            "abandon"      => ["size" => 0, "html" => ""],
            "nextOases"    => "",
            "inReachOasis" => "",
            "OwnOasis"     => "",
        ];
        $db = DB::getInstance();
        $oases = $db->query("SELECT kid, type, loyalty, last_loyalty_update, conquered_time FROM odata WHERE did=" . Village::getInstance()->getKid());
        $this->getNextOasis($oases->num_rows);
        $abandoning = $db->query("SELECT * FROM odelete WHERE kid=" . Village::getInstance()->getKid());
        if ($abandoning->num_rows) {
            while ($row = $abandoning->fetch_assoc()) {
                $this->abandoning[$row['oid']] = $row;
            }
        } else {
            $this->abandoning = [];
        }
        if (isset($_GET['del']) && $_GET['c'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $isMine = $db->fetchScalar("SELECT COUNT(kid) FROM odata WHERE did=" . Village::getInstance()->getKid() . " AND kid=" . (int)$_GET['del']) > 0;
            if ($isMine && !$this->isInDeletion($_GET['del'])) {
                $duration = max(6 * 3600 / getGameSpeed(), 600);
                $db->query("INSERT INTO odelete (`kid`, `oid`, `end_time`) VALUES (" . Village::getInstance()->getKid() . "," . (int)$_GET['del'] . "," . (time() + $duration) . ")");
                $this->abandoning[(int)$_GET['del']] = [
                    "id"       => $db->lastInsertId(),
                    "kid"      => Village::getInstance()->getKid(),
                    "oid"      => (int)$_GET['del'],
                    "end_time" => time() + $duration,
                ];
            }
        }
        if (isset($_GET['cancel']) && $_GET['c'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $db->query("DELETE FROM odelete WHERE kid=" . Village::getInstance()->getKid() . " AND id=" . (int)$_GET['cancel']);
            if ($db->affectedRows()) {
                foreach ($this->abandoning as $key => $row) {
                    if ($row['id'] == (int)$_GET['cancel']) {
                        unset($this->abandoning[$key]);
                        break;
                    }
                }
            }
        }

        $this->getOwnOasisTable($oases);
        $this->getNearDistanceOasis();
        $this->getAbandonOasisTable();
    }

    private function getNextOasis($capturedOasis)
    {
        if ($capturedOasis < 1) {
            $this->view->vars['nextOases'] .= '<div class="nextOases none">1. ' . T("HeroMansion",
                    "nextOasisInHeroMansionLevel") . ' 10</div>';
        }
        if ($capturedOasis < 2) {
            $this->view->vars['nextOases'] .= '<div class="nextOases none">2. ' . T("HeroMansion",
                    "nextOasisInHeroMansionLevel") . ' 15</div>';
        }
        if ($capturedOasis < 3) {
            $this->view->vars['nextOases'] .= '<div class="nextOases none">3. ' . T("HeroMansion",
                    "nextOasisInHeroMansionLevel") . ' 20</div>';
        }
    }

    private function isInDeletion($kid)
    {
        return isset($this->abandoning[$kid]);
    }

    private function getOwnOasisTable(\mysqli_result $oases)
    {
        $village = Village::getInstance();
        $points = max($village->specialBuildingsLvl['Palace'] + $village->specialBuildingsLvl['Residence'], 0);
        if ($oases->num_rows) {
            $direction = strtolower(getDirection());
            while ($oasis = $oases->fetch_assoc()) {
                $oasis['loyalty'] = min(100,
                    $oasis['loyalty'] + $points * ((time() - $oasis['last_loyalty_update']) / 3600));
                $this->oases[] = $oasis['kid'];
                $xy = Formulas::kid2xy($oasis['kid']);
                $this->view->vars['OwnOasis'] .= '<tr>';
                $this->view->vars['OwnOasis'] .= '<td class="type">';
                if (!$this->isInDeletion($oasis['kid'])) {
                    $this->view->vars['OwnOasis'] .= '<a href="build.php?gid=37&amp;c=' . (Session::getInstance()->getChecker()) . '&amp;del=' . $oasis['kid'] . '"><img class="del" src="img/x.gif" alt="' . T("HeroMansion", "del") . '" title="' . T("HeroMansion", "del") . '"></a>';
                }
                $this->view->vars['OwnOasis'] .= '<a href="karte.php?d=' . $oasis['kid'] . '">' . $this->getOasisNameByType($oasis['type']) . '</a></td>';
                $this->view->vars['OwnOasis'] .= '<td class="loy">' . round($oasis['loyalty']) . '%</td>';
                $this->view->vars['OwnOasis'] .= '<td class="nam">' . TimezoneHelper::autoDate($oasis['conquered_time']) . '</td>';
                $this->view->vars['OwnOasis'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '"><span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span></a></td>';
                $this->view->vars['OwnOasis'] .= '<td class="res">' . $this->getOasisResources($oasis['type']) . '</td>';
                $this->view->vars['OwnOasis'] .= '</tr>';
            }
        }
        if (empty($this->view->vars['OwnOasis'])) {
            $this->view->vars['OwnOasis'] = '<td class="noData" colspan="5">' . T("HeroMansion", "noSlot") . '</td>';
        }
    }

    private function getOasisNameByType($type)
    {
        if ($type <= 4) {
            return T("HeroMansion", "Forest");
        } else if ($type <= 8) {
            return T("HeroMansion", "Clay");
        } else if ($type <= 12) {
            return T("HeroMansion", "Hill");
        }
        return T("HeroMansion", "Lake");
    }

    private function getOasisResources($oasisType)
    {
        $return = '<div class="inlineIconList resourceWrapper"><div class="inlineIcon resources">';
        foreach (Formulas::getOasisEffect($oasisType) as $k => $v) {
            if (!$v) {
                continue;
            }
            $return .= '<div class="inlineIcon resources"><i class="r'.$k.'"></i><span class="value ">&#8237;&#8237;'.($v * 25).'&#8236;%&#8236;</span></div>';
        }
        $return .= '</div></div>';
        return $return;
    }

    private function getNearDistanceOasis()
    {
        $nearDistanceOasis = $this->getNearDistanceOasisIds(Village::getInstance()->getKid());
        if (!sizeof($nearDistanceOasis)) {
            $this->view->vars['inReachOasis'] .= '<tr><td colspan="5"></td></tr>';
            return;
        }
        $direction = strtolower(getDirection());
        $db = DB::getInstance();
        $oasisData = $db->query("SELECT id, oasistype, occupied FROM wdata WHERE id IN(" . implode(",",
                $nearDistanceOasis) . ")");
        while ($oasis = $oasisData->fetch_assoc()) {
            $xy = Formulas::kid2xy($oasis['id']);
            $this->view->vars['inReachOasis'] .= '<tr>';
            $this->view->vars['inReachOasis'] .= '<td class="type"><a href="karte.php?d=' . $oasis['id'] . '">' . $this->getOasisNameByType($oasis['oasistype']) . '</a></td>';
            $this->view->vars['inReachOasis'] .= '<td class="nam">' . $this->getPlayerName($oasis['id']) . '</td>';
            $this->view->vars['inReachOasis'] .= '<td class="vil">' . $this->getVillageName($oasis['id']) . '</td>';
            $this->view->vars['inReachOasis'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '"><span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span></a></td>';
            $this->view->vars['inReachOasis'] .= '<td class="res">' . $this->getOasisResources($oasis['oasistype']) . '</td>';
            $this->view->vars['inReachOasis'] .= '</tr>';
        }
    }

    private function getNearDistanceOasisIds($kid)
    {
        $cache = Caching::getInstance();
        if ($data = $cache->get('getNearDistanceOasisIds' . $kid)) {
            return $data;
        }
        $cache->add('getNearDistanceOasisIds' . $kid,
            $kids = $this->getNearByFieldOasisPercent($kid, 4.9497474683058326708059105347339),
            3600);
        return $kids;
    }

    function getNearByFieldOasisPercent($kid, $distance)
    {
        $xy = Formulas::kid2xy($kid);
        $ruler_x = $ruler_y = 7;
        $coordinates = [];
        $i = $xy['y'] + floor($ruler_y / 2);
        $oasisModel = new OasesModel();
        while ($i >= $xy['y'] - floor($ruler_y / 2)) {
            $current_y = Formulas::coordinateFixer($i);
            $j = $xy['x'] - floor($ruler_x / 2);
            while ($j <= $xy['x'] + floor($ruler_x / 2)) {
                $current_x = Formulas::coordinateFixer($j);
                if (Formulas::getDistance(['x' => $current_x, 'y' => $current_y,], $xy) <= $distance) {
                    $current_kid = Formulas::xy2kid($current_x, $current_y);
                    if ($oasisModel->isOasis($current_kid)) {
                        $coordinates[] = $current_kid;
                    }
                }
                $j++;
            }
            --$i;
        }
        return $coordinates;
    }

    private function getPlayerName($oasisId, $o = FALSE)
    {
        $db = DB::getInstance();
        if ($o) {
            $owner = $o;
        } else {
            $owner = $db->fetchScalar("SELECT owner FROM odata WHERE kid=$oasisId");
        }
        if (!$owner) {
            return '-';
        }
        if ($o) {
            $name = $o;
        } else {
            $name = $db->fetchScalar("SELECT name FROM users WHERE id=$owner");
            if (!$name) {
                $name = '-';
            }
        }
        return '<a href="spieler.php?uid=' . $owner . '">' . $name . '</a>';
    }

    private function getVillageName($oasisId, $o = FALSE)
    {
        $db = DB::getInstance();
        if ($o) {
            $conquered = $oasisId;
        } else {
            $conquered = $db->fetchScalar("SELECT did FROM odata WHERE kid=$oasisId");
        }
        if (!$conquered) {
            return '-';
        }
        if ($o) {
            $name = $o;
        } else {
            $name = $db->fetchScalar("SELECT name FROM vdata WHERE kid=$conquered");
        }
        return '<a href="karte.php?d=' . $conquered . '">' . $name . '</a>';
    }

    private function getAbandonOasisTable()
    {
        $direction = strtolower(getDirection());
        $this->view->vars['abandon']['size'] = sizeof($this->abandoning);
        $db = DB::getInstance();
        foreach ($this->abandoning as $row) {
            $url = 'build.php?gid=37&amp;c=' . (Session::getInstance()->getChecker()) . '&amp;cancel=' . $row['id'];
            $xy = Formulas::kid2xy($row['oid']);
            $this->view->vars['abandon']['html'] .= '<tr>';
            $this->view->vars['abandon']['html'] .= '<td class="type">';
            $this->view->vars['abandon']['html'] .= '<a href="'.$url.'"><img class="del" src="img/x.gif"></a>';
            $this->view->vars['abandon']['html'] .= '<a href="karte.php?d=' . $row['oid'] . '">' . $this->getOasisNameByType($db->fetchScalar("SELECT type FROM odata WHERE kid={$row['oid']}")) . '</a></td>';
            $this->view->vars['abandon']['html'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(‭' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭‭' . $xy['y'] . '‬‬)</span></span></a></td>';
            $this->view->vars['abandon']['html'] .= '<td class="res">' . appendTimer($row['end_time'] - time()) . '</td>';
            $this->view->vars['abandon']['html'] .= '<td class="res">' . TimezoneHelper::date("H:i",
                    $row['end_time']) . '</td>';
            $this->view->vars['abandon']['html'] .= '</tr>';
        }
    }
} 