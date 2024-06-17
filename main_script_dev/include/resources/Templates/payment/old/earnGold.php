<div class="contentBorder infoArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <h4><?php use Core\Config;
            use Core\Helper\WebService;
            use Core\Session;

            echo T("PaymentWizard", "How can I invite players?"); ?></h4>

        <div class="howToDescription">
            <?=T("PaymentWizard",
                "If you invite players to open an account in Travian on this server, you can receive Gold as a reward, You can use this Gold to purchase a Plus Account or other Gold advantages"); ?>
            <br/>
            <br/>
            <?=T("PaymentWizard",
                "To bring in new players, you can invite them by email or have them click on your REF link"); ?>
            <br/>
            <?=T("PaymentWizard", "As soon as an invited player has reached x villages"); ?>
        </div>
        <div class="footer"><a class="showEarnGoldPage"
                               href="#"><?=T("PaymentWizard", "back to overview"); ?></a>
        </div>
    </div>
</div>
<div class="contentBorder contentArea">
    <div class="contentBorder-tl"></div>
    <div class="contentBorder-tr"></div>
    <div class="contentBorder-tc"></div>
    <div class="contentBorder-ml"></div>
    <div class="contentBorder-mr"></div>
    <div class="contentBorder-mc"></div>
    <div class="contentBorder-bl"></div>
    <div class="contentBorder-br"></div>
    <div class="contentBorder-bc"></div>
    <div class="contentBorder-contents cf">
        <div class="earnGoldPage earnGoldOverview" style="display: block;">
            <h4><?=T("PaymentWizard", "Choose an option to earn gold"); ?></h4>
            <?php if (Config::getAdvancedProperty("refLimit") > 0): ?>
                <div class="boxes roundedContentBox">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf">
                        <h5><?=T("PaymentWizard", "Send link to friends"); ?></h5>

                        <div
                                class="boxContent"><?=T("PaymentWizard",
                                "You can send a link to your friends via email, inviting them to Travian"); ?></div>
                        <div class="footer"><a
                                    class="showEarnGoldPage earnGoldMailSend"
                                    href="#"><?=T("PaymentWizard", "Send email to friends"); ?></a>
                        </div>
                    </div>
                </div>
                <div class="boxes roundedContentBox">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf">
                        <h5><?=T("PaymentWizard", "Your personal referral link"); ?></h5>

                        <div class="boxContent">
                            <?=$vars['inviteLink'];?>
                        </div>
                        <div class="footer"></div>
                    </div>
                </div>
                <div class="boxes roundedContentBox">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf">
                        <h5><?=T("PaymentWizard", "Players invited so far"); ?></h5>

                        <div
                                class="boxContent"><?=T("PaymentWizard",
                                "Display a list of all the players you have invited so far"); ?></div>
                        <div class="footer"><a
                                    class="showEarnGoldPage earnGoldDrumUps"
                                    href="#"><?=T("PaymentWizard",
                                    "Display list of all invited players"); ?></a>
                        </div>
                    </div>
                </div>
                <?php if (!$vars['invitationStatus']): ?>
                    <div class="boxes roundedContentBox red">
                        <div class="boxes-tl"></div>
                        <div class="boxes-tr"></div>
                        <div class="boxes-tc"></div>
                        <div class="boxes-ml"></div>
                        <div class="boxes-mr"></div>
                        <div class="boxes-mc"></div>
                        <div class="boxes-bl"></div>
                        <div class="boxes-br"></div>
                        <div class="boxes-bc"></div>
                        <div class="boxes-contents cf"><h5><?= T("PaymentWizard", "Invitation is closed"); ?></h5>
                            <div class="boxContent"><?= T("PaymentWizard", "Server is closed for invitations"); ?></div>
                            <div class="footer"></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif (Config::getAdvancedProperty("refLimit") <= 0): ?>
                <div class="boxes roundedContentBox red">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf"><h5><?= T("PaymentWizard", "Invitation is closed"); ?></h5>
                        <div class="boxContent"><?= T("PaymentWizard", "This feature is disabled"); ?></div>
                        <div class="footer"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($vars['invitationStatus'] && Config::getAdvancedProperty("refLimit") > 0): ?>
            <div class="earnGoldPage earnGoldMailSend">
                <h4><?=T("PaymentWizard", "Please enter recipients email addresses"); ?>:</h4>
                <div class="receiverBlock">
                    <div class="receiverLines">
                        <div class="receiverLine">
                            <?=T("PaymentWizard", "Recipient 1"); ?>:<input
                                    class="text" type="text"
                                    name="receiver[]" value="">
                        </div>
                        <div class="receiverLine">
                            <?=T("PaymentWizard", "Recipient 2"); ?>:<input
                                    class="text" type="text"
                                    name="receiver[]" value="">
                        </div>
                    </div>
                    <div class="receiverLinkLine">
                        <a class="earnGoldAddLink receiverAddLink"
                           href="#"><?=T("PaymentWizard", "Add more people"); ?></a>
                    </div>
                </div>
                <h4><?=T("PaymentWizard", "Add a personal message (optional)"); ?>:</h4>
                <div class="message">
				<textarea class="earnGoldSendMailMessage"
                          name="earnGoldSendMailMessage" cols="50"
                          rows="10"></textarea>
                </div>
                <div class="buttonLine">
                    <button type="button" value="Cancel"
                            id="<?=$button_id = get_button_id(); ?>"
                            class="green earnGoldSendMailCancel">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="button-content"><?=T("PaymentWizard", "Cancel"); ?></div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        jQuery(function() {
                            if (jQuery('#<?=$button_id;?>')) {
                                jQuery('#<?=$button_id;?>').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "button",
                                        "value": "<?=T("PaymentWizard", "Cancel");?>",
                                        "name": "",
                                        "id": "<?=$button_id;?>",
                                        "class": "green earnGoldSendMailCancel",
                                        "title": "<?=T("PaymentWizard", "Cancel");?>",
                                        "confirm": "",
                                        "onclick": ""
                                    }]);
                                });
                            }
                        });
                    </script>
                    <button type="button"
                            value="<?=T("PaymentWizard", "Send invitation"); ?>"
                            id="<?=$button_id = get_button_id(); ?>"
                            class="green earnGoldSendMailSubmit">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                    class="button-content"><?=T("PaymentWizard", "Send invitation"); ?></div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        jQuery(function() {
                            if (jQuery('#<?=$button_id;?>')) {
                                jQuery('#<?=$button_id;?>').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "button",
                                        "value": "<?=T("PaymentWizard", "Send invitation");?>",
                                        "name": "",
                                        "id": "<?=$button_id;?>",
                                        "class": "green earnGoldSendMailSubmit",
                                        "title": "<?=T("PaymentWizard", "Send invitation");?>",
                                        "confirm": "",
                                        "onclick": ""
                                    }]);
                                });
                            }
                        });
                    </script>
                    <div class="clear"></div>
                </div>
                <div class="messageLine">
                    <?=$vars['messageLine']; ?>
                </div>
            </div>
            <div class="earnGoldPage earnGoldDrumUps">
                <h4><?=T("PaymentWizard", "Players invited so far"); ?></h4>
                <div class="earnGoldAdvertisedPersonsList"></div>
            </div>
        <?php endif; ?>
        <script type="text/javascript">
            Travian.Translation.add(
                {
                    'earnGoldContentMailSendReceiverCount': '<?=T("PaymentWizard",
                        "Recipient [RECEIVER_COUNT]:");?>'
                });
        </script>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    jQuery(function() {
        Travian.Translation.add(
            {
                'paymentWizard.infoButtonLabel': '<?=T("PaymentWizard", "Travian Answers");?>'
            });
    });
</script>