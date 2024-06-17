<?php

use Core\Session;

$tabs = [
	'Overview', 'Overview', 'Resources', 'Warehouse', 'CulturePoints', 'Troops',
];
$favorId = Session::getInstance()->getFavoriteTab('villageOverview');
$favorText = sprintf(T('villageOverview', 'Select x as favor tab'), T("villageOverview", $tabs[0]));
?>
<a id="tabFavorButton" class="contentTitleButton"
   onclick="
			Travian.ajax(
			{
				data:
				{
					cmd: 'tabFavorite',
					name: 'villageOverview',
					number: '0'
				},
				onSuccess: function(data)
				{
					if (data.success)
					{
						jQuery('.favor').removeClass('favorActive');
						jQuery('.favor.favorKey0').addClass('favorActive');
					}
				}
			});
			return false;
		"
   title="<?=$favorText; ?>"
	>&nbsp;</a>

<div class="contentNavi subNavi ">
	<div
		title=""
		class="container active"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 0 || $favorId == 1 ? 'favorActive' : ''; ?> favorKey0"
			>

			<a
				id="villageOverViewTab1" href="dorf3.php?s=0" class="tabItem"
				>
				<?=T("villageOverview", "Overview"); ?>
				<img src="img/x.gif" class="favorIcon"
				     alt="<?=T("villageOverview", "This tab is set as favourite"); ?>"/>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if (jQuery('#villageOverViewTab1')) {
			jQuery('#villageOverViewTab1').click(function (event) {
				jQuery(window).trigger('tabClicked', [this, {
					"class": "active",
					"title": false,
					"target": false,
					"id": "villageOverViewTab1",
					"href": "dorf3.php?s=0",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Overview");?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab1"
				}]);

			});
		}
	</script>
	<div
		title="<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated"); ?>"
		class="container gold normal"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 2 ? 'favorActive' : ''; ?> favorKey2"
			>

			<a
				id="villageOverViewTab2" href="#" class="tabItem"
				>
				<?=T("villageOverview", "Resources"); ?>
				<img src="img/x.gif" class="favorIcon"
				     alt="<?=T("villageOverview", "This tab is set as favourite"); ?>"/>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if (jQuery('#villageOverViewTab2')) {
			jQuery('#villageOverViewTab2').click(function (event) {
				jQuery(window).trigger('tabClicked', [this, {
					"class": "gold normal",
					"title": "<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated");?>",
					"target": false,
					"id": "villageOverViewTab2",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Resources");?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab2"
				}]);

			});
		}
	</script>

	<div
		title="<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated"); ?>"
		class="container gold normal"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 3 ? 'favorActive' : ''; ?> favorKey3"
			>

			<a
				id="villageOverViewTab3" href="#" class="tabItem"
				>
				<?=T("villageOverview", "Warehouse"); ?>
				<img src="img/x.gif" class="favorIcon"
				     alt="<?=T("villageOverview", "This tab is set as favourite"); ?>"/>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if (jQuery('#villageOverViewTab3')) {
			jQuery('#villageOverViewTab3').click(function (event) {
				jQuery(window).trigger('tabClicked', [this, {
					"class": "gold normal",
					"title": "<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated");?>",
					"target": false,
					"id": "villageOverViewTab3",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Warehouse");?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab3"
				}]);

			});
		}
	</script>

	<div
		title="<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated"); ?>"
		class="container gold normal"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 4 ? 'favorActive' : ''; ?>favorKey4"
			>

			<a
				id="villageOverViewTab4" href="#" class="tabItem"
				>
				<?=T("villageOverview", "CulturePoints"); ?>
				<img src="img/x.gif" class="favorIcon"
				     alt="<?=T("villageOverview", "This tab is set as favourite"); ?>"/>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if (jQuery('#villageOverViewTab4')) {
			jQuery('#villageOverViewTab4').click(function (event) {
				jQuery(window).trigger('tabClicked', [this, {
					"class": "gold normal",
					"title": "<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated");?>",
					"target": false,
					"id": "villageOverViewTab4",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "CulturePoints");?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab4"
				}]);

			});
		}
	</script>

	<div
		title="<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated"); ?>"
		class="container gold normal"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 5 ? 'favorActive' : ''; ?> favorKey5"
			>

			<a
				id="villageOverViewTab5" href="#" class="tabItem"
				>
				<?=T("villageOverview", "Troops"); ?>
				<img src="img/x.gif" class="favorIcon"
				     alt="<?=T("villageOverview", "This tab is set as favourite"); ?>"/>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		if (jQuery('#villageOverViewTab5')) {
			jQuery('#villageOverViewTab5').click(function (event) {
				jQuery(window).trigger('tabClicked', [this, {
					"class": "gold normal",
					"title": "<?=T("villageOverview", "Village statistics||For this feature you need Travian Plus activated");?>",
					"target": false,
					"id": "villageOverViewTab5",
					"href": "#",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Troops");?>",
					"dialog": false,
					"plusDialog": {
						"featureKey": "villageStatistics",
						"infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
					},
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab5"
				}]);

			});
		}
	</script>

	<div class="clear"></div>
</div>
