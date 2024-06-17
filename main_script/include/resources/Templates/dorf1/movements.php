<div class="movements">
    <div class="boxes villageList movements">
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
            <table id="movements" cellpadding="1" cellspacing="1">
                <?php if($vars['numIncomingTroops'] > 0):?>
                    <tr>
                        <th class="troopMovements header" colspan="3"><?=T("Dorf1", "movements.incoming");?>:</th>
                    </tr>
                    <?=$vars['inComingContent'];?>
                <?php endif;?>
                <?php if($vars['numOutGoingTroops'] > 0):?>
                    <tr>
                        <th class="troopMovements header" colspan="3"><?=T("Dorf1", "movements.outgoing");?>:</th>
                    </tr>
                    <?=$vars['outGoingContent'];?>
                <?php endif;?>
            </table>
        </div>
    </div>
</div>
