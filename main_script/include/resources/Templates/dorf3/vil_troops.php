<div class="troops_wrapper">
    <table cellpadding="1" cellspacing="1" class="vil_troops">
        <thead>
        <tr>
            <th><?= T("villageOverview", "Village"); ?></th>
            <th colspan="11"><a
                        href="build.php?gid=16&amp;newdid=<?= $vars['kid']; ?>"><?= $vars['name']; ?></a>
            </th>
        </tr>
        </thead>
        <tbody class="troops">
        <tr>
            <td></td>
            <?php
            for ($i = 1; $i <= 11; ++$i) {
                if ($i == 11) {
                    $unitId = 'hero';
                } else {
                    $unitId = nrToUnitId($i, $vars['race']);
                }
                $title = T("Troops", "$unitId.title");
                echo '<td><img class="unit u' . $unitId . '" src="img/x.gif" title="' . $title . '" alt="' . $title . '" /></td>';
            }
            ?>
        </tr>
        <tr>
            <th><?= T("villageOverview", "Troops"); ?></th>
            <?php
            for ($i = 1; $i <= 11; ++$i) {
                if ($vars['units'][$i]) {
                    echo '<td>' . number_format_x($vars['units'][$i]) . '</td>';
                } else {
                    echo '<td class="none">0</td>';
                }
            }
            ?>
        </tr>
        <tr>
            <td colspan="12" class="empty"></td>
        </tr>
        </tbody>
        <tbody class="upkeep">
        <tr>
            <th><?= T("villageOverview", "Upkeep"); ?></th>
            <td colspan="11">
                <?= $vars['upkeep']; ?>&nbsp;<i class="r4"></i>&nbsp;<?= T("villageOverview", "per hour"); ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
