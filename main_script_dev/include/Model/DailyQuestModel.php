<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein CH
 * Date: 10/10/14
 * Time: 12:37 PM
 */

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Game\ResourcesHelper;
use function getGame;

class DailyQuestModel
{
    private $quest_data      = [
        1  => ['reward' => 5, 'stepCount' => 1],
        2  => ['reward' => 3, 'stepCount' => 3],
        3  => ['reward' => 3, 'stepCount' => 3],
        4  => ['reward' => 5, 'stepCount' => 1],
        5  => ['reward' => 2, 'stepCount' => 3],
        6  => ['reward' => 4, 'stepCount' => 3],
        7  => ['reward' => 5, 'stepCount' => 3],
        8  => ['reward' => 3, 'stepCount' => 3], //changed
        9  => ['reward' => 3, 'stepCount' => 3], //changed
        10 => ['reward' => 5, 'stepCount' => 3],
        11 => ['reward' => 2, 'stepCount' => 3],
    ];
    private $quest_json_data = [
        "AchievementQuest_01" => [
            "id"          => "AchievementQuest_01",
            "name"        => "achievementQuests.achQuest_01_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 1,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_01_answer (en)%%#go2answer",
        ],
        "AchievementQuest_02" => [
            "id"          => "AchievementQuest_02",
            "name"        => "achievementQuests.achQuest_02_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_02_answer (en)%%#go2answer",
        ],
        "AchievementQuest_03" => [
            "id"          => "AchievementQuest_03",
            "name"        => "achievementQuests.achQuest_03_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_03_answer (en)%%#go2answer",
        ],
        "AchievementQuest_04" => [
            "id"          => "AchievementQuest_04",
            "name"        => "achievementQuests.achQuest_04_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 1,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_04_answer (en)%%#go2answer",
        ],
        "AchievementQuest_05" => [
            "id"          => "AchievementQuest_05",
            "name"        => "achievementQuests.achQuest_05_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_05_answer (en)%%#go2answer",
        ],
        "AchievementQuest_06" => [
            "id"          => "AchievementQuest_06",
            "name"        => "achievementQuests.achQuest_06_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_06_answer (en)%%#go2answer",
        ],
        "AchievementQuest_07" => [
            "id"          => "AchievementQuest_07",
            "name"        => "achievementQuests.achQuest_07_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_07_answer (en)%%#go2answer",
        ],
        "AchievementQuest_08" => [
            "id"          => "AchievementQuest_08",
            "name"        => "achievementQuests.achQuest_08_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_08_answer (en)%%#go2answer",
        ],
        "AchievementQuest_09" => [
            "id"          => "AchievementQuest_09",
            "name"        => "achievementQuests.achQuest_09_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_09_answer (en)%%#go2answer",
        ],
        "AchievementQuest_10" => [
            "id"          => "AchievementQuest_10",
            "name"        => "achievementQuests.achQuest_10_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_10_answer (en)%%#go2answer",
        ],
        "AchievementQuest_11" => [
            "id"          => "AchievementQuest_11",
            "name"        => "achievementQuests.achQuest_11_name",
            "category"    => "achievementquests",
            "stepType"    => "achievementtask",
            "currentStep" => NULL,
            "stepCount"   => 3,
            "steps"       => [
                [
                    "stepId"          => 0,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 1,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
                [
                    "stepId"          => 2,
                    "type"            => "achievementtask",
                    "stepDescription" => NULL,
                ],
            ],
            "answersLink" => "http://t4.answers.travian.com/index.php?aid=%%achievementQuests.achQuest_11_answer (en)%%#go2answer",
        ],
    ];

    public static function getAllianceContributionNeededForQuest()
    {
        return 1000;
    }

    public function setReward($uid)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT *, ((qst11*2)+(qst1*5)+(qst2*3)+(qst3*3)+(qst4*5)+(qst5*2)+(qst6*4)+(qst7*5)+(qst8*3)+(qst9*3)+(qst10*5)) `points` FROM daily_quest WHERE uid=$uid")->fetch_assoc();
        $points = $row['points'];
        if ($points >= 25 && !$row['reward1Type']) {
            $reward = mt_rand(1, 4);
            $db->query("UPDATE daily_quest SET reward1Type=$reward WHERE uid=$uid");
        }
        if ($points >= 50 && !$row['reward2Type']) {
            $reward = mt_rand(1, 5);
            $db->query("UPDATE daily_quest SET reward2Type=$reward WHERE uid=$uid");
        }
        if ($points >= 75 && !$row['reward3Type']) {
            $reward = mt_rand(1, 5);
            $db->query("UPDATE daily_quest SET reward3Type=$reward WHERE uid=$uid");
        }
        if ($points >= 100 && !$row['reward4Type']) {
            $reward = mt_rand(1, 4);
            $db->query("UPDATE daily_quest SET reward4Type=$reward WHERE uid=$uid");
        }
    }

