<h4 class="round"><?=T("MarketPlace", "Own merchants and NPC");?></h4>
<div class="whereAreMyMerchants">
    <?=T("MarketPlace", "Free merchants");?>: ‎<?=$vars['total_available'];?>/<?=$vars['total'];?>
    ‎<br/>
    <?=T("MarketPlace", "Merchants offering resources");?>: ‎<?=$vars['total_offering'];?>/<?=$vars['total'];?>
    ‎<br/>
    <?=T("MarketPlace", "Merchants underway");?>: ‎<?=$vars['total_on_the_way'];?>/<?=$vars['total'];?>
    ‎
</div>

<div class="npcMerchant">
    <?=T("MarketPlace", "Trade your village's resources immediately with NPC merchant 1:1");?>.<br/>
    <?=$vars['exchangeButton'];?>
</div>
<div class="clear"></div>