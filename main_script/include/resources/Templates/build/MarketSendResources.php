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
    <div class="boxes-contents cf">
        <?= T("MarketPlace", "Merchants"); ?>‎<span
                class="merchantsAvailable"><?= $vars['merchantsAvailable']; ?></span>/<?= $vars['total_merchants']; ?>
        ‎
    </div>
</div>
<div class="clear"></div>
<div class="carry"><?= T(
        "MarketPlace",
        "Each of your merchants can carry"
    ); ?>
    <b><?= $vars['merchantCapacityValue']; ?></b> <?= T(
        "MarketPlace",
        "Each of your merchants can carry resources"
    ); ?></div>
<script type="text/javascript">
    Travian.Translation.add(
        {
            'notEnoughMerchants': '<?=T("MarketPlace", "notEnoughMerchants");?>'
        });
    auto_reload = 2
</script>
<?php
$direction = getDirection();
?>
<form method="post" name="snd" action="build.php" id="marketSend">
    <input type="hidden" name="id" id="id"
           value="<?= $vars['index']; ?>"/>
    <input
            type="hidden" name="t" id="t"
            value="5"/>


    <table id="send_select" class="send_res" cellpadding="1"
           cellspacing="1">
        <tr>
            <td class="ico"><a href="#" onclick="upd_res(1,1); return false;"> <i class="r1"></i></a></td>
            <td class="nam">
                <?= T("inGame", "resources.r1"); ?>
            </td>
            <?php if ($direction == 'LTR'): ?>
                <td class="val">
                    <input class="text" type="text" name="r1" id="r1" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(1)"
                           tabindex="1"/>
                </td>
            <?php endif; ?>

            <td class="max LTR">‎/
                <a id="addRessourcesLink1" href="#"
                   onclick="marketPlace.addRessources(1);return false;"><?= $vars['merchantCapacityValue']; ?></a>
            </td>

            <?php if ($direction == 'RTL'): ?>
                <td class="val">
                    <input class="text" type="text" name="r1" id="r1" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(1)"
                           tabindex="1"/>
                </td>
            <?php endif; ?>

        </tr>

        <tr>
            <td class="ico"><a href="#"
                               onclick="upd_res(2,1); return false;"> <i class="r2"></i>
                </a></td>
            <td class="nam">
                <?= T("inGame", "resources.r2"); ?>            </td>

            <?php if ($direction == 'LTR'): ?>
                <td class="val">
                    <input class="text" type="text" name="r2" id="r2" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(2)"
                           tabindex="2"/>
                </td>
            <?php endif; ?>
            <td class="max LTR">‎/
                <a id="addRessourcesLink2" href="#"
                   onclick="marketPlace.addRessources(2);return false;"><?= $vars['merchantCapacityValue']; ?></a>
            </td>
            <?php if ($direction == 'RTL'): ?>
                <td class="val">
                    <input class="text" type="text" name="r2" id="r2" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(2)"
                           tabindex="2"/>
                </td>
            <?php endif; ?>
        </tr>

        <tr>
            <td class="ico"><a href="#"
                               onclick="upd_res(3,1); return false;"> <i class="r3"></i>
                </a></td>
            <td class="nam">
                <?= T("inGame", "resources.r3"); ?>            </td>
            <?php if ($direction == 'LTR'): ?>
                <td class="val">
                    <input class="text" type="text" name="r3" id="r3" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(3)"
                           tabindex="3"/>
                </td>
            <?php endif; ?>
            <td class="max LTR">‎/
                <a id="addRessourcesLink3" href="#"
                   onclick="marketPlace.addRessources(3);return false;"><?= $vars['merchantCapacityValue']; ?></a>
            </td>
            <?php if ($direction == 'RTL'): ?>
                <td class="val">
                    <input class="text" type="text" name="r3" id="r3" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(3)"
                           tabindex="3"/>
                </td>
            <?php endif; ?>
        </tr>

        <tr>
            <td class="ico"><a href="#"
                               onclick="upd_res(4,1); return false;"> <i class="r4"></i>
                </a></td>
            <td class="nam">
                <?= T("inGame", "resources.r4"); ?>            </td>
            <?php if ($direction == 'LTR'): ?>
                <td class="val">
                    <input class="text" type="text" name="r4" id="r4" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(4)"
                           tabindex="4"/>
                </td>
            <?php endif; ?>
            <td class="max LTR">‎/
                <a id="addRessourcesLink4" href="#"
                   onclick="marketPlace.addRessources(4);return false;"><?= $vars['merchantCapacityValue']; ?></a>
            </td>
            <?php if ($direction == 'RTL'): ?>
                <td class="val">
                    <input class="text" type="text" name="r4" id="r4" value=""
                           maxlength="20"
                           onchange="marketPlace.validateAndVisualizeMerchantCapacity(4)"
                           tabindex="4"/>
                </td>
            <?php endif; ?>
        </tr>

        <tr>
            <td colspan="4">
                <hr/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="merchantsNeeded">
                    <?= T("MarketPlace", "Merchants"); ?>: <span
                            id="merchantsNeededNumber">0</span>
                </div>
            </td>
            <?php if ($direction == 'LTR'): ?>
                <td>
                    <div class="merchantCapacityVisualization LTR">
                        <div id="sumResources">0</div>
                    </div>
                </td>
            <?php endif; ?>
            <td>
                <div class="merchantCapacity LTR">
                    ‎/ <span
                            id="merchantCapacityValue"><?= $vars['merchantCapacityValue']
                        * $vars['merchantsAvailable']; ?></span>
                </div>
            </td>
            <?php if ($direction == 'RTL'): ?>
                <td>
                    <div class="merchantCapacityVisualization LTR">
                        <div id="sumResources">0</div>
                    </div>
                </td>
            <?php endif; ?>
        </tr>
    </table>

    <div class="destination">
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
                <table cellpadding="0" cellspacing="0"
                       class="transparent compact">
                    <tbody>
                    <tr>
                        <td><span><?= T("MarketPlace", "Village"); ?>
                                :</span></td>
                        <td class="compactInput">
                            <input id="enterVillageName" class="text village"
                                   type="text" name="dname" maxlength="20"
                                   tabindex="5" value="<?=$vars['dname'];?>"/>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table cellpadding="0" cellspacing="0"
                       class="transparent compact">
                    <tbody>
                    <tr>
                        <td colspan="2"><span class="or"><?= T(
                                    "MarketPlace",
                                    "or"
                                ); ?></span>

                            <div class="coordinatesInput">
                                <div class="xCoord">
                                    <label for="xCoordInput">X:</label>

                                    <input type="text" maxlength="4" value="<?= $vars['x']; ?>" name="x" id="xCoordInput"
                                           class="text coordinates x " onkeypress="jQuery('#enterVillageName').value=''"
                                           onkeyup="Travian.Formatter.Filter.aNumber(this)"
                                           onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);"/>
                                </div>
                                <div class="yCoord">
                                    <label for="yCoordInput">Y:</label>
                                    <input type="text" maxlength="4" value="<?= $vars['y']; ?>" name="y" id="yCoordInput"
                                           class="text coordinates y " onkeypress="jQuery('#enterVillageName').value=''"
                                           onkeyup="Travian.Formatter.Filter.aNumber(this)"
                                           onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);"/>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <script type="text/javascript">
                    var villageName = null;
                    jQuery(function () {
                        var element = jQuery('#enterVillageName');
                        villageName = new Travian.Game.AutoCompleter.VillageName(element);
                        element.on('keydown', function (event) {
                            if (event.key === 'enter' && this.value.trim(' ').length === 0) {
                                return true;
                            }
                            jQuery('#xCoordInput').value = '';
                            jQuery('#yCoordInput').value = '';
                        });
                    });
                </script>

            </div>
        </div>
        <?php if ($vars['hasGoldClub']): ?>
            <div class="run_dropdown">
                <select tabindex="9" name="x2" size=""
                        class="dropdown run_twice_1" id="x2">
                    <option value="1">‎1&times;‎</option>
                    <option value="2">‎2&times;‎</option>
                    <option value="3">‎3&times;‎</option>
                </select>
                <?= T("MarketPlace", "go"); ?></div>
        <?php elseif ($vars['hasPlus']): ?>
            <div class="run_dropdown">
                <select tabindex="9" name="x2" size=""
                        class="dropdown run_twice_1" id="x2">
                    <option value="1">‎1&times;‎</option>
                    <option value="2">‎2&times;‎</option>
                </select>
                <?= T("MarketPlace", "go"); ?></div>
        <?php endif; ?>

    </div>

    <div class="clear"></div>
    <div id="button">
        <div id="prepareError" class="error"></div>

        <button type="submit" value="<?= T("MarketPlace", "prepare"); ?>"
                id="enabledButton"
                class="green prepare"
                onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}"
                tabindex="10"
                onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= T(
                        "MarketPlace",
                        "prepare"
                    ); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                jQuery('#enabledButton').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("MarketPlace", "prepare");?>",
                        "name": "",
                        "id": "enabledButton",
                        "class": "green prepare",
                        "title": "",
                        "confirm": "",
                        "onclick": "if($(this).hasClass(\u0027disabled\u0027)){(new DOMEvent(event)).stop(); return false;} else {}",
                        "tabindex": 10,
                        "onfocus": "jQuery(\u0027button\u0027, \u0027input[type!=hidden]\u0027, \u0027select\u0027).set(\u0027focus\u0027, true); (new DOMEvent(event)).stop(); return false;"
                    }]);
                });
            });
        </script>

        <div class="clear"></div>
    </div>

    <div class="clear"></div>

    <p class="note" id="note"></p>
