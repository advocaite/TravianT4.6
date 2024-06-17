<div class="action<?= $vars['index'] == 1 ? ' first' : ''; ?>">
    <?php if ($vars['nr'] != 99): ?>
        <div class="bigUnitSection">
            <a href="#"
               onclick="return Travian.Game.iPopup(<?= $vars['unitId']; ?>,1);">
                <img class="unitSection u<?= $vars['unitId']; ?>Section"
                     src="img/x.gif"
                     alt="<?= T("Troops", $vars['unitId'] . ".title"); ?>"
                     title="<?= T(
                         "Troops", $vars['unitId'] . ".title"
                     ); ?>"/>
            </a>
            <a href="#" class="zoom"
               onclick="return Travian.Game.unitZoom(<?= $vars['unitId']; ?>);">
                <img class="zoom" src="img/x.gif"
                     alt="<?= T("inGame", "zoom_in"); ?>"
                     title="<?= T("inGame", "zoom_in"); ?>"/>
            </a>
        </div>
    <?php endif; ?>
    <div class="details">
        <div class="tit">
            <a href="#"
               onclick="return Travian.Game.iPopup(<?= $vars['unitId']
               == 99 ? '36, 4' : $vars['unitId'] . ', 1'; ?>);"><img
                        class="unit u<?= $vars['unitId']; ?>" src="img/x.gif"
                        alt="<?= T("Troops", $vars['unitId'] . ".title"); ?>"
                        title="<?= T(
                            "Troops", $vars['unitId'] . ".title"
                        ); ?>"/></a>
            <a href="#"
               onclick="return Travian.Game.iPopup(<?= $vars['unitId']
               == 99 ? '36, 4' : $vars['unitId'] . ', 1'; ?>);"><?= T(
                    "Troops", $vars['unitId'] . ".title"
                ); ?></a>
            <span class="furtherInfo">(<?= T(
                    "inGame", "available"
                ); ?> <?= number_format_x($vars['available']); ?>)</span>
        </div>
        <div class="inlineIconList resourceWrapper">
            <div class="inlineIcon resource"><i class="r1Big"></i><span
                        class="value value"><?= $vars['cost'][0]; ?></span></div>
            <div class="inlineIcon resource"><i class="r2Big"></i><span
                        class="value value"><?= $vars['cost'][1]; ?></span></div>
            <div class="inlineIcon resource"><i class="r3Big"></i><span
                        class="value value"><?= $vars['cost'][2]; ?></span></div>
            <div class="inlineIcon resource"><i class="r4Big"></i><span
                        class="value value"><?= $vars['cost'][3]; ?></span></div>
            <div class="inlineIcon resource"><i class="cropConsumptionBig"></i><span
                        class="value value"><?= $vars['upkeep']; ?></span></div>
        </div>
        <br/>
        <div class="inlineIcon duration"><i class="<?=$vars['durationClass'];?>"></i><span
                    class="value "><?= $vars['duration']; ?></span></div>
        <div class="cta">
            <?= $vars['npc']; ?>
            <div class="status none"><?= $vars['none_status']; ?></div>
            <span class="value"><?= T("inGame", "Amount"); ?></span>
            <input type="text" class="text" name="t<?= $vars['index']; ?>" value="0"
                   maxlength="<?= max(strlen($vars['max']), 4); ?>"/><span class="value"> / </span>
            <a href="#"
               onclick="jQuery(this).closest('div.details').find('input').val(<?= $vars['max']; ?>); return false;"><?= number_format_x($vars['max']); ?></a>
        </div>
    </div>
    <div class="clear"></div>
</div>