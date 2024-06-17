<style type="text/css">
    div.statistics table#world_player th, div.statistics table#table td {
        text-align: <?php use Core\Config;echo getDirection() == 'RTL' ? 'right' : 'left';?>;
        width: 50%;
    }

    <?php
    $config = Config::getInstance();
    $bonusRate = 1;
    if (substr($config->settings->worldId, 0, 3) == 'unl') {
        $bonusRate = 50;
    }
    ?>
</style>
<h4 class="round"><?=T("Statistics", "Winner and top player bonuses"); ?></h4>
<table cellpadding="1" cellspacing="1" id="table">
    <tbody>
    <?php if ($config->bonus->bonusGoldWinner): ?>

        <tr class="hover">
            <td><?=T("Statistics", "Winner Player"); ?></td>
            <td><?=$config->bonus->bonusGoldWinner * $bonusRate; ?>
                <img src="img/x.gif"
                     alt="gold"
                     class="gold"></td>
        </tr>
    <?php endif; ?>
    <?php if ($config->bonus->bonusGoldSecondWinner): ?>
        <tr class="hover">
            <td><?=T("Statistics", "Second Winner Player"); ?></td>
            <td><?=$config->bonus->bonusGoldSecondWinner * $bonusRate; ?>
                <img src="img/x.gif"
                     alt="gold"
                     class="gold"></td>
        </tr>
    <?php endif; ?>
    <?php if ($config->bonus->bonusGoldThirdWinner): ?>
        <tr class="hover">
            <td><?=T("Statistics", "Third Winner Player"); ?></td>
            <td><?=$config->bonus->bonusGoldThirdWinner * $bonusRate; ?>
                <img src="img/x.gif"
                     alt="gold"
                     class="gold"></td>
        </tr>
    <?php endif; ?>
    <?php if ($config->bonus->bonusGoldTopAlliance): ?>
        <tr class="hover">
            <td><?=T("Statistics", "Winner Alliance (Top 5)"); ?></td>
            <td><?=$config->bonus->bonusGoldTopAlliance * $bonusRate; ?>
                <img src="img/x.gif"
                     alt="gold"
                     class="gold">
            </td>
        </tr>
    <?php endif; ?>

    <?php if ($config->bonus->bonusGoldTopOff): ?>

        <tr class="hover">
            <td><?=T("Statistics", "Top attacker"); ?></td>
            <td><?=$config->bonus->bonusGoldTopOff * $bonusRate; ?> <img src="img/x.gif"
                                                                                 alt="gold"
                                                                                 class="gold"></td>
        </tr>
    <?php endif; ?>

    <?php if ($config->bonus->bonusGoldTopDef): ?>

        <tr class="hover">
            <td><?=T("Statistics", "Top defender"); ?></td>
            <td><?=$config->bonus->bonusGoldTopDef * $bonusRate; ?> <img src="img/x.gif"
                                                                                 alt="gold"
                                                                                 class="gold"></td>
        </tr>
    <?php endif; ?>

    <?php if ($config->bonus->bonusGoldTopClimber): ?>
        <tr class="hover">
            <td><?=T("Statistics", "Top climber"); ?></td>
            <td><?=$config->bonus->bonusGoldTopClimber * $bonusRate; ?> <img src="img/x.gif"
                                                                                     alt="gold"
                                                                                     class="gold">
            </td>
        </tr>
    <?php endif; ?>
    <?php if ($config->bonus->bonusGoldTopOffHammer): ?>

        <tr class="hover">
            <td><?=T("Statistics", "Top Off hammer"); ?></td>
            <td><?=$config->bonus->bonusGoldTopOffHammer * $bonusRate; ?> <img src="img/x.gif"
                                                                                       alt="gold"
                                                                                       class="gold">
            </td>
        </tr>
    <?php endif; ?>

    <?php if ($config->bonus->bonusGoldTopDefHammer): ?>

        <tr class="hover">
            <td><?=T("Statistics", "Top Def hammer"); ?></td>
            <td><?=$config->bonus->bonusGoldTopDefHammer * $bonusRate; ?> <img src="img/x.gif"
                                                                                       alt="gold"
                                                                                       class="gold">
            </td>
        </tr>
    <?php endif; ?>

    </tbody>
</table>
<hr/>
<?php
if (getDisplay("showBonusRulesInBonusTab")) {
    $content = null;
    $i = 1;
    $content .= '<div style="font-size: 12px;">';
    foreach (T("Statistics", "bonus_rules_array") as $rule) {
        $content .= ($i++) . '. ' . $rule . '<br />';
    }
    $content .= '</div>';
    if (!is_null($content)) {
        echo createBoxTitleHTML(T("Statistics", "Bonus rules"), $content);
    }
}
?>
<br/>
<h4 class="round"><?=T("Statistics", "Server states"); ?></h4>
<table cellpadding="1" cellspacing="1" id="table">
    <tbody>
    <?php
    $order = [
        'Daily gold will be given in', 'Daily quest will reset in',
        'Medals will be given in', 'Artifacts will be released in',
        (getCustom('wwPlansEnabled') ? 'WWPlans will be released in' : 'You can build WW in'), 'Game will be finished in',
    ];
    $values = [
        $config->dynamic->lastDailyGold + 86400 - time(),
        $config->dynamic->lastDailyQuestReset + getGame("dailyQuestInterval") - time(),
        $config->dynamic->lastMedalsGiven + $config->game->medals_interval - time(),
        $config->timers->ArtifactsReleaseTime - time(),
        $config->timers->wwPlansReleaseTime - time(),
        $config->timers->AutoFinishTime - time()
    ];
    $result = array_combine($order, $values);
    natsort($result);
    ?>
    <?php foreach ($result as $name => $timer): ?>
        <?php if ($timer < 0) continue; ?>
        <?php if ($name == 'Daily gold will be given in' and $config->gold->dailyGold <= 0) continue; ?>
        <tr class="hover">
            <td><?=T("Statistics", $name); ?></td>
            <td><?=appendTimer($timer); ?>
                <?=T("Statistics", "hours"); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!--
<div id="tpixeliframe_loading"
     style="z-index: 1000; position: absolute; top: 55px; left: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); opacity: 0.4; display: none; "></div>
<script type="text/javascript">
	document.getElementById("tpixeliframe_loading").style.display = "block";
	var loadTroopsSummary = function loadTroopsSummary(){
		Travian.ajax({
			data: {cmd: "avgTroopsNumber"}, onSuccess: function (a) {
				var dom = document.getElementById("summary");
				dom.innerHTML = a.html;
				//dom.focus();
				//dom.scrollIntoView();
				document.getElementById("tpixeliframe_loading").style.display = "none";
				document.getElementById('content').focus();
			}
		})
	}
	loadTroopsSummary.delay(1000);
</script>
<br />

<div style="width: 543px; align-content: center">
	<h4 class="round"><?=T("Statistics", "Average number of troops per player"); ?></h4>
	<div id="summary">
		<center>
			<img src="/img/loading1.gif">
		</center>
	</div>
</div>
-->
