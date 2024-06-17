<div class="role <?=$vars['isDefender'] ? "defender" : "attacker";?>">
    <div class="header">
        <div class="avatar">
            <i class="tribeIcon bigTribe<?=$vars['race'];?>"> </i>
            <img src="img/svg/combat/svg<?=($vars['isDefender'] ? 'Defend' : 'Attack');?>.svg" alt="<?=$vars['role'];?>">
        </div>
        <h2><?=$vars['role'];?></h2>
        <div class="outcome">
            <div class="arrowWrapper">
                <svg class="outcomeArrow" viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
            <?php if(!$vars['isDefender']):?>
                <img class="losses attack<?=(!$vars['won'] ? 'Lost' : null);?>" src="img/svg/combat/svgAttack<?=(!$vars['won'] ? 'Lost' : null);?>.svg">
                <?php if(!$vars['skull']):?>
                <img class="loot <?=$vars['lootClass'];?>" src="img/svg/combat/svg<?=ucfirst($vars['lootClass']);?>.svg">
                <?php endif;?>
            <?php else:?>
                <img class="losses defend<?=(!$vars['won'] ? 'Lost' : null);?>" src="img/svg/combat/svgDefend<?=(!$vars['won'] ? 'Lost' : null);?>.svg">
            <?php endif;?>
            <?php if($vars['skull']):?>
                <img class="skull " src="img/svg/combat/svgSkull.svg">
            <?php endif;?>
        </div>
    </div>
    <div class="troopHeadline ">
        <div style="direction: <?=strtolower(getDirection());?>">
            <?=$vars['troopHeadline'];?>
        </div>
        <div class="toolList">
            <?php if($vars['showSimulateButton']):?>
                <a class="iconButton" title="<?=T("Reports", "Combat simulator");?>" href="build.php?id=39&amp;tt=3&amp;bid=<?=$vars['reportId'];?>"><i class="simulate"></i></a>
            <?php endif;?>
            <?php if($vars['showRepeatButton']):?>
                <a class="iconButton" title="<?=T("Reports", "Repeat attack");?>" href="build.php?id=39&amp;tt=2&amp;bid=<?=$vars['reportId'];?>"><i class="repeatAttack"></i></a>
            <?php endif;?>
            <?php if ($vars['showAddToFarmList']): ?>
                <?php if ($vars['hasGoldClub']): ?>
                    <?= $vars['addToFarmListHTML']; ?>
                <?php else: ?>
                    <button type="button" id="raidListGoldclub" class="icon gold"
                            title="<?= T("Reports", "Add to farm list||For this feature you need the Gold club activated"); ?>">
                        <i class="reportButton raidList"></i>
                    </button>
                    <script type="text/javascript">jQuery(function () {
                            jQuery('#raidListGoldclub').click(function (event) {
                                jQuery(window).trigger("buttonClicked", [this, {
                                    "goldclubDialog": {
                                        "featureKey": "raidList",
                                        "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                                    }
                                }]);
                            })
                        });</script>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <table id="<?=$vars['isDefender'] ? "defender" : "attacker";?>" class="<?=$vars['isDefender'] ? "defender" : "attacker";?>" cellpadding="0" cellspacing="0">
        <?=$vars['tbody'];?>
    </table>
</div>