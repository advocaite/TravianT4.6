<?php

use Core\Helper\WebService;

?>
<h1 class="titleInHeader countrySelection">         
	<svg viewBox="0 0 20 20" preserveAspectRatio="none" class="arrowDown">
	<path d="M1 1L10 19L19 1"></path>
	</svg>
	<div class="inlineIcon " title="">
		<span class="value "><?= $vars['locationName'];?></span>
	</div>
</h1>
      
<div id="countrySelectionTemplate" class="">
	<h3><?=T("PaymentWizard", "Location"); ?>:</h3>
	<label class="filterCountry">
		<svg viewBox="0 0 20 20" class="magnifier">
		   <path d="M19.688 16.839l-.12-.121-4.808-4.808c.668-1.151 1.056-2.485 1.065-3.911.029-4.365-3.487-7.926-7.852-7.953h-.052C3.581.046.048 3.551.02 7.898c-.028 4.365 3.488 7.926 7.852 7.954h.052c1.45 0 2.81-.393 3.979-1.077l4.804 4.804.121.12c.363.363.952.363 1.315 0l1.545-1.545c.363-.363.363-.952 0-1.315zM7.919 12.847c-2.7-.017-4.883-2.228-4.866-4.929.017-2.683 2.214-4.866 4.896-4.866h.033c1.308.009 2.534.526 3.453 1.457.92.93 1.421 2.164 1.413 3.472-.009 1.302-.522 2.525-1.446 3.443-.924.918-2.149 1.423-3.451 1.423h-.032z"></path>
		</svg>
		<input type="text">
	</label>
	<div class="noCountryFound none hide"><?=T("PaymentWizard", "No country matches your search."); ?></div>
	<div class="scrollableContent">
		<?= $vars['locations'];?>
	</div>
</div>
<div class="loading">
 <svg viewBox="0 0 38 38">
	<defs>
	   <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="paymentShopLoader">
		  <stop stop-color="#fff" stop-opacity="0" offset="0%"></stop>
		  <stop stop-color="#fff" stop-opacity=".631" offset="63.146%"></stop>
		  <stop stop-color="#fff" offset="100%"></stop>
	   </linearGradient>
	</defs>
	<g fill="none" fill-rule="evenodd">
	   <path d="M36 18c0-9.94-8.06-18-18-18" stroke="url(#paymentShopLoader)" stroke-width="2"></path>
	   <circle fill="#fff" cx="36" cy="18" r="1"></circle>
	</g>
 </svg>
