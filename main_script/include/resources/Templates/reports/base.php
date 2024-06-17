<a type="submit" id="tabFavorButton" class="icon contentTitleButton" title="<?=T("inGame", "Select this tab as fav");?>" onclick="Travian.ajax({data: {cmd: 'tabFavorite',name: 'reports',number: '<?=$vars['Tabs']['selectedTab'];?>'},onSuccess: function(data) {if (data.success) { jQuery('.tabFavorWrapper .favor').removeClass('favorActive');jQuery('.tabFavorWrapper .favor.favorKey<?=$vars['Tabs']['selectedTab'];?>').addClass('favorActive');}}});return false;"><img src="img/x.gif" class="&nbsp" alt="&nbsp" /></a>
<div class="contentNavi subNavi tabFavorWrapper">
    <div
        title=""
        class="container overview <?=$vars['Tabs']['selectedTab'] == 0 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 0 ? 'favorActive' : '';?> favorKey0"
        >

            <a
                id="<?=$button_id = get_button_id();?>" href="reports.php?t=0" class="tabItem"
            >
                <?=T("Reports", "Tabs.All");?>                                                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"overview <?=$vars['Tabs']['selectedTab'] == 0 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=0","onclick":false,"enabled":true,"text":"\u0647\u0645\u0647","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>

    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 1 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 1 ? 'favorActive' : '';?> favorKey1"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=1"                                                class="tabItem"
            >
                <?=T("Reports", "Tabs.Attacks");?>                                                      <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 1 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=1","onclick":false,"enabled":true,"text":"\u062d\u0645\u0644\u0647","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>

    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 2 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 2 ? 'favorActive' : '';?> favorKey2"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=2"                                                class="tabItem"
            >
                <?=T("Reports", "Tabs.Defense");?>                                                     <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 2 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=2","onclick":false,"enabled":true,"text":"\u062f\u0641\u0627\u0639\u06cc","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>

    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 3 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 3 ? 'favorActive' : '';?> favorKey3"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=3"                                                class="tabItem"
            >
                <?=T("Reports", "Tabs.Spy");?>                                                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 3 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=3","onclick":false,"enabled":true,"text":"\u062c\u0627\u0633\u0648\u0633\u06cc","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>

    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 4 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 4 ? 'favorActive' : '';?> favorKey4"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=4"                                                class="tabItem"
            >
                <?=T("Reports", "Tabs.Other");?>                                                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 4 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=4","onclick":false,"enabled":true,"text":"\u062f\u06cc\u06af\u0631","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>


    <div
        title="<?=$vars['goldClub'] ? T("Reports", "Tabs.Archive") : $vars['Tabs']['ArchiveGoldClubTitle'];?>"
        class="container <?=$vars['goldClub'] ? '' : 'gold';?> <?=$vars['Tabs']['selectedTab'] == 5 ? 'active' : 'normal';?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$vars['favorTabId'] == 5 ? 'favorActive' : '';?> favorKey5">
            <a id="<?=$vars['Tabs']['Archive'];?>" href="<?=$vars['goldClub'] ? 'reports.php?t=5' : '#';?>" class="tabItem">
                <?=T("Reports", "Tabs.Archive");?>
            </a>
        </div>
    </div>

    <?php if($vars['goldClub']):?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['Tabs']['Archive'];?>')) {
                jQuery('#<?=$vars['Tabs']['Archive'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['Tabs']['selectedTab'] == 5 ? "active" : "normal";?>",
                        "title": "<?= T("Reports", "Tabs.Archive");?>",
                        "target": false,
                        "id": "<?=$vars['Tabs']['Archive'];?>",
                        "href": "reports.php?t=4",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?= T("Reports", "Tabs.Archive");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Tabs']['Archive'];?>"
                    }]);

                });
            }
        </script>
    <?php else:?>
        <script type="text/javascript">
            if (jQuery('#<?=$vars['Tabs']['Archive'];?>')) {
                jQuery('#<?=$vars['Tabs']['Archive'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "gold normal",
                        "title": "<?=$vars['Tabs']['ArchiveGoldClubTitle'];?>",
                        "target": false,
                        "id": "<?=$vars['Tabs']['Archive'];?>",
                        "href": "#",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Reports", "Tabs.Archive");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": {
                            "featureKey": "messageArchive",
                            "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                        },
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Tabs']['Archive'];?>"
                    }]);

                });
            }
        </script>
    <?php endif;?>
    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 6 ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 6 ? 'favorActive' : '';?> favorKey6"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=6"                                                class="tabItem"
            >
                <?=T("Reports", "Tabs.Surrounding");?>                                                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>
    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 6 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=6","onclick":false,"enabled":true,"text":"\u0627\u0637\u0631\u0627\u0641","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>
    <div
        title=""
        class="container <?=$vars['Tabs']['selectedTab'] == 7 ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favorTabId'] == 7 ? 'favorActive' : '';?> favorKey7"
        >

            <a
                id="<?=$button_id = get_button_id();?>"                                                href="reports.php?t=7"                                                class="tabItem"
            >
                <?=T("Reports", "Management");?>                                                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>
    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {"class":"<?=$vars['Tabs']['selectedTab'] == 7 ? 'active' : 'normal';?>","title":false,"target":false,"id":"<?=$button_id;?>","href":"reports.php?t=7","onclick":false,"enabled":true,"text":"\u0627\u0637\u0631\u0627\u0641","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>
    <div class="clear"></div>
</div>

<script>
    function reportsFormSelectAll(checkbox) {
        jQuery('#reportsForm').find('input[type=checkbox]').each(function (_, element) {
            element.checked = checkbox.checked;
        }, checkbox);
    }
</script>
<?=$vars['content'];?>