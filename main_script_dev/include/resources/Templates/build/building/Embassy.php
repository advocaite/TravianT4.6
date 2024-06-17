<?php if($vars['showTabs']):?>
<div class="contentNavi tabNavi tabFavorSubWrapper">
    <?php if ($vars['hasAlliance']): ?>
        <div title="" class="container <?= ($vars['action'] == 'info' ? 'active' : 'normal'); ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content favor <?= ($vars['favorTab'] == 'info' ? 'favorActive' : ''); ?> favorKeyinfo">
                <a id="<?= ($button_id = get_button_id()); ?>"
                   href="build.php?id=<?= $vars['buildingIndex']; ?>&action=info"
                   class="tabItem"><?= T("Embassy", "Alliance"); ?>
                    <img src="img/x.gif" class="favorIcon"
                         alt="<?=T("Global", "This tab is set as favourite"); ?>"/></a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['action'] == 'info' ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=info",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Embassy", "Alliance");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>

        <div title="" class="container <?= ($vars['action'] == 'leave' ? 'active' : 'normal'); ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content favor <?= ($vars['favorTab'] == 'leave' ? 'favorActive' : ''); ?> favorKeyleave">
                <a id="<?= $button_id; ?>" href="build.php?tt=0&id=<?= $vars['buildingIndex']; ?>&action=leave"
                   class="tabItem"><?= T("Embassy", "Leave the alliance"); ?><img src="img/x.gif" class="favorIcon"
                                                                                  alt="<?=T("Global", "This tab is set as favourite"); ?>"/></a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['action'] == 'leave' ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=leave",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Embassy", "Leave the alliance");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>
    <?php else: ?>

        <div
                title=""
                class="container <?= ($vars['action'] == 'find' ? 'active' : 'normal'); ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?= ($vars['favorTab'] == 'find' ? 'favorActive' : ''); ?> favorKeyfind"
            >

                <a
                        id="<?= ($button_id = get_button_id()); ?>" href="build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=find"
                        class="tabItem"
                >
                    <?=T("Embassy", "Find alliance");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/></a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['action'] == 'find' ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=find",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Embassy", "Find alliance");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>

        <div
                title=""
                class="container <?= ($vars['action'] == 'join' ? 'active' : 'normal'); ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?= ($vars['favorTab'] == 'join' ? 'favorActive' : ''); ?> favorKeyjoin"
            >

                <a
                        id="<?= ($button_id = get_button_id()); ?>" href="build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=join"
                        class="tabItem"
                >
                    <?=T("Embassy", "Join alliance");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/></a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['action'] == 'join' ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=join",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Embassy", "Join alliance");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>

        <div
                title=""
                class="container <?= ($vars['action'] == 'found' ? 'active' : 'normal'); ?>"
        >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                    class="content favor <?= ($vars['favorTab'] == 'found' ? 'favorActive' : ''); ?> favorKeyfound"
            >

                <a
                        id="<?= ($button_id = get_button_id()); ?>" href="build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=found"
                        class="tabItem"
                >
                    <?=T("Embassy", "Found alliance");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite"); ?>"/></a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['action'] == 'found' ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "build.php?tt=0&id=<?=$vars['buildingIndex'];?>&action=found",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("Embassy", "Found alliance");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>
    <?php endif; ?>
    <a type="submit" id="nestedTabFavorButton" class="icon nestedTabRowButton" title="<?=T("Global", "This tab is set as favourite"); ?>"
       onclick="Travian.ajax({data: {cmd: 'tabFavorite',name: 'embassyBuildingSubTabs',number: '<?= $vars['action']; ?>'},onSuccess: function(data) {if (data.success) { jQuery('.tabFavorSubWrapper .favor').removeClass('favorActive');jQuery('.tabFavorSubWrapper .favor.favorKey<?= $vars['action']; ?>').addClass('favorActive');}}});return false;"><img
                src="img/x.gif" class="&nbsp" alt="&nbsp"/></a>
    <div class="clear"></div>
</div>
<?php endif;?>
<?= $vars['content']; ?>
