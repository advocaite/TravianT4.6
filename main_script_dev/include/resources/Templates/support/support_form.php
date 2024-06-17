<?= T("inGameSupport", "description"); ?>
<h3><?= T("inGameSupport", "Game errors, login errors and game rules related questions"); ?></h3>
<form method="post" name="support" id="support">
    <div id="group_support_category">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_category"><label class="form_label"
                                                                                      for="support[category]">Category</label>
                </td>
                <td class="form_table_element form_table_element_support_category"><select onchange="
				var f = jQuery('#support');
				f.insert({top:'<input type=&quot;hidden&quot; name=&quot;general_do_not_submit&quot; value=&quot;1&quot; />'});
				f.submit();" id="support_category" name="support[category]">
                        <option value="please_select" <?=($vars['category']['value'] == "please_select" ? 'selected="yes"' : '');?>><?=T("inGameSupport", "please select");?></option>
                        <option value="game_support" <?=($vars['category']['value'] == "game_support" ? 'selected="yes"' : '');?>><?=T("inGameSupport", "Game support");?></option>
                        <option value="rule_violation" <?=($vars['category']['value'] == "rule_violation" ? 'selected="yes"' : '');?>><?=T("inGameSupport", "Violation of the rules");?></option>
                        <option value="plus_support" <?=($vars['category']['value'] == "plus_support" ? 'selected="yes"' : '');?>><?=T("inGameSupport", "Plus support");?></option>
                    </select></td>
            </tr>
        </table>
    </div>
    <input type="hidden" name="support[category_game_support]" value=""/>
    <div id="group_support_supportType">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_supportType"><label class="form_label"
                                                                                         for="support[supportType]"><?=T("inGameSupport", "Game support");?></label></td>
                <td class="form_table_element form_table_element_support_supportType"><select id="support_supportType"
                                                                                              name="support[supportType]">
                        <option value="please_select" <?=($vars['supportType']['value'] == "please_select" ? 'selected="yes"' : '');?>><?=T("inGameSupport", "please select");?></option>
                        <?=$vars['supportType']['content'];?>
                    </select></td>
            </tr>
        </table>
    </div>
    <div id="group_support_message">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_message"><label class="form_label"
                                                                                     for="support[message]">Message</label>
                </td>
                <td class="form_table_element form_table_element_support_message"><textarea name="support[message]"
                                                                                            cols="43" rows="7"
                                                                                            label="Message"
                                                                                            helper=""></textarea></td>
            </tr>
        </table>
    </div>
    <div id="group_support_submit">
        <table class="form_table form_tablel_support" width="100%">
            <tr>
                <td class="form_table_label form_table_label_support_submit"><label class="form_label"
                                                                                    for="support[submit]"></label></td>
                <td class="form_table_element form_table_element_support_submit">
                    <button type="submit" value="send request" name="support[submit]" id="support[submit]"
                            class="green " submit="1">
                        <div class="button-container addHoverClick">
                            <div class="button-background">
                                <div class="buttonStart">
                                    <div class="buttonEnd">
                                        <div class="buttonMiddle"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-content">send request</div>
                        </div>
                    </button>
                    <script type="text/javascript" id="support[submit]_script">
                        jQuery(function() {
                            if (jQuery('#support[submit]')) {
                                jQuery('#support[submit]').click(function (event) {
                                    jQuery(window).trigger('buttonClicked', [this, {
                                        "type": "submit",
                                        "value": "send request",
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