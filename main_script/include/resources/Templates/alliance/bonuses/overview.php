<?php
use Controller\Ajax\allianceBonusOverview;
use Core\Helper\PreferencesHelper;
use Model\AllianceBonusModel;
$preference = PreferencesHelper::getPreference('allianceBonusesOverview');
?>
<div class="roundedCornersBox bonusBox" id="bonusBox0">
    <?php $open = $preference['bonusInfo0'];?>
    <h4>
        <button type="button" class="icon bonusCollapse" ref="bonusInfo0">
            <img src="img/x.gif" class="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>" alt="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>"/>
        </button>
        <span>
            <strong><?= T("AllianceBonus", "Recruitment"); ?></strong>
            -
            <?= T("AllianceBonus", "Faster troop production bonus"); ?>
        </span>
    </h4>
    <?= allianceBonusOverview::renderProgressBar(AllianceBonusModel::TYPE_TRAINING); ?>
    <div class="bonusInfo collapsed <?=($open ? '' : 'hide');?> bonusInfo0">
        <div class="descriptionWrapper">
            <?php
            $title = T("AllianceBonus", "Recruitment") . ' - ';
            $title .= T("AllianceBonus", "Faster troop production bonus");
            ?>
            <div class="bonusExtendedDescription bonusImage0" title="<?=$title;?>">
                <div class="textContent">
                    <?=T("AllianceBonus", "training_bonus_desc");?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bonusStatistics">
            <div class="top5Wrapper" id="statLeft">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of the Week"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_TRAINING, true); ?>
            </div>
            <div class="top5Wrapper" id="statRight">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of all Time"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_TRAINING, false); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="roundedCornersBox bonusBox" id="bonusBox1">
    <?php $open = $preference['bonusInfo1'];?>
    <h4>
        <button type="button" class="icon bonusCollapse" ref="bonusInfo1">
            <img src="img/x.gif" class="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>" alt="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>"/>
        </button>
        <span>
            <strong><?= T("AllianceBonus", "Philosophy"); ?></strong>
            -
            <?= T("AllianceBonus", "Culture Points production bonus"); ?>
        </span>
    </h4>
    <?= allianceBonusOverview::renderProgressBar(AllianceBonusModel::TYPE_CP); ?>
    <div class="bonusInfo collapsed <?=($open ? '' : 'hide');?> bonusInfo1">
        <div class="descriptionWrapper">
            <?php
            $title = T("AllianceBonus", "Philosophy") . ' - ';
            $title .= T("AllianceBonus", "Culture Points production bonus");
            ?>
            <div class="bonusExtendedDescription bonusImage1" title="<?=$title;?>">
                <div class="textContent">
                    <?=T("AllianceBonus", "armor_bonus_desc");?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bonusStatistics">
            <div class="top5Wrapper" id="statLeft">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of the Week"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_CP, true); ?>
            </div>
            <div class="top5Wrapper" id="statRight">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of all Time"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_CP, false); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="roundedCornersBox bonusBox" id="bonusBox2">
    <?php $open = $preference['bonusInfo2'];?>
    <h4>
        <button type="button" class="icon bonusCollapse" ref="bonusInfo2">
            <img src="img/x.gif" class="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>" alt="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>"/>
        </button>
        <span>
            <strong><?= T("AllianceBonus", "Metallurgy"); ?></strong>
            -
            <?= T("AllianceBonus", "Weapons and armor bonus"); ?>
        </span>
    </h4>
    <?= allianceBonusOverview::renderProgressBar(AllianceBonusModel::TYPE_ARMOR); ?>
    <div class="bonusInfo collapsed <?=($open ? '' : 'hide');?> bonusInfo2">
        <div class="descriptionWrapper">
            <?php
            $title = T("AllianceBonus", "Metallurgy") . ' - ';
            $title .= T("AllianceBonus", "Weapons and armor bonus");
            ?>
            <div class="bonusExtendedDescription bonusImage2" title="<?=$title;?>">
                <div class="textContent">
                    <?=T("AllianceBonus", "cp_bonus_desc");?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bonusStatistics">
            <div class="top5Wrapper" id="statLeft">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of the Week"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_ARMOR, true); ?>
            </div>
            <div class="top5Wrapper" id="statRight">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of all Time"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_ARMOR, false); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="roundedCornersBox bonusBox" id="bonusBox3">
    <?php $open = $preference['bonusInfo3'];?>
    <h4>
        <button type="button" class="icon bonusCollapse" ref="bonusInfo3">
            <img src="img/x.gif" class="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>" alt="openedClosedSwitch <?=($open ? 'switchOpened' : 'switchClosed');?>"/>
        </button>
        <span>
            <strong><?= T("AllianceBonus", "Commerce"); ?></strong>
            -
            <?= T("AllianceBonus", "Merchant capacity bonus"); ?>
        </span>
    </h4>
    <?= allianceBonusOverview::renderProgressBar(AllianceBonusModel::TYPE_TRADE); ?>
    <div class="bonusInfo collapsed <?=($open ? '' : 'hide');?> bonusInfo3">
        <div class="descriptionWrapper">
            <?php
            $title = T("AllianceBonus", "Commerce") . ' - ';
            $title .= T("AllianceBonus", "Merchant capacity bonus");
            ?>
            <div class="bonusExtendedDescription bonusImage3" title="<?=$title;?>">
                <div class="textContent">
                    <?=T("AllianceBonus", "trade_bonus_desc");?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="bonusStatistics">
            <div class="top5Wrapper" id="statLeft">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of the Week"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_TRADE, true); ?>
            </div>
            <div class="top5Wrapper" id="statRight">
                <h4 class="round small top"><strong><?= T("AllianceBonus", "Contributors of all Time"); ?></strong></h4>
                <?= allianceBonusOverview::renderContributors(AllianceBonusModel::TYPE_TRADE, false); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>