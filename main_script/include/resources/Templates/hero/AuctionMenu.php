<div class="contentNavi tabNavi ">
    <div title="" class="container <?=$vars['action'] == 'buy' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a href="hero.php?t=4&action=buy" class="tabItem"><?=T("Auction", "buy");?></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['action'] == 'sell' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a href="hero.php?t=4&action=sell" class="tabItem"><?=T("Auction", "sell");?></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['action'] == 'bids' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a href="hero.php?t=4&action=bids" class="tabItem"><?=T("Auction", "bids");?></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['action'] == 'accounting' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a href="hero.php?t=4&action=accounting" class="tabItem"><?=T("Auction", "accounting");?></a>
        </div>
    </div>
    <div class="clear"></div>
</div>