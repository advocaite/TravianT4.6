<div class="a2b">
    <?php if (isset($vars['process']['newVillage'])): ?>
        <div>
            <?= sprintf(T('RallyPoint', 'nowSettlersWillGoNeedsXResources'), number_format_x($vars['process']['neededResources'])); ?>
        </div>
    <?php endif; ?>
    <form method="post" name="snd"
          action="<?php if (isset($vars['process']['d'])): ?><?="build.php?tt=2"; ?><?php else: ?><?="build.php?id=39&amp;tt=2"; ?><?php endif; ?><?php if (isset($vars['extra'])): ?><?=$vars['extra']; ?><?php endif; ?>">
        <?= getCheckerInput(); ?>
        <?php if (isset($vars['process']['timestamp'])): ?>
            <input type="hidden" name="timestamp"
                   value="<?=$vars['process']['timestamp']; ?>"/>
            <input type="hidden" name="timestamp_checksum"
                   value="<?=$vars['process']['timestamp_checksum']; ?>"/>
        <?php endif; ?>
        <?php if (isset($vars['process']['id'])): ?>
            <input type="hidden" name="id" value="<?=$vars['process']['id']; ?>"/>
        <?php endif; ?>
        <?php if (isset($vars['process']['a'])): ?>
            <input type="hidden" name="a" value="<?=$vars['process']['a']; ?>"/>
        <?php endif; ?>
        <?php if (isset($vars['process']['d'])): ?>
            <input type="hidden" name="d" value="<?=$vars['process']['d']; ?>"/>
        <?php endif; ?>
        <?php if (isset($vars['process']['kid'])): ?>
            <input type="hidden" name="kid" value="<?=$vars['process']['kid']; ?>"/>
        <?php endif; ?>
        <?php if (isset($vars['process']['attack_type'])): ?>
            <input type="hidden" name="b"
                   value="<?=$vars['process']['attack_type']; ?>"/>
        <?php endif; ?>
        <?=$vars['process']['troops_details']; ?>
        <?=$vars['process']['error'] == 0 ? $vars['process']['submitButton'] : ''; ?>
    </form>
    <?php if ($vars['process']['error']): ?>
        <p class="error"><?=$vars['process']['errorMsg']; ?></p>
    <?php endif; ?>
    <?php if (isset($vars['process']['greyAreaCaution'])): ?>
        <div class="alert warning">
            <?= T("RallyPoint", "greyAreaNewVillageCaution"); ?>
        </div>
    <?php endif; ?>
</div>