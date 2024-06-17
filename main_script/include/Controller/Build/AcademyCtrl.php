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
use function logError;
use Model\Quest;
use function nrToUnitId;
use resources\View\PHPBatchView;
use function unitIdToNr;

class AcademyCtrl extends AnyCtrl
{
    private $technology;
    private $researching = [];
    private $researches = [];
    private $building_level;

    public function __construct($index)
    {
        parent::__construct();

        $this->building_level = Village::getInstance()->getField($index)['level'];
        $this->view = new PHPBatchView("build/Academy");
        $this->view->vars['villageName'] = Village::getInstance()->getName();
        $db = DB::getInstance();
        $technology = $db->query("SELECT * FROM tdata WHERE kid=" . Village::getInstance()->getKid())->fetch_assoc();
        for($i = 2; $i <= 9; ++$i) {
            $this->technology[$i] = $technology['u' . $i] == 1;
        }
        $this->fetchResearches();
        $this->prepare();
        if(isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker() && !$this->isResearching2()) {
            if(Session::getInstance()->banned()) {
                $this->innerRedirect("InGameBannedPage");
            } else if(Config::getInstance()->dynamic->serverFinished) {
                $this->innerRedirect("InGameWinnerPage");
            } else if(Session::getInstance()->isInVacationMode()) {
                $this->redirect('options.php?s=4');
            } else {
                $_GET['a'] = (int)$_GET['a'];
                if(isset($this->researches['available'][unitIdToNr($_GET['a'])])) {
                    $costs = Formulas::uResearchCost($_GET['a']);
                    $duration = Formulas::uResearchTime($_GET['a']);
                    if(Village::getInstance()->isResourcesAvailable($costs)) {
                        $quest = Quest::getInstance();
                        $quest->setQuestBitwise('battle', 12, 1);
                        $db->query("INSERT INTO research (`kid`, `mode`, `nr`, `end_time`) VALUES (" . Village::getInstance()->getKid() . ", 1, " . unitIdToNr($_GET['a']) . ", " . (time() + $duration) . ")");
                        Village::getInstance()->modifyResources($costs);
                        --$this->view->vars['availableSize'];
                        unset($this->researches['available'][unitIdToNr($_GET['a'])]);
                    }
                }
            }
            Session::getInstance()->changeChecker();
        }
        $this->getResearches();
        $this->getAvailableResearches($index);
        $this->getSoonAvailableResearches();
        $helper = new GoldHelper();
        $this->view->vars['finishNowButton'] = $helper->finishNowButton();
        if(!sizeof($this->researches['available'])) {
            $this->view->vars['researchAllButton'] = null;
        } else {
            $this->view->vars['researchAllButton'] = ExtraModules::showButton("academyResearchAll");
        }
    }

    private function fetchResearches()
    {
        $this->researching = [];
        $db = DB::getInstance();
        $researching = $db->query("SELECT * FROM research WHERE mode=1 AND kid=" . Village::getInstance()->getKid());
        while($row = $researching->fetch_assoc()) {
            $this->researching[$row['nr']] = $row;
        }
        $this->view->vars['researchingSize'] = sizeof($this->researching);
    }

    private function getAvailableResearches($index)
    {
        $village = Village::getInstance();
        $this->view->vars['availableResearches'] = '';
        $_template = new PHPBatchView("build/AcademyResearch");
        $size = sizeof($this->researches['available']);
        $helper = new GoldHelper();
        foreach($this->researches['available'] as $nr) {
            --$size;
            $unitId = nrToUnitId($nr, Session::getInstance()->getRace());
            $costs = Formulas::uResearchCost($unitId);
            $duration = Formulas::uResearchTime($unitId);
            $npc = '';
            if($this->isResearching2()) {
                $contractLink = '<div class="errorMessage">' . T("Academy", "one_research_is_going") . '</div>';
            } else if($village->isResourcesAvailable($costs)) {
                $contractLink = getButton(["type" => "button", "class" => "green", "value" => T("Academy", "research"), "onclick" => "window.location.href = 'build.php?id=" . $index . "&a=" . $unitId . "&c=" . Session::getInstance()->getChecker() . "'; return false;",], ["data" => ["type" => "button"]], T("Academy", "research"));
            } else {
                $contractLink = $village->contractResourcesLink($costs);
                if($contractLink['code'] == -1) {
                    $npc = $helper->getExchangeResourcesButtonByCost($costs);
                }
                $contractLink = $contractLink['text'];
            }
            $_template->vars = ["unitId" => $unitId, "cost" => $costs, "duration" => $duration, "NPCButton" => $npc, "contractLink" => $contractLink];
            $this->view->vars['availableResearches'] .= $_template->output();
            if($size) {
                $this->view->vars['availableResearches'] .= '<hr />';
            }
        }
    }

