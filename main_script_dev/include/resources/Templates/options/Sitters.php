<h4 class="round"><?php
    use Core\Session;

    $m = new \Model\OptionModel();
	echo T("Options", "Sitter(s) for this account"); ?></h4>
<?php
if(isset($vars['error'])){
    echo '<span class="warning">'.$vars['error'].'</span>';
}
?>
<form id="settings" action="options.php" method="post">
	<input type="hidden" name="e" value="3"/>
	<input type="hidden" name="s" value="3"/>
	<input type="hidden" name="a"
	       value="<?=Session::getInstance()->getChecker(); ?>"/>
	<input type="hidden" name="sitter_flag_posted" value="1"/>

	<div class="text">
		<?=T("Options", "MySittersDesc"); ?>
	</div>

	<script type="text/javascript">
		function cloneName(obj, id) {
			$(id).innerHTML = obj.value.stripTags();
			Travian.Form.UnloadHelper.updateSubmitButtons(jQuery('#settings'));
		}
	</script>
	<?php
	$sitter = $m->getMySitters(Session::getInstance()->getSittersId(1), Session::getInstance()->getSittersPermissions(1), Session::getInstance()->getSittersId(2), Session::getInstance()->getSittersPermissions(2));
	?>
	<table class="sitters transparent">
		<tr>
			<th>
				<div class="boxes boxesColor lightGreen">
					<div class="boxes-tl"></div>
					<div class="boxes-tr"></div>
					<div class="boxes-tc"></div>
					<div class="boxes-ml"></div>
					<div class="boxes-mr"></div>
					<div class="boxes-mc"></div>
					<div class="boxes-bl"></div>
					<div class="boxes-br"></div>
					<div class="boxes-bc"></div>
					<div
						class="boxes-contents cf"><span><?=T("Options", "sitter"); ?>
							I					</span>
					</div>
				</div>
			</th>
			<td>
				<?php
				if($sitter[1]['uid'] == 0) {
					echo '<input onkeyup="cloneName(this, \'sitterName0\')" class="text" type="text" name="sitter[0]" maxlength="15" value="" />';
				} else {
					echo '<button type="button" class="icon " onclick="window.location.href = \'options.php?s=3&amp;e=3&amp;id='.$sitter[1]['uid'].'&amp;a='.Session::getInstance()->getChecker().'&amp;type=1\'; return false;"><img src="img/x.gif" class="del" alt="del"></button>&nbsp;'.$sitter[1]['name'];
				}
				?>
			</td>
		</tr>
		<tr>
			<th>
				<div class="boxes boxesColor orange">
					<div class="boxes-tl"></div>
					<div class="boxes-tr"></div>
					<div class="boxes-tc"></div>
					<div class="boxes-ml"></div>
					<div class="boxes-mr"></div>
					<div class="boxes-mc"></div>
					<div class="boxes-bl"></div>
					<div class="boxes-br"></div>
					<div class="boxes-bc"></div>
					<div
						class="boxes-contents cf"><span><?=T("Options", "sitter"); ?>
							II					</span>
					</div>
				</div>
			</th>
			<td>
				<?php
				if($sitter[2]['uid'] == 0) {
					echo '<input onkeyup="cloneName(this, \'sitterName1\')" class="text" type="text" name="sitter[-1]" maxlength="15" value="" />';
				} else {
					echo '<button type="button" class="icon " onclick="window.location.href = \'options.php?s=3&amp;e=3&amp;id='.$sitter[2]['uid'].'&amp;a='.Session::getInstance()->getChecker().'&amp;type=1\'; return false;"><img src="img/x.gif" class="del" alt="del"></button>&nbsp;'.$sitter[2]['name'];
				}
				?>
			</td>
		</tr>
	</table>

	<table cellpadding="1" cellspacing="1" class="sitters2 spacer">
		<tbody>
		<tr class="sitterHead">
			<th><?=T("Options", "player name"); ?></th>

			<td class="name"
			    id="sitterName0"><?=$sitter[1]['name']; ?></td>


			<td class="name"
			    id="sitterName1"><?=$sitter[2]['name']; ?></td>

		</tr>
		<tr>
			<th><?=T("Options", "Send raids"); ?></th>
			<td>
				<input type="checkbox" value="1"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 1 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="1"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 1 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
		<tr>
			<th><?=T("Options", "Send reinforcements to other players"); ?></th>
			<td>
				<input type="checkbox" value="2"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 2 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="2"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 2 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
		<tr>
			<th><?=T("Options", "Send resources to other players"); ?></th>
			<td>
				<input type="checkbox" value="4"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 4 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="4"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 4 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
		<tr>
			<th><?=T("Options", "Buy and spend Gold"); ?></th>
			<td>
				<input type="checkbox" value="8"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 8 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="8"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 8 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
		<tr>
			<th><?=T("Options", "Read and send messages"); ?></th>
			<td>
				<input type="checkbox" value="16"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 16 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="16"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 16 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
		<tr>
			<th><?=T("Options", "Delete and archive messages and reports"); ?></th>
			<td>
				<input type="checkbox" value="32"
				       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 32 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
			<td>
				<input type="checkbox" value="32"
				       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 32 ? ' checked="checked"' : ''; ?>
				       class="check"/>
			</td>
		</tr>
        <tr>
            <th><?=T("Options", "Contribute resources to alliance bonuses"); ?></th>
            <td>
                <input type="checkbox" value="64"
                       name="sitter_flag[0][]" <?=$sitter[1]['perm'] & 64 ? ' checked="checked"' : ''; ?>
                       class="check"/>
            </td>
            <td>
                <input type="checkbox" value="64"
                       name="sitter_flag[-1][]" <?=$sitter[2]['perm'] & 64 ? ' checked="checked"' : ''; ?>
                       class="check"/>
            </td>
        </tr>
		</tbody>
	</table>

	<h4 class="round spacer"><?=T("Options", "Sitting for other account(s)"); ?></h4>

	<div class="text">
		<?=T("Options", "Sitting for other account(s)Desc"); ?>
	</div>
	<?php
	$sitter = $m->getSitters(Session::getInstance()->getPlayerId());
	?>
	<table class="sitters transparent">
		<tr>
			<th>
				<div class="boxes boxesColor lightGreen">
					<div class="boxes-tl"></div>
					<div class="boxes-tr"></div>
					<div class="boxes-tc"></div>
					<div class="boxes-ml"></div>
					<div class="boxes-mr"></div>
					<div class="boxes-mc"></div>
					<div class="boxes-bl"></div>
					<div class="boxes-br"></div>
					<div class="boxes-bc"></div>
					<div
						class="boxes-contents cf"><span><?=T("Options", "sitter"); ?>
							I					</span>
					</div>
				</div>
			</th>
			<td>
				<?php
				if($sitter[1]['uid'] == 0) {
					echo '<span class="errorMessage">'.T("Options", "no entry").'</span>';
				} else {
					echo '<button type="button" class="icon " onclick="window.location.href = \'options.php?s=3&amp;e=3&amp;id='.$sitter[1]['uid'].'&amp;a='.Session::getInstance()->getChecker().'&amp;type=2\'; return false;"><img src="img/x.gif" class="del" alt="del"></button>&nbsp;'.$sitter[1]['name'];
				}
				?>
			</td>
		</tr>
		<tr>
			<th>
				<div class="boxes boxesColor orange">
					<div class="boxes-tl"></div>
					<div class="boxes-tr"></div>
					<div class="boxes-tc"></div>
					<div class="boxes-ml"></div>
					<div class="boxes-mr"></div>
					<div class="boxes-mc"></div>
					<div class="boxes-bl"></div>
					<div class="boxes-br"></div>
					<div class="boxes-bc"></div>
					<div
						class="boxes-contents cf"><span><?=T("Options", "sitter"); ?>
							II					</span>
					</div>
				</div>
			</th>
			<td>
				<?php
				if($sitter[2]['uid'] == 0) {
					echo '<span class="errorMessage">'.T("Options", "no entry").'</span>';
				} else {
					echo '<button type="button" class="icon " onclick="window.location.href = \'options.php?s=3&amp;e=3&amp;id='.$sitter[2]['uid'].'&amp;a='.Session::getInstance()->getChecker().'&amp;type=2\'; return false;"><img src="img/x.gif" class="del" alt="del"></button>&nbsp;'.$sitter[2]['name'];
				}
				?>
			</td>
		</tr>
	</table>

	<table cellpadding="1" cellspacing="1" class="sitters2 spacer">
		<tbody>
		<tr class="sitterHead">
			<th><?=T("Options", "player name"); ?></th>

			<td id="sittingsName0"
			    class="name"><?=$sitter[1]['name']; ?></td>


			<td id="sittingsName1"
			    class="name"><?=$sitter[2]['name']; ?></td>

		</tr>

		<tr>

			<th><?=T("Options", "Send raids"); ?></th>
			<td>
				<input type="checkbox" value="1" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 1 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="1" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 1 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
		<tr>

			<th><?=T("Options", "Send reinforcements to other players"); ?></th>
			<td>
				<input type="checkbox" value="2" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 2 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="2" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 2 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
		<tr>

			<th><?=T("Options", "Send resources to other players"); ?></th>
			<td>
				<input type="checkbox" value="4" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 4 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="4" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 4 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
		<tr>

			<th><?=T("Options", "Buy and spend Gold"); ?></th>
			<td>
				<input type="checkbox" value="8" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 8 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="8" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 8 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
		<tr>

			<th><?=T("Options", "Read and send messages"); ?></th>
			<td>
				<input type="checkbox" value="16" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 16 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="16" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 16 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
		<tr>

			<th><?=T("Options", "Delete and archive messages and reports"); ?></th>
			<td>
				<input type="checkbox" value="32" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[1]['perm'] & 32 ? ' checked="checked"' : ''; ?> />
			</td>
			<td>
				<input type="checkbox" value="32" name="sitter_flag[][]"
				       disabled="disabled"
				       class="check" <?=$sitter[2]['perm'] & 32 ? ' checked="checked"' : ''; ?> />
			</td>
		</tr>
        <tr>
            <th><?=T("Options", "Contribute resources to alliance bonuses"); ?></th>
            <td>
                <input type="checkbox" value="64" name="sitter_flag[][]"
                       disabled="disabled"
                       class="check" <?=$sitter[1]['perm'] & 64 ? ' checked="checked"' : ''; ?> />
            </td>
            <td>
                <input type="checkbox" value="64" name="sitter_flag[][]"
                       disabled="disabled"
                       class="check" <?=$sitter[2]['perm'] & 64 ? ' checked="checked"' : ''; ?> />
            </td>
        </tr>

		</tbody>
	</table>

	<div class="submitButtonContainer">
		<button type="submit" value="save"
		        id="<?=$button_id = get_button_id(); ?>" class="green ">
			<div class="button-container addHoverClick">
				<div class="button-background">
					<div class="buttonStart">
						<div class="buttonEnd">
							<div class="buttonMiddle"></div>
						</div>
					</div>
				</div>
				<div
					class="button-content"><?=T("Global", "General.save"); ?></div>
			</div>
		</button>
		<script type="text/javascript">
			jQuery(function() {
				if (jQuery('#<?=$button_id;?>')) {
					jQuery('#<?=$button_id;?>').click(function (event) {
						jQuery(window).trigger('buttonClicked', [this, {
							"type": "submit",
							"value": "<?=T("Global", "General.save");?>",
							"name": "",
							"id": "<?=$button_id;?>",
							"class": "green ",
							"title": "",
							"confirm": "",
							"onclick": ""
						}]);
					});
				}
			});
		</script>
	</div>
</form>
<script type="text/javascript">
	jQuery(function() {
		Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#settings'));
	});
</script>