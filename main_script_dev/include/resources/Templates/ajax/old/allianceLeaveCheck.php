<div id="allianceLeavePopup">
    <form method="post" action="" id="allianceLeaveForm">
        <p class="option"><?= T("Embassy",
                "In order to quit the alliance you have to enter your password again for safety reasons"); ?>. </p>
        <table cellpadding="1" cellspacing="1" class="option quit transparent">
            <tbody>
            <tr>
                <th><?= T("Embassy", "Password"); ?>:</th>
                <td><input class="pass text" type="password" name="pw" maxlength="100"/></td>
            </tr>
            <tr>
                <td colspan="2"><span id="allianceLeavePopupError" class="error option">
                        <?php if (isset($vars['passwordIsWrong']) && $vars['passwordIsWrong']): ?>
                            <?= T("Embassy", "The password is wrong"); ?>
                        <?php endif; ?>
                    </span></td>
            </tr>
            </tbody>
        </table>
        <div class="option">
            <button type="submit" value="ok" name="s1" id="btn_ok" class="green confirmPassword" title="Confirm">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?= T("Embassy", "Confirm"); ?></div>
                </div>
            </button>
            <script type="text/javascript" id="btn_ok_script">
                jQuery(function () {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "ok",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green confirmPassword",
                            "title": "Confirm",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                });
            </script>
            <div class="clear"></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(function () {
        var allianceDblClickPreventer = new Travian.DoubleClickPreventer(),
            allianceLeaveForm = jQuery('#allianceLeaveForm'),
            allianceLeavePopupError = jQuery('#allianceLeavePopupError');

        allianceDblClickPreventer.timeout = 1000;

        allianceLeaveForm.on('submit', function (e) {
            e.preventDefault();

            if (!allianceDblClickPreventer.check()) {
                return false;
            }

            Travian.ajax({
                data: {
                    cmd: 'allianceLeave',
                    allianceId: <?=$vars['aid'];?>,
                    pass: allianceLeaveForm.find('input[name="pw"]').val(),
                    action: 'leave'
                },
                onSuccess: function (data, responsePayload) {
                    if (data.close) {
                        Travian.WindowManager.closeAllWindows();
                        window.location.reload();
                    }

                    if (responsePayload.error) {
                        allianceLeavePopupError[0].innerHTML = responsePayload.errorMsg;
                    }
                },
                onFailure: function (data, errorMessage) {
                    allianceLeavePopupError[0].innerHTML = errorMessage;
                }
            });
        });
    });
</script>