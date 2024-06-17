<h4><span style="color: red"><?= T("EVerify", "VERIFICATION_IN_PROGRESS"); ?></span></h4>
<p><?= T("EVerify", "ENTER_CODE_OR_CLICK_ON_THE_LINK"); ?></p>
<p><?= T("EVerify", "PLEASE_CHECK_SPAM_BOX"); ?></p>
<p><?= T("EVerify", "TO_CANCEL_AND_CREATE_NEW_ONE_CLICK_HERE"); ?></p>
<div class="roundedCornersBox">
    <table id="brought_in" class="table transparent" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td colspan="2"><?= T("EVerify", "Email verification"); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <?= T("EVerify", "EMAIL_ADDRESS"); ?>:
            </td>
            <td>
                <input type="text" class="text disabled" readonly disabled value="<?= $vars['verify_email_address']; ?>"
                       style="width: 50%" id="email">
            </td>
        </tr>
        <tr>
            <td>
                <?= T("EVerify", "VERIFICATION_CODE"); ?>:
            </td>
            <td>
                <input type="text" class="text" value="" style="width: 50%" id="code">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="green" id="<?= ($button_id = get_button_id()); ?>"
                        onclick="verifyProgress();">
                    <div class="button-container addHoverClick">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-content"><?= T("EVerify", "VERIFY"); ?></div>
                    </div>
                </button>
                <script type="text/javascript">
                    jQuery(function () {
                        if (jQuery('#<?=$button_id;?>')) {
                            jQuery('#<?=$button_id;?>').click(function (event) {
                                jQuery(window).trigger('buttonClicked', [this, {
                                    "type": "submit",
                                    "class": "green",
                                    "id": "<?=$button_id;?>"
                                }]);
                            });
                        }
                    });
                </script>
            </td>
        </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        function verifyProgress() {
            jQuery("#<?=$button_id;?>").attr("disabled", "disabled");
            jQuery("#<?=$button_id;?>").addClass("disabled");
            var code = jQuery("#code").val();
            if (code === "" || code === undefined || code === null) {
                dialog = new Travian.Dialog.Dialog(
                    {
                        buttonOk: true, overlayCancel: false, preventFormSubmit: true
                    }
                );
                dialog.setContent(errors.emptyCode);
                dialog.show();
                jQuery('#<?=$button_id;?>').attr('disabled', false);
                jQuery("#<?=$button_id;?>").removeClass("disabled");
            } else {
                Travian.ajax({
                    data: {
                        cmd: "verify",
                        action: "verify",
                        code: code
                    },
                    onSuccess: function (a) {
                        var dialog;
                        if (a.verifyResult === true) {
                            dialog = new Travian.Dialog.Dialog(
                                {
                                    buttonOk: true, overlayCancel: false, onOkay: function () {
                                        window.location.reload();
                                    }, preventFormSubmit: true
                                }
                            );
                            dialog.setContent(errors.verificationSuccessFull);
                            dialog.show();
                        } else {
                            dialog = new Travian.Dialog.Dialog(
                                {
                                    buttonOk: true, overlayCancel: false, preventFormSubmit: true
                                }
                            );
                            dialog.setContent(errors[a.verifyError]);
                            dialog.show();
                        }
                        jQuery('#<?=$button_id;?>').attr('disabled', false);
                        jQuery("#<?=$button_id;?>").removeClass("disabled");
                    },
                    onFailure: function (a) {
                        var dialog = new Travian.Dialog.Dialog(
                            {
                                buttonOk: true, overlayCancel: false, onOkay: function () {
                                    window.location.reload();
                                }, preventFormSubmit: true
                            }
                        );
                        dialog.setContent('Request failed!');
                        dialog.show();
                        jQuery('#<?=$button_id;?>').attr('disabled', false);
                        jQuery("#<?=$button_id;?>").removeClass("disabled");
                    }
                });
            }
        }

        jQuery(function () {
            <?php if($vars['email_resent']):?>
            (new Travian.Dialog.Dialog({buttonOk: true, overlayCancel: false, preventFormSubmit: true}))
                .setContent(errors['verificationEmailHasBeenSent'])
                .show();
            <?php elseif($vars['tooManyResends']):?>
            (new Travian.Dialog.Dialog({buttonOk: true, overlayCancel: false, preventFormSubmit: true}))
                .setContent(errors['tooManyResends'])
                .show();
            <?php endif;?>
        });
    </script>
</div>
<p class="warning" style="font-weight: bold"><?= T("EVerify", "TO_RESEND_EMAIL_PLEASE_CLICK_HERE"); ?></p>