    public function collectReward($uid, $kid, $which)
    {
        $db = DB::getInstance();
        $row = $db->query("SELECT uid, reward1Type, reward2Type, reward3Type, reward4Type, reward1Done, reward2Done, reward3Done, reward4Done,  ((qst11*2)+(qst1*5)+(qst2*3)+(qst3*3)+(qst4*5)+(qst5*2)+(qst6*4)+(qst7*5)+(qst8*3)+(qst9*3)+(qst10*5)) `points` FROM daily_quest WHERE uid=$uid")->fetch_assoc();
        $points = $row['points'];
        if ($points >= 25 && !$row['reward1Done'] && $which == 1) {
            $reward = $row['reward1Type'];
            if ($reward == 1) {
                $prize = self::calcEffect(200, 'res');
                //$db->query("UPDATE vdata SET wood=wood+$prize, clay=clay+$prize, iron=iron+$prize, crop=crop+$prize WHERE owner={$row['uid']} AND capital=1");
                $db->query("UPDATE vdata SET wood=wood+$prize, clay=clay+$prize, iron=iron+$prize, crop=crop+$prize WHERE kid=$kid");
            } else if ($reward == 2) {
                $prize = self::calcEffect(50, 'exp');
                $db->query("UPDATE hero SET exp=exp+$prize WHERE uid=$uid");
            } else if ($reward == 3) {
                $prize = self::calcEffect(50, 'cp');
                $db->query("UPDATE users SET cp=cp+$prize WHERE id=$uid");
            } else {
                $prize = self::calcEffect(1000, 'res');
                $rand = ['wood', 'clay', 'iron', 'crop'][mt_rand(0, 3)];
                //$db->query("UPDATE vdata SET $rand=$rand+$prize WHERE owner={$row['uid']} AND capital=1");
                $db->query("UPDATE vdata SET $rand=$rand+$prize WHERE kid=$kid");
            }
            $db->query("UPDATE daily_quest SET reward1Done=1 WHERE uid=$uid");
        } else if ($points >= 50 && !$row['reward2Done'] && $which == 2) {
            $reward = $row['reward2Type'];
            if ($reward == 1) {
                $this->addPlus($row['uid'], self::calcEffect(86400, 'plus'));
            } else {
                $this->addProductionBoost($row['uid'], $reward - 1, self::calcEffect(86400, 'productionBoost'));
            }
            $db->query("UPDATE daily_quest SET reward2Done=1 WHERE uid=$uid");
        } else if ($points >= 75 && !$row['reward3Done'] && $which == 3) {
            $reward = $row['reward3Type'];
            if ($reward == 1) {
                $m = new AuctionModel();
                $m->addItemToUser($row['uid'], 11, 106, self::calcEffect(5, 'item'));
            } else if ($reward == 2) {
                $m = new AuctionModel();
                $m->addItemToUser($row['uid'], 14, 109, self::calcEffect(5, 'item'));
            } else if ($reward == 3) {
                $m = new AuctionModel();
                $m->addItemToUser($row['uid'], 7, 112, self::calcEffect(5, 'item'));
            } else if ($reward == 4) {
                $m = new AuctionModel();
                $m->addItemToUser($row['uid'], 9, 114, self::calcEffect(5, 'item'));
            } else {
                $m = new AdventureModel();
                $total_adventures = Session::getInstance()->get('total_adventures');
                for ($i = 1; $i <= self::calcEffect(1, 'adv'); ++$i) {
                    $m->addAdventure($row['uid'], $total_adventures, time() + 10 * 86400);
                }
            }
            $db->query("UPDATE daily_quest SET reward3Done=1 WHERE uid=$uid");
        } else if ($points >= 100 && !$row['reward4Done'] && $which == 4) {
            $reward = $row['reward4Type'];
            if ($reward == 1) {
                $prize = self::calcEffect(400, 'cp');
                $db->query("UPDATE users SET cp=cp+$prize WHERE id={$row['uid']}");
            } else if ($reward == 2) {
                $prize = self::calcEffect(20000, 'res');
                $rand = ['wood', 'clay', 'iron', 'crop'][mt_rand(0, 3)];
                $db->query("UPDATE vdata SET $rand=$rand+$prize WHERE owner={$row['uid']} AND capital=1");
            } else if ($reward == 3) {
                $prize = self::calcEffect(400, 'exp');
                $db->query("UPDATE hero SET exp=exp+$prize WHERE uid={$row['uid']}");
            } else if ($reward == 4) {
                $prize = self::calcEffect(4000, 'res');
                $db->query("UPDATE vdata SET wood=wood+$prize, clay=clay+$prize, iron=iron+$prize, crop=crop+$prize WHERE owner={$row['uid']} AND capital=1");
            }
            $db->query("UPDATE daily_quest SET reward4Done=1 WHERE uid=$uid");
        }
    }

    public static function calcEffect($eff, $type, $asString = false)
    {
        return Quest::calcEffect($eff, $type, $asString, true);
    }