    private function getSoonAvailableResearches()
    {
        $this->view->vars['soonAvailableResearches'] = '';
        $_template = new PHPBatchView("build/AcademyResearch");
        $size = sizeof($this->researches['soon']);
        foreach($this->researches['soon'] as $nr) {
            --$size;
            $unitId = nrToUnitId($nr, Session::getInstance()->getRace());
            $costs = Formulas::uResearchCost($unitId);
            $duration = Formulas::uResearchTime($unitId);
            $breq = Formulas::uResearchPreRequests(Session::getInstance()->getRace(), $nr);
            $requirements = '';
            $size2 = sizeof($breq);
            foreach($breq as $bid => $level) {
                --$size2;
                $rLevel = Village::getInstance()->getTypeLevel($bid);
                $title = $rLevel > $level ? '>' : ($rLevel == $level ? "=" : "+" . ($level - $rLevel));
                $requirements .= '<a href="#" onclick="return Travian.Game.iPopup(' . $bid . ', 4, \'gid\');">' . T("Buildings", $bid . ".title") . ' </a>';
                $requirements .= '<span class="level" title="' . $title . '">' . T("Buildings", "level") . ' ' . $level . '</span>';
                if($size2) {
                    $requirements .= ', ';
                }
            }
            $_template->vars = ["unitId" => $unitId, "cost" => $costs, "duration" => $duration, "requirements" => $requirements];
            $this->view->vars['soonAvailableResearches'] .= $_template->output();
            if($size) {
                $this->view->vars['soonAvailableResearches'] .= '<hr />';
            }
        }
    }

    private function getResearches()
    {
        $this->fetchResearches();
        $researches = $this->researching;
        $this->view->vars['researchingTableBody'] = '';
        foreach($researches as $row) {
            $u = nrToUnitId($row['nr'], Session::getInstance()->getRace());
            $this->view->vars['researchingTableBody'] .= '<tr>';
            $this->view->vars['researchingTableBody'] .= '<td class="desc"><img class="unit u' . $u . '" src="img/x.gif" alt="' . T("Troops", "{$u}.title") . '" title="' . T("Troops", "{$u}.title") . '">' . T("Troops", "{$u}.title") . '</td>';
            $this->view->vars['researchingTableBody'] .= '<td class="dur">' . appendTimer($row['end_time'] - time()) . '</td>';
            $this->view->vars['researchingTableBody'] .= '<td class="fin"><span>' . TimezoneHelper::date("H:i", $row['end_time']) . '</span><span> </span></td>';
            $this->view->vars['researchingTableBody'] .= '</tr>';
        }
    }

    private function prepare()
    {
        $researches = ["available" => [], "soon" => []];
        foreach($this->technology as $u => $v) {
            if($v) {
                continue;
            }
            if($this->isResearching($u)) {
                continue;
            }
            $breq = Formulas::uResearchPreRequests(Session::getInstance()->getRace(), $u);
            $researches[$this->_canDoResearch($breq) ? "available" : "soon"][$u] = $u;
        }
        $this->view->vars['availableSize'] = sizeof($researches['available']);
        $this->view->vars['soonAvailableSize'] = sizeof($researches['soon']);
        $this->researches = $researches;
    }

    private function isResearching($nr)
    {
        return isset($this->researching[$nr]);
    }

    private function _canDoResearch($breq)
    {
        foreach($breq as $bid => $level) {
            if(max(Village::getInstance()->getTypeLevel($bid)) < $level) {
                return FALSE;
            }
        }
        return TRUE;
    }

    private function isResearching2()
    {
        return $this->view->vars['researchingSize'] > 0;
    }
}