<div class="questWrapper">
    <script type="text/javascript">
        Travian.Translation.add({
            'answers.<?php use Core\Session;use Core\Village;echo strtolower($vars['questId']);?>_title': "Travian Answers"
        });
    </script>
    <div class="questImage">
        <?php
        $isTutorial = \Model\Quest::getInstance()->isTutorial();
        if (!$isTutorial) {
            $class = '';
            if ($vars['questId'] == 'Battle_05' || $vars['questId'] == 'Battle_06' || $vars['questId'] == 'Battle_12' || $vars['questId'] == 'World_15') {
                $class = '_vid' . Session::getInstance()->getRace();
            }
            echo '<img id="questLogo" src="img/x.gif" class="enumerableElementsImage ' . strtolower($vars['questId']) . $class . '" style="" alt="' . T("Quest", $vars['questId'] . ".questTitle") . '">';
        } else if ($vars['questId'] == 'Tutorial_01' || ($vars['questId'] == 'Tutorial_14' && !$vars['isReward']) || ($vars['questId'] == 'Tutorial_02' && $vars['currentStep'] != 3) || $vars['questId'] == 'Tutorial_15a') {
            echo '<img id="questLogo" src="img/x.gif" class="enumerableElementsImage ' . strtolower($vars['questId'] == 'Tutorial_15a' ? 'Tutorial_15' : $vars['questId']) . '_' . ($vars['isReward'] ? 'reward' : 'task') . '_image_vid' . Session::getInstance()->getRace() . '" style="" alt="' . T("Quest", $vars['questId'] . ".questTitle") . '">';
        } else {
            echo '<img id="questLogo" src="img/x.gif" class="enumerableElementsImage ' . strtolower($vars['questId']) . '_' . ($vars['isReward'] ? 'reward' : 'task') . '_image" style="" alt="">';
        }
        ?>
        <?php if (!$vars['isReward'] && $isTutorial && $vars['questId'] != 'Tutorial_01' && ($vars['questId'] != 'Tutorial_02' || $vars['currentStep'] >= 2)): ?>
            <div class="tipsWrapper">
                <button type="button" id="questTutorialLightBulb"
                        class="layoutButton bulbActive green questButtonTipsToggle"
                        onclick="return false;">
                    <div class="button-container addHoverClick hover">
                        <i></i>
                    </div>
                </button>
                <script type="text/javascript">

                    if (jQuery('#questTutorialLightBulb').length > 0) {
                        jQuery('#questTutorialLightBulb').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "green",
                                "onclick": "return false;",
                                "loadTitle": false,
                                "boxId": "",
                                "disabled": false,
                                "speechBubble": "",
                                "class": "questButtonTipsToggle",
                                "id": "questTutorialLightBulb",
                                "redirectUrl": "",
                                "redirectUrlExternal": "",
                                "questButtonTipsToggle":<?=$vars['questButtonTipsToggle'] ? 'true' : 'false';?>,
                                "questButtonActivateTips": "<?=T("Quest", "questButtonActivateTips");?>",
                                "questButtonDeactivateTips": "<?=T("Quest", "questButtonDeactivateTips");?>"
                            }]);
                        });
                    }
                </script>
                <div
                        class="questTipsToggleDescription"><?= T("Quest", "questTipsToggleDescription"); ?></div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
    </div>
    <div class="questText">
        <h2 class="questTitle"><?= T("Quest", $vars['questId'] . ".questTitle"); ?></h2>

        <div class="questDescription">
            <div id="questDescription"
                 class="enumerableElementsDescription lala" style="" title="">
                <?php
                if ($vars['questId'] == 'Tutorial_01') {
                    echo sprintf(T("Quest", $vars['questId'] . ".questDescription"), Session::getInstance()->getName());
                } else {
                    if (!$vars['isReward']) {
                        echo T("Quest", $vars['questId'] . ".questDescription");
                    } else {
                        echo T("Quest", $vars['questId'] . ".questDescriptionReward");
                    }
                }
                ?>
            </div>
            <br/>
            <?php if (!$vars['isReward']): ?>
                <h4><?= T("Quest", "questTaskTitle"); ?>:</h4>
                <div class="questTasks">
                    <ul id="questTodolist">
                        <?php
                        $questTodolist = (array)T("Quest", $vars['questId'] . ".todo");
                        foreach ($questTodolist as $key => $todo) {
                            ++$key;
                            echo '<li class="' . ($vars['currentStep'] >= $key ? 'finished' : '') . '"><img src="img/x.gif" alt="" title="">' . $todo . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if (isset(T("Quest", ".")[$vars['questId']]['rewardDescription'])): ?>
                <h4 class="questRewardTitle"><?= T("Quest", "questRewardTitle"); ?>
                    :</h4>
                <div class="questRewards">
                    <?php
                    $description = T("Quest", $vars['questId'] . ".rewardDescription");
                    $description = preg_replace_callback("/\[STOCK_CSS_([\d]+)_([\d]+)\]/is", function ($matches) {
                        $resourceId = $matches[1];
                        $resourceValue = $matches[2];
                        $village = Village::getInstance();
                        $maxStore = $village->get($resourceId == 4 ? 'maxcrop' : 'maxstore');
                        if (($village->getCurrentResources($resourceId - 1) + $resourceValue) > $maxStore) {
                            return 'stockFull';
                        }
                        return null;
                    }, $description);
                    echo $description;
                    ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="questButtons">
        <?php
        if (strpos($vars['questId'], 'Tutorial') === false) {
            echo getButton(['type' => 'submit',
                'value' => T("Quest", "overview"),
                'class' => 'green questButtonOverview',
                'questButtonOverview' => true,
            ], ['data' => ['class' => 'green questButtonOverview',
                'type' => 'submit', 'questButtonOverview' => true,
                'questId' => $vars['questId'],
            ],
            ], T("Quest", "overview"));
        }
        if ($vars['questId'] == 'Tutorial_01' || $vars['questId'] == 'Tutorial_15') {
            echo getButton(['type' => 'submit',
                'value' => T("Quest", "continue"),
                'class' => 'green questButtonNext highlighted on',
                'questButtonNext' => true,
            ], ['data' => ['class' => 'green questButtonNext',
                'type' => 'submit', 'questButtonNext' => true,
                'questId' => $vars['questId'],
            ],
            ], T("Quest", "continue"));
        } else if ($vars['isReward']) {
            if (strpos($vars['questId'], 'Tutorial') !== false) {
                echo getButton(['type' => 'submit',
                    'value' => T("Quest", "getReward"),
                    'class' => 'green questButtonNext highlighted on',
                    'questButtonNext' => 1,
                ], ['data' => ['class' => 'green questButtonNext',
                    'type' => 'submit', 'questButtonNext' => true,
                    'questId' => $vars['questId'],
                ],
                ], T("Quest", "getReward"));
            } else {
                echo getButton(['type' => 'submit',
                    'value' => T("Quest", "getReward"),
                    'class' => 'green questButtonNext highlighted on',
                    'questbuttongainreward' => 1,
                ], ['data' => ['class' => 'green questButtonGainReward',
                    'type' => 'submit',
                    'questButtonGainReward' => true,
                    'questId' => $vars['questId'],
                ],
                ], T("Quest", "getReward"));
            }
        }
        if ($vars['questId'] == 'Tutorial_01') {
            echo getButton(['type' => 'submit',
                'value' => T("Quest", "skip"),
                'class' => 'green questButtonSkipTutorial',
                'questbuttonskiptutorial' => 1,
            ], ['data' => ['class' => 'green questButtonSkipTutorial',
                'type' => 'submit',
                'questButtonSkipTutorial' => true,
            ],
            ], T("Quest", "skip"));
        }
        ?>
        <div class="clear"></div>
    </div>
    <?php if ($vars['questId'] == 'Tutorial_02' && $vars['currentStep'] == 0): ?>
        <script type="text/javascript">
            Travian.Game.Quest.createHighlights();
        </script>
        <script type="text/javascript">
            jQuery('#dialogCancelButton').click(function () {
                Travian.ajax({
                    data: {cmd: 'quest', action: 'questWindowClosed'}, onSuccess: function () {
                        window.location.href = location.href;
                    }
                });
            });</script>
    <?php else: ?>
        <script>
            Travian.Game.Quest.tipsTurnoffAjaxTrigger = function () {
                Travian.ajax({
                    data: {
                        cmd: 'quest',
                        action: 'tipsOff'
                    }
                });
            }
        </script>
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
    <?php endif; ?>
</div>