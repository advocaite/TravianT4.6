<?php
namespace Controller\Ajax;

use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\Formulas;
use Model\AllianceBonusModel;
use function number_format_x;
use resources\View\PHPBatchView;

class allianceBonusOverview extends AjaxBase
{
    public static function renderProgressBar($type)
    {
        $m = new AllianceBonusModel();
        $session = Session::getInstance();
        $bonus = $m->getAllianceBonusTypeParams($session->getAllianceId(), $type);
        $unlockInProgress = $m->isUnlockingNextLevel($session->getAllianceId(), $type);
        $html = null;
        $html .= ' <div class="bonusBar">';
        $iconClasses = [
            AllianceBonusModel::TYPE_TRAINING => 'bonusIconRecruitment',
            AllianceBonusModel::TYPE_ARMOR => 'bonusIconMetallurgy',
            AllianceBonusModel::TYPE_CP => 'bonusIconPhilosophy',
            AllianceBonusModel::TYPE_TRADE => 'bonusIconCommerce',
        ];
        $activationTime = $session->getAllianceJoinTime() + Formulas::getAllianceBonusCoolDownForNewPlayers($bonus['level']);
        $percent = ($type == AllianceBonusModel::TYPE_TRADE ? 20 : 2);
        $html .= '<img src="img/x.gif" title="" alt="" class="' . $iconClasses[$type] . '"/>';
        $html .= '<div class="progressBar ' . ($activationTime > time() ? 'inactive' : ($bonus['level'] >= 5 ? 'complete' : '')) . '">';
        $html .= '<div class="levelIndicator level' . $bonus['level'] . '">';
        $html .= '<div class="indicator">+' . ($bonus['level'] * $percent) . '%';
        $html .= '<div class="arrow"></div>';
        $html .= '<div class="crown"></div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="levelPercentages">';
        for ($i = 1; $i <= 5; ++$i) {
            $styles = [
                'level' . $i,
                $bonus['level'] >= $i ? 'reached' : 'notreached',
            ];
            $html .= '<div class="' . implode(" ", $styles) . '">+' . ($i * $percent) . '%</div>';
        }
        $html .= '</div>';
        $html .= '<div class="levels">';
        for ($i = 1; $i <= 5; ++$i) {
            $styles = [
                'level' . $i,
                $bonus['level'] >= $i ? 'reached' : 'notreached',
            ];

            $title = null;
            if ($bonus['level'] < $i && $i == ($bonus['level'] + 1)) {
                if ($unlockInProgress) {
                    $styles[] = 'upgrading';
                } else {
                    $neededContribution = Formulas::getAllianceBonusContributesNeededForLevel($i) - $bonus['contributions'];
                    $title = sprintf(
                        T("AllianceBonus", "Amount of resources needed to reach next level: %s"),
                        number_format_x($neededContribution)
                    );
                }
            }
            $html .= '<span class="levelTooltip' . $i . '" title="' . $title . '"></span>';

            $title = null;
            if (in_array('upgrading', $styles)) {
                $translateName = [
                    AllianceBonusModel::TYPE_TRAINING => 'training_bonus_upgrading',
                    AllianceBonusModel::TYPE_ARMOR => 'armor_bonus_upgrading',
                    AllianceBonusModel::TYPE_CP => 'cp_bonus_upgrading',
                    AllianceBonusModel::TYPE_TRADE => 'trade_bonus_upgrading',
                ];
                $time = $m->getUnlockTime($session->getAllianceId(), $type);
                $title = sprintf(T("AllianceBonus", $translateName[$type]), TimezoneHelper::autoDate($time, true, true));
            }
            $html .= '<div class="' . implode(" ", $styles) . '" title="' . $title . '"></div>';
        }
        $html .= '</div>';
        $width = 0;
        $lengths = [
            1 => 25, 31, 67, 108, 153+20
        ];
        for ($i = 1; $i <= 5; ++$i) {
            if ($bonus['level'] >= $i) {
                $width += $lengths[$i] + 22;
            } else {
                $totalForThisLevel = Formulas::getAllianceBonusContributesNeededForLevel($i, false);
                $current = $totalForThisLevel - (Formulas::getAllianceBonusContributesNeededForLevel($i) - $bonus['contributions']);
                $width += $current / $totalForThisLevel * $lengths[$i];
                break;
            }
        }
        $html .= '<div class="front"><div class="back" style="width: ' . round($width, 2) . 'px"></div></div>';
        $html .= '<div class="clear"></div>';
        $html .= '</div>';
        if ($activationTime > time()) {
            $text = sprintf(
                T("AllianceBonus", "Bonus activation time: %s"),
                TimezoneHelper::autoDate($activationTime, true)
            );
            $html .= '<div class="bonusActivationMessage">' . $text . '</div>';
        } else {
            $html .= '<div class="bonusActivationMessage hide"></div>';
        }
        $html .= '</div>';
        return $html;
    }

