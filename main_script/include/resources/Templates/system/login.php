<script type="text/javascript">
    Element.implement({
        showOrHide: function (imgid) {
            if (this.getStyle('display') == 'none') {
                if (imgid != '') {
                    $(imgid).className = 'open';
                }
            } else {
                if (imgid != '') {
                    $(imgid).className = 'close';
                }
            }
            this.toggleClass('hide');
        }
    });
</script>
<div class="outerLoginBox <?=$vars['captcha'] ? 'withCaptcha' : ''; ?>">
    <h2><?=$vars['WelcomeText']; ?></h2>
    <noscript>
        <div class="noJavaScript"><?=T("Login", "noJavascript"); ?></div>
    </noscript>
    <script type="text/javascript">
        function reloadCode() {
            document.getElementById("recaptchaImage").setAttribute("src", "login.php?loadCaptcha&" + Math.random());
        }
    </script>
    <div class="innerLoginBox">
        <form name="login" method="POST" action="<?=$vars['isAdmin'] ? 'admin.php' : 'dorf1.php'; ?>">
            <table class="transparent loginTable">
                <tbody>
                <tr class="account">
                    <td class="accountNameOrEmailAddress"><?=T("Login", "accountNameOrEmailAddress"); ?>:</td>
                    <td>
                        <input type="text" name="name" value="<?=$vars['name']; ?>" class="text">

                        <div class="error <?=getDirection(); ?>"><?=$vars['userError']; ?></div>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr class="pass">
                    <td><?=T("Login", "pass"); ?></td>
                    <td>
                        <input type="password" maxlength="20" name="password" value="<?=$vars['password']; ?>" class="text"><br>

                        <div class="error <?=getDirection(); ?>"><?=$vars['pwError']; ?></div>
                    </td>
                    <td>
                    </td>
                </tr>
                <?php if ($vars['captcha'] && !$vars['forgotPassword']): ?>
                    <tr>
                        <th class="captcha">
                            <?=T("Login", "Captcha"); ?>                    </th>
                        <td>
                            <!--
                            <img id="recaptchaImage" src="login.php?loadCaptcha">
                            <br/>-->
                            <?= recaptcha_get_html(); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <!---<input class="text" type="text" name="captcha">-->
                            <div class="error <?=getDirection(); ?>"><?=$vars['captchaError']; ?></div>
                        </td>
                        <td></td>
                    </tr>
                <?php endif; ?>
                <tr class="lowResOption">
                    <td><?=T("Login", "lowResOption"); ?></td>
                    <td colspan="2">
                        <input type="checkbox" class="checkbox" id="lowRes" name="lowRes"
                               value="<?=$vars['lowRes']; ?>">
                        <label for="lowRes"><?=T("Login", "lowRes"); ?></label>
                    </td>
                </tr>
                <tr class="lowResInfo">
                    <td colspan="3"><?=T("Login", "lowResInfo"); ?></td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>testing</td>
                    <td>
                        <button type="submit" value="<?=T("Login", "Login"); ?>" name="s1" id="s1"
                                class="green "
                                onclick="document.login.w.value=screen.width+':'+screen.height;">
                            <div class="button-container addHoverClick ">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=T("Login", "Login"); ?></div>
                            </div>
                        </button>
                        <input type="hidden" name="w" value="">
                        <input type="hidden" name="login" value="<?=$vars['timestamp']; ?>">
                    </td>
                    <td>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php if ($vars['forgotPassword']): ?>
        <div class="greenbox passwordForgotten">
            <div class="greenbox-top"></div>
            <div class="greenbox-content">
                <div class="passwordForgottenLink">
                    <a onclick="jQuery('#showPasswordForgotten').showOrHide('arrow');" href="#" class="showPWForgottenLink">
                        <img class="open" id="arrow" src="img/x.gif"
                             alt="<?=T("Login", "PasswordForgotten?"); ?>"/><?=T("Login",
                            "PasswordForgotten?"); ?></a>
                </div>
                <div class="showPasswordForgotten" id="showPasswordForgotten">
                    <?php if ($vars['success']): ?>
                        <div class="success"><?=T("Login", "Sent to"); ?>: <span
                                    class="sentTo"><?=$vars['pw_email']; ?></span>
                        </div>
                    <?php else: ?>
                        <form method="POST" action="">
                            <input type="hidden" name="forgotPassword" value="1"/>

                            <div class="forgotPasswordDescription">
                                <?=T("Login",
                                    "We will send you a new password It will be activated as soon as you confirm receipt?"); ?>                    </div>
                            <table class="transparent pwForgottenTable" id="pw_forgotten_form" cellpadding="0"
                                   cellspacing="0">
                                <tr class="mail">
                                    <th><?=T("Login", "Email"); ?>:</th>
                                    <td><input class="text" type="text" name="pw_email"
                                               value="<?=$vars['pw_email']; ?>"/><br/>

                                        <div class="error <?=getDirection(); ?>">
                                            <?=$vars['newPassErr']; ?>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th class="captcha" rowspan="2">
                                        <?=T("Login", "Captcha"); ?>                            </th>
                                    <td>
                                        <?= recaptcha_get_html(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td colspan="2">
                                        <button type="submit" value="<?=T("Login", "Request password"); ?>"
                                                name="s2"
                                                id="s2" class="green ">
                                            <div class="button-container addHoverClick">
                                                <div class="button-background">
                                                    <div class="buttonStart">
                                                        <div class="buttonEnd">
                                                            <div class="buttonMiddle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="button-content"><?=T("Login",
                                                        "Request password"); ?></div>
                                            </div>
                                        </button>
                                        <script type="text/javascript">
                                            jQuery(function() {
                                                if (jQuery('#s2')) {
                                                    jQuery('#s2').click(function (event) {
                                                        jQuery(window).trigger('buttonClicked', [this, {
                                                            "type": "submit",
                                                            "value": "<?=T("Login", "Request password");?>",
                                                            "name": "s2",
                                                            "id": "s2",
                                                            "class": "green ",
                                                            "title": "",
                                                            "confirm": "",
                                                            "onclick": ""
                                                        }]);
                                                    });
                                                }
                                            });
                                        </script>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>
        </div>
    <?php else: ?>
        <div class="greenbox passwordForgotten">
            <div class="greenbox-top"></div>
            <div class="greenbox-content">
                <div class="passwordForgottenLink">
                    <a onClick="" href="?forgotPassword=true" class="showPWForgottenLink"><img class="close" id="arrow"
                                                                                               src="img/x.gif"><?=T("Login",
                            "PasswordForgotten?"); ?>
                    </a>
                </div>
            </div>
            <div class="greenbox-bottom"></div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
</div>