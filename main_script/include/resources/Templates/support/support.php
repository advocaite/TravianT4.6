<?=T("Support", "description");?>
<h3><?=T("Support", "Game errors, login errors and game rules related questions");?></h3>
<form method="post" name="support" id="support">
    <div id="group_support_gameworld">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_gameworld">
                    <label class="form_label"
                           for="support[gameworld]"><?=T("Support", "Game world");?></label></td>
                <td class="form_table_element form_table_element_support_gameworld">
                    <select id="support_gameworld" name="support[gameworld]">
                        <option value="please_select" <?=($vars['gameWorld']['value'] == 'please_select' ? 'selected="yes"' : '');?>><?=T("Support", "please select");?></option>
                        <option value="i_do_not_know" <?=($vars['gameWorld']['value'] == 'i_do_not_know' ? 'selected="yes"' : '');?>><?=T("Support", "I don´t know");?></option>
                        <?=$vars['gameWorld']['content'];?>
                    </select>
                    <div class="error"><?=$vars['gameWorld']['error'];?></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_username">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_username">
                    <label class="form_label" for="support[username]"><?=T("Support", "Username");?></label>
                </td>
                <td class="form_table_element form_table_element_support_username">
                    <input type="text" id="support_username" name="support[username]" class="text" label="Username" helper="" value="<?=$vars['username']['value'];?>"/>
                    <div class="error"><?=$vars['username']['error'];?></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_email">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_email">
                    <label class="form_label" for="support[email]"><?=T("Support", "Email");?></label>
                </td>
                <td class="form_table_element form_table_element_support_email">
                    <input type="text" id="support_email"
                           name="support[email]"
                           class="text" label="Email"
                           helper="" value="<?=$vars['email']['value'];?>"/>

                    <div class="error"><?=$vars['email']['error'];?></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_supportType">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_supportType">
                    <label class="form_label"
                           for="support[supportType]"><?=T("Support", "Category");?></label>
                </td>
                <td class="form_table_element form_table_element_support_supportType">
                    <select id="support_supportType"
                            name="support[supportType]">
                        <option value="please_select" <?=($vars['supportType']['value'] == "please_select" ? 'selected="yes"' : '');?>><?=T("Support", "please select");?></option>
                        <option value="general_querstions" <?=($vars['supportType']['value'] == "general_querstions" ? 'selected="yes"' : '');?>><?=T("Support", "General questions");?></option>
                        <option value="i_can_not_login" <?=($vars['supportType']['value'] == "i_can_not_login" ? 'selected="yes"' : '');?>><?=T("Support", "I cannot log in");?></option>
                        <option value="i_can_not_register" <?=($vars['supportType']['value'] == "i_can_not_register" ? 'selected="yes"' : '');?>><?=T("Support", "I cannot register an account");?></option>
                    </select>
                    <div class="error"><?=$vars['supportType']['error'];?></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_message">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_message">
                    <label class="form_label"
                           for="support[message]"><?=T("Support", "Message");?></label>
                </td>
                <td class="form_table_element form_table_element_support_message"><textarea
                        name="support[message]"
                        cols="43" rows="7"
                        label="Message"
                        helper=""><?=$vars['message']['value'];?></textarea>

                    <div class="error"><?=$vars['message']['error'];?></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_message">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_captcha">
                    <label class="form_label" for="support[captcha]"><?=T("Support", "Captcha");?></label>
                </td>
                <td class="form_table_element form_table_element_captcha">
                    <?=recaptcha_get_html();?>
                    <div class="error"></div>
                </td>
            </tr>
        </table>
    </div>
    <div id="group_support_submit">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_submit">
                    <label class="form_label"
                           for="support[submit]"></label></td>
                <td class="form_table_element form_table_element_support_submit">
                    <button type="submit" value="send request"
                            name="support[submit]" id="support[submit]"
                            class="green " submit="1">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content"><?=T("Support", "send request");?></div>
                        </div>
                    </button>
                    <script type="text/javascript">
                        jQuery(function() {
                            if (jQuery('#support[submit]')) {
                                jQuery('#support[submit]').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "submit",
                                        "value": "<?=T("Support", "send request");?>",
                                        "name": "support[submit]",
                                        "id": "support[submit]",
                                        "class": "green ",
                                        "title": "",
                                        "confirm": "",
                                        "onclick": "",
                                        "submit": true
                                    }]);
                                });
                            }
                        });
                    </script>
                </td>
            </tr>
        </table>
    </div>
</form>