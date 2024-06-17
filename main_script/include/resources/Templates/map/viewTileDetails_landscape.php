<div id="tileDetails"
     class="landscape landscape-<?=$vars['landscapeType']; ?>">
	<?php if($vars['ajaxRequest']): ?>
		<h1><?=T("map", "landscape_desc"); ?>
            ‎‭<span class="coordinates coordinatesWrapper"><span class="coordinateX">(‭<?=$vars['x']; ?></span><span class="coordinatePipe">|</span><span class="coordinateY">‭<?=$vars['y']; ?>)</span></span>‬‎
        </h1>
	<?php endif; ?>
	<div class="detailImage">
		<div class="options">
			<?=$vars['options']; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>