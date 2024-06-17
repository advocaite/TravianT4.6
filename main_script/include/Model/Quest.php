<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Helper\PreferencesHelper;
use Core\Locale;
use Core\Session;
use Core\Village;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\GoldHelper;
use function get_locale;
use function getGame;
use function getGameSpeed;
use function miliseconds;
use function number_format_x;

class Quest
{
    static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private $qst_battle    = '0,0,0,0,0,0,0,0,0,0,0,0,0,0';
    private $qst_economy   = '0,0,0,0,0,0,0,0,0,0,0,0';
    private $qst_world     = '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0';
    private $quest_data    = [
        'Tutorial_01'  => [
            "id"                 => "Tutorial_01",
            "name"               => "questV2.tutorial_01_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 1,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_01_step_01_layoutdescription",
                ],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=332#go2answer",
            'highlightSelectors' => [
                [
                    [
                        "selector" => ".dialog.questInformation .questButtonNext",
                        "renderer" => "rectangle",
                    ],
                    [
                        "selector" => "#questmasterButton",
                        "renderer" => "rectangle",
                    ],
                ],
            ],
        ],
        'Tutorial_02'  => [
            'id'                 => 'Tutorial_02',
            'name'               => 'questV2.tutorial_02_name',
            'category'           => 'tutorial',
            'stepType'           => 'task',
            'currentStep'        => 0,
            "stepCount"          => 4,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => 'task',
                    "stepDescription" => 'questV2.tutorial_02_step_01_layoutdescription',
                ],
                [
                    "stepId"          => 1,
                    "type"            => 'task',
                    "stepDescription" => 'questV2.tutorial_02_step_02_layoutdescription',
                ],
                [
                    "stepId"          => 2,
                    "type"            => 'task',
                    "stepDescription" => 'questV2.tutorial_02_step_03_layoutdescription',
                ],
                ["stepId" => 3, "type" => 'reward'],
            ],
            "answersLink"        => 'http://t4.answers.travian.com/index.php?aid=332#go2answer',
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.dialog.questInformation .iconButton.small.cancel',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#questmasterButton',
                        'renderer' => 'rectangle',
                    ],
                ],
                1 => [
                    [
                        'selector' => '.dialog.questInformation .questButtonTipsToggle',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#questmasterButton',
                        'renderer' => 'rectangle',
                    ],
                ],
                2 => [
                    [
                        'selector' => '.dialog.questInformation .questButtonTipsToggle',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#questmasterButton',
                        'renderer' => 'rectangle',
                    ],
                ],
                3 => [],
            ],
        ],
        "Tutorial_03"  => [
            "id"                 => "Tutorial_03",
            "name"               => "questV2.tutorial_03_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_03_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_03_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward"],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=334#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.perspectiveResources #village_map .level.gid1.level0',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveResources #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [
                    [
                        'selector' => '.build .gid1.level0 button.build',
                        'renderer' => 'rectangle',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_04"  => [
            "id"                 => "Tutorial_04",
            "name"               => "questV2.tutorial_04_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_04_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_04_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward"],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.build .gid1.level1 button.build',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveResources #village_map .level.gid1.level1',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveResources #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [
                    [
                        'selector' => '.build .gid1.level1 button.build',
                        'renderer' => 'rectangle',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_05"  => [
            "id"                 => "Tutorial_05",
            "name"               => "questV2.tutorial_05_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_05_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_05_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward"],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.perspectiveResources #village_map .level.gid4.level0',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveResources #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [
                    [
                        'selector' => '.build .gid4.level0 button.build',
                        'renderer' => 'rectangle',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_06"  => [
            "id"                 => "Tutorial_06",
            "name"               => "questV2.tutorial_06_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_06_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_06_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward"],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.hero .attributesTab.normal',
                        'renderer' => 'rectangle',
                    ],
                    ['selector' => '#heroImageButton', 'renderer' => 'image'],
                ],
                1 => [
                    [
                        'selector' => '.hero_inventory .openCloseSwitchBar .openedClosedSwitch.switchClosed',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.hero_inventory #saveHeroAttributes.clayClicked',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.hero_inventory #setResource .resource.r2',
                        'renderer' => 'rectangle',
                    ],
                    ['selector' => '#heroImageButton', 'renderer' => 'image'],
                ],
                2 => [],
            ],
        ],
        "Tutorial_07"  => [
            "id"                 => "Tutorial_07",
            "name"               => "questV2.tutorial_07_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 1,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_07_step_01_layoutdescription",
                ],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.perspectiveResources #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
            ],
        ],
        "Tutorial_08"  => [
            "id"                 => "Tutorial_08",
            "name"               => "questV2.tutorial_08_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_08_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_08_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.perspectiveBuildings #village_map .iso',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '#build.gid0 .contentNavi .container.normal.infrastructure',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveResources #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [
                    [
                        'selector' => '#contract_building10 button.new',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #village_map .iso',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '#build.gid0 .contentNavi .container.normal.infrastructure',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveResources #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_09"  => [
            "id"                 => "Tutorial_09",
            "name"               => "questV2.tutorial_09_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_09_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_09_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.perspectiveBuildings #village_map .building.g16e',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveResources #navigation .inactive',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [
                    [
                        'selector' => '.build #contract_building16 button.new',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #village_map .building.g16e',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveResources #navigation .inactive',
                        'renderer' => 'image',
                    ],
                    [
                        'selector' => '.perspectiveBuildings #closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_10"  => [
            "id"                 => "Tutorial_10",
            "name"               => "questV2.tutorial_10_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 1,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_10_step_01_layoutdescription",
                ],
                ["stepId" => 1, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '#finishNowDialog button',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.finishNow button',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#closeContentButton',
                        'renderer' => 'image',
                    ],
                ],
                1 => [],
            ],
        ],
        "Tutorial_11"  => [
            "id"                 => "Tutorial_11",
            "name"               => "questV2.tutorial_11_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 1,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_11_step_01_layoutdescription",
                ],
                ["stepId" => 1, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.adventureSend button#start',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.hero .gotoAdventure',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '.hero .adventuresTab.normal',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#sidebarBoxHero .adventureWhite',
                        'renderer' => 'image',
                    ],
                ],
                1 => [],
            ],
        ],
        "Tutorial_12"  => [
            "id"                 => "Tutorial_12",
            "name"               => "questV2.tutorial_12_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_12_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_12_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '#content.reports .contentNavi .overview',
                        'renderer' => 'rectangle',
                    ],
                    ['selector' => '#navigation #n5 a', 'renderer' => 'image'],
                ],
                1 => [
                    [
                        'selector' => '.sub.newMessage',
                        'renderer' => 'rectangle',
                    ],
                ],
                2 => [],
            ],
        ],
        "Tutorial_13"  => [
            "id"                 => "Tutorial_13",
            "name"               => "questV2.tutorial_13_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_13_step_01_layoutdescription",
                ],
                [
                    "stepId"          => 1,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_13_step_02_layoutdescription",
                ],
                ["stepId" => 2, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '.hero .attributesTab.normal',
                        'renderer' => 'rectangle',
                    ],
                    ['selector' => '#heroImageButton', 'renderer' => 'image'],
                ],
                1 => [
                    [
                        'selector' => '#hero_inventory .item.male_item_106',
                        'renderer' => 'rectangle',
                    ],
                    [
                        'selector' => '#hero_inventory .item.female_item_106',
                        'renderer' => 'rectangle',
                    ],
                    ['selector' => '#heroImageButton', 'renderer' => 'image'],
                ],
                2 => [],
            ],
        ],
        "Tutorial_14"  => [
            "id"                 => "Tutorial_14",
            "name"               => "questV2.tutorial_14_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 3,
            "steps"              => [
                [
                    "stepId"          => 0,
                    "type"            => "task",
                    "stepDescription" => "questV2.tutorial_14_step_01_layoutdescription",
                ],
                ["stepId" => 1, "type" => "reward",],
            ],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [
                0 => [
                    [
                        'selector' => '#sidebarBoxQuestmaster button.bulbWhite',
                        'renderer' => 'image',
                    ],
                ],
                1 => [],
            ],
        ],
        "Tutorial_15"  => [
            "id"                 => "Tutorial_15",
            "name"               => "questV2.tutorial_15_name",
            "category"           => "tutorial",
            "stepType"           => "task",
            "currentStep"        => 0,
            "stepCount"          => 1,
            "steps"              => [["stepId" => 0, "type" => "task",]],
            "answersLink"        => "http://t4.answers.travian.com/index.php?aid=335#go2answer",
            'highlightSelectors' => [[],],
        ],
        'Tutorial_15a' => [
            'id'                 => 'Tutorial_15a',
            'name'               => 'questV2.tutorial_15a_name',
            'category'           => 'tutorial',
            'stepType'           => 'task',
            'currentStep'        => 0,
            "stepCount"          => 1,
            "steps"              => [["stepId" => 0, "type" => 'reward'],],
            "answersLink"        => 'http://t4.answers.travian.com/index.php?aid=332#go2answer',
            'highlightSelectors' => [0 => []],
        ],
    ];
    private $quest_battle  = [
        'questsTotal'     => 15,
        'questsCompleted' => 0,
        'name'            => 'battle',
        'quests'          => [
            "Battle_01" => [
                "id"          => "Battle_01",
                "name"        => "questV2.battle_01_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_02" => [
                "id"          => "Battle_02",
                "name"        => "questV2.battle_02_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_03" => [
                "id"          => "Battle_03",
                "name"        => "questV2.battle_03_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_15" => [
                "id"          => "Battle_15",
                "name"        => "questV2.battle_15_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_04" => [
                "id"          => "Battle_04",
                "name"        => "questV2.battle_04_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_05" => [
                "id"          => "Battle_05",
                "name"        => "questV2.battle_05_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_06" => [
                "id"          => "Battle_06",
                "name"        => "questV2.battle_06_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_07" => [
                "id"          => "Battle_07",
                "name"        => "questV2.battle_07_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_08" => [
                "id"          => "Battle_08",
                "name"        => "questV2.battle_08_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_09" => [
                "id"          => "Battle_09",
                "name"        => "questV2.battle_09_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_10" => [
                "id"          => "Battle_10",
                "name"        => "questV2.battle_10_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_11" => [
                "id"          => "Battle_11",
                "name"        => "questV2.battle_11_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_12" => [
                "id"          => "Battle_12",
                "name"        => "questV2.battle_12_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_13" => [
                "id"          => "Battle_13",
                "name"        => "questV2.battle_13_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Battle_14" => [
                "id"          => "Battle_14",
                "name"        => "questV2.battle_14_name",
                "category"    => "battle",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
        ],
    ];
    private $quest_economy = [
        'questsTotal'     => 12,
        'questsCompleted' => 0,
        'name'            => 'Economy',
        'quests'          => [
            "Economy_01" => [
                "id"          => "Economy_01",
                "name"        => "questV2.economy_01_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_02" => [
                "id"          => "Economy_02",
                "name"        => "questV2.economy_02_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_03" => [
                "id"          => "Economy_03",
                "name"        => "questV2.economy_03_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_04" => [
                "id"          => "Economy_04",
                "name"        => "questV2.economy_04_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_05" => [
                "id"          => "Economy_05",
                "name"        => "questV2.economy_05_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_06" => [
                "id"          => "Economy_06",
                "name"        => "questV2.economy_06_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_07" => [
                "id"          => "Economy_07",
                "name"        => "questV2.economy_07_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_08" => [
                "id"          => "Economy_08",
                "name"        => "questV2.economy_08_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_09" => [
                "id"          => "Economy_09",
                "name"        => "questV2.economy_09_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_10" => [
                "id"          => "Economy_10",
                "name"        => "questV2.economy_10_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_11" => [
                "id"          => "Economy_11",
                "name"        => "questV2.economy_11_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "Economy_12" => [
                "id"          => "Economy_12",
                "name"        => "questV2.economy_12_name",
                "category"    => "economy",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
        ],
    ];
    private $quest_world   = [
        'questsTotal'     => 16,
        'questsCompleted' => 0,
        'name'            => 'World',
        'quests'          => [
            "World_01" => [
                "id"          => "World_01",
                "name"        => "questV2.world_01_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_02" => [
                "id"          => "World_02",
                "name"        => "questV2.world_02_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_03" => [
                "id"          => "World_03",
                "name"        => "questV2.world_03_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_04" => [
                "id"          => "World_04",
                "name"        => "questV2.world_04_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_05" => [
                "id"          => "World_05",
                "name"        => "questV2.world_05_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_06" => [
                "id"          => "World_06",
                "name"        => "questV2.world_06_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_07" => [
                "id"          => "World_07",
                "name"        => "questV2.world_07_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_08" => [
                "id"          => "World_08",
                "name"        => "questV2.world_08_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_09" => [
                "id"          => "World_09",
                "name"        => "questV2.world_09_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_10" => [
                "id"          => "World_10",
                "name"        => "questV2.world_10_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_11" => [
                "id"          => "World_11",
                "name"        => "questV2.world_11_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_12" => [
                "id"          => "World_12",
                "name"        => "questV2.world_12_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_13" => [
                "id"          => "World_13",
                "name"        => "questV2.world_13_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_14" => [
                "id"          => "World_14",
                "name"        => "questV2.world_14_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_15" => [
                "id"          => "World_15",
                "name"        => "questV2.world_15_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
            "World_16" => [
                "id"          => "World_16",
                "name"        => "questV2.world_16_name",
                "category"    => "world",
                "stepType"    => "task",
                "currentStep" => 0,
                "stepCount"   => 2,
                "steps"       => [
                    [
                        "stepId"          => 0,
                        "type"            => "task",
                        "stepDescription" => NULL,
                    ],
                    ["stepId" => 1, "type" => "reward"],
                ],
                "answersLink" => "",
            ],
        ],
    ];

    public function getQuestInfoIcon($questId)
    {
        return $this->quest_data['Tutorial_' . ($questId == '15a' ? $questId : ($questId < 10 ? '0' . $questId : $questId))]['answersLink'];
    }

    public function hasNewReward()
    {
        if ($this->isTutorial()) {
            $currentQuest = explode("-", $this->getTutorial());

            return $this->quest_data['Tutorial_' . ($currentQuest[0] < 10 ? '0' . $currentQuest[0] : $currentQuest[0])]['steps'][$currentQuest[1]]['type'] == 'reward';
        }

        return FALSE;
    }

    public function getQuestData()
    {
        if ($this->isTutorial()) {
            $highlightsToggle = PreferencesHelper::getPreference("highlightsToggle") == 'true';
            $currentQuest = explode("-", $this->getTutorial());
            $questData['tipsTurnoffAjaxTrigger'] = $highlightsToggle;
            $questData['tutorialData'] = $this->quest_data['Tutorial_' . ($currentQuest[0] < 10 ? '0' . $currentQuest[0] : $currentQuest[0])];
            $questData['tutorialData']['currentStep'] = $currentQuest[1];
            $questData['tutorialData']['stepType'] = $this->quest_data['Tutorial_' . ($currentQuest[0] < 10 ? '0' . $currentQuest[0] : $currentQuest[0])]['steps'][$currentQuest[1]]['type'];
            $questData['highlightSelectors'] = $questData['tutorialData']['highlightSelectors'][$currentQuest[1]];
            if (!$highlightsToggle) {
                unset($questData['highlightSelectors']);
            }
            unset($questData['tutorialData']['highlightSelectors']);
            return $questData;
        } else {
            $questData = [
                'battle'  => $this->quest_battle,
                'economy' => $this->quest_economy,
                'world'   => $this->quest_world,
            ];
            foreach ($questData as $questName => $questSimpleData) {
                $reached = 0;
                foreach ($questSimpleData['quests'] as $key => $quest) {
                    $id = (int)filter_var($quest['id'], FILTER_SANITIZE_NUMBER_INT);
                    $questData[$questName]['quests'][$key]['currentStep'] = $this->getQuest($questName, $id);
                    if ($this->getQuest($questName, $id) > 0) {
                        $questData[$questName]['questsCompleted']++;
                    }
                    if (($questData[$questName]['quests'][$key]['currentStep'] == 2) || $reached >= 2) {
                        unset($questData[$questName]['quests'][$key]);
                        continue;
                    }
                    $reached++;
                    $questData[$questName]['quests'][$key]['stepType'] = $questData[$questName]['quests'][$key]['steps'][$questData[$questName]['quests'][$key]['currentStep']]['type'];
                }
            }

            return $questData;
        }
    }

    public function __construct()
    {
        $this->qst_battle = explode(",", Session::getInstance()->getQuestBattle());
        $this->qst_economy = explode(",", Session::getInstance()->getQuestEconomy());
        $this->qst_world = explode(",", Session::getInstance()->getQuestWorld());
        if (Session::getInstance()->getSuccessAdventuresCount() >= 10) {
            $this->setQuestBitwise("battle", 8, 1);
        }
        if (Session::getInstance()->getSuccessAdventuresCount() >= 5) {
            $this->setQuestBitwise("battle", 15, 1);
        }
    }

    public function isFullyCompleted()
    {
        if (Session::getInstance()->getQuest() == '-1') {
            return TRUE;
        }

        return FALSE;
    }

    public function isTutorial()
    {
        if ($this->getTutorial() != '0' && $this->getTutorial() != '-1') {
            return TRUE;
        }

        return FALSE;
    }

    public function getTutorial()
    {
        return Session::getInstance()->getQuest();
    }

    public function isReward($questId, $step)
    {
        if (!isset($this->quest_data[$questId]['steps'][$step]['type'])) {
            return FALSE;
        }

        return $this->quest_data[$questId]['steps'][$step]['type'] == 'reward';
    }

    public function setTutorial($x)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET qst_tut='$x' WHERE id=" . Session::getInstance()->getPlayerId());
        Session::getInstance()->setQuest($x);
    }

    const QUEST_FINISHED = 1;
    const QUEST_REWARDED = 2;

    public function setQuestBitwise($type, $id, $x)
    {
        if ($this->isFullyCompleted()) {
            return;
        }
        if ($type == 'battle') {
            $cate = &$this->qst_battle;
        } else if ($type == 'economy') {
            $cate = &$this->qst_economy;
        } else {
            $cate = &$this->qst_world;
        }
        if ($cate[$id - 1] >= $x) {
            return;
        }
        $cate[$id - 1] = $x;
        $db = DB::getInstance();
        $implode = implode(",", $cate);
        if ($type == 'battle') {
            Session::getInstance()->setQuestBattle($implode);
        } else if ($type == 'economy') {
            Session::getInstance()->setQuestEconomy($implode);
        } else {
            Session::getInstance()->setQuestWorld($implode);
        }
        $db->query("UPDATE users SET qst_" . $type . "='" . $implode . "' WHERE id=" . Session::getInstance()->getPlayerId());
    }

    public function getQuest($type, $id)
    {
        if ($this->isFullyCompleted()) {
            return FALSE;
        }
        $cate = $type == 'battle' ? $this->qst_battle : ($type == 'economy' ? $this->qst_economy : $this->qst_world);

        return $cate[$id - 1];
    }

    public function questBitwiseRewardMatch($type, $id)
    {
        if ($this->isFullyCompleted()) {
            return FALSE;
        }
        $match = $this->getQuest($type, $id);

        return $match == 1;
    }

    public function questNext()
    {
        if ($this->isFullyCompleted() || !$this->isTutorial()) {
            return FALSE;
        }
        $current = explode("-", $this->getTutorial());
        if ($current[0] == '15a') {
            $gold = new GoldHelper();
            $gold->giftPlus(Quest::calcEffect(86400, 'plus'));
            $db = DB::getInstance();
            $db->query("UPDATE users SET gift_gold=gift_gold+10 WHERE id=" . Session::getInstance()->getPlayerId());
            $village = Village::getInstance();
            for ($i = 1; $i <= 18; ++$i) {
                if ($village->getField($i)['item_id'] == 4 && $village->getField($i)['level'] == 0 && $village->getField($i)['upgrade_state'] == 0) {
                    BuildingAction::upgrade($village->getKid(), $i, 2);
                    break;
                }
            }
            for ($i = 1; $i <= 18; ++$i) {
                if ($village->getField($i)['item_id'] == 1 && $village->getField($i)['level'] == 0 && $village->getField($i)['upgrade_state'] == 0) {
                    BuildingAction::upgrade($village->getKid(), $i, 2);
                    break;
                }
            }
            for ($i = 1; $i <= 18; ++$i) {
                if ($village->getField($i)['item_id'] == 2 && $village->getField($i)['level'] == 0 && $village->getField($i)['upgrade_state'] == 0) {
                    BuildingAction::upgrade($village->getKid(), $i);
                    break;
                }
            }
            if ($village->getField(39)['item_id'] == 0 && $village->getField($i)['upgrade_state'] == 0) {
                $db->query("UPDATE fdata SET f39t=16 WHERE kid=" . $village->getKid());
                BuildingAction::upgrade($village->getKid(), 39);
            }
            $this->setTutorial('0');

            return TRUE;
        }
        if ($current[0] == 1) {
            $this->setTutorial('2-0');
            return TRUE;
        }
        if ($current[0] == 2 && $current[1] == 3) {
            $village = Village::getInstance();
            for ($i = 1; $i <= 18; ++$i) {
                if ($village->getField($i)['item_id'] == 2 && $village->getField($i)['level'] == 0 && $village->getField($i)['upgrade_state'] == 0) {
                    BuildingAction::upgrade($village->getKid(), $i);
                    break;
                }
            }
            $this->setTutorial('3-0');
            return TRUE;
        }
        if ($current[0] == 3 && $current[1] == 2) {
            $village = Village::getInstance();
            $db = DB::getInstance();
            foreach ($village->onLoadBuildings['normal'] as $build) {
                if ($village->getField($build['building_field'])['item_id'] == 1) {
                    $db->query("UPDATE building_upgrade SET commence=0 WHERE id={$build['id']}");
                    break;
                }
            }
            $this->setTutorial('4-0');

            return TRUE;
        }
        if ($current[0] == 4 && $current[1] == 2) {
            $village = Village::getInstance();
            $db = DB::getInstance();
            foreach ($village->onLoadBuildings['normal'] as $build) {
                if ($village->getField($build['building_field'])['item_id'] == 1) {
                    $db->query("UPDATE building_upgrade SET commence=0 WHERE id={$build['id']}");
                    break;
                }
            }
            $this->setTutorial('5-0');

            return TRUE;
        }
        if ($current[0] == 5 && $current[1] == 2) {
            $village = Village::getInstance();
            $db = DB::getInstance();
            $find = FALSE;
            foreach ($village->onLoadBuildings['normal'] as $build) {
                if ($village->getField($build['building_field'])['item_id'] == 4) {
                    $db->query("UPDATE building_upgrade SET commence=0 WHERE id={$build['id']}");
                    BuildingAction::upgrade($village->getKid(), $build['building_field']);
                    $find = TRUE;
                    break;
                }
            }
            if (!$find) {
                for ($i = 1; $i <= 18; ++$i) {
                    if ($village->getField($i)['item_id'] == 4 && $village->getField($i)['level'] == 1) {
                        BuildingAction::upgrade($village->getKid(), $i);
                        break;
                    }
                }
            }
            $this->setTutorial('6-0');

            return TRUE;
        }
        if ($current[0] == 6 && $current[1] == 2) {
            $village = Village::getInstance();
            $village->modifyResources($this->multiply([0, 200, 0, 0]), 1);
            $this->setTutorial('7-0');

            return TRUE;
        }
        if ($current[0] == 8 && $current[1] == 2) {
            $gold = new GoldHelper();
            $gold->giftPlus(Quest::calcEffect(86400, 'plus'));
            $this->setTutorial('9-0');
            return TRUE;
        }
        if ($current[0] == 9 && $current[1] == 2) {
            $db = DB::getInstance();
            $db->query("UPDATE users SET gift_gold=gift_gold+2 WHERE id=" . Session::getInstance()->getPlayerId());
            if (getGameSpeed() > 500) {
                //skipping this step on high speed servers
                $this->setTutorial('10-1');
            } else {
                $this->setTutorial('10-0');
            }
            return TRUE;
        }
        if ($current[0] == 10 && $current[1] == 1) {
            $db = DB::getInstance();
            $db->query("UPDATE users SET gift_gold=gift_gold+10 WHERE id=" . Session::getInstance()->getPlayerId());
            $this->setTutorial('11-0');

            return TRUE;
        }
        if ($current[0] == 11 && $current[1] == 1) {
            $db = DB::getInstance();
            $adventure = MovementsModel::ATTACKTYPE_ADVENTURE;
            $kid = Village::getInstance()->getKid();
            $db->query("UPDATE movement SET end_time=" . miliseconds() . " WHERE mode=0 AND attack_type=$adventure AND kid=$kid");
            $this->setTutorial('12-0');

            return TRUE;
        }
        if ($current[0] == 12 && $current[1] == 2) {
            $m = new AuctionModel();
            $m->addItemToUser(Session::getInstance()->getPlayerId(), 11, 106, self::calcEffect(10, 'item'));
            $this->setTutorial('13-0');
            return TRUE;
        }
        if ($current[0] == 13 && $current[1] == 2) {
            $db = DB::getInstance();
            $db->query("UPDATE hero SET exp=exp+20 WHERE uid=" . Session::getInstance()->getPlayerId());
            $this->setTutorial('14-0');

            return TRUE;
        }
        if ($current[0] == 14 && $current[1] == 1) {
            Village::getInstance()->modifyResources($this->multiply([270, 300, 270, 220]), 1);
            $this->setTutorial('15-0');

            return TRUE;
        }
        if ($current[0] == 15 && $current[1] == 0) {
            $this->setTutorial('0');
            //start other.
            return TRUE;
        }
        return FALSE;
    }

    public function multiply($x)
    {
        $rate = floor(getGameSpeed() / 5);
        if (getGameSpeed() <= 10 || !Config::getProperty("quest", "multiplyRewards")) $rate = 1;
        if (!is_array($x)) return $x * $rate;
        foreach ($x as $k => $v) {
            $x[$k] = $v * $rate;
        }
        return $x;
    }

    public static function effectToString($eff, $type)
    {
        switch ($type) {
            case 'adv':
            case 'item':
                return $eff;
                break;
            case 'res':
            case 'cp':
            case 'exp':
            case 'troops':
                return number_format_x($eff);
                break;
            case 'plus':
            case 'productionBoost':
                if ($eff >= 86400) {
                    return round($eff / 86400, 1) . ' ' . Locale::$translation_preloaded[get_locale()]['days'];
                } else if ($eff >= 3600) {
                    return round($eff / 3600, 1) . ' ' . Locale::$translation_preloaded[get_locale()]['hours'];
                }
                return round($eff / 60, 1) . ' ' . Locale::$translation_preloaded[get_locale()]['minutes'];
                break;
        }
        return $eff;
    }

    public static function calcEffect($eff, $type, $asString = false, $dailyQuest = false)
    {
        $rate = 1;
        if (Config::getProperty("quest", "multiplyRewards")) {
            switch ($type) {
                case 'adv':
                    break;
                case 'res':
                    $rate = floor(Config::getProperty("game", "speed") / 5);
                    break;
                case 'item':
                    $rate = floor(Config::getProperty("game", "speed") / 500);
                    break;
                case 'cp':

                    if (getGameSpeed() <= 10) {
                        if(!$dailyQuest){
                            $rate = 1 / getGameSpeed();
                        }
                    } else {
                        $rate = floor(Config::getProperty("game", "speed") / 100);
                    }
                    break;
                case 'exp':
                    $rate = Formulas::getHeroExpLevelMultiplier();
                    break;
                case 'troops':
                    $rate = floor(Config::getProperty("game", "speed") / 10);
                    break;
                case 'plus':
                    $divider = getGameSpeed() == 1 ? 7 : (getGameSpeed() == 2 ? 2 : 3);
                    $eff = ceil(Config::getProperty("gold", "plusAccountDurationSeconds") / $divider * 600) / 600;
                    break;
                case 'productionBoost':
                    $divider = getGameSpeed() == 1 ? 7 : (getGameSpeed() == 2 ? 2 : 3);
                    $eff = ceil(Config::getProperty("gold", "productionBoostDurationSeconds") / $divider * 600) / 600;
                    break;
            }
        }
        $eff *= $rate == 0 ? 1 : $rate;
        return $asString ? self::effectToString($eff, $type) : $eff;
    }
}