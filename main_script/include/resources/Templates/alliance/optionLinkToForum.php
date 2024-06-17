<h4 class="round"><?=T("Alliance", "Link to the forum");?></h4>
<p class="option">
    <?=T("Alliance", "If your alliance wants to use an external forum, you can enter the URL here");?>
</p>
<form id="SettingsFormular" method="post" action="allianz.php?s=5&amp;o=5">
    <table cellpadding="1" cellspacing="1" class="option forum_link transparent">
        <tbody>
        <tr>
            <th>
                <?=T("Alliance", "URL");?>                    </th>
            <td>
                <input class="link text" type="text" name="f_link" value="<?=$vars['f_link'];?>" maxlength="200">
            </td>
        </tr>
        </tbody>
    </table>
    <p class="option">
        <input type="hidden" name="a" value="5">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green disabled" disabled=""
                title="<?=T("Global", "General.save");?>">
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
                if (jQuery('#btn_ok')) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "ok",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green ",
                            "title": "<?=T("Global", "General.save");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </p>
</form>
<p class="option note">
</p>
<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#SettingsFormular'));
    });
</script>