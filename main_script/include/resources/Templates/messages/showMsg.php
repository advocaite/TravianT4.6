<div id="messageNavigation">
    <div id="backToInbox">
        <a href="messages.php<?=$vars['send'] ? '?t=2' : '';?>"><?=T("Messages", $vars['send'] ? "back to send box" : "back to the inbox");?></a>
    </div>
    <div class="clear"></div>
</div>
<div class="paper">
    <div class="layout">
        <div class="paperTop">
            <div class="paperContent">
                <?php if($vars['isAdmin']):?>
                    <div id="sender">
                        <div class="header label"><?=T("Messages", "sender");?>:</div>
                        <?php if($vars['isAllianceAutoType']):?>
                            <div class="header text"><a href="<?=getAnswersUrl();?>aid=4#go2answer"
                                                        target="_blank"><?=$vars['name'];?></a></div>
                        <?php else:?>
                            <div class="header text"><a href="spieler.php?uid=<?=$vars['info']['uid'];?>"><?=$vars['info']['name'];?></a></div>
                        <?php endif;?>
                        <div class="clear"></div>
                        <div class="header label"><?=T("Messages", "Recipient");?>:</div>
            <?php if($vars['isAllianceAutoType']):?>
                            <div class="header text"><a href="<?=getAnswersUrl();?>aid=4#go2answer"
                                                        target="_blank"><?=$vars['info']['to_name'];?></a></div>
                        <?php else:?>
                            <div class="header text"><a href="spieler.php?uid=<?=$vars['info']['to_uid'];?>"><?=$vars['info']['to_name'];?></a></div>
                        <?php endif;?>
                        <div class="clear"></div>
                    </div>
                <?php else:?>
                    <div id="sender">
                        <div class="header label"><?=$vars['send'] ? T("Messages", "Recipient") : T("Messages", "sender");?>:</div>
                        <?php if($vars['isAllianceAutoType']):?>
                            <div class="header text"><a href="<?=getAnswersUrl();?>aid=4#go2answer"
                                                        target="_blank"><?=$vars['name'];?></a></div>
                        <?php else:?>
                            <div class="header text"><a href="spieler.php?uid=<?=$vars['uid'];?>"><?=$vars['name'];?></a></div>
                        <?php endif;?>
                        <div class="clear"></div>
                    </div>
                <?php endif;?>

                <div id="subject">
                    <div class="header label"><?=T("Messages", "Subject");?>:</div>
                    <div class="header text"><?=$vars['subject'];?></div>
                    <div class="clear"></div>
                </div>

                <div id="time">
                    <div class="header label"><?=T("Messages", "Sent at");?>:</div>
                    <div class="header text"><?=$vars['time'];?></div>

                    <div class="toolList">
                        <div id="deleteMessage">
                            <form method="post" action="messages.php">
                                <input type="hidden" name="n1" value="<?=$vars['id'];?>" id="n1">
                                <input type="hidden" name="t" value="<?=$vars['t'];?>" id="t">
                                <?php if($vars['send']==0 and $vars['reported']==0 and $vars['reportable']==true):?>
                                    <a href="#" id="reportSpam" class="a arrow" onclick='
                                            Travian.Game.ReportSpamMessagesDialog.reportSpam(
                                            "<?=$vars['id'];?>",
                                            "<?=T("Messages", "Report as spam");?>",
                                            "<?=T("Messages", "report");?>",
                                            "<?=T("Messages", "Attention: Misuse of the report function is punishable");?>",
                                            {
                                            "not_chosen":"<?=T("Messages", "Choose reason");?>",
                                            "advertisement":"<?=T("Messages", "Advertisement");?>",
                                            "harassment":"<?=T("Messages", "harassment");?>",
                                            "gold":"<?=T("Messages", "gold");?>",
                                            "misc":"<?=T("Messages", "Other");?>"
                                            }
                                            );
                                            return false;'><?=T("Messages", "Report as spam");?></a>
                                <?php elseif($vars['reported']>0):?>
                                    <span class="notice"><?=$vars['reportedText'];?></span>
                                <?php endif;?>
                                <button type="submit" name="delmsg" id="delmsg" class="icon "
                                        onclick="return (function() {
                                                (new Travian.Dialog.Dialog({

                                                preventFormSubmit: true,
                                                onOkay: function(dialog, contentElement) {jQuery('#delmsg').closest('form').submit();}}))
                                                .setContent('<?=T("Messages", "ConfirmDelete");?>')
                                                .show();
                                                return false;
                                                })()" title="<?=T("Messages", "Delete");?>">
                                    <img src="img/x.gif" class="Delete delete" alt="Delete delete"></button>
                                <input type="hidden" name="delmsg" value="1">
                            </form>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="separator"></div>
                <div id="message"><?=$vars['message'];?></div>

                <div id="answer">
                    <form method="post" action="messages.php">
                        <input type="hidden" name="id" value="<?=$vars['id'];?>" id="id">
                        <input type="hidden" name="t" value="1" id="t">
                        <?php if($vars['send'] == 0):?>
                            <button type="submit" value="<?=T("Messages", "Mark as unread");?>" name="toggleState"
                                    id="toggleState" class="green ">
                                <div class="button-container addHoverClick">
                                    <div class="button-background">
                                        <div class="buttonStart">
                                            <div class="buttonEnd">
                                                <div class="buttonMiddle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-content"><?=T("Messages", "Mark as unread");?></div>
                                </div>
                            </button>
                            <script type="text/javascript">
                                jQuery(function() {
                                    if (jQuery('#toggleState')) {
                                        jQuery('#toggleState').click(function (event) {
                                            jQuery(window).trigger('buttonClicked', [this, {
                                                "type": "submit",
                                                "value": "<?=T("Messages", "Mark as unread");?>",
                                                "name": "toggleState",
                                                "id": "toggleState",
                                                "class": "green ",
                                                "title": "",
                                                "confirm": "",
                                                "onclick": ""
                                            }]);
                                        });
                                    }
                                });
                            </script>
                        <?php endif;?>

                        <button type="submit" value="answer" name="ss" id="ss"
                                class="green <?=$vars['answerActive'] == 0 ? 'disabled' : '';?>"<?=$vars['answerActive'] == 0 ? ' onClick="return false;"' : '';?>>
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=T("Messages", "answer");?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                            jQuery(function() {
                                if (jQuery('#ss')) {
                                    jQuery('#ss').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "submit",
                                            "value": "answer",
                                            "name": "ss",
                                            "id": "ss",
                                            "class": "green <?=$vars['answerActive'] == 0 ? 'disabled' : '';?>",
                                            "title": "",
                                            "confirm": "",
                                            "onclick": "<?=$vars['answerActive'] == 0 ? 'return false;' : '';?>"
                                        }]);
                                    });
                                }
                            });
                        </script>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="paperBottom"></div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function() {
    });
</script>