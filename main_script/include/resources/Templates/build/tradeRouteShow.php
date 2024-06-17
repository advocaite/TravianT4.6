<p>
    <a class="a arrow" href="?t=0&amp;gid=17&amp;option=1&amp;show-destination=all" title="<?=T("MarketPlace", "Create new trade route");?>">
        <?=T("MarketPlace", "Create new trade route");?>
    </a>
</p>
<table id="trading_routes" cellspacing="1" cellpadding="1">
    <thead>
    <tr>
        <?php
        $sortId = $vars['sortId'];
        $sortBy = $vars['sortBy'];
        ?>
        <th colspan="2">
            <a id="sorting1" class="sorting <?=($sortId == 1 ? $sortBy : null);?>" href="?t=0&amp;gid=17" onclick="Travian.Game.Marketplace.toggleSorting(1);">
                <?=T("MarketPlace", "Description");?>
                <img alt="sort" src="img/x.gif">
            </a>
        </th>
        <th>
            <a id="sorting2" class="sorting <?=($sortId == 2 ? $sortBy : null);?>" href="?t=0&amp;gid=17" onclick="Travian.Game.Marketplace.toggleSorting(2);">
                <?=T("MarketPlace", "Start");?>
                <img alt="sort" src="img/x.gif">
            </a>
        </th>
        <th><?=T("MarketPlace", "Merchants");?></th>
        <th><?=T("MarketPlace", "Action");?></th>
        <th>
            <a id="sorting3" class="sorting <?=($sortId == 3 ? $sortBy : null);?>" href="?t=0&amp;gid=17" onclick="Travian.Game.Marketplace.toggleSorting(3);">
            <?=T("MarketPlace", "Enabled");?>
                <img alt="sort" src="img/x.gif">
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?=$vars['content'];?>
    </tbody>
</table>