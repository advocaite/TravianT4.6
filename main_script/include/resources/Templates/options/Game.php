<form id="settings" action="options.php" method="post">
	<input type="hidden" name="s" value="1"/>
	<input type="hidden" name="e" value="1"/>

	<h4 class="round"><?php use Core\Config;
        use Core\Session;

        echo T("Options", "Report filter"); ?></h4>
	<?php
	$checked = 'checked="checked"';
	$session = Session::getInstance();
	?>
	<table class="transparent set" cellpadding="1" cellspacing="1"
	       id="report_filter">
		<tbody>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getReportFilters()[0] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v4" value="1" id="report_filter_option_4"/>
			</td>
			<td>
				<label
					for="report_filter_option_4"><?=T("Options", "No reports about transfers between your own villages"); ?></label>
			</td>
		</tr>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getReportFilters()[1] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v5" value="1" id="report_filter_option_5"/>
			</td>
			<td>
				<label
					for="report_filter_option_5"><?=T("Options", "No reports about transfers to foreign villages"); ?></label>
			</td>
		</tr>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getReportFilters()[2] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v6" value="1" id="report_filter_option_6"/>
			</td>
			<td>
				<label
					for="report_filter_option_6"><?=T("Options", "No reports about transfers from foreign villages"); ?></label>
			</td>
		</tr>
		</tbody>
	</table>
	<h4 class="round spacer"><?=T("Options", "Alliance settings"); ?></h4>
	<table class="transparent set" cellpadding="1" cellspacing="1"
	       id="alliance">
		<tbody>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->isAllianceNotificationEnabled() ? $checked : ''; ?>
					type="checkbox" name="v12" value="1">
			</td>
			<td><?=T("Options", "Receive notifications about invitations to an alliance"); ?></td>
		</tr>
		</tbody>
	</table>
	<?php if(Session::getInstance()->getAllianceId() > 0): ?>
		<table class="transparent set" cellpadding="1" cellspacing="1"
		       id="alliance">
			<tbody>
			<tr>
				<td colspan="2"><?=T("Options", "Show alliance news"); ?>
					:
				</td>
			</tr>
			<tr>
				<td class="sel">
					<input
						class="check" <?=$session->getAllianceSettings()[0] == 1 ? $checked : ''; ?>
						type="checkbox" name="v7" value="1"/>
				</td>
				<td><?=T("Options", "Alliance members founded new village"); ?></td>
			</tr>
			<tr>
				<td class="sel">
					<input
						class="check" <?=$session->getAllianceSettings()[1] == 1 ? $checked : ''; ?>
						type="checkbox" name="v8" value="1"/>
				</td>
				<td><?=T("Options", "New alliance member joined"); ?></td>
			</tr>
			<tr>
				<td class="sel">
					<input
						class="check" <?=$session->getAllianceSettings()[2] == 1 ? $checked : ''; ?>
						type="checkbox" name="v9" value="1"/>
				</td>
				<td><?=T("Options", "Player has been invited"); ?></td>
			</tr>
			<tr>
				<td class="sel">
					<input
						class="check" <?=$session->getAllianceSettings()[3] == 1 ? $checked : ''; ?>
						type="checkbox" name="v10" value="1"/>
				</td>
				<td><?=T("Options", "Player has left alliance"); ?></td>
			</tr>
			<tr>
				<td class="sel">
					<input
						class="check" <?=$session->getAllianceSettings()[4] == 1 ? $checked : ''; ?>
						type="checkbox" name="v11" value="1"/>
				</td>
				<td><?=T("Options", "Player was kicked from alliance"); ?></td>
			</tr>
			</tbody>
		</table>
	<?php endif; ?>
	<h4 class="round spacer"><?=T("Options", "Auto-complete"); ?></h4>
	<table class="transparent set" cellpadding="1" cellspacing="1"
	       id="completion">
		<tbody>
		<tr>
			<td colspan="2"><?=T("Options", "Complete for rally point and marketplace"); ?>
				:
			</td>
		</tr>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getAutoComplete()[0] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v1" value="1"/>
			</td>
			<td>
				<?=T("Options", "Own villages"); ?>                    </td>
		</tr>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getAutoComplete()[1] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v2" value="1"/>
			</td>
			<td>
				<?=T("Options", "Nearby villages"); ?></td>
		</tr>
		<tr>
			<td class="sel">
				<input
					class="check" <?=$session->getAutoComplete()[2] == 1 ? $checked : ''; ?>
					type="checkbox"
					name="v3" value="1"/>
			</td>
			<td>
				<?=T("Options", "Alliance members' villages"); ?>                    </td>
		</tr>
		</tbody>
	</table>
	<h4 class="round spacer"><?=T("Options", "Display"); ?></h4>

	<table class="transparent set" cellpadding="1" cellspacing="1" id="other">
		<tbody>
		<tr>
			<?php if(is_lowres()): ?>
				<td class="noOptions"
				    colspan="2"><?=T("Options", "The LowRes version does not display images in reports"); ?></td>
			<?php else: ?>
				<td class="sel">
					<input
						class="check" <?=$session->getDisplay()[0] == 1 ? $checked : ''; ?>
						type="checkbox"
						id="flag_hiden_report_image"
						name="flag_hiden_report_image" value="1"/>
				</td>
				<td>
					<label
						for="flag_hiden_report_image"><?=T("Options", "Don't display images in reports"); ?></label>
				</td>
			<?php endif; ?>
		</tr>
        <tr>
                <td class="sel">
                    <input
                        class="check" <?=$session->getDisplay()[5] == 1 ? $checked : ''; ?>
                        type="checkbox"
                        id="fast_upgrade"
                        name="fast_upgrade" value="1"/>
                </td>
                <td>
                    <label
                        for="fast_upgrade"><?=T("Options", "Use fast upgrade on buildings"); ?></label>
                </td>
        </tr>
		</tbody>
	</table>

	<table class="transparent set" cellpadding="1" cellspacing="1"
	       id="entriesPerPage">
		<tbody>
		<tr>
			<td>
				<label
					for="epp"><?=T("Options", "Messages and reports per page"); ?>
					:</label>
			</td>
			<td>
				<input type="text" maxlength="2"
				       value="<?=$session->getReportsRecordsPerPage(); ?>"
				       id="epp"
				       name="epp" class="text messageReport"/>
			</td>
		</tr>
		<tr>
			<td>
				<label
					for="troopMovementsPerPage"><?=T("Options", "Troop movements per page in rally point"); ?>
					:</label>
			</td>
			<td>
				<input type="text" maxlength="3"
				       value="<?=$session->getRallyPointRecordsPerPage(); ?>"
				       id="troopMovementsPerPage" name="troopMovementsPerPage"
				       class="text troopMovementsPerPage"/>
			</td>
		</tr>
		</tbody>
	</table>
	<h4 class="round spacer"><?=T("Options", "Time zone preferences"); ?></h4>
    <table class="transparent set timeSettings" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <td colspan="2"><?=T("Options", "You can change your time zone here"); ?></td>
        </tr>
        <tr>
            <th><?=T("Options", "Time zone"); ?></th>
            <td>
                <select name="timezone">
                    <optgroup
                            label="<?=T("Options", "local time zones"); ?>">
                        <?php
                        $timezones = Config::getInstance()->timezones;
                        $myTimeZone = Session::getInstance()->getTimezone()[0];
                        if($myTimeZone == 0) {
                            $myTimeZone = date_default_timezone_get();
                        } else {
                            if(isset($timezones['general'][$myTimeZone])){
                                $myTimeZone = $timezones['general'][$myTimeZone];
                            } else {
                                $myTimeZone = $timezones['local'][$myTimeZone];
                            }
                        }
                        foreach($timezones['local'] as $k => $zone) {
                            echo '<option value="'.$k.'" '.($zone == $myTimeZone ? 'selected="selected"' : '').'>'.$zone.'</option>';
                        }
                        ?>
                    </optgroup>
                    <optgroup
                            label="<?=T("Options", "general time zones"); ?>">
                        <?php
                        foreach($timezones['general'] as $k => $zone) {
                            echo '<option value="'.$k.'" '.($zone == $myTimeZone ? 'selected="selected"' : '').'>'.$zone.'</option>';
                        }
                        ?>
                    </optgroup>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <!--
    <table class="transparent set timeSettings" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <td class="sel">
                <input class="check" type="checkbox" id="flag_local_time_instead_server" name="flag_local_time_instead_server" value="1">
            </td>
            <td>
                <label for="flag_local_time_instead_server">Show local time instead of server time on top</label>
            </td>
        </tr>
        </tbody>
    </table>
    --->
    <table class="transparent set timeSettings" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <th class="timeFormat">
                <?=T("Options", "Date format"); ?>:
            </th>
            <td>
                <label>
                    <input
                            class="radio" <?=$session->getTimezone()[1] == 0 ? $checked : ''; ?>
                            type="radio"
                            name="tformat" value="0"/> EU (dd.mm.yy 24h) </label>
                <label>
                    <input
                            class="radio" <?=$session->getTimezone()[1] == 1 ? $checked : ''; ?>
                            type="radio"
                            name="tformat" value="1"/> US (mm/dd/yy 12h) </label>
                <label>
                    <input
                            class="radio" <?=$session->getTimezone()[1] == 2 ? $checked : ''; ?>
                            type="radio"
                            name="tformat" value="2"/> UK (dd/mm/yy 12h) </label>
                <label>
                    <input
                            class="radio" <?=$session->getTimezone()[1] == 3 ? $checked : ''; ?>
                            type="radio"
                            name="tformat" value="3"/> ISO (yy/mm/dd 24h) </label>
            </td>
        </tr>
        </tbody>
    </table>
	<h4 class="round spacer"><?=T("Options", "language settings");?></h4>
	<table class="transparent set" cellpadding="1" cellspacing="1" id="languageSettings">
		<tbody>
		<tr>
			<th>
				<?=T("Options", "Language");?>:</th>
			<td>
				<select name="lang">
					<?php
					$Languages = (array) Config::getInstance()->settings->availableLanguages;
					$L = Session::getInstance()->getLanguage();
					foreach($Languages as $key => $value){
						echo '<option value="'.$key.'"'.($key == $L ? ' selected="selected"' : '').'>'.$value->name.'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		</tbody>
	</table>


	<div class="submitButtonContainer">
		<button type="submit" value="save" name="s1" id="btn_ok" class="green ">
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
				if (jQuery('#btn_ok')) {
					jQuery('#btn_ok').click(function (event) {
						jQuery(window).trigger('buttonClicked', [this, {
							"type": "submit",
							"value": "save",
							"name": "s1",
							"id": "btn_ok",
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