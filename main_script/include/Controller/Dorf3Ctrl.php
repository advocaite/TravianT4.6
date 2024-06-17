<?php

namespace Controller;

use Core\Caching\Caching;
use Core\Caching\ProfileCache;
use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Game\ResourcesHelper;
use Game\TrainingHelper;
use function getGame;
use function getGameSpeed;
use Model\ArtefactsModel;
use Model\Dorf1Model;
use Model\MarketModel;
use Model\VillageModel;
use Model\villageOverviewModel;
use Model\WonderOfTheWorldModel;
use resources\View\GameView;
use resources\View\PHPBatchView;
use function getDisplay;
use function nanoseconds;

class Dorf3Ctrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'village3';
        $this->view->vars['titleInHeader'] = T("villageOverview", "villageOverview");
        $selectedTabId = isset($_GET['s']) && is_numeric($_GET['s']) && $_GET['s'] <> 1 && $_GET['s'] >= 0 && $_GET['s'] <= ($this->allowed() ? 5 : 0) ? (int)$_GET['s'] : ($this->allowed() ? $this->session->getFavoriteTab("villageOverview") : 0);
        if (!$this->allowed()) {
            $this->view->vars['content'] .= PHPBatchView::render('dorf3/menuDisabled');
        } else {
            $this->view->vars['content'] .= PHPBatchView::render('dorf3/menuEnabled', ['selectedTabId' => $selectedTabId]);
        }
        switch ($selectedTabId) {
            case 0:
                $this->showOverview();
                break;
            case 2:
                $this->showResources();
                break;
            case 3:
                $this->showWarehouse();
                break;
            case 4:
                $this->showCulturePoints();
                break;
            case 5:
                $this->showTroops();
                break;
        }
    }

    private function showOverview()
    {
        $view = new PHPBatchView("dorf3/overview");
        $content = &$view->vars['content'];
        $m = new villageOverviewModel();
        $d1 = new Dorf1Model();

        $alliance_bonus = AllianceBonus::getTradersBonus($this->session->getAllianceId(), $this->session->getAllianceJoinTime());
        $market = new MarketModel();

        $echoAttack = function ($kid, $count, $class, $title) {
            if (!$count) {
                return null;
            }
            $content = null;
            $number = $this->number_format($count);
            $content .= '<a href="build.php?newdid=' . $kid . '&amp;id=39&amp;tt=1#at">';
            $content .= '<img class="' . $class . '" src="img/x.gif" title="' . $number . 'x ' . $title . '" alt="' . $number . 'x ' . $title . '"></a>';
            return $content;
        };

        $playerVillages = $this->getPlayerVillages();
        foreach ($playerVillages as $row) {
            $content .= '<tr class="' . ($row['kid'] == $this->session->getKid() ? 'hl' : 'hover') . '">';
            $content .= '<td class="vil fc"><a href="dorf1.php?newdid=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $content .= '<td class="att">';
            if ($this->allowed()) {
                $oases = $d1->getOasesAsString($row['kid']);
                $data = [
                    'totalMovements'            => 0,
                    'oasesAttacks'              => $d1->getIncomingAttacksToMyOases($oases),
                    'oasesReinforcements'       => $d1->getIncomingReinforcementToMyOases($oases),
                    'inComingAttacksToMe'       => $d1->getIncomingAttacksToMe($row['kid']),
                    'inComingReinforcementToMe' => $d1->getIncomingReinforcementToMe($row['kid']),
                    'outGoingAttacks'           => $d1->getOutgoingAttacks($row['kid']),
                    'outGoingReinforcements'    => $d1->getOutGoingReinforcements($row['kid']),
                ];

                $data['totalMovements'] += $data['inComingAttacksToMe']['count'];
                $data['totalMovements'] += $data['inComingReinforcementToMe']['count'];
                $data['totalMovements'] += $data['outGoingAttacks']['count'];
                $data['totalMovements'] += $data['outGoingReinforcements']['count'];
                $data['totalMovements'] += $data['oasesAttacks']['count'];
                $data['totalMovements'] += $data['oasesReinforcements']['count'];

                $content .= $echoAttack(
                    $row['kid'],
                    $data['oasesAttacks']['count'],
                    'att3',
                    T("villageOverview", "Oasis attacking troops")
                );
                $content .= $echoAttack(
                    $row['kid'],
                    $data['inComingAttacksToMe']['count'],
                    'att1',
                    T("villageOverview", "Other attacking troops")
                );
                $content .= $echoAttack(
                    $row['kid'],
                    $data['oasesReinforcements']['count'],
                    'def3',
                    T("villageOverview", "Oasis reinforcing troops")
                );
                $content .= $echoAttack(
                    $row['kid'],
                    $data['inComingReinforcementToMe']['count'],
                    'def1',
                    T("villageOverview", "Village reinforcing troops")
                );
                $content .= $echoAttack(
                    $row['kid'],
                    $data['outGoingAttacks']['count'],
                    'att2',
                    T("villageOverview", "Own attacking troops")
                );
                $content .= $echoAttack(
                    $row['kid'],
                    $data['outGoingReinforcements']['count'],
                    'def2',
                    T("villageOverview", "Own Reinforcing troops")
                );


                if ($data['totalMovements'] == 0) {
                    $content .= '<span class="errorMessage">-</span>';
                }
            } else {
                $content .= '<span class="errorMessage">?</span>';
            }
            $content .= '</td>';
            $content .= '<td class="bui">';
            if ($this->allowed()) {
                $upgrades = $m->getVillageUpgradeBuildings($row['kid']);
                while ($build = $upgrades->fetch_assoc()) {
                    $item_id = $m->getFieldItemId($row['kid'], $build['building_field']);
                    $content .= '<a href="dorf' . ($build['building_field'] <= 18 ? 1 : 2) . '.php?newdid=' . $row['kid'] . '"><img class="bau" src="img/x.gif" title="' . T(
                        "Buildings",
                            "{$item_id}.title"
                    ) . '" alt="' . T("Buildings", "{$item_id}.title") . '"></a>';
                }
                if (!$upgrades->num_rows) {
                    $content .= '<span class="errorMessage">-</span>';
                }
            } else {
                $content .= '<span class="errorMessage">?</span>';
            }
            $content .= '</td>';
            $content .= '<td class="tro">';
            if ($this->allowed()) {
                $training = $m->getVillageTroopsTraining($row['kid']);
                if (!sizeof($training)) {
                    $content .= '<span class="errorMessage">-</span>';
                } else {
                    foreach ($training as $item_id => $a) {
                        foreach ($a as $nr => $v) {
                            $unitId = nrToUnitId($nr, $this->session->getRace());
                            if (getDisplay("seperateLargeAndSmallTrainingBuildingsSummaryInDorf3")) {
                                $title = $this->number_format($v['num']) . 'x ' . T("Troops", "{$unitId}.title");
                            } else {
                                $db = DB::getInstance();
                                $trainingTime = (int)$db->fetchScalar("SELECT end_time FROM training WHERE nr=$nr AND item_id=$item_id AND kid=" . $row['kid'] . " ORDER BY end_time DESC LIMIT 1");
                                if (Config::getProperty("game", "useNanoseconds")) {
                                    $trainingTime -= nanoseconds();
                                    $trainingTime /= 1e9;
                                } elseif (Config::getProperty("game", "useMilSeconds")) {
                                    $trainingTime -= miliseconds();
                                    $trainingTime /= 1000;
                                } else {
                                    $trainingTime -= time();
                                }
                                $title = $this->number_format($v['num']) . 'x ' . T("Troops", "{$unitId}.title");
                                if ($trainingTime > 0) {
                                    $title .= '<br />';
                                    $title .= sprintf(T("inGame", "TrainingTime"), secondsToString($trainingTime));
                                    $title = htmlspecialchars($title);
                                }
                            }
                            $content .= '<a href="build.php?newdid=' . $row['kid'] . '&amp;gid=' . $item_id . '"><img class="unit u' . $unitId . '" src="img/x.gif" alt="' . $this->number_format($v['num']) . 'x ' . T(
                                "Troops",
                                    "{$unitId}.title"
                            ) . '" title="' . $title . '"></a>';
                        }
                    }
                }
            } else {
                $content .= '<span class="errorMessage">?</span>';
            }
            $content .= '</td>';
            $mo = $market->getMarketAndTradeOfficeLevel($row['kid']);

            $total_merchants = $mo[17];
            $merchant_cap = Formulas::merchantCAP($this->session->getRace(), $mo[28], $alliance_bonus);
            $merchants_on_the_way = $market->getOnTheWayMerchantsCount($row['kid'], $merchant_cap);
            $merchants_offering = $market->getOfferingMerchantsCount($row['kid'], $merchant_cap);
            $free_merchants = $total_merchants - $merchants_on_the_way - $merchants_offering;

            $content .= '<td class="tra lc"><a href="build.php?newdid=' . $row['kid'] . '&gid=17">‎‭‭‭';
            $content .= ($free_merchants) . '‬‬/‭‭' . $total_merchants . '</a></td>';
            $content .= '</tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function getPlayerVillages()
    {
        $cache = new ProfileCache($this->session->get("profileCacheVersion"));
        return $cache->getProfileVillagesSortedByName($this->session->getPlayerId());
    }

    private function number_format($x)
    {
        return number_format_x($x, 0);
    }

    private function showResources()
    {
        $m = new villageOverviewModel();
        $result = $this->getPlayerVillages();
        foreach ($result as $row) {
            ResourcesHelper::updateVillageResources($row['kid']);
        }
        $view = new PHPBatchView("dorf3/resources");
        $content = &$view->vars['content'];
        $result = $m->getPlayerVillageResources($this->session->getPlayerId());
        $summary = ['r1' => 0, 'r2' => 0, 'r3' => 0, 'r4' => 0, 'merchants_available' => 0, 'merchants_total' => 0,];
        while ($row = $result->fetch_assoc()) {
            $row['wood'] = floor($row['wood']);
            $row['clay'] = floor($row['clay']);
            $row['iron'] = floor($row['iron']);
            $row['crop'] = floor(max($row['crop'], 0));
            $content .= '<tr class="' . ($row['kid'] == $this->session->getKid() ? 'hl' : 'hover') . '">';
            $content .= '<td class="vil fc"><a href="dorf1.php?newdid=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $content .= '<td class="lum">' . number_format($row['wood'], 0, ',', ',') . '</td>';
            $content .= '<td class="clay">' . number_format($row['clay'], 0, ',', ',') . '</td>';
            $content .= '<td class="iron">' . number_format($row['iron'], 0, ',', ',') . '</td>';
            $content .= '<td class="crop">' . number_format($row['crop'], 0, ',', ',') . '</td>';
            $summary['r1'] += $row['wood'];
            $summary['r2'] += $row['clay'];
            $summary['r3'] += $row['iron'];
            $summary['r4'] += $row['crop'];
            $market = new MarketModel();
            $mo = $market->getMarketAndTradeOfficeLevel($row['kid']);
            $session = Session::getInstance();
            $alliance_bonus = 1;
            if ($session->getAllianceId() > 0) {
                $alliance_bonus = AllianceBonus::getTradersBonus(
                    $session->getAllianceId(),
                    $session->getAllianceJoinTime()
                );
            }
            $merchant_cap = Formulas::merchantCAP($this->session->getRace(), $mo[28], $alliance_bonus);
            $totalMerchants = $mo[17];
            $available = ($totalMerchants - $market->getOnTheWayMerchantsCount(
                Village::getInstance()->getKid(),
                    $merchant_cap
            ) - $market->getOfferingMerchantsCount(
                        Village::getInstance()->getKid(),
                    $merchant_cap
                    ));
            $summary['merchants_available'] += $available;
            $summary['merchants_total'] += $totalMerchants;
            $content .= '<td class="tra lc"><a href="build.php?newdid=' . $row['kid'] . '&gid=17">‎‭‭‭' . $available . '‬‬/‭‭' . $totalMerchants . '</a></td>';
            $content .= '</tr>';
        }
        $summary['r1'] = number_format($summary['r1'], 0, ',', ',');
        $summary['r2'] = number_format($summary['r2'], 0, ',', ',');
        $summary['r3'] = number_format($summary['r3'], 0, ',', ',');
        $summary['r4'] = number_format($summary['r4'], 0, ',', ',');
        $view->vars['summary'] = $summary;
        $this->view->vars['content'] .= $view->output();
    }

    private function showWarehouse()
    {
        $m = new villageOverviewModel();
        $result = $this->getPlayerVillages();
        foreach ($result as $row) {
            ResourcesHelper::updateVillageResources($row['kid']);
        }
        $view = new PHPBatchView("dorf3/warehouse");
        $content = &$view->vars['content'];
        $result = $m->getPlayerVillageResourcesWarehouse($this->session->getPlayerId());
        while ($row = $result->fetch_assoc()) {
            $content .= '<tr class="' . ($row['kid'] == $this->session->getKid() ? 'hl' : 'hover') . '">';
            $row['wood'] = floor($row['wood']);
            $row['clay'] = floor($row['clay']);
            $row['iron'] = floor($row['iron']);
            $row['crop'] = floor(max($row['crop'], 0));
            $cropp = $row['cropp'] - $row['pop'] - $row['upkeep'];
            $summary = [
                'woodPercent'            => round($row['wood'] / $row['maxstore'] * 100),
                'woodTitle'              => $row['wood'] . '/' . $row['maxstore'],
                'woodTimeToFill'         => round(($row['maxstore'] - $row['wood']) / $row['woodp'] * 3600),
                'clayPercent'            => round($row['clay'] / $row['maxstore'] * 100),
                'clayTitle'              => $row['clay'] . '/' . $row['maxstore'],
                'clayTimeToFill'         => round(($row['maxstore'] - $row['clay']) / $row['clayp'] * 3600),
                'ironPercent'            => round($row['iron'] / $row['maxstore'] * 100),
                'ironTitle'              => $row['iron'] . '/' . $row['maxstore'],
                'ironTimeToFill'         => round(($row['maxstore'] - $row['iron']) / $row['ironp'] * 3600),
                'storeFillRemainingTime' => '',
                'cropPercent'            => round($row['crop'] / $row['maxcrop'] * 100),
                'cropTitle'              => $row['crop'] . '/' . $row['maxcrop'],
                'cropTimeToFill'         => $cropp == 0 ? 1e8 : round(($row['maxcrop'] - $row['crop']) / $cropp * 3600),
            ];
            if ($cropp < 0) {
                $summary['cropTimeToFill'] = round($row['crop'] / abs($cropp) * 3600);
            }
            $content .= '<td class="vil fc"><a href="dorf1.php?newdid=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $content .= '<td class="lum ' . ($summary['woodPercent'] >= 95 ? 'crit' : '') . '" title="' . $summary['woodTitle'] . '">' . $summary['woodPercent'] . '%</td>';
            $content .= '<td class="clay ' . ($summary['clayPercent'] >= 95 ? 'crit' : '') . '" title="' . $summary['clayTitle'] . '">' . $summary['clayPercent'] . '%</td>';
            $content .= '<td class="iron ' . ($summary['ironPercent'] >= 95 ? 'crit' : '') . '" title="' . $summary['ironTitle'] . '">' . $summary['ironPercent'] . '%</td>';
            $max123 = max([
                $summary['woodTimeToFill'],
                $summary['clayTimeToFill'],
                $summary['ironTimeToFill'],
            ]);
            $content .= '<td class="max123">' . ($max123 > 0 ? appendTimer($max123) : '-') . '</td>';
            $content .= '<td class="crop ' . (($cropp < 0 && $summary['cropPercent'] <= 20) || $summary['cropPercent'] >= 95 ? 'crit' : '') . '" title="' . $summary['cropTitle'] . '">' . $summary['cropPercent'] . '%</td>';
            if ($cropp < 0) {
                $content .= '<td class="max4 lc">' . ($summary['cropTimeToFill'] > 0 ? appendTimer(
                    $summary['cropTimeToFill'],
                        0,
                        false,
                        true
                ) : '-') . '</td>';
            } else {
                $content .= '<td class="max4 lc">' . ($summary['cropTimeToFill'] > 0 ? appendTimer($summary['cropTimeToFill']) : '-') . '</td>';
            }
            $content .= '</tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function showCulturePoints()
    {
        $m = new villageOverviewModel();
        $view = new PHPBatchView("dorf3/culturePoints");
        $content = &$view->vars['content'];
        $result = $m->getPlayerVillagesCulturePointsData($this->session->getPlayerId());
        $summary = [
            'totalCP'              => 0,
            'units'                => ['chiefs' => 0, 'settlers' => 0],
            'slots'                => ['filled' => 0, 'total' => 0],
            'totalCelebrationTime' => [0],
        ];

        $cache = Caching::getInstance();

        $TrainingHelper = new TrainingHelper();
        while ($row = $result->fetch_assoc()) {
            if(!($data = $cache->get("dorf3:showCulturePoints:{$row['kid']}"))){
                $data = [];
                $data['th_lvl'] = $m->getTHLevel($row['kid']);
                $data['units'] = $TrainingHelper->getExpansionUnits($row['kid']);
                $data['slots'] = $TrainingHelper->getSlots($row['kid']);
                $cache->set("dorf3:showCulturePoints:{$row['kid']}", $data, 600);
            }
            $summary['slots']['total'] += $data['slots']['maxSlots'];
            $summary['slots']['filled'] += $data['slots']['filledSlots'];

            $summary['units']['settlers'] += $data['units']['settlers'];
            $summary['units']['chiefs'] += $data['units']['chiefs'];

            if ($data['th_lvl'] > 0 && $row['celebration'] >= time()) {
                $summary['totalCelebrationTime'][] = $row['celebration'];
            }
            $cp = Formulas::isGrayArea($row['kid']) ? 0 : $row['cp'];
            $summary['totalCP'] += $cp;
            $content .= '<tr class="' . ($row['kid'] == $this->session->getKid() ? 'hl' : 'hover') . '">';
            $content .= '<td class="vil fc"><a href="dorf1.php?newdid=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $content .= '<td class="cps">' . $cp . '</td>';
            $content .= '<td class="cel">';
            $content .= $data['th_lvl'] > 0 ? '<a href="build.php?newdid=' . $row['kid'] . '&amp;gid=24">' . ($row['celebration'] >= time() ? appendTimer($row['celebration'] - time()) : '<span class="dot">●</span>') . '</a>' : '<span class="errorMessage">-</span>';
            $content .= '</td>';
            $content .= '<td class="tro">';
            for ($i = 1; $i <= $data['units']['settlers']; ++$i) {
                $unitId = nrToUnitId(10, $this->session->getRace());
                $content .= '<img class="unit u' . $unitId . '" src="img/x.gif" alt="' . T("Troops", "{$unitId}.title") . '" title="' . T("Troops", "{$unitId}.title") . '">';
            }
            for ($i = 1; $i <= $data['units']['chiefs']; ++$i) {
                $unitId = nrToUnitId(9, $this->session->getRace());
                $content .= '<img class="unit u' . $unitId . '" src="img/x.gif" alt="' . T("Troops", "{$unitId}.title") . '" title="' . T("Troops", "{$unitId}.title") . '">';
            }
            if (array_sum($data['units']) == 0) {
                $content .= '<span class="errorMessage">-</span>';
            }
            $content .= '</td>';

            $content .= '<td class="slo lc">' . $data['slots']['filledSlots'] . '/' . $data['slots']['maxSlots'] . '</td>';
            $content .= '</tr>';
        }
        $view->vars['summary'] = $summary;
        $this->view->vars['content'] .= $view->output();
    }

    private function showTroops()
    {
        $view = new PHPBatchView("dorf3/troops");
        $view->vars['tooLargeTroops'] = getGameSpeed() > 500;
        $content = &$view->vars['content'];
        if (!isset($_GET['su'])) {
            $_GET['su'] = 0;
        }
        $view->vars['selectedTab'] = (int)$_GET['su'];
        $m = new villageOverviewModel();
        if ($view->vars['selectedTab'] == 0) {
            $summary = [];
            $view->vars['units'] = '';
            for ($i = 1; $i <= 11; ++$i) {
                if ($i == 11) {
                    $unitId = 'hero';
                } else {
                    $unitId = nrToUnitId($i, $this->session->getRace());
                }
                $title = T("Troops", "$unitId.title");
                $view->vars['units'] .= '<td><img class="unit u' . $unitId . '" src="img/x.gif" title="' . $title . '" alt="' . $title . '" /></td>';
            }
            $result = $this->getPlayerVillages();
            foreach ($result as $row) {
                $content .= '<tr class="' . ($row['kid'] == $this->session->getKid() ? 'hl' : 'hover') . '">';
                $content .= '<td class="vil fc"><a href="dorf1.php?newdid=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
                $totalUnits = [];
                $unitsHome = $m->getUnits($row['kid']);
                for ($i = 1; $i <= 11; $i++) {
                    if (!isset($totalUnits[$i])) {
                        $totalUnits[$i] = 0;
                    }
                    if (!isset($summary[$i])) {
                        $summary[$i] = 0;
                    }
                    $totalUnits[$i] += $unitsHome['u' . $i];
                    $summary[$i] += $unitsHome['u' . $i];
                }
                $unitsOnTheWayGo = $m->getGoingUnits($row['kid']);
                while ($b = $unitsOnTheWayGo->fetch_assoc()) {
                    for ($i = 1; $i <= 11; $i++) {
                        $totalUnits[$i] += $b['u' . $i];
                        $summary[$i] += $b['u' . $i];
                    }
                }
                $unitsOnTheWayBack = $m->getReturningUnits($row['kid']);
                while ($b = $unitsOnTheWayBack->fetch_assoc()) {
                    for ($i = 1; $i <= 11; $i++) {
                        $totalUnits[$i] += $b['u' . $i];
                        $summary[$i] += $b['u' . $i];
                    }
                }
                $enforcedUnits = $m->getOutEnforcement($row['kid']);
                while ($b = $enforcedUnits->fetch_assoc()) {
                    for ($i = 1; $i <= 11; $i++) {
                        $totalUnits[$i] += $b['u' . $i];
                        $summary[$i] += $b['u' . $i];
                    }
                }
                $trappedUnits = $m->getOutTrappedUnits($row['kid']);
                while ($b = $trappedUnits->fetch_assoc()) {
                    for ($i = 1; $i <= 11; $i++) {
                        $totalUnits[$i] += $b['u' . $i];
                        $summary[$i] += $b['u' . $i];
                    }
                }
                for ($i = 1; $i <= 11; ++$i) {
                    if ($totalUnits[$i]) {
                        $content .= '<td class="' . ($i == 11 ? 'lc' : '') . '" ' . $this->getStyle() . '>' . $this->number_format($totalUnits[$i]) . '</td>';
                    } else {
                        $content .= '<td class="none ' . ($i == 11 ? 'lc' : '') . '">0</td>';
                    }
                }
                $content .= '</tr>';
            }
            $view->vars['summary'] = '';
            $view->vars['summaryLarge'] = false;
            for ($i = 1; $i <= 11; ++$i) {
                if (!$view->vars['summaryLarge']) {
                    $view->vars['summaryLarge'] = $summary[$i] > 100000;
                }
                if ($summary[$i]) {
                    $view->vars['summary'] .= '<td>' . $this->number_format($summary[$i]) . '</td>';
                } else {
                    $view->vars['summary'] .= '<td class="none">0</td>';
                }
            }
        } elseif ($view->vars['selectedTab'] == 1) {
            $result = $this->getPlayerVillages();
            foreach ($result as $row) {
                $hdp = $this->getHDP($row['kid']);
                $effect = 1;
                if (Village::getInstance()->isWW() && ArtefactsModel::wwPlansReleased()) {
                    $effect = 1 / 2;
                }
                $effect *= ArtefactsModel::getArtifactEffectByType($this->session->getPlayerId(), $row['kid'], ArtefactsModel::ARTIFACT_DIET);
                $content .= $this->renderVillageTroops(
                    $row['kid'],
                    $this->session->getRace(),
                    array_filter_units($m->getUnits($row['kid'])),
                    $hdp,
                    $effect
                );
                $units = $m->getVillageEnforcements($row['kid']);
                while ($b = $units->fetch_assoc()) {
                    $content .= $this->renderVillageTroops(
                        $b['kid'],
                        $b['race'],
                        array_filter_units($b),
                        $hdp,
                        $effect
                    );
                }
            }
        } elseif ($view->vars['selectedTab'] == 2) {
            $armory = new PHPBatchView("dorf3/armory");
            $armory->vars['curKid'] = $this->session->getSelectedVillageID();
            $armory->vars['villages'] = [];
            $result = $this->getPlayerVillages();
            foreach ($result as $row) {
                $armory->vars['villages'][] = [
                    'kid'                 => $row['kid'],
                    'name'                => $row['name'],
                    'research_level'      => $m->getArmory($row['kid']),
                    'research_inProgress' => $m->getArmoryProgress($row['kid']),
                ];
            }
            $content .= $armory->output();
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function getStyle()
    {
        if (!getDisplay("smallTroopsNumFontSize")) {
            return null;
        }
        return 'style="font-size: 11px;"';
    }

    public function getHDP($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$kid}");
        if (!$buildings->num_rows) {
            return 0;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 41) {
                return $buildings['f' . $i];
            }
        }
        return 0;
    }

    public function renderVillageTroops($kid, $race, $units, $hdp, $effect)
    {
        return PHPBatchView::render(
            "dorf3/vil_troops",
            [
                'kid'    => $kid,
                'name'   => (new villageOverviewModel())->getVillageName($kid),
                'race'   => $race,
                'units'  => $units,
                'upkeep' => $this->getTotalCropConsumption($race, $units, $hdp, $effect),
            ]
        );
    }

    public function getTotalCropConsumption($race, $units, $hdp, $effect = 1)
    {
        if ($race == 4) {
            return 0;
        }
        $total = 0;
        foreach ($units as $nr => $amount) {
            if ($nr <= 10) {
                $unitId = nrToUnitId($nr, $race);
            } else {
                $unitId = 98;
            }
            $total += $amount * Formulas::uUpkeep($unitId, $hdp);
        }

        return $total * $effect;
    }

    private function allowed()
    {
        return $this->session->hasPlus() || $this->isAdmin;
    }
}
