<div id="sidebarBoxAlliance" class="sidebarBox <?=$vars['hasNews'] ? ('toggleable ' . $vars['toggle']) : ''; ?>">
 <div class="header ">
	<div class="buttonsWrapper">
	   <?php 
            $d = [
                "class"        => "",
                "type"         => "green",
                "loadTitle"    => FALSE,
                "boxId"        => "alliance",
                "disabled"     => $vars['aid'] > 0,
                "speechBubble" => "",
				"svg"	  	   => "alliance_green",
                "redirectUrl"  => $vars['aid'] > 0 ? 'allianz.php' : '#',
            ];
            echo getAButton([
                'id'      => get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton buttonFramed withIcon round alliance green ".($vars['aid'] <= 0 ? 'disabled' : ''),
                "title"   => htmlspecialchars(T("embassyWhite","Alliance overview").'||'.($vars['aid'] <= 0 ? T("embassyWhite","You are currently not part of any alliance") : '')),
				"svg"	  => "alliance_green",
                "href"    => $vars['aid'] > 0 ? 'allianz.php' : '#',
            ], ["data" => $d]);
	   ?>
	   
	   <?php 
            $d = [
                "class"        => "",
                "type"         => "green",
                "loadTitle"    => FALSE,
                "boxId"        => "alliance",
                "disabled"     => $vars['aid'] > 0,
                "speechBubble" => "",
				"svg"	  	   => "forum_green",
                "redirectUrl"  => $vars['aid'] > 0 ? 'allianz.php?s=2' : '#',
            ];
            echo getAButton([
                'id'      => get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton buttonFramed withIcon round forum green ".($vars['aid'] <= 0 ? 'disabled' : ''),
                "title"   => htmlspecialchars(T("embassyWhite","Alliance forum").'||'.($vars['aid'] <= 0 ? T("embassyWhite","You are currently not part of any alliance") : '')),
				"svg"	  => "forum_green",
                "href"    => $vars['aid'] > 0 ? 'allianz.php?s=2' : '#',
            ], ["data" => $d]);
	   ?>
	   
	   <?php 
            $d = [
                "class"        => "",
                "type"         => "green",
                "loadTitle"    => FALSE,
                "boxId"        => "alliance",
				"buttonId"	   => "embassy",
				"loadTooltip" => "layoutButton",
                "disabled"     => $vars['noEmbassy'],
                "speechBubble" => "",
				"svg"	  	   => "embassy_green",
                "redirectUrl"  => $vars['noEmbassy'] ? '#' : $vars['link'],
            ];
            echo getAButton([
                'id'      => get_button_id(),
                "type"    => "button",
                "class"   => "layoutButton buttonFramed withIcon round embassy green" . ($vars['noEmbassy'] ? ' disabled' : ''),
                "title"   => htmlspecialchars(T("embassyWhite", "embassy").'||'.T("HeroGlobal","Tooltip loading").($vars['noEmbassy'] ? '<br /><span class="warning">' . T("embassyWhite","construct an embassy") . '</span>' : '')),
				"svg"	  => "embassy_green",
                "href"  => $vars['noEmbassy'] ? '#' : $vars['link'],
            ], ["data" => $d]);
	   ?>
	</div>
 </div>
 <div class="content">
	<div class="boxTitle">
	   <div class="name"><?=$vars['aid'] <= 0 ? T("embassyWhite", "no alliance") : $vars['allianceName']; ?></div>
	</div>
	<?=$vars['news']; ?>
	
	<?php if ($vars['hasNews']): ?>
	 <div class="toggle">
		<button type="button" class="toggleBox" onclick="" title="<?=T("HeroGlobal",$vars['toggle'] == "expanded" ? "hideInformation" : "showInformation"); ?>">
		   <svg class="toggleArrow" viewBox="0 0 18 11">
			  <filter id="insetShadow">
				 <feFlood flood-color="#a2e25e"></feFlood>
				 <feComposite in2="SourceAlpha" operator="out"></feComposite>
				 <feGaussianBlur stdDeviation="2" result="blur"></feGaussianBlur>
				 <feComposite operator="atop" in2="SourceGraphic"></feComposite>
			  </filter>
			  <path class="caret" d="M1 10H17L9 1z"></path>
			  <path class="glow" d="M1 10H17L9 1z"></path>
		   </svg>
		</button>
	 </div>
	<?php endif; ?>
	<script type="text/javascript" data-cmp-info="6">
	jQuery(function() {
		Travian.Translation.add({
			'infobox_collapsed': '<?=T("inGame", "showMoreMessages");?>',
			'infobox_expanded': '<?=T("inGame", "hideMoreMessages");?>'
		});

		var box = jQuery('#sidebarBoxAlliance');
		box.find('button.toggleBox').click(function(e) {
			Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'infobox');
		});
	});
	</script>
 </div>
</div>