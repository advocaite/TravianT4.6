<a id="tabFavorButton" class="contentTitleButton"
   onclick="
           Travian.ajax(
           {
           data:
           {
           cmd: 'tabFavorite',
           name: 'hero',
           number: '<?=$vars['selectedTab'];?>'
           },
           onSuccess: function(data)
           {
           if (data.success)
           {
           jQuery('.favor').removeClass('favorActive');
           jQuery('.favor.favorKey<?=$vars['selectedTab'];?>').addClass('favorActive');
           }
           }
           });
           return false;
           "
   title="<?=$vars['favorText'];?>"
>&nbsp;</a>
<?php $favorTabId = \Core\Session::getInstance()->getFavoriteTab("hero");?>
<div class="contentNavi subNavi ">
    <div title="" class="container <?=$vars['selectedTab'] == 1 ? "active" : "normal";?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$favorTabId == 1 ? "favorActive" : '';?> favorKey1">

            <a href="hero.php?t=1" class="tabItem"><?=T("HeroGlobal", "Attributes");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['selectedTab'] == 2 ? "active" : "normal";?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$favorTabId == 2 ? "favorActive" : '';?> favorKey2">

            <a href="hero.php?t=2" class="tabItem"><?=T("HeroGlobal", "Appear");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['selectedTab'] == 3 ? "active" : "normal";?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$favorTabId == 3 ? "favorActive" : '';?> favorKey3">

            <a href="hero.php?t=3" class="tabItem"><?=T("HeroGlobal", "Adventure");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/></a>
        </div>
    </div>
    <div title="" class="container <?=$vars['selectedTab'] == 4 ? "active" : "normal";?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content favor <?=$favorTabId == 4 ? "favorActive" : '';?> favorKey4">
            <a href="hero.php?t=4" class="tabItem"><?=T("HeroGlobal", "Auctions");?> <img src="img/x.gif" class="favorIcon" alt="<?=T("Global", "This tab is set as favourite");?>"/></a>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>