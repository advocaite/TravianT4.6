<div class="birthdayRibbonContainer">
    <div class="headline"> <?=T("DailyQuest", "Daily Quests"); ?> </div>
</div>
<div class="clear"></div>
<div class="questWrapper achievements">
    <h2 class="questTitle"><?=T("DailyQuest",
            "Congratulations! You have collected enough points to get a reward!"); ?></h2>
    <hr class="achievementLine"/>
    <div class="questImage"><img id="questLogo" src="img/x.gif"
                                 class="enumerableElementsImage AchievementQuestReward_0<?=$vars['qstNum']; ?>"
                                 style=""
                                 title="<?=sprintf(T("DailyQuest", "x points achieved"), $vars['points']); ?>"
                                 alt="<?=sprintf(T("DailyQuest", "x points achieved"), $vars['points']); ?>"/>
    </div>
    <div
            class="questDescription">
        <div id="questDescription" class="enumerableElementsDiscription "
             style=""
             title=""><?=sprintf(T("DailyQuest",
                "For collecting x points today, you can now collect your reward"),
                $vars['points']); ?>
            <br/>
            <?=T("DailyQuest", "Your daily reward is determined randomly from these options"); ?>
            :
            <br/>
            <br/>
            <ul>
                <?php
                $questPercent = $vars['qstNum'] * 25;
                foreach ((array)T("DailyQuest", "reward_{$questPercent}%_rows") as $translate) {
                    echo $translate . '<br />';
                }
                ?>
            </ul>
        </div>
        <h3 class="questRewardTitle"><?=sprintf(T("DailyQuest",
                "For collecting x points today, you receive the following reward"),
                $vars['points']); ?>
            :</h3>
        <?php
        echo T("DailyQuest", "reward_{$questPercent}%_rows")[$vars['questReward'] - 1];
        ?>
    </div>
    <div class="clear"></div>
    <hr class="achievementLine"/>
    <div class="questButtons">
        <button type="submit" value="<?=T("DailyQuest", "Overview"); ?>"
                id="<?=$button_id = get_button_id(); ?>"
                class="green questButtonOverviewAchievements"
                questButtonOverviewAchievements="1">
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
            jQuery(function () {
                if (jQuery('#<?=$button_id;?>')) {
                    jQuery('#<?=$button_id;?>').click(function () {
                        jQuery(window).trigger(
                            'buttonClicked', [
                                this, {
                                    "type": "submit",
                                    "value": "<?=T("DailyQuest", "Overview");?>",
                                    "name": "",
                                    "id": "<?=$button_id;?>",
                                    "class": "green questButtonOverviewAchievements",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": "",
                                    "questButtonOverviewAchievements": true
                                }
                            ]);
                    });
                }
            });
        </script>
        <button type="submit"
                value="<?=T("DailyQuest", "Collect reward"); ?>"
                id="<?=$button_id = get_button_id(); ?>"
                class="green questButtonGainReward"
                questId="AchievementQuestReward_0<?=$vars['qstNum']; ?>"
                questButtonGainReward="1">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("DailyQuest", "Collect reward"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                jQuery('#<?=$button_id;?>').click(function () {
                        jQuery(window).trigger(
                            'buttonClicked', [
                                this, {
                                    "type": "submit",
                                    "value": "<?=T("DailyQuest", "Collect reward");?>",
                                    "name": "",
                                    "id": "<?=$button_id;?>",
                                    "class": "green questButtonGainReward",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": "",
                                    "questId": "AchievementQuestReward_0<?=$vars['qstNum'];?>",
                                    "questButtonGainReward": true
                                }
                            ]);
                    });
            });
        </script>
        <div class="clear"></div>
    </div>
</div>