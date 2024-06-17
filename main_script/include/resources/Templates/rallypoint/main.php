<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'buildingRallyPoint',
           number: '<?=$vars['tt'];?>'
           },
           onSuccess: function(data)
           {
           if (data.success)
           {
           jQuery('.favor').removeClass('favorActive');
           jQuery('.favor.favorKey<?=$vars['tt'];?>').addClass('favorActive');
           }
           }
           });
           return false;
           "
   title="<?=$vars['favorText'];?>"
        >&nbsp;</a>

<div class="contentNavi subNavi ">
    <div
            title="<?=$vars['tabs'][0]['text'];?>"
            class="container <?=$vars['tt']==0 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 0 ? "favorActive" : '';?> favorKey0"
                >

            <a
                    id="<?=$vars['tabs'][0]['id'];?>" href="build.php?tt=0&amp;id=39" class="tabItem"
                    >
                <?=$vars['tabs'][0]['text'];?> <img src="img/x.gif" class="favorIcon"
                                        alt="<?=T("RallyPoint", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['tabs'][0]['id'];?>')) {
            jQuery('#<?=$vars['tabs'][0]['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['tt']==0 ? "active" : "normal";?>",
                    "title": "<?=$vars['tabs'][0]['text'];?>",
                    "target": false,
                    "id": "<?=$vars['tabs'][0]['id'];?>",
                    "href": "build.php?tt=0&amp;id=39",
                    "onclick": false,
                    "enabled": true,
                    "['text']": "<?=$vars['tabs'][0]['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['tabs'][0]['id'];?>"
                }]);

            });
        }
    </script>
    <?php if($vars['show']):?>
        <div
                title="<?=$vars['tabs'][1]['text'];?>"
                class="container <?=$vars['tt']==1 ? "active" : "normal";?>"
                >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    id="<?=$vars['tabs'][1]['text'];?>RallyPoint"
                    class="content favor <?=$vars['favorTabId'] == 1 ? "favorActive" : '';?> favorKey1"
                    >

                <a
                        id="<?=$vars['tabs'][1]['id'];?>" href="build.php?tt=1&amp;id=39" class="tabItem"
                        >
                    <?=$vars['tabs'][1]['text'];?> <img src="img/x.gif" class="favorIcon"
                                            alt="<?=T("RallyPoint", "This tab is set as favourite");?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['tabs'][1]['id'];?>')) {
                jQuery('#<?=$vars['tabs'][1]['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['tt']==1 ? "active" : "normal";?>",
                        "title": "<?=$vars['tabs'][1]['text'];?>",
                        "target": false,
                        "id": "<?=$vars['tabs'][1]['id'];?>",
                        "href": "build.php?tt=1&amp;id=39",
                        "onclick": false,
                        "enabled": true,
                        "['text']": "<?=$vars['tabs'][1]['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "<?=$vars['tabs'][1]['text'];?>RallyPoint",
                        "buttonIdentifier": "<?=$vars['tabs'][1]['id'];?>"
                    }]);

                });
            }
        </script>

        <div
                title="<?=$vars['tabs'][2]['text'];?>"
                class="container <?=$vars['tt']==2 ? "active" : "normal";?>"
                >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$vars['favorTabId'] == 2 ? "favorActive" : '';?> favorKey2"
                    >

                <a
                        id="<?=$vars['tabs'][2]['id'];?>" href="build.php?tt=2&amp;id=39" class="tabItem"
                        >
                    <?=$vars['tabs'][2]['text'];?> <img src="img/x.gif" class="favorIcon"
                                            alt="<?=T("RallyPoint", "This tab is set as favourite");?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['tabs'][2]['id'];?>')) {
                jQuery('#<?=$vars['tabs'][2]['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['tt']==2 ? "active" : "normal";?>",
                        "title": "<?=$vars['tabs'][2]['text'];?>",
                        "target": false,
                        "id": "<?=$vars['tabs'][2]['id'];?>",
                        "href": "build.php?tt=2&amp;id=39",
                        "onclick": false,
                        "enabled": true,
                        "['text']": "<?=$vars['tabs'][2]['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['tabs'][2]['id'];?>"
                    }]);

                });
            }
        </script>

        <div
                title="<?=$vars['tabs'][3]['text'];?>"
                class="container <?=$vars['tt']==3 ? "active" : "normal";?>"
                >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$vars['favorTabId'] == 3 ? "favorActive" : '';?> favorKey3"
                    >

                <a
                        id="<?=$vars['tabs'][3]['id'];?>" href="build.php?tt=3&amp;id=39" class="tabItem"
                        >
                    <?=$vars['tabs'][3]['text'];?> <img src="img/x.gif" class="favorIcon"
                                            alt="<?=T("RallyPoint", "This tab is set as favourite");?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['tabs'][3]['id'];?>')) {
                jQuery('#<?=$vars['tabs'][3]['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['tt']==3 ? "active" : "normal";?>",
                        "title": "<?=$vars['tabs'][3]['text'];?>",
                        "target": false,
                        "id": "<?=$vars['tabs'][3]['id'];?>",
                        "href": "build.php?tt=3&amp;id=39",
                        "onclick": false,
                        "enabled": true,
                        "['text']": "<?=$vars['tabs'][3]['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['tabs'][3]['id'];?>"
                    }]);

                });
            }
        </script>
    <?php endif;?>
    <div
            title="<?=$vars['tabs'][99]['hasClub'] ? $vars['tabs'][99]['text'] : $vars['tabs'][99]['title'];?>"
            class="container <?=$vars['tabs'][99]['hasClub'] ? '' : 'gold';?> <?=$vars['tt']==99 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favorTabId'] == 99 ? "favorActive" : '';?> favorKey99"
                >

            <a id="<?=$vars['tabs'][99]['id'];?>" href="<?=$vars['tabs'][99]['hasClub'] ? 'build.php?tt=99&amp;id=39' : '#';?>" class="tabItem"
                    >
                <?=$vars['tabs'][99]['text'];?>
                <img src="img/x.gif" class="favorIcon" alt="<?=T("RallyPoint", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <?php if( $vars['tabs'][99]['hasClub']):?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['tabs'][99]['id'];?>')) {
                jQuery('#<?=$vars['tabs'][99]['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['tt']==99 ? "active" : "normal";?>",
                        "title": "<?=$vars['tabs'][99]['text'];?>",
                        "target": false,
                        "id": "<?=$vars['tabs'][99]['id'];?>",
                        "href": "build.php?tt=99&amp;id=39",
                        "onclick": false,
                        "enabled": true,
                        "['text']": "<?=$vars['tabs'][99]['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['tabs'][99]['id'];?>"
                    }]);

                });
            }
        </script>
    <?php else:?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['tabs'][99]['id'];?>')) {
                jQuery('#<?=$vars['tabs'][99]['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "gold normal",
                        "title": "<?=$vars['tabs'][99]['title'];?>",
                        "target": false,
                        "id": "<?=$vars['tabs'][99]['id'];?>",
                        "href": "#",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['tabs'][99]['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": {
                            "featureKey": "raidList",
                            "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                        },
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['tabs'][99]['id'];?>"
                    }]);

                });
            }
        </script>

    <?php endif;?>

    <div class="clear"></div>
</div>


<?=$vars['content'];?>