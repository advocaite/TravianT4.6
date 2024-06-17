<?=sprintf(T("GoldBank", "Are you sure you want to transfer %s gold to this account?"), $vars['goldAmount']); ?>
<div class="buttons">
	<button type="submit" value="<?=T("inGame", "Exchange"); ?>"
	        id="<?=$button_id = get_button_id(); ?>" class="gold "
	        title="<?=sprintf(T("GoldBank", "Are you sure you want to transfer %s gold to this account?"), $vars['goldAmount']); ?>"
	        coins="<?=$vars['goldAmount']; ?>">
		<div class="button-container addHoverClick">
			<div class="button-background">
				<div class="buttonStart">
					<div class="buttonEnd">
						<div class="buttonMiddle"></div>
					</div>
				</div>
			</div>
			<div class="button-content"><?=T("GoldBank", "Transfer"); ?>
				<img src="img/x.gif" class="goldIcon"
				     alt=""/><span
					class="goldValue"><?=$vars['goldAmount']; ?></span>
			</div>
		</div>
	</button>
	<script type="text/javascript">
		jQuery(function() {
			if (jQuery('#<?=$button_id;?>')) {
				jQuery('#<?=$button_id;?>').click(function (event) {
					jQuery(window).trigger('buttonClicked', [this, {
						"type": "button",
						"value": "<?=T("GoldBank", "Transfer");?>",
						"name": "",
						"id": "<?=$button_id;?>",
						"class": "gold ",
						"title": "<?=sprintf(T("GoldBank", "Are you sure you want to transfer %s gold to this account?"), $vars['goldAmount']);?>",
						"confirm": "",
						"onclick": "",
						"coins": <?=$vars['goldAmount']; ?>,
						"wayOfPayment": {
							"featureKey": "transferGold",
							"goldAmount": <?=$vars['goldAmount']; ?>,
							"dataCallback": "reload"
						}
					}]);
				});
			}
		});
	</script>
</div>