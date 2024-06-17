<script type="text/javascript">
    var adventureList = new Travian.AdventureList();
</script>
<div class="boxes boxesColor gray adventureStatusMessage">
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
        <?php if($vars['noRallyPoint']):?>
        <div class="heroStatusMessage header error">
            <?=T("HeroAdventure", "No rallyPoint");?></div>
    </div>
    <?php else:?>
    <div class="heroStatusMessage <?=$vars['status'] == "101Regenerate" ? "header warning" : ($vars['status'] == 101 ? "header error" : "");?>">
        <img alt="Held tot!" src="img/x.gif" class="heroStatus<?=$vars['status'];?>">
        <?=$vars['heroStatusMessage'];?></div>
</div>
<?php endif;?>
</div>
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
        <div class="durationCalculationsContainer" id="durationCalculationsContainer">
            <?php if($vars['villageCount'] <= 1 || $vars['adventureCount'] <= 0):?>
                <a id="chooseOtherVillageLink" class="disabled">
                    <img class="openedClosedSwitch switchClosed switchDisabled"
                         src="img/x.gif"><?=T("HeroAdventure", "Travel time calculation for other villages");?></a>
                <div id="durationCalculations" class="durationCalculations hide">
                    <select onChange="adventureList.calculateDurations()" id="changeVillage">
                        <?=$vars['villages'];?>
                    </select>

                    <div id="heroInVillageInfo">
                    </div>
                    <div id="infoMoveHero">
                    </div>
                    <div id="rallyPointNeeded"></div>
                </div>
            <?php else: ?>
                <div class="durationCalculationsContainer" id="durationCalculationsContainer">
                    <a id="chooseOtherVillageLink" onclick="adventureList.openDurationsCalulator()">
                        <img class="openedClosedSwitch switchClosed " src="img/x.gif"
                             alt=""><?=T("HeroAdventure", "Travel time calculation for other villages");?></a>

                    <div id="durationCalculations" class="durationCalculations hide">
                        <select onchange="adventureList.calculateDurations()" id="changeVillage">
                            <?=$vars['villages'];?>
                        </select>

                        <div id="heroInVillageInfo">
                        </div>
                        <div id="infoMoveHero">
                        </div>
                        <div id="rallyPointNeeded"></div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="headerAdventures"><?=T("HeroAdventure", "headerAdventures");?>:</div>
<form id="adventureListForm" method="post" action="">
    <table cellspacing="1" cellpadding="1">
        <thead>
        <tr>
            <th class="location" colspan="2"><?=T("HeroAdventure", "location");?></th>
            <th class="moveTime"><?=T("HeroAdventure", "moveTime");?></th>
            <th class="difficulty"><?=T("HeroAdventure", "difficulty");?></th>
            <th class="timeLeft"><?=T("HeroAdventure", "timeLeft");?></th>
            <th class="goTo"><?=T("HeroAdventure", "goTo");?></th>
        </tr>
        </thead>
        <tbody>
        <?=$vars['tbody'];?>
        </tbody>
    </table>
</form>
<?php if(!empty($vars['extraButton'])):?>
    <div class="finishNow">
        <br/>
        <?=$vars['extraButton'];?>
    </div>
<?php endif;?>
<script type="text/javascript">
    jQuery(function() {
        var chooseOtherVillageLink = jQuery('chooseOtherVillageLink');
        if (chooseOtherVillageLink.length > 0) {
            chooseOtherVillageLink.on('click', function(e) {
                var sw = jQuery('#durationCalculationsContainer .openedClosedSwitch');
                Travian.toggleSwitch(jQuery('durationCalculations'), sw);
                Travian.toggleSwitchDescription(sw, '<?=T("HeroAdventure", "Show travel time calculation for other villages");?>.', '<?=T("HeroAdventure", "Hide travel time calculation for other villages");?>');
            });
        }
    });
</script>