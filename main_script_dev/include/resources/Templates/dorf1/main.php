<div id="resourceFieldContainer" class="resourceField<?=$vars['fieldType']; ?> tribe<?=$vars['race']; ?>">
	<?php 
		use Core\Session;
		require SVG_FIELD_TEMPLATES;
	?>
    <?php foreach ($vars['areas'] as $index=>$area): ?>
        <?php $area['title'] = htmlspecialchars($area['title']); ?>
        <?php $area['alt'] = htmlspecialchars($area['alt']); ?>
        <?php $map = $vars['maps'][$index]; ?>
        <?php $map_index = $index +1; ?>
		<a href="/build.php?id=<?=$map_index; ?><?= Session::getInstance()->fastUpgradeActive() ? '&fastUP=1' : null; ?>" 
			class="<?=$map['color']; ?> level colorLayer gid<?=$map['item_id']; ?> buildingSlot<?=$map_index; ?>  level<?=$map['level']; ?> <?=$map['upgradeState'] ? ('aid' . $map_index . ' underConstruction') : 'aid' . ($map_index); ?>">
			<div class="labelLayer"><?=$map['level']; ?></div>
		</a>
    <?php endforeach; ?>
	<a href="/dorf2.php" class="villageCenter" title="<?=T("inGame", "Navigation.Buildings"); ?>"></a>
	<?php if (isset($resourceField['resourceField'.$vars['fieldType']]['fields'])) {?>
		<svg class="resourceField resourceField<?=$vars['fieldType']; ?>" viewBox="0 0 473 304">
		  <?=$resourceField['resourceField'.$vars['fieldType']]['fields'];?>
		</svg>
	  <?php } ?>
	<svg class="villageCenter" viewBox="0 0 473 304">
		<?=$resourceField['villageCenter']; ?>
	</svg>
</div>
<div class="villageInfoWrapper">
	<?=$vars['onLoadBuildings']; ?>
	<?=$vars['movements']; ?>
	<div class="villageInfobox production">
	   <table id="production" cellpadding="1" cellspacing="1">
		  <thead>
			 <tr>
				<th colspan="4"><?=T("Dorf1", "production.production per hour"); ?>:</th>
			 </tr>
		  </thead>
		  <tbody>
			 <tr>
				<td class="ico">
				   <div> <i class="r1"></i><?php if ($vars['productionBoost'][0]): ?><img src="/img/x.gif" class="productionBoost" alt="Production bonus for lumber" data-cmp-info="9"><?php endif; ?></div>
				</td>
				<td class="res"> <?=T("Dorf1", "production.resources.1"); ?>: </td>
				<td class="num"> ‭<?=number_format_x($vars['production'][0], 1e12); ?>‬ </td>
			 </tr>
			 <tr>
				<td class="ico">
				   <div> <i class="r2"></i><?php if ($vars['productionBoost'][1]): ?><img src="/img/x.gif" class="productionBoost" alt="Production bonus for clay" data-cmp-info="9"><?php endif; ?></div>
				</td>
				<td class="res"> <?=T("Dorf1", "production.resources.2"); ?>: </td>
				<td class="num"> ‭<?=number_format_x($vars['production'][1], 1e12); ?>‬ </td>
			 </tr>
			 <tr>
				<td class="ico">
				   <div> <i class="r3"></i><?php if ($vars['productionBoost'][2]): ?><img src="/img/x.gif" class="productionBoost" alt="Production bonus for iron" data-cmp-info="9"><?php endif; ?></div>
				</td>
				<td class="res"> <?=T("Dorf1", "production.resources.2"); ?>: </td>
				<td class="num"> ‭<?=number_format_x($vars['production'][2], 1e12); ?>‬ </td>
			 </tr>
			 <tr>
				<td class="ico">
				   <div> <i class="r4"></i><?php if ($vars['productionBoost'][3]): ?><img src="/img/x.gif" class="productionBoost" alt="Production bonus for crop" data-cmp-info="9"><?php endif; ?></div>
				</td>
				<td class="res"> <?=T("Dorf1", "production.resources.4"); ?>: </td>
				<td class="num"> ‭<?=number_format_x($vars['production'][3], 1e12); ?>‬ </td>
			 </tr>
		  </tbody>
	   </table>
	   <div>
		  <?=$vars['goldProductionBoostButton']; ?>
	   </div>
	</div>
	<script type="text/javascript" data-cmp-info="6">
		jQuery(function () {
			jQuery('input#showTroopsToggleMobile').on('change', function () {
				Travian.Game.Village.toggleMobileUnitDisplay();
			});
		});
	</script>
	<div class="villageInfobox units">
	   <table id="troops" cellpadding="1" cellspacing="1">
		  <thead>
			 <tr>
				<th colspan="3"><?=T("Dorf1", "units"); ?>:</th>
			 </tr>
		  </thead>
		  <tbody>
			 <?php if ($vars['unitsSummary'] <= 0): ?>
                    <tr>
                        <td><?=T("Dorf1", "none"); ?>.</td>
                    </tr>
			 <?php else: ?>
				<?php foreach ($vars['units'] as $key => $num): ?>
					<tr>
						<td class="ico">
							<a href="build.php?gid=16&tt=1#td">
								<img class="unit u<?=$key == 98 ? 'hero' : $key; ?>" src="img/x.gif"
									 alt="<?=T("Troops", ($key == 98 ? 'hero' : $key) . '.title'); ?>">
							</a>
						</td>
						<td class="num"><?=number_format_x($num, 1e12); ?></td>
						<td class="un"><?=T("Troops", ($key == 98 ? 'hero' : $key) . '.title'); ?></td>
					</tr>
				<?php endforeach; ?>
				<?php if ($vars['heroOnly']): ?>
					<tr>
						<td><?=T("Dorf1", "none"); ?>.</td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>
		  </tbody>
	   </table>
	</div>
</div>