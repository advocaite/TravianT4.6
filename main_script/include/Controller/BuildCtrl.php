<?php

namespace Controller;

use Controller\Build\AcademyCtrl;
use Controller\Build\BreweryCtrl;
use Controller\Build\EmbassyCtrl;
use Controller\Build\HeroMansionCtrl;
use Controller\Build\MainBuildingCntrl;
use Controller\Build\MarketPlaceCtrl;
use Controller\Build\ResidencePalaceCtrl;
use Controller\Build\SmithyCtrl;
use Controller\Build\TownhallCntrl;
use Controller\Build\TreasuryCtrl;
use Controller\Build\TroopBuilding;
use Controller\RallyPoint\RallyPointCntrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\StringChecker;
use Core\Helper\WebService;
use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\ExtraModules;
use Game\Formulas;
use Game\GoldHelper;
use Model\ArtefactsModel;
use Model\Quest;
use function number_format_x;
use resources\View\GameView;
use resources\View\PHPBatchView;
use Game\Buildings\BuildingAction;

class BuildCtrl extends GameCtrl
{
    public $selectedBuildingIndex = -1;
    /** @var GameView */
    public $view;
    private $buildView;

    public function __construct()
    {
        parent::__construct();
        $village = Village::getInstance();
        if (isset($_REQUEST['gid'])) {
            $this->selectedBuildingIndex = $village->findBuildingByGid((int)$_REQUEST['gid']);
        } else if (isset($_REQUEST['id']) && (($_REQUEST['id'] > 0 && $_REQUEST['id'] <= 40) || $_REQUEST['id'] == 99)) {
            $this->selectedBuildingIndex = (int)$_REQUEST['id'];
        }
        if ($village->isWW() && in_array($this->selectedBuildingIndex, [21, 26, 30, 31, 32,])) {
            $this->selectedBuildingIndex = 99;
        }
        if ($this->selectedBuildingIndex <= 0) {
            $this->redirect("dorf2.php");
        }
        $field = $village->getField($this->selectedBuildingIndex);
        if (isset($_GET['fastUP']) && $_GET['fastUP'] == 1) {
            $pageNamePostfix = $this->selectedBuildingIndex > 18 ? 2 : 1;
            $item_id = $field['item_id'];
            $lvl = $field['level'];
            $link = ("dorf" . $pageNamePostfix . ".php?") . "a=" . ($lvl >= 1 || $item_id <= 4 ? $this->selectedBuildingIndex : $item_id) . (($lvl >= 1 || $item_id <= 4 ? "" : '&id=' . $this->selectedBuildingIndex) . '&c=' . $this->session->getChecker());

            $max = Formulas::buildingMaxLvl($field['item_id'], $village->isCapital());
            if (!($field['level'] == $max || ($field['level'] + $field['upgrade_state']) == $max)) {
                $this->redirect($link);
            }
        }
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = $this->selectedBuildingIndex <= 18 || $this->selectedBuildingIndex == 39 ? "perspectiveResources" : "perspectiveBuildings";
        $this->view->vars['contentCssClass'] = $this->selectedBuildingIndex <= 18 ? "build gidResources" : "build";
        $this->view->newVillagePrefix['id'] = $this->selectedBuildingIndex;
        if ($field['item_id']) {
            $this->view->vars['titleInHeader'] = T("Buildings", $field['item_id'] . '.title') . ' <span class="level">' . T("Buildings", "level") . ' ' . $field['level'] . '</span>';
            if ($field['item_id'] > 4) {
                $this->view->newVillagePrefix['gid'] = $field['item_id'];
            }
        } else {
            $this->view->vars['titleInHeader'] = T("Buildings", "constructNewBuilding");
        }
        $this->buildView = new PHPBatchView("build/main");
        $this->buildView->vars['selectedBuildingId'] = $field['item_id'];
        $this->buildView->vars['selectedBuildingLevel'] = $field['level'];
        $this->buildView->vars['content'] = '';
        $quest = Quest::getInstance();
        if (!$field['item_id']) {
            if ($quest->getTutorial() == '8-0') {
                $quest->setTutorial("8-1");
            }
            if ($quest->getTutorial() == '9-0' && $this->selectedBuildingIndex == 39) {
                $quest->setTutorial("9-1");
            }
            $this->procNewBuilding();
        } else {
            $this->procBuilding();
        }
        $this->view->vars['content'] = $this->buildView->output();
        if ($quest->getTutorial() == '3-0' && $field['item_id'] == 1 && $field['level'] == 0) {
            $quest->setTutorial("3-1");
        }
        if ($quest->getTutorial() == '4-0' && $field['item_id'] == 1 && $field['level'] == 1) {
            $quest->setTutorial("4-1");
        }
        if ($quest->getTutorial() == '5-0' && $field['item_id'] == 4 && $field['level'] == 0) {
            $quest->setTutorial("5-1");
        }

        if (Session::getInstance()->isAdmin()) {
            if (isset($_REQUEST['new_building_level'])) {
                $newLevel = (int)$_REQUEST['new_building_level'];
                if ($newLevel > $field['level']) {
                    // upgrade
                    BuildingAction::upgrade($village->getKid(), $this->selectedBuildingIndex, $newLevel - $field['level']);
                } else {
                    // downgrade
                    if ($newLevel == 0) {
                        BuildingAction::downgrade($village->getKid(), $this->selectedBuildingIndex, $field['level'] - $newLevel, true);
                    } else {
                        BuildingAction::downgrade($village->getKid(), $this->selectedBuildingIndex, $field['level'] - $newLevel);
                    }
                }
                WebService::redirect('build.php?id=' . $this->selectedBuildingIndex);
            }
            $this->view->vars['content'] .= PHPBatchView::render('build/admin_level_set', [
                'id' => $this->selectedBuildingIndex,
                'level' => $field['level']
            ]);
        }
    }

