<?php if($vars['error1'] or $vars['error2']):?>
	<span class="error"><?=$vars['error1'] ? T("Installer", "error1") : ($vars['error2'] ? T("Installer", "error2") .  ' => ' . $vars['extra'] : '');?></span>
	<br/>
	<br/>
<?php endif;?>
<form method="post" action="index.php?do=set" id="dataform">
	<div id="statLeft" class="top10Wrapper">
		<h4 class="round small  top top10_defs"><?=T("Installer", "Game Server Settings");?></h4>
		<table cellpadding="1" cellspacing="1" id="top10_defs" class="top10 row_table_data">
			<tr class="hover">
				<td><?=T("Installer", "DB_HOST");?>:</td>
				<td><input type="text" class="text" name="db_host" value="<?=$vars['db_host'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "DB_USRE");?>:</td>
				<td><input type="text" class="text" name="db_user" value="<?=$vars['db_user'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "DB_PASS");?>:</td>
				<td><input type="password" class="text" name="db_pass" value="<?=$vars['db_pass'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "DB_DB");?>:</td>
				<td><input type="text" class="text" name="db_db" value="<?=$vars['db_db'];?>"></td>
			</tr>
			<tr class="hover">
				<td colspan="2"><br/></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "worldId");?>:</td>
				<td><input type="text" class="text" name="worldId" value="<?=$vars['worldId'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "preregistration_only");?>:</td>
				<td><input type="text" class="text" name="preregistration_key_only"
				           value="<?=$vars['preregistration_key_only'];?>">
					<br/><?=T("Installer", "preregistration_only_desc");?></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "promoted");?>:</td>
				<td><input type="text" class="text" name="promoted" value="<?=$vars['promoted'];?>"></td>
			</tr>

			<tr class="hover">
				<td colspan="2"><br/></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "startTime");?> (Y-m-d H:i) :</td>
				<td><input type="text" class="text" name="startTime" value="<?=$vars['startTime'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "ServerSpeed");?>:</td>
				<td><input type="number" class="text" name="speed" min="1" max="2000" value="<?=$vars['speed'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "MovementsSpeed");?>:</td>
				<td><input type="number" class="text" name="move_speed" min="1" max="2000" value="<?=$vars['move_speed'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "RoundLength");?>:</td>
				<td><input type="number" class="text" name="round_length" min="3" max="365" value="<?=$vars['round_length'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "protect_time");?>:</td>
				<td><input type="number" class="text" name="protection_time" min="0" max="192"
				           value="<?=$vars['protection_time'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "TrapMultiplier");?>:</td>
				<td><input type="number" class="text" name="trap_multiplier" min="1" max="1000"
				           value="<?=$vars['trap_multiplier'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "StorageMultiplier");?>:</td>
				<td><input type="number" class="text" name="storage_multiplier" min="1" max="1000"
				           value="<?=$vars['storage_multiplier'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "plus_days");?>:</td>
				<td><input type="number" class="text" name="plus_days" min="1" max="7" value="<?=$vars['plus_days'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "plus_gold");?>:</td>
				<td><input type="number" class="text" name="plus_gold" min="10" max="50" value="<?=$vars['plus_gold'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "production_days");?>:</td>
				<td><input type="number" class="text" name="production_days" min="1" max="14"
				           value="<?=$vars['production_days'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "production_gold");?>:</td>
				<td><input type="number" class="text" name="production_gold" min="5" max="50"
				           value="<?=$vars['production_gold'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "finish_now_gold");?>:</td>
				<td><input type="number" class="text" name="finish_now_gold" min="2" max="10"
				           value="<?=$vars['finish_now_gold'];?>"></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "master_gold");?>:</td>
				<td><input type="number" class="text" name="master_gold" min="1" max="10" value="<?=$vars['master_gold'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "demolish_gold");?>:</td>
				<td><input type="number" class="text" name="demolish_gold" min="1" max="10" value="<?=$vars['demolish_gold'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "exchange_gold");?>:</td>
				<td><input type="number" class="text" name="exchange_gold" min="1" max="10" value="<?=$vars['exchange_gold'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "medal_interval");?>:</td>
				<td><input type="number" class="text" name="medal_interval" min="1" max="7"
				           value="<?=$vars['medal_interval'];?>"></td>
			</tr>
			<tr class="hover">
				<td colspan="2"><br/></td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "dailyGold");?>:</td>
				<td><input type="number" class="text" name="dailyGold" min="0" max="100000000" value="<?=$vars['dailyGold'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "bonusGoldWinner");?>:</td>
				<td><input type="number" class="text" name="bonusGoldWinner" min="0" max="5000000" value="<?=$vars['bonusGoldWinner'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "bonusGoldTopOff");?>:</td>
				<td><input type="number" class="text" name="bonusGoldTopOff" min="0" max="5000000" value="<?=$vars['bonusGoldTopOff'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "bonusGoldTopDef");?>:</td>
				<td><input type="number" class="text" name="bonusGoldTopDef" min="0" max="5000000" value="<?=$vars['bonusGoldTopDef'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "bonusGoldTopClimber");?>:</td>
				<td><input type="number" class="text" name="bonusGoldTopClimber" min="0" max="5000000" value="<?=$vars['bonusGoldTopClimber'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "bonusGoldTopAlliance");?>:</td>
				<td><input type="number" class="text" name="bonusGoldTopAlliance" min="0" max="5000000" value="<?=$vars['bonusGoldTopAlliance'];?>">
				</td>
			</tr>
			<tr class="hover">
				<td><?=T("Installer", "buyTroops");?>:</td>
				<td><input type="checkbox" class="text" name="buyTroops" <?=$vars['buyTroops'] == 1 ? 'checked="checked"' : '';?> value="1">
				</td>
			</tr>
		</table>
	</div>
	<br/>
	<button type="submit" value="<?=T("Installer", "install");?>" name="s1" id="s1" class="green ">
		<div class="button-container addHoverClick ">
			<div class="button-background">
				<div class="buttonStart">
					<div class="buttonEnd">
						<div class="buttonMiddle"></div>
					</div>
				</div>
			</div>
			<div class="button-content"><?=T("Installer", "install");?></div>
		</div>
	</button>
</form>