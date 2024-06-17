<h4 class="round"><?=T("Statistics", "Game development"); ?></h4>
<div class="plusInfoText">
	<?=T("Statistics", "The following graphs show a time progression of economy, population, and the military strength of your army"); ?></div>
<h4 class="round spacer"><?=T("Statistics", "Number of troops"); ?></h4>
<div class="graph"
     style="background-image:url('stats.php?id=<?=$vars['uid']; ?>:<?=$vars['chartHashId']; ?>&amp;s=2');">
	<div class="legende">
		<div class="box"
		     style="background-color:#71D000;"></div><?=T("Statistics", "total"); ?>
		<br/>

		<div class="box"
		     style="background-color:#0061FF;"></div><?=T("Statistics", "reinforcements"); ?>
	</div>
</div>
<h4 class="round spacer"><?=T("Statistics", "Resource production and population"); ?></h4>
<div class="graph"
     style="background-image:url('stats.php?id=<?=$vars['uid']; ?>:<?=$vars['chartHashId']; ?>&amp;s=3');">
	<div class="legende">
		<div class="box"
		     style="background-color:#71D000;"></div><?=T("Statistics", "resources/4"); ?>
		<br/>

		<div class="box"
		     style="background-color:#FFDF00;"></div><?=T("Statistics", "Inhabitants"); ?>
	</div>
</div>
<h4 class="round spacer"><?=T("Statistics", "Rank"); ?></h4>
<div class="graph"
     style="background-image:url('stats.php?id=<?=$vars['uid']; ?>:<?=$vars['chartHashId']; ?>&amp;s=4');"></div>
<h4 class="round spacer"><?=T("Statistics", "Number of troops killed"); ?></h4>
<div class="graph"
     style="background-image:url('stats.php?id=<?=$vars['uid']; ?>:<?=$vars['chartHashId']; ?>&amp;s=5');">
	<div class="legende">
		<div class="box"
		     style="background-color:#71D000;"></div><?=T("Statistics", "total"); ?>
		<br/>

		<div class="box"
		     style="background-color:#FF0000;"></div><?=T("Statistics", "attack"); ?>
	</div>
</div>