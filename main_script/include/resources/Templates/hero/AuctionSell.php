<div class="silverAmount">
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
                        <img alt="Silver" class="silver" src="img/x.gif"> ‎‭<span
                                class="ajaxReplaceableSilverAmount"><?= $vars['currentSilver']; ?></span>/<span
                                class="ajaxReplaceableSilverAmountDiff"><?= $vars['availableSilver']; ?></span>‬‎
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<h4 class="spacer"><?= $vars['spacer']; ?></h4>
<table class="sellings" cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <th class="name" colspan="3">
            <?= T("Auction", "desc"); ?>            </th>
        <th class="bids">
            <img title="<?= T("Auction", "bids"); ?>" alt="<?= T("Auction", "bids"); ?>" class="bids"
                 src="img/x.gif"/>
        </th>
        <th class="silver">
            <img title="<?= T("Auction", "silver"); ?>" alt="<?= T("Auction", "silver"); ?>"
                 class="silver"
                 src="img/x.gif"/>
        </th>
        <th class="time">
            <img title="<?= T("Auction", "clock"); ?>" alt="<?= T("Auction", "clock"); ?>" class="clock"
                 src="img/x.gif"/>
        </th>

    </tr>
    </thead>
    <tbody>
    <?= $vars['auctions']; ?>
    </tbody>
</table>


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
        <div class="hero_inventory">

            <div id="itemsToSale">
                <?= $vars['itemsToSale']; ?>
                <div class="clear"></div>
            </div>
        </div>

    </div>
</div>
<div class="clear"></div>

<h4 class="auctionEnded spacer"><?= T("Auction", "Finished auctions"); ?></h4>
<table cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <th class="name" colspan="2">
            <?= T("Auction", "desc"); ?>            </th>
        <th class="bids">
            <img title="<?= T("Auction", "bids"); ?>" alt="<?= T("Auction", "bids"); ?>" class="bids"
                 src="img/x.gif"/>
        </th>
        <th class="silver">
            <img title="<?= T("Auction", "silver"); ?>" alt="<?= T("Auction", "silver"); ?>"
                 class="silver"
                 src="img/x.gif"/>
        </th>
        <th class="time">
            <img title="<?= T("Auction", "clock"); ?>" alt="<?= T("Auction", "clock"); ?>" class="clock"
                 src="img/x.gif"/>
        </th>
    </tr>
    </thead>
    <tbody>
    <?= $vars['finished']; ?>
    </tbody>
</table>
<div class="footer">
    <?= $vars['nav']; ?>
</div>
<form id="sellForm" method="post" action="hero.php?t=4&action=sell">

    <input type="hidden" name="a" value="<?= $vars['checker']; ?>"/>
    <input type="hidden" name="id" value="0"/>
    <input type="hidden" name="amount" value="1"/>
