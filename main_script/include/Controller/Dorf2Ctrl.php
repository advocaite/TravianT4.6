<?php
namespace Controller;
use Core\Config;
use Core\Dispatcher;
use Core\Helper\PreferencesHelper;
use Game\Formulas;
use Model\Quest;
use resources\View\GameView;
use resources\View\PHPBatchView;
use function htmlspecialchars;

class Dorf2Ctrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'village2';
        if ($this->session->getPlayerId() <= 0) return;
        if (!$this->proc()) {
            return;
        }
        $quest = Quest::getInstance();
        if ($quest->getTutorial() == '7-0') {
            $quest->setTutorial("8-0");
        }
        $showColored = PreferencesHelper::getPreference("t4level") == 0;
        $village = $this->session->village;
        $maps = [];
        $non_fast_upgrade_buildings = [13, 15, 16, 17, 18, 19, 20, 21, 22, 24, 25, 26, 27, 29, 30, 36, 37, 40];
        for ($i = 19; $i <= 40; ++$i) {
            if ($village->isWW() && in_array($i, [21, /*26,*/ 30, 31, 32])){
                continue;
            }
            $index = $i;
            if($village->isWW() && $i == 26){
                $index = 99;
            }
            $title = $village->getFieldTitleAsString($index);
            $item_id = $village->getField($index)['item_id'];
            $level = $village->getField($index)['level'];
            $fastUp = $item_id > 0 && $level > 0 && $this->session->fastUpgradeActive() && !in_array($item_id, $non_fast_upgrade_buildings);
            $title = htmlspecialchars($title);
            $maps[] = [
                'index' => $i, 
                "title" => $title, 
                'fastUP' => $fastUp ? 1 : 0,
                'item_id' => $item_id,
                'level' => $level,
                'levelColor' => $this->getBuildingConstruction($index),
                'showColored' => $showColored,
                'class' => $this->getBuildingImgClass($index),
            ];
        }
        $this->view->vars['content'] = PHPBatchView::render('dorf2/main2', [
            'isWW' => $village->isWW(),
            'levelsActive' => PreferencesHelper::getPreference("t4level") == 1,
            'onLoadBuildings' => Dispatcher::getInstance()->dispatch("onLoadBuildingsDorfCtrl", FALSE),
            "maps" => $maps
        ]);
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
                $village->upgradeBuilding(99, isset($_GET['b']) && (int)$_GET['b'] === 1);
            } else {
                $village->constructBuilding((int)$_GET['id'], (int)$_GET['a'], isset($_GET['b']) && (int)$_GET['b'] === 1);
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

    public function getBuildingImgClass($k)
    {
        $village = $this->session->village;
        if ($village->isWW() && $k == 99) {
            if ($village->getField($k)['level'] >= 0 && $village->getField($k)['level'] <= 19) {
                return 'ww g40 g40_0';
            }
            if ($village->getField($k)['level'] >= 20 && $village->getField($k)['level'] <= 39) {
                return 'ww g40 g40_1';
            }
            if ($village->getField($k)['level'] >= 40 && $village->getField($k)['level'] <= 59) {
                return 'ww g40 g40_2';
            }
            if ($village->getField($k)['level'] >= 60 && $village->getField($k)['level'] <= 79) {
                return 'ww g40 g40_3';
            }
            if ($village->getField($k)['level'] >= 80 && $village->getField($k)['level'] <= 89) {
                return 'ww g40 g40_4';
            }
            if ($village->getField($k)['level'] >= 90) {
                return 'ww g40 g40_5';
            }
        }
        if ($village->getField($k)['item_id'] == 0) {
            if ($k == 39) {
                return 'g16e';
            }
            return "iso";
        }
        $res = 'g' . $village->getField($k)['item_id'] . ($village->isWW() && $k == 39 ? "e_ww" : '');
        if ($village->getField($k)['level'] == 0) {
            $res .= 'b';
        }
        return $res;
    }

    public function getBuildingConstruction($i)
    {
        $village = $this->session->village;
        $max = Formulas::buildingMaxLvl($village->getField($i)['item_id'], $village->isCapital());
        $showColored = PreferencesHelper::getPreference("t4level") == 0;
        if ($village->getField($i)['level'] >= $max || ($village->getField($i)['level'] + $village->getField($i)['upgrade_state']) == $max) {
            $color = 'maxLevel';
        } else {
            $item_id = $village->getField($i)['item_id'];
            $lvl = $village->getField($i)['level'] + $village->getField($i)['upgrade_state'] + 1;
            $cost = Formulas::buildingUpgradeCosts($item_id, $lvl);
            if (!$village->isWorkersBusy(FALSE, $item_id == 40)['isBusy'] && $village->isResourcesAvailable($cost) && !$village->checkArtifactDependencies($item_id) && $village->checkDependencies($item_id, $lvl) == 0) {
                $color = 'good';
            } else {
                $color = 'notNow';
            }
        }
        $aid = $i == 99 ? 'ww' : 'aid' . $i;
        if ($village->getField($i)['upgrade_state']) {
            return ($showColored ? 'colorLayer ' : '') . "$color $aid underConstruction";
        }
        return ($showColored ? 'colorLayer ' : '') . "$color $aid";
    }
}