    private function procNewBuilding()
    {
        $village = Village::getInstance();
        $category = isset($_GET['category']) ? (int)$_GET['category'] : -1;
        $noSoon = FALSE;
        if ($this->selectedBuildingIndex == 39 || $this->selectedBuildingIndex == 40) {
            $category = 2;
            $noSoon = TRUE;
        } else if (in_array($this->selectedBuildingIndex, [21, 26, 31, 31, 32, 99,]) && $village->isWW()) {
            $category = 1;
            $noSoon = TRUE;
        }
        if (!in_array($category, [1, 2, 3, -1])) {
            $category = -1;
        }
        if ($category < 0) {
            $category = 1;
            do {
                if (sizeof($this->getCategoryAvailableBuildings($category)['available'])) {
                    break;
                }
                $category++;
            } while ($category < 3);
        }
        $newBuilds = $this->getCategoryAvailableBuildings($category);
        $view = new PHPBatchView("build/newBuildingMenu");
        $view->vars = ["selectedId" => $this->selectedBuildingIndex, "activeTab" => $category, "InfrastructureTab" => ["id" => get_button_id(), "text" => T("Buildings", "newBuilding.Infrastructure"),], "MilitaryTab" => ["id" => get_button_id(), "text" => T("Buildings", "newBuilding.Military"),], "ResourcesTab" => ["id" => get_button_id(), "text" => T("Buildings", "newBuilding.Resources"),],];
        $content = $view->output();
        $x = 0;
        foreach ($newBuilds['available'] as $item_id => $build) {
            if ($village->isWW() && $item_id <> 40 && in_array($this->selectedBuildingIndex, [21, 26, 30, 31, 32, 99,])) {
                continue;
            } else if ($this->selectedBuildingIndex == 39 && $item_id <> 16) {
                continue;
            } else if ($this->selectedBuildingIndex == 40 && !in_array($item_id, [31, 32, 33, 42, 43])) {
                continue;
            }
            $x++;
        }
        foreach ($newBuilds['available'] as $item_id => $build) {
            if ($village->isWW() && $item_id <> 40 && in_array($this->selectedBuildingIndex, [21, 26, 30, 31, 32, 99,])) {
                continue;
            } else if ($this->selectedBuildingIndex == 39 && $item_id <> 16) {
                continue;
            } else if ($this->selectedBuildingIndex == 40 && !in_array($item_id, [31, 32, 33, 42, 43])) {
                continue;
            }
            $content .= $this->getBuildingWrapper($item_id, $build);
            if (--$x > 0) {
                $content .= '<hr />';
            }
        }
        if (sizeof($newBuilds['available']) === 0) {
            $content .= '<div class="none">';
            $content .= T("Buildings", "no_building_available");
            $content .= "</div>";
        }
        if (!$noSoon && !in_array($this->selectedBuildingIndex, [39, 40,]) && !($village->isWW() && in_array($this->selectedBuildingIndex, [21, 26, 31, 31, 32, 99,]))) {
            $x = sizeof($newBuilds['soon']);
            if ($x) {
                $content .= '<h4 class="round spacer">' . T("Buildings", "soon_available") . '</h4>';
                foreach ($newBuilds['soon'] as $item_id => $build) {
                    $content .= $this->getBuildingWrapper($item_id, $build, TRUE);
                    if (--$x > 0) {
                        $content .= '<hr />';
                    }
                }
            }
        }
        $this->buildView->vars['content'] = $content;
    }

