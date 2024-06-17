<a id="tabFavorButton" class="contentTitleButton"
   onclick="
       Travian.ajax(
       {
       data:
       {
       cmd: 'tabFavorite',
       name: 'buildingMarket',
       number: '<?=$vars['selectedTab']; ?>'
       },
       onSuccess: function(data)
       {
       if (data.success)
       {
       jQuery('.favor').removeClass('favorActive');
       jQuery('.favor.favorKey<?=$vars['selectedTab']; ?>').addClass('favorActive');
       }
       }
       });
       return false;
       "
   title="<?=$vars['favorText']; ?>"
    >&nbsp;</a>

<div class="contentNavi subNavi ">
    <div
        title="<?=T("MarketPlace", "Management"); ?>"
        class="container <?=$vars['selectedTab'] == 0 ? 'active'
            : 'normal'; ?>"
        >
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div
            class="content favor <?=$vars['favor'] == 0
                ? 'favorActive' : ''; ?> favorKey0"
            >

            <a
                id="<?=$vars['Management']; ?>"
                href="build.php?t=0&amp;id=<?=$vars['index']; ?>"
                class="tabItem"
                >
                <?=T("MarketPlace", "Management"); ?> <img
                    src="img/x.gif" class="favorIcon"
                    alt="<?=T(
                        "MarketPlace", "This tab is set as favourite"
                    ); ?>"/>
            </a>
        </div>
    </div>

    <script type="text/javascript">
        if (jQuery('#<?=$vars['Management'];?>')) {
            jQuery('#<?=$vars['Management'];?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=$vars['selectedTab'] == 0 ? 'active' : 'normal';?>",
                    "title": "<?=T("MarketPlace", "Management");?>",
                    "target": false,
                    "id": "<?=$vars['Management'];?>",
                    "href": "build.php?t=0&amp;id=<?=$vars['index'];?>",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("MarketPlace", "Management");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$vars['Management'];?>"
                }]);

            });
        }
    </script>

    <?php if ($vars['level'] > 0): ?>
        <div
            title="<?=T("MarketPlace", "SendResources"); ?>	"
            class="container <?=$vars['selectedTab'] == 5 ? 'active'
                : 'normal'; ?>"
            >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                class="content favor <?=$vars['favor'] == 5
                    ? 'favorActive' : ''; ?> favorKey5"
                >

                <a
                    id="<?=$vars['SendResources']; ?>"
                    href="build.php?t=5&amp;id=<?=$vars['index']; ?>"
                    class="tabItem"
                    >
                    <?=T("MarketPlace", "SendResources"); ?> <img
                        src="img/x.gif" class="favorIcon"
                        alt="<?=T(
                            "MarketPlace", "This tab is set as favourite"
                        ); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['SendResources'];?>')) {
                jQuery('#<?=$vars['SendResources'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['selectedTab'] == 5 ? 'active' : 'normal';?>",
                        "title": "<?=T("MarketPlace", "SendResources");?>	",
                        "target": false,
                        "id": "<?=$vars['SendResources'];?>",
                        "href": "build.php?t=5&amp;id=<?=$vars['index'];?>",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("MarketPlace", "SendResources");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['SendResources'];?>"
                    }]);
                });
            }
        </script>

        <div
            title="<?=T("MarketPlace", "Buy"); ?>"
            class="container <?=$vars['selectedTab'] == 1 ? 'active'
                : 'normal'; ?>"
            >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                class="content favor <?=$vars['favor'] == 1
                    ? 'favorActive' : ''; ?> favorKey1"
                >

                <a
                    id="<?=$vars['SendResources']; ?>"
                    href="build.php?t=1&amp;id=<?=$vars['index']; ?>"
                    class="tabItem"
                    >
                    <?=T("MarketPlace", "Buy"); ?> <img src="img/x.gif"
                                                                class="favorIcon"
                                                                alt="<?=T(
                                                                    "MarketPlace",
                                                                    "This tab is set as favourite"
                                                                ); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['Buy'];?>')) {
                jQuery('#<?=$vars['Buy'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['selectedTab'] == 1 ? 'active' : 'normal';?>",
                        "title": "<?=T("MarketPlace", "Buy");?>",
                        "target": false,
                        "id": "<?=$vars['Buy'];?>",
                        "href": "build.php?t=1&amp;id=<?=$vars['index'];?>",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("MarketPlace", "Buy");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Buy'];?>"
                    }]);

                });
            }
        </script>

        <div
            title="<?=T("MarketPlace", "Offer"); ?>"
            class="container <?=$vars['selectedTab'] == 2 ? 'active'
                : 'normal'; ?>"
            >
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div
                class="content favor <?=$vars['favor'] == 2
                    ? 'favorActive' : ''; ?> favorKey2"
                >

                <a
                    id="<?=$vars['Offer']; ?>"
                    href="build.php?t=2&amp;id=<?=$vars['index']; ?>"
                    class="tabItem"
                    >
                    <?=T("MarketPlace", "Offer"); ?> <img
                        src="img/x.gif" class="favorIcon"
                        alt="<?=T(
                            "MarketPlace", "This tab is set as favourite"
                        ); ?>"/>
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (jQuery('#<?=$vars['Offer'];?>')) {
                jQuery('#<?=$vars['Offer'];?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=$vars['selectedTab'] == 2 ? 'active' : 'normal';?>",
                        "title": "<?=T("MarketPlace", "Offer");?>",
                        "target": false,
                        "id": "<?=$vars['Offer'];?>",
                        "href": "build.php?t=2&amp;id=<?=$vars['index'];?>",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("MarketPlace", "Offer");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$vars['Offer'];?>"
                    }]);

                });
            }
        </script>
    <?php endif; ?>
    <div class="clear"></div>
</div>
<?=$vars['content']; ?>

<script type="application/javascript">
    jQuery(function(){
        Travian.Game.Marketplace.onLoad();
    });
</script>
