<div id="sidebarBoxQuestmaster" class="sidebarBox   ">
    <div class="sidebarBoxBaseBox">
        <div class="baseBox baseBoxTop">
            <div class="baseBox baseBoxBottom">
                <div class="baseBox baseBoxCenter"></div>
            </div>
        </div>
    </div>
    <div class="sidebarBoxInnerBox">
        <div class="innerBox header ">
            <button id="questmasterButton" title=""
                    class="forceDisplayElement vid_<?php use Core\Helper\PreferencesHelper;
                    use Core\Session;

                    echo Session::getInstance()->getRace(); ?> highlighted on "
                    type="button">
                <img class="border" alt="" src="img/x.gif">
                <img class="animation" alt="" src="img/x.gif">
                <img class="mentor" alt="" src="img/x.gif">
                <?php if ($vars['hasNewReward']): ?>
                    <div class="bigSpeechBubble newQuestSpeechBubble" title="">
                        <img src="img/x.gif" alt="">
                    </div>
                <?php endif; ?>
            </button>
            <div class="buttonsWrapper">
            <button type="button"
                    id="<?=$button_id = get_button_id(); ?>"
                    class="layoutButton bulbWhite green  "
                    onclick="return false;" title="">
                <div class="button-container addHoverClick">
                    <i></i>
                </div>
            </button>

            <script type="text/javascript">

                if (jQuery('#<?=$button_id;?>')) {
                    jQuery('#<?=$button_id;?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "green",
                            "onclick": "return false;",
                            "loadTitle": false,
                            "boxId": "",
                            "disabled": false,
                            "speechBubble": "",
                            "class": "",
                            "id": "<?=$button_id;?>",
                            "redirectUrl": "",
                            "redirectUrlExternal": "",
                            "overlay": []
                        }]);
                    });
                }
            </script>
            </div>
            <div class="clear"></div>
            <div class="boxTitle"><?php
                if (isset($vars['tutorialSection']) && $vars['tutorialSection'] == 'Tutorial_15a') {
                    echo T("Quest", "SkipTutorial");
                } else if (isset($vars['tutorialSection']) && $vars['tutorialSection'] == 'Tutorial_01') {
                    echo T("Quest", "welcome");
                } else if (isset($vars['tutorialSection']) && $vars['tutorialSection'] == 'Tutorial_15') {
                    echo T("Quest", "endOfTutorial");
                } else {
                    echo T("Quest", "taskList");
                }
                ?></div>

            <script type="text/javascript">
                jQuery(function () {
                    Travian.Game.Quest.setOptions({
                        isTutorial: <?=$vars['isTutorial'] ? 'true' : 'false';?>
                    });
                    <?php if (!isset($vars['tutorialSection'])) {
                    $vars['tutorialSection'] = '';
                }?>
                    // Dialog an den Questmaster binden
                    jQuery('#questmasterButton').click(function (event) {
                        Travian.Game.Quest.mentorClick('<?=$vars['tutorialSection'];?>');
                    });
                });
            </script>
            <div>
                <script type="text/javascript">
                    Travian.Game.Quest.createHighlights();
                    Travian.Game.Quest.toggleHighlights(true);
                    jQuery('.questInformation .iconButton.small.cancel').click(function (event) {
                        setTimeout(function () {
                            Travian.Game.Quest.createHighlights();
                            Travian.Game.Quest.toggleHighlights(true);
                        }, 500);
                    });

                </script>
            </div>
        </div>
        <div class="innerBox content">
            <ul id="mentorTaskList" class="<?=$vars['isTutorial'] ? 'notClickable' : ''; ?>">
                <?php
                if ($vars['isTutorial']) {
                    $data = $vars['data']['tutorialData'];
                    $currentStep = $data['currentStep'];
                    $quest = Session::getInstance()->getQuest();
                    foreach ($data['steps'] as $step) {
                        if ($step['type'] == 'reward' && $quest != '15a-0') {
                            continue;
                        }
                        $stepId = $step['stepId'];
                        echo '<li>';
                        if ($currentStep > $stepId) {
                            echo '<img src="img/x.gif" class="finished">';
                        }
                        echo T("Quest", $data['id'] . ".steps.$stepId");
                        echo '</li>';
                    }
                } else {
                    $quest = \Model\Quest::getInstance();
                    foreach ($vars['data'] as $type => $task) {
                        foreach ($task['quests'] as $quest) {
                            foreach ($quest['steps'] as $step) {
                                if ($step['type'] == 'reward') {
                                    continue;
                                }
                                $stepId = $step['stepId'];
                                echo '<li data-questid="' . $quest['id'] . '" data-category="' . $type . '">';
                                if ($quest['currentStep'] == 1) {
                                    echo '<img src="img/x.gif" class="finished">';
                                }
                                echo '<a href="#" class="quest">' . T("Quest",
                                        explode(".", $quest['name'])[1]) . '</a>';
                                echo '</li>';
                            }
                        }
                    }
                }
                ?>
                <script type="text/javascript">
                    Travian.Translation.add('answers.tutorial_01_title', "Travian Answers");
                </script>
                <?php
                if (!isset($vars['data']['highlightSelectors'])) {
                    $vars['data']['highlightSelectors'] = [];
                }
                ?>
            </ul>
            <script type="text/javascript">
                jQuery(function () {
                    Travian.Game.Quest.setOptions(
                        <?php
                        if ($vars['isTutorial']) {
                            $highlightsToggle = PreferencesHelper::getPreference("highlightsToggle") == true ? 'true' : true;
                            echo '{tipsTurnoffAjaxTrigger: ' . ((bool)$highlightsToggle) . ',tutorialData: ' . json_encode($vars['data']['tutorialData']) . ',highlightSelectors: ' . json_encode($vars['data']['highlightSelectors']) . '}';
                        } else {
                            echo '{tipsTurnoffAjaxTrigger: false, tutorialData: {}, highlightSelectors: {}}';
                        }
                        ?>
                    );
                    Travian.Game.Quest.addListData(<?=json_encode(!$vars['isTutorial'] ? $vars['data'] : []);?>);

                    Travian.Game.Quest.bindListDelegation(jQuery('ul#mentorTaskList li'));
                    Travian.Game.Quest.createHighlights();
                    Travian.Game.Quest.initializeQuests();
                });
            </script>

        </div>
        <div class="innerBox footer">
        </div>
    </div>
</div>