<?php

namespace Controller\RallyPoint;

use Core\Session;
use Core\Village;
use Game\Formulas;
use Core\Locale;
use Game\NoticeHelper;
use function getDisplay;
use Model\BerichteModel;
use Model\RallyPoint\RallyPointModel;
use function number_format_x;
use resources\View\PHPBatchView;

class combat
{
    private $output    = [];
    private $maxLength = 16; //6

    public function __construct()
    {

        $session = Session::getInstance();
        $this->output = [];
        $this->output['submitButton'] = getButton([
            "class" => "green ",
            "type"  => "submit",
            "value" => T("combat", "simulate"),
        ],
            ["data" => ["type" => "submit", "value" => T("combat", "simulate"),],],
            T("combat", "simulate"));
        $this->output['uid'] = $session->getPlayerId();
        $this->output['attack_type'] = 3;
        $this->output['attacker'] = [
            "unitsHTML"             => '',
            'race'                  => $session->getRace(),
            'units'                 => array_fill(0, 10, ["number" => 0, "level" => 0,]),
            'pop'                   => 1,
            'catapult_target_level' => 0,
            "h_off_bonus"           => 0,
            "h_power"               => 0,
        ];
        if (isset($_POST['a1_v']) && $_POST['a1_v'] > 0 && in_array($_POST['a1_v'], [1, 2, 3, 4, 6, 7])) {
            $this->output['attacker']['race'] = (int)$_POST['a1_v'];
        }
        $this->output['attacker']['hero'] = isset($_POST['hero']) && $_POST['hero'] >= 1;
        for ($i = 1; $i <= 10; ++$i) {
            $this->output['attacker']['units'][$i - 1]['number'] = isset($_POST['a1_' . $i]) ? (int)$_POST['a1_' . $i] : 0;
            $this->output['attacker']['units'][$i - 1]['level'] = isset($_POST['f1_' . $i]) ? (int)$_POST['f1_' . $i] : 0;
            $this->output['attacker']['unitsHTML'] .= $this->getUnit(TRUE,
                $i,
                $this->output['attacker']['race'],
                $this->output['attacker']['units'][$i - 1]['number'],
                $this->output['attacker']['units'][$i - 1]['level']);
        }
        $this->output['defender'] = ["pop" => 1, 'races' => []];
        if (isset($_POST['a2_v1'])) {
            $this->output['defender']['races'][1] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }
        if (isset($_POST['a2_v2'])) {
            $this->output['defender']['races'][2] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }
        if (isset($_POST['a2_v3'])) {
            $this->output['defender']['races'][3] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }
        if (isset($_POST['a2_v4'])) {
            $this->output['defender']['races'][4] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }
        if (isset($_POST['a2_v6'])) {
            $this->output['defender']['races'][6] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }
        if (isset($_POST['a2_v7'])) {
            $this->output['defender']['races'][7] = [
                "unitsHTML" => "",
                "units"     => array_fill(0, 10, ["level" => 0, "number" => 0,]),
            ];
        }


        if (isset($_GET['bid']) && Session::getInstance()->hasPlus()) {
            $reportId = (int)$_GET['bid'];
            $rpt = new BerichteModel();
            $report = $rpt->getReport($reportId);
            if ($report['uid'] == Session::getInstance()->getPlayerId()) {
                switch ($report['type']) {
                    case NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES:
                    case NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES:
                    case NoticeHelper::TYPE_LOST_AS_ATTACKER:
                    case NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES:
                    case NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES:
                    case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES:
                    case NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES:
                    case NoticeHelper::TYPE_WON_SPY_WITHOUT_CASUALTIES:
                    case NoticeHelper::TYPE_WON_SPY_WITH_CASUALTIES:
                    case NoticeHelper::TYPE_LOST_AS_SPY:
                    case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_REFUSED_ATTACKER_SPY:
                    case NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY:
                        $data = NoticeHelper::parseReport($report['type'], $report['data']);
                        $_POST['a1_v'] = $this->output['attacker']['race'] = $data['attacker']['race'];
                        $attacker_troops = $data['attacker']['num'];
                        $this->output['attacker']['unitsHTML'] = null;
                        for ($i = 1; $i <= 10; ++$i) {
                            if (isset($data['attacker']['smithy'][$i])) {
                                $this->output['attacker']['units'][$i - 1]['level'] = $data['attacker']['smithy'][$i];
                            }
                            $this->output['attacker']['units'][$i - 1]['number'] = $attacker_troops[$i];
                            $this->output['attacker']['unitsHTML'] .= $this->getUnit(TRUE,
                                $i,
                                $this->output['attacker']['race'],
                                $this->output['attacker']['units'][$i - 1]['number'],
                                $this->output['attacker']['units'][$i - 1]['level']);
                        }
                        foreach ($data['defender'] as $row) {
                            $_POST['a2_v' . $row['race']] = 1;
                            if (!isset($this->output['defender']['races'][$row['race']])) {
                                $this->output['defender']['races'][$row['race']] = [
                                    "unitsHTML" => "",
                                    "units"     => array_fill(0,
                                        10,
                                        ["level" => 0, "number" => 0,]),
                                ];
                            }
                            for ($i = 1; $i <= 10; ++$i) {
                                $this->output['defender']['races'][$row['race']]['units'][$i - 1]['number'] = $row['num'][$i];
                            }
                        }
                        break;
                }
            }
        }
        if (!sizeof($this->output['defender']['races'])) {
            $this->output['defender']['races'][$session->getRace()] = [
                "unitsHTML" => "",
                "units"     => array_fill(0,
                    10,
                    ["level" => 0, "number" => 0,]),
            ];
        }

        ksort($this->output['defender']['races'], SORT_NUMERIC);
        $this->output['defender']['wall1'] = 0;
        $this->output['defender']['wall2'] = 0;
        $this->output['defender']['wall3'] = 0;
        $this->output['defender']['wall6'] = 0;
        $this->output['defender']['wall7'] = 0;
        $this->output['defender']['wallId'] = 0;
        $this->output['defender']['wallLevel'] = 0;
        $this->output['defender']['steinmetz'] = 0;
        $this->output['defender']['palast'] = 0;
        foreach ($this->output['defender']['races'] as $race => &$value) {
            if ($this->output['defender']['wallId'] === 0) {
                $this->output['defender']['wallId'] = $race + 30;
            }
            for ($i = 1; $i <= 10; ++$i) {
                if ($value['units'][$i - 1]['number'] == 0) {
                    $value['units'][$i - 1]['number'] = isset($_POST['a2_' . nrToUnitId($i,
                            $race)]) ? (int)$_POST['a2_' . nrToUnitId($i, $race)] : 0;
                }
                if ($race <> 4 && $i < 8) {
                    $value['units'][$i - 1]['level'] = isset($_POST['f2_' . nrToUnitId($i,
                            $race)]) ? (int)$_POST['f2_' . nrToUnitId($i, $race)] : 0;
                }
                $value['unitsHTML'] .= $this->getUnit(FALSE,
                    $i,
                    $race,
                    $value['units'][$i - 1]['number'],
                    $value['units'][$i - 1]['level']);
            }
        }
        if (isset($_POST['ew1']) && $_POST['ew1'] >= 0) {
            $this->output['attacker']['pop'] = (int)$_POST['ew1'];
        }
        if (isset($_POST['ew2']) && $_POST['ew2'] >= 0) {
            $this->output['defender']['pop'] = (int)$_POST['ew2'];
        }
        if (isset($_POST['palast']) && $_POST['palast'] >= 0) {
            $this->output['defender']['palast'] = min((int)$_POST['palast'], 20);
        }
        if (isset($_POST['wall1']) && $_POST['wall1'] > 0 && $this->output['defender']['wallLevel'] == 0) {
            $this->output['defender']['wallId'] = 31;
            $this->output['defender']['wallLevel'] = min((int)$_POST['wall1'], 20);
            $this->output['defender']['wall1'] = $this->output['defender']['wallLevel'];
        }
        if (isset($_POST['wall2']) && $_POST['wall2'] > 0 && $this->output['defender']['wallLevel'] == 0) {
            $this->output['defender']['wallId'] = 32;
            $this->output['defender']['wallLevel'] = min((int)$_POST['wall2'], 20);
            $this->output['defender']['wall2'] = $this->output['defender']['wallLevel'];
        }
        if (isset($_POST['wall3']) && $_POST['wall3'] > 0 && $this->output['defender']['wallLevel'] == 0) {
            $this->output['defender']['wallId'] = 33;
            $this->output['defender']['wallLevel'] = min((int)$_POST['wall3'], 20);
            $this->output['defender']['wall3'] = $this->output['defender']['wallLevel'];
        }
        if (isset($_POST['wall6']) && $_POST['wall6'] > 0 && $this->output['defender']['wallLevel'] == 0) {
            $this->output['defender']['wallId'] = 36;
            $this->output['defender']['wallLevel'] = min((int)$_POST['wall6'], 20);
            $this->output['defender']['wall6'] = $this->output['defender']['wallLevel'];
        }
        if (isset($_POST['wall7']) && $_POST['wall7'] > 0 && $this->output['defender']['wallLevel'] == 0) {
            $this->output['defender']['wallId'] = 37;
            $this->output['defender']['wallLevel'] = min((int)$_POST['wall7'], 20);
            $this->output['defender']['wall7'] = $this->output['defender']['wallLevel'];
        }
        if (isset($_POST['kata']) && $_POST['kata'] > 0) {
            $this->output['attacker']['catapult_target_level'] = (int)$_POST['kata'];
        }
        if (isset($_POST['h_off_bonus']) && $_POST['h_off_bonus'] > 0) {
            $this->output['attacker']['h_off_bonus'] = min((int)$_POST['h_off_bonus'], 20);
        }
        if (isset($_POST['h_power']) && $_POST['h_power'] > 0) {
            $this->output['attacker']['h_power'] = min((int)$_POST['h_power'], 10100);
        }
        if (isset($_POST['steinmetz']) && $_POST['steinmetz'] > 0) {
            $this->output['defender']['steinmetz'] = min((int)$_POST['steinmetz'], 20);
        }
        if (isset($_POST['ktyp']) && $_POST['ktyp'] >= 0 && $_POST['ktyp'] <= 2) {
            $this->output['attack_type'] = (int)$_POST['ktyp'] + 1;
        }
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $attack_type = $this->output['attack_type'];
            $sum = 0;
            for ($i = 1; $i <= 10; ++$i) {
                $sum += $this->output['attacker']['units'][$i - 1]['number'];
            }
            if (!$sum) {
                goto output;
            }
            $spyCount = $this->output['attacker']['units'][Formulas::getSpyId($this->output['attacker']['race']) - 1]['number'];
            if ($sum - $spyCount == 0) {
                $attack_type = 1;
            }
            if ($this->output['defender']['wallId'] > 0) {
                $race = $this->output['defender']['wallId'] - 30;
            } else {
                if (isset($this->output['defender']['races'][7])) $race = 7;
                if (isset($this->output['defender']['races'][6])) $race = 6;
                if (isset($this->output['defender']['races'][4])) $race = 4;
                if (isset($this->output['defender']['races'][3])) $race = 3;
                if (isset($this->output['defender']['races'][2])) $race = 2;
                if (isset($this->output['defender']['races'][1])) $race = 1;
            }
            $data = [
                "R"              => $this->output['attack_type'] == 3,
                "trapped2killed" => [],
                "defender"       => [
                    "r"         => $race - 1,
                    't'         => 0,
                    "p"         => $this->output['defender']['pop'], //pop
                    "rpLevel"   => $this->output['defender']['palast'], //residence palace level
                    "wLevel"    => $this->output['defender']['wallLevel'], //wall level
                    "stone"     => $this->output['defender']['steinmetz'], //wall level
                    "artifacts" => [
                        "durability" => 0, //Durability artifact effect ;)
                        "scout"      => 0, //scout artifact effect ;)
                    ],
                ],
                "waves"          => [],
            ];
            function add_xxxx_111($race, $row)
            {
                $battle = ["r" => $race - 1, "u" => [], "U" => [], "side" => "def"];
                foreach ($row['units'] as $k => $v) {
                    $battle['u'][] = $v['number'];
                    $battle['U'][] = $v['level'];
                }
                return $battle;
            }

            foreach ($this->output['defender']['races'] as $rab => $abc) {
                $data['waves'][] = add_xxxx_111($rab, $abc);
            }
            $battle = [
                "r"    => $this->output['attacker']['race'] - 1,
                "u"    => [],
                "U"    => [],
                "side" => 'off',
                "h"    => $attack_type <> 1,
            ];
            foreach ($this->output['attacker']['units'] as $k => &$v) {
                $battle['u'][] =& $v['number'];
                $battle['U'][] =& $v['level'];
            }
            $battle['p'] = $this->output['attacker']['pop'];
            $battle['b'] = [$this->output['attacker']['catapult_target_level'], 0,];
            $battle['hero'] = [
                "health"      => 100,
                "total_power" => $this->output['attacker']['hero'] ? $this->output['attacker']['h_power'] : 0,
                "offBonus"    => $this->output['attacker']['hero'] ? $this->output['attacker']['h_off_bonus'] * 5 : 0,
                "str"         => 0,
                "armor"       => 0,
                "bandage"     => ["num" => 0, "eff" => 0],
                "cages"       => 0,
            ];
            $battle['b'] = [$this->output['attacker']['catapult_target_level'], 0,];
            $data['waves'][] = $battle;
            $combat = new Simulator();
            $response = $combat->init($data);

            $this->output['response'] = $response;
            $this->output['response']['showState'] = isset($response[0]['info']['bl']) || isset($response[0]['info']['wall']);
            $this->output['response']['attack_type'] = $attack_type;
            $this->output['response']['attackerTable'] = $this->getAttackerTable();
            $this->output['response']['defenderTable'] = $this->getDefenderTable();
        }
        output:
        $this->output = PHPBatchView::render('combat/main', $this->output);
    }

    private function getUnit($isAttacker, $i, $tribe, $num, $level)
    {
        $num = $num == 0 ? '' : $num;
        $level = $level == 0 ? '' : $level;
        $research = '';
        if ($tribe <> 4 && $i <= 8) {
            $research = '<input class="text" type="text" name="f' . ($isAttacker ? 1 : 2) . '_' . ($isAttacker ? $i : nrToUnitId($i,
                    $tribe)) . '"
                                   value="' . $level . '" maxlength="2"
                                   title="' . T("combat", "unit_level") . ' ' . T("Troops",
                    nrToUnitId($i, $tribe) . '.title') . '" />';
        }
        $ico = '';
        if ($tribe <> 4) {
            $ico .= '<a href="#" onclick="return Travian.Game.iPopup(' . nrToUnitId($i, $tribe) . ',1);">';
        }
        $ico .= '<img src="img/x.gif" class="unit u' . nrToUnitId($i, $tribe) . '"
                                     alt="' . T("Troops", nrToUnitId($i, $tribe) . '.title') . '" title="' . T("Troops",
                nrToUnitId($i, $tribe) . '.title') . '" />';
        if ($tribe <> 4) {
            $ico .= ' </a>';
        }
        return '<tr><td class="ico">' . $ico . '</td>
                        <td class="desc" title="' . T("Troops", nrToUnitId($i, $tribe) . '.title') . '">' . T("Troops",
                nrToUnitId($i, $tribe) . '.title') . '</td>
                        <td class="value">
                        <input class="text" type="text" name="a' . ($isAttacker ? 1 : 2) . '_' . ($isAttacker ? $i : nrToUnitId($i,
                $tribe)) . '" value="' . $num . '" maxlength="' . $this->maxLength . '" title="' . T("combat",
                "number") . ' ' . T("Troops", nrToUnitId($i, $tribe) . '.title') . '" /></td>
                        <td class="research">' . $research . '</td>
        </tr>';
    }

    public function getAttackerTable()
    {
        $units = $values = $losses = '';
        for ($i = 1; $i <= 10; ++$i) {
            $dead = round($this->output['attacker']['units'][$i - 1]['number'] * ($this->output['response'][0]['losses'][0]));
            $values .= '<td' . ($this->output['attacker']['units'][$i - 1]['number'] == 0 ? ' class="none"' : '') . (getDisplay("smallTroopsNumFontSize") ? ' style="font-size:11px"' : '') . '>' . number_format_x($this->output['attacker']['units'][$i - 1]['number']) . '</td>';
            $losses .= '<td' . ($dead == 0 ? ' class="none"' : '') . (getDisplay("smallTroopsNumFontSize") ? ' style="font-size:11px"' : '') . '>' . number_format_x($dead) . '</td>';
            $units .= '<td><img src="img/x.gif" class="unit u' . nrToUnitId($i,
                    $this->output['attacker']['race']) . '" alt="' . T("Troops",
                    nrToUnitId($i, $this->output['attacker']['race']) . '.title') . '" title="' . T("Troops",
                    nrToUnitId($i, $this->output['attacker']['race']) . '.title') . '"></td>';
        }
        return PHPBatchView::render('combat/troopsTable',
            [
                "isAttacker" => TRUE,
                "race"       => $this->output['attacker']['race'],
                "units"      => $units,
                "Troops"     => $values,
                "Loses"      => $losses,
            ]);
    }

    public function getDefenderTable()
    {
        $table = '';
        foreach ($this->output['defender']['races'] as $race => $defender) {
            $units = $values = $losses = '';
            for ($i = 1; $i <= 10; ++$i) {
                $dead = round($defender['units'][$i - 1]['number'] * ($this->output['response'][0]['losses'][1]));
                $values .= '<td' . ($defender['units'][$i - 1]['number'] == 0 ? ' class="none"' : '') . (getDisplay("smallTroopsNumFontSize") ? ' style="font-size:11px"' : '') . '>' . number_format_x($defender['units'][$i - 1]['number']) . '</td>';
                $losses .= '<td' . ($dead == 0 ? ' class="none"' : '') . (getDisplay("smallTroopsNumFontSize") ? ' style="font-size:11px"' : '') . '>' . number_format_x($dead) . '</td>';
                $units .= '<td><img src="img/x.gif" class="unit u' . nrToUnitId($i, $race) . '" alt="' . T("Troops",
                        nrToUnitId($i, $race) . '.title') . '" title="' . T("Troops",
                        nrToUnitId($i, $race) . '.title') . '"></td>';
            }
            $table .= PHPBatchView::render('combat/troopsTable',
                ["isAttacker" => FALSE, "race" => $race, "units" => $units, "Troops" => $values, "Loses" => $losses,]);
        }
        return $table;
    }

    public function procContent()
    {
        return $this->output;
    }
} 