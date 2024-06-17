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
		<div class="buyGoldInfoStep locationStep buyGoldInfoArrow">
			<div class="buyGoldInfoStepNumber">1</div>
			<div
				class="buyGoldInfoStepLabel"><?php use Core\Helper\WebService;

echo T("PaymentWizard", "location"); ?>
				:
			</div>
			<div
				class="buyGoldInfoStepContent"><?=$vars['locationName']; ?></div>
			<div class="buyGoldInfoStepFooter">
				<a href="#"
				   class="changeLocation"><?=T("PaymentWizard", "ChangeLocation"); ?></a>
			</div>
		</div>
		<div class="buyGoldInfoStep locationStep buyGoldFormStep active">
			<div class="buyGoldInfoStepNumber">1</div>
			<div
				class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "location"); ?>
				:
			</div>
			<div class="buyGoldInfoStepContent">
				<select name="location" class="buyGoldLocation">
					<?php
foreach ($vars['locations'] as $locationId => $location) {
    echo '<option value="' . $location['id'] . '" ' . ($location['id'] == $vars['selectedLocation'] ? 'selected="selected"' : '') . '>' . $location['location'] . '</option>';
}
?>
				</select>
			</div>
			<div class="buyGoldInfoStepFooter"></div>
		</div>
		<div class="buyGoldInfoStep goldProductStep">
			<div class="buyGoldInfoStepNumber">2</div>
			<div
				class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "Package"); ?>
				:
			</div>
			<div
				class="buyGoldInfoStepContent"><?=$vars['title']; ?></div>
			<div class="buyGoldInfoStepFooter"><a href="#"
			                                      class="changeGoldProduct"><?=T("PaymentWizard", "changePackage"); ?></a>
			</div>
		</div>
		<div class="buyGoldInfoStep payTypeStep active">
			<div class="buyGoldInfoStepNumber">3</div>
			<div
				class="buyGoldInfoStepLabel"><?=T("PaymentWizard", "BuySettings"); ?></div>
			<div
				class="buyGoldInfoStepContent"><?=T("PaymentWizard", "Select payment method"); ?></div>
			<div class="buyGoldInfoStepFooter"></div>
		</div>
		<div class="buyGoldFooter">
			<div class="footerItem footNotes">
				* <?=T("PaymentWizard", "All displayed prices are final prices"); ?></div>
			<div
				class="footerItem footHint"><?=T("PaymentWizard", "You can check the status of your order at any time"); ?></div>
			<div class="footerItem link">
				<a href="#"
				   class="openOrdersLink ordersShow"><?=T("PaymentWizard", "Show open orders"); ?></a>
				<a href="#"
				   class="openOrdersLink ordersHide hide"><?=T("PaymentWizard", "Hide open orders"); ?></a>
			</div>
			<div class="footerItem link">
				<a href="#"
				   onclick="return Travian.Game.iPopupUrl('<?=WebService::getPaymentUrl() . 'options.php?action=show'; ?>','<?=T("PaymentWizard", "Payment options:"); ?>')"><?=T("PaymentWizard", "Show payment methods"); ?></a>
			</div>
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
		<div
			class="buyGoldContent paymentWizardDirection<?=getDirection(); ?>">
			<h4 class="contentHead"><?=T("PaymentWizard", "Step3-ChoosePayment"); ?></h4>

			<div class="clear"></div>
			<?php foreach ($vars['providers'] as $provider): ?>
				<a href="#" class="providerLink">
					<input type="hidden" class="providerId"
					       value="<?=$provider['providerId']; ?>">

					<div class="boxes paymentProvider">
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
							<div class="providerContent">
								<h3><?=$provider['posId']; ?>
									. <?=$provider['name']; ?></h3>

								<p><?=$provider['description']; ?></p>
								<?php
    $url = WebService::getPaymentUrl() . 'img/provider/' . $provider['img'];
    $ext = explode(".", $provider['img'])[1];
    if ($ext == 'gif') {
        $img = imagecreatefromgif($url);
    } else if ($ext == 'png') {
        $img = imagecreatefrompng($url);
    }
    ?>
								<img width="<?=imagesx($img); ?>"
								     height="<?=imagesy($img); ?>"
								     alt="<?=$provider['name']; ?>"
								     src="<?=$url; ?>">
								<br/><br/>
							</div>
							<div class="selectedGoldPacket">
								<?php
    $url = $vars['img'];
    $ext = explode(".", $vars['img']);
    $ext = $ext[sizeof($ext) - 1];
    if ($ext == 'gif') {
        $img = imagecreatefromgif($url);
    } else if ($ext == 'png') {
        $img = imagecreatefrompng($url);
    }
    ?>
								<img width="<?=imagesx($img); ?>"
								     height="<?=imagesy($img) - 3; ?>"
								     src="<?=$vars['img']; ?>"><?=T("PaymentWizard", "Delivery:"); ?> <?=$provider['delivery']; ?>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="openOffers"></div>
	</div>
</div>