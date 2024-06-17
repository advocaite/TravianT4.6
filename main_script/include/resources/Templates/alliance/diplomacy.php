<h4 class="round"><?=T("Alliance", "Alliance diplomacy");?></h4>
<form method="post" action="allianz.php?s=5&amp;o=6">
    <div class="option diplomacy">
        <table cellpadding="1" cellspacing="1" class="option transparent">
            <tbody>
            <tr>
                <th>
                    <?=T("Alliance", "Alliance");?>:
                </th>
                <td>
                    <input class="ally text" type="text" name="a_name" maxlength="8"/>
                </td>
            </tr>

            <tr>
                <td>
                </td>
                <td>
                    <input class="radio" type="radio" id="dipl1" name="dipl" value="1"/>
                    <label for="dipl1"><?=T("Alliance", "offer a confederacy");?></label>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input class="radio" type="radio" id="dipl2" name="dipl" value="2"/>
                    <label for="dipl2"><?=T("Alliance", "offer a NAP");?></label>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input class="radio" type="radio" id="dipl3" name="dipl" value="3"/>
                    <label for="dipl3"><?=T("Alliance", "declare war");?>
                    </label>
                </td>
            </tr>
            </tbody>
        </table>

        <p class="option">
            <input type="hidden" name="a" value="6"/>
            <button type="submit" value="ok" name="s1" id="btn_ok" class="green " title="<?=T("Alliance", "Send");?>">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("Alliance", "Send");?></div>
                </div>
            </button>
            <script type="text/javascript">
                jQuery(function() {
                    if (jQuery('#btn_ok')) {
                        jQuery('#btn_ok').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "submit",
                                "value": "ok",
                                "name": "s1",
                                "id": "btn_ok",
                                "class": "green ",
                                "title": "<?=T("Alliance", "Send");?>",
                                "confirm": "",
                                "onclick": ""
                            }]);
                        });
                    }
                });
            </script>
        </p>
    </div>

    <div class="boxes boxesColor gray infos">
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
            <div class="title">
                <?=T("Alliance", "Hint");?>
            </div>
            <div class="text"><?=T("Alliance", "DiplomacyHint");?></div>
        </div>
    </div>
    <div class="clear"></div>
    <?php if(isset($vars['error'])):?>
        <p class="error option"><?=$vars['error'];?></p>
    <?php endif;?>
</form>
<h4 class="round"><?=T("Alliance", "Own offers");?></h4>
<table cellpadding="1" cellspacing="1" class="option own transparent">
    <tbody>
    <?=$vars['ownOffers'];?>
    </tbody>
</table>
<h4 class="round"><?=T("Alliance", "Foreign offers");?></h4>
<table cellpadding="1" cellspacing="1" class="option foreign transparent">
    <tbody>
    <?=$vars['foreign'];?>
    </tbody>
</table>
<h4 class="round"><?=T("Alliance", "Existing relationships");?></h4>
<table cellpadding="1" cellspacing="1" class="option existing transparent">
    <tbody>
    <?=$vars['exiting'];?>
    </tbody>
</table>
<div class="boxes boxesColor gray infos">
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
        <div class="title">
            <?=T("Alliance", "Tip");?>        </div>
        <?=T("Alliance", "DiplomacyShowText");?>
    </div>
</div>