<div id="sidebarBoxInfobox"
     class="sidebarBox <?=$vars['total'] > 1 ? 'toggleable' : ''; ?> <?=$vars['toggle']; ?>">
    <div class="sidebarBoxBaseBox">
        <div class="baseBox baseBoxTop">
            <div class="baseBox baseBoxBottom">
                <div class="baseBox baseBoxCenter"></div>
            </div>
        </div>
    </div>
    <div class="sidebarBoxInnerBox">
        <div class="innerBox header ">
            <div class="boxTitle"><?=T("inGame", "InfoBox"); ?></div>
            <span class="messageShortInfo">
           &lrm;&#8237;&#8237;<?=$vars['unreadCount'] ? $vars['unreadCount'] : $vars['total']; ?>&#8236;×&#8236;&lrm;‏‏<img
                        class="messages<?=$vars['unread']; ?>" src="img/x.gif"
                        title="<?=$vars['title']; ?>"
                        alt="<?=$vars['title']; ?>"/>
        </span>
        </div>
        <div class="innerBox content">
            <ul>
                <?=$vars['content']; ?>
            </ul>
        </div>
        <div class="innerBox footer">
            <?php if ($vars['total'] > 1): ?>
                <button type="button" class="toggle"
                        title="<?=T("inGame",
                            $vars['toggle'] == 'expanded' ? "showMoreMessages" : "hideMoreMessages"); ?>"
                        onclick="">
                    <div class="button-container addHoverClick">
                        <?php if (is_new_gpack()): ?>
                            <svg class="toggle-caret" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 32.9">
                                <style>
                                    .caret {
                                        fill: url(#caret_to_bottom_fill);
                                        stroke: url(#caret_to_bottom_stroke);
                                    }
                                </style>
                                <linearGradient id="caret_to_bottom_fill" x1="22.4983" x2="22.4983" y1="26.6416"
                                                y2="8.0344" gradientUnits="userSpaceOnUse"
                                                gradientTransform="matrix(1 0 0 -1 0 33.833)">
                                    <stop offset=".1147" stop-color="#DADED4"/>
                                    <stop offset=".1452" stop-color="#F9FBF7"/>
                                    <stop offset=".1551" stop-color="#FFFFFF"/>
                                </linearGradient>

                                <linearGradient id="caret_to_bottom_stroke" x1="22.4983" x2="22.4983" y1="26.6416"
                                                y2="8.0344" gradientUnits="userSpaceOnUse"
                                                gradientTransform="matrix(1 0 0 -1 0 33.833)">
                                    <stop offset="0" stop-color="#7C9A58"/>
                                    <stop offset=".2" stop-color="#60A200"/>
                                    <stop offset=".4" stop-color="#63A500"/>
                                    <stop offset="1" stop-color="#7DB211"/>
                                </linearGradient>
                                <path class="down_glow"
                                      d="M39 5.9c-.4-.5-1-.8-1.5-.9H7.4c-.6 0-1.1.2-1.5.9C5.5 6.3 5 7.7 5 9c0 .7 0 2.5.5 3.1l15.1 15.1c.4.5 1.3.7 1.9.7.6 0 1.5-.2 2-.7l14.9-15c.4-.5.6-2 .6-2.7.1-1.2-.5-3.4-1-3.6z"/>
                                <path class="up_glow"
                                      d="M39.2,8.2c-0.4-0.5-1.6-1-2.1-1.1l-29.2,0c-0.6,0-1.6,0.4-2.1,1C5.4,8.6,5,9.7,5,11 c0,0.7,0.1,3.3,1.3,4.8l13,13.1c0.4,0.5,2.5,1,3.1,1c0.6,0,2.7-0.5,3.8-1.5L38.4,16c1.4-1.4,1.6-3.8,1.6-4.5 C40.1,10.3,39.9,8.7,39.2,8.2z"/>
                                <path class="topshadow"
                                      d="M39.8 10.8c.5-1.7.1-5.7-2.5-5.8H7.2c-2.4.1-2.4 4.6-2.1 5.6 0 .1.2.1.2.1.8-.2.9-2 3.4-2.1 6.8-.1 22.1 0 28.5.1 2.6.1 2.1 1.9 2.6 2.1z"/>
                                <path class="bottomshadow"
                                      d="M39.4,8.9C39,8.5,38.5,8.3,38,8.2L7.1,8.3C6.5,8.3,6,8.5,5.6,9C5.2,9.4,5,9.9,5,10.5 c0,0.6-0.2,3.6,1.7,5.6l12.7,12.8c1,0.7,2,1,3.1,1c1.1,0,2.7-0.6,3.8-1.5L38.4,16c1.9-2.1,1.6-5.1,1.6-5.7 C40.1,9.8,39.9,9.3,39.4,8.9z"/>
                                <path class="caret"
                                      d="M38.3 8.8c-.4-.4-.9-.6-1.4-.7H8.1c-.6 0-1.1.2-1.5.7-.4.4-.6.9-.6 1.5s.2 1 .6 1.5L21 26.2c.4.4.9.6 1.5.6s1-.2 1.5-.6l14.3-14.5c.4-.4.6-.9.6-1.5.1-.5-.1-1-.6-1.4z"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function () {
                        Travian.Translation.add(
                            {
                                'infobox_collapsed': '<?=T("inGame", "showMoreMessages");?>',
                                'infobox_expanded': '<?=T("inGame", "hideMoreMessages");?>'
                            });

                        var box = jQuery('#sidebarBoxInfobox');
                        box.find('button.toggle').click(function (e) {
                            Travian.Game.Layout.toggleBox(box, 'travian_toggle', 'infobox');
                        });
                    });
                </script>
            <?php endif; ?>
            <script type="text/javascript">
                jQuery(function () {
                    Travian.Game.Layout.setInfoboxItemsRead();
                    Travian.Game.Layout.setupInfoboxItemsDeletionWithMessage('<?=T("inGame",
                        "Delete this message permanently?");?>', '<?=T("inGame", "Confirm");?>');
                });
            </script>
        </div>
    </div>
</div>