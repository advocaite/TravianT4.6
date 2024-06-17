<table class="show_artefacts" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <td></td>
        <td><?=T("Treasury", "Name");?></td>
        <td><?=T("Treasury", "Player");?></td>
        <?php if(isset($vars['dist'])):?>
            <td><?=T("Treasury", "Distance");?></td>
        <?php else:?>
            <td><?=T("Treasury", "Alliance");?></td>
            <td><?=T("Treasury", "Distance");?></td>
        <?php endif;?>
    </tr>
    </thead>
    <tbody>
    <?=$vars['content'];?>
    </tbody>
</table>