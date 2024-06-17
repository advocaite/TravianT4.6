<?php
use Core\Session;
use Game\Formulas;
?>
<script type="text/javascript">
    var raidSlot = new Travian.Game.RaidList.RaidSlot('<?=(isset($vars['slotId']) ? $vars['slotId'] : null); ?>', '<?=$_POST['context'];?>', <?=json_encode($vars['targets']);?>, <?=($a = ($_POST['context'] == 'rallyPoint' ? 'true' : 'false'));?>);
</script>
<div id="raidListSlot">
    <h4><?=T("FarmList", !isset($vars['units']) ? "addRaid" : "editRaid"); ?></h4>
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
                            <select onchange="raidSlot.updateRaidList();" id="lid" name="lid">
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
                    <tr>
                        <th><?=T("FarmList", "choose_target"); ?>:</th>
                        <td>
                            <div class="coordinatesInput">
                                <div class="xCoord">
                                    <label for="xCoordInput">X:</label>
                                    <input type="text" maxlength="4" value="<?=isset($vars['x']) ? $vars['x'] : ''; ?>" name="x" id="xCoordInput" class="text coordinates x " onkeyup="Travian.Formatter.Filter.aNumber(this)" onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);">
                                </div>
                                <div class="yCoord">
                                    <label for="yCoordInput">Y:</label>
                                    <input type="text" maxlength="4" value="<?=isset($vars['y']) ? $vars['y'] : ''; ?>" name="y" id="yCoordInput" class="text coordinates y " onkeyup="Travian.Formatter.Filter.aNumber(this)" onpaste="var cih = new Travian.Game.RallyPoint.CoordinatesInputHelper({coordinateXInputId: 'xCoordInput', coordinateYInputId: 'yCoordInput'}); cih.insertCoordinates(event);">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="targetSelect">
                                <label class="lastTargets" for="last_targets"><?=T("FarmList", "lastTargets"); ?>
                                    :</label>
                                <select id="target_id" name="target_id" onchange="raidSlot.updateTargetId()">
                                    <option value=""><?=T("FarmList", "choose_village"); ?></option>
                                    <?=$vars['target_id']; ?>
                                </select>
                            </div>
                            <div class="clear"></div>
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
                echo '<div class="troopGroup"><label for="t' . $i . '"><img class="unit u' . $unitId . '" title="' . T("Troops", "$unitId.title") . '" alt="' . T("Troops","$unitId.title") . '" src="img/x.gif" /></label><input class="text troop" id="t' . $i . '" type="text" name="t' . $i . '" value="' . $units[$i] . '"' . ($i == Formulas::getSpyId(Session::getInstance()->getRace()) ? ' disabled="disabled"' : '') . ' /></div>';
            }
            echo '<div class="clear"></div>';
            ?>
        </div>
        <button type="submit" value="save" name="save" id="save" class="green "
        onClick="Travian.Game.RaidList.persistSlotEntry(raidSlot.getSelectedListId(), <?=(isset($_REQUEST['slotId']) ? $_REQUEST['slotId'] : 'null');?>, Travian.Game.RaidList.parseQueryString(jQuery('#edit_form').serialize()), false);">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Global", "General.save"); ?></div>
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
                    }]);
                });
            });
        </script>
        <?php if (isset($vars['units'])): ?>
            <button type="button" value="Delete" name="delete" id="delete" class="green " onclick="
                (function() {
                    Travian.Game.RaidList.dialog({
                        onOkay: function(){ Travian.Game.RaidList.deleteSlot(<?=$vars['slotId']; ?>, <?=$a; ?>)}
                    },
                    '<?=T("FarmList", "reallyDelete");?>')
                })()">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("FarmList", "delete"); ?></div>
                </div>
            </button>
            <script type="text/javascript">
                jQuery(function () {
                    jQuery('#delete').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "button",
                            "value": "delete",
                            "name": "delete",
                            "id": "delete",
                            "class": "green ",
                            "title": "",
                            "confirm": ""
                        }]);
                    });
                });
            </script>
        <?php endif; ?>
    </form>
</div>
<script type="text/javascript">
    Travian.Translation.add({
        'raidList.overwriteFarmListEntry': "Overwrite farm list entry",
        'raidList.thisWillOverwriteAnExistingFarmListEntry': "This will overwrite an existing farm list entry."
    });
    jQuery(function () {
        var form = jQuery("#raidListSlot form");
        form.find('input').keypress(function(e) {
            // check if enter button was pressed
            if(e.key === 'Enter') {
                e.preventDefault();
                form.find('button:submit').click();
            }
        });
        form.on('submit', function (event) {
            event.preventDefault();
        });
    });
</script>