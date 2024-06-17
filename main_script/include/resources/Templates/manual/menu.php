<div id="troops">
	<h3>
        <img src="img/x.gif" class="unit uunits"/> <?=T("Manual", "Units"); ?></h3>
	<div class="contentNavi tabNavi ">
		<?php
		for($i = 1; $i <= 7; ++$i) {
		    if($i == 4 || $i == 5) continue;
			$active = $i == 1 ? "active" : "normal";
			$tribe = T("Global", "races.".$i);
			echo '<div title="" class="container category'.$i.' '.$active.'">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content">

									<a id="'.get_button_id().'" onclick="showTroops('.$i.')" class="tabItem">
					'.$tribe.'														</a>
							</div>
		</div>';
		}
		?>
		<div class="clear"></div>
	</div>
	<?php
	for($i = 1; $i <= 7; ++$i) {
        if($i == 4 || $i == 5) continue;
        echo '<ul class="troops'.$i.' '.($i == 1 ? "" : "hide").'">';
		$start = ($i - 1) * 10 + 1;
		for($x = $start; $x <= $start + 9; ++$x) {
			echo '<li>';
			echo '<img src="img/x.gif" class="unit u'.$x.'" />';
			echo '<a href="manual.php?typ=1&amp;s='.$x.'">'.T("Troops", $x.".title").'</a>';
			echo '</li>';
		}
		echo '</ul>';
	}
	$buildings = [
		"Infrastructure" => [
			10, 11, 15, 17, 18, 23, 24, 25, 26, 27, 28, 34, 35, 38, 39, 40, 41, 44, 45
		], "Military"    => [
			13, 14, 16, 19, 20, 21, 22, 29, 30, 31, 32, 33, 42, 43, 36, 37,
		], "resources"   => [1, 2, 3, 4, 5, 6, 7, 8, 9],
	];
	?>
</div>

<div id="buildings">
	<h3><img src="img/x.gif"
	         class="gebIcon"/> <?=T("Buildings", "Buildings"); ?></h3>

	<div class="contentNavi tabNavi ">


		<?php
		$i = 1;
		foreach($buildings as $bkey => $b) {
			$title = T("Buildings", $bkey);
			$active = $i == 1 ? "active" : "normal";
			echo '<div title="" class="container category'.$i.' '.$active.'">
			<div class="background-start">&nbsp;</div>
			<div class="background-end">&nbsp;</div>
			<div class="content">

									<a id="'.get_button_id().'" onclick="showBuildings('.$i.')" class="tabItem">
					'.$title.'														</a>
							</div>
		</div>';
			++$i;
		}
		?>
	</div>

	<div class="clear"></div>

	<?php
	$i = 1;
	foreach($buildings as $type => $gid) {
		echo '<ul class="buildings'.$i.' hide">';
		foreach($gid as $g) {
			$btitle = T("Buildings", $g.".title");
			echo <<<HTML
<li>
            <img src="img/x.gif" class="gebIcon g{$g}Icon" />
            <a href="manual.php?typ=4&amp;gid={$g}">{$btitle}</a></li>
        <li>
HTML;
		}
		++$i;
		echo '</ul>';
	}
	?>
</div>
<script type="text/javascript">
	jQuery('#troops .troops1').removeClass('hide');
	jQuery('#buildings .buildings1').removeClass('hide');

	function resetContent(menu) {
		jQuery('#' + menu + ' ul').addClass('hide');

		jQuery('#' + menu + ' .container').removeClass('active');
		jQuery('#' + menu + ' .container').addClass('normal');
	}

	function showTroops(vid) {
		resetContent('troops');
		jQuery('#troops .troops' + vid).removeClass('hide');
		jQuery('#troops .contentNavi .vid' + vid).removeClass('normal');
		jQuery('#troops .contentNavi .vid' + vid).addClass('active');
	}

	function showBuildings(category) {
		resetContent('buildings');
		jQuery('#buildings .buildings' + category).removeClass('hide');
		jQuery('#buildings .contentNavi .category' + category).removeClass('normal');
		jQuery('#buildings .contentNavi .category' + category).addClass('active');
	}
</script>
<div id="anwersQuestionMark">
	<a href="<?=getAnswersUrl(); ?>/copyable/public/index.php?aid=268#go2answer"
	   target="_blank" title="">
		&nbsp;</a>
</div>