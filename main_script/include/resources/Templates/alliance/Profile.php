<div id="details">
    <h4 class="round small"><?=T("Alliance", "Details");?></h4>
    <table cellpadding="1" cellspacing="1" class="transparent">
        <tbody>
        <tr>
            <th><?=T("Alliance", "Tag");?>:</th>
            <td><?=$vars['tag'];?></td>
        </tr>
        <tr>
            <th><?=T("Alliance", "name");?>:</th>
            <td><?=$vars['name'];?></td>
        </tr>
        <tr>
            <th><?=T("Alliance", "Rank");?></th>
            <td><?=$vars['rank'];?></td>
        </tr>

        <tr>
            <th><?=T("Alliance", "Points");?></th>
            <td><?=$vars['points'];?></td>
        </tr>

        <tr>
            <th><?=T("Alliance", "Members");?></th>
            <td><?=$vars['Members'];?></td>
        </tr>
        <?php if($vars['hasForum']):?>
            <tr>
                <td colspan="2">
                    <a class="a arrow" href="allianz.php?s=2&aid=<?=$vars['aid'];?>"><?=T("Alliance", "toTheForum");?></a>
                </td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<?php if($vars['hasPosition']):?>
    <div id="memberTitles">
        <h4 class="round small"><?=T("Alliance", "Position");?></h4>
        <table cellpadding="1" cellspacing="1" class="transparent">
            <tbody>
            <?=$vars['position'];?>
            </tbody>
        </table>
    </div>
<?php endif;?>
<?php $add = $vars['isMyAlliance'] ? '' : '&aid=' . $vars['aid']; ?>
<div class="contentNavi tabNavi tabFavorSubWrapper">
    <div title="" class="container <?=$vars['action'] == 'description' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$vars['favorActionId'] == 'description' ? 'favorActive' : '';?> favorKeydescription">
            <a id="<?=$button_id = get_button_id();?>" href="allianz.php?s=1&amp;action=description<?=$add;?>" class="tabItem">
                <?=T("Alliance", "desc");?>
                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
            jQuery('#<?=$button_id;?>').click(function (event)
            {
                jQuery(window).trigger('tabClicked', [this, {"class":"active","title":false,"target":false,"id":"<?=$button_id;?>","href":"allianz.php?s=1&action=description","onclick":false,"enabled":true,"text":"Description","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
    </script>

    <div title="" class="container <?=$vars['action'] == 'members' ? 'active' : 'normal';?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$vars['favorActionId'] == 'members' ? 'favorActive' : '';?> favorKeymembers">

            <a id="<?=$button_id = get_button_id();?>" href="allianz.php?s=1&amp;action=members<?=$add;?>" class="tabItem">
                <?=T("Alliance", "Members");?>
                    <img src="img/x.gif" class="favorIcon" alt="<?=T("inGame", "This tab is selected as your fav tab");?>">
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if(jQuery('#<?=$button_id;?>'))
        {
            jQuery('#<?=$button_id;?>').click(function (event)
            {
                jQuery(window).trigger('tabClicked', [this, {"class":"normal","title":false,"target":false,"id":"<?=$button_id;?>","href":"allianz.php?s=1&action=members","onclick":false,"enabled":true,"text":"Members","dialog":false,"plusDialog":false,"goldclubDialog":false,"containerId":"","buttonIdentifier":"<?=$button_id;?>"}]);

            });
        }
    </script>
    <a type="submit" id="nestedTabFavorButton" class="icon nestedTabRowButton" title="<?=T("inGame", "Select this tab as fav");?>" onclick="Travian.ajax({data: {cmd: 'tabFavorite',name: 'allyPageProfile',number: '<?=$vars['action'];?>'},onSuccess: function(data) {if (data.success) { jQuery('.tabFavorSubWrapper .favor').removeClass('favorActive');jQuery('.tabFavorSubWrapper .favor.favorKey<?=$vars['action'];?>').addClass('favorActive');}}});return false;"><img src="img/x.gif" class="&nbsp" alt="&nbsp" /></a>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?php if($vars['action'] === 'description'): ?>
<div class="description description1">
    <?=$vars['desc1'];?>
</div>
<div class="description description2">
    <?=$vars['desc2'];?>
</div>
<?php endif; ?>
<div class="clear"></div>
<?php if($vars['action'] === 'members'): ?>
    <table cellspacing='1' cellpadding='2' class='allianceMembers'>
        <tr>
            <td class="counter"></td>
            <td class="tribe"></td>
            <td><?=T("Alliance", "Player");?></td>
            <td class="population"><?=T("Alliance", "Population");?></td>
            <td class="villages"><?=T("Alliance", "Villages");?></td>
            <td class="buttons"></td>
        </tr>
        <?=$vars['MembersHTML'];?>
        </table>
    <script type="text/javascript">
        AllianceMembersButtonsDoubleClickPreventer = new Travian.DoubleClickPreventer();
        AllianceMembersButtonsDoubleClickPreventer.timeout = 1000;
        jQuery(function () {

            jQuery('button.editNote').on("click", function(e) {
                e.preventDefault();

                if (!AllianceMembersButtonsDoubleClickPreventer.check()) {
                    return false;
                }
                new Travian.Game.AllianceMembers(
                    {
                        data: {
                            cmd: 'playerNote',
                            affectedPlayerID: this.value,
                            hasNote: this.getAttribute('data-note'),
                            hasSpecialization: this.getAttribute('data-spec'),
                            action: 'edit'
                        },
                        context: 'playerNote',
                        buttonOk: false,
                        darkOverlay: true
                    }
                );

            });
        });
    </script>
<?php endif; ?>