<div class="contentNavi subNavi ">
    <div
            title="<?=$vars['InfrastructureTab']['text'];?>"
            class="container infrastructure <?=$vars['activeTab'] == 1 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
                >

            <a
                    id="<?=$vars['InfrastructureTab']['id'];?>" href="build.php?id=<?=$vars['selectedId'];?>&amp;category=1" class="tabItem"
                    >
                <?=$vars['InfrastructureTab']['text'];?>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['InfrastructureTab']['id'];?>')) {
            jQuery('#<?=$vars['InfrastructureTab']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "infrastructure <?=$vars['activeTab'] == 1 ? "active" : "normal";?>",
                    "title": "<?=$vars['InfrastructureTab']['text'];?>",
                    "target": false,
                    "id": "<?=$vars['InfrastructureTab']['id'];?>",
                    "href": "build.php?id=<?=$vars['selectedId'];?>&amp;category=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['InfrastructureTab']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['InfrastructureTab']['id'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=$vars['MilitaryTab']['text'];?>"
            class="container military <?=$vars['activeTab'] == 2 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
                >

            <a
                    id="<?=$vars['MilitaryTab']['id'];?>" href="build.php?id=<?=$vars['selectedId'];?>&amp;category=2" class="tabItem"
                    >
                <?=$vars['MilitaryTab']['text'];?>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['MilitaryTab']['id'];?>')) {
            jQuery('#<?=$vars['MilitaryTab']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "military <?=$vars['activeTab'] == 2 ? "active" : "normal";?>",
                    "title": "<?=$vars['MilitaryTab']['text'];?>",
                    "target": false,
                    "id": "<?=$vars['MilitaryTab']['id'];?>",
                    "href": "build.php?id=<?=$vars['selectedId'];?>&amp;category=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['MilitaryTab']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['MilitaryTab']['id'];?>"
                }]);

            });
        }
    </script>

    <div
            title="<?=$vars['ResourcesTab']['text'];?>"
            class="container resources <?=$vars['activeTab'] == 3 ? "active" : "normal";?>"
            >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
                >

            <a
                    id="<?=$vars['ResourcesTab']['id'];?>" href="build.php?id=<?=$vars['selectedId'];?>&amp;category=3" class="tabItem"
                    >
                <?=$vars['ResourcesTab']['text'];?>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['ResourcesTab']['id'];?>')) {
            jQuery('#<?=$vars['ResourcesTab']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "resources <?=$vars['activeTab'] == 3 ? "active" : "normal";?>",
                    "title": "<?=$vars['ResourcesTab']['text'];?>",
                    "target": false,
                    "id": "<?=$vars['ResourcesTab']['id'];?>",
                    "href": "build.php?id=<?=$vars['selectedId'];?>&amp;category=3",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['ResourcesTab']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['ResourcesTab']['id'];?>"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>
