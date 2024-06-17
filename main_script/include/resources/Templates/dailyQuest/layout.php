<div class="birthdayRibbonContainer">
    <div class="headline"> <?php use Model\DailyQuestModel;

        echo T("DailyQuest", "Daily Quests"); ?> </div>
</div>
<div class="clear"></div>
<div class="questWrapper achievements">
    <hr class="achievementLine "/>
    <div class="questTextHighlight"><strong> <?=$vars['currentStep']; ?>
            / <?=$vars['stepCount']; ?>
            <?php
            $quest_name = T("DailyQuest", "questData." . (int)$vars['questId'] . ".name");
            if ((int)$vars['questId'] == 11) {
                $quest_name = sprintf($quest_name, DailyQuestModel::getAllianceContributionNeededForQuest());
            }
            ?>
            <?= $quest_name; ?>
        </strong>
    </div>
    <hr class="achievementLine "/>
    <div class="questImage"><img id="questLogo" src="img/x.gif"
                                 class="enumerableElementsImage achievementQuest_<?=$vars['questId'] < 10 ? '0' . $vars['questId'] : $vars['questId']; ?>"
                                 style=""
                                 title="<?=$quest_name; ?>"
                                 alt="<?=$quest_name; ?>"/>
    </div>
    <div class="questText">
        <div class="questDescription">
            <div id="questDescription" class="enumerableElementsDiscription "
                 style="" title="">
                <?=T("DailyQuest", "questData." . (int)$vars['questId'] . ".desc"); ?>
                <br/>
                <br/><?=sprintf(T("DailyQuest", "The points for this quest can be achieved x times per day"), $vars['stepCount']); ?>
            </div>
        </div>
        <div class="questAchievementPoints">
            <strong><?=sprintf(T("DailyQuest", "This quest is worth + x points"), $vars['reward']); ?>
                <br/>
                <br/><?=sprintf(T("DailyQuest", "Points granted for this quest: + x / y"), $vars['total_reward'], $vars['total_quest_reward']); ?>
            </strong>
        </div>
        <hr class="achievementLine"/>
        <div class="questDifficulty">
            <strong>
                <div id="questDifficulty" class="enumerableElementsDiscription "
                     style="" title="">
                    <?=T("DailyQuest", "Difficulty"); ?>: <span
                            class="difficulty <?=$difficulty = T("DailyQuest", "questData." . (int)$vars['questId'] . ".difficulty"); ?>"><?=T("DailyQuest", "Difficulties.$difficulty"); ?></span>
                    <br/>
                    <br/><?=T("DailyQuest", "Requirement"); ?>
                    : <?=T("DailyQuest", "questData." . (int)$vars['questId'] . ".Requirement"); ?>
                </div>
            </strong>
        </div>
        <hr class="achievementLine "/>
    </div>
    <div class="clear"></div>
    <div class="questButtons">
        <button type="submit" value="<?=T("DailyQuest", "Overview"); ?>"
                id="<?=$button_id = get_button_id(); ?>"
                class="green questButtonOverviewAchievements"
                questButtonOverviewAchievements="1" onClick="return false;">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("DailyQuest", "Overview"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#<?=$button_id;?>')) {
                    jQuery('#<?=$button_id;?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("DailyQuest", "Overview");?>",
                            "name": "",
                            "id": "<?=$button_id;?>",
                            "class": "green questButtonOverviewAchievements",
                            "title": "",
                            "confirm": "",
                            "onclick": "",
                            "questButtonOverviewAchievements": true,
                            "onClick": "return false;"
                        }]);
                    });
                }
            });
        </script>
        <div class="clear"></div>
    </div>
</div>