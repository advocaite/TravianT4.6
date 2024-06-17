<?php

use Controller\Ajax\allianceBonusOverview;
use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Model\AllianceBonusModel;

$config = Config::getInstance();
$session = Session::getInstance();
$village = Village::getInstance();
$m = new AllianceBonusModel();
if (!isset($minBonusLevel)) {
    $minBonusLevel = $m->getMinAllianceBonusLevel($session->getAllianceId());
}
if (!isset($limitPerDay)) {
    $limitPerDay = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
}
?>
<div id="allianceBonusWrapper" class="alliance-bonuses-overview alliance-bonuses-details">
    <?php if ($vars['newlyJoined']): ?>
        <div class="alliance_bonus_locked">
            <div><img class="lock_big" src="img/x.gif"></div>
            <div class="alliance_bonus_locked_details">
                <?= T("AllianceBonus", "You joined the alliance less than 24:00 hours ago"); ?>
                <?= T("AllianceBonus", "You can still donate, but you may have to wait for the bonuses to unlock"); ?>
            </div>
        </div>
        <div class="clear"></div>
    <?php endif; ?>
    <div class="header">
        <div class="description">
            <?= T("AllianceBonus", "AllianceBonusDescription"); ?>
        </div>
    </div>
    <?php if ($minBonusLevel < 5): ?>
        <?php $reached = $session->getAllianceContribution() >= $limitPerDay; ?>
        <div id="contributionBox" class="roundedCornersBox">
            <div class="contributionIconLarge"></div>
            <h4><?= T("AllianceBonus", "Contribute resources"); ?></h4>
            <div id="contributionForm">
                <?php if ($reached): ?>
                    <span class="limitReachedMessage">
                        <?php
                        $nextReset = $config->dynamic->lastAllianceContributeReset + $config->allianceBonus->donate_reset_interval;
                        $diff = $nextReset - time();
                        $nextResetIn = appendTimer($diff);
                        echo sprintf(
                            T("AllianceBonus", "You have reached you daily contribution limit, Reset in %s"),
                            $nextResetIn
                        );
                        ?>
                    </span>
                <?php elseif (!$session->checkSitterPermission(Session::SITTER_CAN_CONTRIBUTE_ALLIANCE)): ?>
                    <span class="sitterErrorMessage">
                        <?= T("AllianceBonus", "As sitter you can`t contribute to alliance bonuses"); ?>
                    </span>
                <?php else: ?>
                    <?php require __DIR__ . "/donateForm.php"; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!$reached): ?>
            <div id="myDailyContributionLimit">
                <?php require __DIR__ . "/myDailyContributionLimit.php"; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <h4 class="round"><?= T("AllianceBonus", "Alliance bonus overview"); ?></h4>
    <div id="allianceBonusOverview">
        <?= allianceBonusOverview::render(); ?>
    </div>
</div>

<div id="bonusLevelUpRewardTemplate" class="hide">
    <div class="bonusLevelUpReward">
        <div class="banner">
            <div class="description">
                <p></p>
                <p></p>
            </div>
        </div>
        <div class="stoneDisplayHeader">
            <div class="level1">
                <div class="star"></div>
                <div class="glow"></div>
            </div>
            <div class="level2">
                <div class="star"></div>
                <div class="glow"></div>
            </div>
            <div class="level5">
                <div class="star"></div>
                <div class="glow"></div>
            </div>
            <div class="level3">
                <div class="star"></div>
                <div class="glow"></div>
            </div>
            <div class="level4">
                <div class="star"></div>
                <div class="glow"></div>
            </div>
        </div>
        <div class="swords">
            <div class="sword1"></div>
            <div class="sword2"></div>
        </div>
        <div class="stoneDisplay">
            <div class="bonusRepresentation">
                <div>
                    <div class="stage1"></div>
                    <div class="glow"></div>
                    <div class="stage2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(function() {
        Travian.Game.AllianceDonation.initBonusIcons();
        Travian.Game.AllianceDonation.initBonusOverview();
        <?php
        function run_unlock_bonus_animation($type)
        {
            $m = new AllianceBonusModel();
            $session = Session::getInstance();
            $session->set(AllianceBonusModel::USER_UNLOCK_PENDING_ANIMATION[$type], 0);

            $m->setAnimationAsFinished($session->getPlayerId(), $type);

            $level = $m->getAllianceBonusTypeParams($session->getAllianceId(), $type)['level'];
            $animation_classes = [
                AllianceBonusModel::TYPE_TRAINING => 'TroopProductionSpeed',
                AllianceBonusModel::TYPE_CP => 'CPProduction',
                AllianceBonusModel::TYPE_ARMOR => 'SmithyPower',
                AllianceBonusModel::TYPE_TRADE => 'MerchantCapacity',
            ];
            $animation_names = [
                AllianceBonusModel::TYPE_TRAINING => 'Recruitment',
                AllianceBonusModel::TYPE_CP => 'Philosophy',
                AllianceBonusModel::TYPE_ARMOR => 'Metallurgy',
                AllianceBonusModel::TYPE_TRADE => 'Commerce',
            ];
            if ($type == AllianceBonusModel::TYPE_TRADE) {
                $percent = $level * 20;
            } else {
                $percent = $level * 2;
            }
            return 'Travian.Game.AllianceDonation.playLevelUpRewardAnimation("' . $animation_classes[$type] . '", ' . $level . ', "' . T("AllianceBonus", $animation_names[$type]) . '", "' . sprintf('+%s%%', $percent) . '");';
        }
        foreach(AllianceBonusModel::USER_UNLOCK_PENDING_ANIMATION as $key => $value){
            if ($session->get(AllianceBonusModel::USER_UNLOCK_PENDING_ANIMATION[$key]) == 1) {
                echo run_unlock_bonus_animation($key);
                break;
            }
        }
        ?>
    });
</script>