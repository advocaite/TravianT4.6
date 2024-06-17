<?php

use Core\Session;
use Core\Village;
use Game\Formulas;
use Model\AllianceBonusModel;

$m = new AllianceBonusModel();
$village = Village::getInstance();
$session = Session::getInstance();
if (!isset($minBonusLevel)) {
    $minBonusLevel = $m->getMinAllianceBonusLevel($session->getAllianceId());
}
if (5 == $minBonusLevel) {
    return;
}
if (!isset($limitPerDay)) {
    $limitPerDay = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
}
?>
<input type="hidden" id="gold" value="1"/>
<input type="hidden" id="canTriple" value="1"/>
<input type="hidden" id="bid"/>
<input type="hidden" id="did" value="<?= $village->getKid(); ?>"/>
<input type="hidden" id="limitReached" value="<?= ($session->getAllianceContribution() >= $limitPerDay); ?>"/>
<div id="bonusSelection">
    <?php
    $arr = [
        [
            'id' => 'bonusTroopProductionSpeed',
            'class' => 'bonusIconRecruitment',
            'value' => 'TroopProductionSpeed',
            'name' => T("AllianceBonus", "Recruitment"),
            'shortDesc' => T("AllianceBonus", "Faster troop production bonus"),
        ],
        [
            'id' => 'bonusCPProduction',
            'class' => 'bonusIconPhilosophy',
            'value' => 'CPProduction',
            'name' => T("AllianceBonus", "Philosophy"),
            'shortDesc' => T("AllianceBonus", "Culture Points production bonus"),
        ],
        [
            'id' => 'bonusSmithyPower',
            'class' => 'bonusIconMetallurgy',
            'value' => 'SmithyPower',
            'name' => T("AllianceBonus", "Metallurgy"),
            'shortDesc' => T("AllianceBonus", "Weapons and armor bonus"),
        ],
        [
            'id' => 'bonusMerchantCapacity',
            'class' => 'bonusIconCommerce',
            'value' => 'MerchantCapacity',
            'name' => T("AllianceBonus", "Commerce"),
            'shortDesc' => T("AllianceBonus", "Merchant capacity bonus"),
        ],
    ];
    $types = [
        'TroopProductionSpeed' => AllianceBonusModel::TYPE_TRAINING,
        'CPProduction' => AllianceBonusModel::TYPE_CP,
        'SmithyPower' => AllianceBonusModel::TYPE_ARMOR,
        'MerchantCapacity' => AllianceBonusModel::TYPE_TRADE,
    ];
    $i = 0;
    foreach ($arr as $bonus) {
        $typeId = $types[$bonus['value']];
        $upgrading = $m->isUnlockingNextLevel($session->getAllianceId(), $typeId);
        $maxedLevel = $m->getAllianceBonusTypeParams($session->getAllianceId(), $typeId)['level'] >= 5;
        $disabled = $upgrading || $maxedLevel;
        echo '<div data-index="' . $i . '" class="bonusButtonRound ' . ($maxedLevel ? 'maxLevel' : '') . '">';
        echo '<img src="img/x.gif" alt="" class="' . $bonus['class'] . '"/>';
        if ($maxedLevel) {
            echo '<div class="crown"></div>';
        }
        echo '</div>';
        echo '<input type="radio" name="bonus" ' . ($disabled ? 'disabled="disabled"' : '') . ' value="' . $bonus['value'] . '" id="' . $bonus['id'] . '" onChange="' . ($disabled ? '' : 'Travian.Game.AllianceDonation.checkButtonState(\'donate\')') . '"/>';
        if ($upgrading) {
            $translations = [
                AllianceBonusModel::TYPE_TRAINING => 'training_upgrading',
                AllianceBonusModel::TYPE_CP => 'cp_upgrading',
                AllianceBonusModel::TYPE_ARMOR => 'armor_upgrading',
                AllianceBonusModel::TYPE_TRADE => 'trade_upgrading',
            ];
            $title = T("AllianceBonus", $translations[$typeId]);
        } else if ($maxedLevel) {
            $translations = [
                AllianceBonusModel::TYPE_TRAINING => 'training_bonus_maxed',
                AllianceBonusModel::TYPE_CP => 'cp_bonus_maxed',
                AllianceBonusModel::TYPE_ARMOR => 'armor_bonus_maxed',
                AllianceBonusModel::TYPE_TRADE => 'trade_bonus_maxed',
            ];
            $title = T("AllianceBonus", $translations[$typeId]);
        } else {
            $title = $bonus['name'] . ' - ' . $bonus['shortDesc'];
        }
        echo '<label title="' . $title . '" for="' . $bonus['id'] . '" class="' . ($upgrading ? 'upgrading' : ($maxedLevel ? 'maxLevel' : '')) . '"> ' . $bonus['name'] . ' </label>';
        echo '<div class="clear"></div>';
        ++$i;
    }
    ?>
