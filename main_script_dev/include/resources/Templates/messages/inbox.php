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
				<button type="submit" value="bulkread" name="bulkread" id="bulkread" class="textButtonV1 green " version="textButtonV1"><?= T("Messages", "Mark as read"); ?></button>
                <script type="text/javascript">
					jQuery(function() {
						if (jQuery('button#bulkread')) {
							jQuery('button#bulkread').click(function (event) {
								jQuery(window).trigger('buttonClicked', [this, {
									"type": "submit",
									"value": "bulkread",
									"name": "bulkread",
									"id": "bulkread",
									"class": "textButtonV1 green ",
									"title": "<?= T("Messages", "Mark as read"); ?>",
									"confirm": "",
									"onclick": "",
									"version" : "textButtonV1"
								}]);
							});
						}
					});
				</script>
                <button type="submit" value="delmsg" name="delmsg" id="delmsg" class="textButtonV1 green " version="textButtonV1"><?= T("Messages", "Delete"); ?></button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#delmsg')) {
                            jQuery('#delmsg').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "delmsg",
                                    "name": "delmsg",
                                    "id": "delmsg",
                                    "class": "textButtonV1 green ",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": "",
									"version" : "textButtonV1"
                                }]);
                            });
                        }
                    });
                </script>
            <?php if ($vars['goldClub']): ?>
                <button type="submit" value="archive" name="archive" id="archive" class="textButtonV1 green " version="textButtonV1"><?= T("Messages", "Archive"); ?></button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#archive')) {
                            jQuery('#archive').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "Archive",
                                    "name": "archive",
                                    "id": "archive",
                                    "class": "textButtonV1 green ",
                                    "title": "",
                                    "confirm": "",
                                    "onclick": "",
									"version" : "textButtonV1"
                                }]);
                            });
                        }
                    });
                </script>
            <?php endif; ?>
            <?php endif; ?>
            <input type="hidden" name="s" value="0">
            <input type="hidden" name="t" value="0">
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
