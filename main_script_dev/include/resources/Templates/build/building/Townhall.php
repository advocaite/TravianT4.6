<?php
if (!($vars['bigCelebration']['active'] and $vars['bigCelebration']['points'] > 0) && !($vars['smallCelebration']['points'] > 0)) {
    return;
}
?>
    <h4 class="round"><?=T("inGame", "Hold a celebration"); ?></h4>
    <div class="build_details researches">
        <?php if ($vars['smallCelebration']['points'] > 0): ?>
            <div class="research">
                <div class="information">
                    <div class="title">
                        <a href="#"
                           onclick="return Travian.Game.iPopup(24,4);"><img
                                    class="celebration celebrationSmall" src="img/x.gif"
                                    alt="<?=T(
                                        "inGame", "Small celebration"
                                    ); ?>"
                                    title="<?=T(
                                        "inGame", "Small celebration"
                                    ); ?>"/></a> <a href="#"
                                                    onclick="return Travian.Game.iPopup(24,4);"><?=T(
                                "inGame", "Small celebration"
                            ); ?></a>
                        <span
                                class="points">(<?=$vars['smallCelebration']['points']; ?> <?=T(
                                "inGame", "culture points"
                            ); ?>)</span>
                    </div>

                    <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?=number_format_x($vars['smallCelebration']['cost'][0]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?=number_format_x($vars['smallCelebration']['cost'][1]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?=number_format_x($vars['smallCelebration']['cost'][2]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?=number_format_x($vars['smallCelebration']['cost'][3]); ?></span></div>
                    </div>
                    <div class="cta">
                        <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?=$vars['smallCelebration']['time']; ?></span></div>
                        <?=$vars['smallCelebration']['exchangeButton']; ?>
                        <?=$vars['smallCelebration']['npc']; ?>
                        <br />
                        <?=$vars['smallCelebration']['contractLink']; ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        <?php endif; ?>
        <div class="research">
            <?php if ($vars['bigCelebration']['active'] and $vars['bigCelebration']['points'] > 0): ?>
                <?php if ($vars['smallCelebration']['points'] > 0): ?>
                    <hr/>
                    <br/>
                <?php endif; ?>
                <div class="information">
                    <div class="title">
                        <a href="#"
                           onclick="return Travian.Game.iPopup(24,4);"><img
                                    class="celebration celebrationSmall" src="img/x.gif"
                                    alt="<?=T("inGame", "Big celebration"); ?>"
                                    title="<?=T(
                                        "inGame", "Big celebration"
                                    ); ?>"/></a> <a href="#"
                                                    onclick="return Travian.Game.iPopup(24,4);"><?=T(
                                "inGame", "Big celebration"
                            ); ?></a>
                        <span class="points">(<?=$vars['bigCelebration']['points']; ?> <?=T(
                                "inGame", "culture points"
                            ); ?>)</span>
                    </div>
                    <div class="inlineIconList resourceWrapper">
                        <div class="inlineIcon resource"><i class="r1Big"></i><span class="value value"><?=number_format_x($vars['bigCelebration']['cost'][0]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r2Big"></i><span class="value value"><?=number_format_x($vars['bigCelebration']['cost'][1]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r3Big"></i><span class="value value"><?=number_format_x($vars['bigCelebration']['cost'][2]); ?></span></div>
                        <div class="inlineIcon resource"><i class="r4Big"></i><span class="value value"><?=number_format_x($vars['bigCelebration']['cost'][3]); ?></span></div>
                    </div>
                    <div class="cta">
                        <div class="inlineIcon duration"><i class="clock_medium"></i><span class="value "><?=$vars['bigCelebration']['time']; ?></span></div>
                        <?=$vars['bigCelebration']['exchangeButton']; ?>
                        <?=$vars['bigCelebration']['npc']; ?>
                        <?=$vars['bigCelebration']['contractLink']; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
    </div>
<?php if ($vars['isCelebration']): ?>
    <h4 class="round spacer"><?=T("inGame", 'celebrationRunning'); ?></h4>
    <table id="under_progress" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td><?=T("inGame", "type"); ?></td>
            <td><?=T("Global", "General.duration"); ?></td>
            <td><?=T("Global", "General.endat"); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="desc"><?=T("inGame", $vars['type'] == 1 ? "Small celebration" : "Big celebration"); ?></td>
            <td class="dur"><?=$vars['timeLeft']; ?></td>
            <td class="fin"><?=$vars['endat']; ?></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>