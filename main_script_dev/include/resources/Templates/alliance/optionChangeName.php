<h4 class="round"><?=T("Alliance", "Change name");?></h4>
<form id="SettingsFormular" method="post" action="allianz.php?s=5&amp;o=100">
    <table cellpadding="1" cellspacing="1" class="option name transparent">
        <tbody>
        <tr>
            <th>
                <?=T("Alliance", "Tag");?>:
            </th>
            <td>
                <input class="tag text" name="ally1" value="<?=$vars['tag'];?>" maxlength="8">
                <?php if(isset($vars['tagError'])):?>
                    <span class="error2"><?=$vars['tagError'];?></span>
                <?php endif;?>
            </td>
        </tr>
        <tr>
            <th>
                <?=T("Alliance", "name");?>:
            </th>
            <td>
                <input class="name text" name="ally2" value="<?=$vars['name'];?>" maxlength="25">
                <?php if(isset($vars['nameError'])):?>
                    <span class="error2"><?=$vars['nameError'];?></span>
                <?php endif;?>
            </td>
        </tr>
        </tbody>
    </table>
    <p>
        <input type="hidden" name="a" value="100">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green disabled" disabled="">
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
                            "title": "save",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </p>
</form>
<?php if(isset($vars['note'])):?>
    <p class="note option"><?=$vars['note'];?></p>
<?php endif;?>
<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#SettingsFormular'));
    });
</script>