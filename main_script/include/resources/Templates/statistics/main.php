<?php
use Core\Session;
?>
<style type="text/css">
    img.flags {
        margin-top: 5px;
        height: 11px;
        width: 16px;
        background-image: url(<?=get_gpack_cdn_mainPage_url() . 'img_ltr/misc/flags/country_sprite.png';?>);
        border-top: 1px solid #AAA;
    }
</style>
<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'statistics',
           number: '<?= $vars['selectedTabIndex']; ?>'
           },
           onSuccess: function(data)
           {
           if (data.success)
           {
           jQuery('.favor').removeClass('favorActive');
           jQuery('.favor.favorKey<?=$vars['selectedTabIndex']; ?>').addClass('favorActive');
           }
           }
           });
           return false;
           "
   title="<?=$vars['favorText']; ?>"
>&nbsp;</a>
<?php $favorTabId = \Core\Session::getInstance()->getFavoriteTab("statistics"); ?>
<div class="contentNavi subNavi">
    <div
            title=""
            class="container <?=$vars['playersTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 0 ? "favorActive" : ''; ?> favorKey0"
        >

            <a
                    id="<?=$vars['playersTabProperties']['id']; ?>" href="statistiken.php?id=0" class="tabItem">
                <?=$vars['playersTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                          alt="<?=T("Global",
                                                                              "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['playersTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['playersTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['playersTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['playersTabProperties']['id'];?>",
                    "href": "statistiken.php?id=0",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['playersTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['playersTabProperties']['id'];?>"
                }]);

            });
        }
    </script>

    <div
            title=""
            class="container <?=$vars['alliancesTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 1 ? "favorActive" : ''; ?> favorKey1"
        >

            <a
                    id="<?=$vars['alliancesTabProperties']['id']; ?>" href="statistiken.php?id=1"
                    class="tabItem"
            >
                <?=$vars['alliancesTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                            alt="<?=T("Global",
                                                                                "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['alliancesTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['alliancesTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['alliancesTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['alliancesTabProperties']['id'];?>",
                    "href": "statistiken.php?id=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['alliancesTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['alliancesTabProperties']['id'];?>"
                }]);

            });
        }
    </script>


    <div
            title=""
            class="container <?=$vars['villagesTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 2 ? "favorActive" : ''; ?> favorKey2"
        >

            <a
                    id="<?=$vars['villagesTabProperties']['id']; ?>" href="statistiken.php?id=2" class="tabItem"
            >
                <?=$vars['villagesTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                           alt="<?=T("Global",
                                                                               "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['villagesTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['villagesTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['villagesTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['villagesTabProperties']['id'];?>",
                    "href": "statistiken.php?id=2",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['villagesTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['villagesTabProperties']['id'];?>"
                }]);

            });
        }
    </script>
    <div
            title=""
            class="container <?=$vars['heroTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 3 ? "favorActive" : ''; ?> favorKey3"
        >

            <a
                    id="<?=$vars['heroTabProperties']['id']; ?>" href="statistiken.php?id=3" class="tabItem"
            >
                <?=$vars['heroTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                       alt="<?=T("Global",
                                                                           "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['heroTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['heroTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['heroTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['villagesTabProperties']['id'];?>",
                    "href": "statistiken.php?id=3",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['heroTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['heroTabProperties']['id'];?>"
                }]);

            });
        }
    </script>
    <!--
    <div
        title=""
        class="container <?=$vars['plusTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content"
            >

            <a
                id="<?=$vars['plusTabProperties']['id']; ?>" href="statistiken.php?id=4" class="tabItem"
                >
                <?=$vars['plusTabProperties']['text']; ?>                                                        </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['plusTabProperties']['id']; ?>')) {
            jQuery('#<?=$vars['plusTabProperties']['id']; ?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['plusTabProperties']['active'] ? 'active' : 'normal'; ?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['plusTabProperties']['id']; ?>",
                    "href": "statistiken.php?id=4",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['plusTabProperties']['text']; ?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['plusTabProperties']['id']; ?>"
                }]);

            });
        }
    </script>