    private function getCategoryAvailableBuildings($category)
    {
        $categories = [1 =>
            [15, 23, 10, 11, 18, 17, 25, 26, 44, 45, 34, 27, 24, 28, 35, 41, 38, 39, 40,],
            [16, 31, 32, 33, 42, 43, 19, 37, 22, 13, 20, 29, 30, 36, 21, 14],
            [8, 5, 6, 7, 9],
        ];
        $newBuilds = ['available' => [], 'soon' => []];
        $village = Village::getInstance();
        foreach ($categories[$category] as $item_id) {
            $canBuild = $village->canCreateNewBuild($item_id);
            if ($village->checkArtifactDependencies($item_id) <> 0) {
                continue;
            }
            $build = Formulas::$data['buildings'][$item_id - 1];
            if ($canBuild != -1) {
                if ($canBuild) {
                    $newBuilds['available'][$item_id] = [];
                    $newBuilds['available'][$item_id] = $build;
                    continue;
                }
                $dependencyCount = 0;
                if (isset($build['breq'])) {
                    foreach ($build['breq'] as $reqId => $reqValue) {
                        if ($reqValue != -1) {
                            $build['pre_requests_dependencyCount'][$reqId] = $reqValue - max($village->getTypeLevel($reqId));
                            $dependencyCount += $build['pre_requests_dependencyCount'][$reqId];
                        }
                    }
                }
                if (!isset($newBuilds['soon'][$dependencyCount])) {
                    $newBuilds['soon'][$item_id] = [];
                }
                $newBuilds['soon'][$item_id] = $build;
            }
        }
        return $newBuilds;
    }

    private function getBuildingWrapper($item_id, $build, $soon = FALSE)
    {
        $village = Village::getInstance();
        $goldHelper = new GoldHelper();
        $data = ["count" => 0, "itemId" => $item_id, "cost" => $build['cost'], "freeCrop" => $build['cu'], "npcButton" => $soon ? NULL : $goldHelper->getExchangeResourcesButtonByCost($build['cost']), "timeInString" => secondsToString(Formulas::buildingUpgradeTime($item_id, 1, $village->getMainBuildingLvl(), $village->isWW())), 'contractLink' => '',];
        $multi = Formulas::$data['buildings'][$item_id - 1];
        if (isset($multi['req']) && isset($multi['req']['multi']) && $multi['req']['multi'] == TRUE) {
            switch ($item_id) {
                case 36:
                    $data['count'] = sizeof($village->getTrapperLvls()) + 1;
                    break;
                case 23:
                    $data['count'] = sizeof($village->getCrannyLvls()) + 1;
                    break;
                default:
                    for ($i = 19; $i <= 38; ++$i) {
                        if ($village->getField($i)['item_id'] == $item_id) {
                            ++$data['count'];
                        }
                    }
                    $data['count']++;
                    break;
            }
        }
        if (!$soon) {
            $contractLink = $this->getActionText($item_id);
            $data['contractLink'] .= $contractLink['main'];
            $data['contractLink'] .= $contractLink['plus'];
            if (!empty($contractLink['plus']) && !empty($contractLink['master'])) {
                $data['contractLink'] .= '<br /><br />';
            }
            $data['contractLink'] .= $contractLink['master'];
            $data['contractLink'] .= $contractLink['extraModuleButton'];
        } else {
            $data['contractLink'] .= '<div class="contractText">' . T("Buildings", "preRequests") . '</div>';
            $flag = FALSE;
            foreach ($build['breq'] as $reqId => $reqValue) {
                $e = '';
                if (($er = $reqValue - max($village->getTypeLevel($reqId))) > 0) {
                    $e = "error";
                }
                $data['contractLink'] .= '<span class="buildingCondition ' . $e . '">';
                if ($flag) {
                    $data['contractLink'] .= ", ";
                }
                $data['contractLink'] .= '<a href="#" onclick="return Travian.Game.iPopup(' . $reqId . ',4, \'gid\');">';
                if ($reqValue == -1) {
                    $data['contractLink'] .= "<strike>";
                }
                $data['contractLink'] .= T("Buildings", $reqId . '.title') . PHP_EOL;
                if ($reqValue == -1) {
                    $data['contractLink'] .= "</strike>";
                }
                $data['contractLink'] .= '</a>';
                if ($reqValue != -1) {
                    $data['contractLink'] .= '<span title="' . ($er > 0 ? '+' . $er : '') . '">' . T("Buildings", 'level') . ' ' . ($reqValue >= 1 ? $reqValue : 0) . '</span>';
                }
                $data['contractLink'] .= '</span>';
                $flag = TRUE;
                $data['contractLink'] .= '</span>';
            }
        }
        return PHPBatchView::render("build/buildingWrapper", $data);
    }

