<h4 class="round"><?=T("HeroMansion", "AnnexedOasis");?></h4>
<table id="oasesOwned" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <td><?=T("HeroMansion", "type");?></td>
        <td><?=T("HeroMansion", "Loyalty");?></td>
        <td><?=T("HeroMansion", "conquered");?></td>
        <td><?=T("HeroMansion", "Coordinates");?></td>
        <td><?=T("HeroMansion", "Resources");?></td>
    </tr>
    </thead>
    <tbody>
    <?=$vars['OwnOasis'];?>
    </tbody>
</table>
<?=$vars['nextOases'];?>
<h4 class="spacer round"><?=T("HeroMansion", "inReachOases");?></h4>
<table id="oasesSurround" cellpadding="1" cellspacing="1">
    <thead>
    <tr>
        <td><?=T("HeroMansion", "type");?></td>
        <td><?=T("HeroMansion", "owner");?></td>
        <td><?=T("HeroMansion", "Village");?></td>
        <td><?=T("HeroMansion", "Coordinates");?></td>
        <td><?=T("HeroMansion", "Resources");?></td>
    </tr>
    </thead>
    <tbody>
    <?=$vars['inReachOasis'];?>
    </tbody>
</table>
<?php if($vars['abandon']['size'] > 0):?>
    <br/>
    <h4 class="round"><?=T("HeroMansion", "AbandonOases");?></h4>
    <table id="oasesAbandon" cellpadding="1" cellspacing="1" id="under_progress">
        <thead>
        <tr>
            <td><?=T("HeroMansion", "type");?></td>
            <td><?=T("HeroMansion", "Coordinates");?></td>
            <td><?=T("HeroMansion", "duration");?></td>
            <td><?=T("HeroMansion", "finished");?></td>
        </tr>
        </thead>
        <tbody>
        <?=$vars['abandon']['html'];?>
        </tbody>
    </table>
<?php endif;?>