<?php if($vars['numIncomingTroops'] > 0 || $vars['numOutGoingTroops'] > 0):?>
<div class="villageInfobox movements">
	<div class="movements">
		<table id="movements" cellpadding="1" cellspacing="1">
			<?php if($vars['numIncomingTroops'] > 0):?>
				<tr>
					<th class="troopMovements header" colspan="3"><?=T("Dorf1", "movements.incoming");?>:</th>
				</tr>
				<?=$vars['inComingContent'];?>
			<?php endif;?>
			<?php if($vars['numOutGoingTroops'] > 0):?>
				<tr>
					<th class="troopMovements header" colspan="3"><?=T("Dorf1", "movements.outgoing");?>:</th>
				</tr>
				<?=$vars['outGoingContent'];?>
			<?php endif;?>
		</table>
	</div>
</div>
<?php endif;?>