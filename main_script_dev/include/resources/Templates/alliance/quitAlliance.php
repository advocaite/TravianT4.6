<h4 class="round"><?=T("Alliance", "Quit alliance");?></h4>
<?php if($vars['confirmed']):?>
    <p class="error option">
        <?=T("Alliance", "you just left your alliance");?>
    </p>
<?php else:?>
    <p class="option"><?=T("Alliance", "In order to quit the alliance you have to enter your password gain for safety reasons");?></p>
    <form method="post" action="allianz.php?s=5&amp;o=11">
        <table cellpadding="1" cellspacing="1" class="option quit transparent">
            <tbody>
            <tr>
                <th>
                    <?=T("Alliance", "Password");?>:
                </th>
                <td>
                    <input class="pass text" type="password" name="pw" maxlength="20">
                </td>
            </tr>
            </tbody>
        </table>

        <p class="option">
            <input type="hidden" name="a" value="11">
            <button type="submit" value="ok" name="s1" id="btn_ok" class="green "
                    title="<?=T("Alliance", "Confirm");?>">
                <div class="button-container addHoverClick ">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("Alliance", "Confirm");?></div>
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
                                "title": "<?=T("Alliance", "Confirm");?>",
                                "confirm": "",
                                "onclick": ""
                            }]);
                        });
                    }
                });
            </script>
        </p>
    </form>
    <p class="error option">
        <?=$vars['error'];?>
    </p>
<?php endif;?>