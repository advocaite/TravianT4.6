<div class="cf">
    <p>
        <a class="manualBack arrow back" href="manual.php"><?=T("Manual", "toOverview");?></a>
    </p>

    <h1 class="titleInHeader">
        <img class="unit u<?=$vars['unit']['id'];?>" src="img/x.gif" alt="<?=T("Troops", $vars['unit']['id'] . ".title");?>"
             title="<?=T("Troops", $vars['unit']['id'] . ".title");?>"/> <?=T("Troops", $vars['unit']['id'] . ".title");?>
        <span class="tribe">(<?=T("Global", "races.".$vars['unit']['race']);?>)</span>
    </h1>

    <div class="bigUnitSection">
        <img class="unitSection u<?=$vars['unit']['id'];?>Section" src="img/x.gif" alt="<?=T("Troops", $vars['unit']['id'] . ".title");?>"
             title="<?=T("Troops", $vars['unit']['id'] . ".title");?>"/>
    </div>
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table id="troop_info" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r1"></i><span class="value "><?=$vars['unit']['cost'][0];?></span></div></div>
                    </td>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r2"></i><span class="value "><?=$vars['unit']['cost'][1];?></span></div></div>
                    </td>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r3"></i><span class="value "><?=$vars['unit']['cost'][2];?></span></div></div>
                    </td>
                    <td class="last">
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r4"></i><span class="value "><?=$vars['unit']['cost'][3];?></span></div></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img class="att_all" src="img/x.gif" alt="<?=T("Manual", "fightingStrength");?>"
                             title="<?=T("Manual", "fightingStrength");?>"/><?=$vars['unit']['attack_power'];?>
                    </td>
                    <td>
                        <img class="def_i" src="img/x.gif" alt="<?=T("Manual", "fightingStrengthAgainstInf");?>"
                             title="<?=T("Manual", "fightingStrengthAgainstInf");?>"/><?=$vars['unit']['def_inf'];?>
                    </td>
                    <td>
                        <img class="def_c" src="img/x.gif" alt="<?=T("Manual", "fightingStrengthAgainstCav");?>"
                             title="<?=T("Manual", "fightingStrengthAgainstCav");?>"/><?=$vars['unit']['def_cav'];?>
                    </td>
                    <td>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <table class="troopData" cellpadding="1" cellspacing="1">
                <tbody>
                <tr>
                    <th><?=T("Manual", "speed");?></th>
                    <td><?=$vars['unit']['speed'];?> <?=T("Manual", "fieldsPerHour");?></td>
                </tr>
                <tr>
                    <th><?=T("Manual", "CarrySize");?></th>
                    <td><?=$vars['unit']['carry'];?> <?=T("inGame", "resources.resources");?></td>
                </tr>
                <tr>
                    <th><?=T("inGame", "resources.r5");?></th>
                    <td>
                        <div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r5"></i><span class="value "><?=$vars['unit']['cu'];?></span></div></div>
                    </td>
                </tr>
                <tr>
                    <th><?=T("Manual", "durationOfTraining");?></th>
                    <td><img class="clock" src="img/x.gif" alt="<?=T("Global", "General.duration");?>"
                             title="<?=T("Global", "General.duration");?>"/> <?=secondsToString($vars['unit']['trainingTime'], true);?>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
    </div>
    <div id="t_desc"><?=($vars['unit']['race'] <= 3 || $vars['unit']['race'] > 5) ? T("Troops", $vars['unit']['id'] . ".desc") : '';?></div>
    <div class="clear"></div>
    <div id="prereqs"><b><?=T("Manual", "preRequests");?></b><br/><?=$vars['preRequests'];?></div>
</div>
<?php if( $vars['unit']['answerId'] > 0):?>
    <div class="answers">
        <a class="a arrow" href="<?=$vars['TravianAnswersBaseUrl'];?>/copyable/public/index.php?aid=<?=$vars['unit']['answerId'];?>#go2answer"
           target="_blank" title="<?=T("Manual", "TravianAnswers");?>"><?=T("Manual", "moreInTravianAnswers");?></a>
    </div>
<?php endif;?>