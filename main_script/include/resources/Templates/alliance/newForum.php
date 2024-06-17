<script language="JavaScript" type="text/javascript">
    function showCheckList() {
        bid = document.getElementById('bid');
        if (bid.value == 2) {
            if (jQuery('#conf_list')) {
                jQuery('#conf_list').className = '';
                jQuery('#conf_list_headline').removeClass('hide');
            }
            if (jQuery('#ally_list')) {
                jQuery('#ally_list').className = '';
                jQuery('#ally_list_headline').removeClass('hide');
            }
            if (jQuery('#user_list')) {
                jQuery('#user_list').className = 'hide';
                jQuery('#user_list_headline').addClass('hide');
            }
        }
        else if (bid.value == 3) {
            if (jQuery('#conf_list')) {
                jQuery('#conf_list').className = 'hide';
                jQuery('#conf_list_headline').addClass('hide');
            }
            if (jQuery('#ally_list')) {
                jQuery('#ally_list').className = 'hide';
                jQuery('#ally_list_headline').addClass('hide');
            }
            if (jQuery('#user_list')) {
                jQuery('#user_list').className = '';
                jQuery('#user_list_headline').removeClass('hide');
            }
        }
        else {
            if (jQuery('#conf_list')) {
                jQuery('#conf_list').className = 'hide';
                jQuery('#conf_list_headline').addClass('hide');
            }
            if (jQuery('#ally_list')) {
                jQuery('#ally_list').className = 'hide';
                jQuery('#ally_list_headline').addClass('hide');
            }
            if (jQuery('#user_list')) {
                jQuery('#user_list').className = 'hide';
                jQuery('#user_list_headline').addClass('hide');
            }
        }
    }
</script>
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
    <input type="hidden" name="s" value="2">
    <input type="hidden" name="newforum" value="1">
    <input type="hidden" name="admin" value="1">

    <h4 class="round"><?=T("Alliance", "new_forum");?></h4>
    <table class="transparent" id="new_forum">
        <tbody>
        <tr>
            <th><?=T("Alliance", "forum_name");?></th>
            <td><input class="text" type="text" name="u1" value="" maxlength="20"></td>
        </tr>

        <tr>
            <th><?=T("Alliance", "desc");?></th>
            <td><input class="text" type="text" name="u2" value="" maxlength="38"></td>
        </tr>
        <tr>
            <th><?=T("Alliance", "create_in_area");?></th>
            <td>
                <select class="dropdown" id="bid" name="bid" onchange="showCheckList();">
                    <option value="1"><?=T("Alliance", "public_forum");?></option>
                    <option value="2"><?=T("Alliance", "conf_forum");?></option>
                    <option value="0" selected=""><?=T("Alliance", "alliance_forum");?></option>
                    <option value="3"><?=T("Alliance", "closed_forum");?></option>
                </select>
            </td>
        </tr>

        <tr>
            <th><span class="nobr"><?=T("Alliance", "sitters_allowed");?></span></th>
            <td><input type="checkbox" name="for_sitters" value="1" checked="checked" class="check"></td>
        </tr>
        </tbody>
    </table>


    <h4 id="ally_list_headline" class="tableHeadline hide"><?=T("Alliance", "ally_list_headline");?></h4>
    <table cellpadding="1" cellspacing="1" id="ally_list" class="hide">
        <thead>
        <tr>
            <td><?=T("Alliance", "Alliance ID");?></td>
            <td><?=T("Alliance", "Tag");?></td>
            <td><?=T("Alliance", "addLine");?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="addLine insertElement templateElement">
            <td class="ally">
                <input class="text" type="text" id="allys_by_id_0" maxlength="8" name="allys_by_id[]">
            </td>
            <td class="tag">
                <input class="text" type="text" id="allys_by_name_0" maxlength="8" name="allys_by_name[]">
            </td>
            <td class="ad">
                <a href="#" class="addLine addElement"><img src="img/x.gif" class="add" title="اضافه کردن"></a>
            </td>
        </tr>
        </tbody>
    </table>

    <h4 id="user_list_headline" class="tableHeadline hide"><?=T("Alliance", "user_list_headline");?></h4>
    <table cellpadding="1" cellspacing="1" id="user_list" class="hide">
        <thead>
        <tr>
            <td><?=T("Alliance", "Player ID");?></td>
            <td><?=T("Alliance", "name");?></td>
            <td><?=T("Alliance", "addLine");?></td>
        </tr>
        </thead>
        <tbody>
        <tr class="addLine insertElement templateElement">
            <td class="id">
                <input class="text" type="text" id="users_by_id_0" maxlength="8" name="users_by_id[]">
            </td>
            <td class="pla">
                <input class="text" type="text" id="users_by_name_0" maxlength="15" name="users_by_name[]">
            </td>
            <td class="ad">
                <a href="#" class="addLine addElement"><img src="img/x.gif" class="add" title="اضافه کردن"></a>
            </td>
        </tr>
        </tbody>
    </table>


    <div class="spacer"></div>
    <button type="submit" value="<?=T("Global", "General.ok");?>" name="<?=T("Global", "General.ok");?>" id="ok"
            class="green ">
        <div class="button-container addHoverClick ">
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
            if (jQuery('#ok')) {
                jQuery('#ok').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("Global", "General.ok");?>",
                        "name": "<?=T("Global", "General.ok");?>",
                        "id": "ok",
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
<script language="JavaScript" type="text/javascript">
    showCheckList();

    jQuery(function() {
        jQuery('#allys_by_id_0').keyup(function () {
            checkInputs(0, 'allys');
        });
        jQuery('#allys_by_name_0').keyup(function () {
            checkInputs(0, 'allys');
        });
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
                        table: jQuery('#ally_list')
                    },
                    onInsertInputBefore: function (addLine, newInsertElement, newInputElement) {
                        var index = addLine.getEntryCount();
                        if (newInputElement.id.indexOf('allys_by_id') == 0) {
                            newInputElement.id = 'allys_by_id_' + index;
                            newInputElement.name = 'allys_by_id[' + index + ']';
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