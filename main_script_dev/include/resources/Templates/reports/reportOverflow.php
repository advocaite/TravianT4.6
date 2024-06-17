<!--<br>-->
<!--<table id="inbox-size-table">-->
<!--	<thead>-->
<!--	<tr>-->
<!--		<td>--><?//=T("Reports", "Inbox - All reports older than seven days will be deleted");?><!--</td>-->
<!--	</tr>-->
<!--	</thead>-->
<!--</table>-->
<?php
/*
<table id="inbox-size-table">
	<thead>
	<tr>
		<td colspan="2"><?=T('Reports', 'Inbox size'); ?></td>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?=sprintf(T('Reports', "Overflowing reports will be deleted automatically, if they are older than %s hours"), Config::getInstance()->settings->reports->interval); ?></td>
		<td>
			(<?=number_format($vars['count'], 0, ',', ',').'/'.number_format(Config::getInstance()->settings->reports->size, 0, ',', ','); ?>
			)
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div id="inbox-size-bar">
				<div
					style="width:<?=min(round($vars['count'] / Config::getInstance()->settings->reports->size * 100, 2), 100); ?>%">
					&nbsp;</div>
			</div>
		</td>
	</tr>
	</tbody>
</table>*/
?>