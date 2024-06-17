<div class="map2 lowRes">
    <div id="mapContainer" class="lowRes">
        <div class="mapContainerData">
            <?= $vars['mapContainerData']; ?>
        </div>
        <form id="mapCoordEnter" action="karte.php" method="get" class="toolbar">
            <div class="ml">
                <div class="mr">
                    <div class="mc">
                        <div class="contents">
                            <?php if ($vars['hasClub'] == 0): ?>
                                <div class="iconButton iconRequireGold" id="iconCropfinder">
                                    <div class="iconButton linkCropfinder" title="<?= T(
                                        "map",
                                        "cropFinder"
                                    ); ?>||<?= T(
                                        "map",
                                        "needClub"
                                    ); ?>"></div>
                                </div>
                            <?php else: ?>
                                <a href="cropfinder.php" class="iconButton linkCropfinder" title="<?= T(
                                    "map",
                                    "cropFinder"
                                ); ?>">&nbsp;</a>
                            <?php endif; ?>
                            <div class="separator"></div>
                            <div class="coordinatesInput">
                                <div class="xCoord">
                                    <label for="xCoordInputMap">X:</label>
                                    <input type="text" maxlength="4" value="0" name="x" id="xCoordInputMap"
                                           class="text coordinates x"/>
                                </div>
                                <div class="yCoord">
                                    <label for="yCoordInputMap">Y:</label>
                                    <input type="text" maxlength="4" value="0" name="y" id="yCoordInputMap"
                                           class="text coordinates y"/>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?= getButton([
                                "type"  => "submit",
                                "value" => "OK",
                                "class" => "green small",
                            ],
                                [
                                    "data" => [
                                        "value" => "OK",
                                        "class" => "green small",
                                    ],
                                ],
                                T("Global", "General.ok")); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <a href="karte.php?x=<?= $vars['x'] - 1; ?>&amp;y=<?= $vars['y']; ?>" id="navigationMoveLeft"
           class="moveLeft"><img src="/img/x.gif" alt="<?= T("map", "move left"); ?>"
                                 title="<?= T("map", "move left"); ?>"/></a>
        <a href="karte.php?x=<?= $vars['x'] + 1; ?>&amp;y=<?= $vars['y']; ?>" id="navigationMoveRight"
           class="moveRight"><img src="/img/x.gif" alt="<?= T("map", "move right"); ?>"
                                  title="<?= T("map", "move right"); ?>"/></a>
        <a href="karte.php?x=<?= $vars['x']; ?>&amp;y=<?= $vars['y'] + 1; ?>" id="navigationMoveUp" class="moveUp"><img
                    src="/img/x.gif" alt="<?= T("map", "move up"); ?>ا" title="<?= T("map", "move up"); ?>"/></a>
        <a href="karte.php?x=<?= $vars['x']; ?>&amp;y=<?= $vars['y'] - 1; ?>" id="navigationMoveDown"
           class="moveDown"><img src="/img/x.gif" alt="<?= T("map", "move down"); ?>"
                                 title="<?= T("map", "move down"); ?>"/></a>
        <?php if ($vars['hasPlus']): ?>
            <?php if ($vars['fullscreen']): ?>
                <a href="karte.php?x=<?= $vars['x']; ?>&amp;y=<?= $vars['y']; ?>" id="navigationFullScreen"
                   class="viewFullScreen normal"><img src="/img/x.gif" alt="<?= T(
                        "map",
                        "largeMap"
                    ); ?>" title="<?= T(
                        "map",
                        "largeMap"
                    ); ?>"/></a>
            <?php else: ?>
                <a href="karte.php?fullscreen=1&x=<?= $vars['x']; ?>&amp;y=<?= $vars['y']; ?>" id="navigationFullScreen"
                   class="viewFullScreen full"><img src="/img/x.gif" alt="<?= T(
                        "map",
                        "largeMap"
                    ); ?>" title="<?= T(
                        "map",
                        "largeMap"
                    ); ?>"/></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
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
<?php if ($vars['fullscreen']): ?>
    <script type="text/javascript">


        jQuery(function() {
            jQuery('body').addClass('fullScreen');
            // Mind the order, first, the windows size should be adjusted by applying class, and then container view size determined
            var containerViewSize = {
                width: jQuery(window).width() - 25, // 25 is ruler width
                height: jQuery(window).height() - 16 // 16 is ruler height
            };
            jQuery('#mapContainer')
                .remove()
                .css({
                    position: 'absolute',
                    width: Math.floor(containerViewSize.width / 60) *  60,
                    height: Math.floor(containerViewSize.height / 60) *  60,
                    top: 0,
                    left: 0
                })
                .appendTo('body');
            Travian.Game.Map.LowRes.Options.Default.tileDisplayInformation.type = 'dialog';
            new Travian.Game.Map.LowRes.Container(Travian.Helpers.deepmergeObject({}, Travian.Game.Map.LowRes.Options.Default, {
                fullScreen: true,
                mapInitialPosition: {x: <?=$vars['x'];?>, y: <?=$vars['y'];?>}
            }));
        });
    </script>
<?php elseif ($vars['hasPlus']): ?>
    <script type="text/javascript">
        jQuery(function () {
            Travian.Game.Map.LowRes.Options.Default.tileDisplayInformation.type = 'dialog';
            new Travian.Game.Map.LowRes.Container(Travian.Helpers.deepmergeObject({}, Travian.Game.Map.LowRes.Options.Default, {
                fullScreen: false,
                mapInitialPosition: {x: <?=$vars['x'];?>, y: <?=$vars['y'];?>}
            }));
        });
    </script>
<?php endif; ?>