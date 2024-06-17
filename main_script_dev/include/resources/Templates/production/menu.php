

<div class="contentNavi subNavi tabFavorWrapper">
	<button type="button" class="scrollFrom" disabled="disabled"></button>
    <div class="scrollingContainer">
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="production.php?t=1" class="tabItem <?=$vars['tabIndex'] == 1  ? 'active' : 'normal'; ?>"> 
				<?=T("inGame", "resources.r1"); ?>
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['tabIndex'] == 1 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "production.php?t=1",
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("inGame", "resources.r1");?>	",
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="production.php?t=2" class="tabItem <?=$vars['tabIndex'] == 2  ? 'active' : 'normal'; ?>"> 
				<?=T("inGame", "resources.r2"); ?>
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['tabIndex'] == 2 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "production.php?t=2",
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("inGame", "resources.r2");?>	",
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="production.php?t=3" class="tabItem <?=$vars['tabIndex'] == 3  ? 'active' : 'normal'; ?>"> 
				<?=T("inGame", "resources.r3"); ?>
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['tabIndex'] == 3 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "production.php?t=3",
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("inGame", "resources.r3");?>	",
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="production.php?t=4" class="tabItem <?=$vars['tabIndex'] == 4  ? 'active' : 'normal'; ?>"> 
				<?=T("inGame", "resources.r4"); ?>
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['tabIndex'] == 4 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "production.php?t=4",
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("inGame", "resources.r4");?>	",
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		<div class="content" > 
			<a id="<?=$button_id = get_button_id();?>" href="production.php?t=5" class="tabItem <?=$vars['tabIndex'] == 5  ? 'active' : 'normal'; ?>"> 
				<?=T("productionOverview", "balance"); ?>   
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['tabIndex'] == 5 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "production.php?t=5",
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("productionOverview", "balance"); ?>   ",
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
	</div>
	<button type="button" class="scrollTo" disabled="disabled"></button>
</div>