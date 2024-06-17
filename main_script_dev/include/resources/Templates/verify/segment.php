<center>
    <span style="color: red;font-weight: bold;">
        <?=T("EVerify", "NEED_VERIFICATION_FOR_FEATURES");?>
    </span>
</center>
<br/>
<script type="text/javascript">
    var errors = <?=json_encode(T("EVerify", "errors"));?>;
</script>
<?php if (!$vars['activationInProgress']): ?>
    <?php require("newProgress.php");?>
<?php else: ?>
    <?php require("inProgress.php");?>
<?php endif; ?>
<?php require("limitations.php");?>