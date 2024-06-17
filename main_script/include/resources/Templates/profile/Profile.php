<h4 class="round">
    <?=T("Profile", "Details"); ?>
</h4>

<img class="heroImage"
     src="hero_body.php?uid=<?=$vars['uid']; ?>&amp;size=profile&amp;<?=$vars['heroHash']; ?>"
     alt="Hero">
<table cellpadding="1" cellspacing="1" id="details" class="transparent">
    <tbody>
    <tr>
        <th><?=T("Profile", "Rank"); ?></th>
        <td><?=$vars['rank']; ?></td>
    </tr>
    <tr>
        <th><?=T("Profile", "Tribe"); ?></th>
        <td><?=T("Global", "races." . $vars['race']); ?></td>
    </tr>
    <tr>
        <th><?=T("Profile", "Alliance"); ?></th>
        <td><?=$vars['alliance']; ?></td>
    </tr>
    <tr>
        <th><?=T("Profile", "Villages"); ?></th>
        <td><?=$vars['total_villages']; ?></td>
    </tr>
    <tr>
        <th><?=T("Profile", "Population"); ?></th>
        <td><?=$vars['total_pop']; ?></td>
    </tr>
    <?php if (isset($vars['age'])): ?>
        <tr>
            <th><?=T("Profile", "Age"); ?></th>
            <td><?=$vars['age']; ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($vars['gender'] != 0): ?>
        <tr>
            <th><?=T("Profile", "Gender"); ?></th>
            <td><?=$vars['gender'] == 1 ? T("Profile", "male") : T("Profile", "female"); ?></td>
        </tr>
    <?php endif; ?>
    <?php if (!empty($vars['location'])): ?>
        <tr>
            <th><?=T("Profile", "Location"); ?></th>
            <td><?=$vars['location']; ?></td>
        </tr>
    <?php endif; ?>
    <?php if (!empty($vars['language']) && $vars['uid'] > 2): ?>
        <tr>
            <th><?=T("Profile", "Language"); ?></th>
            <td class="flags">
                <img src="img/x.gif" class="flag_<?=$vars['language']; ?>" title="<?= $vars['language']; ?>"
                     alt="<?= $vars['language']; ?>">
            </td>
        </tr>
    <?php endif; ?>
    <?php if ($vars['showNote']): ?>
        <tr>
            <th class="valignTop"><?= T("Profile", "Note"); ?> <a href="#" id="playerNoteEditLink"
                                                                  title=""><?= T("Profile", "Edit"); ?></a>
            </th>
            <td id="playerNoteTextDropArea"><?= $vars['note']; ?></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="2" id="player_message-ignore-buttons-block"></td>
    </tr>
    </tbody>
</table>
<div class="clear"></div>
<h4 class="round"><?=T("Profile", "Description"); ?></h4>
<?php if ($vars['isAdmin']): ?>
    <div style="text-align: <?= (getDirection() == 'LTR' ? 'right' : 'left'); ?>">
        <a target="_editPlayer"
           href="admin.php?action=editPlayer&uid=<?= $vars['uid']; ?>">
            <?= getButton(['type' => 'button', 'class' => 'green'], [], 'Edit Player'); ?>
        </a>
    </div>
<?php endif; ?>
<div class="description description1"><?=$vars['desc1']; ?></div>
<div class="description description2"><?=$vars['desc2']; ?></div>
<div class="clear"></div>
<?= $vars['specialMedals']; ?>
<h4 class="round"><?=T("Profile", "Villages"); ?></h4>
<style type="text/css">
    <?php $gpack_url = get_gpack_cdn_mainPage_url();?>
    .reportButton {
        width: 16px;
        height: 16px;
        background-image: url("<?=$gpack_url;?>img_ltr/report/reportAction.png");
    <?=(getDirection() == 'LTR' ? 'left' : 'right');?>: 4 px;
    }

    .raidList {
        background-position: 0 -130px;
    }

    .warsim {
        background-position: 0 -78px;
    }

    td.buttons {
        padding: 2px 0 2px 2px;
        text-align: <?=(getDirection() == 'RTL' ? 'left' : 'right');?>;
        white-space: nowrap;
        width: 1%;
    }
</style>
<table cellpadding="1" cellspacing="1" id="villages">
    <thead>
    <tr>
        <th class="name"><?=T("Profile", "Name"); ?></th>
        <th class="oases"><?=T("Profile", "Oases"); ?></th>
        <th class="inhabitants"><?=T("Profile", "Inhabitants"); ?></th>
        <th class="coords"><?=T("Profile", "Coordinates"); ?></th>
        <?php if (getDisplay("profileHelperButtons")): ?>
            <th class="buttons"></th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?=$vars['villages']; ?>
    </tbody>
</table>
<script type="text/javascript">
    jQuery(function() {
        "use strict";
        var renderPlayerMessageIgnoreButtons = function () {
            var targetPlayer = '<?=$vars['uid'];?>';
            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: 'render_player_message_ignore_buttons',
                    params: {
                        targetPlayer: targetPlayer
                    }
                },

                onSuccess: function (response) {
                    if (response.result !== undefined) {
                        jQuery('#player_message-ignore-buttons-block').html(response.result);
                    }
                }
            });
        };
        jQuery('#player_message-ignore-buttons-block').on('click', function(event) {
            var target = jQuery(event.target);

            if (target.attr('id') !== 'ignore-player-button') {
                return;
            }

            var targetPlayer = target.attr('data-uid'),
                isIgnored = target.attr('data-player-ignored') !== 'false',
                method = isIgnored ? 'stop_ignore_target_player' : 'ignore_target_player';

            event.stopPropagation();

            Travian.ajax({
                data: {
                    cmd: 'ignoreList',
                    method: method,
                    renderPlayerMessageIgnoreButtons: true,
                    params: {
                        targetPlayer: targetPlayer
                    }
                },
                onSuccess: function(response) {
                    if (response.result !== undefined) {
                        jQuery('#player_message-ignore-buttons-block').html(response.result);
                    }
                }
            });
            return false;
        });

        renderPlayerMessageIgnoreButtons();
        <?php if($vars['showNote']):?>
        var playerNoteEditLink = jQuery('#playerNoteEditLink');
        if (playerNoteEditLink.length > 0) {
            playerNoteEditLink.DoubleClickPreventer = new Travian.DoubleClickPreventer();
            playerNoteEditLink.DoubleClickPreventer.timeout = 1000;
            playerNoteEditLink.on('click', function(e) {
                e.preventDefault();

                if (!playerNoteEditLink.DoubleClickPreventer.check()) {
                    return false;
                }
                new Travian.Dialog.Ajax({
                        data: {
                            cmd: 'playerNote',
                            hasNote: true,
                            affectedPlayerID: <?=$vars['uid'];?>,
                            action: 'edit'
                        },
                        context: 'playerNote',
                        buttonOk: false,
                        darkOverlay: true
                    }
                );
            });
        }
        <?php endif;?>
    });
</script>