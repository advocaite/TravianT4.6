
<div id="sidebarBoxLinklist" class="sidebarBox   ">
	<div class="header ">
		<div class="buttonsWrapper">
			
		   <?php 
				$d = [
					"class"        => "",
					"type"         => $vars['plus'] ? 'green' : 'gold',
					"loadTitle"    => FALSE,
					"boxId"        => "",
					"disabled"     => FALSE,
					"speechBubble" => "",
					"svg"	  	   => "edit_green",
					"redirectUrl"  => $vars['plus'] ? "linklist.php" : '#',
					"plusDialog"   => $vars['plus'] ? [] : [
						"featureKey" => "directLinks",
						"infoIcon"   => "http://t4.answers.travian.com/index.php?aid=Travian Answers#go2answer",
						"cssClass"=>"premiumFeaturePackage premiumFeaturePlus paymentShopV4",
						"premiumFeatureDialogVersion"=>2,
						"version"=>2,
						"paymentShopVersion"=>4
					],
				];
				if ($vars['plus']) {
					unset($d['plusDialog']);
				}
				echo getAButton([
					'id'      => get_button_id(),
					"type"    => "button",
					"class"   => "layoutButton buttonFramed withIcon round edit ". ($vars['plus'] ? 'green' : 'gold'),
					"title"   => htmlspecialchars(T("links", "Link list").'||'.($vars['plus'] ? T("links", "edit link list") : T("links", "Travian Plus allows you to make a link list"))),
					"svg"	  => "edit_green",
					"href"    => $vars['plus'] ? "linklist.php" : '#',
				], ["data" => $d]);
		   ?>
		</div>
	</div>
	<div class="content">
		<div class="boxTitle"><?=T("links", "Link list"); ?></div>
		<?php if(strlen($vars['links'])):?><ul><?=$vars['links']; ?></ul><?php endif;?>
		<?php if(!$vars['plus']): ?>
			<div class="linklistNotice"><?=T("links", "Travian Plus allows you to make a link list"); ?></div>
		<?php elseif($vars['noLinks']): ?>
			<div class="linklistNotice"><?=T("links", "edit link list"); ?></div>
		<?php endif; ?>
	</div>
</div>