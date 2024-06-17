<?php

use Core\Config;
use Game\ExtraModules;

?>
<?php if ($vars['isNew']): ?>
    <div class="build_desc">
        <a class="build_logo"
           onclick="return Travian.Game.iPopup(<?= $vars['itemId']; ?>, 4, 'gid');"
           href="#">
            <img class="build_logo big white g<?= $vars['itemId']; ?>"
                 alt="<?= T("Buildings", $vars['itemId'] . '.title'); ?>"
                 src="img/x.gif"/>
        </a>
        <?= T("Buildings", $vars['itemId'] . '.desc'); ?>
    </div>
    <?php if ($vars['showValuesTable']): ?>
        <table cellpadding="1" cellspacing="1" id="build_value">
            <?= $vars['valueTable']; ?>
        </table>
    <?php endif; ?>
    <?php if (Config::getInstance()->extraSettings->upgradeToMaxLevel->enabled || $vars['itemId'] == 10 || $vars['itemId'] == 11 || $vars['itemId'] == 38 || $vars['itemId'] == 39): ?>
        <script type="text/javascript">
            function getGidX() {
                return {additionalData: {gid: <?=$vars['building_field'];?>}};
            }
        </script>
    <?php endif; ?>
    <div id="contract" class="contractWrapper">
        <?php if ($vars['showCosts']): ?>
            <div class="contractText">
                <?= $vars['contractText']; ?>:
            </div>
            <div class="inlineIconList resourceWrapper">
                <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?= number_format_x($vars['cost'][0]); ?></span></div>
                <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?= number_format_x($vars['cost'][1]); ?></span></div>
                <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?= number_format_x($vars['cost'][2]); ?></span></div>
                <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?= number_format_x($vars['cost'][3]); ?></span></div>
                <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?= $vars['freeCrop']; ?></span></div>
            </div>
        <div class="lineWrapper">
            <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?= $vars['timeInString']; ?></span></div>
        </div>
        <?= $vars['npcButton']; ?>
        <?php endif; ?>
        <div class="contractLink">
            <?php echo($vars['contractLink']); ?>
        </div>
    </div>
    <?php if (ExtraModules::isEnabled('increaseStorage')): ?>
        <?php if ($vars['itemId'] == 10 || $vars['itemId'] == 11 || $vars['itemId'] == 38 || $vars['itemId'] == 39): ?>
            <div style="margin-<?= getDirection() == 'RTL' ? 'right' : 'left'; ?>: 385px; color: blue; font-weight: bold;">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <?php if (true/*$vars['itemId'] == 10 || $vars['itemId'] == 38*/): ?>
                    <?= T("Buildings", "increase warehouse storage by level 20 storage value"); ?>
                <?php else: ?>
                    <?= T("Buildings", "increase granny storage by level 20 storage value"); ?>
                <?php endif; ?>
                <br/>
                <?= T("Global", "Times"); ?>: <input
                        min="1"
                        onchange="onChangeTimes()"
                        onkeydown="onChangeTimes()"
                        onkeyup="onChangeTimes()"
                        type="number" class="text" id="times" value="1" style="width: 45px;">
                <?= ExtraModules::showButton("increaseStorage", 'getGidAndTimes'); ?>
                <script type="text/javascript">
                    function getGidAndTimes() {
                        return {
                            additionalData: {
                                gid: <?=$vars['building_field'];?>,
                                times: jQuery('#times').val()
                            }
                        };
                    }

                    var coins = jQuery("button.gold.increaseStorage").attr("coins");

                    function onChangeTimes() {
                        var times = jQuery('#times').val();
                        jQuery("button.gold.increaseStorage .goldValue").html(times * coins);
                    }
                </script>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="clear"></div>
