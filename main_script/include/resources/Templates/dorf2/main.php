<div class="villageMapWrapper">
    <div id="village_map">
        <map name="clickareas" id="clickareas">
            <?php foreach ($vars['maps'] as $index => $map):++$index; ?>
                <?php $map['title'] = htmlspecialchars($map['title']); ?>
                <area data-index="<?= $map['index']; ?>" alt="<?= $map['title']; ?>"
                      title="<?= $map['title']; ?>" shape="poly" coords="<?= $map['coordinates']; ?>"
                      href="build.php?id=<?= $map['index']; ?><?= ($map['fastUP'] ? "&fastUP={$map['fastUP']}" : ''); ?>"/>
            <?php endforeach; ?>
        </map>
        <?= $vars['img']; ?>
        <div id="levels" class="t44">
            <?= $vars['levels']; ?>
        </div>
        <img src="img/x.gif" id="lswitch" class="<?= $vars['levelsActive'] ? "lswitchPlus" : "lswitchMinus"; ?>"
             title="<?= T("Buildings", "onOffLevelSwitch"); ?>"
             onclick="Travian.Game.Village.toggleBuildingLevels(); return false;" alt=""/>
        <img class="clickareas" usemap="#clickareas" src="img/x.gif" alt=""/>
    </div>
</div>
<?php if (false): ?>
    <img class="rocket rocket_tur" src="img/x.gif" alt="">
    <img class="rocket rocket_yell" src="img/x.gif" alt="">
    <img class="rocket rocket_oran" src="img/x.gif" alt="">
    <img class="rocket rocket_green" src="img/x.gif" alt="">
    <img class="rocket rocket_red" src="img/x.gif" alt="">
<?php endif; ?>
<div class="clear">&nbsp;</div>
<?= $vars['onLoadBuildings']; ?>