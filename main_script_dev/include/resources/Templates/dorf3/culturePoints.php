<table cellpadding="1" cellspacing="1" id="culture_points">
	<thead>
	<tr>
		<td><?=T("villageOverview", "Village"); ?></td>
		<td><?=T("villageOverview", "CPs/Day"); ?></td>
		<td><?=T("villageOverview", "Celebrations"); ?></td>
		<td><?=T("villageOverview", "Troops"); ?></td>
		<td><?=T("villageOverview", "Slots"); ?></td>
	</tr>
	</thead>
	<tbody>
	<?=$vars['content']; ?>
	<tr>
		<td colspan="5" class="empty"></td>
	</tr>
	<tr class="sum">
		<th class="vil"><?=T("villageOverview", "Sum"); ?></th>
		<td class="cps"><?=$vars['summary']['totalCP']; ?></td>
		<?php
		$vars['summary']['totalCelebrationTime'] = max($vars['summary']['totalCelebrationTime']);
		$none = $vars['summary']['totalCelebrationTime'] == 0;
		$value = $none ? '-' : appendTimer($vars['summary']['totalCelebrationTime']-time());
		?>
		<td class="cel <?=$none ? 'none' : ''; ?>"><?=$value; ?></td>
		<td class="tro"><?=array_sum($vars['summary']['units']); ?></td>
		<td class="slo">
			<?=$vars['summary']['slots']['filled']; ?>/<?=$vars['summary']['slots']['total']; ?>
		</td>
	</tr>
	</tbody>
</table>