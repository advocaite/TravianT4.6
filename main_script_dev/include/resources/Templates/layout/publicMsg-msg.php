<div id="sysmsg">
    <?php if ($vars['autoType'] == false): ?>
        <?=$vars['DearPlayer']; ?>
        <br/><br/>
        <img src="/img/u4.gif" style="float:<?=getDirection() == 'RTL' ? 'left' : 'right'; ?>;"/>
    <?php endif; ?>
    <?=$vars['message']; ?>
    <br/><br/>
    <br/><br/>
    <?php if ($vars['autoType'] == false): ?>
        <?=T("Global", "Best regards,The Travian Team"); ?>
        <br/><br/>
    <?php endif; ?>
    <p class="f16" align="center"><a href="dorf1.php?ok">» <?=T("Global", "continue"); ?></a></p>
    <script type="text/javascript"> jQuery(function () {
            jQuery(["village1", "village2"]).each(function (_, e) {
                jQuery("body").removeClass(e);
            });
        }) </script>
</div>
<div class="clear"></div>