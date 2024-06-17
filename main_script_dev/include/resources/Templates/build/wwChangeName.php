<h4><?=T("WWChangeName", "Wonder of the world name"); ?></h4>
<form method="post" action="build.php">
    <table cellpadding="1" cellspacing="1" id="rename" class="transparent">
        <tbody>
        <tr>
            <td colspan="2"><?=T("WWChangeName", "What do you want Wonder of the world name to be?");?></td>
        </tr>
        <tr>
            <th><?=T("WWChangeName", "Name");?>:</th>
            <td>
                <?php
                $disabled = !getDisplay("allowWWUnusualRename") && ($vars['level'] > 10);
                ?>
                <input type="text" class="text" name="ww_name" <?=($disabled ? 'disabled="disabled"' : '');?> value="<?=$vars['WWName']; ?>" maxlength="20">
            </td>
        </tr>
    </table>
    <p>
        <?php if(!$disabled):?>
        <input type="hidden" name="id" value="99">
        <button type="submit" value="ok" name="s1" id="s1" class="green " title="<?= T("Global", "General.save"); ?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= T("Global", "General.save"); ?></div>
            </div>
        </button>
        <script type="text/javascript" id="s1_script">
            jQuery(function() {
                if (jQuery('#s1')) {
                    jQuery('#s1').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "ok",
                            "name": "s1",
                            "id": "s1",
                            "class": "green ",
                            "title": "<?=T("Global", "General.save");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
        <?php endif;?>
        <span class="info">(<?=T("WWChangeName", "Can be changed until level 11");?></span>
    </p>
</form>