    private function getActionText($item_id = 0)
    {
        $result = [
            'main' => null,
            'master' => null,
            'plus' => null,
            'noResources' => false,
            'extraModuleButton' => null,
        ];
        $village = Village::getInstance();
        $fieldId = $this->selectedBuildingIndex;
        if (in_array($item_id, [16, 31, 32, 33, 42, 43])) {
            if ($item_id == 16) {
                $fieldId = 39;
            } else {
                $fieldId = 40;
            }
        }
        $new = FALSE;
        if ($item_id === 0) {
            $item_id = $village->getField($this->selectedBuildingIndex)['item_id'];
        } else {
            $new = TRUE;
        }
        $lvl = $village->getField($fieldId)['level'] + $village->getField($fieldId)['upgrade_state'] + 1;
        if ($village->getField($fieldId)['item_id'] == 40 && $village->isWW()) {
            foreach ($village->onLoadBuildings['master'] as $k => $v) {
                if ($this->selectedBuildingIndex == $v['building_field']) {
                    $lvl++;
                }
            }
        }
        //check status of maxed !
        if ($village->getField($fieldId)['level'] >= Formulas::buildingMaxLvl($item_id, $village->isCapital())) {
            $result['main'] = "<span class=\"none\">" . T("Buildings", $item_id . ".title") . " " . T("Buildings", "upgradeNotices.reachedMaxLvL") . "</span>";
            goto outReturn;
        } else if ($village->getField($fieldId)['level'] + $village->getField($fieldId)['upgrade_state'] >= Formulas::buildingMaxLvl($item_id, $village->isCapital())) {
            $result['main'] = "<span class=\"none\">" . sprintf(T("Buildings", "upgradeNotices.currentlyReachingMaxLevel"), T("Buildings", $item_id . ".title")) . "</span>";
            goto outReturn;
        } else if ($item_id == 40 && ($lvl - 1) >= Formulas::buildingMaxLvl($item_id, $village->isCapital())) {
            $result['main'] = "<span class=\"none\">" . sprintf(T("Buildings", "upgradeNotices.currentlyReachingMaxLevel"), T("Buildings", $item_id . ".title")) . "</span>";
            goto outReturn;
        } else if ($village->getOnDemolishBuildingFieldId() == $fieldId) {
            $result['main'] = "<span class=\"none\">" . T("Buildings", "upgradeNotices.buildingIsOnDemolition") . "</span>";
            goto outReturn;
        }
        $needUpgradeType = $village->checkArtifactDependencies($item_id);
        if ($needUpgradeType <> 0) {
            switch ($needUpgradeType) {
                case 1:
                    $result['main'] = '<span class="errorMessage">' . T("Buildings", "errors.noGreatArtefact") . '</span>';
                    goto outReturn;
                case 2:
                case 3:
                    $result['main'] = '<span class="errorMessage">' . T("Buildings", "errors.wwPlans") . '</span>';
                    goto outReturn;
            }
        }

        if ($new) {
            $result['extraModuleButton'] = null;
        } else if (Config::getInstance()->extraSettings->upgradeStorageToMaxLevel->enabled && in_array($item_id, [10, 11, 38, 39])) {
            $result['extraModuleButton'] = ExtraModules::showButton('upgradeStorageToMaxLevel', $fieldId);
        } else if (Config::getInstance()->extraSettings->upgradeToMaxLevel->enabled && !in_array($item_id, [10, 11, 38, 39])) {
            $result['extraModuleButton'] = ExtraModules::showButton('upgradeToMaxLevel', $fieldId);
        }
        $needUpgradeType = $village->checkDependencies($item_id, $lvl);
        if ($needUpgradeType <> 0) {
            switch ($needUpgradeType) {
                case 1:
                    $result['main'] = "<span class=\"none\">" . T("Buildings", "errors.foodShortage") . "</span>";
                    goto outReturn;
                case 2:
                    $result['main'] = "<span class=\"none\">" . T("Buildings", "errors.upgradeWareHouse") . "</span>";
                    goto outReturn;
                case 22:
                    $result['main'] = "<span class=\"none\">" . T("Buildings", "errors.constructWarehouse") . "</span>";
                    goto outReturn;
                case 3:
                    $result['main'] = "<span class=\"none\">" . T("Buildings", "errors.upgradeGranny") . "</span>";
                    goto outReturn;
                case 33:
                    $result['main'] = "<span class=\"none\">" . T("Buildings", "errors.constructGranny") . "</span>";
                    goto outReturn;
            }
        }
        $session = $this->session;
        $workerResult = $village->isWorkersBusy($item_id <= 4, $item_id == 40);
        $pageNamePostfix = ($item_id <= 4 ? '1' : '2');
        $link = ("dorf" . $pageNamePostfix . ".php?") . "a=" . ($lvl > 1 || $item_id <= 4 ? $fieldId : $item_id) . (($lvl > 1 || $item_id <= 4 ? "" : '&id=' . $fieldId) . '&c=' . $session->getChecker());
        $cost = Formulas::buildingUpgradeCosts($item_id, $lvl);
        $goldHelper = new GoldHelper();
        if ((!$village->isWW() || $item_id == 40) && ($workerResult['isBusy'] || !$village->isResourcesAvailable($cost))) {
            //masterBuilder
            $result['master'] = $goldHelper->getMasterBuilderButton($fieldId, $item_id, $village->getField($fieldId)['level'] + $village->getField($fieldId)['upgrade_state'], $link);
        }
        if (!$session->hasPlus() && $workerResult['isBusy']) {
            $result['plus'] = getButton(["type" => "button", "class" => "gold builder", "value" => T("Buildings", "buildingQueue.name"),], ["data" => ['type' => 'button', "plusDialog" => ["featureKey" => 'buildingQueue', 'infoIcon' => 'http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer',],],], T("Buildings", "buildingQueue.name"));
            $result['plus'] .= '<br>';
            $result['plus'] .= T("Buildings", "buildingQueue.desc");
        }
        $cost = Formulas::buildingUpgradeCosts($item_id, $lvl);
        if (!$village->isResourcesAvailable($cost)) {
            $result['noResources'] = true;
            $result['main'] = $village->calcWhenResourcesAreAvailable($cost, TRUE);
            goto outReturn;
        }
        $btn = getButton(["type" => "button", "class" => "green " . ($new ? 'new' : 'build'), "onclick" => "window.location.href = '$link'; return false;",], ['data' => ["class" => "green " . ($new ? 'new' : 'build')]], $lvl == 1 && $item_id > 4 ? T("Buildings", "constructBuilding") : sprintf(T("Buildings", "upgradeBuilding"), $lvl));
        $result['waitLoop'] = $workerResult['isPlusUsed'];
        if ($workerResult['isBusy']) {
            //$result['main'] = '<span class="errorMessage">' . T("Buildings", "workersBusy") . '</span>';
            $result['main'] = null;
            goto outReturn;
        } else {
            $result['main'] = $btn;
            goto outReturn;
        }
        outReturn:
        return $result;
    }

