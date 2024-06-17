<h4 class="round"><?=T("Alliance", "Kick player"); ?></h4>
<?php if ($vars['disallowKick']): ?>
<p class="warning"><?=T("Alliance", "Kicking/inviting is not allowed at this time");?></p>
<?php elseif ($vars['hasMembers']): ?>
    <form method="post" action="allianz.php?s=5&amp;o=2">
        <table cellpadding="1" cellspacing="1" class="option kick transparent">
            <tbody>
            <tr>
                <th><?=T("Alliance", "name"); ?>:</th>
                <td>
                    <select name="a_user" class="name dropdown"><?=$vars['members']; ?></select>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="option">
            <button type="submit" value="ok" name="s1" id="btn_ok" class="green "
                    title="<?=T("Alliance", "Select"); ?>">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("Alliance", "Select"); ?></div>
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
                                "title": "<?=T("Alliance", "Select");?>",
                                "confirm": "",
                                "onclick": ""
                            }]);
                        });
                    }
                });
            </script>

        </p>
    </form>
<?php endif; ?>