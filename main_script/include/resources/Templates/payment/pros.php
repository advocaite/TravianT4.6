<?php
use Core\Config;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\GoldHelper;
use Model\AutoExtendModel;

$autoExtend = new AutoExtendModel();
$helper = new GoldHelper();
$checked = 'checked="checked"';
function getEnd($time, $autoExtend = false)
{
	if($time < time()) {
		return '';
	}
	if(($time - time()) > 86400) {
		$hldDays = round(($time - time()) / 86400);

		return '<div class="featureRemainingTime featureSubtitle subtitle"><span class=""> '.T("PaymentWizard", "Days remaining").' '.$hldDays.' '.T("PaymentWizard", "until").' '.TimezoneHelper::date("H:i:s", $time).'</span></div>';
	} else {
		return '<div class="featureRemainingTime featureSubtitle subtitle"><span class="'.($autoExtend ? 'renewalActive' : 'bonusEndsSoon').'"> '.sprintf(T("PaymentWizard", "EndsAtX"), appendTimer($time-time())).'</span>'.'</div>';
	}
}
function getTime($time){
	if($time >= 86400){
		return '<span class="bold">' . round($time/86400, 1) . '</span> ' . T("PaymentWizard", "Days");
	}
	return '<span class="bold">' . round($time/3600, 1) . '</span> ' . T("PaymentWizard", "hour");
}
?>
<div class="contentBorder infoArea">
	<div class="contentBorder-tl"></div>
	<div class="contentBorder-tr"></div>
	<div class="contentBorder-tc"></div>
	<div class="contentBorder-ml"></div>
	<div class="contentBorder-mr"></div>
	<div class="contentBorder-mc"></div>
	<div class="contentBorder-bl"></div>
	<div class="contentBorder-br"></div>
	<div class="contentBorder-bc"></div>
	<div class="contentBorder-contents cf">
		<div class="premiumFeature Goldclub " style="display: block;">
			<h4><?=T("PaymentWizard", "GoldClub"); ?> </h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "goldClubDesc"); ?></div>
			<img class="prosGoldclubImage" src="img/x.gif">
		</div>
		<div class="premiumFeature Plus hide" style="display: none;">
			<h4><?=T("PaymentWizard", "Plus"); ?> </h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "PlusDesc"); ?></div>
			<img class="prosPlusImage" src="img/x.gif">
		</div>
		<div class="premiumFeature ProductionboostWood hide"
		     style="display: none;">
			<h4><?=T("PaymentWizard", "+25Wood"); ?> </h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "+25WoodDesc"); ?></div>
			<img class="prosProductionboostWoodImage" src="img/x.gif">
		</div>
		<div class="premiumFeature ProductionboostClay hide"
		     style="display: none;">
			<h4><?=T("PaymentWizard", "+25Clay"); ?> </h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "+25ClayDesc"); ?></div>
			<img class="prosProductionboostClayImage" src="img/x.gif">
		</div>
		<div class="premiumFeature ProductionboostIron hide"
		     style="display: none;">
			<h4><?=T("PaymentWizard", "+25Iron"); ?></h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "+25IronDesc"); ?></div>
			<img class="prosProductionboostIronImage" src="img/x.gif">
		</div>
		<div class="premiumFeature ProductionboostCrop hide"
		     style="display: none;">
			<h4><?=T("PaymentWizard", "+25Crop"); ?></h4>

			<div class="premiumFeatureDescription">
				<?=T("PaymentWizard", "+25CropDesc"); ?></div>
			<img class="prosProductionboostCropImage" src="img/x.gif">
		</div>
	</div>
