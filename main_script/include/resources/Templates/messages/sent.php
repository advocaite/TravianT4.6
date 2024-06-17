
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
                <button type="submit" value="<?=T("Messages", "Delete");?>" name="delmsg" id="delmsg" class="green ">
                    <div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?=T("Messages", "Delete");?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function() {
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
            <?php endif;?>
            <input type="hidden" name="s" value="0" />
        </div>
    </div>