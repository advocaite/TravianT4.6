<?php
$selectedTab = $vars['selectedTab'];
?>
    <div class="contentNavi tabNavi ">
        <div
                title=""
                class="container <?=$selectedTab == 0 ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content"
            >

                <a
                        id="<?=$button_id = get_button_id(); ?>"
                        href="dorf3.php?s=5" class="tabItem"
                >
                    <?=T("villageOverview",
                        "Own Troops"); ?>                                                        </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$selectedTab == 0 ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "dorf3.php?s=5",
                        "onclick": false,
                        "enabled": true,
                        "text": "Own troops",
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
                class="container <?=$selectedTab == 1 ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content"
            >

                <a
                        id="<?=$button_id = get_button_id(); ?>"
                        href="dorf3.php?s=5&amp;su=1" class="tabItem"
                >
                    <?=T("villageOverview",
                        "Troops in villages"); ?>                                                        </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$selectedTab == 1 ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "dorf3.php?s=5&amp;su=1",
                        "onclick": false,
                        "enabled": true,
                        "text": "Troops in villages",
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
                class="container <?=$selectedTab == 2 ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content"
            >

                <a
                        id="<?=$button_id = get_button_id(); ?>"
                        href="dorf3.php?s=5&amp;su=2" class="tabItem"
                >
                    <?=T("villageOverview",
                        "Armory"); ?>                                                        </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$selectedTab == 2 ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "dorf3.php?s=5&amp;su=2",
                        "onclick": false,
                        "enabled": true,
                        "text": "Armory",
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
<?php if ($selectedTab == 0): ?>
    <table cellpadding="1" cellspacing="1" id="troops">
        <thead>
        <tr>
            <th><?=T("villageOverview", "Village"); ?></th>
            <?=$vars['units']; ?>
        </tr>
        </thead>
        <tbody class="<?= ($vars['tooLargeTroops'] ? 'noPadding' : null); ?>">
        <?=$vars['content']; ?>
        <tr>
            <td colspan="12" class="empty"></td>
        </tr>
        <tr class="sum <?= ($vars['summaryLarge'] ? 'small' : ''); ?>">
            <th><?=T("villageOverview", "Sum"); ?></th>
            <?=$vars['summary']; ?>
        </tr>
        </tbody>
    </table>
<?php else: ?>
    <?=$vars['content']; ?>
<?php endif; ?>