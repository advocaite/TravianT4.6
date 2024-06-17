<div class="buildingWrapper">
    <h2><?=$vars['count'] > 1 ? $vars['count'].'. '
            : ''; ?><?=T("Buildings", $vars['itemId'].'.title'); ?></h2>

    <div class="build_desc">
        <a href="#"
           onclick="return Travian.Game.iPopup(<?=$vars['itemId']; ?>,4);"
           class="build_logo">
            <img class="build_logo building big white g<?=$vars['itemId']; ?>"
                 src="img/x.gif"
                 alt="<?=T("Buildings", $vars['itemId'].'.title'); ?>"
                 title="<?=T(
                     "Buildings", $vars['itemId'].'.title'
                 ); ?>"/> </a>
        <?=T("Buildings", $vars['itemId'].'.desc'); ?>
    </div>
    <div id="contract_building<?=$vars['itemId']; ?>" class="contract contractNew contractWrapper">
        <div class="contractText">
            <?=T("Global", "General.cost"); ?>:
        </div>
        <div class="inlineIconList resourceWrapper">
            <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?= number_format_x($vars['cost'][0]); ?></span></div>
            <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?= number_format_x($vars['cost'][1]); ?></span></div>
            <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?= number_format_x($vars['cost'][2]); ?></span></div>
            <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?= number_format_x($vars['cost'][3]); ?></span></div>
            <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span class="value value"><?= $vars['freeCrop']; ?></span></div>
        </div>
        <div class="lineWrapper">
            <?=$vars['npcButton']; ?>
            <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?= $vars['timeInString']; ?></span></div>
        </div>
        <div class="contractLink">
            <?php echo($vars['contractLink']);?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>