<h4 class="round"><?=T("Statistics", "WonderOfTheWorld");?></h4>

<table cellpadding="1" cellspacing="1" id="wonder">
    <thead>
    <tr>
        <td></td>
        <td><?=T("Statistics", "Player");?></td>
        <td><?=T("Statistics", "Name");?></td>
        <td><?=T("Statistics", "Alliance");?></td>
        <td><?=T("Statistics", "Level");?></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?=$vars['wonders'];?>
    </tbody>
</table>