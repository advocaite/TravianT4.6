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
        <table cellpadding="0" cellspacing="0" class="transparent compact">
            <tbody>
            <tr>
                <td><span><?= T("MarketPlace", "Village"); ?>:</span></td>
                <td class="compactInput">
                    <input id="enterVillageName" class="text village" type="text" name="dname" maxlength="" tabindex="5"
                           value="<?= $vars['dname']; ?>"/>
                </td>
            </tr>
            </tbody>
        </table>

        <table cellpadding="0" cellspacing="0" class="transparent compact">
            <tbody>
            <tr>
                <td colspan="2"><span class="or"><?= T("MarketPlace", "or"); ?></span>
                    <div class="coordinatesInput">
                        <div class="xCoord">
                            <label for="xCoordInput">X:</label>
                            <input maxlength="4" value="<?= $vars['x']; ?>" name="x" id="xCoordInput"
                                   class="text coordinates x "
                                   onkeypress="jQuery('#enterVillageName').value=''"
                                   onkeyup="Travian.Formatter.Filter.aNumber(this)"
                                   onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);"/>
                        </div>
                        <div class="yCoord">
                            <label for="yCoordInput">Y:</label>
                            <input maxlength="4" value="<?= $vars['y']; ?>" name="y" id="yCoordInput"
                                   class="text coordinates y "
                                   onkeypress="jQuery('#enterVillageName').value=''"
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
<?php

use Core\Session;

if (Session::getInstance()->hasGoldClub() || Session::getInstance()->hasPlus()):?>
    <div class="run_dropdown">
        <select tabindex="9" name="x2" size="0" class="dropdown run_twice_1" id="x2">
            <option value="1" <?=($vars['x2'] == 1 ? 'selected' : null);?>>1x</option>
            <option value="2" <?=($vars['x2'] == 2 ? 'selected' : null);?>>2x</option>
            <?php if (Session::getInstance()->hasGoldClub()): ?>
                <option value="3" <?=($vars['x2'] == 3 ? 'selected' : null);?>>3x</option>
            <?php endif; ?>
        </select> <?= T("MarketPlace", "go"); ?>
    </div>
<?php endif; ?>

