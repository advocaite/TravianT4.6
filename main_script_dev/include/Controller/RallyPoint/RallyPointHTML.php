<?php

namespace Controller\RallyPoint;

use Core\Config;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Model\ArtefactsModel;
use Model\WonderOfTheWorldModel;

class RallyPointHTML
{
    public function getMovementTable($row, $settings, $noHeroWhenZero = false)
    {
        $style = 'style="font-size: 11px;"';
        if (!getDisplay("smallTroopsNumFontSize")) $style = null;
        $HTML = '';
        $HTML .= '<table ' . (isset($row['id']) ? 'id="entity-' . $row['id'] : '') . '" cellspacing="1" cellpadding="1" class="troop_details' . (isset($settings['troopDetailsClass']) ? " " . $settings['troopDetailsClass'] : "") . '">';
        $HTML .= '<thead><tr><td class="role">';
        if (isset($settings['noVillageLink']) && $settings['noVillageLink']) {
            $HTML .= $row['owner']['villageName'];
        } else {
            $HTML .= '<a href="karte.php?d=' . $row['owner']['kid'] . '">' . $row['owner']['villageName'] . '</a>';
        }
        $size = sizeof($row['units']);
        if (isset($row['units'][98]) && $noHeroWhenZero && $row['units'][98] == 0) {
            $size--;
        }
        $HTML .= '</td>';
        $HTML .= '<td colspan="' . $size . '" class="troopHeadline">';
        if (isset($settings['showMarkState']) && $settings['showMarkState']) {
            $HTML .= '<a class="markAttack" onclick="Travian.AttackSymbol.markAttackSymbol(' . $settings['movementId'] . ');return false;"><img id="markSymbol_' . $settings['movementId'] . '" class="markAttack markAttack' . $settings['markState'] . '" src="img/x.gif" alt="mark attack"></a>';
        }
        if (isset($settings['troopHeadline'])) {
            $HTML .= $settings['troopHeadline'];
        }
        //message
        $HTML .= '</td></tr></thead>';
        $HTML .= '<tbody class="units"><tr';
        if (isset($settings['unitsRowId'])) {
            $HTML .= ' id="' . $settings['unitsRowId'] . '"';
        }
        $HTML .= '>';
        if (!isset($settings['noCoordinates']) || !$settings['noCoordinates']) {
            //coordinate
            $coord = Formulas::kid2xy($row['owner']['kid']);
            $HTML .= '<th class="coords">‎<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . strtolower(getDirection()) . '"><span class="coordinateX">(' . $coord['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $coord['y'] . ')</span></span></th>';
        } else {
            $HTML .= '<td></td>';
        }
        $i = 1;
        $isset = isset($settings['unitsRowId']) && $settings['unitsRowId'] == "unitRowAtTown";
        foreach ($row['units'] as $u => $value) {
            if ($i == 11 || $i == 98) {
                if ($value == 0 && $noHeroWhenZero) continue;
                $u = "hero";
            }
            $HTML .= '<td class="uniticon' . ($isset ? " t" . $i : "") . ($i == $size ? " last" : "") . '"><img class="unit u' . $u . '" title="' . T("Troops",
                    $u . '.title') . '" alt="' . T("Troops", $u . '.title') . '" src="img/x.gif" /></td>';
            ++$i;
        }
        $HTML .= '</tr></tbody>';
        $HTML .= '<tbody class="units last"><tr><th>' . T("RallyPoint", "troops") . '</th>';
        $i = 1;
        foreach ($row['units'] as $value) {
            if ($i == 11 || $i == 98) {
                if ($value == 0 && $noHeroWhenZero) continue;
            }
            $none = "";
            if ($settings['showTroopsType'] && !$value) {
                $value = 0;
            }
            if (!$settings['showTroopsNum']) {
                if (!$settings['showTroopsType']) {
                    $value = "?";
                } else if ($settings['showTroopsType'] && $value) {
                    $value = "?";
                }
                $none = " none";
            }
            if (is_numeric($value) && $value <= 0) {
                $none = " none";
            }
            if (isset($settings['unitsAreEditable']) && $settings['unitsAreEditable'] && $settings['showTroopsNum'] && $value > 0) {
                $value = '<input type="text" name="t[' . $i . ']" class="text" value="' . $value . '" maxlength="' . max(5,
                        strlen($value)) . '">';
            }
            $HTML .= '<td class="unit' . $none . '" ' . $style . '>' . $this->number_format($value) . '</td>';
            ++$i;
        }
        $HTML .= '</tr></tbody>';
        if (!isset($settings['cata'])) {
            $settings['cata'] = [];
        }
        foreach ($settings['cata'] as $target) {
            if ($target['type'] == 'cata') {
                $HTML .= '<tbody class="infos">';
                if ($target['isRaid']) {
                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("Reports", "Information") . '</th>';
                    $HTML .= '<td colspan="' . $size . '">';
                    $HTML .= T("RallyPoint", "catapult only attacks in normal type");
                    $HTML .= '</td></tr>';
                    continue;
                }
            }
            $HTML .= '<tbody class="cata">';
            switch ($target['type']) {
                case 'targets':
                    $size1 = 5;
                    if ($target['lvl'] < 20) {
                        $size1 *= 2;
                        if ($size == 11) {
                            $size1++;
                        }
                    }
                    $HTML .= '
                    <tr><th>' . T("RallyPoint", "catapultTargets") . '</th>';
                    $HTML .= '<td colspan="' . $size1 . '" > ';
                    if ($target['ctar1'] == 99) {
                        $HTML .= T("RallyPoint", "random");
                    } else {
                        $HTML .= T("Buildings", "{$target['ctar1']}.title");
                    }
                    $HTML .= '</td>';
                    if ($target['lvl'] >= 20 || $target['ctar2'] > 0) {
                        $HTML .= '<td colspan="' . ($size == 11 ? 6 : 5) . '" > ';
                        if ($target['ctar2'] == 99) {
                            $HTML .= T("RallyPoint", "random");
                        } else if ($target['ctar2'] == 0) {
                            $HTML .= ' - ';
                        } else {
                            $HTML .= T("Buildings", "{$target['ctar2']}.title");
                        }
                        $HTML .= '</td>';
                    }
                    $HTML .= '</tr>';
                    break;
                case "cata":
                    $count = 1;
                    if ($target['level'] == 20) {
                        if (isset($target['count']) && $target['count'] > 20) {
                            $count++;
                        }
                    }
                    $resources = $pishNiaz = $military = [];
                    if ($target['level'] < 3) {
                        $resources = [];
                        $pishNiaz = [];
                        $military = [];
                    } else if ($target['level'] <= 4) {
                        $resources = [];
                        $pishNiaz = [10, 11];
                        $military = [];
                    } else if ($target['level'] <= 9) {
                        $resources = [1, 2, 3, 4, 5, 6, 7, 8, 9];
                        $pishNiaz = [10, 11];
                        $military = [];
                    } else if ($target['level'] >= 10) {
                        $resources = [1, 2, 3, 4, 5, 6, 7, 8, 9];
                        $pishNiaz = [10, 11, 15, 17, 18, 24, 25, 26, 44, 27, 28, 38, 39, 41, 45];
                        if (ArtefactsModel::wwPlansReleased()) {
                            $pishNiaz[] = 40;
                        }
                        $military = [13, 14, 16, 19, 20, 21, 22, 35, 37];
                    }

                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("RallyPoint", "target") . '</th>';
                    $HTML .= '<td colspan="' . $size . '">';

                    for ($i = 1; $i <= $count; ++$i) {
                        if ($i == 2) $HTML .= '<br/>';
                        $HTML .= ' <select name="ctar' . $i . '" class="dropdown">';
                        if ($i == 2) $HTML .= '<option value="0"> - </option>';
                        $HTML .= '<option value="99">' . T("RallyPoint", "random") . '</option>';
                        if (sizeof($resources)) {
                            $HTML .= '<optgroup label="' . T("Buildings", "newBuilding.Resources") . '">';
                            foreach ($resources as $res) {
                                $HTML .= '<option value="' . $res . '">' . T("Buildings", "{$res}.title") . '</option>';
                            }
                            $HTML .= '</optgroup>';
                        }
                        if (sizeof($pishNiaz)) {
                            $HTML .= '<optgroup label="' . T("Buildings", "newBuilding.Infrastructure") . '">';
                            foreach ($pishNiaz as $res) {
                                $HTML .= '<option value="' . $res . '">' . T("Buildings", "{$res}.title") . '</option>';
                            }
                            $HTML .= '</optgroup>';
                        }
                        if (sizeof($military)) {
                            $HTML .= '<optgroup label="' . T("Buildings", "newBuilding.Military") . '">';
                            foreach ($military as $res) {
                                $HTML .= '<option value="' . $res . '">' . T("Buildings", "{$res}.title") . '</option>';
                            }
                            $HTML .= '</optgroup>';
                        }
                        $HTML .= '</select> ';
                        $HTML .= '<span class="info">  (' . T("RallyPoint", "willBeAttackedTarget") . ')  </span>';
                    }
                    $HTML .= '</td></tr>';
                    break;
            }
            $HTML .= '</tbody>';
        }
        if (!isset($settings['options'])) {
            $settings['options'] = [];
        }
        foreach ($settings['options'] as $option) {
            $HTML .= '<tbody class="targets">';
            switch ($option['type']) {
                case "spy":
                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("RallyPoint", "options") . '</th>';
                    $other = '';
                    if (!$option['isOasis']) {
                        $other = '<input class="radio" type="radio" name="spy" value="1" checked />  ' . T("RallyPoint",
                                "spyTargetTroopsResources") . '.
<br />';
                    }
                    $HTML .= '<td colspan="' . $size . '">
' . $other . '
<input class="radio" type="radio" name="spy" value="2"' . ($option['isOasis'] ? 'checked' : '') . '> ' . T("RallyPoint",
                            "spyTargetTroopsBuildings") . '.
</td>';
                    $HTML .= '</tr>';
                    break;
            }
            $HTML .= '</tbody>';
        }
        if (!isset($settings['targets'])) {
            $settings['targets'] = [];
        }
        foreach ($settings['targets'] as $target) {
            $HTML .= '<tbody class="targets">';
            switch ($target['type']) {
                case "spy":
                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("RallyPoint", "spyTarget") . '</th>';
                    $HTML .= '<td colspan="' . $size . '">' . T("RallyPoint",
                            $target['targetId'] == 1 ? "spyTargetTroopsResources" : "spyTargetTroopsBuildings") . '</td>';
                    $HTML .= '</tr>';
                    break;
            }
            $HTML .= '</tbody>';
        }
        if (!isset($settings['info'])) {
            $settings['info'] = [];
        }
        foreach ($settings['info'] as $info) {
            $HTML .= '<tbody class="infos">';
            switch ($info['type']) {
                case "Consumption":
                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("RallyPoint", "Consumption") . '</th>';
                    $HTML .= '<td colspan="' . $size . '">';
                    $HTML .= '<div class="sup"><div class="inlineIconList supplyWrapper"><div class="inlineIcon resources"><span class="value ">' . $this->number_format($info['consumption']) . '</span><i class="r4"></i></div></div>&nbsp;' . T("Global", "General.perHour") . '</div>';
                    if (isset($info['withdraw']) && $info['withdraw']) {
                        $HTML .= '<div class="sback">';
                        $HTML .= '<a class="arrow" href="build.php?id=39&amp;tt=2&amp;d=' . $info['taskId'] . '" title="' . T("RallyPoint",
                                "withdraw") . '">' . T("RallyPoint", "withdraw") . '</a>';
                        $HTML .= '</div>';
                    } else if (isset($info['kill']) && $info['kill']) {
                        $HTML .= '<div class="sback">';
                        $desc = T("RallyPoint", "TroopKillDesc");
                        $kill = T("RallyPoint", "kill");
                        $query = "build.php?" . http_build_query([
                                'tt' => 1,
                                "gid" => 16,
                                "kill" => $info['taskId'],
                                Session::getCheckerName() => Session::getInstance()->getChecker(),
                                "page" => isset($_REQUEST['page']) ? $_REQUEST['page'] : 1,
                                "filter" => $info['filter'],
                            ]);
                        $HTML .= <<<HTML
                        <a class="arrow" onclick="return (function() {
				(new Travian.Dialog.Dialog({
				    preventFormSubmit: true,
					onOkay: function(dialog, contentElement) {window.location.href = '{$query}'}}))
                .setContent('{$desc}')
                .show();
				return false;
			})()" title="$kill">$kill</a>
HTML;
                        $HTML .= '</div>';
                    } else if (isset($info['free']) && $info['free']) {
                        $HTML .= '<div class="sback">';
                        $HTML .= '<a class="arrow" href="build.php?id=39&amp;tt=2&amp;free=' . $info['taskId'] . '&' . (Session::getCheckerForUrl()) . '" title="' . T("RallyPoint",
                                "free") . '">' . T("RallyPoint", "free") . '</a>';
                        $HTML .= '</div>';
                    } else if (isset($info['back']) && $info['back']) {
                        $HTML .= '<div class="sback">';
                        $HTML .= '<a class="arrow" href="build.php?id=39&amp;tt=2&amp;d=' . $info['taskId'] . '" title="' . T("RallyPoint",
                                "back") . '">' . T("RallyPoint", "back") . '</a>';
                        $HTML .= '</div>';
                    }
                    $HTML .= '</td></tr>';
                    break;
                case "resources":
                    $HTML .= '<tr><th>' . T("inGame", "resources.resources") . '</th>';
                    $HTML .= '<td colspan="' . $size . '" ' . $style . '>';
                    $HTML .= '<div class="res">';

