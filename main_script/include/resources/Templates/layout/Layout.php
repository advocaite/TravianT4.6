<?php

use Core\Config;
use Core\Helper\TimezoneHelper;


?>
<?php require __DIR__ . "/head.php"; ?>
<body class="v35 webkit chrome <?=get_locale();?> <?= Config::getProperty("settings", "global_css_class"); ?> <?=$vars['contentCssClass']; ?> <?= $vars['colorBlind'] ? 'colorBlind' : ''; ?> <?=$vars['bodyCssClass']; ?> <?= (getDirection() == 'RTL' ? 'rtl' : 'ltr'); ?> season-<?= detect_season(); ?> buildingsV1">
<div id="reactDialogWrapper"></div>
<div id="background">
    <?php
    if ($vars['headerBar']) {
        echo '<div id="headerBar"></div>';
    }
    ?>
    <div id="bodyWrapper">
        <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt=""/>

        <div id="header">
            <a id="logo" href="<?=Config::getInstance()->settings->indexUrl; ?>" target="_blank"
               title="<?=T("Global", "Travian"); ?>"></a>
            <?php
            if ($vars['showNavBar']) {
                ?>

                <ul id="navigation">
                    <li id="n1" class="villageResources">
                        <a class="<?=$vars['bodyCssClass'] == 'perspectiveBuildings' ? 'in' : ''; ?>active"
                           href="dorf1.php"
                           accesskey="1"
                           title="<?=T("inGame", "Navigation.Resources"); ?>||"></a>
                    </li>
                    <li id="n2" class="villageBuildings">
                        <a class="<?=$vars['bodyCssClass'] == 'perspectiveResources' ? 'in' : ''; ?>active"
                           href="dorf2.php"
                           accesskey="2"
                           title="<?=T("inGame", "Navigation.Buildings"); ?>||"></a>
                    </li>
                    <li id="n3" class="map">
                        <a href="karte.php" accesskey="3"
                           title="<?=T("inGame", "Navigation.Map"); ?>||"></a>
                    </li>
                    <li id="n4" class="statistics">
                        <a href="statistiken.php" accesskey="4"
                           title="<?=T("inGame", "Navigation.Statistics"); ?>||"></a>
                    </li>
                    <li id="n5" class="reports">
                        <a href="reports.php" accesskey="5"
                           title="<?=T("inGame", "Navigation.Reports"); ?>||<?=T("inGame",
                               "Navigation.newReports"); ?>: <?=$vars['newReportsCount']; ?>"></a>
                        <?php if ($vars['newReportsCount']): ?>
                            <div class="speechBubbleContainer ">
                                <div class="speechBubbleBackground">
                                    <div class="start">
                                        <div class="end">
                                            <div class="middle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="speechBubbleContent"><?=$vars['newReportsCount'] > 99 ? '+99' : $vars['newReportsCount']; ?></div>
                            </div>
                            <div class="clear"></div>
                        <?php endif; ?>
                    </li>
                    <li id="n6" class="messages">
                        <a href="messages.php" accesskey="6"
                           title="<?=T("inGame", "Navigation.Messages"); ?>||<?=T("inGame",
                               "Navigation.newMessages"); ?>: <?=$vars['newMessagesCount']; ?>"></a>
                        <?php if ($vars['newMessagesCount']): ?>
                            <div class="speechBubbleContainer ">
                                <div class="speechBubbleBackground">
                                    <div class="start">
                                        <div class="end">
                                            <div class="middle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                        class="speechBubbleContent"><?=$vars['newMessagesCount'] > 99 ? '+99' : $vars['newMessagesCount']; ?></div>
                            </div>
                            <div class="clear"></div>
                        <?php endif; ?>
                    </li>
                    <li id="n7" class="gold">
                        <a href="#" accesskey="7"
                           title="<?=T("inGame", "Navigation.Buy gold"); ?>"
                           onclick="jQuery(window).trigger('startPaymentWizard', {}); this.blur(); return false;"></a>
                    </li>
                    <li class="clear">&nbsp;</li>
                </ul>
                <div id="goldSilver">
                    <div class="gold">
                        <img src="img/x.gif" alt="<?=T("inGame", "gold"); ?>"
                             title="<?=T("inGame", "gold"); ?>"
                             class="gold"
                             onclick="jQuery(window).trigger('startPaymentWizard', {data:{activeTab: 'pros'}}); return false;"/>
                        <span
                                class="ajaxReplaceableGoldAmount">
            <?php if (getCustom("serverIsFreeGold")): ?>
                <b><?= T("Global", "Unlimited"); ?></b>
            <?php else: ?>
                <?=$vars['goldCount']; ?>
            <?php endif; ?>
        </span>
                    </div>
                    <div class="silver">
                        <img src="img/x.gif" alt="<?=T("inGame", "silver"); ?>"
                             title="<?=T("inGame", "silver"); ?>"
                             class="silver"
                             onclick="jQuery(window).trigger('startPaymentWizard', {data:{activeTab: 'pros'}}); return false;"/>
                        <span
                                class="ajaxReplaceableSilverAmount"><?=$vars['silverCount']; ?></span>
                    </div>
                </div>
                <ul id="outOfGame" class="<?=getDirection(); ?>">
                    <li class="profile">
                        <a href="spieler.php"
                           title="<?=T("inGame", "Profile.Profile"); ?>||<?=T("inGame",
                               "Profile.edit profile description"); ?>">
                            <img src="img/x.gif"
                                 alt="<?=T("inGame", "Profile.Profile"); ?>"/>
                        </a>
                    </li>
                    <li class="options">
                        <?php if (!$vars['isSitter']): ?>
                            <a href="options.php"
                               title="<?=T("inGame", "Options.Options"); ?>||<?=T("inGame",
                                   "Options.edit account settings"); ?>">
                                <img src="img/x.gif"
                                     alt="<?=T("inGame", "Options.Options"); ?>"/>
                            </a>
                        <?php else: ?>
                            <div class="a disabled"
                                 title="<?=T("inGame",
                                     "Options.Options"); ?>||<?=htmlspecialchars('<span class="warning">' . T("inGame",
                                         "Options.you may not edit settings of another account") . '</span>'); ?>">
                                <img src="img/x.gif"
                                     alt="<?=T("inGame", "Options.Options"); ?>"/>
                            </div>
                        <?php endif; ?>
                    </li>
                    <li class="forum">
                        <a target="_blank" href="<?=getForumUrl(); ?>"
                           title="<?=T("inGame", "Forum.Forum"); ?>||<?=T("inGame",
                               "Forum.Meet other players on our external forum"); ?>">
                            <img src="img/x.gif"
                                 alt="<?=T("inGame", "Forum.Forum"); ?>"/>
                        </a>
                    </li>
                    <?php
                    /*<li class="chat">
                        <a target="_blank" href="http://natar.travian.org:8080" title="Chat||Chat in IRC with other players from your server.">
                            <img src="img/x.gif" alt="Chat" />
                        </a>
                    </li>*/
                    ?>
                    <li class="help">
                        <a href="help.php"
                           title="<?=T("inGame", "Help.Help"); ?>||<?=T("inGame",
                               "Help.Manuals, Answers and Support"); ?>">
                            <img src="img/x.gif" alt="<?=T("inGame", "Help.Help"); ?>"/>
                        </a>
                    </li>
                    <li class="logout ">
                        <a href="logout.php"
                           title="<?=T("inGame", "Logout.Logout"); ?>||<?=T("inGame",
                               "Logout.Log out from the game"); ?>">
                            <img src="img/x.gif"
                                 alt="<?=T("inGame", "Logout.Logout"); ?>"/>
                        </a>
                    </li>
                    <li class="clear">&nbsp;</li>
                </ul>
                <script type="text/javascript">
                    jQuery('#outOfGame li.logout a').click(function () {
                        var windows = Travian.WindowManager.getWindows();
                        for (var i = 0; i < windows.length; i++) {
                            Travian.WindowManager.unregister(windows[i]);
                        }
                    });
                </script>

            <?php
            } else if ($vars['headerBar']) {
            ?>
                <ul id="outOfGame" class="<?=getDirection(); ?>">
                    <li class="logout logoutOnly">
                        <a href="logout.php"
                           title="<?=T("inGame", "Logout.Logout"); ?>||<?=T("inGame",
                               "Logout.Log out from the game"); ?>">
                            <img src="img/x.gif"
                                 alt="<?=T("inGame", "Logout.Logout"); ?>"/>
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
        <div id="center">
            <div id="sidebarBeforeContent" class="sidebar beforeContent">
                <?=$vars['sidebarBeforeContent']; ?>
                <div class="clear"></div>
            </div>
            <div id="contentOuterContainer" class="size1">
                <?php
                if (isset($vars['stockBar']) && $vars['showStockbar']):?>
                    <ul id="stockBar">
                        <li id="stockBarWarehouseWrapper" class="stock"
                            title="<?=T("Buildings", "10.title"); ?>">
                            <i class="warehouse"></i>
                            <span class="value"
                                  id="stockBarWarehouse" style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"
                            ><?=number_format_x($vars['stockBar']['maxstore'], 9 * 1e6); ?></span>
                        </li>
                        <li id="stockBarResource1" class="stockBarButton"
                            title="<?=$vars['stockBar']['titles'][0]; ?>">
                            <div class="begin"></div>
                            <div class="middle">
                                <i class="r1"></i>
                                <?php if ($vars['stockBar']['productionBoost'][0]): ?>
                                    <img src="img/x.gif" class="productionBoost"
                                         alt="">
                                <?php endif; ?>
                                <span id="l1"
                                      class="value"
                                      style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"><?=$vars['stockBar']['storageString'][0]; ?></span>

                                <div class="barBox">
                                    <div id="lbar1"
                                         class="bar stock<?=$vars['stockBar']['storageClass'][0];?>"
                                         style="width:<?=$vars['stockBar']['percents'][0]; ?>%;"></div>
                                </div>
                                <a href="production.php?t=1"
                                   title="<?=$vars['stockBar']['titles'][0]; ?>"><img
                                            src="img/x.gif"
                                            alt=""/></a>
                            </div>
                            <div class="end"></div>
                        </li>
                        <li id="stockBarResource2" class="stockBarButton"
                            title="<?=$vars['stockBar']['titles'][1]; ?>">
                            <div class="begin"></div>
                            <div class="middle">
                                <i class="r2"></i>
                                <?php if ($vars['stockBar']['productionBoost'][1]): ?>
                                    <img src="img/x.gif" class="productionBoost"
                                         alt="">
                                <?php endif; ?>
                                <span id="l2"
                                      class="value"
                                      style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"><?=$vars['stockBar']['storageString'][1]; ?></span>

                                <div class="barBox">
                                    <div id="lbar2"
                                         class="bar stock<?=$vars['stockBar']['storageClass'][1];?>"
                                         style="width:<?=$vars['stockBar']['percents'][1]; ?>%;"></div>
                                </div>
                                <a href="production.php?t=2"
                                   title="<?=$vars['stockBar']['titles'][1]; ?>"><img
                                            src="img/x.gif"
                                            alt=""/></a>
                            </div>
                            <div class="end"></div>
                        </li>
                        <li id="stockBarResource3" class="stockBarButton"
                            title="<?=$vars['stockBar']['titles'][2]; ?>">
                            <div class="begin"></div>
                            <div class="middle">
                                <i class="r3"></i>
                                <?php if ($vars['stockBar']['productionBoost'][2]): ?>
                                    <img src="img/x.gif" class="productionBoost"
                                         alt="">
                                <?php endif; ?>
                                <span id="l3"
                                      class="value"
                                      style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"><?=$vars['stockBar']['storageString'][2]; ?></span>

                                <div class="barBox">
                                    <div id="lbar3"
                                         class="bar stock<?=$vars['stockBar']['storageClass'][2];?>"
                                         style="width:<?=$vars['stockBar']['percents'][2]; ?>%;"></div>
                                </div>
                                <a href="production.php?t=3"
                                   title="<?=$vars['stockBar']['titles'][2]; ?>"><img
                                            src="img/x.gif"
                                            alt=""/></a>
                            </div>
                            <div class="end"></div>
                        </li>

                        <li id="stockBarGranaryWrapper" class="stock"
                            title="<?=T("Buildings", "11.title"); ?>">
                            <i class="granary"></i>
                            <span class="value" id="stockBarGranary" style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"
                            ><?=number_format_x($vars['stockBar']['maxcrop'], 9 * 1e6); ?></span>
                        </li>

                        <li id="stockBarResource4" class="stockBarButton"
                            title="<?=htmlspecialchars($vars['stockBar']['titles'][3]); ?>">
                            <div class="begin"></div>
                            <div class="middle">
                                <i class="r4"></i>
                                <?php if ($vars['stockBar']['productionBoost'][3]): ?>
                                    <img src="img/x.gif" class="productionBoost"
                                         alt="">
                                <?php endif; ?>
                                <span id="l4"
                                      class="value <?= ($vars['stockBar']['production'][3] < 0 ? 'alert' : ''); ?>"
                                      style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 9px;' : ''); ?>"><?=$vars['stockBar']['storageString'][3]; ?></span>

                                <div class="barBox">
                                    <div id="lbar4"
                                         class="bar stock<?=$vars['stockBar']['storageClass'][3];?>"
                                         style="width:<?=$vars['stockBar']['percents'][3]; ?>%;"></div>
                                </div>
                                <a href="production.php?t=4"
                                   title="<?=htmlspecialchars($vars['stockBar']['titles'][3]); ?>"><img
                                            src="img/x.gif"
                                            alt=""/></a>
                            </div>
                            <div class="end"></div>
                        </li>

                        <li id="stockBarFreeCropWrapper" class="stockBarButton r5"
                            title="<?=$vars['stockBar']['titles'][4]; ?>">
                            <div class="begin"></div>
                            <div class="middle">
                                <i class="r5"></i>
                                <span id="stockBarFreeCrop"
                                      class="value"
                                      style="<?= (getDisplay("smallResourcesFontSize") ? 'font-size: 8px;' : ''); ?>"><?=$vars['stockBar']['production'][4]; ?></span>
                                <a href="production.php?t=5"
                                   title="<?=$vars['stockBar']['titles'][4]; ?>"><img
                                            src="img/x.gif"
                                            alt=""/></a>
                            </div>
                            <div class="end"></div>
                        </li>
                        <li class="clear">&nbsp;</li>
                    </ul>

                    <script type="text/javascript">
                        var resources = {};

                        resources.production = {
                            "l1": <?=$vars['stockBar']['production'][0];?>,
                            "l2": <?=$vars['stockBar']['production'][1];?>,
                            "l3": <?=$vars['stockBar']['production'][2];?>,
                            "l4": <?=$vars['stockBar']['production'][3];?>,
                            "l5": <?=$vars['stockBar']['production'][4];?>
                        };
                        resources.storage = {
                            "l1": <?=$vars['stockBar']['storage'][0];?>,
                            "l2": <?=$vars['stockBar']['storage'][1];?>,
                            "l3": <?=$vars['stockBar']['storage'][2];?>,
                            "l4": <?=$vars['stockBar']['storage'][3];?>
                        };
                        resources.maxStorage = {
                            "l1": <?=$vars['stockBar']['maxstore'];?>,
                            "l2": <?=$vars['stockBar']['maxstore'];?>,
                            "l3": <?=$vars['stockBar']['maxstore'];?>,
                            "l4": <?=$vars['stockBar']['maxcrop'];?>
                        };
                    </script>
                <?php endif; ?>
                <div class="contentTitle">
                    <?php if ($vars['showCloseButton']): ?>
                        <a id="closeContentButton" class="contentTitleButton"
                           href="<?=$vars['bodyCssClass'] == 'perspectiveResources' ? 'dorf1.php' : 'dorf2.php'; ?>"
                           title="<?=T("Global", "General.closeWindow"); ?>">
                            &nbsp;</a>
                    <?php endif; ?>
                    <?php if ($vars['answerId']): ?>
                        <a id="answersButton" class="contentTitleButton"
                           href="<?=getAnswersUrl(); ?>aid=<?=$vars['answerId']; ?>#go2answer"
                           target="_blank"
                           title="<?=T("Global", "FAQ"); ?>">&nbsp;</a>
                    <?php endif; ?>
                </div>
                <div class="contentContainer">
                    <div id="content"
                         class="<?=$vars['contentCssClass']; ?>">
                        <?php
                        if ($vars['titleInHeader']) {
                            echo '<h1 class="titleInHeader">' . $vars['titleInHeader'] . '</h1>';
                        }
                        echo $vars['content'];
                        ?>
                        <div class="clear"></div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                <div class="contentFooter"></div>
            </div>
            <div id="sidebarAfterContent" class="sidebar afterContent">
                <?=$vars['sidebarAfterContent']; ?>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <div id="footer">
            <!--email_off-->
            <div id="pageLinks">
                <a href="<?=Config::getInstance()->settings->indexUrl; ?>"
                   target="_blank"><?=T("Global", "Footer.HomePage"); ?></a>
                <a href="<?=getForumUrl(); ?>"
                   target="_blank"><?=T("Global", "Footer.Forum"); ?></a>
                <a href="<?=Config::getInstance()->settings->indexUrl; ?>links.php"
                   target="_blank"><?=T("Global", "Footer.Links"); ?></a>
                <a href="<?=getAnswersUrl(); ?>"
                   target="_blank"><?=T("Global", "Footer.FAQ"); ?></a>
                <a href="<?=Config::getInstance()->settings->indexUrl; ?>agb.php"
                   target="_blank"><?=T("Global", "Footer.Terms"); ?></a>
                <a href="<?=Config::getInstance()->settings->indexUrl; ?>impressum.php"
                   target="_blank"><?=T("Global", "Footer.Imprint"); ?></a>
                <div class="clear"></div>
            </div>
            <br/>
            <p class="copyright" style="direction:ltr;">© 2011 - <?=date("Y"); ?> Travian Games GmbH</p>
            <?php if (getDisplay("showCopyright")): ?>
                <p class="copyright" style="direction:ltr;">
                    Developed By <a style="font-weight: bold; color: orange;" href="mailto:chamirhossein@gmail.com">Amirhossein</a>.
                </p>
                <div id="pageLinks">
                    <a href="/credits.php"><?=empty(T("Global", "Footer.Credits")) ? 'Credits' : T("Global",
                            "Footer.Credits"); ?></a>
                    <div class="clear"></div>
                </div>
            <?php endif; ?>
            <!--/email_off-->
            <br/>
        </div>
        <?php
        if ($vars['headerBar']) {
            if (!isset($vars['dateTime'])) {
                $vars['dateTime'] = time();
            }
            ?>
            <div id="servertime" class="stime">
                <?=T("inGame", "serverTime"); ?>:&nbsp;
                <?=appendTimer($vars['dateTime'], 1); ?>
            </div>
        <?php } ?>
    </div>
    <div id="ce"></div>
</div>
<script type="text/javascript">
    <?php
    $feature_flags = [
        'vacationMode'            => true,
        "territory"               => false,
        "heroitems"               => true,
        "allianceBonus"           => true,
        "boostedStart"            => false,
        "pushingProtectionAlways" => false,
        "tribesEgyptiansAndHuns"  => false,
        "hideFoolsArtifacts"      => false,
        "welcomeScreen"           => false
    ];
    ?>
    var T4_feature_flags = <?=json_encode($feature_flags);?>
</script>
</body>
</html>
<!---- This page was generated in <?= round(1000 * (microtime(true) - $GLOBALS['start_time']), 2); ?> ms ---->