    protected function addPlus($uid, $till)
    {
        $db = DB::getInstance();
        $plusTill = $db->query("SELECT plus FROM users WHERE id=$uid")->fetch_assoc()['plus'];
        $showTo = $plusTill > time() ? $plusTill + $till : time() + $till;
        $db->query("UPDATE users SET plus=" . $showTo . " WHERE id=$uid");
        $m = new InfoBoxModel();
        $m->deleteInfoByType($uid, 1);
        $m->addInfo($uid, 0, 1, '', $showTo - 86400, $showTo + 86400);
    }

    protected function addProductionBoost($uid, $resourceId, $till)
    {
        $db = DB::getInstance();
        $boostTill = $db->fetchScalar("SELECT b{$resourceId} FROM users WHERE id=$uid");
        $villageModel = new VillageModel();
        $update = $boostTill < time();
        $showTo = $boostTill > time() ? $boostTill + $till : time() + $till;
        $db->query("UPDATE users SET b" . ($resourceId) . "=" . $showTo . " WHERE id=$uid");
        $m = new InfoBoxModel();
        $m->deleteInfoByType($uid, 1 + $resourceId);
        $m->addInfo($uid, 0, 1 + $resourceId, '', $showTo - 86400, $showTo + 86400);
        if ($update) {
            $villages = $db->query("SELECT kid FROM vdata WHERE owner=$uid");
            while ($row = $villages->fetch_assoc()) {
                ResourcesHelper::updateVillageResources($row['kid'], FALSE);
            }
        }
    }

    public function getQuestData($quest)
    {
        $json = [];
        for ($i = 1; $i <= 11; ++$i) {
            if (!$this->isQuestCompleted($i, $quest['qst' . $i])) {
                if ($i < 10) {
                    $i = '0' . $i;
                }
                $json['AchievementQuest_' . $i] = $this->quest_json_data['AchievementQuest_' . $i];
                $json['AchievementQuest_' . $i]['currentStep'] = $quest['qst' . (int)$i];
            }
        }
        return $json;
    }

    public function isQuestCompleted($questId, $stepId)
    {
        return $stepId >= $this->quest_data[(int)$questId]['stepCount'];
    }

    public function getAllianceContribution($uid)
    {
        $uid = (int)$uid;
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT alliance_contribution FROM daily_quest WHERE uid=$uid");
    }

    public function addDailyQuestRow($uid)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO daily_quest SET uid=$uid");
    }

    public function calcTotalPoints($quest)
    {
        $points = 0;
        for ($i = 1; $i <= 11; ++$i) {
            $points += $this->getQuestReward($i, $quest['qst' . $i]);
        }

        return $points;
    }

    public function getQuestReward($questId, $stepId)
    {
        return $this->quest_data[(int)$questId]['reward'] * $stepId;
    }

    public function getTotalCompletedQuests($quest)
    {
        $completed = 0;
        for ($i = 1; $i <= 11; ++$i) {
            if ($this->isQuestCompleted($i, $quest['qst' . $i])) {
                $completed++;
            }
        }

        return $completed;
    }

    public function getTotalQuestReward($questId)
    {
        return $this->quest_data[(int)$questId]['reward'] * $this->quest_data[(int)$questId]['stepCount'];
    }

    public function getQuest($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM daily_quest WHERE uid=$uid")->fetch_assoc();
    }

    public function getStepCount($id)
    {
        return $this->quest_data[(int)$id]['stepCount'];
    }

    public function resetDailyQuest()
    {
        $db = DB::getInstance();
        $config = Config::getInstance();
        $lastDailyQuestReset = $db->fetchScalar("SELECT lastDailyQuestReset FROM config");
        if ($lastDailyQuestReset == 0) {
            $today = strtotime('today 12:00', $config->game->start_time);
            $db->query("UPDATE config SET lastDailyQuestReset=$today");
            return;
        }
        if (($lastDailyQuestReset + getGame("dailyQuestInterval")) > time()) {
            return;
        }
        if ($lastDailyQuestReset == 0) $lastDailyQuestReset = $config->game->start_time;
        $db->query("UPDATE daily_quest SET alliance_contribution=0, qst1=0, qst2=0, qst3=0, qst4=0, qst5=0, qst6=0, qst7=0, qst8=0, qst9=0, qst10=0, qst11=0, reward1Type=0, reward2Type=0, reward3Type=0, reward4Type=0, reward1Done=0, reward2Done=0, reward3Done=0, reward4Done=0");
        $db->query("UPDATE config SET lastDailyQuestReset=" . ($lastDailyQuestReset + getGame("dailyQuestInterval")));
    }

    public function setQuestAsCompleted($uid, $questId)
    {
        $db = DB::getInstance();
        $column = 'qst' . $questId;
        $max = $this->quest_data[(int)$questId]['stepCount'];
        $db->query("UPDATE daily_quest SET $column=LEAST($column+1, $max) WHERE uid=$uid");
    }

    public function setQuestAsStep($uid, $questId, $step)
    {
        $db = DB::getInstance();
        $column = 'qst' . $questId;
        $max = $this->quest_data[(int)$questId]['stepCount'];
        $db->query("UPDATE daily_quest SET $column=LEAST($step, $max) WHERE uid=$uid");
    }
} 