<script language="JavaScript" type="text/javascript">

    function checkInputs(id, typ) {
        id_field = document.getElementById(typ + '_by_id_' + id);
        name_field = document.getElementById(typ + '_by_name_' + id);

        //alert(id_field.value);
        //alert(name_field.value);

        if (id_field.value != '' && id_field.disabled == false) {
            name_field.disabled = true;
            name_field.style.border = '1px solid #999';
        }
        else {
            name_field.disabled = false;
            name_field.style.border = '1px solid #71D000';
        }

        if (name_field.value != '' && name_field.disabled == false) {
            id_field.disabled = true;
            id_field.style.border = '1px solid #999';
        }
        else {
            id_field.disabled = false;
            id_field.style.border = '1px solid #71D000';
        }
    }

</script>
<form method="post" action="allianz.php">
    <input type="hidden" name="s" value="2"/>
    <input type="hidden" name="fid" value="<?=$vars['fid'];?>"/>
    <input type="hidden" name="bid" value="<?=$vars['bid'];?>"/>
    <input type="hidden" name="editforum" value="1"/>
    <input type="hidden" name="admin" value="1"/>
    <h4 class="round"><?=T("Alliance", "edit forum");?></h4>
    <table class="transparent" id="edit_forum">
        <tbody>
        <tr>
            <th><?=T("Alliance", "Forum name");?></th>
            <td><input class="text" type="text" name="u1"
                       value="<?=$vars['name'];?>"
                       maxlength="30"/></td>
        </tr>

        <tr>
            <th><?=T("Alliance", "desc");?></th>
            <td><input class="text" type="text" name="u2"
                       value="<?=$vars['desc'];?>"
                       maxlength="38"/></td>
        </tr>
        <tr>
            <th><span class="nobr"><?=T("Alliance", "sitters_allowed");?></span></th>
            <td><input type="checkbox" name="for_sitters" value="<?=$vars['for_sitters'];?>"
                        <?=$vars['for_sitters']==1 ? 'checked' : '';?> class="check"/></td>
        </tr>
        </tbody>
    </table>
    <div class="spacer"></div>
    <?php if($vars['showMorePlayers']):?>
    <?php if($vars['hasPlayers']):?>
        <h4 class="tableHeadline"><?=T("Alliance", "user_list_headline");?>:</h4>
        <table cellpadding="1" cellspacing="1" id="open_user">
            <thead>
            <tr>
                <td></td>
                <td><?=T("Alliance", "name");?>:</td>
            </tr>
            </thead>
            <tbody>
            <?=$vars['players'];?>
            </tbody>
        </table>
    <?php endif;?>
        <table cellpadding="1" cellspacing="1" id="user_list">
            <thead>
            <tr>
                <th colspan="3"><?=T("Alliance", "user_list_headline");?></th>
            </tr>
            <tr>
                <td><?=T("Alliance", "Player ID");?></td>
                <td><?=T("Alliance", "name");?>:</td>
                <td><?=T("Alliance", "addLine");?></td>
            </tr>
            </thead>
            <tbody>
            <tr class="addLine insertElement templateElement">
                <td class="id">
                    <input class="text" type="text" id="users_by_id_0" maxlength="8" name="users_by_id[]"/>
                </td>
                <td class="pla">
                    <input class="text" type="text" id="users_by_name_0" maxlength="15" name="users_by_name[]"/>
                </td>
                <td class="ad"><a href="#" class="addLine addElement"
                                  title="add"><img src="img/x.gif"
                                                   class="add" alt="<?=T("Alliance", "addLine");?>"/></a></td>
            </tr>
            </tbody>
        </table>
        <script language="JavaScript" type="text/javascript">
            jQuery(function() {
                jQuery('#users_by_id_0').keyup(function () {
                    checkInputs(0, 'users');
                });
                jQuery('#users_by_name_0').keyup(function () {
                    checkInputs(0, 'users');
                });
                new Travian.Game.AddLine(
                        {
                            entryCount: 1,
                            elements: {
                                table: jQuery('#user_list')
                            },
                            onInsertInputBefore: function (addLine, newInsertElement, newInputElement) {
                                var index = addLine.getEntryCount();
                                if (newInputElement.id.indexOf('users_by_id') == 0) {
                                    newInputElement.id = 'users_by_id_' + index;
                                    newInputElement.name = 'users_by_id[]';
                                }
                                else if (newInputElement.id.indexOf('users_by_name') == 0) {
                                    newInputElement.id = 'users_by_name_' + index;
                                    newInputElement.name = 'users_by_name[]';
                                }
                                newInputElement.addEvent('keyup', function () {
                                    checkInputs(index, 'users');
                                });
                            }
                        });
            });
        </script>
        <div class="spacer"></div>
    <?php endif;?>
    <?php if($vars['showMoreAlliances']):?>
    <?php if($vars['hasAlliances']):?>
        <h4 class="tableHeadline"><?=T("Alliance", "open forum for the following alliances");?></h4>
        <table cellpadding="1" cellspacing="1" id="non_conf_list">
            <thead>
            <tr>
                <td></td>
                <td><?=T("Alliance", "Tag");?>:</td>
                <td><?=T("Alliance", "name");?>:</td>
            </tr>
            </thead>
            <tbody>
            <?=$vars['alliances'];?>
            </tbody>
        </table>
    <?php endif;?>
        <h4 class="tableHeadline"><?=T("Alliance", "ally_list_headline");?></h4>
        <table cellpadding="1" cellspacing="1" id="ally_list">
            <thead>
            <tr>
                <td><?=T("Alliance", "Alliance ID");?></td>
                <td><?=T("Alliance", "Tag");?>:</td>
                <td><?=T("Alliance", "addLine");?></td>
            </tr>
            </thead>
            <tbody>
            <tr class="addLine insertElement templateElement">
                <td class="ally">
                    <input class="text" type="text" id="allys_by_id_0" maxlength="8" name="allys_by_id[0]"/>
                </td>
                <td class="tag">
                    <input class="text" type="text" id="allys_by_name_0" maxlength="8" name="allys_by_name[0]"/>
                </td>
                <td class="ad"><a href="#" class="addLine addElement"
                                  title="add"><img src="img/x.gif"
                                                   class="add" alt="<?=T("Alliance", "addLine");?>"/></a></td>
            </tr>
        </table>
        <script language="JavaScript" type="text/javascript">
            jQuery(function() {
                jQuery('#allys_by_id_0').keyup(function () {
                    checkInputs(0, 'allys');
                });
                jQuery('#allys_by_name_0').keyup(function () {
                    checkInputs(0, 'allys');
                });
                new Travian.Game.AddLine(
                        {
                            entryCount: 1,
                            elements: {
                                table: jQuery('#ally_list')
                            },
                            onInsertInputBefore: function (addLine, newInsertElement, newInputElement) {
                                var index = addLine.getEntryCount();
                                if (newInputElement.id.indexOf('allys_by_id') == 0) {
                                    newInputElement.id = 'allys_by_id_' + index;
                                    newInputElement.name = 'allys_by_id[]';
                                }
                                else if (newInputElement.id.indexOf('allys_by_name') == 0) {
                                    newInputElement.id = 'allys_by_name_' + index;
                                    newInputElement.name = 'allys_by_name[]';
                                }
                                newInputElement.addEvent('keyup', function () {
                                    checkInputs(index, 'allys');
                                });
                            }
                        });
            });
        </script>
        <div class="spacer"></div>
    <?php endif;?>

    <button type="submit" value="<?=T("Global", "General.ok");?>" name="s1" id="s1" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?=T("Global", "General.ok");?></div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function() {
            if (jQuery('#s1')) {
                jQuery('#s1').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("Global", "General.ok");?>",
                        "name": "s1",
                        "id": "s1",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": ""
                    }]);
                });
            }
        });
    </script>
</form>