</div>
<div class="buyProgress">
 <div class="inlineIcon step selectPackage allowedStep active" title="">
	<svg viewBox="0 0 19.58 20" class="">
	   <path class="shield" d="M19.58 3.79S16.73 3 13.77 1.85C12.37 1.32 11 0 9.79 0s-2.7 1.35-4.15 1.91C2.74 3 0 3.79 0 3.79S-.38 15.42 9.79 20C20 15.42 19.58 3.79 19.58 3.79z"></path>
	   <path class="check" d="M15.37 6.18a.26.26 0 00-.25-.13 1.08 1.08 0 00-.58.22 5.55 5.55 0 00-.78.65l-3.45 3.42a6.57 6.57 0 01-.53.48.73.73 0 01-.3.18c-.13 0-1.74-2.51-2.1-2.51a1.42 1.42 0 00-1 .48 1.45 1.45 0 00-.46 1 13.56 13.56 0 001.25 3.06 1.57 1.57 0 00.63.63 1.66 1.66 0 00.81.31 2.33 2.33 0 001.06-.62 20.4 20.4 0 001.82-1.73l3.35-3.54.06-.06a1.76 1.76 0 00.58-1.23v-.15a1 1 0 00-.11-.46z"></path>
	</svg>
	<span class="value "><?= T("PaymentWizard", "Select package"); ?></span>
 </div>
 <div class="divider"></div>
 <div class="inlineIcon step selectPaymentMethod allowedStep locked" title="">
	<svg viewBox="0 0 19.58 20" class="">
	   <path class="shield" d="M19.58 3.79S16.73 3 13.77 1.85C12.37 1.32 11 0 9.79 0s-2.7 1.35-4.15 1.91C2.74 3 0 3.79 0 3.79S-.38 15.42 9.79 20C20 15.42 19.58 3.79 19.58 3.79z"></path>
	   <path class="check" d="M15.37 6.18a.26.26 0 00-.25-.13 1.08 1.08 0 00-.58.22 5.55 5.55 0 00-.78.65l-3.45 3.42a6.57 6.57 0 01-.53.48.73.73 0 01-.3.18c-.13 0-1.74-2.51-2.1-2.51a1.42 1.42 0 00-1 .48 1.45 1.45 0 00-.46 1 13.56 13.56 0 001.25 3.06 1.57 1.57 0 00.63.63 1.66 1.66 0 00.81.31 2.33 2.33 0 001.06-.62 20.4 20.4 0 001.82-1.73l3.35-3.54.06-.06a1.76 1.76 0 00.58-1.23v-.15a1 1 0 00-.11-.46z"></path>
	</svg>
	<span class="value "><?= T("PaymentWizard", "Payment method"); ?></span>
 </div>
 <div class="divider"></div>
 <div class="inlineIcon step insertBillingInformation locked" title="">
	<svg viewBox="0 0 19.58 20" class="">
	   <path class="shield" d="M19.58 3.79S16.73 3 13.77 1.85C12.37 1.32 11 0 9.79 0s-2.7 1.35-4.15 1.91C2.74 3 0 3.79 0 3.79S-.38 15.42 9.79 20C20 15.42 19.58 3.79 19.58 3.79z"></path>
	   <path class="check" d="M15.37 6.18a.26.26 0 00-.25-.13 1.08 1.08 0 00-.58.22 5.55 5.55 0 00-.78.65l-3.45 3.42a6.57 6.57 0 01-.53.48.73.73 0 01-.3.18c-.13 0-1.74-2.51-2.1-2.51a1.42 1.42 0 00-1 .48 1.45 1.45 0 00-.46 1 13.56 13.56 0 001.25 3.06 1.57 1.57 0 00.63.63 1.66 1.66 0 00.81.31 2.33 2.33 0 001.06-.62 20.4 20.4 0 001.82-1.73l3.35-3.54.06-.06a1.76 1.76 0 00.58-1.23v-.15a1 1 0 00-.11-.46z"></path>
	</svg>
	<span class="value "><?= T("PaymentWizard", "Billing information"); ?></span>
 </div>
 <div class="divider"></div>
 <div class="inlineIcon step confirmed locked" title="">
	<svg viewBox="0 0 19.58 20" class="">
	   <path class="shield" d="M19.58 3.79S16.73 3 13.77 1.85C12.37 1.32 11 0 9.79 0s-2.7 1.35-4.15 1.91C2.74 3 0 3.79 0 3.79S-.38 15.42 9.79 20C20 15.42 19.58 3.79 19.58 3.79z"></path>
	   <path class="check" d="M15.37 6.18a.26.26 0 00-.25-.13 1.08 1.08 0 00-.58.22 5.55 5.55 0 00-.78.65l-3.45 3.42a6.57 6.57 0 01-.53.48.73.73 0 01-.3.18c-.13 0-1.74-2.51-2.1-2.51a1.42 1.42 0 00-1 .48 1.45 1.45 0 00-.46 1 13.56 13.56 0 001.25 3.06 1.57 1.57 0 00.63.63 1.66 1.66 0 00.81.31 2.33 2.33 0 001.06-.62 20.4 20.4 0 001.82-1.73l3.35-3.54.06-.06a1.76 1.76 0 00.58-1.23v-.15a1 1 0 00-.11-.46z"></path>
	</svg>
	<span class="value "><?= T("PaymentWizard", "Confirmed"); ?></span>
 </div>
</div>
<div class="purchaseStepWrapper">
 <div class="packages">
	<?php 
	if(empty($vars['packages'])):
	?>
	<label for="package0" class="package noOffer emptyOffer"><div class="emptyOfferInformation"><?=T("PaymentWizard", "Currently there are no offers.");?></div></label>
	<?php
	else: 
		echo $vars['packages'];
	endif;
	?>
 </div>
 <div class="packages specialOffersPackages">
	<?php 
	if(empty($vars['offer_packages'])):
	?>
	<label for="package0" class="package specialOffer noOffer emptyOffer"><div class="emptyOfferInformation"><?=T("PaymentWizard", "Currently there are no offers.");?></div></label>
	<?php
	else: 
		echo $vars['offer_packages'];
	endif;
	?>
 </div>
 <div class="silwia normal"></div>
 <div class="packages smsPackages">
	<?php 
	if(empty($vars['sms_packages'])):
	?>
	<label for="package0" class="package noOffer emptyOffer"><div class="emptyOfferInformation"><?=T("PaymentWizard", "Currently there are no offers.");?></div></label>
	<?php
	else: 
		echo $vars['sms_packages'];
	endif;
	?>
 </div>
 <div class="confirmation billingInformation">
	<div class="confirmationTitle">Excellent choice!<br>One more step:</div>
	<div class="confirmationText">By clicking "Buy now", you will be forwarded to your payment provider. Please continue in the window that opens.</div>
	<div class="vatInfo">*&nbsp;All prices incl. VAT</div>
 </div>
 <div class="confirmation forwarded">
	<div class="confirmationTitle">Almost done...</div>
	<div class="confirmationText">We have forwarded you to the payment provider. Please proceed with your purchase in the external window.</div>
	<div class="confirmationTroubleshooting">
	   If the window doesn't open, please read the <a href="http://support.travian.com/en/support/solutions/articles/7000065565-cannot-start-purchase" target="_blank">troubleshooter.</a>                
	</div>
 </div>
 <div class="confirmation success">
	<div class="confirmationTitle">Payment confirmed</div>
	<div class="confirmationImage"></div>
	<div class="confirmationText">
	   Your transaction was successful!<br>
	   <span class="value">-</span> Gold added to your account.                
	</div>
 </div>