</div>
<div id="resourceSelection">
    <table class="resourceSelection transparent">
        <tr>
            <td class="resourceIcon">
                <a onclick="Travian.Game.AllianceDonation.fillUp(document.getElementById('donate1'), <?= $village->getCurrentResources(0); ?>, 'donate')">
                    <i class="r1"></i> </a></td>
            <td class="resourceName"><?= T("inGame", "resources.r1"); ?></td>
            <td class="resourceInput ratioltr"><input type="text" id="donate1" class="text" maxlength="99" size="5" value="0"
                                             onkeyup="Travian.Game.AllianceDonation.checkAndChange(this, <?= $village->getCurrentResources(0); ?>, 'donate')">
            </td>
            <td class="resourceMaximum"> / <?= $village->getCurrentResources(0); ?></td>
        </tr>
        <tr>
            <td class="resourceIcon"><a
                        onclick="Travian.Game.AllianceDonation.fillUp(document.getElementById('donate2'), <?= $village->getCurrentResources(1); ?>, 'donate')">
                    <i class="r2"></i> </a></td>
            <td class="resourceName"><?= T("inGame", "resources.r2"); ?></td>
            <td class="resourceInput ratioltr"><input type="text" id="donate2" class="text" maxlength="99" size="5" value="0"
                                             onkeyup="Travian.Game.AllianceDonation.checkAndChange(this, <?= $village->getCurrentResources(1); ?>, 'donate')">
            </td>
            <td class="resourceMaximum"> / <?= $village->getCurrentResources(1); ?></td>
        </tr>
        <tr>
            <td class="resourceIcon"><a
                        onclick="Travian.Game.AllianceDonation.fillUp(document.getElementById('donate3'), <?= $village->getCurrentResources(2); ?>, 'donate')">
                    <i class="r3"></i> </a></td>
            <td class="resourceName"><?= T("inGame", "resources.r3"); ?></td>
            <td class="resourceInput ratioltr"><input type="text" id="donate3" class="text" maxlength="99" size="5" value="0"
                                             onkeyup="Travian.Game.AllianceDonation.checkAndChange(this, <?= $village->getCurrentResources(2); ?>, 'donate')">
            </td>
            <td class="resourceMaximum"> / <?= $village->getCurrentResources(2); ?></td>
        </tr>
        <tr>
            <td class="resourceIcon">
                <a onclick="Travian.Game.AllianceDonation.fillUp(document.getElementById('donate4'), <?= $village->getCurrentResources(3); ?>, 'donate')">
                    <i class="r4"></i>
                </a></td>

            <td class="resourceName"><?= T("inGame", "resources.r4"); ?></td>
            <td class="resourceInput ratioltr">
                <input type="text" id="donate4" class="text" maxlength="99" size="5" value="0"
                       onkeyup="Travian.Game.AllianceDonation.checkAndChange(this, <?= $village->getCurrentResources(3); ?>, 'donate')">
            </td>
            <td class="resourceMaximum"> / <?= $village->getCurrentResources(3); ?></td>
        </tr>
    </table>
    <hr/>
    <div class="resourceSum"><img src="img/x.gif" alt="" class="resAllBigIcon"/> <span
                class="sumText"><?= T("AllianceBonus", "Sum:"); ?></span>
        <span id="donateSum" class="sumValue">0</span></div>
</div>
<div class="clear"></div>
<div id="contributeButtons">

    <?php
    echo getButton(
        [
            'id' => 'donate_gold',
            "type" => "button",
            "class" => "gold disabled",
            'title' => T("AllianceBonus", "Contribute"),
        ],
        [
            "data" => [
                "type" => "button",
                'value' => T("AllianceBonus", "Contribute x3"),
                'onclick' => 'if($(this).hasClass(\'disabled\')){(new DOMEvent(event)).stop(); return false;} else {Travian.Game.AllianceDonation.donate(\'donate\', this.id, Travian.Game.AllianceDonation.getDonationParams(\'donate\', this))}',
                'onfocus' => 'jQuery(\'button\', \'input[type!=hidden]\', \'select\').focus(); event.stopPropagation(); return false;',
            ]
        ],
        T("AllianceBonus", "Contribute x3")
    );
    echo getButton(
        [
            'id' => 'donate_green',
            "type" => "button",
            "class" => "green disabled",
            'title' => T("AllianceBonus", "Contribute"),
        ],
        [
            "data" => [
                "type" => "button",
                'value' => T("AllianceBonus", "Contribute"),
                'onclick' => 'if($(this).hasClass(\'disabled\')){(new DOMEvent(event)).stop(); return false;} else {Travian.Game.AllianceDonation.donate(\'donate\', this.id, Travian.Game.AllianceDonation.getDonationParams(\'donate\', this))}',
                'onfocus' => 'jQuery(\'button\', \'input[type!=hidden]\', \'select\').focus(); event.stopPropagation(); return false;',
            ]
        ],
        T("AllianceBonus", "Contribute")
    );
    ?>
</div>
<div id="bonusNotSelectedMessage">
    <?= T("AllianceBonus", "Please select a bonus"); ?>
</div>
<div class="clear"></div>
<script>
    Travian.Game.AllianceDonation.initContributeDisabledAction();
</script>