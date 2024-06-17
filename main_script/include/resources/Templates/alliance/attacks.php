<div class="boxes boxesColor gray reportFilter offDef">
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
        <button type="button" class="iconFilter <?=($vars['filter'] != 31 && $vars['filter'] != 32) || $vars['filter']==31 ? 'iconFilterActive' : '';?>" title="Attacker"
                onclick="window.location.href = 'allianz.php?s=3&amp;f=31&amp;fn=<?=$vars['fn'];?>'; return false;">
            <img src="img/x.gif" class="att_all" alt="att_all"/>
        </button>
        <button type="button" class="iconFilter <?=($vars['filter'] != 31 && $vars['filter'] != 32) || $vars['filter'] == 32 ? 'iconFilterActive' : '';?>" title="Defender"
                onclick="window.location.href = 'allianz.php?s=3&amp;f=32&amp;fn=<?=$vars['fn'];?>'; return false;">
            <img src="img/x.gif" class="def_all" alt="def_all"/>
        </button>
    </div>
</div>
<div class="boxes boxesColor gray reportFilter unimportant">
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
        <button type="button" class="iconFilter <?=$vars['fn']==1 ? 'iconFilterActive' : '';?>"
                title="<?=T("Alliance", "Don´t show attacks of own alliance (under 100 units, no losses)");?>."
                onclick="window.location.href = 'allianz.php?s=3&amp;f=-1&amp;fn=<?=$vars['fn'] == 1 ? 0 : 1;?>'; return false;">
            <img src="img/x.gif" class="filterNews" alt="filterNews"/>
        </button>
    </div>
</div>
<div class="clear"></div>
<table cellpadding="1" cellspacing="1" id="offs">
    <thead>
    <tr>
        <td><?=T("Alliance", "Player");?></td>
        <td><?=T("Alliance", "Alliance");?></td>
        <td><?=T("Alliance", "Date");?></td>
    </tr>
    </thead>
    <tbody>
    <?=$vars['attacks'];?>
    </tbody>
</table>