</form>
<script type="text/javascript">

    Travian.Translation.add('hero.sellMulti', '<?=T("Auction", "Sell [AMOUNT] units?");?>');
    Travian.Translation.add('hero.sellSingle', '<?=T("Auction", "Really sell this item?");?>');
    Travian.Translation.add('hero.notEnoughItems', '<?=T("Auction", "Not enough items available for auction ([MIN_AMOUNT] items)");?>');


    Travian.Game.HeroAuction = Object.create({
        alreadyOpen: false,
        valid: true,
        textSingle: '<?=T("Auction", "Really sell this item?");?>',
        textMulti: '<?=T("Auction", "Sell [AMOUNT] units?");?>',
        textNotEnough: '<?=T("Auction", "Not enough items available for auction ([MIN_AMOUNT] items)");?>',

        /**
         * Constructor
         */
        initialize: function() {
            var $this = this;
            <?=$vars['ajaxItemsToSale'];?>
        },
        noMoreAuctions: function (element)
        {
            var dialog = new Travian.Dialog.Dialog(
                {
                    relativeTo:			jQuery(element),
                    elementFocus:		'sellAmount',
                    buttonTextOk: '<?=T("Global", "General.ok");?>',
                    preventFormSubmit: true
                }
            );
            dialog.setContent('<?=$vars['noMoreAuctions'];?>');
            dialog.show();
        },

        horseCanNotSell: function (element)
        {
            var dialog = new Travian.Dialog.Dialog(
                {
                    relativeTo:			jQuery(element),
                    buttonTextOk: '<?=T("Global", "General.ok");?>',
                    preventFormSubmit: true
                }
            );
            dialog.setContent('<?=T("Auction", "You cannot sell your horse!");?>');
            dialog.show();
        },
        horseForSilver: function (element, itemId)
        {
            var $this = this;
            if ($this.alreadyOpen) {
                return;
            }

            $this.alreadyOpen = true;

            var dialog = new Travian.Dialog.Dialog(
                {
                    relativeTo:			jQuery(element),
                    buttonTextOk: '<?=T("Global", "General.ok");?>',
                    preventFormSubmit: true,
                    onOkay: function(dialog, contentElement) {
                        window.location.href = 'hero.php?t=4&action=sellHorse&itemId=' + itemId;
                    },
                    onClose: function(dialog, contentElement) {
                        $this.alreadyOpen = false;
                    }
                }
            );
            dialog.setContent('<?=T("Auction", "Do you want to sell this horse for 100 silver?");?>');
            dialog.show();
        },

        /**
         * Verkaufsform anzeigen
         */
        sellItem: function (element, id, typeId, amount)
        {
            var $this = this;

            Travian.ajax(
                {
                    data:
                        {
                            cmd: 'heroAuction',
                            itemTypeId: typeId

                        },
                    onSuccess: function(amounts)
                    {
                        if (amounts.errorMessage)
                        {
                            $this.setError(amounts);
                        }
                        else
                        {
                            var container = jQuery("<div></div>");
                            $this.valid = true;

                            if (amounts.length > 1 && amounts[0] <= amount)
                            {
                                var select = jQuery('<select id="sellAmount"></select>');
                                for(var i = 0; i < amounts.length;i++)
                                {
                                    if(amounts[i] <= amount)
                                    {
                                        if(i <= 0)
                                        {
                                            select.append(jQuery('<option value="'+amounts[i]+'" selected="selected">'+amounts[i]+'</option>'));
                                        }
                                        else
                                        {
                                            select.append('<option value="'+amounts[i]+'">'+amounts[i]+'</option>');
                                        }
                                    }
                                }

                                container.append(select);
                                container.html($this.textMulti.replace(/\[AMOUNT\]/g, container.html()));
                            }
                            else if(amounts.length > 1 && amounts[0] > amount)
                            {
                                $this.valid = false;
                                container.html($this.textNotEnough.replace(/\[MIN_AMOUNT\]/g, amounts[0]));
                            }
                            else
                            {
                                amount = 1;
                                container.html($this.textSingle);
                            }
                            $this.sellItemDialog(element, id, amount, container.html());
                        }
                    }
                });
        },

        sellItemDialog: function(element, id, amount, content)
        {
            var $this = this;

            if (this.alreadyOpen)
            {
                return;
            }

            this.alreadyOpen = true;

            var sellForm = jQuery('#sellForm');
            var sellAmount = jQuery('#sellAmount');

            sellForm[0].id.value = id;
            sellForm[0].amount.value = amount;

            var dialog = new Travian.Dialog.Dialog(
                {
                    relativeTo:			jQuery(element),
                    elementFocus:		'sellAmount',
                    buttonTextOk: '<?=T("Auction", "yes");?>',
                    buttonTextCancel: '<?=T("Auction", "no");?>',
                    title: $this.valid ? '<?=T("Auction", "Confirm sale:");?>' : '',
                    buttonOk: $this.valid?true:false,
                    preventFormSubmit: true,

                    // beim anzeigen müssen wir die Farbauswahl hinmachen
                    onOpen: function(dialog, contentElement)
                    {
                        sellAmount = jQuery('#sellAmount');
                        if (sellAmount.length > 0)
                        {
                            sellAmount.val(amount);
                            sellAmount.on('change', function()
                            {
                                sellForm[0].amount.value = sellAmount.val();
                            });
                        }
                    },

                    // wenn bestätigt wird
                    onOkay: function(dialog, contentElement)
                    {
                        // hier wird noch einmal der Wert ggf. übertragen da alles < IE 9 bei ENTER das onChange der Textbox nicht auslöst
                        if (sellAmount.length > 0)
                        {
                            sellForm[0].amount.value = sellAmount.val();
                        }
                        sellForm.submit();
                    },

                    onClose: function(dialog, contentElement)
                    {
                        $this.alreadyOpen = false;
                    }
                });

            dialog.setContent(content);
            dialog.show();
        },
        vacationMode: function() {
            window.location.href = 'options.php?s=4';
        }
    });

    jQuery(function() {
        Travian.Game.HeroAuction.initialize();
    });
</script>