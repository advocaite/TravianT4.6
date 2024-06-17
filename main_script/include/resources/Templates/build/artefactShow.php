<div class="artefact">
    <h4><?=$vars['name'];?></h4>

    <p>
        <?=$vars['desc'];?>
    </p>

    <table id="art_details" class="transparent" cellpadding="1" cellspacing="1">
        <tbody>
        <tr>
            <th><?=T("Treasury", "Owner");?></th>
            <td>
                <?=$vars['owner'];?>
            </td>
        </tr>
        <tr>
            <th><?=T("Treasury", "Village");?></th>
            <td>
                <?=$vars['village'];?>
            </td>
        </tr>
        <tr>
            <th><?=T("Treasury", "Alliance");?></th>
            <td><?=$vars['alliance'];?></td>
        </tr>
        <tr>
            <th><?=T("Treasury", "Area of effect");?></th>
            <td><?=T("Treasury", $vars['size'] == 1 ? 'Village' : 'Account');?></td>
        </tr>
        <?php if($vars['type'] != 12 and $vars['type']  != 9):?>
            <tr>
                <th><?=T("Treasury", "Bonus");?></th>
                <td><?=$vars['bonus'];?>‬‎</td>
            </tr>
        <?php endif;?>
        <tr>
            <th><?=T("Treasury", "Required level");?></th>
            <td><?=T("Buildings", "27.title");?> <?=T("Buildings", "level");?> <b><?=$vars['size']==1 ? 10 : 20;?></b></td>
        </tr>

        <tr>
            <th><?=T("Treasury", "Time of conquer");?></th>
            <td><?=$vars['conquer'];?></td>
        </tr>

        <tr>
            <th><?=T("Treasury", "Time of activation");?></th>
            <td><?=$vars['active'];?></td>
        </tr>
        </tbody>
    </table>
    <?php if($vars['showDetails']):?>
        <table class="art_details" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <th colspan="3"><?=T("Treasury", "Former owner");?></th>
            </tr>
            <tr>
                <td><?=T("Treasury", "Player");?></td>
                <td><?=T("Treasury", "Village");?></td>
                <td><?=T("Treasury", "conquered");?></td>
            </tr>
            </thead>
            <tbody>
            <?=$vars['details'];?>
            </tbody>
        </table>
    <?php endif;?>
    <br/>
    <img class="artefact image-<?=$vars['type'] == 11 ? 'fool' : ($vars['type'] == 12 ? 1 : $vars['type']);?>" src="img/x.gif" alt="artefact">
</div>