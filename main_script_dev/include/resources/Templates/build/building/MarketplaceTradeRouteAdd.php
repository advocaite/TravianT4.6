<script type="text/javascript">
    window.marketPlace = new Travian.Game.Marketplace(
        {
            merchantsAvailable: <?php use Core\Config;echo $vars['available_merchants'];?>,
            capacityPerMerchant: <?=$vars['cap'];?>,
            autoCompleter: false,
            merchantsMax: <?=$vars['total_merchant'];?>
        });
    Travian.Translation.add({'notEnoughMerchants': '<?=T("MarketPlace", "notEnoughMerchants");?>'});
    Travian.Translation.add({'resourcesNumberInvalid': '<?=T("MarketPlace", "noResourcesEntered");?>'});
</script>
<form action="build.php" method="post">
    <div id="tradeRouteEdit" class="roundedCornersBox big">
        <div class="targetSelector">
            <div>
                <label for="trade_route_destination"><?= T("MarketPlace", "Target village"); ?></label>
                <select name="did_dest" id="trade_route_destination">
                    <?= $vars['did_dest']; ?>
                </select>
            </div>
            <div>
                <div>

                    <input type="radio"
                           name="show-destination"
                           id="show-destination-all"
                        <?= $vars['destination'] == 'all' ? 'checked="checked"' : ''; ?>

                           onclick="window.location.href='?gid=17&amp;t=0&amp;option=1&amp;show-destination=all';"
                    /><label for="show-destination-all"> <?= T(
                            "MarketPlace", "all"
                        ); ?></label>
                </div>
                <div>

                    <input type="radio"
                           name="show-destination"
                           id="show-destination-only-mine"
                        <?= $vars['destination'] == 'only-mine'
                            ? 'checked="checked"' : ''; ?>

                           onclick="window.location.href='?gid=17&amp;t=0&amp;option=1&amp;show-destination=only-mine';"
                    /><label for="show-destination-only-mine"> <?= T(
                            "MarketPlace", "only mine"
                        ); ?></label>
                </div>
                <div>

                    <input type="radio"
                           name="show-destination"
                           id="show-destination-others"
                        <?= $vars['destination'] == 'others' ? 'checked="checked"' : ''; ?>

                           onclick="window.location.href='?gid=17&amp;t=0&amp;option=1&amp;show-destination=others';"
                    /><label for="show-destination-others"> <?= T(
                            "MarketPlace", "others"
                        ); ?></label>
                    <div>
                    </div>
                </div>
            </div>
        </div>
        <div class="resourceSelector">
            <div>
                <label for="r1"><i class="r1Big"></i></label>
                <input type="text" id="r1" name="r1" class="text" size="5" maxlength="6" value="<?= $vars['r1']; ?>" onchange="marketPlace.validateTradeRouteResources(1)">
            </div>
            <div>
                <label for="r2"><i class="r2Big"></i></label>
                <input type="text" id="r2" name="r2" class="text" size="5" maxlength="6" value="<?= $vars['r2']; ?>" onchange="marketPlace.validateTradeRouteResources(2)">
            </div>
            <div>
                <label for="r3"><i class="r3Big"></i></label>
                <input type="text" id="r3" name="r3" class="text" size="5" maxlength="6" value="<?= $vars['r3']; ?>" onchange="marketPlace.validateTradeRouteResources(3)">
            </div>
            <div>
                <label for="r4"><i class="r4Big"></i></label>
                <input type="text" id="r4" name="r4" class="text" size="5" maxlength="6" value="<?= $vars['r4']; ?>" onchange="marketPlace.validateTradeRouteResources(4)">
            </div>
        </div>
        <?php if (Config::getInstance()->game->usePeriodicTradeRoutes): ?>
            <div class="timeSelector">
                <div>
                    <input type="radio" name="trade_route_mode" id="trade_route_mode_send" value="send" checked="checked">
                    <label for="trade_route_mode_send"><?= T("MarketPlace", "Send time"); ?></label>
                </div>
                <div>
                    <select name="hour">
                        <?php
                        function create_option_sendEvery($value, $vars)
                        {
                            $selected = $vars['hour'] == $value;
                            $text = getTradeRouteTimeText($value);
                            return '<option value="' . $value . '" ' . ($selected ? 'selected="selected"' : '') . '>' . $text . '</option>';
                        }

                        echo create_option_sendEvery(2 * 60, $vars);
                        echo create_option_sendEvery(5 * 60, $vars);
                        echo create_option_sendEvery(10 * 60, $vars);
                        echo create_option_sendEvery(20 * 60, $vars);
                        echo create_option_sendEvery(30 * 60, $vars);
                        echo create_option_sendEvery(45 * 60, $vars);
                        echo create_option_sendEvery(1 * 60 * 60, $vars);
                        echo create_option_sendEvery(2 * 60 * 60, $vars);
                        echo create_option_sendEvery(3 * 60 * 60, $vars);
                        echo create_option_sendEvery(4 * 60 * 60, $vars);
                        echo create_option_sendEvery(5 * 60 * 60, $vars);
                        echo create_option_sendEvery(6 * 60 * 60, $vars);
                        echo create_option_sendEvery(12 * 60 * 60, $vars);
                        echo create_option_sendEvery(24 * 60 * 60, $vars);
                        ?>
                    </select>
                </div>
            </div>
        <?php else: ?>
            <div class="timeSelector">
                <div>
                    <input type="radio" name="trade_route_mode" id="trade_route_mode_send" value="send" checked="checked">
                    <label for="trade_route_mode_send"><?= T("MarketPlace", "Start time"); ?></label>
                </div>
                <div>
                    <select class="dropdown dur" name="hour">
                        <?php for ($i = 0; $i <= 23; ++$i): ?>
                            <option
                                    value="<?= $i; ?>" <?= $vars['hour']
                            == $i ? 'selected="selected"'
                                : ''; ?>><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>
        <div class="runTimeAndAction">

            <div class="runTimesSelector">
                <?= T("MarketPlace", "Deliveries"); ?>:
                <select name="repeat" id="repeat">
                    <option value="1" <?= $vars['times'] == 1
                        ? 'selected="selected"' : ''; ?>>1
                    </option>
                    <option value="2" <?= $vars['times'] == 2
                        ? 'selected="selected"' : ''; ?>>2
                    </option>
                    <option value="3" <?= $vars['times'] == 3
                        ? 'selected="selected"' : ''; ?>>3
                    </option>
                </select>

            </div>

            <div class="actions">

                <a href="build.php?gid=17&amp;t=0"><?=T("MarketPlace", "cancel"); ?></a>
                <button type="submit" value="<?=T("Global", "General.save"); ?>" id="tradeSaveButton" class="green " onclick="return marketPlace.validateTradeRouteResourcesSanity()">  <!-- && marketPlace.validateTradeRouteSendTimeSanity(); -->
                    <?=T("Global", "General.save"); ?></button>
                <script type="text/javascript" id="tradeSaveButton_script">
                    jQuery(function() {
                        jQuery('button#tradeSaveButton').click(function () {
                            jQuery(window).trigger('buttonClicked', [this, {"type":"submit","value":"\u0630\u062e\u06cc\u0631\u0647","name":"","id":"tradeSaveButton","class":"green ","title":"\u0630\u062e\u06cc\u0631\u0647","confirm":"","onclick":"return marketPlace.validateTradeRouteResourcesSanity() \u0026\u0026 marketPlace.validateTradeRouteSendTimeSanity();"}]);
                        });
                    });
                </script>
                <input type="hidden" name="gid" value="17"/>
                <input type="hidden" name="a" value="1"/>
                <input type="hidden" name="t" value="0"/>
                <input type="hidden" name="c" value="<?=$vars['checker']; ?>"/>
                <?php if (isset($vars['trid'])): ?>
                    <input type="hidden" name="trid" value="<?=$vars['trid']; ?>"/>
                <?php endif; ?>
                <input type="hidden" name="option"  value="<?=$vars['edit'] ? 2 : 1; ?>"/>
            </div>
        </div>
    </div>
    <div id="tradeRouteError"></div>
</form>