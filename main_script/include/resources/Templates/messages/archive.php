<form method="post" action="messages.php" name="msg">
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
        <?php if($vars['hasPermission']):?>
            <div class="checkAll">
                <input class="check" type="checkbox" id="sAll" name="sAll" onclick="reportsFormSelectAll(this);">&nbsp;<?=T("Messages", "select all");?>
            </div>
        <?php endif;?>
        <?=$vars['nav'];?>
        <div class="clear"></div>
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
            <?php if($vars['goldClub']):?>
                <button type="submit" value="recover" name="recover" id="recover" class="green ">
                    <div class="button-container addHoverClick ">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?=T("Messages", "Recover");?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function() {
                        if (jQuery('#recover')) {
                            jQuery('#recover').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "value": "recover",
                                    "name": "recover",
                                    "id": "recover",
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
            <?php endif;?>
            <input type="hidden" name="s" value="0">
        </div>
    </div>
</form>
<script type="text/javascript">
    jQuery(function() {
    });
</script>
