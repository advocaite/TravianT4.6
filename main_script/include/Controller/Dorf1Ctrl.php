<?php

namespace Controller;

use Core\Config;
use Core\Dispatcher;
use Core\Helper\PreferencesHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\Formulas;
use function getDifMilisecondsToSeconds;
use Model\Dorf1Model;
use PDO;
use resources\View\GameView;
use resources\View\PHPBatchView;

class Dorf1Ctrl extends GameCtrl
{
    private $dorf1View;
    private $field_maps = [
        "RTL" => [
            "coordinates" => [
                1 =>
                    "277,88,28",
                "187,89,28",
                "119,101,28",
                "335,127,28",
                "222,140,28",
                "165,147,28",
                "80,145,28",
                "395,178,28",
                "314,179,28",
                "124,179,28",
                "37,179,28",
                "387,239,28",
                "314,229,28",
                "178,265,28",
                "56,234,28",
                "283,319,28",
                "192,324,28",
                "102,301,28",
                "217,191,32"
            ],
            "styles"      => [
                1 =>
                    "right:179px;top:78px",
                "right:269px;top:79px",
                "right:337px;top:91px",
                "right:121px;top:117px",
                "right:234px;top:130px",
                "right:291px;top:137px",
                "right:376px;top:135px",
                "right:61px;top:168px",
                "right:142px;top:169px",
                "right:332px;top:169px",
                "right:419px;top:169px",
                "right:69px;top:229px",
                "right:142px;top:219px",
                "right:278px;top:255px",
                "right:400px;top:224px",
                "right:173px;top:309px",
                "right:264px;top:314px",
                "right:354px;top:291px"
            ]
        ],
        "LTR" => [
            "coordinates" => [
                1 =>
                    "137,88,28",
                "227,89,28",
                "295,101,28",
                "79,127,28",
                "192,140,28",
                "249,147,28",
                "334,145,28",
                "19,178,28",
                "100,179,28",
                "290,179,28",
                "377,179,28",
                "27,239,28",
                "100,229,28",
                "236,265,28",
                "358,234,28",
                "131,319,28",
                "222,324,28",
                "312,301,28",
                "197,191,32"
            ],
            "styles"      => [
                1 =>
                    "left: 179px; top:78px;",
                "left: 269px; top:79px;",
                "left: 337px; top:91px;",
                "left: 121px; top:117px;",
                "left: 234px; top:130px;",
                "left: 291px; top:137px;",
                "left: 376px; top:135px;",
                "left: 61px; top:168px;",
                "left: 142px; top:169px;",
                "left: 332px; top:169px;",
                "left: 419px; top:169px;",
                "left: 69px; top:229px;",
                "left: 142px; top:219px;",
                "left: 278px; top:255px;",
                "left: 400px; top:224px;",
                "left: 173px; top:309px;",
                "left: 264px; top:314px;",
                "left: 354px; top:291px;"
            ]
        ]
    ];

    public function __construct()
    {
        parent::__construct();
        if (WebService::isPost()) {
            if (!isset($_POST['reCaptchaVerify'])) {
                $this->innerRedirect("LoginCtrl");
            }
        }
        if ($this->session->hasPublicMsg() && !$this->session->isAdminInAnotherAccount()) {
            if (isset($_GET['ok'])) {
                $this->session->updatePublicMsg(0);
            } else {
                $this->innerRedirect("PublicMsgCtrl");
            }
        }
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'village1';
        if ($this->session->getPlayerId() <= 0) return;
        if (!$this->proc()) {
            return;
        }
        $m = new Dorf1Model();
        $this->dorf1View = new PHPBatchView("dorf1/main");
        $this->areaMapsAction();
        $this->unitsAction($m);
        $this->movementsAction($m);
        $session = $this->session;
        $this->dorf1View->vars['onLoadBuildings'] = Dispatcher::getInstance()->dispatch("onLoadBuildingsDorfCtrl",
            FALSE);
        $this->dorf1View->vars['production'] = $this->session->village->getProduction();
        $this->dorf1View->vars['productionBoost'] = [
            $session->hasProductionBoost(1),
            $session->hasProductionBoost(2),
            $session->hasProductionBoost(3),
            $session->hasProductionBoost(4),
        ];
        $this->dorf1View->vars['goldProductionBoostButton'] = getButton([
            "type"  => "button",
            "class" => "gold productionBoostButton",
            "title" => T("Dorf1",
                'production.productionBoostButton'),
        ],
            [
                "data" => [
                    "name"                  => '',
                    "onclick"               => '',
                    "confirm"               => '',
                    'productionBoostDialog' => ['infoIcon' => 'http://t4.answers.travian.ir/index.php?aid=0#go2answer',],
                ],
            ],
            '+25%');
        $this->view->vars['content'] = $this->dorf1View->output();
    }

