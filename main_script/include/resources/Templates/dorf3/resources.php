<table cellpadding="1" cellspacing="1" id="ressources">
	<thead>
	<tr>
		<td><?=T("villageOverview", "Village"); ?></td>
		<td><i class="r1"></i></td>
		<td><i class="r2"></i></td>
		<td><i class="r3"></i></td>
		<td><i class="r4"></i></td>
		<td><?=T("villageOverview", "Merchants"); ?></td>
	</tr>
	</thead>
	<tbody>
	<?=$vars['content']; ?>
	<tr>
		<td colspan="6" class="empty"></td>
	</tr>
	<tr class="sum">
		<th><?=T("villageOverview", "Sum"); ?></th>
		<td class="lum"><?=$vars['summary']['r1']; ?></td>
		<td class="clay"><?=$vars['summary']['r2']; ?></td>
		<td class="iron"><?=$vars['summary']['r3']; ?></td>
		<td class="crop"><?=$vars['summary']['r4']; ?></td>
		<td class="tra">
			‎&#x202d;&#x202d;&#x202d;<?=$vars['summary']['merchants_available']; ?>
			&#x202c;&#x202c;/&#x202d;&#x202d;<?=$vars['summary']['merchants_total']; ?>
			&#x202c;&#x202c;&#x202c;‎
		</td>
	</tr>
	</tbody>
</table>