<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'alliance',
           number: '<?=$vars['selectedTabId'];?>'
           },
           onSuccess: function(data)
           {
           if (data.success)
           {
           jQuery('.favor').removeClass('favorActive');
           jQuery('.favor.favorKey<?=$vars['selectedTabId'];?>').addClass('favorActive');
           }
           }
           });
           return false;
           "
   title="<?=$vars['favorText'];?>"
        >&nbsp;</a>
<div class="contentNavi subNavi ">
    <div
            class="container <?=$vars['selectedTabId']==7 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 7 ? "favorActive" : '';?> favorKey7"
                >

            <a
                    id="<?=($button_id = get_button_id());?>" href="allianz.php?s=7<?=$vars['isMyAlliance'] ? '' : ('&aid=' . $vars['aid']);?>"
                    class="tabItem"
                    >
                <?=T("Alliance", "Overview");?> <img src="img/x.gif" class="favorIcon"
                                                     alt="<?=T("Global", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==7 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Overview");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=7<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Overview");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div
            class="container <?=$vars['selectedTabId']==1 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 1 ? "favorActive" : '';?> favorKey1"
                >

            <a
                    id="<?=($button_id = get_button_id());?>" href="allianz.php?s=1<?=$vars['isMyAlliance'] ? '' : ('&aid=' . $vars['aid']);?>" class="tabItem"
                    >
                <?=T("Alliance", "Profile");?> <img src="img/x.gif" class="favorIcon"
                                                    alt="<?=T("Alliance", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==1 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Profile");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=1<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Profile");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div
            class="container <?=$vars['selectedTabId']==3 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 3 ? "favorActive" : '';?> favorKey3"
                >

            <a
                    id="<?=($button_id = get_button_id());?>" href="allianz.php?s=3<?=$vars['isMyAlliance'] ? '' : ('&aid=' . $vars['aid']);?>" class="tabItem"
                    >
                <?=T("Alliance", "Attacks");?> <img src="img/x.gif" class="favorIcon"
                                                    alt="<?=T("Alliance", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==3 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Attacks");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=3<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Attacks");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div
            class="container <?=$vars['selectedTabId']==8 ? "active" : "normal";?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 8 ? "favorActive" : '';?> favorKey8"
        >

            <a
                    id="<?=($button_id = get_button_id());?>" href="allianz.php?s=8<?=$vars['isMyAlliance'] ? '' : ('&aid=' . $vars['aid']);?>" class="tabItem"
            >
                <?=T("Alliance", "Bonuses");?> <img src="img/x.gif" class="favorIcon"
                                                            alt="<?=T("Alliance", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>
    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==8 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Bonuses");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=8<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Bonuses");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>





    <div
            class="container <?=$vars['selectedTabId']==2 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 2 ? "favorActive" : '';?> favorKey2"
                >

            <a
                    id="<?=($button_id = get_button_id());?>" href="<?=$vars['ForumLink'];?>" class="tabItem"
                    >
                <?=T("Alliance", "Forum");?> <img src="img/x.gif" class="favorIcon"
                                                  alt="<?=T("Alliance", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==2 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Forum");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=2<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Forum");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div
            class="container <?=$vars['selectedTabId']==5 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 5 ? "favorActive" : '';?> favorKey5"
                >

            <a
                    id="<?=($button_id = get_button_id());?>" href="allianz.php?s=5<?=$vars['isMyAlliance'] ? '' : ('&aid=' . $vars['aid']);?>" class="tabItem"
                    >
                <?=T("Alliance", "Options");?> <img src="img/x.gif" class="favorIcon"
                                                    alt="<?=T("Alliance", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId']==5 ? "active" : "normal";?>",
                    "title": "<?=T("Alliance", "Forum");?>",
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "allianz.php?s=5<?=$vars['isMyAlliance'] ? "" : ('&aid=' . $vars['aid']);?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Alliance", "Options");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div class="clear"></div>
</div>
