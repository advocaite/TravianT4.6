<?php

use Core\Config;
use Game\Hero\SessionHero;

?>
<div id="attributes" class="hero-<?= ($vars['hero']['health'] == 0 ? "dead" : "alive"); ?>">
    <div id="attributes"
         class="<?= $vars['hero']['status'] == "101Regenerate" ? "hero-regenerate" : ($vars['hero']['status'] == 101 ? "hero-dead" : "hero-alive"); ?>">
        <div class="roundedCornersBox <?= $vars['hero']['status'] == "101Regenerate" ? "lightGreen" : ($vars['hero']['status'] == 101 ? "lightRed" : "lightGreen"); ?>">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents cf">
                <div class="attribute heroStatus">
                    <div class="heroStatusMessage <?= $vars['hero']['status'] == "101Regenerate" ? "header warning" : ($vars['hero']['status'] == 101 ? "header error" : ""); ?>">
                        <img alt="Held tot!" src="img/x.gif" class="heroStatus<?= $vars['hero']['status']; ?>">
                        <?= $vars['hero']['heroStatusMessage']; ?></div>
                </div>
                <div class="attribute heroStatus">
                    <?php if ($vars['hero']['status'] != '101'): ?>
                        <?= T("HeroInventory", !$vars['hero']['hide'] ? "HeroShowDesc" : "HeroHideDesc"); ?>
                    <?php endif; ?>
                </div>
                <?php if ($vars['hero']['status'] == '101'): ?>
                    <div class="attribute regenerate tooltip" title="">
                        <div class="element attributesHeadline">
                            <?= $vars['regenerate']['heroReviveDesc']; ?>
                        </div>
                        <div class="element attributesHeadline"><?= T("HeroInventory", "ReviveHeroInVillage"); ?></div>
                        <div class="element attributesHeadline"></div>
                        <div class="roundedCornersBox white">
                            <div class="element resourceDemandCaption"><?= T("HeroInventory",
                                    "ResourcesRequiredToReviveHero"); ?>:
                            </div>
                            <div class="clear"></div>
                            <form method="post" action="hero.php?t=1">
                                <input type="hidden" name="a" value="1">

                                <div class="inlineIconList resourceWrapper">
                                    <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?= $vars['regenerate']['costs'][0]; ?></span></div>
                                    <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?= $vars['regenerate']['costs'][1]; ?></span></div>
                                    <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?= $vars['regenerate']['costs'][2]; ?></span></div>
                                    <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?= $vars['regenerate']['costs'][3]; ?></span></div>
                                    <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value">6</span></div>
                                </div>

                                <div class="lineWrapper">
                                    <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?= secondsToString($vars['regenerate']['neededTime'], true); ?></span></div>
                                    <?= $vars['regenerate']['npc']; ?>
                                    <?php if ($vars['regenerate']['showButton']): ?>
                                        <button type="submit" value="ok" name="heroRegeneration" id="heroRegeneration"
                                                class="green startTraining">
                                            <div class="button-container addHoverClick ">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content"><?= T("HeroInventory", "Regenerate"); ?></div>
                                            </div>
                                        </button>
                                        <script type="text/javascript">
                                            jQuery(function () {
                                                if (jQuery('#heroRegeneration')) {
                                                    jQuery('#heroRegeneration').click(function (event) {
                                                        jQuery(window).trigger('buttonClicked', [this, {
                                                            "type": "submit",
                                                            "value": "ok",
                                                            "name": "heroRegeneration",
                                                            "id": "heroRegeneration",
                                                            "class": "green startTraining",
                                                            "title": "",
                                                            "confirm": "",
                                                            "onclick": ""
                                                        }]);
                                                    });
                                                }
                                            });
                                        </script>
                                    <?php endif; ?>
                                </div>
                                <div class="clear"></div>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <table cellspacing="0" cellpadding="0" class="transparent attributes noPointsToSet">
                        <tbody>
                        <tr class="attribute health tooltip" title="<?= htmlspecialchars($vars['HealthTitle']); ?>">
                            <td class="element attribName"><?= T("HeroInventory", "health"); ?></td>
                            <td class="element current powervalue">
                                <span class="value"><?= ($vars['hero']['regenerating'] ? $vars['hero']['regeneratedHealth'] : $vars['hero']['health']); ?>
                                    %‬‎</span>
                            </td>
                            <td class="element progress">
                                <div class="bar-bg">
                                    <div class="bar"
                                         style="width:<?= ($vars['hero']['regenerating'] ? $vars['hero']['regeneratedHealth'] : $vars['hero']['health']); ?>%;"></div>
                                    <div class="clear"></div>
                                </div>
                            </td>
                            <td class="element pointsValueSetter sub"></td>
                            <td class="element points"></td>
                            <td class="element pointsValueSetter add"></td>
                        </tr>

                        <tr class="attribute experience tooltip" title="<?= htmlspecialchars($vars['ExperienceTitle']); ?>">
                            <td class="element attribName"><?= T("HeroInventory", "experience"); ?></td>
                            <td class="element current powervalue">
                                <span class="value"><?= number_format_x($vars['hero']['exp']); ?></span>
                            </td>
                            <td class="element progress">
                                <div class="bar-bg">
                                    <div class="bar" style="width:<?= $vars['hero']['reachedExperience']; ?>%;"></div>
                                    <div class="clear"></div>
                                </div>
                            </td>
                            <td class="element pointsValueSetter sub"></td>
                            <td class="element points"></td>
                            <td class="element pointsValueSetter add"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
					        <span class="speed tooltip">
						        <?= T("HeroInventory", "speed"); ?>:
                                <strong id="heroSpeedValueNumber"
                                        class="current"><?= $vars['hero']['speed']; ?></strong>
                                <?= T("HeroInventory", "fieldPerHour"); ?></span>
                            </td>
                            <td class="pointsText" colspan="4">
                                <div class="production tooltip"
                                     title="<?= htmlspecialchars($vars['production_tooltip_title']); ?>">
        <span class="current">
        <?= $vars['production_tooltip']; ?>
        </span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clear"></div>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="roundedCornersBox">
        <h4><?php $hide = !(isset($_GET['flagAttributesBoxOpen']) || SessionHero::getInstance()->hasNewPoints()); ?>
            <div class="openCloseSwitchBar">
                <img alt="<?= T("Hero", "Attributes"); ?>" src="img/x.gif"
                     class="openedClosedSwitch switch<?= $hide ? 'Closed' : 'Opened'; ?>"/>
                <span class="title"><?= T("Hero", "Attributes"); ?></span>
                <span class="heroAttributesFormMessage notice hide "><?= T("HeroInventory", "SaveChanges"); ?></span>
                <?php if ($vars['hero']['points']): ?>
                    <span class="availablePoints">
        <?= T("HeroInventory", "availablePoints"); ?>
                        <span class="points"><?= $vars['hero']['points']; ?></span>
        </span>
                <?php endif; ?>
                <div class="clear"></div>
            </div>
        </h4>
        <div class="heroPropertiesContent <?= $hide ? 'hide' : ''; ?>">
            <div class="attribute res" id="setResource">
                <div class="changeResourcesHeadline"><?= T("HeroInventory", "changeResourcesHeadline"); ?></div>
                <div class="clear"></div>
                <div class="resourcePick">
                <div class="resource r0">

                    <label for="resourceHero0">
                        <input
                                class="radio"
                                type="radio"<?= $vars['hero']['r0'] ? ' checked="checked"' : ""; ?>
                                name="resource"
                                value="0"
                                id="resourceHero0"
                                checked="checked"/>
                        <i class="r0"></i>
                        <span class="current"><?= number_format_x($vars['hero']['allResourcesProduct'], 1e5); ?></span>
                    </label>
                </div>
                <div class="resource r1">

                    <label for="resourceHero1">
                        <input class="radio" type="radio"<?= $vars['hero']['r1'] ? ' checked="checked"' : ""; ?>
                               name="resource" value="1"
                               id="resourceHero1"/>
                        <i class="r1"></i>
                        <span class="current"><?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?></span>
                    </label>
                </div>
                <div class="resource r2">

                    <label for="resourceHero2">
                        <input class="radio" type="radio"<?= $vars['hero']['r2'] ? ' checked="checked"' : ""; ?>
                               name="resource" value="2"
                               id="resourceHero2"/>
                        <i class="r2"></i>
                        <span class="current"><?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?></span>
                    </label>
                </div>
                <div class="resource r3">
                    <label for="resourceHero3">
                        <input class="radio" type="radio"<?= $vars['hero']['r3'] ? ' checked="checked"' : ""; ?>
                               name="resource" value="3"
                               id="resourceHero3"/>
                        <i class="r3"></i>
                        <span class="current"><?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?></span>
                    </label>
                </div>
                <div class="resource r4">
                    <label for="resourceHero4">
                        <input class="radio" type="radio"<?= $vars['hero']['r4'] ? ' checked="checked"' : ""; ?>
                               name="resource" value="4" id="resourceHero4"/>
                        <i class="r4"></i>
                        <span class="current"><?= number_format_x($vars['hero']['eachResourceProduct'], 1e5); ?></span>
                    </label>
                </div>
                <div class="resource last">
                    <label class="baseCrop">
                        + <i class="r4"></i><span class="current">6</span>
                    </label>
                </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="attribute attackBehaviour">
                <div class="changeResourcesHeadline"><br/><?= T("HeroInventory", "attackBehaviourSettings"); ?>:</div>
                <div class="options">
                    <input class="radio" type="radio" id="attackBehaviourHide" name="attackBehaviour"
                           value="hide"<?= $vars['hero']['hide'] ? 'checked="checked"' : ''; ?> />
                    <label for="attackBehaviourHide"> <?= T("HeroInventory", "HeroHideDesc"); ?></label>
                    <br/><input class="radio" type="radio" id="attackBehaviourFight" name="attackBehaviour"
                                value="fight"<?= $vars['hero']['hide'] ? "" : ' checked="checked"'; ?> />
                    <label for="attackBehaviourFight">
                        <?= T("HeroInventory", "HeroShowDesc"); ?>
                    </label>
                </div>
            </div>
            <div class="clear"></div>
            <div class="roundedCornersBox">

                <table id="attributesOfHero" cellspacing="0" cellpadding="0"
                       class="transparent attributes <?= $vars['hero']['points'] ? "" : "noPointsToSet"; ?>">
                    <thead>
                    <tr>
                        <th class="headline">
                            <?= T("Hero", "Attributes"); ?></th>
                        <th colspan="5"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr id="attributepower" class="attribute power">
                        <td class="element attribName tooltip"
                            title="<?= htmlspecialchars($vars['HeroFightingStrengthTitle']); ?>"><?= T("HeroInventory",
                                "fightingStrength"); ?></td>
                        <td class="element current powervalue tooltip"
                            title="<?= htmlspecialchars($vars['HeroFightingStrengthTitle']); ?>">
                            <span class="value"><?= $vars['hero']['totalPower']; ?></span></td>
                        <td class="element progress tooltip"
                            title="<?= htmlspecialchars($vars['HeroFightingStrengthTitle']); ?>">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?= $vars['hero']['power']; ?>%;"></div>
                                <div class="bar setted" style="width: 0%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>
                        <td class="element pointsValueSetter sub">
                            <a class="setPoint" href="#"></a>
                        </td>
                        <td class="element points">
                            <?php if ($vars['hero']['points']): ?>
                                <input type="text" class="text" value="<?= $vars['hero']['power']; ?>"
                                       name="attributepower">
                            <?php else: ?>
                                <?= $vars['hero']['power']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="element pointsValueSetter add">
                            <a class="setPoint" href="#"></a>
                        </td>
                    </tr>
                    <tr id="attributeoffBonus" class="attribute offBonus">
                        <td class="element attribName tooltip"
                            title="<?= htmlspecialchars($vars['HeroOffBonusTitle']); ?>">
                            <?= T("HeroInventory", "offBonus"); ?>
                        </td>
                        <td class="element current powervalue tooltip"
                            title="<?= htmlspecialchars($vars['HeroOffBonusTitle']); ?>">
                            <span class="value"><?= round($vars['hero']['offBonus'] * 0.2, 1); ?></span>%
                        </td>
                        <td class="element progress tooltip"
                            title="<?= htmlspecialchars($vars['HeroOffBonusTitle']); ?>">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?= $vars['hero']['offBonus']; ?>%;"></div>
                                <div class="bar setted" style="width: 0%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>
                        <td class="element pointsValueSetter sub">
                            <a class="setPoint" href="#"></a>
                        </td>
                        <td class="element points">
                            <?php if ($vars['hero']['points']): ?>
                                <input type="text" class="text" value="<?= $vars['hero']['offBonus']; ?>"
                                       name="attributeoffBonus">
                            <?php else: ?>
                                <?= $vars['hero']['offBonus']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="element pointsValueSetter add">
                            <a class="setPoint" href="#"></a>
                        </td>
                    </tr>
                    <tr id="attributedefBonus" class="attribute defBonus">
                        <td class="element attribName tooltip" title="<?= htmlspecialchars($vars['DefBonusTitle']); ?>">
                            <?= T("HeroInventory", "defBonus"); ?>
                        <td class="element current powervalue tooltip"
                            title="<?= htmlspecialchars($vars['DefBonusTitle']); ?>">
                            <span class="value"><?= round($vars['hero']['defBonus'] * 0.2, 1); ?></span>%
                        </td>
                        <td class="element progress tooltip" title="<?= htmlspecialchars($vars['DefBonusTitle']); ?>">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?= $vars['hero']['defBonus']; ?>%;"></div>
                                <div class="bar setted" style="width: 0%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>
                        <td class="element pointsValueSetter sub">
                            <a class="setPoint" href="#"></a>
                        </td>
                        <td class="element points">
                            <?php if ($vars['hero']['points']): ?>
                                <input type="text" class="text" value="<?= $vars['hero']['defBonus']; ?>"
                                       name="attributedefBonus">
                            <?php else: ?>
                                <?= $vars['hero']['defBonus']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="element pointsValueSetter add">
                            <a class="setPoint" href="#"></a>
                        </td>
                    </tr>
                    <tr id="attributeproductionPoints" class="attribute productionPoints">
                        <td class="element attribName tooltip"
                            title="<?= htmlspecialchars($vars['heroProductBonusTitle']); ?>">
                            <?= T("HeroInventory", "productBonus"); ?>
                        </td>
                        <td class="element current powervalue tooltip"
                            title="<?= htmlspecialchars($vars['heroProductBonusTitle']); ?>">
                            <span class="value"><?= $vars['hero']['production']; ?></span></td>
                        <td class="element progress tooltip"
                            title="<?= htmlspecialchars($vars['heroProductBonusTitle']); ?>">
                            <div class="bar-bg">
                                <div class="bar" style="width:<?= $vars['hero']['production']; ?>%;"></div>
                                <div class="bar setted" style="width: 0%;"></div>
                                <div class="clear"></div>
                            </div>
                        </td>

                        <td class="element pointsValueSetter sub">
                            <a class="setPoint" href="#"></a>
                        </td>
                        <td class="element points">
                            <?php if ($vars['hero']['points']): ?>
                                <input type="text" class="text" value="<?= $vars['hero']['production']; ?>"
                                       name="attributeproductionPoints">
                            <?php else: ?>
                                <?= $vars['hero']['production']; ?>
                            <?php endif; ?>
                        </td>
                        <td class="element pointsValueSetter add">
                            <a class="setPoint" href="#"></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        </td>
                        <td class="pointsText availablePoints" colspan="2">
                            <?= T("HeroInventory", "availablePoints"); ?>:
                        </td>
                        <td class="pointsValue">
                            <span id="availablePoints"><?= $vars['hero']['points']; ?>/<?= $vars['hero']['points']; ?></span>
                        </td>
                        <td class="pointsEmptyColumn"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="saveHeroAttributes">
                <div class="saveHeroAttributes">
                    <button type="button" value="<?= T("HeroInventory", "save"); ?>" name="saveHeroAttributes"
                            id="saveHeroAttributes" class="green disabled" disabled="">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?= T("HeroInventory", "save"); ?></div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        jQuery(function () {
                            if (jQuery('#saveHeroAttributes')) {
                                jQuery('#saveHeroAttributes').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "button",
                                        "value": "<?=T("HeroInventory", "save");?>",
                                        "name": "saveHeroAttributes",
                                        "id": "saveHeroAttributes",
                                        "class": "green ",
                                        "title": "",
                                        "confirm": "",
                                        "onclick": ""
                                    }]);
                                });
                            }
                        });
                    </script>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(function () {
                    jQuery('.hero_inventory #attributes .openCloseSwitchBar').click(function (e) {
                        Travian.Game.Preferences.set('flagAttributesBoxOpen', !(Travian.Game.Preferences.get('flagAttributesBoxOpen')), false);
                        Travian.toggleSwitch(jQuery('.hero_inventory #attributes .heroPropertiesContent')[0], jQuery('.hero_inventory #attributes .openCloseSwitchBar .openedClosedSwitch')[0]);
                        jQuery('.hero_inventory #attributes .openCloseSwitchBar .availablePoints')[0].toggleClass('hide');
                    });

                    var attributeForm = new Travian.Game.Hero.Properties.PropertyForm();
                    attributeForm.addInputElementByName('saveHeroAttributes');
                    attributeForm.addInputElementByName('resource');
                    attributeForm.addInputElementByName('attackBehaviour');

                    <?php if($vars['hero']['points']):?>
                    var propertySetterElement = new Travian.Game.Hero.PropertySetter(attributeForm,
                        {
                            element: 'attributesOfHero',
                            elementAvailablePoints: 'availablePoints',
                            availablePoints: <?=$vars['hero']['points'];?>,
                            attributes: [
                                new Travian.Game.Hero.PropertySetter.Attribute.Power(
                                    {
                                        id: 'power',
                                        element: 'attributepower',
                                        value: <?=100 + $vars['hero']['power'] * $vars['hero']['fsperpoint'];?>,
                                        usedPoints: <?=$vars['hero']['power'];?>,
                                        maxPoints: 100,
                                        valueOfItems: <?=$vars['hero']['itemfs'];?>,
                                        valueBonus: <?=$vars['hero']['fsperpoint'];?>
                                    }),
                                new Travian.Game.Hero.PropertySetter.Attribute.OffBonus(
                                    {
                                        id: 'offBonus',
                                        element: 'attributeoffBonus',
                                        value: <?=$vars['hero']['offBonus'];?>,
                                        usedPoints: <?=$vars['hero']['offBonus'];?>,
                                        maxPoints: 100,
                                        valueOfItems: 0,
                                        valueBonus: 0
                                    }),
                                new Travian.Game.Hero.PropertySetter.Attribute.DefBonus(
                                    {
                                        id: 'defBonus',
                                        element: 'attributedefBonus',
                                        value: <?=$vars['hero']['defBonus'];?>,
                                        usedPoints: <?=$vars['hero']['defBonus'];?>,
                                        maxPoints: 100,
                                        valueOfItems: 0,
                                        valueBonus: 0
                                    }),
                                new Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints(
                                    {
                                        id: 'productionPoints',
                                        element: 'attributeproductionPoints',
                                        value: <?=$vars['hero']['production'];?>,
                                        usedPoints: <?=$vars['hero']['production'];?>,
                                        maxPoints: 100,
                                        valueOfItems: 0,
                                        valueBonus: 0
                                    })
                            ]
                        });
                    attributeForm.addElement('properties', propertySetterElement);
                    <?php endif;?>
                    attributeForm.onDirty(false);
                });
            </script>
        </div>
    </div>

