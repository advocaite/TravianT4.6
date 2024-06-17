<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\ExtraModules;
use Game\Formulas;
use Game\GoldHelper;
use Core\Locale;
use Model\Quest;
use resources\View\PHPBatchView;

class SmithyCtrl extends AnyCtrl
{
    private $smithy = [];
    private $researches = [];
    private $researchLevels = [];
    private $smithyCapacity = 1;

    public function __construct($index)
    {
        parent::__construct();

        if (Session::getInstance()->hasPlus()) $this->smithyCapacity = 2;
        $this->building_lvl = Village::getInstance()->getField($index)['level'];
        $this->view = new PHPBatchView("build/SmithyLayout");
        $this->getSmithy();
        $this->getSmithyResearches();
        if (!$this->isResearchFull() && isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker()) {
            if (Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if (Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if (Session::getInstance()->isInVacationMode()) {
                $this->redirect('options.php?s=4');
            } else {
                $nr = unitIdToNr((int)$_GET['a']);
                if (
                    isset($this->smithy[$nr]) &&
                    (($this->smithy[$nr] + $this->getResearchLevel($nr)) < 20) &&
                    (($this->smithy[$nr] + $this->getResearchLevel($nr) + 1) <= $this->building_lvl)
                ) {
                    $unitId = nrToUnitId($nr, Session::getInstance()->getRace());
                    $costs = Formulas::uUpgradeCost($unitId, $this->smithy[$nr] + $this->getResearchLevel($nr) + 1);
                    $duration = Formulas::uUpgradeTime($unitId, $this->smithy[$nr] + $this->getResearchLevel($nr) + 1, $this->building_lvl);
                    $db = DB::getInstance();
                    if ($this->isResearch()) {
                        $lastResearch = $db->fetchScalar("SELECT end_time FROM research WHERE kid=" . Village::getInstance()->getKid() . " AND mode=0");
                        if ($lastResearch !== false) {
                            $duration += $lastResearch - time();
                        }
                    }
                    if (Village::getInstance()->isResourcesAvailable($costs) && Village::getInstance()->modifyResources($costs)) {
                        $quest = Quest::getInstance();
                        $quest->setQuestBitwise('battle', 14, 1);
                        $db = DB::getInstance();
                        $db->query("INSERT INTO research (`kid`, `mode`, `nr`, `end_time`) VALUES (" . Village::getInstance()->getKid() . ", 0, " . $nr . ", " . (time() + $duration) . ")");
                        $this->getSmithyResearches();
                    }
                }
            }
            Session::getInstance()->changeChecker();
            $this->redirect('build.php?id=' . $index);
        }
        $this->getSmithyWrapper($index);
        $helper = new GoldHelper();
        $this->view->vars['finishNowButton'] = $helper->finishNowButton();
        if (array_sum($this->smithy) == (sizeof($this->smithy)) * 20) {
            $this->view->vars['upgradeAllButton'] = null;
        } else {
            $this->view->vars['upgradeAllButton'] = ExtraModules::showButton("smithyUpgradeAllToMax");
        }
    }

    private $building_lvl;

    private function getResearchLevel($nr)
    {
        return isset($this->researchLevels[$nr]) ? $this->researchLevels[$nr] : 0;
    }

    private function getSmithyResearches()
    {
        $this->researches = [];
        $this->researchLevels = array_fill(1, 8, 0);
        $db = DB::getInstance();
        $kid = Village::getInstance()->getKid();
        $researches = $db->query("SELECT * FROM research WHERE kid={$kid} AND mode=0 ORDER BY end_time ASC");
        $this->view->vars['researchingSize'] = $researches->num_rows;
        $this->view->vars['researchingTableBody'] = '';
        while ($row = $researches->fetch_assoc()) {
            $this->researches[] = $row;
            $u = nrToUnitId($row['nr'], Session::getInstance()->getRace());
            $this->view->vars['researchingTableBody'] .= '<tr>';
            $this->view->vars['researchingTableBody'] .= '<td class="desc"><img class="unit u' . $u . '" src="img/x.gif" alt="' . T("Troops", "{$u}.title") . '" title="' . T("Troops", "{$u}.title") . '">' . T("Troops", "{$u}.title") . ' <span class="level">' . T("Buildings", "level") . ' ' . ($this->smithy[$row['nr']] + $this->getResearchLevel($row['nr']) + 1) . '</span></td>';
            $this->view->vars['researchingTableBody'] .= '<td class="dur">' . appendTimer($row['end_time'] - time()) . '</td>';
            $this->view->vars['researchingTableBody'] .= '<td class="fin"><span>' . TimezoneHelper::date("H:i", $row['end_time']) . '</span><span> </span></td>';
            $this->view->vars['researchingTableBody'] .= '</tr>';
            $this->researchLevels[$row['nr']]++;
        }
    }

    private function getSmithyWrapper($index)
    {
        $village = Village::getInstance();
        $this->view->vars['availableResearches'] = '';
        $_template = new PHPBatchView("build/SmithyResearch");
        $helper = new GoldHelper();
        $size = sizeof($this->smithy);
        foreach ($this->smithy as $nr => $cur_lvl) {
            --$size;
            $unitId = nrToUnitId($nr, Session::getInstance()->getRace());
            $lvl = $cur_lvl + $this->getResearchLevel($nr);
            $costs = Formulas::uUpgradeCost($unitId, $lvl + 1);
            $duration = Formulas::uUpgradeTime($unitId, $lvl + 1, $this->building_lvl);
            $npc = '';
            if ($lvl >= 20) {
                $contractLink = '<br /><span class="errorMessage">' . sprintf(T("Smithy", "reachedMaxLvl"), T("Troops", $unitId . ".title")) . '</span>';
            } else if ($lvl >= $this->building_lvl) {
                $contractLink = '<br /><span class="errorMessage">' . sprintf(T("Smithy", "upgradeSmithy"), T("Troops", $unitId . ".title")) . '</span>';
            } else if ($this->isResearchFull()) {
                $contractLink = '<span class="errorMessage">' . T("Smithy", "one_research_is_going") . '</span>';
            } else if ($village->isResourcesAvailable($costs)) {
                $contractLink = getButton([
                    "type" => "button",
                    "class" => "green",
                    "value" => T("Smithy", "improve"),
                    "onclick" => "window.location.href = 'build.php?id=" . $index . "&a=" . $nr . "&c=" . Session::getInstance()->getChecker() . "'; return false;",
                ],
                    ["data" => ["type" => "button"]],
                    T("Smithy", "improve"));
            } else {
                $contractLink = $village->contractResourcesLink($costs);
                if ($contractLink['code'] == -1) {
                    $npc = $helper->getExchangeResourcesButtonByCost($costs);
                }
                $contractLink = $contractLink['text'];
            }
            if ($lvl < 20 && Config::getInstance()->extraSettings->smithyMaxLevel->enabled) {
                $contractLink .= '<br /><br />' . ExtraModules::smithyMaxLevelButton($nr);
            }
            $_template->vars = [
                'lvl' => "$cur_lvl" . ($this->getResearchLevel($nr) ? (' + ' . $this->getResearchLevel($nr)) : ''),
                "isMaxLvl" => ($lvl + $this->getResearchLevel($nr)) >= 20,
                "unitId" => $unitId,
                "cost" => $costs,
                "duration" => $duration,
                "NPCButton" => $npc,
                "contractLink" => $contractLink,
            ];
            $this->view->vars['availableResearches'] .= $_template->output();
            if ($size) {
                $this->view->vars['availableResearches'] .= '<hr />';
            }
        }
    }

    private function isResearch()
    {
        return sizeof($this->researches);
    }

    private function isResearchFull()
    {
        return sizeof($this->researches) >= $this->smithyCapacity;
    }

    private function getSmithy()
    {
        $this->smithy = [];
        $db = DB::getInstance();
        $smithy = $db->query("SELECT * FROM smithy WHERE kid=" . Village::getInstance()->getKid())->fetch_assoc();
        $technology = $db->query("SELECT * FROM tdata WHERE kid=" . Village::getInstance()->getKid())->fetch_assoc();
        for ($i = 1; $i <= 8; ++$i) {
            if ($i > 1 && !$technology['u' . $i] == 1) {
                continue;
            }
            $this->smithy[$i] = $smithy['u' . $i];
        }
    }
} 