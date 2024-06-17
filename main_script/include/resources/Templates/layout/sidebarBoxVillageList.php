<div id="sidebarBoxVillagelist"
     class="sidebarBox toggleable <?=$vars['toggle']; ?> ">
    <div class="sidebarBoxBaseBox">
        <div class="baseBox baseBoxTop">
            <div class="baseBox baseBoxBottom">
                <div class="baseBox baseBoxCenter"></div>
            </div>
        </div>
    </div>
    <div class="sidebarBoxInnerBox">
        <div class="innerBox header ">
            <div class="buttonsWrapper">
                <button type="button" id="<?=$vars['buttonToggleId']; ?>" class="layoutButton toggleCoordsWhite green  toggle" onclick="return false;" title="<?=$vars['toggle'] == "collapsed" ? T("inGame", "showCoordinates") : T("inGame", "hideCoordinates"); ?>">
                    <div class="button-container addHoverClick">
                        <i></i>
                    </div>
                </button>
                <script type="text/javascript">

                    if (jQuery('#<?=$vars['buttonToggleId'];?>')) {
                        jQuery('#<?=$vars['buttonToggleId'];?>').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "green",
                                "onclick": "return false;",
                                "loadTitle": false,
                                "boxId": "",
                                "disabled": false,
                                "speechBubble": "",
                                "class": "toggle",
                                "id": "<?=$vars['buttonToggleId'];?>",
                                "redirectUrl": "",
                                "redirectUrlExternal": ""
                            }]);
                        });
                    }
                </script>
                <button type="button" id="<?=$vars['buttonDorf3Id']; ?>" class="layoutButton overviewWhite green  " onclick="return false;" title="<?=T("inGame", "Village statistics"); ?>">
                    <div class="button-container addHoverClick">
                        <i></i>
                    </div>
                </button>
                <script type="text/javascript">
                    if (jQuery('#<?=$vars['buttonDorf3Id'];?>')) {
                        jQuery('#<?=$vars['buttonDorf3Id'];?>').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "green",
                                "onclick": "return false;",
                                "loadTitle": false,
                                "boxId": "",
                                "disabled": false,
                                "speechBubble": "",
                                "class": "",
                                "id": "<?=$vars['buttonDorf3Id'];?>",
                                "redirectUrl": "dorf3.php",
                                "redirectUrlExternal": ""
                            }]);
                        });
                    }
                </script>
                <?php if (getDisplay("fastBuilder")):
                $builderStatus = \Core\Session::getInstance()->getDisplay()[5];
                if ($builderStatus == 1) {
                    $title = 'Enable this button to construct by clicking on the field';
                } else {
                    $title = 'Disable fast upgrade';
                }
                $title = T("inGame", $title);
                ?>
                    <button type="button" id="buttonBuild" title="<?= $title; ?>"
                            class="layoutButton gold <?= ($builderStatus == 1 ? '' : "disabled"); ?> green"
                            onclick="return false;">
                        <div class="button-container addHoverClick ">
                            <img class="reportButton" style="position: absolute;top: 5px;right: 6px;width: 18px;height: 18px;overflow: hidden;z-index: 3;" src="<?=get_gpack_cdn_mainPage_url();?>img_<?=strtolower(getDirection());?>/report/mini_house-<?=strtolower(getDirection());?>.png">
                        </div>
                    </button>
                    <script type="text/javascript">

                        if (jQuery('#buttonBuild')) {
                            jQuery('#buttonBuild').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "green",
                                    "onclick": "return false;",
                                    "loadTitle": false,
                                    "boxId": "",
                                    "disabled": false,
                                    "speechBubble": "",
                                    "class": "",
                                    "id": "buttonBuild",
                                    "redirectUrl": "?toggleFastUp",
                                    "redirectUrlExternal": ""
                                }]);
                            });
                        }
                    </script>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
            <div class="expansionSlotInfo"
                 title="<?=T("inGame", "villages"); ?>: ‎&#x202d;&#x202d;&#x202d;<?=$vars['vcount']; ?>&#x202c;&#x202c;/&#x202d;&#x202d;<?=$vars['total_vcount']; ?>&#x202c;&#x202c;&#x202c;‎</br> <?=T("inGame", "Culture points generated to take control of another village:"); ?> <?=$vars['currentCP']; ?>/<?=$vars['nextCP']; ?>">
                <div class="boxTitleAdditional">&#x202d;&#x202d;&#x202d;<?=$vars['vcount']; ?>&#x202c;&#x202c;/&#x202d;&#x202d;<?=$vars['total_vcount']; ?>
                    &#x202c;&#x202c;&#x202c;‎
                </div>
                <div
                        class="boxTitle"><?=T("inGame", "villages"); ?></div>
                <div class="villageListBarBox">
                    <div class="bar"
                         style="width:<?=$vars['percent']; ?>%">
                        &nbsp;
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(function() {
                    Travian.Translation.add(
                        {
                            'villagelist_collapsed': '<?=T("inGame", "showCoordinates");?>',
                            'villagelist_expanded': '<?=T("inGame", "hideCoordinates");?>'
                        });

                    var box = jQuery('#sidebarBoxVillagelist');
                    box.find('button.toggle').click(function(e) {
                        Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'villagelist');
                    });
                });
            </script>
        </div>
        <div class="innerBox content">
            <ul>
                <?=$vars['villages']; ?>
            </ul>
        </div>
        <div class="innerBox footer">
        </div>
    </div>
</div>