</div>
<div class="contentBorder contentArea">
	<div class="contentBorder-tl"></div>
	<div class="contentBorder-tr"></div>
	<div class="contentBorder-tc"></div>
	<div class="contentBorder-ml"></div>
	<div class="contentBorder-mr"></div>
	<div class="contentBorder-mc"></div>
	<div class="contentBorder-bl"></div>
	<div class="contentBorder-br"></div>
	<div class="contentBorder-bc"></div>
	<div class="contentBorder-contents cf">
		<div class="paymentPopupDialogWrapper">
			<h4 class="subHeadline"><?=T("PaymentWizard", "Please activate advantage that you can choose"); ?>
				:</h4>

			<div class="featureCollection" id="featureCollectionWrapper">
				<div class="feature featureBooking ">
					<div class="dynamicContent " style="display: block;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="Goldclub">

					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "GoldClub"); ?></h3>

						<div class="featureButton">
							<?=$helper->getGoldClubButton(); ?>
						</div>
						<div
							class="featureDuration featureRenewal featureButtonSubtitle subtitle">
							<?php if(!Session::getInstance()->hasGoldClub()): ?>
								<?=T("PaymentWizard", "Bonus duration"); ?>:
								<span
									class="bold"><?=T("PaymentWizard", "ToTheEndOfTheGame"); ?></span>
							<?php else: ?>
								<?=T("PaymentWizard", "Activated To End Of the game"); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="feature featureBooking ">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="Plus">
					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "Plus"); ?> </h3>
						<?=getEnd(Session::getInstance()->plusTill(), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 1)); ?>
						<div class="featureButton">
							<?=$helper->getPlusButton(false, true); ?>
						</div>
						<?php if(Session::getInstance()->hasPlus()): ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle">
								<input type="checkbox" id="plus" name="plus[]"
								       class="enumerableElements check checkbox prolongPlus"
								       style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 1) ? $checked : ''; ?>
								       value="1" title="">
								<label for="plus"
								       class="enumerableElementsCheckboxLabel prolongPlus"
								       style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>
							</div>
						<?php else: ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle"><?=T("PaymentWizard", "Bonus duration"); ?>
								: <?=getTime(Config::getInstance()->gold->plusAccountDurationSeconds);?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div
					class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="ProductionboostWood">

					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "+25Wood"); ?></h3>
						<?=getEnd(Session::getInstance()->productionBoostTill(1), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 2)); ?>
						<div class="featureButton">
							<?=$helper->getProductionBoostButton(1, false, true); ?>
						</div>
						<?php if(Session::getInstance()->hasProductionBoost(1)): ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle">
								<input type="checkbox" id="productionboostWood"
								       name="productionboostWood[]"
								       class="enumerableElements check checkbox prolongProductionboostWood"
								       style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 2) ? $checked : ''; ?>
								       value="1" title="">
								<label for="productionboostWood"
								       class="enumerableElementsCheckboxLabel prolongProductionboostWood"
								       style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>
							</div>
						<?php else: ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle"><?=T("PaymentWizard", "Bonus duration"); ?>
								: <?=getTime(Config::getInstance()->gold->productionBoostDurationSeconds);?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div
					class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="ProductionboostClay">

					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "+25Clay"); ?></h3>
						<?=getEnd(Session::getInstance()->productionBoostTill(2), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 3)); ?>
						<div class="featureButton">
							<?=$helper->getProductionBoostButton(2, false, true); ?>
						</div>
						<?php if(Session::getInstance()->hasProductionBoost(2)): ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle">
								<input type="checkbox" id="productionboostClay"
								       name="productionboostClay[]"
								       class="enumerableElements check checkbox prolongProductionboostClay"
								       style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 3) == 1 ? $checked : ''; ?>
								       value="1" title="">
								<label for="productionboostClay"
								       class="enumerableElementsCheckboxLabel prolongProductionboostClay"
								       style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>
							</div>
						<?php else: ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle"><?=T("PaymentWizard", "Bonus duration"); ?>
								: <?=getTime(Config::getInstance()->gold->productionBoostDurationSeconds);?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div
					class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="ProductionboostIron">

					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "+25Iron"); ?></h3>
						<?=getEnd(Session::getInstance()->productionBoostTill(3), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 4)); ?>
						<div class="featureButton">
							<?=$helper->getProductionBoostButton(3, false, true); ?>
						</div>
						<?php if(Session::getInstance()->hasProductionBoost(3)): ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle">
								<input type="checkbox" id="productionboostIron"
								       name="productionboostIron[]"
								       class="enumerableElements check checkbox prolongProductionboostIron"
								       style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 4) == 1 ? $checked : ''; ?>
								       value="1" title="">
								<label for="productionboostIron"
								       class="enumerableElementsCheckboxLabel prolongProductionboostIron"
								       style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>
							</div>
						<?php else: ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle"><?=T("PaymentWizard", "Bonus duration"); ?>
								: <?=getTime(Config::getInstance()->gold->productionBoostDurationSeconds);?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div
					class="feature featureBooking premiumFeatureProductionBoost">
					<div class="dynamicContent hide" style="display: none;">
						<img src="img/x.gif" class="highlightArrow" alt="">
					</div>
					<input type="hidden" class="premiumFeatureName hide"
					       name="featureName" value="ProductionboostCrop">

					<div class="featureContent">
						<h3 class="featureTitle"><?=T("PaymentWizard", "+25Crop"); ?></h3>
						<?=getEnd(Session::getInstance()->productionBoostTill(4), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 5)); ?>
						<div class="featureButton">
							<?=$helper->getProductionBoostButton(4, false, true); ?>
						</div>
						<?php if(Session::getInstance()->hasProductionBoost(4)): ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle">
								<input type="checkbox" id="productionboostCrop"
								       name="productionboostCrop[]"
								       class="enumerableElements check checkbox prolongProductionboostCrop"
								       style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 5) == 1 ? $checked : ''; ?>
								       value="1" title="">
								<label for="productionboostCrop"
								       class="enumerableElementsCheckboxLabel prolongProductionboostCrop"
								       style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>
							</div>
						<?php else: ?>
							<div
								class="featureDuration featureRenewal featureButtonSubtitle subtitle"><?=T("PaymentWizard", "Bonus duration"); ?>
								: <?=getTime(Config::getInstance()->gold->productionBoostDurationSeconds);?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>