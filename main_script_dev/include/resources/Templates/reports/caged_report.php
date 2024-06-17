<img src="img/x.gif" class="reportImage usedCages" alt="">
<div class="animalReport">
    <div class="animalHeader">
        <div class="headline">
            <div class="from">
                <i class="tribeIcon bigTribe4"> </i>
                <img class="roleIcon" src="img/svg/combat/svgDefend.svg" alt="">
                <h2><?= T("Global", "NatureName"); ?></h2>
            </div>
            <div class="to">
                <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
        </div>
        <div class="participants">
            <?=$vars['cagedReport']['participants'];?>
        </div>
    </div>
    <table id="defender" cellpadding="0" cellspacing="0">
        <tbody class="units">
        <tr>
            <th class="coords"></th>
            <?php for ($i = 31; $i <= 40; ++$i): ?>
                <td class="unit <?= ($i == 40 ? 'last' : ''); ?>"><img src="img/x.gif" class="unit u<?= $i; ?>"></td>
            <?php endfor; ?>
        </tr>
        </tbody>
        <tbody class="units last">
        <tr>
            <th><i class="troopCount"></i></th>
            <?php for ($i = 31; $i <= 40; ++$i): ?>
                <?php $num = $vars['cagedReport']['units'][$i - 30]; ?>
                <td class="unit <?= ($num == 0 ? 'none' : ''); ?> <?= ($i == 40 ? 'last' : ''); ?>" <?=$vars['cagedReport']['tdStyle'];?>><?= $num; ?></td>
            <?php endfor; ?>
        </tr>
        </tbody>
    </table>
    <table class="additionalInformation">
        <tbody class="infos">
        <tr>
            <th><?= T("Reports", "Information"); ?></th>
            <td colspan="11"><?= $vars['cagedReport']['notice']; ?></td>
        </tr>
        </tbody>
    </table>
</div>