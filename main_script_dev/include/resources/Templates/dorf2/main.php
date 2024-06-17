<div id="villageContent">
	<?php 
		require SVG_BUILDING_TEMPLATES;
	?>
	<?php foreach ($vars['maps'] as $index => $map):++$index; ?>
	<?php if($map['index'] == 40):?>
		<?php if($map['item_id'] == 0):?>
			<div class="buildingSlot a<?=$map['index'];?> g<?=$map['item_id'];?> <?=$vars['raceName']; ?>" data-aid="<?=$map['index'];?>" data-gid="<?=$map['item_id'];?>" data-building-id="2504<?=$map['index'];?>" title="<?=$map['title'];?>">
				<a href="/build.php?id=40" class="emptyBuildingSlot"></a>
				<?php if (isset($buildingField['g00'])) {?>
					<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape emptyWall">
					  <path d="<?=$buildingField['g00'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path>
					</svg>
				<?php } ?>
			</div>
		<?php else:?>
			<div class="buildingSlot bottom a<?=$map['index'];?> g<?=$map['item_id'];?> <?=$vars['raceName']; ?>" data-aid="<?=$map['index'];?>" data-gid="<?=$map['item_id'];?>" data-building-id="2504<?=$map['index'];?>" >
				<div class="level <?=$map['levelColor'];?> <?=$vars['raceName']; ?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'">
					<?php if($map['showColored']):?>
						<div class="labelLayer"><?=$map['level'];?></div>
					<?php else:?>
						<?=$map['level'];?>
					<?php endif;?>
				</div>
				<img src="img/x.gif" class="wall g<?=$map['item_id'];?>Bottom <?=$vars['raceName']; ?>" alt="" title="<?=$map['title'];?>">
				<?php if (isset($buildingField['g'.$map['item_id']]['bottom'])) {?>
					<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape g<?=$map['item_id'];?>Bottom">
					  <g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id']]['bottom'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
					</svg>
				<?php } ?>
			</div>
			<div class="buildingSlot a<?=$map['index'];?> g<?=$map['item_id'];?> top <?=$vars['raceName']; ?>" data-aid="<?=$map['index'];?>" data-gid="<?=$map['item_id'];?>" data-building-id="2504<?=$map['index'];?>" title="<?=$map['title'];?>">
				<div class="level <?=$map['levelColor'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'">
					<?php if($map['showColored']):?>
						<div class="labelLayer"><?=$map['level'];?></div>
					<?php else:?>
						<?=$map['level'];?>
					<?php endif;?>
				</div>
				<img src="img/x.gif" class="wall g<?=$map['item_id'];?>Top <?=$vars['raceName']; ?>" alt="">
				<?php if (isset($buildingField['g'.$map['item_id']]['top'])) {?>
					<svg width="794" height="540" viewBox="0 0 794 540" class="buildingShape g<?=$map['item_id'];?>Top">
					  <g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id']]['top'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
					</svg>
				<?php } ?>
			</div>
		<?php endif;?>
	<?php else:?>
	<div class="buildingSlot a<?=$map['index'];?> g<?=$map['item_id'];?> aid<?=$map['index'];?> <?=$vars['raceName']; ?>" data-aid="<?=$map['index'];?>" data-gid="<?=$map['item_id'];?>" data-building-id="2504<?=$map['index'];?>" title="<?=$map['title'];?>">
		<?php if($map['item_id'] > 0):?>
			<div class="level <?=$map['levelColor'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'">
				<?php if($map['showColored']):?>
					<div class="labelLayer"><?=$map['level'];?></div>
				<?php else:?>
					<?=$map['level'];?>
				<?php endif;?>
			</div>
		<?php endif;?>
		<img src="img/x.gif" class="building iso <?=$map['class'];?> <?=$vars['raceName']; ?>" alt="">
		<?php if($map['item_id'] == 0):?>
			<a href="/build.php?id=<?=$map['index'];?>" class="emptyBuildingSlot"></a>
			<?php if($map['index'] == 39):?>
				<svg width="120" height="180" viewBox="0 0 120 180" class="buildingShape g16e">
					<path d="<?=$buildingField['g16e'];?>" fill="#606060" onclick="window.location.href='build.php?id=<?= $map['index']; ?>'"><title><?=$map['title'];?></title></path>
				</svg>
			<?php else:?>
				<svg width="120" height="120" viewBox="0 0 120 120" class="buildingShape iso">
					<path d="<?=$buildingField['g0'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?>'"><title><?=$map['title'];?></title></path>
				</svg>
			<?php endif;?>
		<?php elseif($map['item_id'] == 16):?>
			<?php if($vars['isWW']):?>
				<?php if (isset($buildingField['g'.$map['item_id'].'_ww'])) {?>
					<svg width="125" height="160" viewBox="0 0 125 160" class="buildingShape g16_ww">
					  <g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'].'_ww'];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
					</svg>
				<?php } ?>
			<?php else:?>
				<?php if (isset($buildingField[$vars['race']]['g'.$map['item_id']])) {?>
					<svg width="125" height="160" viewBox="0 0 125 160" class="buildingShape g<?=$map['item_id'];?>">
					  <g class="highlightShape"><path d="<?=$buildingField[$vars['race']]['g'.$map['item_id']];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
					</svg>
				<?php } ?>
			<?php endif;?>
			
		
		<?php elseif($map['item_id'] == 40):?>
			<?php if($map['level'] >= 0 && $map['level'] <= 19):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_0">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][0]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php elseif($map['level'] >= 20 && $map['level'] <= 39):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_1">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][1]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php elseif($map['level'] >= 40 && $map['level'] <= 59):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_2">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][2]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php elseif($map['level'] >= 60 && $map['level'] <= 79):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_3">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][3]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php elseif($map['level'] >= 80 && $map['level'] <= 89):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_4">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][4]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php elseif($map['level'] >= 90):?>
			<svg width="298" height="318" viewBox="0 0 298 318" class="buildingShape g40_5">
				<g class="highlightShape"><path d="<?=$buildingField['g'.$map['item_id'][5]];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
			</svg>
			<?php endif;?>
		<?php else:?>
			<?php if (isset($buildingField[$vars['race']]['g'.$map['item_id']])) {?>
				<svg width="120" height="120" viewBox="0 0 120 120" class="buildingShape g<?=$map['item_id'];?>">
				  <g class="highlightShape"><path d="<?=$buildingField[$vars['race']]['g'.$map['item_id']];?>" onclick="window.location.href='build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>'"><title><?=$map['title'];?></title></path></g>
				</svg>
			<?php } ?>
		<?php endif;?>
	</div>
	<?php endif;?>
	<?php endforeach; ?>
	<button id="levelSwitch" class="<?= $vars['levelsActive'] ? "plus" : "minus"; ?>" onclick="Travian.Game.Village.toggleBuildingLevels(); return false;">
		<svg class="plusMinusToggle" viewBox="0 0 15 15">
			<path d="M0 5L0 10L15 10L15 5Z"></path>
		</svg>
	</button>
</div>
<script type="text/javascript">
    jQuery(function() {
        Travian.Game.Village.initializeWallStates();
    });
</script>
<?php if (false): ?>
    <img class="rocket rocket_tur" src="img/x.gif" alt="">
    <img class="rocket rocket_yell" src="img/x.gif" alt="">
    <img class="rocket rocket_oran" src="img/x.gif" alt="">
    <img class="rocket rocket_green" src="img/x.gif" alt="">
    <img class="rocket rocket_red" src="img/x.gif" alt="">
<?php endif; ?>
<div class="clear">&nbsp;</div>
<?= $vars['onLoadBuildings']; ?>