<img src="img/x.gif" class="reportImage trade" alt="">
<div class="tradeReport">
    <div class="tradeHeader">
        <div class="headline">
            <h2 class="from"><?=T("Reports", "Sender");?></h2>
            <h2 class="to">
                <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
                <?=T("Reports", "Recipient");?></h2>
        </div>
        <div class="participants">
            <div class="from">
                <?=$vars['trade']['participants']['from'];?>
            </div>
            <div class="to">
                <?=$vars['trade']['participants']['to'];?>
            </div>
        </div>
    </div>

    <table cellpadding="0" cellspacing="0" id="trade">
        <tbody class="goods">
        <tr>
            <td class="empty" colspan="2"></td>
        </tr>
        <tr>
            <th><?=T("inGame", "resources.resources");?></th>
            <td <?=$vars['trade']['tdStyle'];?>>

                <div class="inlineIconList resourceWrapper rArea">
                    <div class="inlineIcon resources"><i class="r1"></i><span class="value "><?=$vars['trade']['res'][1];?></span></div>
                    <div class="inlineIcon resources"><i class="r2"></i><span class="value "><?=$vars['trade']['res'][2];?></span></div>
                    <div class="inlineIcon resources"><i class="r3"></i><span class="value "><?=$vars['trade']['res'][3];?></span></div>
                    <div class="inlineIcon resources"><i class="r4"></i><span class="value "><?=$vars['trade']['res'][4];?></span></div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="empty" colspan="2"></td>
        </tr>
        <tr>
            <th><?=T("Global", "General.duration");?></th>
            <td>
                <img src="img/x.gif" class="clock" alt="<?=T("Global", "General.duration");?>">&nbsp;<?=$vars['trade']['duration'];?></td>
        </tr>
        </tbody>
    </table>
</div>