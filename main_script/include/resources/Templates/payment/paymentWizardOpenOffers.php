<h4><?=T("PaymentWizard", "OpenOffers"); ?></h4>
<table cellpadding="1" cellspacing="1" id="open_orders" class=" lang_ltr">
	<thead>
	<tr>
		<th><?=T("PaymentWizard", "Order Date"); ?></th>
		<th><?=T("PaymentWizard", "Payment"); ?></th>
		<th><?=T("PaymentWizard", "Booking"); ?></th>
		<th><?=T("PaymentWizard", "Presenter"); ?></th>
		<th><?=T("PaymentWizard", "Units"); ?></th>
		<th><?=T("PaymentWizard", "Price"); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<?=$vars['content']; ?>
	</tr>
	</tbody>
</table>