<div id="finishNowDialog">
    <p><?=T("finishNowPopup", "desc");?>:</p>
    <?php if($vars['buildingOrder']):?>
        <h5><?=T("finishNowPopup", "buildingOrders");?>:</h5>
        <ul>
            <?php foreach($vars['buildingOrders'] as $li):?>
                <?php if($li['possible']):?>
                    <li>
                        <span><?=T("Buildings", $li['itemId'] . '.title');?> </span><span
                                class="lvl"><?=T("Buildings", "level");?> <?=$li['lvl'];?></span>
                    </li>
                <?php else:?>
                    <li class="notPossibleToFinishNow">
                        <span><?=T("Buildings", $li['itemId'] . '.title');?> </span>
                        <span class="notPossible"><?=T("Buildings", "(not possible)");?></span>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
    <?php if($vars['demolish']):?>
        <h5><?=T("finishNowPopup", "demolishBuildingLevel");?>:</h5>
        <ul>
        <?php foreach($vars['demolishs'] as $li):?>
                <li>
                    <span><?=T("Buildings", $li['itemId'] . '.title');?> </span><span
                            class="lvl"><?=T("Buildings", "level");?> <?=$li['lvl'];?></span>
                </li>
        <?php endforeach;?>
        </ul>
    <?php endif;?>
    <?php if($vars['academy']):?>
        <h5><?=T("finishNowPopup", "academy");?>:</h5>
        <ul>
        <?php foreach($vars['academys'] as $li):?>
                <li>
                    <?=T("Troops", $li . '.title');?>
                </li>
        <?php endforeach;?>
        </ul>
    <?php endif;?>
    <?php if($vars['smithy']):?>
        <h5><?=T("finishNowPopup", "academy");?>:</h5>
        <ul>
        <?php foreach($vars['smithys'] as $li):?>
                <li>
                    <?=T("Troops", $li['unitId'] . '.title');?>
                    <span class="lvl"><?=T("finishNowPopup", "level");?> <?=$li['lvl'];?></span>
                </li>
        <?php endforeach;?>
        </ul>
    <?php endif;?>
    <div class="buttonWrapper">
        <?=$vars['button'];?>
    </div>
</div>