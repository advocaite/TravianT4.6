<h4 class="round"><?=T("Alliance", "Edit internal info page");?></h4>
<form id="SettingsFormular" method="post" action="allianz.php?s=7">
    <input type="hidden" name="a" value="7">
    <textarea id="internInfo1" class="internInfo" name="info1"><?=$vars['info1'];?></textarea>
    <textarea id="internInfo2" class="internInfo" name="info2"><?=$vars['info2'];?></textarea>

    <div class="clear"></div>
    <p class="btn">
        <input type="image" value="" name="save" id="btn_save" class="dynamic_img" src="img/x.gif"
               alt="<?=T("Global", "General.save");?>">
    </p>

    <div class="openedClosedSwitch switchClosed" id="switchBBCodes"><?=T("Alliance", "BB codes");?></div>
    <div class="clear"></div>
    <table cellpadding="1" cellspacing="1" id="bBCodes" class="hide">
        <tbody>
        <tr>
            <td class="desc"><?=T("Alliance", "News");?></td>
            <td class="tag">[news]<?=T("Alliance", "Number");?>[/news]</td>
        </tr>
        <tr>
            <td class="desc"><?=T("Alliance", "losses");?></td>
            <td class="tag">[losses]<?=T("Alliance", "Tag");?>[/losses]</td>
        </tr>
        <tr>
            <td class="desc"><?=T("Alliance", "strength");?></td>
            <td class="tag">[stats]strength[/stats]</td>
        </tr>
        <tr>
            <td class="desc"><?=T("Alliance", "fighting points");?></td>
            <td class="tag">[stats]fighting points[/stats]</td>
        </tr>
        <tr>
            <td class="desc"><?=T("Alliance", "Forum");?></td>
            <td class="tag">[forum]<?=T("Alliance", "Number");?>[/forum]</td>
        </tr>
        </tbody>
    </table>

    <div class="submitContainer">
        <button type="submit" value="save" id="<?=$vars['buttonId'];?>" class="green disabled" disabled="">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Global", "General.save");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#<?=$vars['buttonId'];?>')) {
                    jQuery('#<?=$vars['buttonId'];?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Global", "General.save");?>",
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
    </div>
</form>
<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#SettingsFormular'));

        jQuery('#switchBBCodes').click(function (e) {
            Travian.toggleSwitch(jQuery('#bBCodes'), $('switchBBCodes'));
        });
    });
</script>