<h4 class="round"><?= T("EVerify", "ADD_NEW_VERIFY_PROGRESS"); ?></h4>
<div class="roundedCornersBox">
    <table class="table transparent">
        <tbody>
        <tr>
            <td class="accountNameOrEmailAddress"><?= T("EVerify", "EMAIL_ADDRESS"); ?>:</td>
            <td>
                <input type="email" class="text" value="" style="font-size: 14px; width: 60%" id="email">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?= recaptcha_get_html(); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="green" id="<?= ($button_id = get_button_id()); ?>"
                        onclick="addNewProgress();">
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
            </td>
        </tr>
        </tbody>
    </table>
    <br/>
    <script type="text/javascript">
        jQuery(function () {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('buttonClicked', [this, {
                    "type": "submit",
                    "class": "green",
                    "id": "<?=$button_id;?>"
                }]);
            });
        });
    </script>
</div>
<script type="text/javascript">
    function switchSubmit(enabled) {
        enabled = enabled || false;
        if (!enabled) {
            jQuery("#<?=$button_id;?>").attr("disabled", "disabled");
            jQuery("#<?=$button_id;?>").addClass("disabled");
        } else {
            jQuery("#<?=$button_id;?>").attr("disabled", false);
            jQuery("#<?=$button_id;?>").removeClass("disabled");
        }
    }


    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function addNewProgress() {
        switchSubmit(false);
        var email = jQuery("#email").val();
        if (email === "" || email === undefined || email === null) {
            dialog = new Travian.Dialog.Dialog(
                {
                    buttonOk: true, overlayCancel: false,preventFormSubmit: true
                }
            );
            dialog.setContent(errors.emptyEmail);
            dialog.show();
            switchSubmit(true);
        } else if (!validateEmail(email)) {
            dialog = new Travian.Dialog.Dialog(
                {
                    buttonOk: true, overlayCancel: false,preventFormSubmit: true
                }
            );
            dialog.setContent(errors.invalidEmail);
            dialog.show();
            switchSubmit(true);
        } else {
            Travian.ajax({
                data: {
                    cmd: "verify",
                    action: "newProgress",
                    email: email,
                    'g-recaptcha-response': grecaptcha.getResponse()
                },
                onSuccess: function (a) {
                    var dialog;
                    if (a.verifyResult === true) {
                        dialog = new Travian.Dialog.Dialog(
                            {
                                buttonOk: true, overlayCancel: false, onOkay: function () {
                                    window.location.reload();
                                },preventFormSubmit: true
                            }
                        );
                        dialog.setContent(errors.verificationEmailHasBeenSent);
                        dialog.show();
                    } else {
                        grecaptcha.reset();
                        dialog = new Travian.Dialog.Dialog(
                            {
                                buttonOk: true, overlayCancel: false, preventFormSubmit: true
                            }
                        );
                        dialog.setContent(errors[a.verifyError]);
                        dialog.show();
                    }

                    switchSubmit(true);
                },
                onFailure: function (a) {
                    var dialog = new Travian.Dialog.Dialog(
                        {
                            buttonOk: true, overlayCancel: false, onOkay: function () {
                                window.location.reload();
                            },
                            preventFormSubmit: true
                        }
                    );
                    dialog.setContent('Request failed!');
                    dialog.show();
                    grecaptcha.reset();
                    switchSubmit(true);
                }
            });
        }
    }
</script>