    private function procBuilding()
    {
        $village = Village::getInstance();
        //process tabs here.
        $showDesc = TRUE;
        switch ($this->buildView->vars['selectedBuildingId']) {
            case 16: //rally point
                $rallyPoint = new RallyPointCntrl($this);
                $this->buildView->vars['content'] .= $rallyPoint->render();
                return TRUE;
                break;
            case 25:
            case 26:
            case 44:
                $dispatcher = new ResidencePalaceCtrl($this);
                $this->buildView->vars['content'] .= $dispatcher->render();
                return TRUE;
                break;
            case 27:
                $dispatcher = new TreasuryCtrl($this);
                $this->buildView->vars['content'] .= $dispatcher->render();
                return TRUE;
                break;
            case 17://Marketplace TOD:
                $dispatcher = new MarketPlaceCtrl($this);
                $this->buildView->vars['content'] .= $dispatcher->render();
                return TRUE;
                break;
        }
        if ($showDesc) {
            $this->buildView->vars['content'] .= $this->getBuildingContract();
        }
        switch ($this->buildView->vars['selectedBuildingId']) {
            case 40:
                $db = DB::getInstance();
                $wwName = $db->fetchScalar("SELECT wwname FROM fdata WHERE kid=" . $this->session->getKid());
                if (isset($_POST['ww_name']) && StringChecker::isValidName($_POST['ww_name'])) {
                    if (getDisplay("allowWWUnusualRename") || $village->getField($this->selectedBuildingIndex)['level'] <= 10) {
                        if (strlen($_POST['ww_name']) <= 20) {
                            $wwName = $db->real_escape_string(filter_var($_POST['ww_name'], FILTER_SANITIZE_STRING));
                            $db->query("UPDATE fdata SET wwname='$wwName' WHERE kid=" . $this->session->getKid());
                        }
                    }
                }
                $view = new PHPBatchView("build/wwChangeName");
                $view->vars['level'] = $village->getField($this->selectedBuildingIndex)['level'];
                $view->vars['WWName'] = $wwName;
                $this->buildView->vars['content'] .= $view->output();
                break;
            case 18:
                $view = new EmbassyCtrl($this);
                $this->buildView->vars['content'] .= $view->render();
                break;
            case 15:
                if ($village->getField($this->selectedBuildingIndex)['level'] >= 10) {
                    $view = new MainBuildingCntrl();
                    $this->buildView->vars['content'] .= $view->render();
                }
                break;
            case 37:
                $view = new HeroMansionCtrl();
                $this->buildView->vars['content'] .= $view->render();
                break;
            case 24:
                if ($village->getField($this->selectedBuildingIndex)['level'] <= 0) {
                    break;
                }
                $view = new TownhallCntrl($this->selectedBuildingIndex);
                $this->buildView->vars['content'] .= $view->render();
                break;

            case 13:
                $dispatcher = new SmithyCtrl($this->selectedBuildingIndex);
                $this->buildView->vars['content'] .= $dispatcher->render();
                break;
            case 22:
                $dispatcher = new AcademyCtrl($this->selectedBuildingIndex);
                $this->buildView->vars['content'] .= $dispatcher->render();
                break;
            case 19;
            case 20:
            case 21:
            case 29:
            case 30:
            case 36:
                if ($village->getField($this->selectedBuildingIndex)['level'] <= 0) {
                    break;
                }
                $dispatcher = new TroopBuilding($this->selectedBuildingIndex);
                $this->buildView->vars['content'] .= $dispatcher->render();
                break;
            case 35:
                if ($village->getField($this->selectedBuildingIndex)['level'] <= 0) {
                    break;
                }
                $view = new BreweryCtrl($this->selectedBuildingIndex);
                $this->buildView->vars['content'] .= $view->render();
                break;
        }
        return TRUE;
    }

