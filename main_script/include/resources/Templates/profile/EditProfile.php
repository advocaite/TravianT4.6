<form id="PlayerProfileEditor" action="spieler.php" method="post">

    <input type="hidden" name="e" value="2"/>
    <input type="hidden" name="uid" value="<?php use Core\Config;

    echo $vars['uid']; ?>"/>
    <input type="hidden" name="did" value="<?=$vars['kid']; ?>"/>
    <h4 class="round"><?=T("Profile", "Details"); ?></h4>
    <table cellpadding="1" cellspacing="1" id="editDetails" class="transparent">
        <tbody>
        <tr>
            <th class="birth"><?=T("Profile", "Birthday"); ?></th>
            <td class="birth">

                <input tabindex="3" type="text" name="jahr" value="<?=$vars['year']; ?>" maxlength="4"
                       class="text year"/>
                <select tabindex="2" name="monat" class="dropdown">
                    <option value="0"></option>
                    <?=$vars['month']; ?>
                </select><input tabindex="1" class="text day" type="text" name="tag" value="<?=$vars['day']; ?>"
                                maxlength="2"/>
            </td>
            <th class="gender" rowspan="2"><?=T("Profile", "Gender"); ?></th>
            <td class="gender" rowspan="2">
                <label>
                    <input class="radio" type="radio" name="mw"
                           value="0" <?=$vars['gender'] == 0 ? 'checked="checked"' : ''; ?>
                           tabindex="5"/>
                    <?=T("Profile", "n/a"); ?>                    </label><br/>
                <label>
                    <input class="radio" type="radio" name="mw"
                           value="1" <?=$vars['gender'] == 1 ? 'checked="checked"' : ''; ?> />
                    <?=T("Profile", "male"); ?>                    </label><br/>
                <label>
                    <input class="radio" type="radio" name="mw"
                           value="2" <?=$vars['gender'] == 2 ? 'checked="checked"' : ''; ?> />
                    <?=T("Profile", "female"); ?>                    </label>
            </td>
        </tr>
        <tr>
            <th><?=T("Profile", "Location"); ?></th>
            <td><input tabindex="4" type="text" name="ort" value="<?=$vars['location']; ?>" maxlength="30"
                       class="text"/>
            </td>
        </tr>
        <?php if ($vars['promoted']): ?>
            <tr>
                <th colspan="4"><?= T("Profile", "Show country flag in your profile"); ?>
                    <select tabindex="5" name="showCountryFlag" class="showCountryFlagDropdown">
                        <option value="1" <?=$vars['showCountryFlag'] == 1 ? 'selected="selected"' : ''; ?>>
                            <?= T("Profile", "YES"); ?>
                        </option>
                        <option value="0" <?=$vars['showCountryFlag'] == 0 ? 'selected="selected"' : ''; ?>>
                            <?= T("Profile", "NO"); ?>
                        </option>
                    </select>
                </th>
            </tr>
        <?php endif; ?>
        <?php if (getDisplay("includeHiddenMedals")): ?>
            <tr>
                <th colspan="4"><?= T("Profile", "Show special medals?"); ?>
                    <select tabindex="5" name="showMedals" class="showCountryFlagDropdown">
                        <option value="1" <?=$vars['showMedals'] == 1 ? 'selected="selected"' : ''; ?>>
                            <?= T("Profile", "YES"); ?>
                        </option>
                        <option value="0" <?=$vars['showMedals'] == 0 ? 'selected="selected"' : ''; ?>>
                            <?= T("Profile", "NO"); ?>
                        </option>
                    </select>
                </th>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <h4 class="round spacer"><?=T("Profile", "Description"); ?></h4>
    <textarea tabindex="6" class="editDescription editDescription1" name="be1" rows=""
              cols=""><?=$vars['desc1']; ?></textarea>
    <textarea tabindex="7" class="editDescription editDescription2" name="be2" rows=""
              cols=""><?=$vars['desc2']; ?></textarea>
    <div class="clear"></div>
    <div class="switchWrap">
        <div class="openedClosedSwitch switchClosed" id="switchMedals"><?=T("Profile", "Medals"); ?></div>
        <div class="clear"></div>
    </div>

    <!-- Medaillen -->
    <table cellpadding="1" cellspacing="1" id="medals" class="hide">
        <thead>
        <tr>
            <td><?=T("Profile", "Category"); ?></td>
            <td><?=T("Profile", "Rank"); ?></td>
            <td><?=T("Profile", "Week"); ?></td>
            <td><?=T("Profile", "BB-Code"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?=$vars['medals']; ?>
        </tbody>
    </table>
    <?php if (!empty($vars['medals2'])): ?>
        <div class="switchWrap">
            <div class="openedClosedSwitch switchClosed" id="switchMedals2"
                 style="float: <?= getDirection() == 'RTL' ? 'left' : 'right'; ?>;"><?=T("Profile", "SpecialMedals"); ?></div>
            <div class="clear"></div>
        </div>
        <table cellpadding="1" cellspacing="1" id="medals2" class="hide">
            <thead>
            <tr>
                <td><?=T("Profile", "Category"); ?></td>
                <td><?=T("Profile", "BB-Code"); ?></td>
            </tr>
            </thead>
            <tbody>
            <?=$vars['medals2']; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <h4 class="round spacer"><?=T("Profile", "Villages"); ?></h4>

    <table cellpadding="1" cellspacing="1" id="villages">
        <thead>
        <tr>
            <th class="name"><?=T("Profile", "Name"); ?></th>
            <th><?=T("Profile", "Oases"); ?></th>
            <th><?=T("Profile", "Inhabitants"); ?></th>
            <th><?=T("Profile", "Coordinates"); ?></th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['villages']; ?>
        </tbody>
    </table>

    <div class="submitButtonContainer">
        <button type="submit" value="save" name="s1" id="btn_ok" class="green ">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Global", "General.ok"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#btn_ok')) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Global", "General.ok");?>",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green ",
                            "title": "",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </div>
</form>

<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#PlayerProfileEditor'));

        if (jQuery('#switchMedals')) {
            jQuery('#switchMedals').click(function (e) {
                Travian.toggleSwitch(jQuery('#medals'), $('switchMedals'));
            });
        }
    });

</script>
<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#PlayerProfileEditor'));
        <?php if(!empty($vars['medals2'])):?>
        if (jQuery('#switchMedals2')) {
            jQuery('#switchMedals2').click(function (e) {
                Travian.toggleSwitch(jQuery('#medals2'), $('switchMedals2'));
            });
        }
        <?php endif;?>
    });
</script>