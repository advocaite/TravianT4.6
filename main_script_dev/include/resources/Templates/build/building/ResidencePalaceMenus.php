<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'buildingExpansion',
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
            title=""
            class="container <?=$vars['selectedTabId'] == 0 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 0 ? 'favorActive' : '';?> favorKey0"
                >

            <a
                    id="<?=$vars['Management'];?>" href="build.php?s=0&amp;id=<?=$vars['buildingIndex'];?>" class="tabItem"
                    >
                <?=T("ResidencePalace", "Management");?> <img src="img/x.gif" class="favorIcon"
                                                              alt="<?=T("ResidencePalace", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Management'];?>')) {
            jQuery('#<?=$vars['Management'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId'] == 0 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Management'];?>",
                    "href": "build.php?s=0&amp;id=28",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("ResidencePalace", "Management");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Management'];?>"
                }]);

            });
        }
    </script>

    <?php if($vars['buildingLevel'] >= 1):?>
    <div
            title=""
            class="container <?=$vars['selectedTabId'] == 1 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 1 ? 'favorActive' : '';?> favorKey1"
                >

            <a
                    id="<?=$vars['Train'];?>" href="build.php?s=1&amp;id=<?=$vars['buildingIndex'];?>" class="tabItem"
                    >
                <?=T("ResidencePalace", "Train");?> <img src="img/x.gif" class="favorIcon"
                                                         alt="<?=T("ResidencePalace", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Train'];?>')) {
            jQuery('#<?=$vars['Train'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId'] == 1 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Train'];?>",
                    "href": "build.php?s=1&amp;id=28",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("ResidencePalace", "Train");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Train'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTabId'] == 2 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 2 ? 'favorActive' : '';?> favorKey2"
                >

            <a
                    id="<?=$vars['CulturePoints'];?>" href="build.php?s=2&amp;id=<?=$vars['buildingIndex'];?>" class="tabItem"
                    >
                <?=T("ResidencePalace", "CulturePoints");?> <img src="img/x.gif" class="favorIcon"
                                                                 alt="<?=T("ResidencePalace", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['CulturePoints'];?>')) {
            jQuery('#<?=$vars['CulturePoints'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId'] == 2 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['CulturePoints'];?>",
                    "href": "build.php?s=2&amp;id=28",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("ResidencePalace", "CulturePoints");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['CulturePoints'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTabId'] == 3 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 3 ? 'favorActive' : '';?> favorKey3"
                >

            <a
                    id="<?=$vars['Loyalty'];?>" href="build.php?s=3&amp;id=<?=$vars['buildingIndex'];?>" class="tabItem"
                    >
                <?=T("ResidencePalace", "Loyalty");?> <img src="img/x.gif" class="favorIcon"
                                                           alt="<?=T("ResidencePalace", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Loyalty'];?>')) {
            jQuery('#<?=$vars['Loyalty'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId'] == 3 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Loyalty'];?>",
                    "href": "build.php?s=3&amp;id=28",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("ResidencePalace", "Loyalty");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Loyalty'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['selectedTabId'] == 4 ? 'active' : 'normal';?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$vars['favor'] == 4 ? 'favorActive' : '';?> favorKey4"
                >

            <a
                    id="<?=$vars['Expansion'];?>" href="build.php?s=4&amp;id=<?=$vars['buildingIndex'];?>" class="tabItem"
                    >
                <?=T("ResidencePalace", "Expansion");?> <img src="img/x.gif" class="favorIcon"
                                                             alt="<?=T("ResidencePalace", "This tab is set as favourite");?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Expansion'];?>')) {
            jQuery('#<?=$vars['Expansion'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTabId'] == 4 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['Expansion'];?>",
                    "href": "build.php?s=4&amp;id=28",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("ResidencePalace", "Expansion");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Expansion'];?>"
                }]);

            });
        }
    </script>
    <?php endif;?>

    <div class="clear"></div>
</div>

<?=$vars['content'];?>