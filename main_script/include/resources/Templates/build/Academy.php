<h4 class="round"><?= sprintf(T("Academy", "Researches for village %s"), $vars['villageName']); ?></h4>

<div class="build_details researches">
    <?php if ($vars['availableSize'] > 0): ?>
        <?= $vars['availableResearches']; ?>
    <?php else: ?>
        <div class="noResearchPossible">
            <span class="errorMessage"><?= T("Academy", "noResearchAvailableDesc"); ?></span>
        </div>
    <?php endif; ?>
</div>
<?php if ($vars['soonAvailableSize'] > 0): ?>
    <div class="switch">
        <a id="researchFutureLink" class="openedClosedSwitch switchClosed" href="#"
           onclick="Travian.toggleSwitch(jQuery('#researchFuture'), this);"><?= T("Academy", "showMore"); ?></a>
    </div>
    <div id="researchFuture" class="researches hide">
        <?= $vars['soonAvailableResearches']; ?>
    </div>
    <script type="text/javascript">
        //<![CDATA[
        $("researchFuture").toggle = (function () {
            this.toggleClass("hide");

            $("researchFutureLink").set("text",
                this.hasClass("hide")
                    ? "<?=T("Academy", "showMore");?>"
                    : "<?=T("Academy", "hideMore");?>"
            );

            return false;
        }).bind($("researchFuture"));
        //]]>
    </script>
<?php endif; ?>
<?php if ($vars['researchingSize'] > 0): ?>
    <h4 class="round"><?= T("Academy", "Researching"); ?></h4>
    <table cellpadding="1" cellspacing="1" class="under_progress">
        <thead>
        <tr>
            <td><?= T("Academy", "unit"); ?></td>
            <td><?= T("Global", "General.duration"); ?></td>
            <td><?= T("Global", "General.endat"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?= $vars['researchingTableBody']; ?>
        </tbody>
    </table>
    <?= $vars['finishNowButton']; ?>
<?php endif; ?>
<?php if (!empty($vars['researchAllButton'])): ?>
    <br />
    <div class="roundedCornersBox big">
        <h4>
            <div class="statusMessage"><?= T("ExtraModules", "academyResearchAll"); ?></div>
        </h4>
        <div id="contractSpacer"></div>
        <div id="contract" class="contractWrapper">
            <div class="contractLink centeredText">
                <?= $vars['researchAllButton']; ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    //<![CDATA[
    jQuery("researchFutureLink").on("click", function () {
        this.text("text",
            jQuery("researchFuture").hasClass("hide")
                ? "<?=T("Academy", "showMore");?>"
                : "<?=T("Academy", "hideMore");?>"
        );
        return false;
    });
    //]]>
</script>