-->

    <div
            title=""
            class="container <?=$vars['GeneralTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 5 ? "favorActive" : ''; ?> favorKey5"
        >

            <a
                    id="<?=$vars['GeneralTabProperties']['id']; ?>" href="statistiken.php?id=5" class="tabItem"
            >
                <?=$vars['GeneralTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                          alt="<?=T("Global",
                                                                              "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['GeneralTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['GeneralTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['GeneralTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['GeneralTabProperties']['id'];?>",
                    "href": "statistiken.php?id=5",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['GeneralTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['GeneralTabProperties']['id'];?>"
                }]);

            });
        }
    </script>
    <?php if (getDisplay("showBonusTabInStatistics")): ?>
        <div
                title=""
                class="container <?=$vars['BonusTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 7 ? "favorActive" : ''; ?> favorKey7"
            >

                <a
                        id="<?=$button_id = get_button_id(); ?>" href="statistiken.php?id=7" class="tabItem"
                >
                    <?=$vars['BonusTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                            alt="<?=T("Global",
                                                                                "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['BonusTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "statistiken.php?id=7",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['BonusTabProperties']['text'];?>",
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
    <?php if (getDisplay("showFarmsInStatistics")): ?>
        <div
                title=""
                class="container <?=$vars['farmTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 8 ? "favorActive" : ''; ?> favorKey8"
            >

                <a
                        id="<?=$button_id = get_button_id(); ?>" href="statistiken.php?id=8" class="tabItem"
                >
                    <?=$vars['farmTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                           alt="<?=T("Global",
                                                                               "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['farmTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "statistiken.php?id=8",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['farmTabProperties']['text'];?>",
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
    <div
            title=""
            class="container <?=$vars['WonderTabProperties']['active'] ? 'active' : 'normal'; ?>"
    >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
                class="content favor <?=$favorTabId == 6 ? "favorActive" : ''; ?> favorKey6"
        >

            <a
                    id="<?=$vars['WonderTabProperties']['id']; ?>" href="statistiken.php?id=6" class="tabItem"
            >
                <?=$vars['WonderTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                         alt="<?=T("Global",
                                                                             "This tab is set as favourite"); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['WonderTabProperties']['id'];?>')) {
            jQuery('#<?=$vars['GeneralTabProperties']['id'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['WonderTabProperties']['active'] ? 'active' : 'normal';?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$vars['WonderTabProperties']['id'];?>",
                    "href": "statistiken.php?id=6",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=$vars['WonderTabProperties']['text'];?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['WonderTabProperties']['id'];?>"
                }]);

            });
        }
    </script>

    <div class="clear"></div>
</div>

<?php if ($vars['error'] != ""): ?>
    <p class="error"><?=$vars['error']; ?></p>
