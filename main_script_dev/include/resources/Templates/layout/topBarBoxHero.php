<?php
use Game\Hero\SessionHero;
use Controller\Hero_imageCtrl;
?>

<div id="topBarHero">
	<svg class="health" viewBox="0 0 110 110">
		<defs>
			<clipPath id="healthMask" maskContentUnits="objectBoundingBox">
				<path d="M55 55L47.35 109.46A 55 55 0 0 0 109.99 54.1" fill="white"></path>
			</clipPath>
		</defs>
		
		<!-- last two parameters give correct effect -->
		<path class="title" d="M55 55L47.35 109.46A 55 55 0 0 0 109.87 51.16" fill="transparent"></path>
	</svg>
	<script type="text/javascript" data-cmp-info="6">
	jQuery(function() {
		Travian.Game.Layout.updateHeroExperienceBar({mask:20, title:'<?=$vars['exp']; ?>'}, "<?=T("HeroGlobal", "Experience"); ?>: <?=$vars['exp']; ?>");
	});
	</script>
	<svg class="experience" viewBox="0 0 110 110">
		<defs>
			<clipPath id="experienceMask" maskContentUnits="objectBoundingBox">
				<path d="M55 55L32.63 105.25A 55 55 0 0 1 <?=(100-$vars['expPercent']); ?> 36.26" fill="white"></path>
			</clipPath>
		</defs>
		
		<!-- last two parameters give correct effect -->
		<path class="title" d="M55 55L32.63 105.25A 55 55 0 0 1 4 34.4" fill="transparent"></path>
	</svg>
	<a id="heroImageButton" href="hero.php<?=$vars['hasNewPoints'] ? "?flagAttributesBoxOpen" : ''; ?>" class="heroImageButton" type="button" title="<?=T("HeroGlobal","HeroOverview"); ?>||<?=htmlspecialchars($vars['longStatus']); ?>">
        <div class="heroImageHover">  
			<img class="heroImage" src="hero_image.php?size=sideinfo&amp;uuu=<?=$vars['uid']; ?>&amp;hairColor=<?=$vars['hairColor'];?>&amp;gender=<?=$vars['gender'];?>&amp;size=<?='medium'?>&amp;beard=<?=$vars['beard']; ?>&amp;jaw=<?=$vars['headProfile']; ?>&amp;hairStyle=<?=$vars['hairStyle']; ?>&amp;nose=<?=$vars['nose']; ?>&amp;mouth=<?=$vars['mouth']; ?>&amp;eyes=<?=$vars['eyes']; ?>&amp;ears=<?=$vars['ears']; ?>&amp;brows=<?=$vars['eyebrow']; ?>&amp;" title="Hero" alt="Hero" data-cmp-info="9">