    private function proc()
    {
        if (!isset($_GET['a']) || !isset($_GET['c'])) {
            return TRUE;
        }
        $session = $this->session;
        $c = filter_var($_GET['c'], FILTER_SANITIZE_STRING);
        if ($c != $session->getChecker()) {
            return TRUE;
        }
        $session->changeChecker();
        $village = $this->session->village;
        if (!isset($_GET['id'])) {
            if ((int)$_GET['a'] === 0) {
                $village->removeBuilding((int)$_GET['d']);
            } else {
                $village->upgradeBuilding($_GET['a'], isset($_GET['b']) && (int)$_GET['b'] === 1);
            }
        } else {
            if ($village->isWW() && $_GET['id'] == '99' && $_GET['a'] == 40) {
                $village->upgradeBuilding(99, (int)$_GET['b'] === 1);
            } else {
                $village->constructBuilding((int)$_GET['id'],  (int)$_GET['a'], isset($_GET['b']) && (int)$_GET['b'] === 1);
            }
        }
        if ($this->session->banned()) {
            new BannedCtrl($this->view->vars['contentCssClass'], $this->view->vars['content']);
            return FALSE;
        } else if (Config::getInstance()->dynamic->serverFinished) {
            new WinnerCtrl($this->view->vars['contentCssClass'], $this->view->vars['content']);
            return FALSE;
        }
        return TRUE;
    }

    private function areaMapsAction()
    {
        $direction = getDirection();
        $village = $this->session->village;
        $this->dorf1View->vars['fieldType'] = $village->getFieldType();
        $this->dorf1View->vars['showColored'] = PreferencesHelper::getPreference("t4level") == 0;
        for ($i = 1; $i <= 18; ++$i) {
            $max = Formulas::buildingMaxLvl($village->getField($i)['item_id'], $village->isCapital());
            $this->dorf1View->vars['areas'][] = [
                "coordinates" => $this->field_maps[$direction]['coordinates'][$i],
                "title"       => $village->getFieldTitleAsString($i),
                'alt'         => T("Buildings", "{$village->getField($i)['item_id']}.title") . ' ' . T("Buildings", "level") . ' ' . $village->getField($i)['level'] . '.',
            ];
            if ($village->getField($i)['level'] >= $max || ($village->getField($i)['level'] + $village->getField($i)['upgrade_state']) == $max) {
                $color = 'maxLevel';
            } else {
                $item_id = $village->getField($i)['item_id'];
                $lvl = $village->getField($i)['level'] + $village->getField($i)['upgrade_state'] + 1;
                $cost = Formulas::buildingUpgradeCosts($item_id, $lvl);

                if($village->checkArtifactDependencies($item_id) <> 0 || $village->checkDependencies($item_id, $lvl) <> 0){
                    $color = 'dependencies';
                } else if($village->isWorkersBusy(TRUE)['isBusy'] || !$village->isResourcesAvailable($cost)) {
                    $color = 'notNow';
                }else {
                    $color = 'good';
                }
            }
            $this->dorf1View->vars['maps'][] = [
                "color"        => $color,
                "item_id"      => $village->getField($i)['item_id'],
                "level"        => $village->getField($i)['level'],
                "upgradeState" => $village->getField($i)['upgrade_state'],
                "style"        => $this->field_maps[$direction]['styles'][$i],
            ];
        }
    }

    private function unitsAction(Dorf1Model $m)
    {
        $assoc_units = [];
        $animals = [];
        $kid = $this->session->village->getKid();
        $unitsSummary = 0;
        $units = $m->getUnits($kid);
        if(!$units) return;
        foreach($units['units'] as $i => $num) {
            if ($num <= 0) {
                continue;
            }
            $unitsSummary += $num;
            if (!isset($assoc_units[nrToUnitId($i, $units['race'])])) {
                $assoc_units[nrToUnitId($i, $units['race'])] = 0;
            }
            $assoc_units[nrToUnitId($i, $units['race'])] += $num;
        }
        $enf = $m->getEnforcements($kid);
        while ($row = $enf->fetch(PDO::FETCH_ASSOC)) {
            for ($i = 1; $i <= 11; ++$i) {
                if (!$row['u' . $i]) {
                    continue;
                }
                $unitsSummary += $row['u' . $i];
                if ($row['race'] == 4) {
                    if (!isset($animals[nrToUnitId($i, $row['race'])])) {
                        $animals[nrToUnitId($i, $row['race'])] = 0;
                    }
                    $animals[nrToUnitId($i, $row['race'])] += $row['u' . $i];
                    continue;
                }
                if (!isset($assoc_units[nrToUnitId($i, $row['race'])])) {
                    $assoc_units[nrToUnitId($i, $row['race'])] = 0;
                }
                $assoc_units[nrToUnitId($i, $row['race'])] += $row['u' . $i];
            }
        }
        ksort($animals, SORT_NUMERIC);
        ksort($assoc_units, SORT_NUMERIC);
        $heroOnly = (array_sum($assoc_units) - (isset($assoc_units[98]) ? $assoc_units[98] : 0)) == 0;
        if (isset($assoc_units[98])) {
            $temp = [98 => $assoc_units[98]];
            unset($assoc_units[98]);
            $assoc_units = $temp + $assoc_units;
        }
        $assoc_units = $assoc_units + $animals;
        $this->dorf1View->vars['heroOnly'] = $heroOnly;
        $this->dorf1View->vars['unitsSummary'] = $unitsSummary;
        $this->dorf1View->vars['units'] = $assoc_units;
    }

