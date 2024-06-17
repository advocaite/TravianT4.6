<div id="tileDetails" class="village village-<?=$vars['fieldType']; ?>">
	<?php
	if($vars['ajaxRequest']):
		?>
        <h1>
            <?=T("Global", "Abandoned valley"); ?>‎
            ‎‭<span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭<?=$vars['x']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY">‭<?=$vars['y']; ?>)</span></span>‬‎
            <span class="clear">&nbsp;</span>
        </h1>
		<?php
	endif;
	?>
	<div class="detailImage">
		<div class="options">
			<?=$vars['options']; ?>
		</div>
	</div>

	<div id="map_details">
		<h4><?=T("map", "distribution"); ?></h4>
		<table cellpadding="1" cellspacing="1" id="distribution" class="transparent">
			<tbody>
			<?=$vars['distribution']; ?>
			</tbody>
		</table>
        <h4><?=T("map", "Other Information");?></h4>
        <table cellpadding="1" cellspacing="1" class="transparent">
            <tbody>
            <tr>
                <td class="desc">
                    <?=T("map", "Distance");?>			</td>
                <td class="bold">
                    <?=$vars['distance'];?> <?=T("map", "fields");?>			</td>
            </tr>
            </tbody>
        </table>
	</div>
	<div class="clear"></div>
</div>
