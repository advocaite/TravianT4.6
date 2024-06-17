<div class="boxes boxesColor gray silverExchange">
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
        <div id="silverExchange" class="silverExchange">
            <h4><?= T("Auction", "silverExchange"); ?></h4>
            <div class="exchangeLine">
                <form method="post" action="#">
                    <button style="display: none;"></button>
                    <div class="directionButtons">
                        <button class="directionButton GoldToSilver active"><img src="img/x.gif" class="gold"
                                                                                 alt="Gold"><img src="img/x.gif"
                                                                                                 class="arrow"
                                                                                                 alt=""><img
                                    src="img/x.gif" class="silver" alt="Silver"></button>
                        <button class="directionButton SilverToGold "><img src="img/x.gif" class="silver"
                                                                           alt="Silver"><img src="img/x.gif"
                                                                                             class="arrow" alt=""><img
                                    src="img/x.gif" class="gold" alt="Gold"></button>
                    </div>
                    <div class="exchangeTypeGoldToSilver exchangeType active">
                        <button type="submit" value="GoldToSilver" id="<?= $button_id = get_button_id(); ?>"
                                class="gold " title="<?= T("Auction", "exchange"); ?>" coins="1">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= T("Auction", "exchange"); ?><img src="img/x.gif"
                                                                                                 class="goldIcon"
                                                                                                 alt=""/><span
                                            class="goldValue">1</span></div>
                            </div>
                        </button>
                        <script type="text/javascript" id="<?= $button_id; ?>_script">
                            jQuery(function () {
                                jQuery('#<?=$button_id;?>').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "submit",
                                        "value": "GoldToSilver",
                                        "name": "",
                                        "id": "<?=$button_id;?>",
                                        "class": "gold ",
                                        "title": "<?=T("Auction", "exchange");?>",
                                        "confirm": "",
                                        "onclick": "",
                                        "coins": "1",
                                        "wayOfPayment": {
                                            "featureKey": "exchangeSilver",
                                            "context": "convertGoldPopup",
                                            "dataCallback": "getExchangeCoins",
                                            "confirmPopup": {
                                                "name": "convertGoldPopup",
                                                "options": {"elementFocus": "goldToSilver_confirm_btn"}
                                            }
                                        }
                                    }]);
                                });
                            });
                        </script>

                        <div class="exchangeItem formularDirectionLTR">
                            <span class="silverExchangeFormularTerm"><img src="img/x.gif" class="gold" alt="gold"
                                                                          title=""/></span>
                            <span class="silverExchangeFormularTerm">
                                <input id="exchangeGoldToSilverInput"
                                       class="goldInput text" type="text"
                                       onkeyup="if (event.keyCode == 13) { document.getElementById('goldToSilver_btn').click(); return false; }"
                                       value="1"/></span>
                            <span class="silverExchangeFormularTerm">&times;</span>
                            <span class="silverExchangeFormularTerm">100</span>
                            <span class="silverExchangeFormularTerm">=</span>
                            <span class="silverExchangeFormularTerm resultTerm"><img src="img/x.gif" class="silver"
                                                                                     alt="silver" title=""/><span
                                        class="silverResult">100</span></span>
                        </div>

                    </div>
                    <div class="exchangeTypeSilverToGold exchangeType">
                        <button type="submit" value="SilverToGold" id="silverToGold_btn" class="green "
                                title="<?= T("Auction", "Exchange"); ?>">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= T("Auction", "exchange"); ?></div>
                            </div>
                        </button>
                        <script type="text/javascript" id="silverToGold_btn_script">
                            jQuery(function () {
                                if (jQuery('#silverToGold_btn')) {
                                    jQuery('#silverToGold_btn').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "submit",
                                            "value": "SilverToGold",
                                            "name": "",
                                            "id": "silverToGold_btn",
                                            "class": "green ",
                                            "title": "\u0645\u0628\u0627\u062f\u0644\u0647\u200c\u06cc \u0633\u06a9\u0647\u200c\u06cc \u0646\u0642\u0631\u0647\u200c\u06cc \u062a\u0631\u0627\u0648\u06cc\u0646 \u0628\u0627 \u0633\u06a9\u0647\u200c\u06cc \u0637\u0644\u0627\u06cc \u062a\u0631\u0627\u0648\u06cc\u0646",
                                            "confirm": "",
                                            "onclick": ""
                                        }]);
                                    });
                                }
                            });
                        </script>

                        <div class="exchangeItem formularDirection formularDirectionLTR">
                            <span class="silverExchangeFormularTerm"><img src="img/x.gif" class="silver" alt="silver"
                                                                          title=""/></span>
                            <span class="silverExchangeFormularTerm"><input id="exchangeSilverToGoldInput"
                                                                            class="silverInput text" type="text"
                                                                            value="200"/></span>
                            <span class="silverExchangeFormularTerm">&divide;</span>
                            <span class="silverExchangeFormularTerm">200</span>
                            <span class="silverExchangeFormularTerm">=</span>
                            <span class="silverExchangeFormularTerm resultTerm"><img src="img/x.gif" class="gold"
                                                                                     alt="gold" title=""/><span
                                        class="goldResult">1</span></span>
                        </div>


                    </div>
                </form>
            </div>
            <div class="clear"></div>
            <div class="exchangeMessageLine">
                &nbsp;
            </div>
        </div>
        <script type="text/javascript">
            function getExchangeCoins() {
                var input = jQuery('#exchangeGoldToSilverInput');
                var gold = 0;
                if (input.length > 0) {
                    gold = parseInt(input.val());
                }
                if (gold === 0) {
                    return false;
                }
                return {coins: gold};
            }

            // check if pasted text is an integer and update exchangeValue, otherwise discard it
            function checkGoldSilverPaste(e, inputElement, exchange) {
                var pastedText = undefined;
                if (window.clipboardData && window.clipboardData.getData) { // IE
                    pastedText = window.clipboardData.getData('Text');
                } else if (e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                    pastedText = e.originalEvent.clipboardData.getData('text');
                }

                if (!isNaN(pastedText) && (parseInt(pastedText) == pastedText)) {
                    // update exchange gold value on submit button
                    var val = parseInt(pastedText);
                    exchange.updateExchangeValue(val);

                    if (inputElement.length > 0) {
                        inputElement.val(val);
                    }
                }
            }

            jQuery('#silverExchange form').on('submit', function (e) {
                e.preventDefault();
            });

            jQuery(function () {

                var goldToSilverExchange = new Travian.Game.Hero.SilverExchange(
                    {
                        exchangeOptions:
                            {
                                directionType: 'GoldToSilver',
                                showExchangeTypeElement: jQuery('#silverExchange .directionButtons .GoldToSilver'),
                                inputElement: jQuery('#silverExchange .exchangeTypeGoldToSilver input'),
                                resultValueElements:
                                    [
                                        {
                                            setType: 'html',//use html, val, text, {attr: 'xxx'} and {prop: 'xxx'}
                                            element: jQuery('#silverExchange .exchangeTypeGoldToSilver .silverResult')
                                        }
                                    ],
                                inputValueElements:
                                    [
                                        {
                                            setType: 'html',//use html, val, text, {attr: 'xxx'} and {prop: 'xxx'}
                                            element: jQuery('#silverExchange .exchangeTypeGoldToSilver button.gold .goldValue')
                                        },
                                        {
                                            setType: {attr: 'coins'},//use html, val, text, {attr: 'xxx'} and {prop: 'xxx'}
                                            element: jQuery('#silverExchange .exchangeTypeGoldToSilver button.gold')
                                        }
                                    ],
                                baseMultiplier: 100,
                                maxAmount: <?=$vars['gold'];?>,
                                submitButton: jQuery('#silverExchange .exchangeTypeGoldToSilver button.gold'),
                                handleMaxFunction: function (targetValue) {
                                    this.showMessageByKey('notEnoughGold');
                                    return targetValue;
                                }
                            },
                        messages:
                            {
                                maxAmountTooltip:
                                    {
                                        type: 'tooltip',
                                        message: "Buy now."
                                    },
                                notEnoughGold:
                                    {
                                        type: 'error',
                                        message: "<?=T("Auction", "notEnoughGold");?>"
                                    },
                                autoCorrect:
                                    {
                                        type: 'notice',
                                        message: "<?=T("Auction", "autoCorrect");?>"
                                    },
                                disabledSubmitTooltip:
                                    {
                                        type: 'tooltip',
                                        message: "<?=T("Auction", "disabledSubmitTooltip");?>"
                                    },
                                enabledSubmitTooltip:
                                    {
                                        type: 'tooltip',
                                        message: "<?=T("Auction", "enabledSubmitTooltip");?>"
                                    }
                            }
                    });

                var silverToGoldExchange = new Travian.Game.Hero.SilverExchange(
                    {
                        exchangeOptions:
                            {
                                directionType: 'SilverToGold',
                                showExchangeTypeElement: jQuery('#silverExchange .directionButtons .SilverToGold'),
                                inputElement: jQuery('#silverExchange .exchangeTypeSilverToGold input'),
                                resultValueElements:
                                    [
                                        {
                                            setType: 'html',
                                            element: jQuery('#silverExchange .exchangeTypeSilverToGold .goldResult')
                                        }
                                    ],
                                baseMultiplier: 0.005,
                                maxAmount: <?=$vars['silver'];?>,
                                submitButton: jQuery('#silverExchange .exchangeTypeSilverToGold button.green'),
                                submitButtonClickListener: null,
                                handleMaxFunction: function (targetValue) {
                                    targetValue = this.options.exchangeOptions.maxAmount;
                                    this.options.exchangeOptions.inputElement.val(targetValue);
                                    this.showMessageByKey('autoCorrect');
                                    return targetValue;
                                }
                            },

                        messages:
                            {
                                notEnoughGold:
                                    {
                                        type: 'error',
                                        message: "<?=T("Auction", "notEnoughGold");?>"
                                    },
                                autoCorrect:
                                    {
                                        type: 'notice',
                                        message: "<?=T("Auction", "autoCorrect");?>"
                                    },
                                disabledSubmitTooltip:
                                    {
                                        type: 'tooltip',
                                        message: "<?=T("Auction", "disabledSubmitTooltip");?>"
                                    },
                                enabledSubmitTooltip:
                                    {
                                        type: 'tooltip',
                                        message: "<?=T("Auction", "enabledSubmitTooltip");?>"
                                    }
                            }
                    });

                jQuery(document).bind("TG:changeMaxGoldToSilverAmounts", function (eventData, params) {
                    goldToSilverExchange.setMaxAmounts(params);
                });

                window.showFinishedExchangeGoldToSilver = function (options, context) {
                    Travian.WindowManager.closeByContext('convertGoldPopup');
                    if (options.message) {
                        goldToSilverExchange.showMessage(options.message);
                    }
                    goldToSilverExchange.overrideGoldAndSilver(options.oldGold, options.oldSilver, options.newGold, options.newSilver);
                    var url = Travian.parseURL(window.location.href);
                    goldToSilverExchange.updateHeroAuctionContent(url.searchObject.action, {
                        filter: url.searchObject.filter,
                        page: url.searchObject.page
                    });
                    silverToGoldExchange.setMaxAmounts(options);
                };

                // check paste value
                jQuery('#silverExchange .exchangeTypeGoldToSilver input').on('paste', function (e) {
                    checkGoldSilverPaste(e, jQuery(this), goldToSilverExchange);
                    return false; // Prevent the default handler from running.
                });

                // check paste value
                jQuery('#silverExchange .exchangeTypeSilverToGold input').on('paste', function (e) {
                    checkGoldSilverPaste(e, jQuery(this), silverToGoldExchange);
                    return false; // Prevent the default handler from running.
                });

                // after all the listeners have been set correctly, update the input value once again
                goldToSilverExchange.updateExchangeValue(1);
            });
        </script>
    </div>
</div>


