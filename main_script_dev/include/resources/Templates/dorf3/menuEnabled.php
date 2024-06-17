<?php
use Core\Session;

$tabs = [
	'Overview', 'Overview', 'Resources', 'Warehouse', 'CulturePoints', 'Troops',
];
$favorId = Session::getInstance()->getFavoriteTab('villageOverview');
$favorText = sprintf(T('villageOverview', 'Select x as favor tab'), T("villageOverview", $tabs[$vars['selectedTabId']]));
$selectedTabId = $vars['selectedTabId'];
function getClass($s, $selectedTabId)
{
	return $selectedTabId == $s ? 'active' : 'normal';
}

?>
<a id="tabFavorButton" class="contentTitleButton"
   onclick="
	   Travian.ajax(
	   {
	   data:
	   {
	   cmd: 'tabFavorite',
	   name: 'villageOverview',
	   number: '<?=$selectedTabId; ?>'
	   },
	   onSuccess: function(data)
	   {
	   if (data.success)
	   {
	   jQuery('.favor').removeClass('favorActive');
	   jQuery('.favor.favorKey<?=$selectedTabId; ?>').addClass('favorActive');
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
		class="container <?=getClass(0, $selectedTabId); ?>"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 0 ? 'favorActive' : ''; ?> favorKey0"
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
					"class": "<?=getClass(0, $selectedTabId);?>",
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
		title=""
		class="container  <?=getClass(2, $selectedTabId); ?>"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 2 ? 'favorActive' : ''; ?> favorKey2"
			>

			<a
				id="villageOverViewTab2" href="dorf3.php?s=2" class="tabItem"
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
					"class": " <?=getClass(2, $selectedTabId);?>",
					"title": false,
					"target": false,
					"id": "villageOverViewTab2",
					"href": "dorf3.php?s=2",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Resources");?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab2"
				}]);

			});
		}
	</script>

	<div
		title=""
		class="container  <?=getClass(3, $selectedTabId); ?>"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 3 ? 'favorActive' : ''; ?> favorKey3"
			>

			<a
				id="villageOverViewTab3" href="dorf3.php?s=3" class="tabItem"
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
					"class": " <?=getClass(3, $selectedTabId);?>",
					"title": false,
					"target": false,
					"id": "villageOverViewTab3",
					"href": "dorf3.php?s=3",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Warehouse");?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab3"
				}]);

			});
		}
	</script>

	<div
		title=""
		class="container  <?=getClass(4, $selectedTabId); ?>"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 4 ? 'favorActive' : ''; ?> favorKey4"
			>

			<a
				id="villageOverViewTab4" href="dorf3.php?s=4" class="tabItem"
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
					"class": " <?=getClass(4, $selectedTabId);?>",
					"title": false,
					"target": false,
					"id": "villageOverViewTab4",
					"href": "dorf3.php?s=4",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "CulturePoints");?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab4"
				}]);

			});
		}
	</script>

	<div
		title=""
		class="container  <?=getClass(5, $selectedTabId); ?>"
		>
		<div class="background-start">&nbsp;</div>
		<div class="background-end">&nbsp;</div>
		<div
			class="content favor <?=$favorId == 5 ? 'favorActive' : ''; ?> favorKey5"
			>

			<a
				id="villageOverViewTab5" href="dorf3.php?s=5" class="tabItem"
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
					"class": " <?=getClass(5, $selectedTabId);?>",
					"title": false,
					"target": false,
					"id": "villageOverViewTab5",
					"href": "dorf3.php?s=5",
					"onclick": false,
					"enabled": true,
					"text": "<?=T("villageOverview", "Troops");?>",
					"dialog": false,
					"plusDialog": false,
					"goldclubDialog": false,
					"containerId": "",
					"buttonIdentifier": "villageOverViewTab5"
				}]);

			});
		}
	</script>

	<div class="clear"></div>
</div>
