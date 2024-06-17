<form method="post" action="allianz.php">
    <input type="hidden" name="s" value="2"/>
    <input type="hidden" name="tid" value="<?=$vars['tid'];?>"/>
    <input type="hidden" name="edittopic" value="1"/>
    <input type="hidden" name="admin" value="1"/>
    <h4 class="round"><?=T("Alliance", "edit topic");?></h4>
    <table cellpadding="1" cellspacing="1" class="transparent" id="edit_topic">
        <tbody>
        <tr>
            <th><?=T("Alliance", "Thread");?>:</th>
            <td><input class="text" type="text" name="thema" value="<?=$vars['name'];?>" maxlength="35"/></td>
        </tr>
        <tr>
            <th><?=T("Alliance", "move topic");?>:</th>
            <td>
                <select class="dropdown" name="fid">
                    <?=$vars['options'];?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="spacer"></div>
    <button type="submit" value="<?=T("Global", "General.ok");?>" name="s1" id="btn_ok" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=T("Global", "General.ok");?></div>
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
</form>