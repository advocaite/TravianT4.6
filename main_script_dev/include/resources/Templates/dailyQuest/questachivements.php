<div class="questWrapper achievements mainDialog">
    <div class="birthdayRibbonContainer">
        <div class="headline"> <?php use Core\Config;
            use Core\Helper\TimezoneHelper;
            use Core\Session;
            use Model\DailyQuestModel;

            echo T("DailyQuest", "Daily Quests"); ?>
        </div>
    </div>
    <div class="clear">
    </div>
    <?php
    $m = new \Model\DailyQuestModel();
    $quest = $m->getQuest(Session::getInstance()->getPlayerId());
    $rewardReady = '<div class="bigSpeechBubble rewardReady"><img alt="" src="img/x.gif"></div>';
    ?>
    <div class="pointsAndAchievements">
        <div class="achievementPoints">
            <div
                    class="points"> <?=$total_points = $m->calcTotalPoints($quest); ?>
            </div>
            <div class="pointstext"> <?=T("DailyQuest", "points"); ?>
            </div>
        </div>
        <?php
        function getTitleOfThat($quest, $points)
        {
            $HTML = sprintf(T("DailyQuest", "you collected x points today!"), $points);
            $HTML .= '<br />';
            $HTML .= '<br />';
            $HTML .= T("DailyQuest", "Your Reward:") . ' ';
            $text = T('DailyQuest', 'reward_' . $points . '%_rows')[$quest['reward' . ($points / 25) . 'Type'] - 1];

            return $HTML . str_replace(['<li>', '</li>'], '', $text);
        }

        ?>
        <div id="achievementRewardList">
            <div class="verticalLine">
            </div>
            <div class="achievementArrow"><img src="img/x.gif"/>
            </div>
            <div class="achievement"
                 title="<?=$quest['reward1Done'] ? getTitleOfThat($quest, 25) : T("DailyQuest",
                     "reward_25%_desc"); ?>">
                <?php
                if ($total_points >= 25 && !$quest['reward1Done']) {
                    echo '<a href="#" class="quest" data-category="achievementrewards" data-questid="AchievementQuestReward_01">';
                    echo $rewardReady;
                }
                if ($quest['reward1Done']) {
                    echo '<div class="hook points_25"><img alt="" src="img/x.gif"></div>';
                } else {
                    echo '<div class="hook"><img class="hook hide" src="img/x.gif"></div>';
                }
                ?>
                <div class="pointAmount points_25"> 25
                </div>
                <img src="img/x.gif"
                     class="points_25 <?=$total_points >= 25 ? 'active' : 'inactive'; ?>"/>
                <?php
                if ($total_points >= 25 && !$quest['reward1Done']) {
                    echo '</a>';
                }
                ?>
            </div>
            <div class="achievementArrow"><img src="img/x.gif"/>
            </div>
            <div class="achievement"
                 title="<?=$quest['reward2Done'] ? getTitleOfThat($quest, 50) : T("DailyQuest",
                     "reward_50%_desc"); ?>">
                <?php
                if ($total_points >= 50 && !$quest['reward2Done']) {
                    echo '<a href="#" class="quest" data-category="achievementrewards" data-questid="AchievementQuestReward_02">';
                    echo $rewardReady;
                }
                if ($quest['reward2Done']) {
                    echo '<div class="hook points_50"><img alt="" src="img/x.gif"></div>';
                } else {
                    echo '<div class="hook"><img class="hook hide" src="img/x.gif"></div>';
                }
                ?>
                <div class="pointAmount points_50"> 50
                </div>
                <img src="img/x.gif"
                     class="points_50 <?=$total_points >= 50 ? 'active' : 'inactive'; ?>"/>
                <?php
                if ($total_points >= 50 && !$quest['reward2Done']) {
                    echo '</a>';
                }
                ?>
            </div>
            <div class="achievementArrow"><img src="img/x.gif"/>
            </div>
            <div class="achievement"
                 title="<?=$quest['reward3Done'] ? getTitleOfThat($quest, 75) : T("DailyQuest",
                     "reward_75%_desc"); ?>">
                <?php
                if ($total_points >= 75 && !$quest['reward3Done']) {
                    echo '<a href="#" class="quest" data-category="achievementrewards" data-questid="AchievementQuestReward_03">';
                    echo $rewardReady;
                }
                if ($quest['reward3Done']) {
                    echo '<div class="hook points_75"><img alt="" src="img/x.gif"></div>';
                } else {
                    echo '<div class="hook"><img class="hook hide" src="img/x.gif"></div>';
                }
                ?>
                <div class="pointAmount points_75"> 75
                </div>
                <img src="img/x.gif"
                     class="points_75 <?=$total_points >= 75 ? 'active' : 'inactive'; ?>"/>
                <?php
                if ($total_points >= 75 && !$quest['reward3Done']) {
                    echo '</a>';
                }
                ?>
            </div>
            <div class="achievementArrow"><img src="img/x.gif"/>
            </div>
            <div class="achievement"
                 title="<?=$quest['reward4Done'] ? getTitleOfThat($quest, 100) : T("DailyQuest",
                     "reward_100%_desc"); ?>">
                <?php
                if ($total_points >= 100 && !$quest['reward4Done']) {
                    echo '<a href="#" class="quest" data-category="achievementrewards" data-questid="AchievementQuestReward_04">';
                    echo $rewardReady;
                }
                if ($quest['reward4Done']) {
                    echo '<div class="hook points_100"><img alt="" src="img/x.gif"></div>';
                } else {
                    echo '<div class="hook"><img class="hook hide" src="img/x.gif"></div>';
                }
                ?>
                <div class="pointAmount points_100"> 100
                </div>
                <img src="img/x.gif"
                     class="points_100 <?=$total_points >= 100 ? 'active' : 'inactive'; ?>"/>
                <?php
                if ($total_points >= 100 && !$quest['reward4Done']) {
                    echo '</a>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
    <?php
    function achievement($id, \Model\DailyQuestModel $m, $quest)
    {
        $stepId = $quest['qst' . $id];
        $completed = $m->isQuestCompleted($id, $stepId);
        $HTML = '<tr class="' . (!$completed ? 'zebra' : '') . '">';
        $HTML .= '<td class="hook">';
        if ($completed) {
            $HTML .= '<img src="img/x.gif" class="hook done" title="' . T("DailyQuest",
                    "Quest is complete for today") . '" />';
        } else {
            if ($stepId) {
                $HTML .= '<img src="img/x.gif" class="hook working" title="' . T("DailyQuest",
                        "Quest is still open") . '" />';
            } else {
                $HTML .= '<img src="img/x.gif" class="hook hide" title="" />';
            }
        }
        $HTML .= '</td>';
        $HTML .= '<td class="steps">' . $stepId . '/' . $m->getStepCount($id) . '</td>';
        if ($completed) {
            $quest_name = T("DailyQuest", "questData." . (int)$id . ".name");
            if ($id == 11) {
                $quest_name = sprintf($quest_name, DailyQuestModel::getAllianceContributionNeededForQuest());
            }
            $HTML .= '<td class="questName"><span title="' . T("DailyQuest",
                    "Quest is complete for today") . '">' . $quest_name . '</span>';
        } else {
            if ($id < 10) {
                $id = '0' . $id;
            }
            $quest_name = T("DailyQuest", "questData." . (int)$id . ".name");
            if ($id == 11) {
                $quest_name = sprintf($quest_name, DailyQuestModel::getAllianceContributionNeededForQuest());
            }
            $HTML .= '<td class="questName"><a href="#" class="quest" data-category="achievementquests" data-questId="AchievementQuest_' . $id . '">' . $quest_name . '</a>';
        }
        $HTML .= '</td><td class="points">+ ' . ($m->getQuestReward($id,
                $stepId)) . ' / ' . $m->getTotalQuestReward($id) . '</td>';
        $HTML .= '</tr>';

        return $HTML;
    }

    ?>
    <hr class="achievementLine"/>
    <div class="achievement">
        <h1 class="questList"><?=T("DailyQuest", "Receive these free rewards every day!"); ?></h1>
        <div class="nextReset">
            <?php $config = Config::getInstance(); ?>
            (<?=sprintf(T("DailyQuest", "nextResetDesc"),
                TimezoneHelper::date("H:i",
                    ($config->dynamic->lastDailyQuestReset + getGame("dailyQuestInterval")))); ?>
            )
        </div>
        <table id="achievementQuestList">
            <?php
            echo achievement(11, $m, $quest);
            for ($i = 1; $i <= 10; ++$i) {
                echo achievement($i, $m, $quest);
            }
            ?>
        </table>
    </div>
</div>
<script type="text/javascript">
    jQuery(function () {
        Travian.Game.Quest.bindListDelegation(jQuery('table#achievementQuestList a.quest'));
        Travian.Game.Quest.bindListDelegation(jQuery('div#achievementRewardList a.quest'));
    });
</script>