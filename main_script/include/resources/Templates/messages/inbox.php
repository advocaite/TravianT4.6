<form method="post" action="messages.php" name="msg" id="messagesForm">
    <?php if (isset($vars['error']) and $vars['error']): ?>
        <p class="error"><?= $vars['error']; ?></p>
    <?php endif; ?>
    <div class="footer">
        <?php if ($vars['hasPermission']): ?>
            <div id="markAll">
                <input class="check" type="checkbox" id="sAll1" onclick="messagesFormSelectAll(this);">
                <span><label for="sAll1"><?= T("Messages", "select all"); ?></label></span>
            </div>
        <?php endif; ?>
        <?= $vars['nav']; ?>
        <div class="clear">&nbsp;</div>
    </div>
    <table cellpadding="1" cellspacing="1" id="overview" class="inbox">
        <thead>
        <tr>
            <th colspan="2"><?= T("Messages", "Subject"); ?></th>
            <th class="send"><?= T("Messages", "Sender"); ?></th>
            <th class="dat">
                <a href="messages.php?s=0&amp;t=0<?= $vars['recursive'] == 0 ? "&amp;o=1" : ''; ?>"
                   class="sorting <?= $vars['recursive'] ? "asc" : "desc"; ?>">
                    <?= T("Messages", "Sent at"); ?>&nbsp;
                    <img src="img/x.gif" alt="sort"/>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?= $vars['content']; ?>
        </tbody>
    </table>
    <div class="administration">
        <div class="footer">
            <?php if ($vars['hasPermission']): ?>
                <div id="markAll">
                    <input class="check" type="checkbox" id="sAll2" onclick="messagesFormSelectAll(this);">
                    <span><label for="sAll2"><?= T("Messages", "select all"); ?></label></span>
                </div>
            <?php endif; ?>
            <?= $vars['nav']; ?>
            <div class="clear"></div>
        </div>
        <div class="buttons">
            <?php if ($vars['hasPermission']): ?>
                <button type="submit" value="<?= T("Messages", "Mark as read"); ?>" name="bulkread" id="bulkread"
                        class="green ">
                    <div class="button-container addHoverClick">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?= T("Messages", "Mark as read"); ?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#bulkread')) {
                            jQuery('#bulkread').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "<?=T("Messages", "Mark as read");?>",
                                    "name": "bulkread",
                                    "id": "bulkread",
                                    "class": "green ",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": ""
                                }]);
                            });
                        }
                    });
                </script>
                <button type="submit" value="<?= T("Messages", "Delete"); ?>" name="delmsg" id="delmsg" class="green ">
                    <div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?= T("Messages", "Delete"); ?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#delmsg')) {
                            jQuery('#delmsg').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "<?=T("Messages", "Delete");?>",
                                    "name": "delmsg",
                                    "id": "delmsg",
                                    "class": "green ",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": ""
                                }]);
                            });
                        }
                    });
                </script>
            <?php if ($vars['goldClub']): ?>
                <button type="submit" value="Archive" name="archive" id="archive" class="green ">
                    <div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?= T("Messages", "Archive"); ?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#archive')) {
                            jQuery('#archive').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "Archive",
                                    "name": "archive",
                                    "id": "archive",
                                    "class": "green ",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": ""
                                }]);
                            });
                        }
                    });
                </script>
            <?php endif; ?>
            <?php endif; ?>
            <input type="hidden" name="s" value="0">
        </div>
    </div>
</form>
<?php if (isset($vars['InadmissibleMessage']) and $vars['InadmissibleMessage']): ?>
    <script type="text/javascript">
        jQuery(function () {
            var dialog = new Travian.Dialog.Dialog(
                {
                    buttonTextOk: '<?=T("Global", "General.ok");?>',
                    preventFormSubmit: true
                }
            );
            dialog.setContent('<?=T("Messages", "Inadmissible message");?>');
            dialog.show();
        });
    </script>
<?php endif; ?>