</div>
<div class="paymentWrapper">	  
 <div class="paymentMethods">
	<?=$vars['paymentMethods'];?>
	<div class="paymentMethod back">
	   <div class="back">
		  <svg viewBox="0 0 20 20" preserveAspectRatio="none">
			 <path d="M19 1L1 10L19 19"></path>
		  </svg>
		  <?= T("PaymentWizard", "Back"); ?>
	   </div>
	</div>
 </div>
 <span class="choosePayment"><?= T("PaymentWizard", "Choose your payment method"); ?></span>
 <span class="smsPayment <?=(!empty($vars['sms_packages'])?'available':'');?>">Prefer payment by SMS? Click <a href="#">here</a></span>
 <span class="rightOfWithdrawal">I have read the information concerning the exercise of the <a href="https://agb.traviangames.com/rights-en.pdf" target="_blank">right of withdrawal</a>.</span>
 
 <a href="#" class="transactionHistory" onclick="shopUIV4.renderTransactionHistoryDialog(); return false;"><?= T("PaymentWizard", "Order History"); ?></a>
 <button type="button" value="<?= T("PaymentWizard", "Continue"); ?>" id="continueBuy" class="textButtonV2 green buyButton disabled buttonFramed withText rectangle" onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}" version="textButtonV2" onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;">
	<div>
	   <?= T("PaymentWizard", "Continue"); ?>	
	</div>
 </button>
 <script type="text/javascript" id="continueBuy_script">
	jQuery(function() {
		   jQuery('button#continueBuy').click(function () {
			   jQuery(window).trigger('buttonClicked', [this, {"type":"button","value":"<?= T("PaymentWizard", "Continue"); ?>","name":"","id":"continueBuy","class":"textButtonV2 green buyButton disabled buttonFramed withText rectangle","title":"","confirm":"","onclick":"if(jQuery(this).hasClass(\u0027disabled\u0027)){event.stopPropagation(); return false;} else {}","version":"textButtonV2","onfocus":"jQuery(\u0027button\u0027, \u0027input[type!=hidden]\u0027, \u0027select\u0027).focus(); event.stopPropagation(); return false;"}]);
		   });
	});
 </script>
 <button type="button" value="<?= T("PaymentWizard", "Buy now"); ?>" id="confirmBuy" class="textButtonV2 green buyButton disabled buttonFramed withText rectangle" onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}" version="textButtonV2" onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;">
	<div>
	   <?= T("PaymentWizard", "Buy now"); ?>	
	</div>
 </button>
 <script type="text/javascript" id="confirmBuy_script">
	jQuery(function() {
		   jQuery('button#confirmBuy').click(function () {
			   jQuery(window).trigger('buttonClicked', [this, {"type":"button","value":"<?= T("PaymentWizard", "Buy now"); ?>","name":"","id":"confirmBuy","class":"textButtonV2 green buyButton disabled buttonFramed withText rectangle","title":"","confirm":"","onclick":"if(jQuery(this).hasClass(\u0027disabled\u0027)){event.stopPropagation(); return false;} else {}","version":"textButtonV2","onfocus":"jQuery(\u0027button\u0027, \u0027input[type!=hidden]\u0027, \u0027select\u0027).focus(); event.stopPropagation(); return false;"}]);
		   });
	});
 </script>
 <button type="button" value="<?= T("PaymentWizard", "Back to the game"); ?>" id="backToGame" class="textButtonV2 green  buttonFramed withText rectangle" version="textButtonV2">
	<div>
	   <?= T("PaymentWizard", "Back to the game"); ?>	
	</div>
 </button>
 <script type="text/javascript" id="backToGame_script">
	jQuery(function() {
		   jQuery('button#backToGame').click(function () {
			   jQuery(window).trigger('buttonClicked', [this, {"type":"button","value":"<?= T("PaymentWizard", "Back to the game"); ?>","name":"","id":"backToGame","class":"textButtonV2 green  buttonFramed withText rectangle","title":"","confirm":"","onclick":"","version":"textButtonV2"}]);
		   });
	});
 </script>
</div>


<script type="text/javascript" data-cmp-info="6">
 Travian.Translation.add({
	 'paymentWizard.pricesAreFinalExceptExtraTaxes': 'All prices are final unless extra taxes apply'
 });
</script>