    private function movementsAction(Dorf1Model $m)
    {
        $movements = [
            "numIncomingTroops" => 0,
            "inComingContent"   => '',
            "numOutGoingTroops" => 0,
            "outGoingContent"   => '',
        ];
        $oases = $m->getOasesAsString($this->session->village->getKid());
        if (!empty($oases)) {
            $result = $m->getIncomingAttacksToMyOases($oases);
            $movements['inComingContent'] .= $this->getMovementHTML($result['count'],
                T("Dorf1", "movements.attack"),
                T("Dorf1", "movements.incomingAttacksToMe"),
                "att3",
                "a3",
                getDifMilisecondsToSeconds($result['end_time']));
        }
        $kid = $this->session->village->getKid();
        $result = $m->getIncomingAttacksToMe($kid);
        $movements['inComingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.attack"),
            T("Dorf1", "movements.incomingAttacksToMe"),
            "att1",
            "a1",
            getDifMilisecondsToSeconds($result['end_time']));
        if (!is_null($oases)) {
            $result = $m->getIncomingReinforcementToMyOases($oases);
            $movements['inComingContent'] .= $this->getMovementHTML($result['count'],
                T("Dorf1", "movements.reinforcement"),
                T("Dorf1", "movements.incomingReinforcementsToMyOases"),
                "def3",
                "d3",
                getDifMilisecondsToSeconds($result['end_time']));
        }
        $result = $m->getIncomingReinforcementToMe($kid);
        $movements['inComingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.reinforcement"),
            T("Dorf1", "movements.incomingReinforcements"),
            "def1",
            "d1",
            getDifMilisecondsToSeconds($result['end_time']));
        $result = $m->getOutgoingAttacks($kid);
        $movements['outGoingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.attack"),
            T("Dorf1", "movements.outGoingAttacks"),
            "att2",
            "a2",
            getDifMilisecondsToSeconds($result['end_time']));
        $result = $m->getOutGoingReinforcements($kid);
        $movements['outGoingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.reinforcement"),
            T("Dorf1", "movements.outGoingReinforcements"),
            "def2",
            "d2",
            getDifMilisecondsToSeconds($result['end_time']));
        $result = $m->getOutgoingAdventure($kid);
        $movements['outGoingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.adventure"),
            T("Dorf1", "movements.outGoingAdventure"),
            "hero_on_adventure",
            "adventure",
            getDifMilisecondsToSeconds($result['end_time']));
        $result = $m->getOutgoingEvasion($kid);
        $movements['outGoingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.evasion"),
            T("Dorf1", "movements.outGoingEvasion"),
            "def2",
            "d2",
            getDifMilisecondsToSeconds($result['end_time']));
        $result = $m->getOutgoingSettlers($kid);
        $movements['outGoingContent'] .= $this->getMovementHTML($result['count'],
            T("Dorf1", "movements.settlers"),
            T("Dorf1", "movements.settlersOnTheWay"),
            "settlersOnTheWay",
            "settle",
            getDifMilisecondsToSeconds($result['end_time']));
        if (!empty($movements['outGoingContent'])) {
            $movements['numOutGoingTroops'] = 1;
        }
        if (!empty($movements['inComingContent'])) {
            $movements['numIncomingTroops'] = 1;
        }
        if (empty($movements['inComingContent']) && empty($movements['outGoingContent'])) {
            $this->dorf1View->vars['movements'] = '';
        } else {
            $this->dorf1View->vars['movements'] = PHPBatchView::render("dorf1/movements", $movements);
        }
    }

    private function getMovementHTML($count, $shortTitle, $typTitle, $attackType, $movementType, $duration)
    {
        if (!$count) {
            return FALSE;
        }
        $seconds = $duration;
        $duration = secondsToString($duration);
        $prefix = 'at';
        if ($attackType == 'settlersOnTheWay' || $attackType == "hero_on_adventure" || $attackType == "def2" || $attackType == "att2") {
            $prefix = 'tu';
        }
        $hour = T('Dorf1', "movements.hour");
        $in = T('Dorf1', "movements.in");
        return <<<HTML
<tr>
                        <td class="typ">
                            <a href="build.php?id=39&amp;tt=1#{$prefix}">
                                <img class="{$attackType}" alt="{$typTitle}" title="{$typTitle}" src="img/x.gif">
                            </a>
                        </td>
                        <td>
                            <div class="mov">
                                <span class="{$movementType}">{$count} {$shortTitle}</span>
                            </div>
                            <div class="dur_r"> {$in}<span class="timer" counting="down" value="{$seconds}">{$duration}</span> $hour.</div>
                        </td>
                    </tr>
HTML;
    }
}