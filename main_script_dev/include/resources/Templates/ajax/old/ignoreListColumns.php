<table class="column column1">
	<tbody>
	<?php
	foreach([1, 3, 5, 7, 9, 11, 13, 15, 17, 19] as $id) {
		echo '<tr>'.$vars['ignoreList'][$id].'</tr>';
	}
	?>
	</tbody>
</table>
<table class="column column2">
	<tbody>
	<?php
	foreach([2, 4, 6, 8, 10, 12, 14, 16, 18, 20] as $id) {
		echo '<tr>'.$vars['ignoreList'][$id].'</tr>';
	}
	?>
	</tbody>
</table>