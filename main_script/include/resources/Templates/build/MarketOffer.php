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
    <div class="boxes-contents cf"><?=T("MarketPlace", "Merchants"); ?>:
        <span
            id="merchantsAvailable"><?=$vars['merchantsAvailable']; ?></span>/<?=$vars['total_merchants']; ?>
    </div>
</div>
<div class="clear"></div>
<form class="sell_resources" method="POST" action="build.php">
    <input type="hidden" name="gid" value="17">
    <input type="hidden" name="t" value="2">
    <input type="hidden" name="a" value="4">
    <input type="hidden" name="c" value="<?=$vars['checker']; ?>">
    <table id="sell" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <th><?=T("MarketPlace", "I'm offering"); ?></th>
            <td class="val"><input type="text" class="text" tabindex="1" name="m1"
                                   value="<?=$vars['m1']; ?>"
                                   maxlength="6"></td>
            <td class="res">
                <select name="rid1" tabindex="2" class="dropdown">
                    <option value="1" selected="selected"><?=T(
                            "inGame", "resources.r1"
                        ); ?></option>
                    <option value="2"><?=T(
                            "inGame", "resources.r2"
                        ); ?></option>
                    <option value="3"><?=T(
                            "inGame", "resources.r3"
                        ); ?></option>
                    <option value="4"><?=T(
                            "inGame", "resources.r4"
                        ); ?></option>
                </select>
            </td>
            <td class="tra"><input class="check" type="checkbox" tabindex="5"
                                   name="d1"
                                   value="1"> <?=T(
                    "MarketPlace", "max, time of transport"
                ); ?>: <input type="text" class="text"
                              tabindex="6"
                              name="d2"
                              value="2"
                              maxlength="2"> <?=T("Global", "General.hour"); ?>

            </td>

        </tr>
        <tr>
            <th><?=T("MarketPlace", "Search"); ?></th>
            <td class="val"><input type="text" class="text" tabindex="3" name="m2"
                                   value="<?=$vars['m2']; ?>"
                                   maxlength="6"></td>
            <td class="res">
                <select name="rid2" tabindex="4" class="dropdown">
                    <option value="1"><?=T(
                            "inGame", "resources.r1"
                        ); ?></option>
                    <option value="2" selected="selected"><?=T(
                            "inGame", "resources.r2"
                        ); ?></option>
                    <option value="3"><?=T(
                            "inGame", "resources.r3"
                        ); ?></option>
                    <option value="4"><?=T(
                            "inGame", "resources.r4"
                        ); ?></option>
                </select>
            </td>
			<?php if ($vars['hasAlliance']): ?>
                <td class="al">
                    <input class="check" type="checkbox" tabindex="7"
                           name="ally" value="1">
                    <?=T("MarketPlace", 'own alliance only'); ?></td>
            <?php endif; ?>
        </tr>
        </tbody>
    </table>
    <p class="error">
        <?=$vars['error']; ?>
    </p>

    <p class="success"><?=$vars['success']; ?></p>

    <button type="submit" value="<?=T("Global", "General.ok"); ?>"
            id="<?=$vars['buttonId']; ?>" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=T(
                    "Global", "General.ok"
                ); ?></div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function() {
            if (jQuery('#<?=$vars['buttonId'];?>')) {
                jQuery('#<?=$vars['buttonId'];?>').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("Global", "General.ok");?>",
                        "name": "",
                        "id": "<?=$vars['buttonId'];?>",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": ""
                    }]);
                });
            }
        });
    </script>
</form>
<?php if ($vars['hasOffers']): ?>
    <h4 class="spacer"><?=T("MarketPlace", "Own offers"); ?></h4>
    <table id="sell_overview" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td>&nbsp;</td>
            <td><?=T("MarketPlace", "I'm offering"); ?></td>
            <th><img src="img/x.gif" class="ratio" alt="ratio"></th>
            <td><?=T("MarketPlace", "I'm searching"); ?></td>
            <td><?=T("MarketPlace", "Merchants"); ?></td>
            <td><?=T("MarketPlace", "Alliance"); ?></td>
            <td><?=T("Global", "General.duration"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?=$vars['content']; ?>
        </tbody>
    </table>
<?php endif; ?>