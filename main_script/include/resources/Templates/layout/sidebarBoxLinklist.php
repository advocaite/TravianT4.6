<div id="sidebarBoxLinklist" class="sidebarBox   ">
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
                <button type="button" id="<?=$vars['editBlack']; ?>"
                        class="layoutButton <?=$vars['plus'] ? 'editWhite green' : 'editBlack gold'; ?>"
                        onclick="return false;"
                        title="<?=T("links", "Link list"); ?>|| <?=$vars['plus'] ? T("links", "edit link list") : T("links", "Travian Plus allows you to make a link list"); ?>">
                    <div class="button-container addHoverClick">
                        <i></i>
                    </div>
                </button>

                <script type="text/javascript">

                    if (jQuery('#<?=$vars['editBlack'];?>')) {
                        jQuery('#<?=$vars['editBlack'];?>').click(function (event) {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "<?=$vars['plus'] ? 'green' : 'gold';?>",
                                "onclick": "return false;",
                                "loadTitle": false,
                                "boxId": "",
                                "disabled": false,
                                "speechBubble": "",
                                "class": "",
                                "id": "<?=$vars['editBlack'];?>",
                                "redirectUrl": "<?=$vars['plus'] ? "linklist.php" : '';?>",
                                "redirectUrlExternal": "",
                                <?=$vars['plus'] ? '' : '"plusDialog":{"featureKey":"linkList","infoIcon":"http:\/\/t4.answers.travian.us\/index.php?aid=Help#go2answer"},';?>"title": "<?=T("links", "Link list");?> || <?=$vars['plus'] ? T("links", "edit link list") : T("links", "Travian Plus allows you to make a link list");?>"
                            }]);
                        });
                    }
                </script>
            </div>
            <div class="clear"></div>
            <div class="boxTitle"><?=T("links", "Link list"); ?></div>
        </div>
        <div class="innerBox content">
            <?php if(!$vars['plus']): ?>
                <?php if(strlen($vars['links'])):?><ul><?=$vars['links']; ?></ul><?php endif;?>
                <div
                        class="linklistNotice"><?=T("links", "Travian Plus allows you to make a link list"); ?></div>
            <?php elseif($vars['noLinks']): ?>
                <?php if(strlen($vars['links'])):?><ul><?=$vars['links']; ?></ul><?php endif;?>
                <div
                        class="linklistNotice"><?=T("links", "edit link list"); ?></div>
            <?php else: ?>
                <ul><?=$vars['links']; ?></ul>
            <?php endif; ?>
        </div>
        <div class="innerBox footer">
        </div>
    </div>
</div>