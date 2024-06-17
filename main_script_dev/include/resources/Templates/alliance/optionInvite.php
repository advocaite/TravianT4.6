<h4 class="round"><?=T("Alliance", "Invite a player into the alliance");?></h4>
<?php if ($vars['disallowInvite']): ?>
    <p class="warning"><?=T("Alliance", "Kicking/inviting is not allowed at this time");?></p>
<?php else: ?>
<form method="post" action="allianz.php?s=5&amp;o=4">
    <table cellpadding="1" cellspacing="1" class="option invite transparent">
        <tbody>
        <tr>
            <th>
                <?=T("Alliance", "name");?>:
            </th>
            <td>
                <input class="name text" type="text" name="a_name" id="enterPlayerName" maxlength="20">
            </td>
        </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        jQuery(function() {
            new Travian.Game.AutoCompleter.UserName(jQuery('input#enterPlayerName'));
        });
    </script>
    <p class="option">
        <input type="hidden" name="a" value="4">
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green ">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Alliance", "invite");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#btn_ok')) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "ok",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green ",
                            "title": "Invite",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </p>
    <?php if(isset($vars['error'])):?>
        <p class="error option"><?=$vars['error'];?></p>
    <?php elseif(isset($vars['note'])):?>
        <p class="note option"><?=$vars['note'];?></p>
    <?php endif;?>
</form>
<h4 class="round"><?=T("Alliance", "Invitations");?>:</h4>
<table cellpadding="1" cellspacing="1" class="option invitations transparent">
    <tbody>
    <?=$vars['invitations'];?>
    </tbody>
</table>
<?php endif;?>