                    $HTML .= '<div class="inlineIconList resourceWrapper">';
                    $HTML .= '<div class="inlineIcon resources"><i class="r1"></i><span class="value ">' . $this->number_format($info['resources'][0]) . '</span></div>';
                    $HTML .= '<div class="inlineIcon resources"><i class="r2"></i><span class="value ">' . $this->number_format($info['resources'][1]) . '</span></div>';
                    $HTML .= '<div class="inlineIcon resources"><i class="r3"></i><span class="value ">' . $this->number_format($info['resources'][2]) . '</span></div>';
                    $HTML .= '<div class="inlineIcon resources"><i class="r4"></i><span class="value ">' . $this->number_format($info['resources'][3]) . '</span></div>';
                    $HTML .= '</div>';

                    $HTML .= '</div>';
                    if (isset($info['noCarry']) && $info['noCarry']) {
                    } else {
                        $HTML .= '<div class="carry">';
                        $loot = array_sum($info['resources']);
                        $carry = $loot . ' / ' . $info['carry'];
                        $style = "full";
                        if ($loot == 0) {
                            $style = "empty";
                        } else if ($info['carry'] != 0 && $loot <> $info['carry']) {
                            $style = "half";
                        }
                        $HTML .= '<img title="' . $carry . '" src="img/x.gif" class="carry ' . $style . '"> ' . $carry;
                        $HTML .= '</div>';
                    }
                    $HTML .= '</td></tr>';
                    break;
                case "Arrival":
                    $remaining = $info['ArrivalTime'] - time();
                    $HTML .= '<tr>';
                    $HTML .= '<th>' . T("RallyPoint", "ArrivalIn") . '</th>';
                    $HTML .= '<td colspan="' . $size . '">';
                    $HTML .= '<div class="in">' . T("Global", "General.in") . "&nbsp;";
                    if (isset($info['countDown']) && $info['countDown']) {
                        $HTML .= '<span class="timer" counting="down" value="' . $remaining . '"> ';
                    }
                    $HTML .= secondsToString($remaining);
                    if (isset($info['countDown']) && $info['countDown']) {
                        $HTML .= '</span> ';
                    }
                    $HTML .= ' ' . T("Global", "General.hour") . '.</div>';
                    if (isset($info['abort']) && $info['abort']) {//need fix later!
                        $HTML .= '<div class="abort"><button type="button" class="icon " title="' . T("Global",
                                "General.cancel") . '" onclick="window.location.href = \'build.php?gid=16&amp;tt=1&amp;a=4&amp;t=' . $info['taskId'] . '&amp;tt=1&amp;' . Session::getCheckerForUrl() . '\'; return false;"><img src="img/x.gif" class="del" alt="' . T("Global",
                                "General.cancel") . '" /></button></div>';
                    }
                    $HTML .= '<div class="at">' . T("Global", "General.at") . ' ';
                    if (isset($info['countUp']) && $info['countUp']) {
                        $HTML .= '<span class="timer" counting="up" value="' . $info['ArrivalTime'] . '"> ';
                    } else {
                        $HTML .= '<span> ';
                    }
                    $HTML .= TimezoneHelper::date("H:i:s", $info['ArrivalTime']);
                    $HTML .= '</span><span> </span></div></td>';
                    break;
            }
            $HTML .= '</tbody>';
        }
        $HTML .= '</tbody>';
        $HTML .= '</table>';
        return $HTML;
    }

    //get the html of movement.

    private function number_format($x, $dec = 0)
    {
        if ($x == '?') return $x;
        if (!is_numeric($x)) return $x;
        return number_format_x($x, $dec);
    }
} 