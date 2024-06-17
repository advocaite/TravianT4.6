<div id="transactionHistory">
	<h3><?=T("PaymentWizard", "OpenOffers"); ?></h3>
	<div class="scrollableContent">
		<div class="tableWrapper">
			<table cellpadding="1" cellspacing="1" id="open_orders" class=" lang_ltr">
				<thead>
				<tr>
					<th><?=T("PaymentWizard", "Order Date"); ?></th>
					<th><?=T("PaymentWizard", "Status"); ?></th>
					<th><?=T("PaymentWizard", "Booking"); ?></th>
					<th><?=T("PaymentWizard", "Payment method"); ?></th>
					<th><?=T("PaymentWizard", "Gold"); ?></th>
					<th><?=T("PaymentWizard", "Price"); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<?=$vars['content']; ?>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" data-cmp-info="6">
	jQuery(function () {
		shopUIV4.copyOrderCodeListener();
	});
</script>