<form method="post" action="messages.php" name="msg" id="messagesForm">
    <input type="hidden" name="t" value="3">
    <table cellpadding="1" cellspacing="1" id="overview" class="inbox">
        <thead>
        <tr>
            <th colspan="2"><?=T("Messages", "Subject");?></th>
            <th class="send"><?=T("Messages", "Sender");?></th>
            <th class="dat">
                <a href="messages.php?s=0&amp;t=3<?=$vars['recursive']==0 ? "&amp;o=1" : '';?>"
                   class="sorting <?=$vars['recursive'] ? "asc" : "desc";?>">
                    <?=T("Messages", "Sent at");?>&nbsp;
                    <img src="img/x.gif" alt="sort"/>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['content'];?>
        </tbody>
    </table>
    <div class="administration">
		<div class="footer">
			<?php if($vars['hasPermission']):?>
				<div id="markAll">
					<input class="check" type="checkbox" id="sAll" name="sAll" onclick="messagesFormSelectAll(this);">&nbsp;<?=T("Messages", "select all");?>
				</div>
			<?php endif;?>
			<?=$vars['nav'];?>
			<div class="clear"></div>
			<div class="buttons">
            <?php if($vars['hasPermission']):?>
				<button type="submit" value="delmsg" name="delmsg" id="delmsg" class="textButtonV1 green " version="textButtonV1"><?= T("Messages", "Delete"); ?></button>
                <script type="text/javascript">
                    jQuery(function() {
                        if (jQuery('#delmsg')) {
                            jQuery('#delmsg').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "<?=T("Messages", "Delete");?>",
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
            <?php if($vars['goldClub']):?>
                <button type="submit" value="recover" name="recover" id="recover" class="textButtonV1 green " version="textButtonV1"><?= T("Messages", "Recover"); ?></button>
                <script type="text/javascript">
                    jQuery(function() {
                        if (jQuery('#recover')) {
                            jQuery('#recover').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "recover",
                                    "name": "recover",
                                    "id": "recover",
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
            <?php endif;?>
            <?php endif;?>
            <input type="hidden" name="s" value="0">
        </div>
		</div>
	</div>
</form>
<script type="text/javascript">
    jQuery(function() {
    });
</script>
