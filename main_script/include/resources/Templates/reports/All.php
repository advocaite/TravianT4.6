<form method="post" action="reports.php?t=<?=$vars['selectedTabIndex'];?>" name="msg" id="reportsForm">
    <?php if(isset($vars['allCategories'][$vars['selectedTabId']]) && sizeof($vars['allCategories'][$vars['selectedTabId']])):?>
    <div class="boxes boxesColor gray reportFilter">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <?php
            $x = 1;
            foreach($vars['allCategories'][$vars['selectedTabId']] as $category){
                $title = T("Reports", "reportTypes.$category");
                $active = in_array($category, $vars['customCategories'][$vars['selectedTabId']]);
                echo '<button type="button" class="iconFilter '.($active ? 'iconFilterActive' : '').'" title="'.$title.'" onclick="window.location.href = \'reports.php?t='.$vars['selectedTabId'].'&opt='.base64_encode(base64_encode($x)).'\'; return false;" alt="'.$title.'"><img src="img/x.gif" class="iReport iReport'.$category.'" alt="iReport iReport'.$category.'" /></button>';
                $x *= 2;
            }
            ?>
        </div>
    </div>
    <?php endif;?>
    <input type="hidden" name="page" value="<?=$vars['page'];?>">
    <div class="footer">
        <?php if($vars['hasPermission']):?>
            <div id="markAll">
                <input class="check" type="checkbox" id="sAll1" onclick="reportsFormSelectAll(this);">
                <span><label for="sAll1"><?=T("Reports", "select all");?></label></span>
            </div>
        <?php endif;?>
        <?=$vars['navigator'];?>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1" id="overview" class="row_table_data">
        <thead>
        <tr>
            <th colspan="2">
                <?=T("Reports", "Subject");?>:
            </th>
            <th class="dat">
                <a href="reports.php?s=0&amp;t=<?=$vars['selectedTabId'];?><?=$vars['recursive']==0 ? "&amp;o=1" : '';?>"
                   class="sorting <?=$vars['recursive'] ? "asc" : "desc";?>">
                    <?=T("Reports", "Sent");?>&nbsp;
                    <img src="img/x.gif" alt="sort"/>
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['reports'];?>
        </tbody>
    </table>
    <div class="footer">
        <?php if($vars['hasPermission']):?>
            <div id="markAll">
                <input class="check" type="checkbox" id="sAll2" onclick="reportsFormSelectAll(this);">
                <span><label for="sAll2"><?=T("Reports", "select all");?></label></span>
            </div>
        <?php endif;?>
        <?=$vars['navigator'];?>
        <div class="clear"></div>
    </div>

    <?php if($vars['hasPermission']):?>
        <button type="submit" value="<?=T("Reports", "Mark as read");?>" title="<?=T("Reports", "Mark as read");?>"
                name="mark_as_read" id="mark_as_read" class="green ">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Reports", "Mark as read");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#mark_as_read')) {
                    jQuery('#mark_as_read').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Reports", "Mark as read");?>",
                            "name": "mark_as_read",
                            "id": "mark_as_read",
                            "class": "green ",
                            "title": "<?=T("Reports", "Mark as read");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
        <button type="submit" value="<?=T("Reports", "Delete");?>" name="del" id="del" class="green "
                title="<?=T("Reports", "Delete");?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Reports", "Delete");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#del')) {
                    jQuery('#del').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Reports", "Delete");?>",
                            "name": "del",
                            "id": "del",
                            "class": "green ",
                            "title": "<?=T("Reports", "Delete");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
        <input type="hidden" name="s" value="0"/>

    <?php if($vars['selectedTabId'] == 5):?>
        <button type="submit" value="<?=T("Reports", "Recover");?>" name="start" id="start" class="green "
                title="<?=T("Reports", "Recover");?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Reports", "Recover");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#start')) {
                    jQuery('#start').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Reports", "Recover");?>",
                            "name": "start",
                            "id": "start",
                            "class": "green ",
                            "title": "<?=T("Reports", "Recover");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
        <?php elseif($vars['goldClub']):?>
        <button type="submit" value="<?=T("Reports", "Archive");?>" name="archive" id="archive" class="green "
                title="<?=T("Reports", "Archive");?>">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?=T("Reports", "Archive");?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#archive')) {
                    jQuery('#archive').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Reports", "Archive");?>",
                            "name": "archive",
                            "id": "archive",
                            "class": "green ",
                            "title": "<?=T("Reports", "Archive");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    <?php endif;?>
    <?php endif;?>
    <?=$vars['inboxSize'];?>
</form>