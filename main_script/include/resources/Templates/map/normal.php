<div class="map2">
    <div id="mapContainer">
        <div class="innerShadow">
            <div class="innerShadow-tl">
                <div class="innerShadow-tr">
                    <div class="innerShadow-tc"></div>
                </div>
            </div>
            <div class="innerShadow-ml">
                <div class="innerShadow-mr"></div>
            </div>
            <div class="innerShadow-bl">
                <div class="innerShadow-br">
                    <div class="innerShadow-bc"></div>
                </div>
            </div>
        </div>
        <div id="toolbar" class="toolbar">
            <div class="ml">
                <div class="mr">
                    <div class="mc">
                        <div class="contents">
                            <div class="iconButton zoomIn" title="<?=T(
                                "map",
                                "zoomIn"
                            ); ?>"></div>
                            <div class="iconButton zoomOut" title="<?=T(
                                "map",
                                "zoomOut"
                            ); ?>"></div>

                            <div class="dropdown">
                                <div class="dataContainer">
                                    <div
                                            class="entry <?=$vars['Map']['zoomLevel']
                                            == 1 ? 'display' : "hide"; ?>">100%
                                    </div>
                                    <div
                                            class="entry <?=$vars['Map']['zoomLevel']
                                            == 2 ? 'display' : "hide"; ?>">50%
                                    </div>
                                    <?php if ($vars['smallMapEnabled']): ?>
                                        <div
                                                class="entry <?=$vars['Map']['zoomLevel']
                                                == 3 ? 'display' : "hide"; ?>">8%
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="iconButton dropDownImage"
                                     title="<?=T(
                                         "map",
                                         "zoomLevel"
                                     ); ?>"></div>
                                <div class="clear"></div>
                            </div>
                            <?php if ($vars['hasPlus'] == 0): ?>
                                <div class="iconButton iconRequireGold"
                                     id="iconFullscreen">
                                    <div class="iconButton viewFullGold"
                                         title="<?=T(
                                             "map",
                                             "largeMap"
                                         ); ?>||<?=T(
                                             "map",
                                             "needPlus"
                                         ); ?>"></div>
                                </div>
                            <?php else: ?>
                                <div
                                        class="iconButton <?=$vars['fullscreen']
                                            ? 'viewNormal'
                                            : "viewFull"; ?> <?=$vars['fullscreen']
                                            ? 'checked' : ''; ?>"
                                        title="<?=T(
                                            "map",
                                            "largeMap"
                                        ); ?>"></div>
                            <?php endif; ?>
                            <?php if ($vars['hasClub'] == 0): ?>
                                <div class="iconButton iconRequireGold"
                                     id="iconCropfinder">
                                    <div class="iconButton linkCropfinder"
                                         title="<?=T(
                                             "map",
                                             "cropFinder"
                                         ); ?>||<?=T(
                                             "map",
                                             "needClub"
                                         ); ?>"></div>
                                </div>
                            <?php else: ?>
                                <div class="iconButton linkCropfinder"
                                     title="<?=T(
                                         "map",
                                         "cropFinder"
                                     ); ?>"></div>
                            <?php endif; ?>
                            <div class="text"><?=T(
                                    "map",
                                    "filter"
                                ); ?></div>
                            <div
                                    class="iconButton filterMy <?=$vars['Map']['Marks']['player']['enabled']
                                        ? 'checked' : ''; ?>"
                                    title="<?=T(
                                        "map",
                                        $vars['Map']['Marks']['player']['enabled']
                                            ? "hideUserMarks" : "showUserMarks"
                                    ); ?>"></div>
                            <div
                                    class="iconButton filterAlliance <?=$vars['Map']['Marks']['alliance']['enabled']
                                        ? 'checked' : ''; ?>"
                                    title="<?=T(
                                        "map",
                                        $vars['Map']['Marks']['alliance']['enabled']
                                            ? "hideAllianceMarks"
                                            : "showAllianceMarks"
                                    ); ?>?"></div>

                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bl">
                <div class="br">
                    <div class="bc"></div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            Travian.Game.Map.Options.Toolbar.filterPlayer.checked = <?=$vars['Map']['Marks']['player']['enabled'] ? "true" : "false";?>;
            Travian.Game.Map.Options.Toolbar.filterAlliance.checked = <?=$vars['Map']['Marks']['alliance']['enabled'] ? "true" : "false";?>;
        </script>
        <?php if ($vars['hasPlus'] == 0): ?>
            <script type="text/javascript">
                jQuery(function () {
                    jQuery('#iconFullscreen').click(function (event) {
                        jQuery(window).trigger("buttonClicked", [this, {
                            "plusDialog": {
                                "featureKey": "fullScreen",
                                "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                            }
                        }]);
                    })
                });
            </script>
        <?php endif; ?>
        <?php if ($vars['hasClub'] == 0): ?>
            <script
                    type="text/javascript">jQuery(function () {
                    jQuery('#iconCropfinder').click(function (event) {
                        jQuery(window).trigger("buttonClicked", [this, {
                            "goldclubDialog": {
                                "featureKey": "cropFinder",
                                "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                            }
                        }]);
                    })
                });</script>
        <?php endif; ?>

        <form id="mapCoordEnter" action="karte.php" method="get"
              class="toolbar">
            <div class="ml">
                <div class="mr">
                    <div class="mc">
                        <div class="contents">
                            <div class="coordinatesInput">
                                <div class="xCoord">
                                    <label for="xCoordInputMap">X:</label>
                                    <input type="text" maxlength="4" value="<?=$vars['Map']['mapInitialPosition']['x'];?>" name="x"
                                           id="xCoordInputMap"
                                           class="text coordinates x "/>
                                </div>
                                <div class="yCoord">
                                    <label for="yCoordInputMap">Y:</label>
                                    <input type="text"  maxlength="4" value="<?=$vars['Map']['mapInitialPosition']['y'];?>" name="y"
                                           id="yCoordInputMap"
                                           class="text coordinates y "/>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?=$vars['coordinateSubmitButton']; ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="minimapContainer">
            <div class="background"></div>
            <div class="headline">
                <div class="title"><?=T("map", "minimap"); ?></div>
                <div class="iconButton small"></div>
                <div class="clear"></div>
            </div>
            <div id="miniMap">
                <img class="map" style="width: 185px; height: 109px;"
                     src="minimap.php"
                     alt="<?=T("map", "minimap"); ?>"/>
            </div>

            <div class="bl">
                <div class="br">
                    <div class="bc"></div>
                </div>
            </div>
        </div>
        <div id="outline">
            <div class="tl">
                <div class="tr">
                    <div class="tc"></div>
                </div>
            </div>
            <div class="background"></div>
            <div id="mapMarks">
                <div class="headline">
                    <div class="title"><?=T("map", "outline"); ?></div>
                    <div class="iconButton small"></div>
                    <div class="clear"></div>
                </div>
                <div class="tabContainer">
                    <div class="tab">
                        <div class="entry selected">
                            <div class="tab-container">
                                <div class="tab-position">
                                    <div class="tab-tl">
                                        <div class="tab-tr">
                                            <div class="tab-tc"></div>
                                        </div>
                                    </div>
                                    <div class="tab-ml">
                                        <div class="tab-mr">
                                            <div class="tab-mc"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-contents">
                                    <a href="#" onclick="outlineContainerTabClick('player')"><?=T("map",
                                            "users"); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php if ($vars['hasAlliance']): ?>
                            <div class="entry">
                                <div class="tab-container">
                                    <div class="tab-position">
                                        <div class="tab-tl">
                                            <div class="tab-tr">
                                                <div class="tab-tc"></div>
                                            </div>
                                        </div>
                                        <div class="tab-ml">
                                            <div class="tab-mr">
                                                <div class="tab-mc"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-contents">
                                        <a href="#" onclick="
								if (!$(this).up('.entry').hasClass('selected'))
								{
									jQuery('#tabAlliance').show();
									jQuery('#tabPlayer').hide();
									$(this).up('.entry').toggleClass('selected').prev('.entry').toggleClass('selected');
								}
								jQuery('#mapContainer')._map.mapMarks.alliance.update(false);
								return false;
							"><?=T("map", "alliance"); ?>    </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>

                    <div id="tabPlayer" class="dataTab"></div>
                    <div id="tabAlliance" class="dataTab"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function outlineContainerTabClick(part) {
            var section = part === 'alliance' ? 'alliance' : 'player';
            var tab = section === 'player' ? '#tabPlayer' : '#tabAlliance';
            jQuery('.dataTab').hide();
            jQuery(tab).show();
            jQuery('.tabContainer .entry').removeClass('selected');
            jQuery('.tabContainer .entry.' + section).addClass('selected');
            Travian.Game.Map._map.mapMarks[part].update(false);
            return false;
        }
    </script>
    <div id="contextmenu">
        <div class="background">
            <div class="background-tl">
                <div class="background-tr">
                    <div class="background-tc"></div>
                </div>
            </div>
            <div class="background-ml">
                <div class="background-mr">
                    <div class="background-mc"></div>
                </div>
            </div>
            <div class="background-bl">
                <div class="background-br">
                    <div class="background-bc"></div>
                </div>
            </div>
        </div>
        <div class="background-content">
            <div>
                <div class="tl">
                    <div class="tr">
                        <div class="tc"></div>
                    </div>
                </div>
                <div class="ml">
                    <div class="mr">
                        <div class="mc">
                            <div class="contents">
                                <div id="contextMenuSendTroops" class="entry">
                                    <a href="#flag"><?=T(
                                            "map",
                                            "sendTroops"
                                        ); ?></a>
                                </div>
                                <div id="contextMenuSendTraders" class="entry">
                                    <a href="#flag"><?=T(
                                            "map",
                                            "sendMerchants"
                                        ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bl">
                    <div class="br">
                        <div class="bc"></div>
                    </div>
                </div>
            </div>
            <div class="separator separatorActions"></div>

            <div>
                <div class="tl">
                    <div class="tr">
                        <div class="tc"></div>
                    </div>
                </div>
                <div class="ml">
                    <div class="mr">
                        <div class="mc">
                            <div class="contents">
                                <div class="hideIE6 title">
                                    <?=T(
                                        "map",
                                        "users"
                                    ); ?>                            </div>
                                <div id="contextMenuMarkPlayerAlliance"
                                     class="hideIE6 entry">
                                    <a href="#flag"><?=T(
                                            "map",
                                            "markAlliance"
                                        ); ?></a>
                                </div>
                                <div id="contextMenuMarkPlayerPlayer"
                                     class="hideIE6 entry">
                                    <a href="#flag"><?=T(
                                            "map",
                                            "markPlayer"
                                        ); ?></a>
                                </div>
                                <div id="contextMenuFlagPlayer"
                                     class="hideIE6 entry">
                                    <a href="#flag"><?=T(
                                            "map",
                                            "markField"
                                        ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bl">
                    <div class="br">
                        <div class="bc"></div>
                    </div>
                </div>
            </div>

            <div class="separator"></div>
            <?php if ($vars['hasAlliance'] and $vars['hasPermission']): ?>
                <div>
                    <div class="tl">
                        <div class="tr">
                            <div class="tc"></div>
                        </div>
                    </div>
                    <div class="ml">
                        <div class="mr">
                            <div class="mc">
                                <div class="contents">
                                    <div class="hideIE6 title">
                                        <?=T(
                                            "map",
                                            "alliance"
                                        ); ?>                            </div>
                                    <div id="contextMenuMarkAllianceAlliance"
                                         class="hideIE6 entry">
                                        <a href="#flag"><?=T(
                                                "map",
                                                "markAlliance"
                                            ); ?></a>
                                    </div>
                                    <div id="contextMenuMarkAlliancePlayer"
                                         class="hideIE6 entry">
                                        <a href="#flag"><?=T(
                                                "map",
                                                "markPlayer"
                                            ); ?></a>
                                    </div>
                                    <div id="contextMenuFlagAlliance"
                                         class="hideIE6 entry">
                                        <a href="#flag"><?=T(
                                                "map",
                                                "markField"
                                            ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bl">
                        <div class="br">
                            <div class="bc"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    Travian.Translation.add(
        {
            'k.spieler': '<?=T("map", "users");?>',
            'k.einwohner': '<?=T("map", "population");?>',
            'k.allianz': '<?=T("map", "alliance");?>',
            'k.volk': '<?=T("map", "tribe");?>',
            'k.dt': '<?=T("map", "village");?>',
            'k.bt': '<?=T("map", "freeOasis");?>',
            'k.fo': '<?=T("map", "occupiedOasis");?>',
            'k.vt': '<?=T("map", "landscape");?>',
            'k.loadingData': '<?=T("map", "loadingData");?>',

            'a.v1': '<?=T("Global", "races.1");?>',
            'a.v2': '<?=T("Global", "races.2");?>',
            'a.v3': '<?=T("Global", "races.3");?>',
            'a.v4': '<?=T("Global", "races.4");?>',
            'a.v5': '<?=T("Global", "races.5");?>',
            'a.v6': '<?=T("Global", "races.6");?>',
            'a.v7': '<?=T("Global", "races.7");?>',

            'k.f1': '3-3-3-9',
            'k.f2': '3-4-5-6',
            'k.f3': '4-4-4-6',
            'k.f4': '4-5-3-6',
            'k.f5': '5-3-4-6',
            'k.f6': '1-1-1-15',
            'k.f7': '4-4-3-7',
            'k.f8': '3-4-4-7',
            'k.f9': '4-3-4-7',
            'k.f10': '3-5-4-6',
            'k.f11': '4-3-5-6',
            'k.f12': '5-4-3-6',
            'k.f99': '<?=T("map", "natarsVillage");?>',

            'b.ri1': '<?=T("Reports", "reportTypes.1");?>.',
            'b.ri2': '<?=T("Reports", "reportTypes.2");?>.',
            'b.ri3': '<?=T("Reports", "reportTypes.3");?>.',
            'b.ri4': '<?=T("Reports", "reportTypes.4");?>.',
            'b.ri5': '<?=T("Reports", "reportTypes.5");?>.',
            'b.ri6': '<?=T("Reports", "reportTypes.6");?>.',
            'b.ri7': '<?=T("Reports", "reportTypes.7");?>.',

            'b:ri1': '<img src="img/x.gif" class="iReport iReport1"/>',
            'b:ri2': '<img src="img/x.gif" class="iReport iReport2"/>',
            'b:ri3': '<img src="img/x.gif" class="iReport iReport3"/>',
            'b:ri4': '<img src="img/x.gif" class="iReport iReport4"/>',
            'b:ri5': '<img src="img/x.gif" class="iReport iReport5"/>',
            'b:ri6': '<img src="img/x.gif" class="iReport iReport6"/>',
            'b:ri7': '<img src="img/x.gif" class="iReport iReport7"/>',

            'b:bi0': '<img class="carry empty" src="img/x.gif" alt="<?=T("map", "bounty");?>" />',
            'b:bi1': '<img class="carry half" src="img/x.gif" alt="<?=T("map", "bounty");?>" />',
            'b:bi2': '<img class="carry" src="img/x.gif" alt="<?=T("map", "bounty");?>" />',

            'a.r1': '<?=T("inGame", "resources.r1");?>',
            'a.r2': '<?=T("inGame", "resources.r2");?>',
            'a.r3': '<?=T("inGame", "resources.r3");?>',
            'a.r4': '<?=T("inGame", "resources.r4");?>',

            'a.ad': '<?=T("map", "difficulty");?>:',
            <?=$vars['Map']['adventures'];?>

            'a:r1': '<i class="r1"></i>',
            'a:r2': '<i class="r2"></i>',
            'a:r3': '<i class="r3"></i>',
            'a:r4': '<i class="r4"></i>',

            'k.arrival': '<?=T("map", "arrival");?>',
            'k.ssupport': '<?=T("map", "supply");?>',
            'k.sspy': '<?=T("map", "spy");?>',
            'k.sreturn': '<?=T("map", "return");?>',
            'k.sraid': '<?=T("map", "raid");?>',
            'k.sattack': '<?=T("map", "attack");?>'
        });
</script>
<script type="text/javascript">
    jQuery(function () {
        <?php if($vars['fullscreen']):?>
        jQuery('body').addClass('fullScreen');
        // Mind the order, first, the windows size should be adjusted by applying class, and then container view size determined
        var containerViewSize = {
            width: jQuery(window).width() - 25, // 25 is ruler width
            height: jQuery(window).height() - 16 // 16 is ruler width
        };
        <?php if(getDirection() == "LTR"):?>
        jQuery('#mapContainer')
            .remove()
            .css({
                position: 'absolute',
                width: containerViewSize.width,
                height: containerViewSize.height,
                top: 0,
                right: 0
            })
            .appendTo('body');
        <?php else:?>
        jQuery('#mapContainer')
            .remove()
            .css({
                position: 'absolute',
                width: containerViewSize.width,
                height: containerViewSize.height,
                top: 0,
                left: 0
            })
            .appendTo('body');
        <?php endif;?>
        <?php else:?>
        var containerViewSize = {
            width: 543,
            height: 401
        };
        <?php endif;?>
        Travian.Game.Map.Options.Rulers.steps = Travian.Helpers.deepmergeObject({}, Travian.Game.Map.Options.Rulers.steps, {
            "x": {
                "1": 1,
                "2": 1,
                "3": 10,
                "4": 20
            }, "y": {"1": 1, "2": 1, "3": 10, "4": 20}
        });
        Travian.Game.Map.Options.Default.dataStore = Travian.Helpers.deepmergeObject({}, Travian.Game.Map.Options.Default.dataStore, {
            "cachingTimeForType": {
                "blocks": 1800000,
                "symbol": 600000,
                "tile": 600000,
                "tooltip": 300000
            },
            "persistentStorage": false,
            "useStorageForType": {"blocks": false, "symbol": false, "tile": false, "tooltip": false},
            "clearStorageForType": {"blocks": false, "symbol": false, "tile": false, "tooltip": false}
        });
        Travian.Game.Map.Options.Default.updater = Travian.Helpers.deepmergeObject({}, Travian.Game.Map.Options.Default.updater, {
            "maxRequestCount": 5,
            "requestDelayTime": {"multiple": 100, "position": 300},
            "url": "ajax.php",
            "positionOptions": {
                "areaAroundPosition": {
                    "1": {"left": -5, "bottom": -4, "right": 5, "top": 4},
                    "2": {"left": -10, "bottom": -8, "right": 10, "top": 8},
                    "3": {"left": -15, "bottom": -15, "right": 15, "top": 15},
                    "4": {"left": -15, "bottom": -15, "right": 15, "top": 15}
                }
            }
        });
        Travian.Game.Map.Options.Default.tileDisplayInformation.type = 'dialog';

        Travian.Game.Map.Options.MapMark.Flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
        Travian.Game.Map.Options.MapMark.Mark.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

        Travian.Game.Map.Options.Default.mapMarks.player.layers.alliance.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
        Travian.Game.Map.Options.Default.mapMarks.player.layers.player.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
        Travian.Game.Map.Options.Default.mapMarks.alliance.layers.alliance.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
        Travian.Game.Map.Options.Default.mapMarks.alliance.layers.player.dialog.html = '<div class=\"mapMarkMark\">\n	<div class=\"color {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\"><\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

        Travian.Game.Map.Options.Default.mapMarks.player.layers.flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';
        Travian.Game.Map.Options.Default.mapMarks.alliance.layers.flag.dialog.html = '<div class=\"mapMarkField\">\n	<div class=\"flag {select}\"><\/div>\n	<div class=\"{coord}\">\n		\n			<div class=\"coordinatesInput\">\n				<div class=\"xCoord\">\n					<label for=\"coordinateDialogX\">X:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"x\" id=\"coordinateDialogX\" class=\"text coordinates x {inputX}\"   />\n				<\/div>\n				<div class=\"yCoord\">\n					<label for=\"coordinateDialogY\">Y:<\/label>\n					<input maxlength=\"4\" value=\"\" name=\"y\" id=\"coordinateDialogY\" class=\"text coordinates y {inputY}\"   />\n				<\/div>\n				<div class=\"clear\"><\/div>\n			<\/div>\n			<\/div>\n	<div class=\"{textDisplay}\">\n		<input id=\"coordinateDialogText\" class=\"text {inputText}\" type=\"text\" />\n	<\/div>\n	<p class=\"error errorMessage\"><\/p>\n<\/div>';

        Travian.Game.Map.Tips.tooltipHtml = '‏&#x202e;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">({x}<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">{y})<\/span><\/span>&#x202c;‏';
        Travian.Game.Map.Options.Default.block.tooltipHtml = '‏&#x202e;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">({x}<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">{y})<\/span><\/span>&#x202c;‏<br />{k.loadingData}';
        Travian.Game.Map.Options.MiniMap.tooltipHtml = '‏&#x202e;<span class=\"coordinates coordinatesWrapper\"><span class=\"coordinateX\">({x}<\/span><span class=\"coordinatePipe\">|<\/span><span class=\"coordinateY\">{y})<\/span><\/span>&#x202c;‏';


        new Travian.Game.Map.Container(Travian.Helpers.deepmergeObject({}, Travian.Game.Map.Options.Default,
            {
                blockOverflow: 1,
                blockSize:
                    {
                        width: 600,
                        height: 600
                    },
                containerViewSize: containerViewSize,
                mapInitialPosition: {
                    x: <?=$vars['Map']['mapInitialPosition']['x'];?>,
                    y: <?=$vars['Map']['mapInitialPosition']['y'];?>
                },
                transition: {
                    zoomOptions: {
                        level: <?=$vars['Map']['zoomLevel'];?>,
                        sizes: [{"x": 10, "y": 10}, {
                            "x": 20,
                            "y": 20
                        } <?=($vars['smallMapEnabled'] ? ',{"x": 120, "y": 120}' : '');?>]
                    }
                },
                data: <?=$vars['Map']['data'];?>,
                mapMarks:
                    {
                        player: {
                            data: <?=$vars['Map']['Marks']['player']['data'];?>,
                            layers: {
                                alliance: {
                                    title: '<?=T("map", "alliance");?>',
                                    dialog: {
                                        title: '<?=T("map", "ownAllianceMarks");?>',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    },
                                    optionsData: {
                                        urlLink: 'allianz.php?aid={markId}'
                                    }
                                },
                                player: {
                                    title: '<?=T("map", "users");?>',
                                    dialog: {
                                        title: '<?=T("map", "ownPlayerMarkTitle");?>',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    },
                                    optionsData: {
                                        urlLink: 'spieler.php?uid={markId}'
                                    }
                                },
                                flag: {
                                    title: '<?=T("map", "flags");?>',
                                    dialog: {
                                        title: '<?=T("map", "ownFlags");?>.',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    }
                                }
                            }
                        },
                        alliance: {
                            enabled: <?=$vars['hasAlliance'] ? 'true' : 'false';?>,
                            data: <?=$vars['Map']['Marks']['alliance']['data'];?>,
                            layers: {
                                alliance: {
                                    <?=$vars['hasPermission'] == 0 ? 'editable: false,' : '';?>
                                    title: '<?=T("map", "alliance");?>',
                                    dialog: {
                                        title: '<?=T("map", "allianceMarkTitle");?>',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    },
                                    optionsData: {
                                        urlLink: 'allianz.php?aid={markId}'
                                    }
                                },
                                player: {
                                    <?=$vars['hasPermission'] == 0 ? 'editable: false,' : '';?>
                                    title: '<?=T("map", "users");?>',
                                    dialog: {
                                        title: '<?=T("map", "playerMarksTitle");?>',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    },
                                    optionsData: {
                                        urlLink: 'spieler.php?uid={markId}'
                                    }
                                },
                                flag: {
                                    <?=$vars['hasPermission'] == 0 ? 'editable: false,' : '';?>
                                    title: '<?=T("map", "flags");?>',
                                    dialog: {
                                        title: '<?=T("map", 'allianceFlags');?>',
                                        textOkay: '<?=T("map", "save");?>',
                                        textCancel: '<?=T("map", "cancel");?>'
                                    }
                                }
                            }
                        }
                    }
            }));
    });
</script>