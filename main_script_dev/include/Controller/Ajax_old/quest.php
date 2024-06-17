<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Buildings\BuildingAction;
use Game\GoldHelper;
use Game\ResourcesHelper;
use Model\AuctionModel;
use Model\DailyQuestModel;
use Model\MessageModel;
use resources\View\PHPBatchView;

class Quest extends AjaxBase
{
    public function dispatch()
    {
        $quest = \Model\Quest::getInstance();
        $db = DB::getInstance();
        $session = Session::getInstance();
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == 'reward' && isset($_REQUEST['questTutorialId'])) {
                switch ($_REQUEST['questTutorialId']) {
                    case 'AchievementQuestReward_01':
                        (new DailyQuestModel())->collectReward($session->getPlayerId(), $session->getKid(), 1);
                        break;
                    case 'AchievementQuestReward_02':
                        (new DailyQuestModel())->collectReward($session->getPlayerId(), $session->getKid(), 2);
                        break;
                    case 'AchievementQuestReward_03':
                        (new DailyQuestModel())->collectReward($session->getPlayerId(), $session->getKid(), 3);
                        break;
                    case 'AchievementQuestReward_04':
                        (new DailyQuestModel())->collectReward($session->getPlayerId(), $session->getKid(), 4);
                        break;
                    case 'Battle_01':
                        if ($quest->questBitwiseRewardMatch("battle", 1)) {
                            $db->query("UPDATE hero SET exp=exp+30 WHERE uid=" . Session::getInstance()->getPlayerId(),
                                1);
                            $quest->setQuestBitwise("battle", 1, 2);
                        }
                        break;
                    case 'Battle_02':
                        if ($quest->questBitwiseRewardMatch("battle", 2)) {
                            Village::getInstance()->modifyResources($quest->multiply([130, 150, 120, 100,]), 1);
                            $quest->setQuestBitwise("battle", 2, 2);
                        }
                        break;
                    case 'Battle_03':
                        if ($quest->questBitwiseRewardMatch("battle", 3)) {
                            Village::getInstance()->modifyResources($quest->multiply([110, 140, 160, 30,]), 1);
                            $quest->setQuestBitwise("battle", 3, 2);
                        }
                        break;
                    case 'Battle_04':
                        if ($quest->questBitwiseRewardMatch("battle", 4)) {
                            Village::getInstance()->modifyResources($quest->multiply([190, 250, 150, 110,]), 1);
                            $quest->setQuestBitwise("battle", 4, 2);
                        }
                        break;
                    case 'Battle_05':
                        if ($quest->questBitwiseRewardMatch("battle", 5)) {
                            $m = new AuctionModel();
                            $m->addItemToUser(Session::getInstance()->getPlayerId(), 9, 114, 1);
                            $quest->setQuestBitwise("battle", 5, 2);
                        }
                        break;
                    case 'Battle_06':
                        if ($quest->questBitwiseRewardMatch("battle", 6)) {
                            Village::getInstance()->modifyResources($quest->multiply([120, 120, 90, 50,]), 1);
                            $quest->setQuestBitwise("battle", 6, 2);
                        }
                        break;
                    case 'Battle_07':
                        if ($quest->questBitwiseRewardMatch("battle", 7)) {
                            $num = \Model\Quest::calcEffect(2, 'troops');
                            $db->query("UPDATE units SET u1=u1+$num WHERE kid=" . Village::getInstance()->getKid(), 1);
                            ResourcesHelper::modifyUpkeep($this->session->getPlayerId(), $this->session->village->getKid(), $num);
                            $quest->setQuestBitwise("battle", 7, 2);
                        }
                        break;
                    case 'Battle_08':
                        if ($quest->questBitwiseRewardMatch("battle", 8)) {
                            //TODO: silver accounting...
                            $db->query("UPDATE users SET silver=silver+500 WHERE id=" . Session::getInstance()->getPlayerId(),
                                1);
                            $quest->setQuestBitwise("battle", 8, 2);
                        }
                        break;
                    case 'Battle_09':
                        if ($quest->questBitwiseRewardMatch("battle", 9)) {
                            Village::getInstance()->modifyResources($quest->multiply([280, 120, 220, 110,]), 1);
                            $quest->setQuestBitwise("battle", 9, 2);
                        }
                        break;
                    case 'Battle_10':
                        if ($quest->questBitwiseRewardMatch("battle", 10)) {
                            Village::getInstance()->modifyResources($quest->multiply([440, 290, 430, 240,]), 1);
                            $quest->setQuestBitwise("battle", 10, 2);
                        }
                        break;
                    case 'Battle_11':
                        if ($quest->questBitwiseRewardMatch("battle", 11)) {
                            Village::getInstance()->modifyResources($quest->multiply([210, 170, 245, 115,]), 1);
                            $quest->setQuestBitwise("battle", 11, 2);
                        }
                        break;
                    case 'Battle_12':
                        if ($quest->questBitwiseRewardMatch("battle", 12)) {
                            Village::getInstance()->modifyResources($quest->multiply([450, 435, 515, 550,]), 1);
                            $quest->setQuestBitwise("battle", 12, 2);
                        }
                        break;
                    case 'Battle_13':
                        if ($quest->questBitwiseRewardMatch("battle", 13)) {
                            Village::getInstance()->modifyResources($quest->multiply([500, 400, 700, 400,]), 1);
                            $quest->setQuestBitwise("battle", 13, 2);
                        }
                        break;
                    case 'Battle_14':
                        if ($quest->questBitwiseRewardMatch("battle", 14)) {
                            $m = new AuctionModel();
                            $num = \Model\Quest::calcEffect(10, 'item');
                            $m->addItemToUser(Session::getInstance()->getPlayerId(), 7, 112, $num);
                            $quest->setQuestBitwise("battle", 14, 2);
                        }
                        break;
                    case 'Battle_15':
                        if ($quest->questBitwiseRewardMatch("battle", 15)) {
                            $m = new AuctionModel();
                            $num = \Model\Quest::calcEffect(15, 'item');
                            $m->addItemToUser(Session::getInstance()->getPlayerId(), 11, 106, $num);
                            $quest->setQuestBitwise("battle", 15, 2);
                        }
                        break;
                    case 'Economy_01'://
                        if ($quest->questBitwiseRewardMatch("economy", 1)) {
                            $gold = new GoldHelper();
                            $time = \Model\Quest::calcEffect(86400, 'productionBoost');
                            //86400
                            $gold->giftProductionBoost(1, $time);
                            $gold->giftProductionBoost(2, $time);
                            $gold->giftProductionBoost(3, $time);
                            $gold->giftProductionBoost(4, $time);
                            $quest->setQuestBitwise("economy", 1, 2);
                        }
                        break;
                    case 'Economy_02':
                        if ($quest->questBitwiseRewardMatch("economy", 2)) {
                            Village::getInstance()->modifyResources($quest->multiply([160, 190, 150, 70,]), 1);
                            $quest->setQuestBitwise("economy", 2, 2);
                        }
                        break;
                    case 'Economy_03':
                        if ($quest->questBitwiseRewardMatch("economy", 3)) {
                            Village::getInstance()->modifyResources($quest->multiply([250, 290, 100, 130,]), 1);
                            $quest->setQuestBitwise("economy", 3, 2);
                        }
                        break;
                    case 'Economy_04':
                        if ($quest->questBitwiseRewardMatch("economy", 4)) {
                            Village::getInstance()->modifyResources($quest->multiply([400, 460, 330, 270,]), 1);
                            $quest->setQuestBitwise("economy", 4, 2);
                        }
                        break;
                    case 'Economy_05':
                        if ($quest->questBitwiseRewardMatch("economy", 5)) {
                            Village::getInstance()->modifyResources($quest->multiply([240, 255, 190, 160,]), 1);
                            $quest->setQuestBitwise("economy", 5, 2);
                        }
                        break;
                    case 'Economy_06':
                        if ($quest->questBitwiseRewardMatch("economy", 6)) {
                            Village::getInstance()->modifyResources($quest->multiply([600, 0, 0, 0,]), 1);
                            $quest->setQuestBitwise("economy", 6, 2);
                        }
                        break;
                    case 'Economy_07':
                        if ($quest->questBitwiseRewardMatch("economy", 7)) {
                            Village::getInstance()->modifyResources($quest->multiply([100, 99, 99, 99,]), 1);
                            $quest->setQuestBitwise("economy", 7, 2);
                        }
                        break;
                    case 'Economy_08':
                        if ($quest->questBitwiseRewardMatch("economy", 8)) {
                            Village::getInstance()->modifyResources($quest->multiply([400, 400, 400, 200,]), 1);
                            $quest->setQuestBitwise("economy", 8, 2);
                        }
                        break;
                    case 'Economy_09':
                        if ($quest->questBitwiseRewardMatch("economy", 9)) {
                            Village::getInstance()->modifyResources($quest->multiply([620, 730, 560, 230,]), 1);
                            $quest->setQuestBitwise("economy", 9, 2);
                        }
                        break;
                    case 'Economy_10':
                        if ($quest->questBitwiseRewardMatch("economy", 10)) {
                            Village::getInstance()->modifyResources($quest->multiply([880, 1020, 590, 320,]), 1);
                            $quest->setQuestBitwise("economy", 10, 2);
                        }
                        break;
                    case 'Economy_11':
                        if ($quest->questBitwiseRewardMatch("economy", 11)) {
                            $quest->setQuestBitwise("economy", 11, 2);
                            $village = Village::getInstance();
                            for ($i = 19; $i <= 38; ++$i) {
                                if ($village->getField($i)['item_id'] == 8 && Village::getInstance()->getField($i)['level'] == 1 && $village->getField($i)['upgrade_state'] == 0) {
                                    BuildingAction::upgrade($village->getKid(), $i);
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Economy_12':
                        if ($quest->questBitwiseRewardMatch("economy", 12)) {
                            $gold = new GoldHelper();
                            $time = \Model\Quest::calcEffect(86400, 'productionBoost');
                            $gold->giftProductionBoost(1, $time);
                            $gold->giftProductionBoost(2, $time);
                            $gold->giftProductionBoost(3, $time);
                            $gold->giftProductionBoost(4, $time);
                            $quest->setQuestBitwise("economy", 12, 2);
                        }
                        break;
                    case 'World_01':
                        if ($quest->questBitwiseRewardMatch("world", 1)) {
                            Village::getInstance()->modifyResources($quest->multiply([90, 120, 60, 30,]), 1);
                            $quest->setQuestBitwise("world", 1, 2);
                        }
                        break;
                    case 'World_02':
                        if ($quest->questBitwiseRewardMatch("world", 2)) {
                            //CP
                            $point = \Model\Quest::calcEffect(100, 'cp');
                            $db->query("UPDATE users SET cp=cp+$point WHERE id=" . Session::getInstance()->getPlayerId(),
                                1);
                            $quest->setQuestBitwise("world", 2, 2);
                        }
                        break;
                    case 'World_03':
                        if ($quest->questBitwiseRewardMatch("world", 3)) {
                            Village::getInstance()->modifyResources($quest->multiply([170, 100, 130, 70,]), 1);
                            $quest->setQuestBitwise("world", 3, 2);
                        }
                        break;
                    case 'World_04':
                        if ($quest->questBitwiseRewardMatch("world", 4)) {
                            Village::getInstance()->modifyResources($quest->multiply([215, 145, 195, 50,]), 1);
                            $quest->setQuestBitwise("world", 4, 2);
                        }
                        break;
                    case 'World_05':
                        if ($quest->questBitwiseRewardMatch("world", 5)) {
                            Village::getInstance()->modifyResources($quest->multiply([90, 160, 90, 95,]), 1);
                            $quest->setQuestBitwise("world", 5, 2);
                        }
                        break;
                    case 'World_06':
                        if ($quest->questBitwiseRewardMatch("world", 6)) {
                            Village::getInstance()->modifyResources($quest->multiply([280, 315, 200, 145,]), 1);
                            $quest->setQuestBitwise("world", 6, 2);
                        }
                        break;
                    case 'World_07':
                        if ($quest->questBitwiseRewardMatch("world", 7)) {
                            $quest->setQuestBitwise("world", 7, 2);
                            $db->query("UPDATE users SET gift_gold=gift_gold+20 WHERE id=" . Session::getInstance()->getPlayerId(),
                                1);
                        }
                        break;
                    case 'World_08':
                        if ($quest->questBitwiseRewardMatch("world", 8)) {
                            Village::getInstance()->modifyResources($quest->multiply([295, 210, 235, 185,]), 1);
                            $quest->setQuestBitwise("world", 8, 2);
                        }
                        break;
                    case 'World_09':
                        if ($quest->questBitwiseRewardMatch("world", 9)) {
                            Village::getInstance()->modifyResources($quest->multiply([570, 470, 560, 265,]), 1);
                            $quest->setQuestBitwise("world", 9, 2);
                        }
                        break;
                    case 'World_10':
                        if ($quest->questBitwiseRewardMatch("world", 10)) {
                            Village::getInstance()->modifyResources($quest->multiply([525, 420, 620, 335,]), 1);
                            $quest->setQuestBitwise("world", 10, 2);
                        }
                        break;
                    case 'World_11':
                        if ($quest->questBitwiseRewardMatch("world", 11)) {
                            Village::getInstance()->modifyResources($quest->multiply([650, 800, 740, 530,]), 1);
                            $quest->setQuestBitwise("world", 11, 2);
                        }
                        break;
                    case 'World_12':
                        if ($quest->questBitwiseRewardMatch("world", 12)) {
                            Village::getInstance()->modifyResources($quest->multiply([2650, 2150, 1810, 1320,]), 1);
                            $quest->setQuestBitwise("world", 12, 2);
                        }
                        break;
                    case 'World_13':
                        if ($quest->questBitwiseRewardMatch("world", 13)) {
                            Village::getInstance()->modifyResources($quest->multiply([800, 700, 750, 600,]), 1);
                            $quest->setQuestBitwise("world", 13, 2);
                        }
                        break;
                    case 'World_14':
                        if ($quest->questBitwiseRewardMatch("world", 14)) {
                            $point = \Model\Quest::calcEffect(500, 'cp');
                            $db->query("UPDATE users SET cp=cp+$point WHERE id=" . Session::getInstance()->getPlayerId(),
                                1);
                            $quest->setQuestBitwise("world", 14, 2);
                        }
                        break;
                    case 'World_15':
                        if ($quest->questBitwiseRewardMatch("world", 15)) {
                            Village::getInstance()->modifyResources($quest->multiply([1050, 800, 900, 750, 1,]), 1);
                            $quest->setQuestBitwise("world", 15, 2);
                        }
                        break;
                    case 'World_16':
                        if ($quest->questBitwiseRewardMatch("world", 16)) {
                            $gold = new GoldHelper();
                            $gold->giftPlus(\Model\Quest::calcEffect(172800, 'plus'));
                            $quest->setQuestBitwise("world", 16, 2);
                        }
                        break;
                    /** STEP-ID */
                }
                $this->response['reload'] = TRUE;
            } else if ($_REQUEST['action'] == 'skip') {
                if ($quest->getTutorial() == '1-0') {
                    $db->query("UPDATE users SET qst_tut='15a-0' WHERE id=" . Session::getInstance()->getPlayerId());
                    $this->response['reload'] = TRUE;
                }
            } else if ($_REQUEST['action'] == 'questWindowClosed') {
                if ($quest->getTutorial() == '2-0') {
                    $db->query("UPDATE users SET qst_tut='2-1' WHERE id=" . Session::getInstance()->getPlayerId());
                    $this->response['reload'] = TRUE;
                }
            } else if ($_REQUEST['action'] == 'tipsOff') {
                if ($quest->getTutorial() == '2-2') {
                    $db->query("UPDATE users SET qst_tut='2-3' WHERE id=" . Session::getInstance()->getPlayerId());
                    $this->response['reload'] = TRUE;
                }
            } else if ($_REQUEST['action'] == 'next') {
                if ($quest->questNext()) {
                    $this->response['reload'] = TRUE;
                }
            }
        } else {
            $questTutorialId = isset($_POST['questTutorialId']) ? $_POST['questTutorialId'] : NULL;
            if (strpos($questTutorialId, 'AchievementQuest_') !== FALSE) {
                $this->showDailyQuest((int)filter_var($questTutorialId, FILTER_SANITIZE_NUMBER_INT));
            } else if (strpos($questTutorialId, 'Tutorial_') !== FALSE) {
                $this->showTutorial($questTutorialId == 'Tutorial_15a' ? '15a' : (int)filter_var($questTutorialId, FILTER_SANITIZE_NUMBER_INT));
            } else if ($questTutorialId === NULL && !$quest->isTutorial()) {
                $this->showAll();
            } else if (strpos($questTutorialId, 'AchievementQuestReward_') !== FALSE) {
                $this->showDailyQuestReward((int)filter_var($questTutorialId, FILTER_SANITIZE_NUMBER_INT));
            } else if (!$quest->isTutorial()) {
                $this->showOther($questTutorialId);
            }
        }
    }

    private function showDailyQuest($questId)
    {
        $view = new PHPBatchView("dailyQuest/layout");
        $m = new DailyQuestModel();
        $quest = $m->getQuest(Session::getInstance()->getPlayerId());
        if ($m->isQuestCompleted($questId, $quest['qst' . $questId])) {
            return;
        }
        $view->vars['questId'] = $questId;
        $view->vars['currentStep'] = $quest['qst' . $questId];
        $view->vars['stepCount'] = $m->getStepCount($questId);
        $view->vars['reward'] = $m->getQuestReward($questId, 1);
        $view->vars['total_reward'] = $m->getQuestReward($questId, $quest['qst' . $questId]);
        $view->vars['total_quest_reward'] = $m->getTotalQuestReward($questId);
        $this->response['data']['html'] = $view->output();
        $this->response['data']['infoIcon'] = '';
        $this->response['data']['cssClass'] = 'white questInformation AchievementQuest_' . ($questId < 10 ? '0' . $questId : $questId) . ' quest';
    }

    private function showTutorial($questId)
    {
        $quest = \Model\Quest::getInstance();
        if (!$quest->isTutorial()) {
            setcookie("questTutorialId", '', -1);
            $this->response['javascript'] = <<<JS
            var c = Travian.WindowManager.getWindows();
            var d =(c.length) ? c[c.length-1]:null;
            if(c.length>0&&!!d){
                c[c.length-1].close()
            }
JS;
            return;
        }
        $current = explode('-', $quest->getTutorial());
        if ($current[0] != $questId) {
            $questId = $current[0];
        }
        $view = new PHPBatchView("quest/TutorialLayout");
        $view->vars['questId'] = 'Tutorial_' . ($questId == '15a' ? $questId : ($questId < 10 ? '0' . $questId : $questId));
        $view->vars['isReward'] = $quest->isReward($view->vars['questId'], isset($current[1]) ? $current[1] : '');
        $view->vars['currentStep'] = $current[1];
        $view->vars['questButtonTipsToggle'] = isset($_COOKIE['highlightsToggle']) ? $_COOKIE['highlightsToggle'] : TRUE;
        $this->response['data']['html'] = $view->output();
        $this->response['data']['infoIcon'] = '';//$quest->getQuestInfoIcon($questId)
        $this->response['data']['cssClass'] = 'white questInformation Tutorial_' . ($questId < 10 ? '0' . $questId : $questId) . ' tutorial';
        if ($current[0] == 2 && $current[1] == 1) {
            $quest->setTutorial('2-2');
            $this->response['reload'] = TRUE;
        }
    }

    private function showAll()
    {
        $view = new PHPBatchView("quest/TodoList");
        $this->response['data']['html'] = $view->output();
        $this->response['data']['infoIcon'] = '';//$quest->getQuestInfoIcon($questId)
        $this->response['data']['cssClass'] = 'white questTodoList';
    }

    private function showDailyQuestReward($questId)
    {
        $m = new DailyQuestModel();
        $quest = $m->getQuest(Session::getInstance()->getPlayerId());
        if ($quest['reward' . $questId . 'Done']) {
            return;
        }
        if (!$quest['reward' . $questId . 'Type']) {
            $m->setReward(Session::getInstance()->getPlayerId());
            $quest = $m->getQuest(Session::getInstance()->getPlayerId());
        }
        $view = new PHPBatchView("dailyQuest/reward");
        $view->vars['points'] = $questId * 25;
        $view->vars['qstNum'] = $questId;
        $view->vars['questReward'] = $quest['reward' . $questId . 'Type'];
        $this->response['data']['html'] = $view->output();
        $this->response['data']['infoIcon'] = '';
        $this->response['data']['cssClass'] = 'white questInformation AchievementQuestReward_' . ($questId < 10 ? '0' . $questId : $questId) . ' quest';
    }

    private function showOther($questId)
    {
        $quest = \Model\Quest::getInstance();
        $view = new PHPBatchView("quest/TutorialLayout");
        $view->vars['questId'] = $questId;
        if (strpos($questId, "Battle") !== FALSE) {
            $type = 'battle';
        } else if (strpos($questId, 'Economy') !== FALSE) {
            $type = 'economy';
        } else {
            $type = 'world';
        }
        $data = $quest->getQuestData();
        if (!isset($data[$type]['quests'][$questId])) {
            return;
        }
        $questData = $data[$type]['quests'][$questId];
        if ($questData['id'] === 'World_06' && $questData['stepType'] == 'task') {
            $m = new MessageModel();
            $m->sendQuestMessage(Session::getInstance()->getPlayerId());
        }
        $view->vars['isReward'] = $questData['stepType'] == 'reward';
        $view->vars['currentStep'] = $questData['currentStep'];
        $this->response['data']['html'] = $view->output();
        $this->response['data']['infoIcon'] = '';//$quest->getQuestInfoIcon($questId)
        $this->response['data']['cssClass'] = 'white questInformation ' . $questId . ' quest';
    }
}