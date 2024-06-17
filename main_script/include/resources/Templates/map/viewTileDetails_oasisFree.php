<div id="tileDetails" class="oasis oasis-<?= $vars['oasisType']; ?>">
    <?php if ($vars['ajaxRequest']): ?>
        <h1><?= $vars['coordText']; ?>&nbsp;<?=getCoordinatesHTML($vars['x'], $vars['y']);?><span class="clear">&nbsp;</span></h1>
    <?php endif; ?>
    <div class="detailImage">
        <div class="options">
            <?= $vars['options']; ?>
        </div>
    </div>

    <div id="map_details">
        <h4><?= T("map", "Bonus"); ?></h4>
        <table cellpadding="1" cellspacing="1" id="distribution"
               class="transparent">
            <tbody>
            <?= $vars['distribution']; ?>
            </tbody>
        </table>

        <h4><?= T("map", "units"); ?></h4>
        <table cellpadding="1" cellspacing="1" id="troop_info"
               class="transparent">
            <tbody>
            <?= $vars['troops_info']; ?>
            </tbody>
        </table>
        <div id="oasis1InstantTabs" class="instantTabs">
            <div class="contentNavi tabNavi tabSubWrapper">
                <div
                        title=""
                        class="container active"
                >
                    <div class="background-start">&nbsp;</div>
                    <div class="background-end">&nbsp;</div>
                    <div
                            class="content"
                    >

                        <a
                                id="<?= $button_id = get_button_id(); ?>" href="#" class="tabItem"
                        >
                            <?= T("map",
                                "Reports"); ?>                                                                </a>
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
                                "href": "#",
                                "onclick": false,
                                "enabled": true,
                                "text": "<?=T("map", "Reports");?>",
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
                        class="container normal"
                >
                    <div class="background-start">&nbsp;</div>
                    <div class="background-end">&nbsp;</div>
                    <div
                            class="content"
                    >

                        <a
                                id="<?= $button_id = get_button_id(); ?>" href="#" class="tabItem"
                        >
                            <?= T("map",
                                "Surrounding"); ?>                                                                </a>
                    </div>
                </div>

                <script type="text/javascript">
                    if (jQuery('#<?=$button_id;?>')) {
                        jQuery('#<?=$button_id;?>').click(function (event) {
                            jQuery(window).trigger('tabClicked', [this, {
                                "class": "normal",
                                "title": false,
                                "target": false,
                                "id": "<?=$button_id;?>",
                                "href": "#",
                                "onclick": false,
                                "enabled": true,
                                "text": "Surrounding",
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

            <div class="tabContainer">
                <table cellpadding="1" cellspacing="1" id="troop_info" class="rep transparent">
                    <tbody><?= $vars['top5Attacks']; ?></tbody>
                </table>
            </div>
            <div class="tabContainer reports hide">
                <table id="surrounding_info" class="reportSurround transparent">
                    <?= $vars['top5Surrounding']; ?>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            Travian.Game.InstantTabs(jQuery('#oasis1InstantTabs'));
        </script>
    </div>
    <div class="clear"></div>
</div>