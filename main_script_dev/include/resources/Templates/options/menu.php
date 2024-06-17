<div class="contentNavi subNavi ">
    <div
            title=""
            class="container <?=$vars['selectedTab'] == 1 ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
        >

            <a
                    id="<?=$button_id = get_button_id(); ?>"
                    href="options.php?s=1" class="tabItem"
            >
                <?=T("Options", "Game"); ?>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "options.php?s=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Options", "Game");?>",
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
            title=""
            class="container <?=$vars['selectedTab'] == 2 ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
        >

            <a
                    id="<?=$button_id = get_button_id(); ?>"
                    href="options.php?s=2" class="tabItem"
            >
                <?=T("Options", "Account"); ?>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "options.php?s=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Options", "Account");?>",
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
            title=""
            class="container <?=$vars['selectedTab'] == 3 ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content"
        >

            <a
                    id="<?=$button_id = get_button_id(); ?>"
                    href="options.php?s=3" class="tabItem"
            >
                <?=T("Options", "Sitter"); ?>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 3 ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "options.php?s=3",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("Options", "Sitter");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <?php if (Core\Config::getProperty("game", "vacationDays") > 0): ?>
        <div
                title=""
                class="container <?=$vars['selectedTab'] == 4 ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content">
                <a
                        id="<?=$button_id = get_button_id(); ?>"
                        href="options.php?s=4" class="tabItem"
                >
                    <?=T("Options", "Vacation"); ?>
                </a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "active",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "options.php?s=4",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Options", "Vacation");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);
                });
            }
        </script>
    <?php endif; ?>
    <div class="clear"></div>
</div>
