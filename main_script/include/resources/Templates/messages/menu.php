<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'messages',
           number: '<?=$vars['selectedTab'];?>'
           },
           onSuccess: function(data)
           {
           if (data.success)
           {
           jQuery('.favor').removeClass('favorActive');
           jQuery('.favor.favorKey<?=$vars['selectedTab'];?>').addClass('favorActive');
           }
           }
           });
           return false;
           "
   title="<?=$vars['favorText'];?>"
>&nbsp;</a>
<?php $favorTabId = \Core\Session::getInstance()->getFavoriteTab("messages");?>
<div class="contentNavi subNavi ">
    <div
            title=""
            class="container <?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 0 ? "favorActive" : '';?> favorKey0"
                >

            <a
                    id="<?=$vars['Inbox'];?>" href="messages.php?t=0" class="tabItem"
                    >
                <?=T("Messages", "Inbox");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Inbox'];?>')) {
            jQuery('#<?=$vars['Inbox'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Inbox'];?>",
                    "href": "messages.php?t=0",
                    "onclick": false,
                    "enabled": true,
                    "text": "Inbox",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Inbox'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 1 ? "favorActive" : '';?> favorKey1"
                >

            <a
                    id="<?=$vars['Write'];?>" href="messages.php?t=1" class="tabItem"
                    >
                <?=T("Messages", "Write");?>  <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>                                              </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Write'];?>')) {
            jQuery('#<?=$vars['Write'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Write'];?>",
                    "href": "messages.php?t=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "Write",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Write'];?>"
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
                class="content favor <?=$favorTabId == 2 ? "favorActive" : '';?> favorKey2"
                >

            <a
                    id="<?=$vars['Sent'];?>" href="messages.php?t=2" class="tabItem"
                    >
                <?=T("Messages", "Sent");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>                                                       </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Sent'];?>')) {
            jQuery('#<?=$vars['Sent'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Sent'];?>",
                    "href": "messages.php?t=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "Sent",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Sent'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=$vars['goldClub'] ? T("Messages", "Archive") : $vars['ArchiveGoldClubTitle'];?>"
            class="container <?=$vars['goldClub'] ? '' : 'gold';?> <?=$vars['selectedTab'] == 3 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$favorTabId == 3 ? "favorActive" : '';?> favorKey3">
            <a id="<?=$vars['Archive'];?>" href="<?=$vars['goldClub'] ? 'messages.php?t=3' : '#';?>" class="tabItem">
                <?=T("Messages", "Archive");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <?php if($vars['goldClub']):?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['Archive'];?>')) {
                jQuery('#<?=$vars['Archive'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['selectedTab'] == 3 ? "active" : "normal";?>",
                        "title": "<?= T("Messages", "Archive");?>",
                        "target": false,
                        "id": "<?=$vars['Archive'];?>",
                        "href": "messages.php?t=3",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?= T("Messages", "Archive");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Archive'];?>"
                    }]);

                });
            }
        </script>
    <?php else:?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['Archive'];?>')) {
                jQuery('#<?=$vars['Archive'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "gold normal",
                        "title": "<?=$vars['ArchiveGoldClubTitle'];?>",
                        "target": false,
                        "id": "<?=$vars['Archive'];?>",
                        "href": "#",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Messages", "Archive");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": {
                            "featureKey": "messageArchive",
                            "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                        },
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Archive'];?>"
                    }]);

                });
            }
        </script>

    <?php endif;?>


    <div
            title=""
            class="container <?=$vars['selectedTab'] == 4 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 4 ? "favorActive" : '';?> favorKey4"
                >

            <a
                    id="<?=$vars['Notes'];?>" href="messages.php?t=4" class="tabItem"
                    >
                <?=T("Messages", "Notes");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Notes'];?>')) {
            jQuery('#<?=$vars['Notes'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 4 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Notes'];?>",
                    "href": "messages.php?t=4",
                    "onclick": false,
                    "enabled": true,
                    "text": "Notes",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Notes'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 5 ? "favorActive" : '';?> favorKey5"
                >

            <a
                    id="<?=$vars['ignoredPlayers'];?>" href="messages.php?t=5" class="tabItem"
                    ><?=T("Messages", "Ignored players");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['ignoredPlayers'];?>')) {
            jQuery('#<?=$vars['ignoredPlayers'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['ignoredPlayers'];?>",
                    "href": "messages.php?t=5",
                    "onclick": false,
                    "enabled": true,
                    "text": "Ignored players",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['ignoredPlayers'];?>"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>

<script>
    function messagesFormSelectAll(checkbox) {
        jQuery('#messagesForm').find('input[type=checkbox]').each(function (index, element) {
            element.checked = checkbox.checked;
        }, checkbox);
    }
</script>