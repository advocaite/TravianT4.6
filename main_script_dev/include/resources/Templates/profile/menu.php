<div class="contentNavi subNavi tabFavorWrapper">
	<button type="button" class="scrollFrom" disabled="disabled"></button>
    <div class="scrollingContainer">
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="spieler.php?s=1" class="tabItem <?=$vars['selectedTab'] == 1 ? 'active' : 'normal'; ?>" > 
				<?=T("Profile", "Overview");?>
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "spieler.php?s=1", "onclick": false, "enabled": true, "text": "<?=T("Profile", "Overview");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		<?php if(!$vars['banned']):?>
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="spieler.php?s=2" class="tabItem <?=$vars['selectedTab'] == 2 ? 'active' : 'normal'; ?>" > 
				<?=T("Profile", "Edit Profile");?>
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "spieler.php?s=2", "onclick": false, "enabled": true, "text": "<?=T("Profile", "Edit Profile");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		<?php else:?><?php endif;?>
	</div>
	<button type="button" class="scrollTo" disabled="disabled"></button>
</div>