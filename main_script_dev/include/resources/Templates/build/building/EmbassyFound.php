<form method="post" action="build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=found">
    <table cellpadding="1" cellspacing="1" id="found"
           class="transparent">
        <tbody>
        <tr>
            <th><?=T("Buildings", "Tag"); ?></th>
            <td class="tag">
                <input class="text" name="ally1"
                       value="<?=$vars['tag']; ?>"
                       maxlength="8">
                <span
                    class="error"><?=$vars['errorTag']; ?></span>
            </td>
        </tr>
        <tr>
            <th><?=T("Buildings", "Name"); ?></th>
            <td class="nam">
                <input class="text" name="ally2"
                       value="<?=$vars['name']; ?>"
                       maxlength="25">
                <span
                    class="error"><?=$vars['errorName']; ?></span>
            </td>
        </tr>
        </tbody>
    </table>
    <p>
        <button type="submit"
                value="<?=T("Global", "General.ok"); ?>"
                name="s1" id="s1" class="green "
                title="<?=T("Global", "General.ok"); ?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T(
                        "Global", "General.save"
                    ); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#s1')) {
                    jQuery('#s1').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Global", "General.ok");?>",
                            "name": "s1",
                            "id": "s1",
                            "class": "green ",
                            "title": "<?=T("Global", "General.ok");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </p>
</form>