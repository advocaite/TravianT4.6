<table cellpadding="1" cellspacing="1" id="warehouse">
	<thead>
	<tr>
		<td><?=T('villageOverview', 'Village'); ?></td>
        <td><i class="r1"></i></td>
        <td><i class="r2"></i></td>
        <td><i class="r3"></i></td>
		<td><img class="clock" src="img/x.gif"
		         title="<?=T("villageOverview", "duration"); ?>"
		         alt="<?=T("villageOverview", "duration"); ?>"/></td>
        <td><i class="r4"></i></td>
        <td><img class="clock" src="img/x.gif"
		         title="<?=T("villageOverview", "duration"); ?>"
		         alt="<?=T("villageOverview", "duration"); ?>"/></td>
	</tr>
	</thead>
	<tbody>
	<?=$vars['content']; ?>
	</tbody>
</table>