<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Controller\BuildCtrl;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Game\Helpers\LoyaltyHelper;
use Game\Hero\HeroHelper;
use Core\Locale;
use Model\Quest;
use Model\VillageModel;
use resources\View\PHPBatchView;

class ResidencePalaceCtrl extends AnyCtrl
{
    private $building_id;

    public function __construct(BuildCtrl $build)
    {
        parent::__construct();

        $buildingInfo = Village::getInstance()->getField($build->selectedBuildingIndex);
        $this->building_id = $buildingInfo['item_id'];
        $this->view = new PHPBatchView("build/ResidencePalaceMenus");
        $this->view->vars['buildingIndex'] = $build->selectedBuildingIndex;
        $this->view->vars['content'] = '';
        $tabs = ['Management', 'Train', 'CulturePoints', 'Loyalty', 'Expansion',];
        foreach ($tabs as $tab) {
            $this->view->vars[$tab] = get_button_id();
        }
        $this->view->vars['favor'] = Session::getInstance()->getFavoriteTab("buildingExpansion");
        $this->view->vars['buildingLevel'] = $buildingInfo['level'];
        $this->view->vars['selectedTabId'] = isset($_REQUEST['s']) && $_REQUEST['s'] >= 0 && $_REQUEST['s'] <= 4 ? (int)$_REQUEST['s'] : Session::getInstance()->getFavoriteTab("buildingExpansion");
        $this->view->vars['favorText'] = sprintf(T('ResidencePalace', 'Select x as favor tab'), T("ResidencePalace", $tabs[$this->view->vars['selectedTabId']]));
        if ($this->view->vars['selectedTabId'] == 0 || $buildingInfo['level'] <= 0) {
            $this->view->vars['content'] .= $build->getBuildingContract();
            if ($this->building_id == 26 && $buildingInfo['level'] >= 1) {
                $view = new PHPBatchView("build/changeCapital");
                $view->vars['showForm'] = FALSE;
                $view->vars['error'] = '';
                if (isset($_REQUEST['change_capital']) && !Village::getInstance()->isCapital() && !Village::getInstance()->isWW()) {
                    if (isset($_POST['pw'])) {
                        if (sha1($_POST['pw']) == $_SESSION[Session::getInstance()->fixSessionPrefix('pw')]) {
                            $view->vars['showForm'] = FALSE;
                            $villageModel = new VillageModel();
                            $villageModel->changeCapital(Session::getInstance()->getPlayerId(), Session::getInstance()->getKid());
                            Village::getInstance()->setCapital(1);
                        } else {
                            $view->vars['showForm'] = TRUE;
                            $view->vars['error'] = T("ResidencePalace", "wrongPass");
                        }
                    } else {
                        $view->vars['showForm'] = TRUE;
                    }
                }
                $view->vars['isCapital'] = Village::getInstance()->isCapital();
                $view->vars['isWW'] = Village::getInstance()->isWW();
                $view->vars['checker'] = Session::getInstance()->getChecker();
                $this->view->vars['content'] .= $view->output();
            }
        } else if ($this->view->vars['selectedTabId'] == 1) {
            $dispatcher = new TroopBuilding($build->selectedBuildingIndex);
            $this->view->vars['content'] .= $dispatcher->render();
        } else if ($this->view->vars['selectedTabId'] == 2) {
            $this->culturePoints();
        } else if ($this->view->vars['selectedTabId'] == 3) {
            $this->loyalty($build->selectedBuildingIndex);
        } else if ($this->view->vars['selectedTabId'] == 4) {
            $this->expansion();
        }
    }