</form>

<script type="text/javascript">
    function customReload() {
        window.marketPlace.reloadMarketPlace();
    }

    function upd_res(resNr, max) {
        var currentRes = window.resources.storage['l' + resNr];
        var merchantMax = <?=($vars['merchantsAvailable']*$vars['merchantCapacityValue']);?>;
        var resource = jQuery('#r' + resNr);
        var inputRes = parseInt((max) ? currentRes : resource.val()) || 0;

        resource.val(res_max(inputRes, currentRes, merchantMax, 0));

        var prepare = jQuery('.prepare');
        if (prepare.length > 0) {
            prepare.attr('disabled', false);
            prepare.removeClass('disabled');
        }

        window.marketPlace.visualizeMerchantCapacity();
    }

    function res_max(_merchantRes, _actualRes, _merchantMax, _carry) {
        var res = Number(_merchantRes) + _carry;
        if (res > _actualRes) {
            res = _actualRes;
        }
        if (res > _merchantMax) {
            res = _merchantMax;
        }
        if (res === 0) {
            res = '';
        }
        return res;
    }

    jQuery(function () {
        jQuery('#r1').focus();
        window.marketPlace = new Travian.Game.Marketplace({
            merchantsAvailable: <?=$vars['merchantsAvailable'];?>,
            capacityPerMerchant: <?=$vars['merchantCapacityValue'];?>,
            autoCompleter: true,
            merchantsMax: <?=$vars['total_merchants'];?>
        });
        window.marketPlace.visualizeMerchantCapacity();

        var form = jQuery('#marketSend');
        form.on('submit', function (e) {
            e.preventDefault();
            Travian.Game.Marketplace.updateVillageListLinks(this);
            window.marketPlace.prepare();
        });
    });
</script>
<form id="merchantsOnTheWayFormular" action="" method="post">
	<span id="merchantsOnTheWay">
        <?= $vars['merchantsOnTheWay']; ?>
		</span>
</form>