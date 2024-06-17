<h4 class="round"><?=T("Smithy", "Improve weapons and armour");?></h4>
<script type="text/javascript">
    <?php for($i = 1; $i <= 8; ++$i):?>
    function getNr<?=$i;?>() {return {additionalData: {nr: <?=$i;?>}};}
    <?php endfor;?>
</script>
<div class="build_details researches">
    <?=$vars['availableResearches'];?>
</div>
<?php if($vars['researchingSize']>0):?>
    <h4 class="round"><?=T("Smithy", "Researching");?></h4>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead>
        <tr>
            <td><?=T("Smithy", "unit");?></td>
            <td><?=T("Global", "General.duration");?></td>
            <td><?=T("Global", "General.endat");?></td>
        </tr>
        </thead>
        <tbody>
        <?=$vars['researchingTableBody'];?>
        </tbody>
    </table>
    <?=$vars['finishNowButton'];?>
<?php endif;?>
<?php if(!empty($vars['upgradeAllButton'])):?>
    <br />
    <div class="roundedCornersBox big">
        <h4><div class="statusMessage"><?=T("ExtraModules", "smithyUpgradeAllToMax");?></div></h4>
        <div id="contractSpacer"></div>
        <div id="contract" class="contractWrapper">
            <div class="contractLink centeredText">
                <?=$vars['upgradeAllButton'];?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
<?php endif;?>