    private function culturePoints()
    {
        Quest::getInstance()->setQuestBitwise('world', 11, 1);
        $view = new PHPBatchView("build/expansionCulturePoints");
        $db = DB::getInstance();
        $villages = $db->query("SELECT SUM(cp) AS `total_cp`, COUNT(kid) `total_village_count`  FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId())->fetch_assoc();
        $view->vars['total_villages'] = $villages['total_village_count'];
        
        $currentCP = Session::getInstance()->getCP();
        $i = Formulas::countCPVillages($currentCP);
        $newVillageCP = Formulas::newVillageCP($i + 1);

        $helmet = $db->fetchScalar("SELECT helmet FROM inventory WHERE uid=" . Session::getInstance()->getPlayerId());
        $view->vars['max_village_count'] = $i;
        $view->vars['curCP'] = $currentCP;
        $view->vars['nextCP'] = $newVillageCP;
        $view->vars['activeVillageCP'] = Village::getInstance()->getCP();
        $view->vars['otherVillageCP'] = $villages['total_cp'] - Village::getInstance()->getCP();
        $view->vars['hasAlliance'] = Session::getInstance()->getAllianceId() > 0;
        $view->vars['allianceBonus'] = !$view->vars['hasAlliance'] ? 1 : AllianceBonus::getCulturePointProductionBonus(
            Session::getInstance()->getAllianceId(),
            Session::getInstance()->getAllianceJoinTime()
        );
        $helper = new HeroHelper();
        $view->vars['heroCP'] = $helper->calcMoreCulturePoints($helmet);
        $totalInSecond = ($view->vars['activeVillageCP'] + $view->vars['otherVillageCP'] + $view->vars['heroCP']) / 86400;
        $totalInSecond = min($totalInSecond, 1e8);
        if($totalInSecond == 0){
            $view->vars['date'] = '?';
        } else {
            $view->vars['date'] = TimezoneHelper::autoDate(time() + (($newVillageCP - $currentCP) / $totalInSecond), TRUE);
        }
        $view->vars['needCP'] = $newVillageCP - $currentCP;
        $this->view->vars['content'] .= $view->output();
    }

    private function loyalty($index)
    {
        //TODO: cache
        $view = new PHPBatchView("build/loyaltyTab");
        $view->vars['loyalty'] = round(Village::getInstance()->getLoyalty());
        $view->vars['content'] = NULL;
        $db = DB::getInstance();
        LoyaltyHelper::updateUserVillagesLoyalty(Session::getInstance()->getPlayerId());
        $villages = $db->query("SELECT kid, loyalty, pop, name FROM vdata WHERE owner=" . Session::getInstance()->getPlayerId());
        while ($row = $villages->fetch_assoc()) {
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<th><a href="?id=' . $index . '&amp;s=3&amp;gid=' . $this->building_id . '&amp;newdid=' . $row['kid'] . '">' . $row['name'] . '</a></th>';
            $view->vars['content'] .= '<td>' . $row['pop'] . '</td>';
            if ($row['loyalty'] > 100) {
                $class = 'high';
            } else if ($row['loyalty'] <= 50 || $row['loyalty'] == 100) {
                $class = 'medium';
            } else {
                $class = 'low';
            }
            $view->vars['content'] .= '<td class="' . $class . '">' . round($row['loyalty']) . '%‬‎</td>';
            $view->vars['content'] .= '</tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function expansion()
    {
        $view = new PHPBatchView("build/Expansion");
        $view->vars['content'] = '';
        $db = DB::getInstance();
        $villages = $db->query("SELECT kid, pop, name, created FROM vdata WHERE expandedfrom=" . Village::getInstance()->getKid() . " ORDER BY created ASC");
        $rank = 0;
        $direction = strtolower(getDirection());
        while ($row = $villages->fetch_assoc()) {
            ++$rank;
            $xy = Formulas::kid2xy($row['kid']);
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td class="ra">' . $rank . '.</td>';
            $view->vars['content'] .= '<td class="vil"><a href="karte.php?d=' . $row['kid'] . '">' . $row['name'] . '</a></td>';
            $view->vars['content'] .= '<td class="pla"><a href="spieler.php?uid=' . Session::getInstance()->getPlayerId() . '">' . Session::getInstance()->getName() . '</a></td>';
            $view->vars['content'] .= '<td class="ha">' . $row['pop'] . '</td>';
            $view->vars['content'] .= '<td class="coords"><a class="" href="karte.php?x=' . $xy['x'] . '&amp;y=' . $xy['y'] . '">‎‭<span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(' . $xy['x'] . '‬‬</span><span class="coordinatePipe">|</span><span class="coordinateY">‭' . $xy['y'] . '‬‬)</span></span>‬‎</a></td>';
            $view->vars['content'] .= '<td class="dat">' . TimezoneHelper::autoDate($row['created'], FALSE) . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (empty($view->vars['content'])) {
            $view->vars['content'] = '<tr><td colspan="6" class="noData">' . T("ResidencePalace", "noExpansion") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
    }
}