<?php 
use Core\Helper\WebService;
foreach ($vars['providers'] as $provider): ?>
<input id="paymentMethod<?=$provider['providerId']; ?>" type="radio" name="paymentMethod" value="<?=$provider['providerId']; ?>" data-iframe="no" data-code="<?=$provider['providerId']; ?>" <?=($vars['enabled']?'disabled="disabled"':'');?>>
<label for="paymentMethod<?=$provider['providerId']; ?>" class="paymentMethod ">
   <div class="paymentImage" style="background-image: url('<?=$url = WebService::getPaymentUrl() . 'img/provider/' . $provider['img'];?>');" alt="<?=$provider['name']; ?>"></div>
   <div class="duration">
	  <?=$provider['delivery']; ?>	
   </div>
</label>
<?php endforeach; ?>
<div class="paymentMethod back">
<div class="back">
	<svg viewBox="0 0 20 20" preserveAspectRatio="none">
		<path d="M19 1L1 10L19 19"></path>
	</svg>
	<?=T("PaymentWizard", "Back");?>
</div>
</div>