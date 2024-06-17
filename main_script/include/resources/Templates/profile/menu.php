<div class="contentNavi subNavi ">
    <div
            title=""
            class="container <?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
                >

            <a
                    id="<?=$vars['buttonId1'];?>" href="spieler.php?s=1" class="tabItem"
                    >
                <?=T("Profile", "Overview");?>                                                            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['buttonId1'];?>')) {
            jQuery('#<?=$vars['buttonId1'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['buttonId1'];?>",
                    "href": "spieler.php?s=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Profile", "Overview");?>	",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['buttonId1'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
                >
            <?php if(!$vars['banned']):?>
            <a id="<?=$vars['buttonId2'];?>" href="spieler.php?s=2" class="tabItem">
                <?=T("Profile", "Edit Profile");?>
            </a>
            <?php else:?>
                <span id="<?=$vars['buttonId2'];?>" href="spieler.php?s=2" class="tabItem">
                    <?=T("Profile", "Edit Profile");?>
                </span>            <?php endif;?>
        </div>
    </div>
    <script type="text/javascript">
        if (jQuery('#<?=$vars['buttonId2'];?>')) {
            jQuery('#<?=$vars['buttonId2'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['buttonId2'];?>",
                    "href": "spieler.php?s=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Profile", "Edit Profile");?>		",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['buttonId2'];?>"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>