</div>
	</a>
	
	<!-- <a id="heroImageButton" href="hero.php<//?=$vars['hasNewPoints'] ? "?flagAttributesBoxOpen" : ''; ?>" class="heroImageButton" type="button" title="<//?=T("HeroGlobal","HeroOverview"); ?>||<//?=htmlspecialchars($vars['longStatus']); ?>">
        <div class="heroImageHover">
			
		<img class="heroImage" src="hero_head.php?uid=<//?=$vars['uid']; ?>&amp;size=sideinfo&amp;<//?=$vars['heroImageHash']; ?>" title="Hero" alt="Hero" data-cmp-info="9"></div>
		</div>
	</a> -->
	<div class="heroStatus">
		<a href="" title="<?=T("HeroGlobal","HeroOverview"); ?>||<?=htmlspecialchars($vars['longStatus']); ?>">
		<svg viewBox="0 0 19.08 20" class="heroRunning <?=$vars['status']; ?>"><g class="outline">
		  <path d="M18.62 18.28a1.75 1.75 0 0 0 .05-.46 2.18 2.18 0 0 0-2.18-2.18h-.23l-1.94.11-4-3V7l2.88-.11s-.33-4.26-1-5.67C10.8-.13 2.85-.59 1 1-.17 2 0 7.35 0 7.35l2-.08v5.42a4 4 0 0 0-1.42 3v1.82l-.4.3V20h18.9v-1.72z"></path>
		</g><g class="icon">
		  <path d="M18.62 18.28a1.75 1.75 0 0 0 .05-.46 2.18 2.18 0 0 0-2.18-2.18h-.23l-1.94.11-4-3V7l2.88-.11s-.33-4.26-1-5.67C10.8-.13 2.85-.59 1 1-.17 2 0 7.35 0 7.35l2-.08v5.42a4 4 0 0 0-1.42 3v1.82l-.4.3V20h18.9v-1.72z"></path>
		</g></svg>
		
		<?php /*
		todo: 
		other classes: heroHome, heroDead heroReinforcing heroTrapped heroReviving
		<svg viewBox="0 0 20 17.43" class="heroHome"><g class="outline">
		  <path d="M20 10L10 0 0 10l2.56 2.56 1.74-1.75v6.62h11.39V11l1.64 1.63zm-8.36 4.92H8.36V9.58h3.28z"></path>
		</g><g class="icon">
		  <path d="M20 10L10 0 0 10l2.56 2.56 1.74-1.75v6.62h11.39V11l1.64 1.63zm-8.36 4.92H8.36V9.58h3.28z"></path>
		</g></svg>*/?>
		</a>
	</div>
	<i class="dead <?=$vars['dead']? 'show': ''?>"></i>
	<i class="levelUp <?=$vars['lvlUp']? 'show': ''?>"></i>
	<a id="<?=$vars['auctionWhiteButton']['id'];?>" class="layoutButton buttonFramed withIcon round auction green" href="hero.php?t=4" 
		title="<?=T("HeroGlobal", "Auctions"); ?>||<?=T("HeroGlobal","Tooltip loading"); ?>">
		<svg viewBox="0 0 20.18 19.44" class="auction"><g class="outline">
		  <path d="M20 9.44l-6.14 6.16a.54.54 0 0 1-.78 0L11 13.5a.56.56 0 0 1 0-.78l1.64-1.64-.64-.64h-1.24l-7.38 8.7L0 15.76l8.67-7.41V7.13l-.57-.57-.74.75a.49.49 0 0 1-.69 0L4.19 4.83a.49.49 0 0 1 0-.69l4-4a.49.49 0 0 1 .69 0l2.45 2.45a.52.52 0 0 1 0 .74l-.45.46.65.65h3.14v3.14l.73.73 1.75-1.75a.54.54 0 0 1 .78 0L20 8.66a.54.54 0 0 1 0 .78zm-9.35 7v3h9v-3z"></path>
		</g><g class="icon">
		  <path d="M20 9.44l-6.14 6.16a.54.54 0 0 1-.78 0L11 13.5a.56.56 0 0 1 0-.78l1.64-1.64-.64-.64h-1.24l-7.38 8.7L0 15.76l8.67-7.41V7.13l-.57-.57-.74.75a.49.49 0 0 1-.69 0L4.19 4.83a.49.49 0 0 1 0-.69l4-4a.49.49 0 0 1 .69 0l2.45 2.45a.52.52 0 0 1 0 .74l-.45.46.65.65h3.14v3.14l.73.73 1.75-1.75a.54.54 0 0 1 .78 0L20 8.66a.54.54 0 0 1 0 .78zm-9.35 7v3h9v-3z"></path>
		</g></svg>
	</a>
	<script type="text/javascript" data-cmp-info="6">
		jQuery('#<?=$vars['auctionWhiteButton']['id'];?>').click(function (event) {
			jQuery(window).trigger('buttonClicked', [event.delegateTarget, {
				"type":"green",
				"loadTitle":true,
				"boxId":"hero",
				"disabled":false,
				"attention":false,
				"colorBlind":false,"class":"",
				"id":"<?=$vars['auctionWhiteButton']['id'];?>",
				"redirectUrl":"hero.php?t=4",
				"redirectUrlExternal":"",
				"svg":"topBar\/auction.svg",
				"content":"",
				"title":"Auctions||Tooltip loading..."}]);
		});
		jQuery(function() {
			jQuery('#<?=$vars['auctionWhiteButton']['id'];?>').one('mouseover', function(event) {
				Travian.Tip.load(event.delegateTarget, 'hero', {boxId: 'hero', buttonId: 'auction'});
			});
		});
	</script>
	<a id="<?=$vars['adventureWhiteButton']['id']; ?>" class="layoutButton buttonFramed withIcon round adventure green attention" href="hero.php?t=3" 
		title="<?=T("HeroGlobal", "Adventure"); ?>||<?=T("HeroGlobal","Tooltip loading"); ?>">
		<div class="content"><?=$vars['adventureWhiteButton']['adventureCount']; ?></div>
	</a>
	<script type="text/javascript" data-cmp-info="6">
		jQuery('#<?=$vars['adventureWhiteButton']['id']; ?>').click(function (event) {
			jQuery(window).trigger('buttonClicked', [event.delegateTarget, 
			{
				"type":"green",
				"loadTitle":true,
				"boxId":"hero",
				"disabled":false,
				"attention":true,
				"colorBlind":false,
				"class":"",
				"id":"<?=$vars['adventureWhiteButton']['id'];?>",
				"redirectUrl":"hero.php?t=3",
				"redirectUrlExternal":"",
				"svg":false,
				"content":"<?=$vars['adventureWhiteButton']['adventureCount'];?>",
				"title":"Adventure||Tooltip loading..."}]);
		});
		jQuery(function() {
			jQuery('#<?=$vars['adventureWhiteButton']['id'];?>').one('mouseover', function(event) {
				Travian.Tip.load(event.delegateTarget, 'hero', {boxId: 'hero', buttonId: 'adventure'});
			});
		});
	</script>
</div>