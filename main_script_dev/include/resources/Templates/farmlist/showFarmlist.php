<div id="list<?php
use Core\Session;
use Core\Config;
echo $vars['lid']; ?>" class="listEntry">
	<?php if(getCustom("autoRaidEnabled")):?>
	<script type="text/javascript">
		function toggleAutoRaid(lid, box){
			Travian.ajax({
				data: {
					cmd: "toggleAutoRaid",
					lid: lid
				},
				onSuccess: function (a) {
					selectItemByValue(box, a.result);
					window.location.reload();
				},
				onFailure: function (e){
					selectItemByValue(box.selectedIndex == 0 ? 1 : 0);
					window.location.reload();
				}
			})
		}
		function selectItemByValue(elmnt, value){
			for(var i=0; i < elmnt.options.length; i++)
			{
				if(elmnt.options[i].value === value) {
					elmnt.selectedIndex = i;
					break;
				}
			}
		}
	</script>
	<?php endif;?>
	<form action="build.php?gid=16&amp;tt=99" method="post">
		<input type="hidden" name="action" value="startRaid"/>
		<input type="hidden" name="a"
			   value="<?=Session::getInstance()->getChecker(); ?>"/>
		<input type="hidden" name="sort" value="distance"/>
		<input type="hidden" name="direction" value="asc"/>
		<input type="hidden" name="lid" value="<?=$vars['lid']; ?>"/>
		<a name="did<?=$vars['kid']; ?>"></a>
		<div class="round  listTitle">
			<div class="raidListTitleButtons">
				<button type="button" id="deleteRaidList" class="icon "
                        onclick="return (function() {
				(new Travian.Dialog.Dialog({
				    preventFormSubmit: true,
					onOkay: function(dialog, contentElement) {window.location.href = 'build.php?gid=16&amp;tt=99&amp;action=deleteList&amp;lid=<?=$vars['lid']; ?>'}}))
                .setContent('<?=T("FarmList", "reallyDelete");?>')
                .show();
				return false;
			})()"><img src="img/x.gif" class="raidList delete"  alt="raidList delete"></button>
				<button type="button" id="updateRaidList" class="icon " onclick="Travian.Game.RaidList.showUpdateList(<?=$vars['lid']; ?>)"><img src="img/x.gif" class="raidList update" alt="raidList update"></button>

				<div class="raidListSwitchWrapper">
					<div class="openedClosedSwitch switchOpened" onclick="Travian.Game.RaidList.toggleList(<?=$vars['lid']; ?>);"><?=T("FarmList", "details"); ?></div>
				</div>

				<?php if($vars['auto'] == 0 && getDisplay("farmListHelperIconActions")):?>
				<button type="button" style="margin-top: -4px; float: <?=(getDirection() == 'RTL' ? 'left' : 'right');?>;" class="icon" onclick="attackFarmList(<?=$vars['lid']; ?>, 4, event);" title="<?=T("FarmList", "Attack_att3");?>">
					<img src="img/x.gif" style="margin-<?=(getDirection() == 'LTR' ? 'left' : 'right');?>: 3px;" class="att3"/>
				</button>
				<button type="button" style="margin-top: -4px; float: <?=(getDirection() == 'RTL' ? 'left' : 'right');?>;" class="icon" onclick="attackFarmList(<?=$vars['lid']; ?>, 3, event);" title="<?=T("FarmList", "Attack_iReport3");?>">
					<img src="img/x.gif" style="margin-<?=(getDirection() == 'LTR' ? 'left' : 'right');?>: 3px;" class="iReport iReport2"/>
				</button>
				<button type="button" style="margin-top: -4px; float: <?=(getDirection() == 'RTL' ? 'left' : 'right');?>;" class="icon" onclick="attackFarmList(<?=$vars['lid']; ?>, 2, event);" title="<?=T("FarmList", "Attack_iReport2");?>">
					<img src="img/x.gif" style="margin-<?=(getDirection() == 'LTR' ? 'left' : 'right');?>: 3px;" class="iReport iReport1"/>
				</button>
				<button type="button" style="margin-top: -4px; float: <?=(getDirection() == 'RTL' ? 'left' : 'right');?>;" class="icon" onclick="attackFarmList(<?=$vars['lid']; ?>, 1, event);" title="<?=T("FarmList", "Attack_iReport1");?>">
					<img src="img/x.gif" style="margin-<?=(getDirection() == 'LTR' ? 'left' : 'right');?>: 3px;" class="att_all"/>
				</button>
				<?php endif;?>

				<span class="raidListSlotCount"><?=$vars['numSlots']; ?>/‭‭100‬‬‬‎</span>
			</div>
			<div class="listTitleText">
				<?php if(getCustom("autoRaidEnabled")):?>
				<select onchange="toggleAutoRaid(<?=$vars['lid'];?>, this);">
					<option value="1" <?=($vars['auto'] == 0 ? '' : 'selected');?>><?=T("FarmList", "Auto raid On");?></option>
					<option value="0" <?=($vars['auto'] == 1 ? '' : 'selected');?>><?=T("FarmList", "Auto raid Off");?></option>
				</select>
				<?php endif;?>
				<?=$vars['name'];?>
				<img alt="Loading..." class="loading hide" src="img/x.gif">
			</div>
			<div class="clear"></div>
		</div>
		<?php
		$hide = $vars['hide'];
		?>
		<div class="listContent <?=$hide ? 'hide' : ''; ?>">
			<?php if(!$hide): ?>
				<div class="detail">
					<table class="list" cellpadding="1" cellspacing="1">
						<thead>
						<tr>
							<?=($vars['auto'] == 0 ? '<td class="checkbox edit"></td>' : '');?>
							<td class="village sortable"
								onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'village');"><?=T("FarmList", "Village"); ?></td>
							<td class="ew sortable"
								onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'ew');"><?=T("FarmList", "pop"); ?>
								.
							</td>
							<td class="distance sortable"
								onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'distance');"><?=T("FarmList", "distance"); ?></td>
							<td class="troops sortable"
								onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'troops');"><?=T("FarmList", "troops"); ?></td>
							<td class="lastRaid sortable"
								onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'lastRaid');"><?=T("FarmList", "lastRaid"); ?></td>
							<td class="action"></td>
						</tr>
						</thead>
						<tbody>
						<?php
						if($vars['numSlots'] == 0) {
							echo '<tr class="slotRow">
		<td class="noData" colspan="'.($vars['auto'] == 0 ? 7 : 6).'">
			'.T("FarmList", "noSlot").'		</td>
	</tr>';
						} else {
							echo $vars['slots'];
						}
						?>
						</tbody>
					</table>
					<?php if($vars['auto'] == 0):?>
					<div class="markAll">
						<input type="checkbox"
							   id="raidListMarkAll<?=$vars['lid']; ?>"
							   class="markAll check"
							   onclick="Travian.Game.RaidList.markAllSlotsOfAListForRaid(<?=$vars['lid']; ?>, this.checked);"/>
						<label
								for="raidListMarkAll<?=$vars['lid']; ?>"><?=T("FarmList", "checkAll"); ?></label>
					</div>
					<?php endif;?>

					<div class="addSlot">
						<?php
						echo getButton(["type"    => "button", "value" => "add",
								"class"   => 'green ',
								'onclick' => "Travian.Game.RaidList.addSlot({$vars['lid']},'','','rallyPoint');",
						], [], T("FarmList", "add"));
						if(getDisplay("displayFarmlistEditAll")) {
                            echo getButton([
                                "type" => "button", "value" => "edit", "class" => 'green ',
                                'onclick' => "editFarmList({$vars['lid']});",
                            ], [], T("FarmList", "editAllSlotsRaid"));
                        }
						?>
						<span class="raidListSlotCount"><?=$vars['numSlots'];?>/100</span>
					</div>
				</div>
				<div class="clear"></div>

				<div class="troopSelection">
					<?php
					for($i = 1; $i <= 10; ++$i) {
						$unitId = nrToUnitId($i, Session::getInstance()->getRace());
						echo '<span class="troopSelectionUnit">';
						echo '<img class="unit u'.$unitId.'" title="'.T("Troops", "$unitId.title").'" alt="'.T("Troops", "$unitId.title").'" src="img/x.gif" />';
						echo '<span class="troopSelectionValue">0</span>';
						echo '</span>';
					}
					?>
					<div class="clear"></div>
				</div>
				<?php
				if($vars['numSlots'] && $vars['numRaids'] > -1) {
					echo '<p>'.sprintf(T("FarmList", "nRaidsMade"), $vars['numRaids']).'</p>';
				}
				if($vars['err'] === true) {
					echo '<p style="color: red;">'.T("FarmList", "System: You must wait some time before sending another raid").'</p>';
				} else if(isset($vars['err2']) && $vars['err2']){
                    echo '<p style="color: red;">Maximum raid limit reached.</p>';
                }
				if($vars['auto'] == 0) {
					echo getButton(["type" => "submit", "value" => "start raid", "class" => 'green ', "onclick" => "return f3321bf4b28aad28366b5d58a9e532b849088a512(event);",], [], T("FarmList", "startRaid"));
				}
				?>
				<br/>
				<br/>
			<?php endif; ?>
		</div>
	</form>
</div>