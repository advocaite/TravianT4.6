<?php
use Model\ArtefactsModel;
$disAllowKick = getGame("disallowAllianceKickAfterWWRelease") && ArtefactsModel::wwPlansReleased();
$disAllowInvite = getGame("disallowAllianceInviteAfterWWRelease") && ArtefactsModel::wwPlansReleased();
?>
<?php if ($vars['options']['total'] > 0): ?>
    <h4 class="round"><?=T("Alliance", "Settings"); ?></h4>
    <ul class="options">
        <?php if ($vars['options']['perm'][0]): ?>
            <li>
                <a class="a arrow" href="allianz.php?s=5&amp;o=100"><?=T("Alliance", "Change name"); ?></a>
            </li>
            <li>
                <a class="a arrow"
                   href="allianz.php?s=5&amp;o=3"><?=T("Alliance", "Change alliance description"); ?></a>
            </li>
            <li>
                <a class="a arrow"
                   href="allianz.php?s=5&amp;o=7"><?=T("Alliance", "Edit internal info page"); ?></a>
            </li>
        <?php endif; ?>
        <?php if ($vars['options']['perm'][1]): ?>
            <li>
                <a class="a arrow" href="allianz.php?s=5&amp;o=1"><?=T("Alliance", "Assign to position"); ?></a>
            </li>
        <?php endif; ?>
        <?php if ($vars['options']['perm'][2]): ?>
            <li>
                <a class="a arrow" href="allianz.php?s=5&amp;o=5"><?=T("Alliance", "Link to the forum"); ?></a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<h4 class="round"><?=T("Alliance", "Actions"); ?></h4>
<ul class="options">
    <?php if ($vars['options']['perm'][3]): ?>
        <?php if ($vars['finish']): ?>
            <li>
                <a class="a arrow disabled"
                   title="<?=T("Alliance", "InvitesAreClosed"); ?>"><?=T("Alliance", "Invite a player into the alliance"); ?></a>
            </li>
        <?php elseif ($disAllowInvite): ?>
            <li>
                <a class="a arrow disabled"
                   title="<?=T("Alliance", "Kicking/inviting is not allowed at this time");?>"><?=T("Alliance", "Kick player"); ?></a>
            </li>
        <?php else: ?>
            <li>
                <a class="a arrow"
                   href="allianz.php?s=5&amp;o=4"><?=T("Alliance", "Invite a player into the alliance"); ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($vars['options']['perm'][4]): ?>
        <li>
            <a class="a arrow" href="allianz.php?s=5&amp;o=6"><?=T("Alliance", "Alliance diplomacy"); ?></a>
        </li>
    <?php endif; ?>
    <?php if ($vars['options']['perm'][5]): ?>
        <?php if ($vars['finish']): ?>
            <li>
                <a class="a arrow disabled"
                   title="<?=T("Alliance", "Cant kick player"); ?>"><?=T("Alliance", "Kick player"); ?></a>
            </li>
        <?php elseif ($disAllowKick): ?>
            <li>
                <a class="a arrow disabled"
                   title="<?=T("Alliance", "Kicking/inviting is not allowed at this time");?>"><?=T("Alliance", "Kick player"); ?></a>
            </li>
        <?php else: ?>
            <li>
                <a class="a arrow" href="allianz.php?s=5&amp;o=2"><?=T("Alliance", "Kick player"); ?></a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
    <li>
        <?php if($vars['hasEmbassy']):?>
        <a class="a arrow" href="allianz.php?s=5&amp;o=11"><?=T("Alliance", "Quit alliance"); ?></a>
            <?php else:?>
            <a class="a arrow disabled" href="#" title="<?=T("Alliance", "In order to quit alliance you need an embassy");?>"><?=T("Alliance", "Quit alliance"); ?></a>
        <?php endif;?>

    </li>
</ul>
<div class="clear"></div>