    public function getBuildingContract()
    {
        $village = Village::getInstance();
        $cost = Formulas::buildingUpgradeCosts($village->getField($this->selectedBuildingIndex)['item_id'], $village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state'] + 1);
        $goldHelper = new GoldHelper();
        $curLevel = ($village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state']);
        $nextLevel = 1 + ($village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state']);
        $contract = [
            'building_field' => $this->selectedBuildingIndex,
            "itemId" => $village->getField($this->selectedBuildingIndex)['item_id'],
            "showCosts" => $curLevel < Formulas::buildingMaxLvl($village->getField($this->selectedBuildingIndex)['item_id'], $village->isCapital()),
            "contractText" => sprintf(T("Buildings", "costsForUpgradeToLvl"), $village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state'] + 1),
            "cost" => $cost,
            "freeCrop" => Formulas::buildingCropConsumption($village->getField($this->selectedBuildingIndex)['item_id'], $village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state'] + 1),
            "timeInString" => secondsToString(Formulas::buildingUpgradeTime($village->getField($this->selectedBuildingIndex)['item_id'], $village->getField($this->selectedBuildingIndex)['level'] + $village->getField($this->selectedBuildingIndex)['upgrade_state'] + 1, $village->getMainBuildingLvl(), $village->isWW())), "npcButton" => $goldHelper->getExchangeResourcesButtonByCost($cost),
            "showValuesTable" => FALSE,
            'contractLink' => null,
            "valueTable" => ''
        ];
        $cpPop = Formulas::buildingCpPop($village->getField($this->selectedBuildingIndex)['item_id'], 0, $curLevel);
        $contract['culturePointsAndPopulation'] = [
            'pop' => $cpPop[0],
            'cp' => $cpPop[1],
            'infantryBonusTime' => null,
            'cavalryBonusTime' => null,
            'siegeTime' => null,
            'maxTraps' => null,
            'merchantCap' => null,
            'warehouseCap' => null,
            'granaryCap' => null,
            'troopSpeed' => null,
            'crannyCap' => null,
        ];
        $newCpPop = Formulas::buildingCpPop($village->getField($this->selectedBuildingIndex)['item_id'], 0, $nextLevel);
        $contract['nextLevelCpPop'] = [
            'pop' => $newCpPop[0] - $cpPop[0],
            'cp' => $newCpPop[1] - $cpPop[1],
            'infantryBonusTime' => null,
            'cavalryBonusTime' => null,
            'siegeTime' => null,
            'maxTraps' => null,
            'merchantCap' => null,
            'warehouseCap' => null,
            'granaryCap' => null,
            'troopSpeed' => null,
            'crannyCap' => null,
        ];
        $item_id = $village->getField($this->selectedBuildingIndex)['item_id'];
        if($item_id == 14){
            $contract['culturePointsAndPopulation']['troopSpeed'] = Formulas::TournamentSqValue($curLevel);
            $contract['nextLevelCpPop']['troopSpeed'] = Formulas::TournamentSqValue($nextLevel) - $contract['culturePointsAndPopulation']['troopSpeed'];
        } else if($item_id == 10 ||  $item_id == 38){
            $contract['culturePointsAndPopulation']['warehouseCap'] = $item_id == 38 ? Formulas::bigStoreCAP($curLevel) : Formulas::storeCAP($curLevel);
            $contract['nextLevelCpPop']['warehouseCap'] = ($item_id == 38 ? Formulas::bigStoreCAP($nextLevel) : Formulas::storeCAP($nextLevel)) - $contract['culturePointsAndPopulation']['warehouseCap'];
        } else if($item_id == 11 || $item_id == 39){
            $contract['culturePointsAndPopulation']['granaryCap'] = $item_id == 39 ? Formulas::bigStoreCAP($curLevel) : Formulas::storeCAP($curLevel);
            $contract['nextLevelCpPop']['granaryCap'] = ($item_id == 39 ? Formulas::bigStoreCAP($nextLevel) : Formulas::storeCAP($nextLevel)) - $contract['culturePointsAndPopulation']['granaryCap'];
        } else if ($item_id == 28) {
            $alliance_bonus = 1;
            if ($this->session->getAllianceId() > 0) {
                $alliance_bonus = AllianceBonus::getTradersBonus($this->session->getAllianceId(), $this->session->getAllianceJoinTime());
            }
            $contract['culturePointsAndPopulation']['merchantCap'] = Formulas::merchantCAP($this->session->getRace(), $curLevel, $alliance_bonus);
            $contract['nextLevelCpPop']['merchantCap'] = Formulas::merchantCAP($this->session->getRace(), $nextLevel, $alliance_bonus) - $contract['culturePointsAndPopulation']['merchantCap'];
        } else if (in_array($item_id, [20, 30])) {
            // stable
            $contract['culturePointsAndPopulation']['cavalryBonusTime'] = round((100 * (1 - pow(0.9, $curLevel - 1))));
            $contract['nextLevelCpPop']['cavalryBonusTime'] = $contract['culturePointsAndPopulation']['cavalryBonusTime'] - round((100 * (1 - pow(0.9, $nextLevel - 1))));
            if ($contract['culturePointsAndPopulation']['cavalryBonusTime'] > 0) {
                $contract['culturePointsAndPopulation']['cavalryBonusTime'] = -$contract['culturePointsAndPopulation']['cavalryBonusTime'];
            }
        } else if ($item_id == 21) {
            //workshop
            $contract['culturePointsAndPopulation']['siegeTime'] = round((100 * (1 - pow(0.9, $curLevel - 1))));
            $contract['nextLevelCpPop']['siegeTime'] = $contract['culturePointsAndPopulation']['siegeTime'] - round((100 * (1 - pow(0.9, $nextLevel - 1))));
            if ($contract['culturePointsAndPopulation']['siegeTime'] > 0) {
                $contract['culturePointsAndPopulation']['siegeTime'] = -$contract['culturePointsAndPopulation']['siegeTime'];
            }
        } else if ($item_id == 36) {
            $contract['culturePointsAndPopulation']['maxTraps'] = Formulas::trapperValue($curLevel);
            $contract['nextLevelCpPop']['maxTraps'] = Formulas::trapperValue($nextLevel) - $contract['culturePointsAndPopulation']['maxTraps'];
        } else if (in_array($item_id, [19, 29])) {
            $contract['culturePointsAndPopulation']['infantryBonusTime'] = round((100 * (1 - pow(0.9, $curLevel - 1))));
            $contract['nextLevelCpPop']['infantryBonusTime'] = $contract['culturePointsAndPopulation']['infantryBonusTime'] - round((100 * (1 - pow(0.9, $nextLevel - 1))));
            if ($contract['culturePointsAndPopulation']['infantryBonusTime'] > 0) {
                $contract['culturePointsAndPopulation']['infantryBonusTime'] = -$contract['culturePointsAndPopulation']['infantryBonusTime'];
            }
        } else if($item_id == 23){
            $contract['culturePointsAndPopulation']['crannyCap'] = Formulas::crannyCAP($curLevel, $this->session->getRace());
            $contract['nextLevelCpPop']['crannyCap'] = Formulas::crannyCAP($nextLevel, $this->session->getRace()) - $contract['culturePointsAndPopulation']['crannyCap'];
        }
        switch ($item_id) {
            case 1:
            case 2:
            case 3:
            case 4:
                $percent = $village->calculateResourcesTotalBonusProduction($item_id);
                $this->getValuesTable($contract, ["percent" => $percent], function ($params, $lvl) {
                    return Formulas::fieldProduction($lvl) + round5(Formulas::fieldProduction($lvl) * $params['percent'] / 100);
                });
                break;
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 45:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return $lvl * 5;
                });
                break;
            case 10:
            case 11:
            case 38:
            case 39:
                $this->getValuesTable($contract, ["big" => $item_id > 11], function ($params, $lvl) {
                    return $params['big'] ? Formulas::bigStoreCAP($lvl) : Formulas::storeCAP($lvl);
                });
                break;
            case 23:
                $increase = ArtefactsModel::getArtifactEffectByType($this->session->getPlayerId(), $village->getKid(), ArtefactsModel::ARTIFACT_CRANNY);
                $this->getValuesTable($contract, ["race" => $this->session->getRace(), "increase" => $increase,], function ($params, $lvl) {
                    return Formulas::crannyCAP($lvl, $params['race']) * $params['increase'];
                });
                break;
            case 36:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::trapperValue($lvl);
                });
                break;
            case 15:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::getMainBuildingValue($lvl);
                });
                break;
            case 31:
            case 32:
            case 33:
            case 42:
            case 43:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::wallPower($this->session->getRace(), $lvl);
                });
                break;
            case 41:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return 100 + $lvl;
                });
                break;
            case 14:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::TournamentSqValue($lvl);
                });
                break;
            case 28:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::TradeOfficeValue($lvl);
                });
                break;
            case 34:
                $this->getValuesTable($contract, [], function ($params, $lvl) {
                    return Formulas::StonemasonsLodgeValue($lvl);
                });
                break;
        }
        if (is_null($contract['contractLink'])) {
            $contract['contractLink'] = $this->getActionText();
        }
        $contract['isNew'] = !($village->getField($this->selectedBuildingIndex)['item_id'] <> 0);
        return PHPBatchView::render("build/buildingReadyWrapper", $contract);
    }

    private function getValuesTable(&$contract, $params = [], callable $callback)
    {
        $contract['showValuesTable'] = TRUE;
        $contract['valueTable'] = '';
        //no over all for resources
        $village = Village::getInstance();
        $item_id = $village->getField($this->selectedBuildingIndex)['item_id'];
        if ($item_id == 23 || $item_id == 36) {
            if ($item_id == 23) {
                //cranny total overall value;
                $overall = 0;
                foreach ($village->getCrannyLvls() as $lvl) {
                    $overall += $callback($params, $lvl);
                }
            } else {
                $overall = 0;
                foreach ($village->getTrapperLvls() as $lvl) {
                    $overall += $callback($params, $lvl);
                }
            }
            $contract['valueTable'] .= '<tr class="overall"><th>' . T("Buildings", $item_id . ".overall_storage") . '</th><td><span class="number">' . number_format_x($overall) . '</span> ' . T("Buildings", $item_id . ".unit") . '</td></tr>';
        } else {
            $contract['valueTable'] .= '<tr class="overall"><th></th><td></td></tr>';
        }
        $current_value = $callback($params, $village->getField($this->selectedBuildingIndex)['level']);
        $contract['valueTable'] .= '<tr class="currentLevel"><th>' . T("Buildings", $item_id . ".current_prod") . ':</th><td><span class="number">' . number_format_x($current_value) . '</span> ' . T("Buildings", $item_id . ".unit") . '</td></tr>';
        $tmp = $village->getField($this->selectedBuildingIndex)['level'];
        $upgrade_state = $village->getField($this->selectedBuildingIndex)['upgrade_state'];
        $maxLvl = Formulas::buildingMaxLvl($item_id, $village->isCapital());
        if ($upgrade_state) {
            for ($i = $tmp + 1; $i <= $tmp + $upgrade_state; ++$i) {
                if ($i == $maxLvl) {
                    $msg = sprintf(T("Buildings", "upgradeNotices.currentlyReachingMaxLevel"), T("Buildings", "{$item_id}.title"));
                } else {
                    $msg = sprintf(T("Buildings", "upgradeNotices.currentlyUpgradingToLevel"), $i);
                }
                $contract['valueTable'] .= '<tr class="underConstruction">';
                $contract['valueTable'] .= '<th>' . $msg . '</th>';
                $value = $callback($params, $i);
                $contract['valueTable'] .= '<td><span class="number">' . number_format_x($value) . '</span> ' . T("Buildings", $item_id . ".unit") . '</td>';
                $contract['valueTable'] .= '</tr>';
            }
        }
        if ($village->getField($this->selectedBuildingIndex)['level'] >= $maxLvl) {
        } else if (($village->getField($this->selectedBuildingIndex)['level'] + $upgrade_state) >= $maxLvl) {
        } else {
            $nextLevel = ($village->getField($this->selectedBuildingIndex)['level'] + $upgrade_state) + 1;
            $value = $callback($params, $nextLevel);
            $contract['valueTable'] .= '<tr class="nextPossible"><th>' . T("Buildings", $item_id . ".next_prod") . ' ' . $nextLevel . ':</th><td><span class="number">' . number_format_x($value) . '</span> ' . T("Buildings", $item_id . ".unit") . '</td></tr>';
        }
    }
} 