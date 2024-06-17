<?php
use Core\Config;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Model\AllianceBonusModel;

$config = Config::getInstance();
$session = Session::getInstance();
$village = Village::getInstance();
$m = new AllianceBonusModel();
if(!isset($minBonusLevel)){
    $minBonusLevel = $m->getMinAllianceBonusLevel($session->getAllianceId());
}
if (!isset($limitPerDay)) {
    $limitPerDay = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
}
if($minBonusLevel >= 5){
    return;
}
?>
<input type="hidden" id="dailyLimit" value="<?= $limitPerDay; ?>"/>
<input type="hidden" id="donatedToday" value="<?= $session->getAllianceContribution(); ?>"/>
<div id="dailyContributionTitle">
    <?php
    $nextReset = $config->dynamic->lastAllianceContributeReset + $config->allianceBonus->donate_reset_interval;
    $diff = $nextReset - time();
    echo sprintf(T("AllianceBonus", "My daily contribution limit (reset in %s)"), '<strong>' . appendTimer($diff) . '</strong>');
    ?>
</div>
<div class="progressBarDailyLimit"
     title="<?= sprintf(T("AllianceBonus", "Amount of resources you can still contribute: %s"), $limitPerDay - $session->getAllianceContribution()); ?>"
     data-tooltip="<?= sprintf(T("AllianceBonus", "Amount of resources you can still contribute: %s"), '[AMOUNT]'); ?>">
    <div id="dailyContributionTitleArrow" class="greenArrow"
         style="width: <?=round($session->getAllianceContribution()/$limitPerDay*100, 2);?>%;"></div>
    <div id="dailyContributionTitleText" class="contributionText">
        &#x202d;<span class="donationValueNumber">&#x202d;<?= $session->getAllianceContribution(); ?>
            &#x202c;</span>/<span class="donationMaxNumber">&#x202d;<?= $limitPerDay; ?>&#x202c;</span>&#x202c;
    </div>
</div>
<div class="clear"></div>
<div class="bonus-donation-response"></div>