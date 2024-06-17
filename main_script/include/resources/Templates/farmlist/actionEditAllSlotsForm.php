<script type="text/javascript">
    var targets = {};

    function getSelectedListId() {
        return jQuery('select#lid option:selected').val()
    }

    var lid = <?php use Core\Session;use Game\Formulas;echo $vars['lid'];?>;
    targets[lid] = {};
    <?php $a = 'true';?>
</script>
<div id="raidListSlot">
    <h4><?=T("FarmList", "editAllSlotsRaid"); ?></h4>
    <form id="edit_form" action="" method="post">
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
                <table cellpadding="1" cellspacing="1" class="transparent">
                    <tr>
                        <th><?=T("FarmList", "FarmList"); ?>:</th>
                        <td>
                            <select onchange="getTargetsByLid();" id="lid"
                                    name="lid">
                                <?php
                                $m = new \Model\FarmListModel();
                                $lists = $m->getMyFarmLists(Session::getInstance()->getPlayerId());
                                while ($row = $lists->fetch_assoc()) {
                                    $name = $m->getVillage($row['kid'], 'name')['name'];
                                    echo '<option value="' . $row['id'] . '" ' . ($row['id'] == $vars['lid'] ? 'selected' : '') . '>' . $name . ' - ' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="troops">
            <?php
            $rtl = getDirection() == 'RTL';
            $units = isset($vars['units']) ? $vars['units'] : array_fill(1, 10, 0);
            for ($i = $rtl ? 5 : 1; $rtl ? $i >= 1 : $i <= 5; $rtl ? --$i : ++$i) {
                $unitId = nrToUnitId($i, Session::getInstance()->getRace());
                echo '<div class="troopGroup"><label for="t' . $i . '"><img class="unit u' . $unitId . '" title="' . T("Troops",
                        "$unitId.title") . '" alt="' . T("Troops",
                        "$unitId.title") . '" src="img/x.gif" /></label><input class="text troop" id="t' . $i . '" type="text" name="t' . $i . '" value="' . $units[$i] . '"' . ($i == Formulas::getSpyId(Session::getInstance()->getRace()) ? ' disabled="disabled"' : '') . ' /></div>';
            }
            echo '<div class="clear"></div>';
            for ($i = $rtl ? 10 : 6; $rtl ? $i >= 6 : $i <= 10; $rtl ? --$i : ++$i) {
                $unitId = nrToUnitId($i, Session::getInstance()->getRace());
                echo '<div class="troopGroup"><label for="t' . $i . '"><img class="unit u' . $unitId . '" title="' . T("Troops",
                        "$unitId.title") . '" alt="' . T("Troops",
                        "$unitId.title") . '" src="img/x.gif" /></label><input class="text troop" id="t' . $i . '" type="text" name="t' . $i . '" value="' . $units[$i] . '"' . ($i == Formulas::getSpyId(Session::getInstance()->getRace()) ? ' disabled="disabled"' : '') . ' /></div>';
            }
            echo '<div class="clear"></div>';
            ?>
        </div>
        <button type="button" value="save" name="save" id="save" class="green "
                onClick="saveSlot(getSelectedListId(), Travian.Game.RaidList.parseQueryString(jQuery('#edit_form').serialize()),<?=$a; ?> );">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("Global", "General.save"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                jQuery('#save').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "button",
                        "value": "save",
                        "name": "save",
                        "id": "save",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": "",
                        "onClick": "saveSlot(getSelectedListId(), jQuery('#edit_form').toQueryString().parseQueryString(),<?=$a;?> );"
                    }]);
                });
            });

            function saveSlot(b, d, a) {
                Travian.ajax({
                    data: {
                        cmd: "raidList",
                        method: "actionEditAllSlots",
                        listId: b,
                        t1: d.t1,
                        t2: d.t2,
                        t3: d.t3,
                        t4: d.t4,
                        t5: d.t5,
                        t6: d.t6,
                        t7: d.t7,
                        t8: d.t8,
                        t9: d.t9,
                        t10: d.t10
                    }, onSuccess: function (e) {
                        Travian.WindowManager.getWindowsByContext("raidAddSlotDialog").pop().close();
                        if (a !== false) {
                            window.location.reload();
                        }
                        return true
                    }
                })
            }
        </script>
    </form>
</div>