<div class="body">
    <img src="img/x.gif" class="reportImage reinforcement" alt="">
    <div class="supportReport">
        <div class="supportHeader">
            <div class="headline"><h2 class="from"><?= T("Reports", "Sender"); ?></h2>
                <h2 class="to">
                    <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M0 0L20 10L0 20z"></path>
                    </svg>
                    <?= T("Reports", "Recipient"); ?>
                </h2>
            </div>
            <div class="participants">
                <div class="from">
                    <?= $vars['reinforcement']['from']['headLine']; ?>
                </div>
                <div class="to">
                    <?= $vars['reinforcement']['to']['headLine']; ?>
                </div>
            </div>
        </div>
        <table class="supportTroops" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <td class="role"></td>
                <td class="troopHeadline" colspan="10"><p></p></td>
            </tr>
            </thead>
            <tbody class="units">
            <tr>
                <th class="coords"></th>
                <?php for ($i = 1; $i <= ($vars['reinforcement']['race'] == 4 ? 10 : 11); ++$i): ?>
                    <?php
                    $unitId = nrToUnitId($i, $vars['reinforcement']['race']);
                    if ($unitId == 98) {
                        $unitId = 'hero';
                    }
                    ?>
                    <td class="uniticon <?= ($i == ($vars['reinforcement']['race'] == 4 ? 10 : 11) ? 'last' : ''); ?>">
                        <img src="img/x.gif" class="unit u<?= $unitId; ?>"></td>
                <?php endfor; ?>
            </tr>
            </tbody>
            <tbody class="units last">
            <tr>
                <th><i class="troopCount"></i></th>
                <?php for ($i = 1; $i <= ($vars['reinforcement']['race'] == 4 ? 10 : 11); ++$i): ?>
                    <?php
                    $num = $vars['reinforcement']['units'][$i];
                    $unitId = nrToUnitId($i, $vars['reinforcement']['race']);
                    if ($unitId == 98) {
                        $unitId = 'hero';
                    }
                    ?>
                    <td class="unit <?= ($num == 0 ? 'none' : ''); ?> <?= ($i == ($vars['reinforcement']['race'] == 4 ? 10 : 11) ? 'last' : ''); ?>" <?= $vars['reinforcement']['tdStyle']; ?>><?= $num; ?></td>
                <?php endfor; ?>
            </tr>
            </tbody>
        </table>
        <table class="additionalInformation">
            <tbody class="infos">
            <tr>
                <th><?=T("Global", "General.duration");?></th>
                <td colspan="11"><img src="img/x.gif" class="clock"><?=$vars['reinforcement']['duration'];?></td>
            </tr>
            </tbody>
            <tbody class="infos">
            <tr>
                <td class="empty" colspan="12"></td>
            </tr>
            <tr>
                <th><?=T("Reports", "Consumption");?></th>
                <td colspan="11">
                    <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resources" title="">
                            <i class="r4"></i>
                            <span class="value "><?=$vars['reinforcement']['consumption'];?> <?=T("Reports", "perHR") ;?></span>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>