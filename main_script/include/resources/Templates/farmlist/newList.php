<div id="raidListCreate">
    <h4><?php use Core\Session;
        use Core\Village;
        use Model\FarmListModel;

        echo T("FarmList", "create_new_list"); ?></h4>

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
                            <input class="text" id="name" name="listName"
                                   type="text"/>
                        </td>
                    </tr>
                    <tr>
                        <th><?=T("FarmList", "Village"); ?>:</th>
                        <td>
                            <select id="did" name="did">
                                <?php
                                $m = new FarmListModel();
                                $villages = $m->getMyVillages(Session::getInstance()->getPlayerId());
                                while ($row = $villages->fetch_assoc()) {
                                    echo '<option value="' . $row['kid'] . '"' . ($row['kid'] == Village::getInstance()->getKid() ? ' selected="selected"' : '') . '>' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <span id="error" class="error"></span>
        <br/>
        <button type="button" value="<?=T("FarmList", "create"); ?>"
                id="<?=$button_id = get_button_id(); ?>" class="green "
                onclick="Travian.Game.RaidList.createNewList()">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("FarmList", "create"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "button",
                        "value": "<?=T("FarmList", "create");?>",
                        "name": "",
                        "id": "<?=$button_id;?>",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": "Travian.Game.RaidList.createNewList()"
                    }]);
                });
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