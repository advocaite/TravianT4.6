<div id="raidListCreate">
    <h4><?=T("FarmList", "rename_list"); ?></h4>

    <form action="?" method="post">
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
                <input type="hidden" name="action" value="addList"/>
                <table cellpadding="1" cellspacing="1" class="transparent">
                    <tr>
                        <th><?=T("FarmList", "name"); ?>:</th>
                        <td>
                            <input class="text" id="name" name="listName" type="text" value="<?=$vars['name']; ?>"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <span id="error" class="error"></span>
        <br>
        <button type="button" value="<?=T("FarmList", "rename"); ?>"
                id="<?=$button_id = get_button_id(); ?>" class="green "
                onclick="Travian.Game.RaidList.updateList(<?=$vars['lid']; ?>)">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("FarmList", "rename"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                if (jQuery('#<?=$button_id;?>')) {
                    jQuery('#<?=$button_id;?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "button",
                            "value": "<?=T("FarmList", "rename");?>",
                            "name": "",
                            "id": "<?=$button_id;?>",
                            "class": "green ",
                            "title": "",
                            "confirm": "",
                            "onclick": "Travian.Game.RaidList.updateList(<?=$vars['lid'];?>)"
                        }]);
                    });
                }
            });
        </script>
    </form>
</div>
<script type="text/javascript">
    jQuery(function () {
        var raidListCreate = jQuery('#raidListCreate');
        var form = raidListCreate.find('form');

        raidListCreate.find('#name').focus();
        form.on('submit', function (event) {
            event.preventDefault();
            form.find('button').click();
        });
    });
</script>