<img src="img/x.gif" class="reportImage <?= ($vars['lose'] ? 'adventureLose' : 'adventureVictory'); ?>">
<div class="adventureReport">
    <div class="adventureHeader">
        <div class="headline">
            <div class="from">
                <i class="tribeIcon bigTribe<?= $vars['race']; ?>"> </i>
                <img class="roleIcon" src="img/svg/combat/svgAttack.svg" alt="">
                <h2><?= T("Auction", "Adventure"); ?></h2>
            </div>
            <div class="to">
                <svg viewBox="0 0 20 20" preserveAspectRatio="none">
                    <path d="M0 0L20 10L0 20z"></path>
                </svg>
            </div>
        </div>
    </div>
    <table class="additionalInformation">
        <?php if (!$vars['lose']): ?>
            <tbody class="infos">
            <tr>
                <td class="empty" colspan="12"></td>
            </tr>
            <tr>
                <th><?= T("Reports", "Information"); ?></th>
                <td class="dropItems" colspan="11">
                    <img src="img/x.gif" class="iExperience" alt="<?= T("Reports", "exp"); ?>:"
                         title="<?= T("Reports", "exp"); ?>:">+<?= $vars['exp']; ?>
                    <img src="img/x.gif" class="injury" alt="<?= T("Reports", "injury"); ?>:"
                         title="<?= T("Reports", "injury"); ?>:">-<?= $vars['injury']; ?>%
                </td>
            </tr>
            </tbody>
        <?php endif; ?>
        <tbody class="goods">
        <tr>
            <td class="empty" colspan="12"></td>
        </tr>
        <?php if ($vars['failed']): ?>
            <th><?= T("Reports", "Bounty"); ?></th>
            <td colspan="11">
                <?= T("Reports", "noValuableThingFound"); ?>
            </td>
        <?php elseif (!empty($vars['Bounty'])): ?>
            <tr>
                <th><?= T("Reports", "Bounty"); ?>:</th>
                <td colspan="11" <?= $vars['style']; ?>><?= $vars['Bounty']; ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <th><?= T("Reports", "Information"); ?></th>
                <td colspan="11"><?= T("Reports", "adventureFailed"); ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>