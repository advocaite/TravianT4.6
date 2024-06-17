<h4 class="round"><?=T("Alliance", "Change alliance description");?></h4>
<form id="SettingsFormular" method="post" action="allianz.php">
    <textarea class="editDescription editDescription1" tabindex="1" name="be1"><?=$vars['desc1'];?></textarea>
    <textarea class="editDescription editDescription2" tabindex="2" name="be2"><?=$vars['desc2'];?></textarea>

    <div class="clear"></div>
    <?php if($vars['hasMedal']):?>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#switchBBCodes')) {
                    jQuery('#switchBBCodes').click(function (e) {
                        Travian.toggleSwitch(jQuery('#bBCodes'), $('switchBBCodes'));
                    });
                }
            });
        </script>
        <div class="switchWrap">
            <div class="openedClosedSwitch switchClosed" id="switchBBCodes"><?=T("Alliance", "Medals");?></div>
            <div class="clear"></div>
        </div>
        <table cellpadding="1" cellspacing="1" id="bBCodes" class="hide">
            <tr>
                <td><?=T("Alliance", "Category");?></td>
                <td><?=T("Alliance", "Rank");?></td>
                <td><?=T("Alliance", "week");?></td>
                <td><?=T("Alliance", "bbcode");?></td>
            </tr>
            <?=$vars['medals'];?>
        </table>
        <br/>
    <?php endif;?>
    <p class="btn">
        <input type="hidden" name="a" value="3">
        <input type="hidden" name="s" value="1">
        <button type="submit" value="save" name="s1" id="btn_save" class="green disabled" tabindex="3" disabled="">
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
                if (jQuery('#btn_save')) {
                    jQuery('#btn_save').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "save",
                            "name": "s1",
                            "id": "btn_save",
                            "class": "green ",
                            "title": "save",
                            "confirm": "",
                            "onclick": "",
                            "tabindex": 3
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
