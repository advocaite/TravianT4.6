<h4 class="round"><?=T("Alliance", "Assign to position");?></h4>
<p><?=T("Alliance", "You can set up different permissions for each alliance member and assign positions");?></p>
<form id="SettingsFormular" method="post" action="allianz.php?s=5&amp;o=1">
    <table cellpadding="1" cellspacing="1" id="memberAdministration">

        <thead>
        <tr>
            <th><?=T("Alliance", "Player");?></th>
            <th><img src="img/x.gif" class="allyRight allyRightPosition" alt="<?=T("Alliance", "Assign to position");?>" title="<?=T("Alliance", "Assign to position");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightDisband" alt="<?=T("Alliance", "Kick player");?>" title="<?=T("Alliance", "Kick player");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightDescription" alt="<?=T("Alliance", "Change alliance description");?>" title="<?=T("Alliance", "Change alliance description");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightDiplomacy" alt="<?=T("Alliance", "Alliance diplomacy");?>" title="<?=T("Alliance", "Alliance diplomacy");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightMessage" alt="<?=T("Alliance", "IGMs to every alliance member");?>" title="<?=T("Alliance", "IGMs to every alliance member");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightInvite" alt="<?=T("Alliance", "Invite a player into the alliance");?>" title="<?=T("Alliance", "Invite a player into the alliance");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightForum" alt="<?=T("Alliance", "Manage forums");?>" title="<?=T("Alliance", "Manage forums");?>"/></th>
            <th><img src="img/x.gif" class="allyRight allyRightFlags" alt="<?=T("Alliance", "Manage flags and markers in map");?>" title="<?=T("Alliance", "Manage flags and markers in map");?>"/></th>
            <!---<th><img src="img/x.gif" class="allyRight allyRightSpecialization" alt="Manage members specializations" title="Manage members specializations"/></th>--->
            <th><?=T("Alliance", "Title");?></th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['membersWithPermission'];?>
        </tbody>
    </table>
    <p>
        <input type="hidden" name="a" value="1"/>
        <button type="submit" value="ok" name="s1" id="btn_ok" class="green " title="<?=T("Global", "General.save");?>">
            <div class="button-container addHoverClick">
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
        <script type="text/javascript">
            jQuery(function() {
                if (jQuery('#btn_ok').length > 0) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "ok",
                            "name": "s1",
                            "id": "btn_ok",
                            "class": "green ",
                            "title": "<?=T("Global", "General.save");?>",
                            "confirm": "",
                            "onclick": ""
                        }]);
                    });
                }
            });
        </script>
    </p>
</form>
<?php if(isset($vars['note'])):?>
    <p class="note option"><?=$vars['note'];?></p>
<?php endif;?>