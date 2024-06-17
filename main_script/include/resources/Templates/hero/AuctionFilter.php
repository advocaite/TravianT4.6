<div id="filter">
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
            <div class="wrapper">
                <div class="silver">
                    <img alt=<?=T("Auction", "silver");?>" title=<?=T("Auction", "silver");?>" class="silver"
                         src="img/x.gif">
                    <?=$vars['availableSilver'];?> / <?=$vars['currentSilver'];?>
                </div>
                <div class="filterContainer">
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "helmet");?>" type="button"
                            value="itemCategory itemCategory_helmet"
                            class="iconFilter<?=$vars['filter']==0 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=1'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_helmet"
                                alt="itemCategory itemCategory_helmet"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "body");?>" type="button"
                            value="itemCategory itemCategory_body"
                            class="iconFilter<?=$vars['filter']==1 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=2'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_body"
                                alt="itemCategory itemCategory_body"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "leftHand");?>" type="button"
                            value="itemCategory itemCategory_leftHand"
                            class="iconFilter<?=$vars['filter']==2 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=3'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_leftHand"
                                alt="itemCategory itemCategory_leftHand"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "rightHand");?>" type="button"
                            value="itemCategory itemCategory_rightHand"
                            class="iconFilter<?=$vars['filter']==3 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=4'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_rightHand"
                                alt="itemCategory itemCategory_rightHand"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "shoes");?>" type="button"
                            value="itemCategory itemCategory_shoes"
                            class="iconFilter<?=$vars['filter']==4 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=5'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_shoes"
                                alt="itemCategory itemCategory_shoes"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "horse");?>" type="button"
                            value="itemCategory itemCategory_horse"
                            class="iconFilter<?=$vars['filter']==5 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=6'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_horse"
                                alt="itemCategory itemCategory_horse"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "bandage25");?>" type="button"
                            value="itemCategory itemCategory_bandage25"
                            class="iconFilter<?=$vars['filter']==6 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=7'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_bandage25"
                                alt="itemCategory itemCategory_bandage25"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "bandage%s");?>" type="button"
                            value="itemCategory itemCategory_bandage33"
                            class="iconFilter<?=$vars['filter']==7 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=8'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_bandage33"
                                alt="itemCategory itemCategory_bandage33"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "cage");?>" type="button"
                            value="itemCategory itemCategory_cage"
                            class="iconFilter<?=$vars['filter']==8 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=9'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_cage"
                                alt="itemCategory itemCategory_cage"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "scroll");?>" type="button"
                            value="itemCategory itemCategory_scroll"
                            class="iconFilter<?=$vars['filter']==9 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=10'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_scroll"
                                alt="itemCategory itemCategory_scroll"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "ointment");?>" type="button"
                            value="itemCategory itemCategory_ointment"
                            class="iconFilter<?=$vars['filter']==10 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=11'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_ointment"
                                alt="itemCategory itemCategory_ointment"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "bucketOfWater");?>" type="button"
                            value="itemCategory itemCategory_bucketOfWater"
                            class="iconFilter<?=$vars['filter']==11 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=12'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_bucketOfWater"
                                alt="itemCategory itemCategory_bucketOfWater"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "bookOfWisdom");?>" type="button"
                            value="itemCategory itemCategory_bookOfWisdom"
                            class="iconFilter<?=$vars['filter']==12 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=13'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_bookOfWisdom"
                                alt="itemCategory itemCategory_bookOfWisdom"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "lawTables");?>" type="button"
                            value="itemCategory itemCategory_lawTables"
                            class="iconFilter<?=$vars['filter']==13 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=14'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_lawTables"
                                alt="itemCategory itemCategory_lawTables"></button>
                    <button title="<?=T("Auction", "filterFor");?> <?=T("Auction", "artWork");?>" type="button"
                            value="itemCategory itemCategory_artWork"
                            class="iconFilter<?=$vars['filter']==14 ? ' iconFilterActive' : '';?>"
                            onclick="window.location.href = 'hero.php?t=4&action=<?=$vars['action'];?>&amp;filter=15'; return false;"><img
                                src="img/x.gif" class="itemCategory itemCategory_artWork"
                                alt="itemCategory itemCategory_artWork"></button>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>