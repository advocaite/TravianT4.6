<?php

namespace Controller;

use Core\Caching\Caching;
use Core\Config;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use resources\View\PHPBatchView;

class OnLoadBuildingsDorfCtrl extends AnyCtrl
{
    public function __construct()
    {
        $village = Village::getInstance();
        $sort = function ($a, $b) {
            return $a['commence'] == $b['commence'] ? 0 : ($a['commence'] > $b['commence'] ? 1 : -1);
        };
        uasort($village->onLoadBuildings['normal'], $sort);
        uasort($village->onLoadBuildings['master'], $sort);
        if ($village->onLoadBuildings['normal'] + $village->onLoadBuildings['master']) {
            $session = Session::getInstance();
            $json = [];
            $tmp = [];
            $HTML = '';
            $firstFlag = TRUE;
            foreach ($village->onLoadBuildings['normal'] as $row) {
                if (!isset($tmp[$row['building_field']])) {
                    $tmp[$row['building_field']] = 0;
                }
                ++$tmp[$row['building_field']];
                $level = $village->getField($row['building_field'])['level'] + $tmp[$row['building_field']];
                $item_id = $village->getField($row['building_field'])['item_id'];
                if ($firstFlag) {
                    $HTML .= '<ul>';
                    $firstFlag = FALSE;
                }
                $HTML .= '<li>
                <a href="?d=' . $row['id'] . '&amp;a=0&amp;c=' . $session->getChecker() . '">
                    <img src="img/x.gif" class="del" title="' . T("Global", "General.cancel") . '" alt="' . T("Global",
                        "General.cancel") . '" />
                </a>
                <div class="name">
                    ' . T("Buildings", $item_id . '.title') . '
                    <span class="lvl">' . T("Buildings", "level") . ' ' . $level . '</span>
                </div>
                <div class="buildDuration">
                    ' . appendTimer(($row['commence'] - time())) . " " . T("Global",
                        "General.hour") . '.' . ' ' . T("Global", "General.endat") . ' ' . TimezoneHelper::date('H:i',
                        $row['commence']) . '
                </div>
                <div class="clear"></div>
            </li>';
                $json[] = [
                    'stufe' => $level,
                    'gid' => $item_id,
                    'aid' => $row['building_field'],
                ];
            }
            if (!$firstFlag) {
                $HTML .= '</ul>';
            }
            $firstFlag = TRUE;
            $ti = TRUE;
            foreach ($village->onLoadBuildings['master'] as $row) {
                $row['commence']++;
                if (!isset($tmp[$row['building_field']])) {
                    $tmp[$row['building_field']] = 0;
                }
                ++$tmp[$row['building_field']];
                $level = $village->getField($row['building_field'])['level'] + $tmp[$row['building_field']];
                $item_id = $village->getField($row['building_field'])['item_id'];
                if ($firstFlag) {
                    $HTML .= '<h5>' . T("Buildings", "masterBuilder.masterBuilder") . ': <span>';
                    if (!$village->isWW()) {
                        $HTML .= "(" . ' <img src="img/x.gif" alt="' . T("inGame", "gold") . '"
                        title="' . T("inGame",
                                "gold") . '" class="gold" /><span class="goldValue">' . Config::getInstance()->gold->masterBuilderGold . '</span> ' . T("Buildings",
                                "masterBuilder.atStartOfConstruction") . ')';
                    }
                    $HTML .= '</h5>';
                    $HTML .= '<ul>';
                    $firstFlag = FALSE;
                }
                $costs = Formulas::buildingUpgradeCosts($item_id, $level);
                $duration = '';
                if (sizeof($json) === 0 && $ti && ($village->isWW() || $village->getProduction(3) > 0 || $costs[3] <= $village->getCurrentResources(3))) {
                    $ti = FALSE;
                    $timeLeft = sprintf(T("Global", "General.startat") . ' %s',
                        appendTimer($row['commence'] - time()) . " ");
                    $duration = <<<HTML
     <div class="buildDuration">
                    {$timeLeft}
                </div>
HTML;
                }
                $HTML .= '<li>
                <a href="?d=' . $row['id'] . '&amp;a=0&amp;c=' . $session->getChecker() . '">
                    <img src="img/x.gif" class="del" title="' . T("Global", "General.cancel") . '" alt="' . T("Global",
                        "General.cancel") . '" />
                </a>
                <div class="name inactive">
                    ' . T("Buildings", $item_id . '.title') . '
                    <span class="lvl">' . T("Buildings", "level") . ' ' . $level . '</span>
                </div>
                ' . $duration . '
                <div class="clear"></div>
            </li>';
            }
            if (!$firstFlag) {
                $HTML .= '</ul>';
            }
            $helper = new GoldHelper();
            $this->view = new PHPBatchView('dorf1/buildingQueue');
            $this->view->vars = [
                'normal' => sizeof($village->onLoadBuildings['normal']),
                'buildings' => $HTML,
                'finishNowButton' => $helper->finishNowButton(),
                'buildsJson' => json_encode($json),
            ];
        }
    }
} 