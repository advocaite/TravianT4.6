<?php
function MergeSubFilters($id, $subFiltersArray)
{
    if($subFiltersArray[$id]) {//filter is active link must deactivate it!
        $subFiltersArray[$id] = 0;
    } else {//key is not active! merge with current
        $subFiltersArray[$id] = 1;
    }

    return implodeActiveSubFilters($subFiltersArray);
}

$filter = isset($_REQUEST['filter']) && is_numeric($_REQUEST['filter']) && $_REQUEST['filter'] >= 1 && $_REQUEST['filter'] <= 4 ? $_REQUEST['filter'] : 0;
$subFiltersArray = $filter == 1 ? [
    1 => 1, 2 => 1, 3 => 0,
] : [4 => 1, 5 => 1, 6 => 0];
function implodeActiveSubFilters($subFiltersArray)
{
    $implode = [];
    foreach($subFiltersArray as $subFilterId => $subFilterActive) {
        if($subFilterActive) {
            $implode[] = $subFilterId;
        }
    }

    return implode(",", $implode);
}

if( $vars['filter'] > 0 and $vars['filter'] < 3):?>
    <div class="filter subFilterContainer">
        <div class="boxes boxesColor gray">
            <div class="boxes-tl"></div>
            <div class="boxes-tr"></div>
            <div class="boxes-tc"></div>
            <div class="boxes-ml"></div>
            <div class="boxes-mr"></div>
            <div class="boxes-mc"></div>
            <div class="boxes-bl"></div>
            <div class="boxes-br"></div>
            <div class="boxes-bc"></div>
            <div class="boxes-contents cf">
                <div class="filterContainer">
                    <?php if( $vars['filter'] == 1):?>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][1] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.1");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=1&amp;subfilters=<?=MergeSubFilters(1, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory1"
                                 alt="filterCategory subFilterCategory1"/></button>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][2] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.2");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=1&amp;subfilters=<?=MergeSubFilters(2, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory2"
                                 alt="filterCategory subFilterCategory2"/></button>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][3] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.3");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=1&amp;subfilters=<?=MergeSubFilters(3, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory3"
                                 alt="filterCategory subFilterCategory3"/></button>
                    <?php else:?>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][4] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.4");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=2&amp;subfilters=<?=MergeSubFilters(4, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory4"
                                 alt="filterCategory subFilterCategory4"/></button>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][5] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.5");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=2&amp;subfilters=<?=MergeSubFilters(5, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory5"
                                 alt="filterCategory subFilterCategory5"/></button>
                        <button type="button" class="iconFilter <?=$vars['subFilters'][6] > 0 ? "iconFilterActive" : '';?>"
                                title="<?=T("RallyPoint", "SubFilters.6");?>"
                                onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=2&amp;subfilters=<?=MergeSubFilters(6, $vars['subFilters']);?>'; return false;">
                            <img src="img/x.gif" class="filterCategory subFilterCategory6"
                                 alt="filterCategory subFilterCategory6"/></button>
                    <?php endif;?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php endif;?>
<div class="filter">
    <div class="boxes boxesColor gray">
        <div class="boxes-tl"></div>
        <div class="boxes-tr"></div>
        <div class="boxes-tc"></div>
        <div class="boxes-ml"></div>
        <div class="boxes-mr"></div>
        <div class="boxes-mc"></div>
        <div class="boxes-bl"></div>
        <div class="boxes-br"></div>
        <div class="boxes-bc"></div>
        <div class="boxes-contents cf">
            <div class="filterContainer">
                <button type="button" class="iconFilter <?=$vars['filter'] == 1 ? "iconFilterActive" : '';?>"
                        title="<?=T("RallyPoint", "filters.1");?>"
                        onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=<?=$vars['filter'] == 1 ? '' : 1;?>'; return false;">
                    <img src="img/x.gif" class="filterCategory filterCategory1" alt="filterCategory filterCategory1"/>
                </button>
                <button type="button" class="iconFilter <?=$vars['filter'] == 2 ? "iconFilterActive" : '';?>"
                        title="<?=T("RallyPoint", "filters.2");?>"
                        onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=<?=$vars['filter'] == 2 ? '' : 2;?>'; return false;">
                    <img src="img/x.gif" class="filterCategory filterCategory2" alt="filterCategory filterCategory2"/>
                </button>
                <button type="button" class="iconFilter <?=$vars['filter'] == 3 ? "iconFilterActive" : '';?>"
                        title="<?=T("RallyPoint", "filters.3");?>"
                        onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=<?=$vars['filter'] == 3 ? '' : 3;?>'; return false;">
                    <img src="img/x.gif" class="filterCategory filterCategory3" alt="filterCategory filterCategory3"/>
                </button>
                <button type="button" class="iconFilter <?=$vars['filter'] == 4 ? "iconFilterActive" : '';?>"
                        title="<?=T("RallyPoint", "filters.4");?>"
                        onclick="window.location.href = '?gid=16&amp;tt=1&amp;filter=<?=$vars['filter'] == 4 ? '' : 4;?>'; return false;">
                    <img src="img/x.gif" class="filterCategory filterCategory4" alt="filterCategory filterCategory4"/>
                </button>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<div class="data">
    <?=$vars['content'];?>
</div>