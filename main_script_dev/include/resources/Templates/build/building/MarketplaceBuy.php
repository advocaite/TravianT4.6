<div class="boxes boxesColor gray traderCount">
    <div class="boxes-tl"></div>
    <div class="boxes-tr"></div>
    <div class="boxes-tc"></div>
    <div class="boxes-ml"></div>
    <div class="boxes-mr"></div>
    <div class="boxes-mc"></div>
    <div class="boxes-bl"></div>
    <div class="boxes-br"></div>
    <div class="boxes-bc"></div>
    <div class="boxes-contents cf"><?=T("MarketPlace", "Merchants");?>: <span
                id="merchantsAvailable"><?=$vars['merchantsAvailable'];?></span>/<?=$vars['total_merchants'];?>    </div>
</div>
<div class="clear"></div>
<?php if($vars['offerAccepted']):?>
    <table id="summary" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <td colspan="2" class="desc"><?=$vars['offerAcceptTitle'];?></td>
        </tr>
        <tr>
            <td class="val">
                <img class="r<?=$vars['giveType'];?>" src="img/x.gif" alt="<?=T("inGame", "resources.r" . $vars['giveType']);?>">
                <?=$vars['giveValue'];?>
            </td>
            <td class="text"><?=T("MarketPlace", "are on their way to you");?></td>
        </tr>
        <tr>
            <td class="val">
                <img class="r<?=$vars['needType'];?>" src="img/x.gif" alt="<?=T("inGame", "resources.r" . $vars['needType']);?>">
                <?=$vars['needValue'];?>
            </td>
            <td class="text"><?=T("MarketPlace", "have been dispatched by your merchants");?></td>
        </tr>
        </tbody>
    </table>
    <div class="clear"></div>
    <br/>
<?php endif;?>
<div class="boxes boxesColor gray search_select">
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
        <table id="search_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <td colspan="4"><?=T("MarketPlace", "I'm searching");?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <button type="button" value="r1Big" class="iconFilter <?=$vars['s'] == 1 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1<?=$vars['s'] != 1 ? '&amp;s=1' : '';?>'; return false;">
                        <i class="r1"></i>
                    </button>
                </td>
                <td>
                    <button type="button" value="r2Big" class="iconFilter <?=$vars['s'] == 2 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1<?=$vars['s'] != 2 ? '&amp;s=2' : '';?>'; return false;">
                        <i class="r2"></i></button>
                </td>
                <td>
                    <button type="button" value="r3Big" class="iconFilter <?=$vars['s'] == 3 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1<?=$vars['s'] != 3 ? '&amp;s=3' : '';?>'; return false;">
                        <i class="r3"></i>
                    </button>
                </td>
                <td>
                    <button type="button" value="r4Big" class="iconFilter <?=$vars['s'] == 4 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1<?=$vars['s'] != 4 ? '&amp;s=4' : '';?>'; return false;">
                        <i class="r4"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="boxes boxesColor gray ratio_select">
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
        <table id="ratio_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
            <tbody>
            <tr>
                <td>
                    <button type="button" value="marketPercentage marketPercentage1_1"
                            class="iconFilter <?=$vars['r'] == '1:1' ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;page=1&amp;v=1:1&s=<?=$vars['s'];?>'; return false;">
                        <img src="img/x.gif" class="marketPercentage marketPercentage1_1"
                             alt="marketPercentage marketPercentage1_1">
                    </button>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" value="marketPercentage marketPercentage1_x"
                            class="iconFilter <?=$vars['r'] != '1:1' ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;page=1&s=<?=$vars['s'];?>'; return false;">
                        <img src="img/x.gif" class="marketPercentage marketPercentage1_x"
                             alt="marketPercentage marketPercentage1_x">
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="boxes boxesColor gray bid_select">
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
        <table id="bid_select" class="buy_select transparent" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <td colspan="4"><?=T("MarketPlace", "I'm offering");?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <button type="button" value="r1Big" class="iconFilter <?=$vars['b'] == 1 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;v=<?=$vars['r'];;?><?=$vars['b'] != 1 ? '&amp;b=1' : '';?>&s=<?=$vars['s'];?>'; return false;">
                        <i class="r1"></i>
                    </button>
                </td>
                <td>
                    <button type="button" value="r2Big" class="iconFilter <?=$vars['b'] == 2 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;v=<?=$vars['r'];;?><?= $vars['b'] != 2 ? '&amp;b=2' : '';?>&s=<?=$vars['s'];?>'; return false;">
                        <i class="r2"></i>
                    </button>
                </td>
                <td>
                    <button type="button" value="r3Big" class="iconFilter <?=$vars['b'] == 3 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;v=<?=$vars['r'];;?><?= $vars['b'] != 3 ? '&amp;b=3' : '';?>&s=<?=$vars['s'];?>'; return false;">
                        <i class="r3"></i>
                    </button>
                </td>
                <td>
                    <button type="button" value="r4Big" class="iconFilter <?=$vars['b'] == 4 ? 'iconFilterActive' : '';?>"
                            onclick="window.location.href = 'build.php?id=<?=$vars['index'];?>&amp;t=1&amp;v=<?=$vars['r'];?><?= $vars['b'] != 1 ? '&amp;b=4' : '';?>&s=<?=$vars['s'];?>'; return false;">
                        <i class="r4"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="clear"></div>
<h4 class="spacer"><a name="h2"></a><?=T("MarketPlace", "Offers at the marketplace");?></h4>
<table id="range" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <th><?=T("MarketPlace", 'Offered to me');?></th>
        <th><img src="img/x.gif" class="ratio" alt="ratio"></th>
        <th><?=T("MarketPlace", 'Wanted from me');?></th>
        <th><?=T("MarketPlace", 'Player');?></th>
        <th><?=T("MarketPlace", 'Duration');?></th>
        <th><?=T("MarketPlace", 'Action');?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['content'];?>
    </tbody>
</table>
<div style="text-align: right; margin-top: 10px;">
    <?=$vars['nav'];?>
</div>

