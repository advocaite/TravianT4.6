<?php if($vars['showTabs']):?>
<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'buildingTreasury',
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

<div class="contentNavi subNavi ">
    <div
            title="<?=T("Treasury", "Management");?>"
            class="container <?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 0 ? 'favorActive': '';?> favorKey0"
                >

            <a
                    id="<?=$vars['Management'];?>" href="build.php?s=0&amp;id=<?=$vars['index'];?>" class="tabItem"
                    >
                <?=T("Treasury", "Management");?> <img src="img/x.gif" class="favorIcon"
                                                       alt="<?=T("Treasury", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Management'];?>')) {
            jQuery('#<?=$vars['Management'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>",
                    "title": "<?=T("Treasury", "Management");?>",
                    "target": false,
                    "id": "<?=$vars['Management'];?>",
                    "href": "build.php?s=0&amp;id=<?=$vars['index'];?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Treasury", "Management");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Management'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=T("Treasury", "Artefacts in your area");?>"
            class="container <?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 5 ? 'favorActive' : '';?> favorKey5"
                >

            <a
                    id="<?=$vars['artifactsInYourArea'];?>" href="build.php?s=5&amp;id=<?=$vars['index'];?>" class="tabItem"
                    >
                <?=T("Treasury", "Artefacts in your area");?> <img src="img/x.gif" class="favorIcon"
                                                                   alt="<?=T("Treasury", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['artifactsInYourArea'];?>')) {
            jQuery('#<?=$vars['artifactsInYourArea'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>",
                    "title": "<?=T("Treasury", "Artefacts in your area");?>",
                    "target": false,
                    "id": "<?=$vars['artifactsInYourArea'];?>",
                    "href": "build.php?s=5&amp;id=<?=$vars['index'];?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Treasury", "Artefacts in your area");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['artifactsInYourArea'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=T("Treasury", "Small artefacts");?>"
            class="container <?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 1 ? 'favorActive' : '';?> favorKey1"
                >

            <a
                    id="<?=$vars['smallArtifact'];?>" href="build.php?s=1&amp;id=<?=$vars['index'];?>" class="tabItem"
                    >
                <?=T("Treasury", "Small artefacts");?> <img src="img/x.gif" class="favorIcon"
                                                            alt="<?=T("Treasury", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['smallArtifact'];?>')) {
            jQuery('#<?=$vars['smallArtifact'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>",
                    "title": "<?=T("Treasury", "Small artefacts");?>",
                    "target": false,
                    "id": "<?=$vars['smallArtifact'];?>",
                    "href": "build.php?s=1&amp;id=<?=$vars['index'];?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Treasury", "Small artefacts");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['smallArtifact'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=T("Treasury", "Large artefacts");?>"
            class="container <?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 2 ? 'favorActive' : '';?> favorKey2"
                >

            <a
                    id="<?=$vars['largeArtifact'];?>" href="build.php?s=2&amp;id=<?=$vars['index'];?>" class="tabItem"
                    >
                <?=T("Treasury", "Large artefacts");?> <img src="img/x.gif" class="favorIcon"
                                                            alt="<?=T("Treasury", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['largeArtifact'];?>')) {
            jQuery('#<?=$vars['largeArtifact'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>",
                    "title": "<?=T("Treasury", "Large artefacts");?>",
                    "target": false,
                    "id": "<?=$vars['largeArtifact'];?>",
                    "href": "build.php?s=2&amp;id=<?=$vars['index'];?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Treasury", "Large artefacts");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['largeArtifact'];?>"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>

<?php endif;?>
<?=$vars['content'];?>