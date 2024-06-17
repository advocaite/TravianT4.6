<br />
<hr />
<form method="GET" action="build.php">
    <input type="hidden" name="id" value="<?=$vars['id'];?>">
    <table class="row_table_data" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="2"><?=T("Global", "Building settings");?></th>
            </tr>
        </thead>
        <tr>
            <td><?=T("Global", "General.level");?>:</td>
            <td><input name="new_building_level" type="number" class="text" value="<?=$vars['level'];?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="green">
                    <div class="button-container addHoverClick hover">
                        <div class="button-background">
                            <div class="buttonStart">
                                <div class="buttonEnd">
                                    <div class="buttonMiddle"></div>
                                </div>
                            </div>
                        </div>
                            <div class="button-content"><?=T("Global", "General.save");?></div>
                        </div>
                </button>
            </td>
        </tr>
    </table>
</form>