<div class="cf">
    <p>
        <a class="manualBack arrow back" href="manual.php"><?=T("Manual", "toOverview");?></a>
    </p>

    <h1 class="titleInHeader"><img class="gebIcon g<?=$vars['building']['gid'];?>Icon"
                                   src="img/x.gif"
                                   alt="<?=T("Buildings", $vars['building']['gid'] . ".title");?>"> <?=T("Buildings", $vars['building']['gid'] . ".title");?>
    </h1>
    <img class="building big black g<?=$vars['building']['gid'];?>" src="img/x.gif"
         alt="Woodcutter" title="<?=T("Buildings", $vars['building']['gid'] . ".title");?>"/>
    <p class="description">
        <?=T("Buildings", $vars['building']['gid']. ".desc");?></p>
    <p class="costsHeader">
        <b><?=T("Buildings", "costs");?></b> <?=T("Manual", "and");?>
        <b><?=T("Manual", "construction_time") . ' ' . T("Manual", "for") . ' ' . T("Manual", "level");?></b> 1:<br/>
    <div class="inlineIconList resourceWrapper">
        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?=$vars['building']['cost'][0];?></span></div>
        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?=$vars['building']['cost'][1];?></span></div>
        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?=$vars['building']['cost'][2];?></span></div>
        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?=$vars['building']['cost'][3];?></span></div>
        <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?=$vars['building']['cu'];?></span></div>
    </div>
    <br />
    <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?=secondsToString($vars['building']['upTime']);?></span></div>
    <div id="prereqs"><b><?=T("Manual", "preRequests");?></b><br/><?=$vars['preRequests'];?></div>
</div>
<div class="answers">
    <a class="a arrow" href="<?=$vars['TravianAnswersBaseUrl'];?>/copyable/public/index.php?aid=<?=$vars['building']['answerId'];?>#go2answer"
       target="_blank" title="<?=T("Manual", "TravianAnswers");?>"><?=T("Manual", "moreInTravianAnswers");?></a>
</div>