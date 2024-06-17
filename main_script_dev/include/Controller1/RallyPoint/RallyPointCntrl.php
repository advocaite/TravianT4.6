<?php

namespace Controller\RallyPoint;

use Controller\AnyCtrl;
use Controller\BuildCtrl;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\Hero\SessionHero;
use Core\Locale;
use Game\ResourcesHelper;
use Model\AccountDeleter;
use Model\RallyPoint\RallyPointModel;
use Model\TrainingModel;
use Model\VillageModel;
use resources\View\PHPBatchView;

class RallyPointCntrl extends AnyCtrl
{
    private function trainTraps($kid, $count)
    {
        (new TrainingModel())->addTraining($kid, 36, 99, $count, Formulas::getTrapRepairTime());
    }

    public function __construct(BuildCtrl $build)
    {
        parent::__construct();
        $session = Session::getInstance();
        $tt = isset($_REQUEST['tt']) ? $_REQUEST['tt'] : $session->getFavoriteTab("buildingRallyPoint");
        if (!in_array($tt, [0, 1, 2, 3, 99])) {
            $tt = 0;
        }
        if (!$session->hasGoldClub() && $tt == 99) {
            $tt = 0;
        }
        if (isset($_GET['kill'])/* && Session::validateChecker()*/) {
            //delete trapped
            $db = DB::getInstance();
            $id = (int)$_GET['kill'];
            $kid = Session::getInstance()->getKid();
            $result = $db->query("SELECT * FROM trapped WHERE kid={$kid} AND id={$id}");
            if ($result->num_rows) {
                $result = $result->fetch_assoc();
                if ($db->query("DELETE FROM trapped WHERE kid={$kid} AND id={$id}") && $db->affectedRows()) {
                    $tt = 1;
                    if ($result['u11']) {
                        $db->query("UPDATE hero SET health=0 WHERE kid={$kid}");
                    }
                    ResourcesHelper::updateVillageResources(Session::getInstance()->getKid(), FALSE);
                    $traps_num = array_sum(array_filter_units($result));
                    $query = $db->query("UPDATE units SET u99=IF(u99-$traps_num > 0, u99-$traps_num, 0) WHERE kid={$result['to_kid']}");
                    if ($query && $db->affectedRows()) {
                        $this->trainTraps($result['to_kid'], $traps_num);
                    }
                }
            }
        }
        if (isset($_GET['free'])/* && Session::validateChecker()*/) {
            //delete trapped
            $db = DB::getInstance();
            $id = (int)$_GET['free'];
            $kid = Session::getInstance()->getKid();
            $find = $db->query("SELECT * FROM trapped WHERE to_kid=$kid AND id=$id");
            if ($find->num_rows) {
                $find = $find->fetch_assoc();
                $helper = new AccountDeleter();
                if ($helper->returnTrappedOrEnforcementRow($find, FALSE)) {
                    $traps_num = array_sum(array_filter_units($find));
                    $query = $db->query("UPDATE units SET u99=IF(u99-$traps_num > 0, u99-$traps_num, 0) WHERE kid={$find['to_kid']}");
                    if ($query && $db->affectedRows()) {
                        $this->trainTraps($find['to_kid'], $traps_num);
                    }
                }
                $tt = 1;
            }
        }
        $rallyPoint = new RallyPoint();
        if (isset($_REQUEST['a']) && $_REQUEST['a'] == 4 && isset($_REQUEST['t']) && Session::validateChecker()) {
            $m = new RallyPointModel();
            $m->cancelTask((int)$_REQUEST['t']);
        }
        $x['tt'] = $tt;
        $x['content'] = '';
        $x['show'] = Village::getInstance()->getField(39)['level'] > 0;
        //tabs
        $x['favorTabId'] = $session->getFavoriteTab("buildingRallyPoint");
        $x['tabs'][0]['id'] = get_button_id();
        $x['tabs'][0]['text'] = T("RallyPoint", "Management");
        $x['tabs'][1]['id'] = get_button_id();
        $x['tabs'][1]['text'] = T("RallyPoint", "overview");
        $x['tabs'][2]['id'] = get_button_id();
        $x['tabs'][2]['text'] = T("RallyPoint", "sendTroops");
        $x['tabs'][3]['id'] = get_button_id();
        $x['tabs'][3]['text'] = T("RallyPoint", "combatSimulator");
        $x['tabs'][99]['id'] = get_button_id();
        $x['tabs'][99]['text'] = T("RallyPoint", "farmlist");
        $x['tabs'][99]['hasClub'] = $session->hasGoldClub();
        $x['tabs'][99]['title'] = T("RallyPoint", "farmlist") . '||' . T("RallyPoint", "needClubToBeActive");
        $x['favorText'] = null;
        if (isset($x['tabs'][$tt]['text'])) {
            $x['favorText'] = sprintf(T("RallyPoint", "Set tab x as favourite"), $x['tabs'][$tt]['text']);
        }
        $build->view->newVillagePrefix['tt'] = $tt;
        switch ($tt) {
            case 0:
                $x['content'] = $build->getBuildingContract();
                $rallyPoint->procEvasion();
                $l = ["goldClub" => $session->hasGoldClub(), "goldClubButton" => $session->hasGoldClub(), "evasion" => $session->evasionStatus(), "heroEvasion" => $this->session->hero->evasionStatus(),];
                $l['evasionSaveButton'] = getButton(["type" => "submit", "class" => "green",], ["data" => ["type" => "submit", "value" => T("Global", "General.save"), "class" => "green",],], T("Global", "General.save"));
                if (!$session->hasGoldClub()) {
                    $l['goldClubEvasionDesc'] = T("RallyPoint", "goldClubEvasionDesc");
                    $l['goldClubButton'] = getButton(["type" => "button", "class" => "gold builder ", "title" => T("RallyPoint", "evasion in capital") . '||' . T("RallyPoint", "needClubToBeActive"),], ["data" => ["type" => "button", "class" => "gold builder ", "value" => T("RallyPoint", "goldclub"), "goldclubDialog" => ["featureKey" => "troopEscape", "infoIcon" => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",],],], T("RallyPoint", "goldclub"));
                }
                $view = new PHPBatchView('rallypoint/escape');
                $view->vars = $l;
                $x['content'] .= $view->output();
                break;
            case 1:
                function MergeSubFilters($id, $subFiltersArray)
                {
                    if ($subFiltersArray[$id]) {//filter is active link must deactivate it!
                        $subFiltersArray[$id] = 0;
                    } else {//key is not active! merge with current
                        $subFiltersArray[$id] = 1;
                    }
                    return implodeActiveSubFilters($subFiltersArray);
                }

                $filter = isset($_REQUEST['filter']) && is_numeric($_REQUEST['filter']) && $_REQUEST['filter'] >= 1 && $_REQUEST['filter'] <= 4 ? $_REQUEST['filter'] : 0;
                $subFiltersArray = $filter == 1 ? [1 => 1, 2 => 1, 3 => 0,] : [4 => 1, 5 => 1, 6 => 0];
                function implodeActiveSubFilters($subFiltersArray)
                {
                    $implode = [];
                    foreach ($subFiltersArray as $subFilterId => $subFilterActive) {
                        if ($subFilterActive) {
                            $implode[] = $subFilterId;
                        }
                    }
                    return implode(",", $implode);
                }

                if ($filter == 1 || $filter == 2) {
                    $subFiltersCookieName = 'active_rallypoint_sub_filters_' . $filter;
                    if (!isset($_COOKIE[$subFiltersCookieName])) {
                        setcookie($subFiltersCookieName, implodeActiveSubFilters($subFiltersArray), time() + 86400 * 365 * 4); // 4years!
                        $_COOKIE[$subFiltersCookieName] = implodeActiveSubFilters($subFiltersArray);
                    }
                    $subFilters = isset($_REQUEST['subfilters']) && !empty($_REQUEST['subfilters']) ? $_REQUEST['subfilters'] : $_COOKIE[$subFiltersCookieName];
                    $subFilters = explode(",", $subFilters);
                    foreach ($subFiltersArray as $subFilterId => $subFilterActive) {
                        $find = FALSE;
                        foreach ($subFilters as $sf2) {
                            if ($sf2 == $subFilterId) {
                                $find = TRUE;
                                break;
                            }
                        }
                        $subFiltersArray[$subFilterId] = $find ? 1 : 0;
                    }
                    if ($filter == 2 && $subFiltersArray[6]) {
                        if (!$subFiltersArray[4] && !$subFiltersArray[5]) {
                            //when all outgoing troops are selected there must be 2 subFilters that are selected.
                            foreach (explode(",", $_COOKIE[$subFiltersCookieName]) as $subFilterId) {
                                if ($subFilterId <> 6) {
                                    $subFiltersArray[$subFilterId] = 1;
                                    break;
                                }
                            }
                        }
                    }
                    setcookie($subFiltersCookieName, implodeActiveSubFilters($subFiltersArray), time() + 86400 * 365 * 4); // 4years!
                    $_COOKIE[$subFiltersCookieName] = implodeActiveSubFilters($subFiltersArray);
                }
                $l = ["filter" => $filter, "subFilters" => $subFiltersArray, "content" => '',];
                $rallyPoint->procContent($l);
                $view = new PHPBatchView('rallypoint/overview');
                $view->vars = $l;
                $x['content'] .= $view->output();
                break;
            case 2:
                if (isset($_GET['a']) && $_GET['a'] == 6) {
                    $x['content'] .= $rallyPoint->procSettlers();
                    break;
                }
                if (isset($_REQUEST['d']) && is_numeric($_REQUEST['d'])) {
                    $x['content'] .= $rallyPoint->procEnforcement((int)$_REQUEST['d']);
                    break;
                }
                $sendTroops = new sendTroops();
                $x['content'] .= $sendTroops->procContent($build);
                break;
            case 3:
                $combat = new combat();
                $x['content'] .= $combat->procContent();
                break;
            case 99:
                $farmList = new FarmList();
                $x['content'] .= $farmList->procContent();
                break;
        }
        $this->view = new PHPBatchView('rallypoint/main');
        $this->view->vars = $x;
    }
} 