    public static function renderContributors($type, $isWeek)
    {
        $m = new AllianceBonusModel();
        $session = Session::getInstance();
        $html = '<table cellspacing="1" cellpadding="1" class="top5 row_table_data" id="' . ($isWeek ? 'top5_contributors_week' : 'top5_contributors_all') . '">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td>' . T("AllianceBonus", "NoColumn") . '</td>';
        $html .= '<td>' . T("AllianceBonus", "Player(s)") . '</td>';
        $html .= '<td>' . T("AllianceBonus", "Resources") . '</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        if ($isWeek) {
            $contributors = $m->getContributorsOfTheWeek($session->getAllianceId(), $type);
        } else {
            $contributors = $m->getAllTimeContributors($session->getAllianceId(), $type);
        }

        $contributors_arr = [
            'contributors' => [
                1 => null,
                2 => null,
                3 => null,
                4 => null,
                5 => null,
            ],
            'my_contribution_rank' => null,
        ];

        $rank = 1;
        while ($row = $contributors->fetch_assoc()) {
            if ($row['id'] == $session->getPlayerId()) {
                $contributors_arr['my_contribution_rank'] = $rank;
            }
            $contributors_arr['contributors'][$rank++] = $row;
        }

        for ($rank = 1; $rank <= 5; ++$rank) {
            $html .= '<tr class="hover ">';
            $html .= '<td class="ra fc">' . $rank . '.&nbsp;</td>';
            $html .= '<td class="pla">';
            $rankRow = $contributors_arr['contributors'][$rank];
            if (is_null($rankRow)) {
                $html .= '<span class="archived">-</span>';
            } else {
                $html .= '<a href="spieler.php?uid=' . $rankRow['id'] . '">' . $rankRow['name'] . '</a>';
            }
            $html .= '</td>';
            if (is_null($rankRow)) {
                $html .= '<td class="val lc">-</td>';
            } else {
                $html .= '<td class="val lc">' . $rankRow['points'] . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '<tr><td colspan="3" class="empty"></td></tr>';
        $myRank = $contributors_arr['my_contribution_rank'];
        if ($isWeek) {
            $myContribution = $session->get(AllianceBonusModel::USER_WEEK_CONTRIBUTION_PARAMS[$type]);
        } else {
            $myContribution = $session->get(AllianceBonusModel::USER_TOTAL_CONTRIBUTION_PARAMS[$type]);
        }
        $html .= '<tr class="own hl">';
        $html .= '<td class="ra fc">' . (is_null($myRank) ? '&#63;' : $myRank . '.') . '</td>';
        $html .= '<td class="pla"><a href="spieler.php?uid=' . $session->getPlayerId() . '">' . $session->getName() . '</a></td>';
        $html .= '<td class="val lc"> ' . $myContribution . '</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        return $html;
    }


    public function dispatch()
    {
        $this->response['data']['overview'] = self::render();
    }

    public static function render()
    {
        $view = new PHPBatchView("alliance/bonuses/overview");


        return $view->output();
    }
}