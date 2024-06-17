<?php
use Core\Config;
use Core\Session;

if (isset($vars['error'])) {
    echo '<p class="error">' . $vars['error'] . '</p>';
}
$m = new \Model\OptionModel();
$config = Config::getInstance();
$total_pop = Session::getInstance()->get("total_pop");
?>
<form id="accountSettings" action="options.php" method="post">
    <input type="hidden" name="e" value="2"/>
    <input type="hidden" name="s" value="2"/>
    <input type="hidden" name="formType" value="account"/>
    <script type="text/javascript">
        function getAccountRenameValues()
        {
            var accountNewName = jQuery('#acount_rename_new_name').val();
            var accountPassword = jQuery('#account_rename_password_confirmation').val();
            if(typeof accountNewName !== 'undefined' && typeof accountPassword !== 'undefined')
            {
                return {accountNewName: accountNewName, accountPassword: accountPassword};
            }
            return false;
        }
    </script>
    <h4 class="round"><?=T("Options", "Change account name"); ?></h4>
    <table id="change_account_name" cellpadding="1" cellspacing="1"
           class="transparent">
        <tbody>
        <tr>
            <td colspan="3">
                <?=sprintf(T("Options", "changeNameDesc"), $config->gold->changeName->freeTimes, $config->gold->changeName->freeTillPopulation, Config::getInstance()->gold->accountChangeNameGold, $config->gold->changeName->impossibleAfterPopulation); ?>
            </td>
        </tr>
        <tr>
            <th><?=T("Options", "Number of changes"); ?>:</th>
            <td colspan="2"><?php
                if ($total_pop >= $config->gold->changeName->freeTillPopulation || Session::getInstance()->getTotalNameChanges() >= $config->gold->changeName->freeTimes) {
                    echo Session::getInstance()->getTotalNameChanges();
                } else {
                    echo sprintf(T("Options", "x of y changes"), Session::getInstance()->getTotalNameChanges(), $config->gold->changeName->freeTimes);
                }
                ?></td>
        </tr>
        <tr>
            <th><?=T("Options", "Enter new account name"); ?></th>
            <td><input id="acount_rename_new_name" tabindex="1" class="text"
                       type="text" name="acount_rename_new_name"
                       maxlength="20"
                       value="<?=isset($_POST['acount_rename_new_name']) ? filter_var($_POST['acount_rename_new_name']) : ''; ?>"/>
            </td>
            <td>
                <?php
                if (($total_pop >= $config->gold->changeName->freeTillPopulation || Session::getInstance()->getTotalNameChanges()) >= $config->gold->changeName->freeTimes && $total_pop <= $config->gold->changeName->impossibleAfterPopulation) {
                    echo getButton([
                        'type' => 'button',
                        'value' => T("Options", "Change name"),
                        'class' => 'gold',
                        'coins' => Config::getInstance()->gold->accountChangeNameGold,
                    ], [
                        'data' => [
                            'wayOfPayment' => [
                                'featureKey' => 'ChangeAccountName',
                                'dataCallback' => 'getAccountRenameValues',
                            ],
                        ],
                    ], T("Options", "Change name"));
                } else {
                    echo getButton([
                        'type' => 'button',
                        'value' => T("Options", "Change name"),
                        'class' => 'gold disabled',
                        'coins' => Config::getInstance()->gold->accountChangeNameGold,
                    ], ['data' => [],], T("Options", "Change name"));
                }
                ?>
            </td>
        </tr>
        <tr>
            <th><?=T("Options", "Confirm with password"); ?>:</th>
            <td><input id="account_rename_password_confirmation" tabindex="2"
                       class="text" type="password"
                       name="account_rename_password_confirmation"
                       maxlength="20"/></td>
            <td>
                <?php
                if ($total_pop < $config->gold->changeName->freeTillPopulation && Session::getInstance()->getTotalNameChanges() < $config->gold->changeName->freeTimes) {
                    echo getButton([
                        'type' => 'submit',
                        'value' => T("Options", "Change name"),
                        'class' => 'green',
                    ], ['data' => [],], T("Options", "Change name"));
                } else {
                    echo getButton([
                        'type' => 'submit',
                        'value' => T("Options", "Change name"),
                        'class' => 'green disabled',
                        'onclick' => "if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}",
                        'onfocus' => "jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;",
                    ], ['data' => [],], T("Options", "Change name"));
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</form>
<form id="settings" action="options.php" method="post">
    <input type="hidden" name="e" value="2"/>
    <input type="hidden" name="s" value="2"/>
    <input type="hidden" name="a"
           value="<?=Session::getInstance()->getChecker(); ?>"/>

    <h4 class="round spacer"><?=T("Options", "Change password"); ?></h4>

    <table cellpadding="1" cellspacing="1" id="change_pass"
           class="transparent">
        <tbody>
        <tr>
            <th class="col1"><?=T("Options", "Old Password"); ?>:</th>
            <td><input class="text" type="password" name="pw1" maxlength="20"/>
            </td>
        </tr>
        <tr>
            <th><?=T("Options", "New Password"); ?>:</th>
            <td><input class="text" type="password" name="pw2" maxlength="20"/>
            </td>
        </tr>
        <tr>
            <th><?=T("Options", "confirm"); ?>:</th>
            <td><input class="text" type="password" name="pw3" maxlength="20"/>
            </td>
        </tr>

        </tbody>
    </table>
    <h4 class="round spacer"><?=T("Options", "Change email"); ?></h4>
    <?php if (!$m->isEmailChangeExists(Session::getInstance()->getPlayerId())): ?>
        <table id="change_mail" cellpadding="1" cellspacing="1"
               class="transparent">
            <tbody>
            <tr>
                <td colspan="2"><?=T("Options", "Change email desc"); ?></td>
            </tr>
            <tr>
                <th><?=T("Options", "Old email"); ?>:</th>
                <td><input class="text" type="text" name="email_alt"
                           maxlength="50"
                           size="40"/></td>
            </tr>
            <tr>
                <th><?=T("Options", "New email"); ?>:</th>
                <td><input class="text" type="text" name="email_neu"
                           maxlength="50"
                           size="40"/></td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
        <table cellpadding="1" cellspacing="1" id="change_mail"
               class="account transparent">
            <tbody>
            <tr>
                <td colspan="2"><?=T("Options", "change_mail_desc"); ?></td>
            </tr>
            <tr>
                <th><?=T("Options", "Old email code"); ?></th>
                <td><input class="text" type="text" name="code_email_alt"
                           maxlength="5"/></td>
            </tr>
            <tr>
                <th><?=T("Options", "New email code"); ?></th>
                <td><input class="text" type="text" name="code_email_neu"
                           maxlength="5"/></td>
            </tr>
            </tbody>
            <tbody>
            <tr>
                <th colspan="2" class="process">
                    <button type="button" class="icon "
                            onclick="window.location.href = 'options.php?e=2&amp;s=2&amp;a=<?=Session::getInstance()->getChecker(); ?>&amp;email_abbrechen'; return false;">
                        <img src="img/x.gif" class="del" alt="del"/>
                    </button> <?=T("Options", "Email change is in progress"); ?>
                </th>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>
    <h4 class="round spacer"><?= T("Options", "Support colorBlind title"); ?></h4>
    <table cellpadding="1" cellspacing="1" id="colorblind" class="account transparent">
        <tbody>
        <tr>
            <td colspan="2"><?= T("Options", "Support colorBlind desc"); ?></td>
        </tr>
        <tr>
            <th>
                <?= T("Options", "Use colorBlind?"); ?>                </th>
            <td class="del_selection">
                <label><input class="radio" type="radio" name="colorblind"
                              value="1" <?= $vars['colorBlind'] == 1 ? ' checked="checked"' : ''; ?> /> <?=T("Options", "Yes"); ?>
                </label>
                &nbsp;&nbsp;&nbsp;
                <label><input class="radio" type="radio" name="colorblind"
                              value="0" <?= $vars['colorBlind'] == 0 ? ' checked="checked"' : ''; ?> /> <?=T("Options", "No"); ?>
                </label>
            </td>
        </tr>
        </tbody>
    </table>
    <?php if (getDisplay("allowAutoReloadSettingChange")): ?>
        <h4 class="round spacer"><?= T("Options", "Auto reload status"); ?></h4>
        <table cellpadding="1" cellspacing="1" id="colorblind" class="account transparent">
            <tbody>
            <tr>
                <td colspan="2"><?= T("Options", "You can set the page to auto reload, the page will be automatically refreshed when timer reaches 0"); ?></td>
            </tr>
            <tr>
                <th>
                    <?= T("Options", "Enable auto reload?"); ?>                </th>
                <td class="del_selection">
                    <label><input class="radio" type="radio" name="autoReload"
                                  value="1" <?= $vars['autoReload'] == 1 ? ' checked="checked"' : ''; ?> /> <?=T("Options", "Yes"); ?>
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <label><input class="radio" type="radio" name="autoReload"
                                  value="0" <?= $vars['autoReload'] == 0 ? ' checked="checked"' : ''; ?> /> <?=T("Options", "No"); ?>
                    </label>
                </td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>
        <h4 class="round spacer"><?= T("Options", "Graphic pack"); ?></h4>
        <table cellpadding="1" cellspacing="1" class="account transparent">
            <tbody>
            <tr>
                <td colspan="2"><?= T("Options", "You can change the way the game looks for you"); ?></td>
            </tr>
            <tr>
                <th>
                    <?= T("Options", "Graphic pack"); ?>
                </th>
                <td>
                    <select name="gpackNew">
                        <?php
                        global $globalConfig;
                        foreach($globalConfig['staticParameters']['gpacks']['list'] as $key => $value){
                            echo '<option value="'.$key.'"'.($key == get_gpack_version() ? ' selected="selected"' : '').'>'.$value['name'].' '.($value['isNew'] ? '('.T("Options", "new").')' : "").'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>


    <h4 class="round spacer"><?=T("Options", "Delete account"); ?></h4>
    <table cellpadding="1" cellspacing="1" id="del_acc"
           class="account transparent">
        <tbody>
        <?php if (!$m->getLatestPayment(Session::getInstance()->getPlayerId())): ?>
            <tr>
                <td colspan="2"><?=T("Options", "deleteDesc"); ?></td>
            </tr>
            <?php
            if (!$m->isDeletion(Session::getInstance()->getPlayerId())):
                ?>
                <tr>
                    <th>
                        <?=T("Options", "Delete account?"); ?>                </th>
                    <td class="del_selection">
                        <label><input class="radio" type="radio" name="del"
                                      value="1"/> <?=T("Options", "Yes"); ?>
                        </label>
                        <label><input class="radio" type="radio" name="del"
                                      value="0"
                                      checked="checked"/> <?=T("Options", "No"); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?=T("Options", "Confirm with password"); ?>:
                    </th>
                    <td>
                        <input class="text" type="password" name="del_pw"
                               maxlength="20"/>
                    </td>
                </tr>
            <?php else:
                $timestamp = $m->getDeletionTimestamp(Session::getInstance()->getPlayerId());
                ?>
                <tr>
                    <td colspan="2" class="count">
                        <?php
                        echo(!isServerFinished() ? "<button type=\"button\" class=\"icon \" onclick=\"window.location.href = 'options.php?s=2&amp;id=" . Session::getInstance()->getPlayerId() . "&amp;a=1&amp;e=2'; return false;\"><img src=\"img/x.gif\" class=\"del\" alt=\"del\"></button> " : '');
                        echo sprintf(T("inGame", "The account will be deleted in"), appendTimer($timestamp - time()));
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php else: ?>
            <tr>
                <td class="noOptions"
                    colspan="2"><?=T("Options", "You need to wait 7 days before deletion"); ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php
    $session = Session::getInstance();
    if ($session->getBoughtGold()):?>
        <h4 class="round spacer"><?=T("Options", "Transfer gold"); ?></h4>
        <table cellpadding="1" cellspacing="1" class="newsletter transparent">
            <tbody>
            <tr>
                <td colspan="2">
                    <?php
                    echo sprintf(T("Options", "You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!"), $session->getGold() . ' <img class="gold" src="img/x.gif">', $session->getTransferGold() . ' <img class="gold" src="img/x.gif">'); ?>
                </td>
            </tr>
            </tbody>
        </table>
    <?php endif; ?>
    <h4 class="round spacer"><?=T("Options", "Newsletter"); ?></h4>
    <input type="hidden" name="newsletter_posted" value="1"/>
    <table cellpadding="1" cellspacing="1" class="newsletter transparent">
        <tbody>
        <tr>
            <td><?=T("Options", "Here you can subscribe or unsubscribe to our newsletter"); ?></td>
        </tr>
        <tr>
            <td class="newsletter_selection">
                <input class="check" type="checkbox" id="newsletter_4"
                       name="newsletter_4"
                       value="1" <?=$m->isInNewsLetter(Session::getInstance()->getEmail()) ? 'checked="checked"' : ''; ?> />
                <label
                        for="newsletter_4"><?=T("Options", "Travian Games"); ?></label>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="submitButtonContainer">
        <button type="submit" value="<?=T("Global", "General.save"); ?>"
                id="<?=$button_id = get_button_id(); ?>" class="green ">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?=T("Global", "General.save"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#<?=$button_id;?>')) {
                    jQuery('#<?=$button_id;?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Global", "General.save");?>",
                            "name": "",
                            "id": "<?=$button_id;?>",
                            "class": "green ",
                            "title": "",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </div>

</form>

<script type="text/javascript">
    jQuery(function() {
        Travian.Form.UnloadHelper.watchHtmlForm(jQuery('#settings'));
    });
</script>