<?php endif; ?>
<?php if ($vars['selectedTabIndex'] < 2): ?>
    <?php $favorTabId = \Core\Session::getInstance()->getFavoriteTab($vars['selectedTabIndex'] == 0 ? "statisticsTablePlayer" : "statisticsTableAlly"); ?>
    <div class="contentNavi tabNavi tabFavorSubWrapper">

        <div
                title=""
                class="container <?=$vars['overviewSubTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 0 ? "favorActive" : ''; ?> favorKey0"
            >

                <a
                        id="<?=$vars['overviewSubTabProperties']['id']; ?>"
                        href="statistiken.php?id=<?=$vars['selectedTabIndex']; ?>&amp;idSub=0"
                        class="tabItem"
                >
                    <?=$vars['overviewSubTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                                  alt="<?=T("Global",
                                                                                      "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['overviewSubTabProperties']['id'];?>')) {
                jQuery('#<?=$vars['overviewSubTabProperties']['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['overviewSubTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$vars['overviewSubTabProperties']['id'];?>",
                        "href": "statistiken.php?id=<?=$vars['selectedTabIndex'];?>&amp;idSub=0",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['overviewSubTabProperties']['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['overviewSubTabProperties']['id'];?>"
                    }]);

                });
            }
        </script>

        <div
                title=""
                class="container <?=$vars['attackerSubTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 1 ? "favorActive" : ''; ?> favorKey1"
            >

                <a
                        id="<?=$vars['attackerSubTabProperties']['id']; ?>"
                        href="statistiken.php?id=<?=$vars['selectedTabIndex']; ?>&amp;idSub=1"
                        class="tabItem"
                >
                    <?=$vars['attackerSubTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                                  alt="<?=T("Global",
                                                                                      "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['attackerSubTabProperties']['id'];?>')) {
                jQuery('#<?=$vars['attackerSubTabProperties']['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['attackerSubTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$vars['overviewSubTabProperties']['id'];?>",
                        "href": "statistiken.php?id=<?=$vars['selectedTabIndex'];?>&amp;idSub=1",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['attackerSubTabProperties']['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['attackerSubTabProperties']['id'];?>"
                    }]);

                });
            }
        </script>


        <div
                title=""
                class="container <?=$vars['defenderSubTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 2 ? "favorActive" : ''; ?> favorKey2"
            >

                <a
                        id="<?=$vars['defenderSubTabProperties']['id']; ?>"
                        href="statistiken.php?id=<?=$vars['selectedTabIndex']; ?>&amp;idSub=2"
                        class="tabItem"
                >
                    <?=$vars['defenderSubTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                                  alt="<?=T("Global",
                                                                                      "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['defenderSubTabProperties']['id'];?>')) {
                jQuery('#<?=$vars['defenderSubTabProperties']['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['defenderSubTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$vars['defenderSubTabProperties']['id'];?>",
                        "href": "statistiken.php?id=<?=$vars['selectedTabIndex'];?>&amp;idSub=2",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['defenderSubTabProperties']['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['defenderSubTabProperties']['id'];?>"
                    }]);

                });
            }
        </script>

        <div
                title=""
                class="container <?=$vars['top10SubTabProperties']['active'] ? 'active' : 'normal'; ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?=$favorTabId == 3 ? "favorActive" : ''; ?> favorKey3"
            >

                <a
                        id="<?=$vars['top10SubTabProperties']['id']; ?>"
                        href="statistiken.php?id=<?=$vars['selectedTabIndex']; ?>&amp;idSub=3"
                        class="tabItem"
                >
                    <?=$vars['top10SubTabProperties']['text']; ?> <img src="img/x.gif" class="favorIcon"
                                                                               alt="<?=T("Global",
                                                                                   "This tab is set as favourite"); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['top10SubTabProperties']['id'];?>')) {
                jQuery('#<?=$vars['top10SubTabProperties']['id'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['top10SubTabProperties']['active'] ? 'active' : 'normal';?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$vars['top10SubTabProperties']['id'];?>",
                        "href": "statistiken.php?id=<?=$vars['selectedTabIndex'];?>&amp;idSub=3",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=$vars['top10SubTabProperties']['text'];?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['top10SubTabProperties']['id'];?>"
                    }]);

                });
            }
        </script>
        <a type="submit" id="nestedTabFavorButton" class="icon nestedTabRowButton" title="<?= $vars['favorText2'] ?>"
           onclick="Travian.ajax({data: {cmd: 'tabFavorite',name: '<?= ($vars['selectedTabIndex'] == 0 ? "statisticsTablePlayer" : "statisticsTableAlly"); ?>',number: '<?= $vars['selectedSubIndex']; ?>'},onSuccess: function(data) {if (data.success) { jQuery('.tabFavorSubWrapper .favor').removeClass('favorActive');jQuery('.tabFavorSubWrapper .favor.favorKey<?= $vars['selectedSubIndex']; ?>').addClass('favorActive');}}});return false;"><img
                    src="img/x.gif" class="&nbsp;" alt="&nbsp;"></a>
        <div class="clear"></div>
    </div>
<?php endif; ?>
<?php
if(Session::getInstance()->isAdmin()){
    $showFakeUsers = Session::getCookie('showFakeUsers', 0);
    echo '<div>';
    echo getButton(
        [
            "type"    => "button",
            "class"   => "green" . (!$showFakeUsers ? ' disabled' : null),
            "style" => "cursor: pointer",
            'onclick' => "window.location.href = '?showFakeUsers=".($showFakeUsers ? 0 : 1)."'",
        ],
        ["data" => ["type" => "button", "class" => "green" . (!$showFakeUsers ? ' disabled' : null)]],
        'Show fake users: ' . ($showFakeUsers ? 'On' : 'Off')
    );
    echo '<br />';
    echo '<br />';
    echo '<div class="clear"></div>';
    echo '</div>';
}
?>
<?=$vars['other']; ?>
