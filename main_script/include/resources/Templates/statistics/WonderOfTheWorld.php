<h4 class="round"><?=T("Statistics", "tabs.WonderOfTheWorld");?></h4>

<table cellpadding="1" cellspacing="1" id="wonder">
    <thead>
    <tr>
        <td></td>
        <td><?=T("Statistics", "WonderOfTheWorld.player");?></td>
        <td><?=T("Statistics", "WonderOfTheWorld.name");?></td>
        <td><?=T("Statistics", "WonderOfTheWorld.alliance");?></td>
        <td><?=T("Statistics", "WonderOfTheWorld.level");?></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?=$vars['wonders'];?>
    </tbody>
</table>