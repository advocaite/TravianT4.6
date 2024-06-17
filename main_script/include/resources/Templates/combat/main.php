<div class="warsim">
    <?php use Game\Formulas;

    if (isset($vars['response'])): ?>
        <h4 class="round"><?=T("combat", "attack_type"); ?>
            : <?=T("combat", "attack_types." . $vars['response']['attack_type']); ?></h4>
        <?php if (isset($vars['response'][0]['info']['loy'])): ?>
            <p><?=T("RallyPoint", "loyaltyReducedBy"); ?><?=$vars['response'][0]['info']['loy'][0] . '-' . $vars['response'][0]['info']['loy'][1] . '%'; ?></p>
        <?php endif; ?>
        <?=$vars['response']['attackerTable']; ?>
        <?=$vars['response']['defenderTable']; ?>
        <?php if ($vars['response']['showState'] == 1): ?>
            <p>
                <?php if (isset($vars['response'][0]['info']['wall'])): ?>
                    <?php echo(T("combat", "DamageByRam") . ': ' . T("combat", "from") . ' ' . T("Buildings", "level") . ' <b>' . $vars['response'][0]['info']['wall'][0] . '</b> ' . T("combat", "to") . ' ' . T("Buildings", "level") . ' <b>' . $vars['response'][0]['info']['wall'][1] . '</b>'); ?>
                <?php endif; ?>
                <?php if (isset($vars['response'][0]['info']['bl'])): ?>
                    <?php if (isset($vars['response'][0]['info']['wall'])): ?>
                        <br>
                    <?php endif; ?>
                    <?php echo(T("combat", "DamageByCatapult") . ': ' . T("combat", "from") . ' ' . T("Buildings", "level") . ' <b>' . $vars['response'][0]['info']['bl'][0] . '</b> ' . T("combat", "to") . ' ' . T("Buildings", "level") . ' <b>' . $vars['response'][0]['info']['bl'][1] . '</b>'); ?>
                <?php endif; ?>
            </p>
        <?php endif; ?>
        <h4 class="round"><?=T("combat", "attack_settings"); ?></h4>
    <?php endif; ?>
    <form action="build.php?id=39&amp;tt=3" method="post">
        <div id="attacker">
            <div class="fighterType">
                <div class="boxes boxesColor red">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf"><?=T("combat", "attacker"); ?>    </div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="border">
                <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                    <tbody>
                    <tr>
                        <th><?=T("Global", "races." . $vars['attacker']['race']); ?> </th>
                    </tr>
                    <tr>
                        <td class="details">
                            <table cellpadding="1" cellspacing="1">
                                <?=$vars['attacker']['unitsHTML']; ?>
                                    <tr>
                                        <td class="ico">
                                            <img src="img/x.gif" class="unit uhero" alt="<?=T("Troops", "hero.title");?>">
                                        </td>
                                        <td class="desc"><?=T("Troops", "hero.title");?></td>
                                        <td class="value"><input class="text" type="text" name="hero" value="<?=($vars['attacker']['hero'] ? 1 : 0);?>" maxlength="1"></td>
                                        <td class="research">
                                        </td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="border">
                <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                    <tbody>
                    <tr>
                        <th><?=T("combat", "other"); ?></th>
                    </tr>
                    <tr>
                        <td class="details">
                            <table cellpadding="1" cellspacing="1">
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="unit uhab"
                                             alt="<?=T("combat", "Population"); ?>"
                                             title="<?=T("combat", "Population"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("combat", "Population"); ?>">
                                        <?=T("combat", "Population"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="ew1"
                                                             value="<?=$vars['attacker']['pop']; ?>"
                                                             maxlength="5"
                                                             title="<?=T("combat", "number"); ?> <?=T("combat", "Population"); ?>"/>
                                    </td>
                                    <td class="research">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="unit ucata"
                                             alt="<?=T("combat", "catapult_target_level"); ?>"
                                             title="<?=T("combat", "catapult_target_level"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("combat", "catapult_target_level"); ?>">
                                        <?=T("combat", "catapult_target_level"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="kata"
                                                             value="<?=$vars['attacker']['catapult_target_level']; ?>"
                                                             maxlength="2"
                                                             title="<?=T("combat", "catapult_target_level"); ?>"/>
                                    </td>
                                    <td class="research">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="unit uhero"
                                             alt="<?=T("Troops", "98.title"); ?>"
                                             title="<?=T("Troops", "98.title"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("Troops", "98.title"); ?>">
                                        <?=T("combat", "hero_off_bonus"); ?>
                                    </td>
                                    <td class="value"><input class="text" type="text" name="h_off_bonus"
                                                             value="<?=$vars['attacker']['h_off_bonus']; ?>"
                                                             maxlength="4"
                                                             title="<?=T("combat", "hero_off_bonus"); ?>"/></td>
                                    <td class="research">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="unit uhero"
                                             alt="<?=T("Troops", "98.title"); ?>"
                                             title="<?=T("Troops", "98.title"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("Troops", "98.title"); ?>">
                                        <?=T("combat", "hero_power"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="h_power"
                                                             value="<?=$vars['attacker']['h_power']; ?>"
                                                             maxlength="5"
                                                             title="<?=T("combat", "hero_power"); ?>"/></td>
                                    <td class="research"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="defender">
            <div class="fighterType">
                <div class="boxes boxesColor green">
                    <div class="boxes-tl"></div>
                    <div class="boxes-tr"></div>
                    <div class="boxes-tc"></div>
                    <div class="boxes-ml"></div>
                    <div class="boxes-mr"></div>
                    <div class="boxes-mc"></div>
                    <div class="boxes-bl"></div>
                    <div class="boxes-br"></div>
                    <div class="boxes-bc"></div>
                    <div class="boxes-contents cf"><?=T("combat", "defender"); ?></div>
                </div>
            </div>
            <div class="clear"></div>
            <?php if (isset($vars['defender']['races'][1])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.1"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][1]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][2])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.2"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][2]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][3])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.3"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][3]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][4])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.4"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][4]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][5])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.5"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][5]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][6])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.6"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][6]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (isset($vars['defender']['races'][7])): ?>
                <div class="border">
                    <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                        <tbody>
                        <tr>
                            <th><?=T("Global", "races.7"); ?></th>
                        </tr>
                        <tr>
                            <td class="details">
                                <table cellpadding="1" cellspacing="1">
                                    <?=$vars['defender']['races'][7]['unitsHTML']; ?>
                                </table>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <div class="border">
                <table class="fill_in transparent" cellpadding="1" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>
                            <?=T("combat", "other"); ?>                    </th>
                    </tr>
                    <tr>
                        <td class="details">
                            <table cellpadding="1" cellspacing="1">
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="unit uhab"
                                             alt="<?=T("combat", "Population"); ?>"
                                             title="<?=T("combat", "Population"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("combat", "Population"); ?>">
                                        <?=T("combat", "Population"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="ew2"
                                                             value="<?=$vars['defender']['pop']; ?>"
                                                             maxlength="5"
                                                             title="<?=T("combat", "number"); ?> <?=T("combat", "Population"); ?>"/>
                                    </td>
                                    <td class="research">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="gebIcon g34Icon"
                                             alt="<?=T("Buildings", "34.title"); ?>"
                                             title="<?=T("Buildings", "34.title"); ?>"/>
                                    </td>
                                    <td class="desc" title="<?=T("Buildings", "34.title"); ?>">
                                        <?=T("Buildings", "34.title"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="steinmetz"
                                                             value="<?=$vars['defender']['steinmetz']; ?>"
                                                             maxlength="2"
                                                             title="<?=T("Buildings", "level"); ?> <?=T("Buildings", "34.title"); ?>"/>
                                    </td>
                                    <td class="research">
                                    </td>
                                </tr>
                                <?php
                                foreach ([1, 2, 3, 6, 7] as $k) {
                                    if (!isset($vars['defender']['races'][$k])) continue;
                                    $wall_ID = Formulas::getWallID($k);
                                    ?>
                                    <tr>
                                        <td class="ico">
                                            <img src="img/x.gif" class="gebIcon g<?= $wall_ID; ?>Icon"
                                                 alt="<?=T("Buildings", "{$wall_ID}.title"); ?>"
                                                 title="<?=T("Buildings", "{$wall_ID}.title"); ?>"/>
                                        </td>
                                        <td class="desc" title="<?=T("Buildings", "{$wall_ID}.title"); ?>">
                                            <?=T("Buildings", "{$wall_ID}.title"); ?>    </td>
                                        <td class="value"><input class="text" type="text" name="wall<?= $k; ?>"
                                                                 value="<?=$vars['defender']['wall' . $k]; ?>"
                                                                 maxlength="2"
                                                                 title="<?=T("Buildings", "level"); ?> <?=T("Buildings", "{$wall_ID}.title"); ?>"/>
                                        </td>
                                        <td class="research"></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td class="ico">
                                        <img src="img/x.gif" class="gebIcon g26Icon"
                                             alt="<?=T("combat", "Palace_Resident"); ?>"
                                             title="<?=T("combat", "Palace_Resident"); ?>e"/>
                                    </td>
                                    <td class="desc" title="<?=T("combat", "Palace_Resident"); ?>">
                                        <?=T("combat", "Palace_Resident"); ?>    </td>
                                    <td class="value"><input class="text" type="text" name="palast"
                                                             value="<?=$vars['defender']['palast']; ?>"
                                                             maxlength="2"
                                                             title="<?=T("Buildings", "level"); ?> <?=T("combat", "Palace_Resident"); ?>"/>
                                    </td>
                                    <td class="research">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clear"></div>

        <table id="select" cellpadding="1" cellspacing="1">
            <tbody>
            <tr>
                <td>
                    <div class="fighterType">
                        <div class="boxes boxesColor red">
                            <div class="boxes-tl"></div>
                            <div class="boxes-tr"></div>
                            <div class="boxes-tc"></div>
                            <div class="boxes-ml"></div>
                            <div class="boxes-mr"></div>
                            <div class="boxes-mc"></div>
                            <div class="boxes-bl"></div>
                            <div class="boxes-br"></div>
                            <div class="boxes-bc"></div>
                            <div class="boxes-contents cf"><?=T("combat", "attacker"); ?>    </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="choice">
                        <input class="radio" type="radio" name="a1_v"
                               value="1"<?=$vars['attacker']['race'] == 1 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.1"); ?></label>
                        <br/>
                        <input class="radio" type="radio" name="a1_v"
                               value="2"<?=$vars['attacker']['race'] == 2 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.2"); ?></label>
                        <br/>
                        <input class="radio" type="radio" name="a1_v"
                               value="3"<?=$vars['attacker']['race'] == 3 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.3"); ?></label>
                        <br/>
                        <input class="radio" type="radio" name="a1_v"
                               value="6"<?=$vars['attacker']['race'] == 6 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.6"); ?></label>
                        <br/>
                        <input class="radio" type="radio" name="a1_v"
                               value="7"<?=$vars['attacker']['race'] == 7 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.7"); ?></label>
                    </div>
                </td>
                <td>
                    <div class="fighterType">
                        <div class="boxes boxesColor green">
                            <div class="boxes-tl"></div>
                            <div class="boxes-tr"></div>
                            <div class="boxes-tc"></div>
                            <div class="boxes-ml"></div>
                            <div class="boxes-mr"></div>
                            <div class="boxes-mc"></div>
                            <div class="boxes-bl"></div>
                            <div class="boxes-br"></div>
                            <div class="boxes-bc"></div>
                            <div class="boxes-contents cf"><?=T("combat", "defender"); ?>    </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="choice">
                        <input class="check" type="checkbox" name="a2_v1"
                               value="1"<?=isset($vars['defender']['races'][1]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.1"); ?></label><br/>
                        <input class="check" type="checkbox" name="a2_v2"
                               value="1"<?=isset($vars['defender']['races'][2]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.2"); ?></label><br/>
                        <input class="check" type="checkbox" name="a2_v3"
                               value="1"<?=isset($vars['defender']['races'][3]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.3"); ?></label><br/>
                        <input class="check" type="checkbox" name="a2_v6"
                               value="6"<?=isset($vars['defender']['races'][6]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.6"); ?></label><br/>
                        <input class="check" type="checkbox" name="a2_v7"
                               value="7"<?=isset($vars['defender']['races'][7]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.7"); ?></label><br/>
                        <input class="check" type="checkbox" name="a2_v4"
                               value="1"<?=isset($vars['defender']['races'][4]) ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("Global", "races.4"); ?></label>

                    </div>
                </td>

                <td>
                    <div class="fighterType">
                        <div class="boxes boxesColor darkGray">
                            <div class="boxes-tl"></div>
                            <div class="boxes-tr"></div>
                            <div class="boxes-tc"></div>
                            <div class="boxes-ml"></div>
                            <div class="boxes-mr"></div>
                            <div class="boxes-mc"></div>
                            <div class="boxes-bl"></div>
                            <div class="boxes-br"></div>
                            <div class="boxes-bc"></div>
                            <div class="boxes-contents cf"><?=T("combat", "attack_type"); ?>    </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="choice">
                        <input class="radio" type="radio" name="ktyp"
                               value="1"<?=($vars['attack_type'] - 1) == 1 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("combat", "normal"); ?></label><br/>
                        <input class="radio" type="radio" name="ktyp"
                               value="2"<?=($vars['attack_type'] - 1) == 2 ? ' checked="checked"' : ''; ?>/>
                        <label><?=T("combat", "raid"); ?></label><br/>
                        <input type="hidden" name="uid" value="<?=$vars['uid']; ?>"/>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <?=$vars['submitButton']; ?>
    </form>
</div>