<?php else: ?>
    <div id="descriptionAndInfo">
        <div class="build_desc">
            <?= T("Buildings", $vars['itemId'] . '.desc'); ?>
        </div>
        <div class="clear"></div>
        <?php if ($vars['showValuesTable']): ?>
            <table cellpadding="1" cellspacing="1" id="build_value">
                <?= $vars['valueTable']; ?>
            </table>
            <div class="clear"></div>
        <?php endif; ?>
    </div>
    <?php if (Config::getInstance()->extraSettings->upgradeToMaxLevel->enabled || $vars['itemId'] == 10 || $vars['itemId'] == 11 || $vars['itemId'] == 38 || $vars['itemId'] == 39): ?>
        <script type="text/javascript">
            function getGidX() {
                return {additionalData: {gid: <?=$vars['building_field'];?>}};
            }
        </script>
    <?php endif; ?>
    <?php if (!$vars['showCosts']): ?>
        <div class="roundedCornersBox big headlineOnly">
            <div class="stickyImage">
                <a class="build_logo" onclick="return Travian.Game.iPopup(<?= $vars['itemId']; ?>, 4);" href="#">
                    <img class="build_logo big black g<?= $vars['itemId']; ?>"
                         title="<?= T("Buildings", $vars['itemId'] . '.title'); ?>"
                         alt="<?= T("Buildings", $vars['itemId'] . '.title'); ?>" src="img/x.gif">
                </a>
            </div>
            <div class="upgradeBuilding completed">
                <div class="completedMessage"><span class="errorMessage"><?= $vars['contractLink']['main']; ?></span></div>
                <div class="culturePointsAndPopulation completed">
                    <div class="wrapper">
                        <div class="unit">
                            <i class="culturePoints_medium"></i>
                            <span class="value"><?=$vars['culturePointsAndPopulation']['cp'];?></span>
                            <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['cp'];?>&#8236;&#8236;)</span>
                        </div>
                        <div class="unit">
                            <i class="population_medium"></i>
                            <span class="value"><?=$vars['culturePointsAndPopulation']['pop'];?></span>
                            <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['pop'];?>&#8236;&#8236;)</span>
                        </div>
                        <?php if($vars['culturePointsAndPopulation']['infantryBonusTime']  !== null):?>
                            <div class="unit">
                                <i class="infantryBonusTime_medium"></i>
                                <span class="value"><?=$vars['culturePointsAndPopulation']['infantryBonusTime'];?>&#8236;%&#8236;</span>
                                <span class="delta">(&#8237;−&#8237;<?=$vars['nextLevelCpPop']['infantryBonusTime'];?>&#8236;%&#8236;)</span>
                            </div>
                        <?php endif;?>

                        <?php if($vars['culturePointsAndPopulation']['cavalryBonusTime']  !== null):?>
                            <div class="unit">
                                <i class="cavalryBonusTime_medium"></i>
                                <span class="value"><?=$vars['culturePointsAndPopulation']['cavalryBonusTime'];?>&#8236;%&#8236;</span>
                                <span class="delta">(<?=$vars['nextLevelCpPop']['cavalryBonusTime'];?>&#8236;%&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['merchantCap']  !== null):?>
                            <div class="unit">
                                <i class="merchantCap_small"></i>
                                <span class="value"><?=$vars['culturePointsAndPopulation']['merchantCap'];?>&#8236;&#8236;</span>
                                <span class="delta">(+<?=$vars['nextLevelCpPop']['merchantCap'];?>&#8236;&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['siegeTime'] !== null):?>
                            <div class="unit">
                                <i class="siegeTime_small"></i>
                                <span class="value">&#8237;&#8237;<?=$vars['culturePointsAndPopulation']['siegeTime'];?>&#8236;%&#8236;</span>
                                <span class="delta">(&#8237;−&#8237;<?=$vars['nextLevelCpPop']['siegeTime'];?>&#8236;%&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['maxTraps'] !== null):?>
                            <div class="unit">
                                <i class="maxTraps_medium"></i>
                                <span class="value">&#8237;&#8237;<?=$vars['culturePointsAndPopulation']['maxTraps'];?>&#8236;&#8236;</span>
                                <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['maxTraps'];?>&#8236;&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['warehouseCap']  !== null):?>
                            <div class="unit">
                                <i class="warehouseCap_medium"></i>
                                <span class="value"><?=number_format_x($vars['culturePointsAndPopulation']['warehouseCap']);?>&#8236;&#8236;</span>
                                <span class="delta">(&#8237;+&#8237;<?=number_format_x($vars['nextLevelCpPop']['warehouseCap']);?>&#8236;&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['granaryCap']  !== null):?>
                            <div class="unit">
                                <i class="granaryCap_medium"></i>
                                <span class="value"><?=number_format_x($vars['culturePointsAndPopulation']['granaryCap']);?>&#8236;&#8236;</span>
                                <span class="delta">(&#8237;+&#8237;<?=number_format_x($vars['nextLevelCpPop']['granaryCap']);?>&#8236;&#8236;)</span>
                            </div>
                        <?php endif;?>
                        <?php if($vars['culturePointsAndPopulation']['troopSpeed']  !== null):?>
                            <div class="unit">
                                <i class="troopSpeed_medium"></i>
                                <span class="value"><?=($vars['culturePointsAndPopulation']['troopSpeed']);?>&#8236;%&#8236;</span>
                                <span class="delta">(&#8237;+&#8237;<?=($vars['nextLevelCpPop']['troopSpeed']);?>&#8236;%&#8236;)</span>
                            </div>
                        <?php endif;?><?php if($vars['culturePointsAndPopulation']['crannyCap']  !== null):?>
                            <div class="unit">
                                <i class="crannyCap_small"></i>
                                <span class="value"><?=($vars['culturePointsAndPopulation']['crannyCap']);?>&#8236;&#8236;</span>
                                <span class="delta">(&#8237;+&#8237;<?=($vars['nextLevelCpPop']['crannyCap']);?>&#8236;&#8236;)</span>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="roundedCornersBox big">
            <div class="stickyImage">
                <a class="build_logo" onclick="return Travian.Game.iPopup(<?= $vars['itemId']; ?>, 4);" href="#">
                    <img class="build_logo big black g<?= $vars['itemId']; ?>"
                         title="<?= T("Buildings", $vars['itemId'] . '.title'); ?>"
                         alt="<?= T("Buildings", $vars['itemId'] . '.title'); ?>" src="img/x.gif">
                </a>
            </div>
            <h4><?= T("Buildings", $vars['itemId'] . '.title'); ?></h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                <div class="inlineIconList resourceWrapper">
                    <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?= number_format_x($vars['cost'][0]); ?></span></div>
                    <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?= number_format_x($vars['cost'][1]); ?></span></div>
                    <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?= number_format_x($vars['cost'][2]); ?></span></div>
                    <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?= number_format_x($vars['cost'][3]); ?></span></div>
                    <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?= $vars['freeCrop']; ?></span></div>
                </div>
            <?php if (isset($vars['contractLink']['noResources']) && $vars['contractLink']['noResources']): ?>
                <div class="upgradeBlocked">
                    <div class="errorMessage">
                        <?= $vars['contractLink']['main']; ?>
                       <span class="hide">
                       <?php
                       $time = \Core\Village::getInstance()->calcWhenResourcesAreAvailable($vars['cost']);
                       echo appendTimer($time);
                       ?>
                       </span>
                    </div>
                    <?= $vars['npcButton']; ?>
                 </div>
            <?php endif; ?>
            </div>
            <div class="culturePointsAndPopulation ">
                <div class="wrapper">
                    <div class="unit">
                        <i class="culturePoints_medium"></i>
                        <span class="value"><?=$vars['culturePointsAndPopulation']['cp'];?></span>
                        <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['cp'];?>&#8236;&#8236;)</span>
                    </div>
                    <div class="unit">
                        <i class="population_medium"></i>
                        <span class="value"><?=$vars['culturePointsAndPopulation']['pop'];?></span>
                        <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['pop'];?>&#8236;&#8236;)</span>
                    </div>
                    <?php if($vars['culturePointsAndPopulation']['infantryBonusTime']  !== null):?>
                        <div class="unit">
                            <i class="infantryBonusTime_medium"></i>
                            <span class="value"><?=$vars['culturePointsAndPopulation']['infantryBonusTime'];?>&#8236;%&#8236;</span>
                            <span class="delta">(&#8237;−&#8237;<?=$vars['nextLevelCpPop']['infantryBonusTime'];?>&#8236;%&#8236;)</span>
                        </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['cavalryBonusTime']  !== null):?>
                    <div class="unit">
                        <i class="cavalryBonusTime_medium"></i>
                        <span class="value"><?=$vars['culturePointsAndPopulation']['cavalryBonusTime'];?>&#8236;%&#8236;</span>
                        <span class="delta">(<?=$vars['nextLevelCpPop']['cavalryBonusTime'];?>&#8236;%&#8236;)</span>
                    </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['merchantCap']  !== null):?>
                    <div class="unit">
                        <i class="merchantCap_small"></i>
                        <span class="value"><?=$vars['culturePointsAndPopulation']['merchantCap'];?>&#8236;&#8236;</span>
                        <span class="delta">(+<?=$vars['nextLevelCpPop']['merchantCap'];?>&#8236;&#8236;)</span>
                    </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['siegeTime'] !== null):?>
                    <div class="unit">
                        <i class="siegeTime_small"></i>
                        <span class="value">&#8237;−&#8237;<?=$vars['culturePointsAndPopulation']['siegeTime'];?>&#8236;%&#8236;</span>
                        <span class="delta">(&#8237;−&#8237;<?=$vars['nextLevelCpPop']['siegeTime'];?>&#8236;%&#8236;)</span>
                    </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['maxTraps'] !== null):?>
                    <div class="unit">
                        <i class="maxTraps_medium"></i>
                        <span class="value">&#8237;&#8237;<?=$vars['culturePointsAndPopulation']['maxTraps'];?>&#8236;&#8236;</span>
                        <span class="delta">(&#8237;+&#8237;<?=$vars['nextLevelCpPop']['maxTraps'];?>&#8236;&#8236;)</span>
                    </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['warehouseCap']  !== null):?>
                        <div class="unit">
                            <i class="warehouseCap_medium"></i>
                            <span class="value"><?=number_format_x($vars['culturePointsAndPopulation']['warehouseCap']);?>&#8236;&#8236;</span>
                            <span class="delta">(&#8237;+&#8237;<?=number_format_x($vars['nextLevelCpPop']['warehouseCap']);?>&#8236;&#8236;)</span>
                        </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['granaryCap']  !== null):?>
                        <div class="unit">
                            <i class="granaryCap_medium"></i>
                            <span class="value"><?=number_format_x($vars['culturePointsAndPopulation']['granaryCap']);?>&#8236;&#8236;</span>
                            <span class="delta">(&#8237;+&#8237;<?=number_format_x($vars['nextLevelCpPop']['granaryCap']);?>&#8236;&#8236;)</span>
                        </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['troopSpeed']  !== null):?>
                        <div class="unit">
                            <i class="troopSpeed_medium"></i>
                            <span class="value"><?=($vars['culturePointsAndPopulation']['troopSpeed']);?>&#8236;%&#8236;</span>
                            <span class="delta">(&#8237;+&#8237;<?=($vars['nextLevelCpPop']['troopSpeed']);?>&#8236;%&#8236;)</span>
                        </div>
                    <?php endif;?>
                    <?php if($vars['culturePointsAndPopulation']['crannyCap']  !== null):?>
                        <div class="unit">
                            <i class="crannyCap_small"></i>
                            <span class="value"><?=($vars['culturePointsAndPopulation']['crannyCap']);?>&#8236;&#8236;</span>
                            <span class="delta">(&#8237;+&#8237;<?=($vars['nextLevelCpPop']['crannyCap']);?>&#8236;&#8236;)</span>
                        </div>
                    <?php endif;?>
                </div>
            </div>
            <?php
            $plusAdvertising = !empty($vars['contractLink']['plus']) && !empty($vars['contractLink']['master']);
            $has = $plusAdvertising || !empty($vars['contractLink']['extraModuleButton']);
            ?>
            <div class="upgradeButtonsContainer<?= ($has ? ' section2Enabled' : ''); ?>">
                <div class="section1">
                    <?php if (!(isset($vars['contractLink']['noResources']) && $vars['contractLink']['noResources'])): ?>
                    <?php if (!is_null($vars['contractLink']['main'])): ?>
                            <?= $vars['contractLink']['main']; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?= $vars['contractLink']['master']; ?>
                    <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?= $vars['timeInString']; ?></span></div>
                    <?php if (isset($vars['contractLink']['waitLoop']) && $vars['contractLink']['waitLoop']): ?>
                        <span class="none">(<?= T("Buildings", "waitLoop"); ?>)</span>
                    <?php endif; ?>
                    </div>
                <div class="section2">
                    <?php if ($plusAdvertising): ?>
                        <div class="plusAdvertising">
                            <?= str_replace(['<br />', '<br>', '<br/>'],'', $vars['contractLink']['plus']); ?>
                        </div>
                    <?php endif; ?>
                    <?= str_replace(['<br />', '<br>', '<br/>'],'', $vars['contractLink']['extraModuleButton']); ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <?php if (ExtraModules::isEnabled('increaseStorage') && ($vars['itemId'] == 10 || $vars['itemId'] == 11 || $vars['itemId'] == 38 || $vars['itemId'] == 39)): ?>
        <div class="roundedCornersBox big">
            <h4>
                <div class="statusMessage"
                     style="color: midnightblue"><?php if (true/*$vars['itemId'] == 10 || $vars['itemId'] == 38*/): ?>
                        <?= T("Buildings", "increase warehouse storage by level 20 storage value"); ?>
                    <?php else: ?>
                        <?= T("Buildings", "increase granny storage by level 20 storage value"); ?>
                    <?php endif; ?>
                </div>
            </h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                <div class="contractLink centeredText">
                    <?= T("Global", "Times"); ?>: <input
                            onchange="onChangeTimes()"
                            type="number" id="times" class="text" value="1" style="width: 45px;">
                    <?= ExtraModules::showButton("increaseStorage", 'getGidAndTimes'); ?>
                    <script type="text/javascript">
                        function getGidAndTimes() {
                            return {
                                additionalData: {
                                    gid: <?=$vars['building_field'];?>,
                                    times: jQuery('#times').val()
                                }
                            };
                        }

                        var coins = jQuery("button.gold.increaseStorage").attr("coins");

                        function onChangeTimes() {
                            var times = jQuery('#times').val();
                            jQuery("button.gold.increaseStorage .goldValue").html(times * coins);
                        }
                    </script>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <div class="clear"></div>
<?php endif; ?>