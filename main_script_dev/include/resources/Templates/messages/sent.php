
<script>
    function messagesFormSelectAll(checkbox) {
        jQuery('#messagesForm').find('input[type=checkbox]').each(function (index, element) {
            element.checked = checkbox.checked;
        }, checkbox);
    }
</script>

<form id="messagesForm" method="post" action="messages.php" name="msg">
    <input type="hidden" name="t" value="2" />
    <input type="hidden" name="s" value="0" />
    <div class="footer">
        <?php if($vars['hasPermission']):?>
            <div class="markAll">
                <input class="check" type="checkbox" id="sAll1" onclick="messagesFormSelectAll(this);"/>
                <span><label for="sAll1"><?=T("Messages", "select all");?></label></span>
            </div>
        <?php endif;?>
        <?=$vars['nav'];?>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1" id="overview" class="inbox">
        <thead>
        <tr>
            <th colspan="2"><?=T("Messages", "Subject");?></th>
            <th class="send"><?=T("Messages", "Recipient");?></th>
            <th class="dat">
                <a href="messages.php?s=0&amp;t=2<?=$vars['recursive']==0 ? "&amp;o=1" : '';?>"
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
    <div class="footer">
        <?php if($vars['hasPermission']):?>
            <div id="markAll">
                <input class="check" type="checkbox" id="sAll2" onclick="messagesFormSelectAll(this);"/>
                <span><label for="sAll2"><?=T("Messages", "select all");?></label></span>
            </div>
        <?php endif;?>
        <?=$vars['nav'];?>
        <div class="clear"></div>
    </div>
    <div class="administration">
        <div class="buttons">
            <?php if($vars['hasPermission']):?>
                <button type="submit" value="delmsg" name="delmsg" id="delmsg" class="textButtonV1 green " version="textButtonV1"><?=T("Messages", "Delete");?></button>
				<script type="text/javascript">
                    jQuery(function() {
                        if (jQuery('#delmsg')) {
                            jQuery('#delmsg').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "delmsg",
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
            <?php endif;?>
            <input type="hidden" name="s" value="0" />
        </div>
    </div>