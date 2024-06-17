<table class="currentBid" cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <th class="name" colspan="3">
            <?=T("Auction", "desc");?>
        </th>
        <?php if ($vars['isAdmin']): ?>
            <td>Owner</td>
            <td>Buyer</td>
        <?php endif; ?>
        <th class="bids">
            <img title="<?=T("Auction", "bids");?>" alt="<?=T("Auction", "bids");?>" class="bids" src="img/x.gif"/>
        </th>
        <th class="silver">
            <img title="<?=T("Auction", "silver");?>" alt="<?=T("Auction", "silver");?>" class="silver"
                 src="img/x.gif"/>
        </th>
        <th class="time">
            <img title="<?=T("Auction", "clock");?>" alt="<?=T("Auction", "clock");?>" class="clock" src="img/x.gif"/>
        </th>
        <th class="bid"><?=T("Auction", "bid");?></th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['currentBid'];?>
    </tbody>
</table>
<form method="post" action="hero.php?t=4">
    <h4 class="auctionEnded"><?=T("Auction", "Finished auctions");?></h4>
    <table cellspacing="1" cellpadding="1">
        <thead>
        <tr>
            <th class="name" colspan="3">
                <?=T("Auction", "desc");?>            </th>
            <th class="bids">
                <img title="<?=T("Auction", "bids");?>" alt="<?=T("Auction", "bids");?>" class="bids" src="img/x.gif"/>
            </th>
            <th class="silver">
                <img title="<?=T("Auction", "silver");?>" alt="<?=T("Auction", "silver");?>" class="silver"
                     src="img/x.gif"/>
            </th>
            <th class="time">
                <img title="<?=T("Auction", "clock");?>" alt="<?=T("Auction", "clock");?>" class="clock"
                     src="img/x.gif"/>
            </th>
            <th class="bid"><?=T("Auction", "bid");?></th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['finished'];?>
        </tbody>
    </table>

    <div class="footer">
        <div id="markAll">
            <input class="check" type="checkbox" id="sAll" onclick="
            jQuery(this).closest('form').find('input[type=checkbox]').each(function(index, element) {
                element.checked = this.checked;
            }.bind(this));"/>
            <span><label for="sAll"><?=T("Auction", "select all");?></label></span>
        </div>
        <?=$vars['nav'];?>
        <div class="clear"></div>
    </div>

    <div>
        <button type="submit" value="Delete" name="del" id="del" class="green " title="<?=T("Auction", "del");?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Auction", "del");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#del')) {
                    jQuery('#del').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "Delete",
                            "name": "del",
                            "id": "del",
                            "class": "green ",
                            "title": "Delete",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
        <input type="hidden" name="action" value="bids"/>
        <input type="hidden" name="page" value="<?=$vars['page'];?>"/>
        <input type="hidden" name="filter" value="<?=$vars['filter'];?>"/>
    </div>
</form>