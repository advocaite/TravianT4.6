<div id="reportWrapper">
    <div class="header<?=(!$vars['showImage'] ? ' noImages' : null);?>">
        <?php if ($vars['showForward']): ?>
            <div class="headline withQuickNavigation">
                <?php if ($vars['old']['disabled']): ?>
                <a href="#" class="reportQuickNavigation disabled">
                    <?php else: ?>
                    <a href="<?= $vars['old']['link']; ?>" class="reportQuickNavigation">
                        <?php endif; ?>
                        <svg class="chevronBack" viewBox="0 0 20 20" preserveAspectRatio="none">
                            <path d="M19 1L1 10L19 19"></path>
                        </svg>
                    </a>
                    <div class="subject"><?= $vars['subject']; ?></div>
                    <?php if ($vars['next']['disabled']): ?>
                    <a href="#" class="reportQuickNavigation disabled">
                        <?php else: ?>
                        <a href="<?= $vars['next']['link']; ?>" class="reportQuickNavigation">
                            <?php endif; ?>
                            <svg class="chevronForward" viewBox="0 0 20 20" preserveAspectRatio="none">
                                <path d="M1 1L19 10L1 19"></path>
                            </svg>
                        </a>
            </div>
        <?php else:?>
            <div class="headline withQuickNavigation">
                <a href="#" class="reportQuickNavigation disabled">
                    <svg class="chevronBack" viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M19 1L1 10L19 19"></path>
                    </svg>
                </a>
                <div class="subject"><?= $vars['subject']; ?></div>
                <a href="#" class="reportQuickNavigation disabled">
                    <svg class="chevronForward" viewBox="0 0 20 20" preserveAspectRatio="none">
                        <path d="M1 1L19 10L1 19"></path>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
        <div class="time">
            <div class="text"><?= $vars['sendTime']; ?></div>
        </div>
        <div class="toolList">

            <?php if ($vars['showDeleteButton']): ?>
                <button type="button" id="deleteReportButton" class="icon "
                        title="<?= T("Reports", "Delete report"); ?>" onclick="return (function() {
                        (new Travian.Dialog.Dialog({

                        preventFormSubmit: true,
                        onOkay: function(dialog, contentElement) {window.location.href = '?n1=<?= $vars['reportId']; ?>&amp;del=1'}}))
                        .setContent('<?= T("Reports", "Really delete this report?"); ?>')
                        .show();
                        return false;
                        })()"><i class="reportButton delete"></i>
                </button>
            <?php endif; ?>

            <?php if ($vars['isMine']): ?>
                <button type="button" id="markReadButtonReport" class="icon " title="<?= T("Reports", "Mark as unread"); ?>" onclick="window.location.href = 'reports.php?id=<?= $vars['reportId']; ?>&amp;toggleState=1&amp;t=0&amp;s=0'; return false;" useicon="1"><i class="reportButton markRead"></i></button>
            <?php endif; ?>

            <?php if ($vars['showPermissionsButton']): ?>
                <button type="button" class="icon " title="<?= T("Reports", "Access permissions"); ?>"
                        onclick="return Travian.Game.Reports.editRights(this,
                                {
                                text:
                                {
                                anonymOpponent:        '<?= T("Reports", "make opponent anonymous"); ?>',
                                anonymMyself:        '<?= T("Reports", "make myself anonymous"); ?>',
                                hiddenOwnTroops:    '<?= T("Reports", "hide own troops"); ?>',
                                hiddenOtherTroops:    '<?= T("Reports", "hide opposing troops"); ?>',
                                description:        '<?= T("Reports", "Description:"); ?>',
                                buttonTextOk:        '<?= T("Global", "General.save"); ?>',
                                buttonTextCancel:    '<?= T("Global", "General.cancel"); ?>',
                                title:                '<?= T("Reports", "Access permissions"); ?>'
                                },
                                datas:
                                {
                                reportId:    '<?= $vars['reportId']; ?>'
                                }
                                });"><i class="reportButton access"></i></button>
            <?php endif; ?>

            <?php if ($vars['showArchiveButton']): ?>
                <?php if ($vars['hasGoldClub']): ?>
                    <?php if ($vars['archived']): ?>
                    <button type="button" id="archiveGoldclub" class="icon"
                            onclick="window.location.href = '?n1=<?= $vars['reportId']; ?>&amp;recover=1';return false;"
                            title="<?= T("Reports", "Recover"); ?>"><i class="reportButton archive"></i></button>
                <?php else: ?>
                    <button type="button" id="archiveGoldclub" class="icon"
                            onclick="window.location.href = '?n1=<?= $vars['reportId']; ?>&amp;archive=1';return false;"
                            title="<?= T("Reports", "Archive"); ?>"><i class="reportButton archive"></i></button>
                <?php endif; ?>
                <?php else: ?>
                    <button type="button" id="archiveGoldclub" class="icon gold"
                            title="<?= T("Reports", "Archive||For this feature you need the Gold club activated"); ?>">
                        <i class="reportButton archive"></i></button>
                    <script type="text/javascript">jQuery(function () {
                            jQuery('#archiveGoldclub').click(function (event) {
                                jQuery(window).trigger("buttonClicked", [this, {
                                    "goldclubDialog": {
                                        "featureKey": "messageArchive",
                                        "infoIcon": "http:\/\/t4.answers.travian.com\/index.php?aid=Travian Answers#go2answer"
                                    }
                                }]);
                            })
                        });</script>
                <?php endif; ?>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
    </div>
    <div class="body">
        <?php if($vars['showImage'] && isset($vars['bodyImage'])):?>
        <?=$vars['bodyImage'];?>
        <?php endif;?>
        <?php if (isset($vars['includeFile'])): ?>
            <?php require(TEMPLATES_PATH . $vars['includeFile'] . ".php"); ?>
        <?php endif; ?>
        <?= $vars['content']; ?>
    </div>
</div>
