<h4 class="round"><?=T("Options", "Vacation mode is active"); ?></h4>
<div>
	<?=T("Options", "Your are not able to"); ?>
	<ul>
		<li><?=T("Options", "upgrade buildings"); ?></li>
		<li><?=T("Options", "train troops"); ?></li>
		<li><?=T("Options", "send troops"); ?></li>
		<li><?=T("Options", "send merchants"); ?></li>
		<li><?=T("Options", "delete your account"); ?></li>
	</ul>
</div>

<div class="vacationModeActive">
	<div>
		<?=T("Options", "Remaining days in vacation mode"); ?>
		: <?=$vars['vacationDays']; ?> <?=T("Options", "day(s)"); ?></div>
	<div>
		<?=T("Options", "Vacation mode runs til"); ?>
		: <?=$vars['vacationTil']; ?></div>
	<div>
		<?=T("Options", "You can abort vacation mode now"); ?></div>
	<br/>

	<div>
		<button type="button"
		        value="<?=T("Options", "abort vacation mode"); ?>"
		        id="<?=$button_id = get_button_id(); ?>" class="gold "
		        title="<?=T("Options", "abort vacation mode"); ?>">
			<div class="button-container addHoverClick">
				<div class="button-background">
					<div class="buttonStart">
						<div class="buttonEnd">
							<div class="buttonMiddle"></div>
						</div>
					</div>
				</div>
				<div
					class="button-content"><?=T("Options", "abort vacation mode"); ?></div>
			</div>
		</button>
		<script type="text/javascript">
			jQuery(function() {
				if (jQuery('#<?=$button_id;?>')) {
					jQuery('#<?=$button_id;?>').click(function (event) {
						jQuery(window).trigger('buttonClicked', [this, {
							"type": "button",
							"value": "<?=T("Options", "abort vacation mode");?>",
							"name": "",
							"id": "button5587ee2fad056",
							"class": "gold ",
							"title": "<?=T("Options", "abort vacation mode");?>",
							"confirm": "",
							"onclick": "",
							"wayOfPayment": {"featureKey": "VacationModeAbort"}
						}]);
					});
				}
			});
		</script>
	</div>
</div>