</div>
<div id="bodyOptions">
    <div id="hero_body_container">
        <div id="hero_body">
            <img src="hero_body.php?uid=<?= $vars['hero']['uid']; ?>&size=inventory&<?= $vars['hero']['heroBodyHash']; ?>"
                 class="heroBodyImage heroBodyImage-<?= getDirection(); ?>"
                 alt="<?= T("HeroInventory", "Body"); ?>"/>

            <div class="clear"></div>
        </div>
        <div id="hero_body_content">
            <div class="content gender_<?= $vars['hero']['gender']; ?>">
                <div id="helmet" class="draggable"></div>
                <div id="leftHand" class="draggable"></div>
                <div id="rightHand" class="draggable"></div>
                <div id="body" class="draggable"></div>
                <div id="horse" class="draggable"></div>
                <div id="shoes" class="draggable"></div>
                <div id="bag" class="draggable"></div>
            </div>
        </div>
    </div>
</div>
<div id="hero_inventory">
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <div id="itemsToSale">
                <?php for ($i = 1; $i <= $vars['inventorySize']; ++$i): ?>
                    <div id="inventory_<?= $i; ?>" class="inventory draggable"></div>
                <?php endfor; ?>
                <div class="market">
                    <a class="buy arrow" href="hero.php?t=4&action=buy"><?= T("HeroInventory", "BuyItem"); ?>.</a>
                    <a class="sell arrow" href="hero.php?t=4&action=sell"><?= T("HeroInventory", "sellItem"); ?>.</a>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div id="placeHolder"></div>
