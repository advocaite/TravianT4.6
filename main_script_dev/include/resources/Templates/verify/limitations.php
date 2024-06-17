<div class="roundedCornersBox" style="margin-top: 10px;">
    <p style="margin-<?= (getDirection() == 'LTR' ? 'left' : 'right'); ?>: 10px;">
        <?=T("EVerify", "YOU_CANNOT_DO_THE_FOLLOWING_THINGS");?>:
    </p>
    <h4><?=T("EVerify", "UNVERIFIED_ACCOUNT_LIMITATIONS");?></h4>
    <div id="contractSpacer"></div>
    <div id="contract" class="contractWrapper">
        <div class="contractLink">
            <p>
            <ul>
                <?php foreach (T("EVerify", "limitations") as $e): ?>
                <li><?= $e; ?></li>
                <?php endforeach; ?>
            </ul>
            <p style="margin-<?= (getDirection() == 'LTR' ? 'left' : 'right'); ?>: 10px;">
                <?=T("EVerify", "WE_ARE_NOT_RESPONSIBLE_AS_ADMINISTRATORS_TO_RESTORE");?>
                <br/>
                <?=T("EVerify", "YOU_ARE_THE_ONLY_ONE_RESPONSIBLE");?>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>