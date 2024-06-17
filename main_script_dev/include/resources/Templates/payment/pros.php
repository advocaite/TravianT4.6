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
<div class="infoArea">
  <div class="premiumFeature Goldclub goldclub show">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "GoldClub"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "goldClubDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
  <div class="premiumFeature Plus plus">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "Plus"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "PlusDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
  <div class="premiumFeature ProductionboostWood productionboostWood">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "+25Wood"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "+25WoodDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
  <div class="premiumFeature ProductionboostClay productionboostClay">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "+25Clay"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "+25ClayDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
  <div class="premiumFeature ProductionboostIron productionboostIron">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "+25Iron"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "+25IronDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
  <div class="premiumFeature ProductionboostCrop productionboostCrop">
	 <div class="descriptionWrapper">
		<h4><?=T("PaymentWizard", "+25Crop"); ?></h4>
		<div class="premiumFeatureDescription">
		   <?=T("PaymentWizard", "+25CropDesc"); ?>
		</div>
	 </div>
	 <div class="featureImage"></div>
  </div>
</div>
<div class="contentArea">
  <div class="paymentPopupDialogWrapper">
	 <div id="featureIndicator" class="" style="top: 14.5px;"></div>
	 <div class="featureCollection" id="featureCollectionWrapper">
		<div class="feature featureBooking  preSelected">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="Goldclub">
		   <div class="featureContent goldclub">
			  <div class="featureImage goldclub">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle"><?=T("PaymentWizard", "GoldClub"); ?></div>
			  <div class="featureDuration">
				 <?php if(!Session::getInstance()->hasGoldClub()): ?>
					<?=T("PaymentWizard", "Bonus duration"); ?>:
					<span
						class="bold"><?=T("PaymentWizard", "ToTheEndOfTheGame"); ?></span>
				<?php else: ?>
					<?=T("PaymentWizard", "Activated To End Of the game"); ?>
				<?php endif; ?>
			  </div>
			  <div class="featureButton">
				 <?=$helper->getGoldClubButton(); ?>
			  </div>
			  <div class="featureRenewal">
			  </div>
		   </div>
		</div>
		<div class="feature featureBooking  ">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="Plus">
		   <div class="featureContent active plus">
			  <div class="featureImage plus">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle"><?=T("PaymentWizard", "Plus"); ?></div>
			  <?=getEnd(Session::getInstance()->plusTill(), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 1)); ?>
			  <div class="featureButton">
				 <?=$helper->getPlusButton(false, true); ?>
			  </div>
			  <?php if(Session::getInstance()->hasPlus()): ?>
			  <div class="featureRenewal">
				 <input type="checkbox" id="plus" name="plus[]" class="enumerableElements check checkbox prolongPlus" style="" value="1" title="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 1) ? $checked : ''; ?>>
				 <label for="plus" class="enumerableElementsCheckboxLabel prolongPlus" style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>		
			  </div>
			  <?php endif; ?>
		   </div>
		</div>
		<div class="feature featureBooking premiumFeatureProductionBoost ">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="ProductionboostWood">
		   <div class="featureContent active productionboostWood">
			  <div class="featureImage productionboostWood">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle">‭<?=T("PaymentWizard", "+25Wood"); ?></div>
			  <?=getEnd(Session::getInstance()->productionBoostTill(1), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 2)); ?>
			  <div class="featureButton">
				 <?=$helper->getProductionBoostButton(1, false, true); ?>
			  </div>
			  <?php if(Session::getInstance()->hasProductionBoost(1)): ?>
			  <div class="featureRenewal">
				 <input type="checkbox" id="productionboostWood" name="productionboostWood[]" class="enumerableElements check checkbox prolongProductionboostWood" style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 2) ? $checked : ''; ?> value="1" title="">
				 <label for="productionboostWood" class="enumerableElementsCheckboxLabel prolongProductionboostWood" style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>		
			  </div>
			  <?php endif; ?>
		   </div>
		</div>
		<div class="feature featureBooking premiumFeatureProductionBoost ">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="ProductionboostClay">
		   <div class="featureContent active productionboostClay">
			  <div class="featureImage productionboostClay">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle">‭<?=T("PaymentWizard", "+25Clay"); ?></div>
			  <?=getEnd(Session::getInstance()->productionBoostTill(2), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 3)); ?>
			  <div class="featureButton">
				 <?=$helper->getProductionBoostButton(2, false, true); ?>
			  </div>
			  <?php if(Session::getInstance()->hasProductionBoost(2)): ?>
			  <div class="featureRenewal">
				 <input type="checkbox" id="productionboostWood" name="productionboostWood[]" class="enumerableElements check checkbox prolongProductionboostWood" style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 3) ? $checked : ''; ?> value="1" title="">
				 <label for="productionboostWood" class="enumerableElementsCheckboxLabel prolongProductionboostWood" style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>		
			  </div>
			  <?php endif; ?>
		   </div>
		</div>
		<div class="feature featureBooking premiumFeatureProductionBoost ">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="ProductionboostIron">
		   <div class="featureContent active productionboostIron">
			  <div class="featureImage productionboostIron">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle">‭<?=T("PaymentWizard", "+25Iron"); ?></div>
			  <?=getEnd(Session::getInstance()->productionBoostTill(3), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 4)); ?>
			  <div class="featureButton">
				 <?=$helper->getProductionBoostButton(3, false, true); ?>
			  </div>
			  <?php if(Session::getInstance()->hasProductionBoost(3)): ?>
			  <div class="featureRenewal">
				 <input type="checkbox" id="productionboostWood" name="productionboostWood[]" class="enumerableElements check checkbox prolongProductionboostWood" style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 4) ? $checked : ''; ?> value="1" title="">
				 <label for="productionboostWood" class="enumerableElementsCheckboxLabel prolongProductionboostWood" style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>		
			  </div>
			  <?php endif; ?>
		   </div>
		</div>
		<div class="feature featureBooking premiumFeatureProductionBoost ">
		   <input type="hidden" class="premiumFeatureName" name="featureName" value="ProductionboostCrop">
		   <div class="featureContent active productionboostCrop">
			  <div class="featureImage productionboostCrop">
				 <svg class="productionBoost" viewBox="0 0 20 20">
					<path d="M7 2L7 7L2 7L2 12L7 12L7 17L12 17L12 12L17 12L17 7L12 7L12 2Z"></path>
				 </svg>
			  </div>
			  <div class="featureTitle">‭<?=T("PaymentWizard", "+25Crop"); ?></div>
			  <?=getEnd(Session::getInstance()->productionBoostTill(4), $autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 5)); ?>
			  <div class="featureButton">
				 <?=$helper->getProductionBoostButton(4, false, true); ?>
			  </div>
			  <?php if(Session::getInstance()->hasProductionBoost(4)): ?>
			  <div class="featureRenewal">
				 <input type="checkbox" id="productionboostWood" name="productionboostWood[]" class="enumerableElements check checkbox prolongProductionboostWood" style="" <?=$autoExtend->hasAutoExtend(Session::getInstance()->getPlayerId(), 5) ? $checked : ''; ?> value="1" title="">
				 <label for="productionboostWood" class="enumerableElementsCheckboxLabel prolongProductionboostWood" style=""><?=T("PaymentWizard", "Extend automatically"); ?></label>		
			  </div>
			  <?php endif; ?>
		   </div>
		</div>
	 </div>
  </div>
</div>