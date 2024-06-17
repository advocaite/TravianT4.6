<?php

namespace Controller\Build;

use Controller\AnyCtrl;
use Core\Config;
use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use Model\DailyQuestModel;
use resources\View\PHPBatchView;

class TownhallCntrl extends AnyCtrl
{
    public function __construct($index)
    {
        parent::__construct();
        $level = Village::getInstance()->getField($index)['level'];
        $this->view = new PHPBatchView("build/Townhall");
        $village = Village::getInstance();
        $helper = new GoldHelper();
        $this->view->vars['smallCelebration']['active'] = $village->getCP() > 0;
        $this->view->vars['smallCelebration']['points'] = Formulas::getCelebrationMaxCP(false, $village->getCP());
        $this->view->vars['smallCelebration']['cost'] = Formulas::celebrationCost(FALSE);
        $this->view->vars['smallCelebration']['time'] = secondsToString(Formulas::celebrationTime(FALSE, $level));
        if (Village::getInstance()->isResourcesAvailable($this->view->vars['smallCelebration']['cost'])) {
            $this->view->vars['smallCelebration']['exchangeButton'] = $helper->getExchangeResourcesButtonByCost($this->view->vars['smallCelebration']['cost']);
        } else {
            $this->view->vars['smallCelebration']['exchangeButton'] = NULL;
        }
        {
            $button = $this->getButton($index, FALSE);
            $this->view->vars['smallCelebration']['contractLink'] = $button['text'];
            $this->view->vars['smallCelebration']['npc'] = $button['npc'];
        }
        $this->view->vars['bigCelebration']['active'] = $level >= 10;
        $this->view->vars['bigCelebration']['points'] = Formulas::getCelebrationMaxCP(true,
            $this->getTotalCulturePoints(Session::getInstance()->getPlayerId()));
        $this->view->vars['bigCelebration']['cost'] = Formulas::celebrationCost(TRUE);
        $this->view->vars['bigCelebration']['time'] = secondsToString(Formulas::celebrationTime(TRUE, $level));
        if (Village::getInstance()->isResourcesAvailable($this->view->vars['bigCelebration']['cost'])) {
            $this->view->vars['bigCelebration']['exchangeButton'] = $helper->getExchangeResourcesButtonByCost($this->view->vars['bigCelebration']['cost']);
        } else {
            $this->view->vars['bigCelebration']['exchangeButton'] = NULL;
        }
        {
            $button = $this->getButton($index, TRUE);
            $this->view->vars['bigCelebration']['contractLink'] = $button['text'];
            $this->view->vars['bigCelebration']['npc'] = $button['npc'];
        }
        if ($this->view->vars['smallCelebration']['points'] == 0 && $this->view->vars['bigCelebration']['points'] == 0) {
            $this->view = NULL;
        } else {
            //process requests.
            if (!$this->isCelebrationRunning() && isset($_GET['z']) && $_GET['z'] == Session::getInstance()->getChecker() && isset($_GET['type']) && in_array($_GET['type'],
                    [1, 2,])) {
                if (Session::getInstance()->banned()) {
                    $this->innerRedirect("InGameBannedPage");
                } else if (Config::getInstance()->dynamic->serverFinished) {
                    $this->innerRedirect("InGameWinnerPage");
                } else if (Session::getInstance()->isInVacationMode()) {
                    $this->redirect('options.php?s=4');
                } else {
                    Session::getInstance()->changeChecker();
                    $type = (int)$_GET['type'];
                    $cost = Formulas::celebrationCost($type == 2);
                    if (Village::getInstance()->isResourcesAvailable($cost) && $this->view->vars[$type == 1 ? 'smallCelebration' : 'bigCelebration']['points'] && $this->view->vars[$type == 1 ? 'smallCelebration' : 'bigCelebration']['active']) {
                        $db = DB::getInstance();
                        if (Village::getInstance()->modifyResources($cost)) {
                            $celebration = time() + Formulas::celebrationTime($type == 2, $level);
                            $db->query("UPDATE vdata SET celebration=$celebration, type=$type WHERE kid=" . Village::getInstance()->getKid());
                            Village::getInstance()->setCelebration($celebration);
                            Village::getInstance()->setCelebrationType($_GET['type']);
                            $dailyQuest = new DailyQuestModel();
                            $dailyQuest->setQuestAsCompleted(Session::getInstance()->getPlayerId(), 10);
                            if ($type == 1) {
                                $cp = Formulas::getCelebrationMaxCP(false, $village->getCP());
                            } else {
                                $cp = Formulas::getCelebrationMaxCP(true,
                                    $this->getTotalCulturePoints(Session::getInstance()->getPlayerId()));
                            }
                            $owner = Session::getInstance()->getPlayerId();
                            $db->query("UPDATE users SET cp=cp+$cp WHERE id=$owner");
                            {
                                $button = $this->getButton($index, FALSE);
                                $this->view->vars['smallCelebration']['contractLink'] = $button['text'];
                                $this->view->vars['smallCelebration']['npc'] = $button['npc'];
                            }
                            {
                                $button = $this->getButton($index, TRUE);
                                $this->view->vars['bigCelebration']['contractLink'] = $button['text'];
                                $this->view->vars['bigCelebration']['npc'] = $button['npc'];
                            }
                        }
                    }
                }
            }
        }
        $this->view->vars['isCelebration'] = $this->isCelebrationRunning();
        if ($this->view->vars['isCelebration']) {
            $this->view->vars['type'] = Village::getInstance()->getCelebrationType();
            $this->view->vars['timeLeft'] = appendTimer(Village::getInstance()->getCelebration() - time());
            $this->view->vars['endat'] = TimezoneHelper::date("H:i", Village::getInstance()->getCelebration());
        }
    }

    private function getButton($id, $big)
    {
        if ($this->isCelebrationRunning()) {
            return [
                'npc' => null,
                'text' => '<div class="errorMessage">' . T("inGame", "one celebration is running") . '</div>',
            ];
        }
        $cost = Formulas::celebrationCost($big);
        if (Village::getInstance()->isResourcesAvailable($cost)) {
            return [
                'text' => getButton([
                    "type"    => "button",
                    "class"   => "green",
                    "onclick" => "window.location.href = 'build.php?id=$id&type=" . ($big ? 2 : 1) . "&z=" . Session::getInstance()->getChecker() . "'; return false;",
                    'value'   => T("inGame", "run celebration"),
                ],
                    ["data" => ["type" => "button",]],
                    T("inGame", "run celebration")),
                'npc' => null,
            ];
        }
        $contract = Village::getInstance()->contractResourcesLink($cost);
        $npc = null;
        if ($contract['code'] == -1) {
            $helper = new GoldHelper();
            $npc = $helper->getExchangeResourcesButtonByCost($cost);
        }
        return [
            'npc'  => $npc,
            'text' => $contract['text'],
        ];
    }

    private function isCelebrationRunning()
    {
        return Village::getInstance()->getCelebration() > time();
    }

    private function getTotalCulturePoints($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT SUM(cp) FROM vdata WHERE isWW=0 AND owner=$uid");
    }
}