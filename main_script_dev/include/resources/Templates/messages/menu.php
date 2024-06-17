<a type="button" title="<?=T("inGame", "Select this tab as fav");?>" id="tabFavorButton" class="icon contentTitleButton  buttonFramed green withIcon rectangle" 
onclick="Travian.api('favourite-tab', {data: {name: 'messages',number: '<?=$vars['selectedTab'];?>'},success: function(data) {if (data.success) { jQuery('.favor').removeClass('favorActive');jQuery('.favor.favorKey<?=$vars['selectedTab'];?>').addClass('favorActive');}}});return false;" useicon="">
<img src="/img/x.gif" class="&nbsp;" alt="" data-cmp-info="9"></a>

<div class="contentNavi subNavi tabFavorWrapper">
	<button type="button" class="scrollFrom" disabled="disabled"></button>
    <div class="scrollingContainer">
		<div class="content favor <?=$vars['favorTabId']==0 ? "favorActive" : ''; ?> favorKey0" > 
			<a id="<?=$button_id = get_button_id();?>" href="messages.php?t=0" class="tabItem <?=$vars['selectedTab'] == 0  ? 'active' : 'normal'; ?>"> 
				<?=T("Messages", "Inbox");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>"/> 
			</a> 
		</div>
		<script type="text/javascript">
		if (jQuery('#<?=$button_id;?>')){
			jQuery('#<?=$button_id;?>').click(
				function (event){
					jQuery(window).trigger('tabClicked', [this,{
						"class": "<?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>", 
						"title": false, 
						"target": false, 
						"id": "<?=$button_id;?>", 
						"href": "messages.php?t=0", 
						"onclick": false, 
						"enabled": true, 
						"text": "<?=T("Messages", "Inbox");?>", 
						"dialog": false, 
						"plusDialog": false, 
						"goldclubDialog": false, 
						"containerId": "", 
						"buttonIdentifier": "<?=$button_id;?>"
						}]);
					});
				}
		</script>
		
		<div class="content favor <?=$vars['favorTabId']==1 ? "favorActive" : ''; ?> favorKey1" > 
			<a id="<?=$button_id = get_button_id();?>" href="messages.php?t=1" class="tabItem <?=$vars['selectedTab'] == 1 ? 'active' : 'normal'; ?>" > 
				<?=T("Messages", "Write");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "messages.php?t=1", "onclick": false, "enabled": true, "text": "<?=T("Messages", "Write");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==2 ? "favorActive" : ''; ?> favorKey2" > 
			<a id="<?=$button_id = get_button_id();?>" href="messages.php?t=2" class="tabItem <?=$vars['selectedTab'] == 2 ? 'active' : 'normal'; ?>" > 
				<?=T("Messages", "Sent");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "messages.php?t=2", "onclick": false, "enabled": true, "text": "<?=T("Messages", "Sent");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		<div class="content favor <?=$vars['favorTabId']==3 ? "favorActive" : ''; ?> favorKey3"> 
			<a id="<?=$button_id = get_button_id();?>" href="<?=$vars['goldClub'] ? 'messages.php?t=3' : '#';?>" class="tabItem <?=$vars['goldClub'] ? '' : 'gold';?> <?=$vars['selectedTab'] == 3 ? 'active' : 'normal'; ?>" > 
				<?=T("Messages", "Archive");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<?php if($vars['goldClub']):?>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 3 ? 'active' : 'normal';?>", "title": "<?=T("Messages", "Archive");?>", "target": false, "id": "<?=$button_id;?>", "href": "messages.php?t=3", "onclick": false, "enabled": true, "text": "<?=T("Reports", "Tabs.Archive");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		<?php else:?>
		<script type="text/javascript">
		jQuery(function() {
		if (jQuery('#<?=$button_id;?>').length > 0){
			jQuery('#<?=$button_id;?>').on('click', function (){jQuery(window).trigger('tabClicked', [this,{
			"class": "gold normal", 
			"title": "<?=$vars['ArchiveGoldClubTitle'];?>", 
			"target": false, 
			"id": "<?=$button_id;?>", 
			"href": "#", 
			"onclick": false, 
			"enabled": true, 
			"text": "<?=T("Messages", "Archive");?>", 
			"dialog": false, 
			"plusDialog": false, 
			"goldclubDialog": {
				"featureKey": "messageArchive",
				"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer",
				"cssClass":"premiumFeaturePackage premiumFeatureGoldclub paymentShopV4",
				"premiumFeatureDialogVersion":2,
				"version":2,
				"paymentShopVersion":4}, 
			"containerId": "", 
			"buttonIdentifier": "<?=$button_id;?>"}]);});}
		});</script> 
		<?php endif;?>
		
		<div class="content favor <?=$vars['favorTabId']==4 ? "favorActive" : ''; ?> favorKey4" > 
			<a id="<?=$button_id = get_button_id();?>" href="messages.php?t=4" class="tabItem <?=$vars['selectedTab'] == 4 ? 'active' : 'normal'; ?>" > 
				<?=T("Messages", "Notes");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 4 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "messages.php?t=4", "onclick": false, "enabled": true, "text": "<?=T("Messages", "Notes");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
		
		<div class="content favor <?=$vars['favorTabId']==5 ? "favorActive" : ''; ?> favorKey6" > 
			<a id="<?=$button_id = get_button_id();?>" href="messages.php?t=5" class="tabItem <?=$vars['selectedTab'] == 5 ? 'active' : 'normal'; ?>" > 
				<?=T("Messages", "Ignored players");?>
				<img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/> 
			</a> 
		</div>
		<script type="text/javascript">if (jQuery('#<?=$button_id;?>')){jQuery('#<?=$button_id;?>').click(function (event){jQuery(window).trigger('tabClicked', [this,{"class": "<?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>", "title": false, "target": false, "id": "<?=$button_id;?>", "href": "messages.php?t=5", "onclick": false, "enabled": true, "text": "<?=T("Messages", "Ignored players");?>", "dialog": false, "plusDialog": false, "goldclubDialog": false, "containerId": "", "buttonIdentifier": "<?=$button_id;?>"}]);});}</script> 
		
	</div>
	<button type="button" class="scrollTo" disabled="disabled"></button>
</div>

<script type="text/javascript" data-cmp-info="6">
	jQuery(function() {
		Travian.Game.TabScrollNavigation();
	});
</script>
<script data-cmp-info="6">
	function messagesFormSelectAll(checkbox) {
		jQuery('#messagesForm').find('input[type=checkbox]').each(function (_, element) {
			element.checked = checkbox.checked;
		}, checkbox);
	}
</script>