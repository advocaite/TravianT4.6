<div class="detail">
    <table class="list" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <?= ($vars['auto'] == 0 ? '<td class="checkbox edit"></td>' : ''); ?>
            <td class="village sortable"
                onclick="Travian.Game.RaidList.sort(<?php use Core\Session;

                echo $vars['lid']; ?>, 'village');"><?=T("FarmList", "Village"); ?></td>
            <td class="ew sortable"
                onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'ew');"><?=T("FarmList",
                    "pop"); ?>
                .
            </td>
            <td class="distance sortable"
                onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'distance');"><?=T("FarmList",
                    "distance"); ?></td>
            <td class="troops sortable"
                onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'troops');"><?=T("FarmList",
                    "troops"); ?></td>
            <td class="lastRaid sortable"
                onclick="Travian.Game.RaidList.sort(<?=$vars['lid']; ?>, 'lastRaid');"><?=T("FarmList",
                    "lastRaid"); ?></td>
            <td class="action"></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($vars['numSlots'] == 0) {
            echo '<tr class="slotRow">
		<td class="noData" colspan="7">
			' . T("FarmList", "noSlot") . '		</td>
	</tr>';
        } else {
            echo $vars['slots'];
        }
        ?>
        </tbody>
    </table>
    <?php if ($vars['auto'] == 0): ?>
        <div class="markAll">
            <input type="checkbox" id="raidListMarkAll<?=$vars['lid']; ?>"
                   class="markAll check"
                   onclick="Travian.Game.RaidList.markAllSlotsOfAListForRaid(<?=$vars['lid']; ?>, this.checked);"/>
            <label
                    for="raidListMarkAll<?=$vars['lid']; ?>"><?=T("FarmList", "checkAll"); ?></label>
        </div>
    <?php endif; ?>
    <div class="addSlot">
        <?php
        echo getButton([
            "type"    => "button",
            "value"   => "add",
            "class"   => 'green ',
            'onclick' => "Travian.Game.RaidList.addSlot({$vars['lid']},'','','rallyPoint');",
        ],
            [],
            T("FarmList", "add"));
        if (getDisplay("displayFarmlistEditAll")) {
            echo getButton([
                    "type"    => "button",
                    "value"   => "add",
                    "class"   => 'green ',
                    'onclick' => "editFarmList({$vars['lid']});",
                ],
                    [],
                    T("FarmList", "editAllSlotsRaid"));
        }
        ?>
        <span
                class="raidListSlotCount">‎&#x202d;&#x202d;&#x202d;<?=$vars['numSlots']; ?>
            &#x202c;&#x202c;/&#x202d;&#x202d;100&#x202c;&#x202c;&#x202c;‎</span>
    </div>
</div>
<div class="clear"></div>
<div class="troopSelection">
    <?php
    for ($i = 1; $i <= 10; ++$i) {
        $unitId = nrToUnitId($i, Session::getInstance()->getRace());
        echo '<span class="troopSelectionUnit">';
        echo '<img class="unit u' . $unitId . '" title="' . T("Troops", "$unitId.title") . '" alt="' . T("Troops",
                "$unitId.title") . '" src="img/x.gif" />';
        echo '<span class="troopSelectionValue">0</span>';
        echo '</span>';
    }
    ?>
    <div class="clear"></div>
</div>
<?php
if ($vars['auto'] == 0) {
    echo getButton([
        "type"    => "submit",
        "value"   => "start raid",
        "class"   => 'green ',
        "onclick" => "return f3321bf4b28aad28366b5d58a9e532b849088a512(event);",
    ],
        [],
        T("FarmList", "startRaid"));
}
?>
<br/>
<br/>