<script type="text/javascript">
    jQuery(function () {
        Travian.Game.Hero.Inventory = new Travian.Game.Hero.Inventory(
            {
                isInVillage: <?=$vars['hero']['status'] == 100 ? 'true' : 'false';?>,
                isDead: <?=$vars['hero']['health'] == 0 ? 'true' : 'false';?>,
                isRegenerating: <?=$vars['hero']['status'] == '101Regenerate' ? 'true' : 'false';?>,
                heroState: {
                    experience: <?=$vars['hero']['exp'];?>,
                    culturePoints: <?=$vars['session']['cp'];?>
                },
                a: <?=$vars['hero']['kid'];?>,
                c: '<?=$vars['session']['checker'];?>',
                gender: '<?=$vars['hero']['gender'];?>',
                data: <?=$vars['HeroItems'];?>,
                text: {
                    notMoveableText: '<span class="itemNotMoveable"><?=T("HeroInventory",
                        "notMoveableText");?>.</span>',
                    notMoveableTextDead: '<span class="itemNotMoveable"><?=T("HeroInventory",
                        "notMoveableTextDead");?>.</span>',
                    moveDialogDescription: '<?=T("HeroInventory", "moveDialogDescription");?>: {inputField}',
                    useDialogDescription: '<?=T("HeroInventory", "useDialogDescription");?>: {inputField}',
                    useOneDialogTitle: '<?=T("HeroInventory", "useOneDialogTitle");?>',
                    moveDialogTitle: '<?=T("HeroInventory", "moveDialogTitle");?>',
                    useDialogTitle: '<?=T("HeroInventory", "useDialogTitle");?>',
                    buttonOk: '<?=T("HeroInventory", "buttonOk");?>',
                    buttonCancel: '<?=T("HeroInventory", "buttonCancel");?>'
                },
                elementHeroBody: jQuery('div#hero_body img'),
                heroBodyHash: '<?=$vars['hero']['heroBodyHash'];?>',
                urlBodyImage: 'hero_body.php?uid=<?=$vars['hero']['uid'];?>&amp;size=inventory&amp;{heroBodyHash}',
                useOneDialogTitleCallbacks: {
                    0: Travian.emptyFunction
                    <?=$vars['useOneDialogTitleCallbacks'];?>
                },
                afterRequestCallback: {
                    0: Travian.emptyFunction
                }
            });
    });
</script>