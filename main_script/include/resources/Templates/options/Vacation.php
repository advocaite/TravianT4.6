<h4 class="round"><?php use Core\Session;
    use Game\Formulas;

    echo T("Options", "Vacation"); ?></h4>

<div>
    <?= T("Options", "Use the vacation to protect your villages while being abroad"); ?>
    <br/>
    <?= T("Options", "While in vacation mode the following actions will be deactivated"); ?>
    :
    <br/>
    <ul>
        <li><?= T("Options", "send or receive troops"); ?></li>
        <li><?= T("Options", "start new building orders"); ?></li>
        <li><?= T("Options", "using the marketplace"); ?></li>
        <li><?= T("Options", "start training troops"); ?></li>
        <li><?= T("Options", "join alliances"); ?></li>
        <li><?= T("Options", "delete your account"); ?></li>
    </ul>
</div>

<form id="settings" action="options.php?s=4" method="post">
    <input type="hidden" name="e" value="4"/>
    <input type="hidden" name="s" value="4"/>
    <input type="hidden" name="a" value=""/>


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
            <div class="switchWrap">
                <?php $switchStatus = array_sum($vars['conditions']) == 9 ? 'Closed' : 'Opened'; ?>
                <div
                        class="openedClosedSwitch switch<?= $switchStatus; ?>"
                        id="vacationModeToggle"><?= sprintf(T("Options", "x/9 conditions met"),
                        array_sum($vars['conditions'])); ?></div>
                <div class="clear"></div>
            </div>
            <div id="vacationModeConditions"
                 class="<?= $switchStatus == 'Closed' ? 'hide' : ''; ?>">
                <ul>
                    <li<?= !$vars['conditions'][1] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "There are no outgoing troops"); ?></li>
                    <li<?= !$vars['conditions'][2] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "There are no incoming troops"); ?></li>
                    <li<?= !$vars['conditions'][3] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "There are no troops reinforing other players"); ?></li>
                    <li<?= !$vars['conditions'][4] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "No other player reinforces you"); ?></li>
                    <li<?= !$vars['conditions'][5] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "You dont own a Wonder of the World Village"); ?></li>
                    <li<?= !$vars['conditions'][6] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "You dont own an artifact"); ?></li>
                    <li<?= !$vars['conditions'][7] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "You dont have beginners protection left"); ?></li>
                    <li<?= !$vars['conditions'][8] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "There are no troops in your traps"); ?></li>
                    <li<?= !$vars['conditions'][9] ? ' class="alert"' : ''; ?>><?= T("Options",
                            "Your account is not in deletion"); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php $remainingVacationDays = Formulas::maxVacationDays() - Session::getInstance()->getUsedVacationDays(); ?>
    <?php $canGoOnVacation = $remainingVacationDays > 0 && array_sum($vars['conditions']) == 9; ?>
    <div class="vacationMode">
        <div><?= T("Options", "How many days should the vacation mode last"); ?>
            :
        </div>
        <div class="daySetter">
			<span class="daySetter sub" id="daySetterSub"><a
                        href="#"></a></span>
            <input type="text" size="2" name="days"
                   id="dayInput" <?= $canGoOnVacation ? '' : 'disabled="disabled"'; ?>
                   value="<?= $remainingVacationDays; ?>"/>
            <span class="daySetter add" id="daySetterAdd"><a
                        href="#"></a></span>
        </div>
        <div
                id="vacationTimeWrapper"><?= T("Options", "Vacation til"); ?>
            &nbsp;<span id="vacationTime"></span>
        </div>
        <div><?= sprintf(T("Options", "Available Days x/y"),
                $remainingVacationDays,
                Formulas::maxVacationDays()); ?></div>
        <div class="submitButtonContainer">
            <button type="submit" value="<?= T("Options", "enter vacation mode now"); ?>"
                    id="vacationModeStart"
                    class="green <?= !$canGoOnVacation ? 'disabled' : ''; ?>"
                    title="<?= T("Options", "enter vacation mode now"); ?>"
                    onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}"
                    onClick="Travian.Game.Vacation.openConfirmation()"
                    onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;"
                    value="<?= T("Options", "enter vacation mode now"); ?>">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div
                            class="button-content"><?= T("Options", "enter vacation mode now"); ?></div>
                </div>
            </button>
            <script type="text/javascript">
                jQuery(function () {
                    jQuery('#vacationModeStart').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Options", "enter vacation mode now");?>",
                            "name": "",
                            "id": "vacationModeStart",
                            "class": "green <?=!$canGoOnVacation ? 'disabled' : '';?>",
                            "title": "<?=T("Options", "enter vacation mode now");?>"
                        }]);
                    });
                });
            </script>
        </div>
    </div>
</form>
<script type="text/javascript">
    jQuery(function () {
        var dayInput = jQuery('#dayInput'),
            days = dayInput.val(),
            tOffset = 16200;
        Travian.Game.Vacation.updateVacationTime(days, tOffset);
        if (days > 0) {
            jQuery('#vacationTimeWrapper').show();
        }

        var toggle = jQuery('#vacationModeToggle');
        if (toggle.length > 0) {
            toggle.on('click', function(e) {
                Travian.toggleSwitch(jQuery('#vacationModeConditions'), jQuery('#vacationModeToggle'));
            });
        }

        var setterSub = jQuery('#daySetterSub');
        if (setterSub.length > 0) {
            setterSub.on('click', function(e) {
                e.preventDefault();
                days = parseInt(dayInput.val());
                if(days > 1 ){
                    dayInput.val(--days);
                    Travian.Game.Vacation.updateVacationTime(days, tOffset);
                }
            });
        }

        var setterAdd = jQuery('#daySetterAdd');
        if (setterAdd.length > 0) {
            setterAdd.on('click', function(e) {
                e.preventDefault();
                days = parseInt(dayInput.val());
                if(days < <?=$remainingVacationDays;?>){
                    dayInput.val(++days);
                    Travian.Game.Vacation.updateVacationTime(days, tOffset);
                }
            });
        }

        if (dayInput.length > 0) {
            dayInput.on('change', function(e){
                if (isNaN(parseInt(dayInput.val()))) {
                    dayInput.val(<?=$remainingVacationDays;?>);
                } else if(dayInput.val() > <?=$remainingVacationDays;?>) {
                    dayInput.val(<?=$remainingVacationDays;?>);
                } else if(dayInput.val() < 1){
                    dayInput.val(1);
                }

                var days = dayInput.val();
                Travian.Game.Vacation.updateVacationTime(days, tOffset);

            });
            dayInput.on('keyup', function (e) {
                if (e.key === "enter") {
                    this.blur();
                } else {
                    days = dayInput.val();
                    if (days.length > 0) {
                        days = parseInt(days);
                        if (!isNaN(days) || days.length === 0) {
                            if (days < 1) {
                                days = 1;
                            }
                            if (days > <?=$remainingVacationDays;?>) {
                                days = <?=$remainingVacationDays;?>;
                            }

                            dayInput.val(days);
                            Travian.Game.Vacation.updateVacationTime(days, tOffset);
                        } else {
                            dayInput.val(1);
                            Travian.Game.Vacation.updateVacationTime(1, tOffset);
                        }
                    }
                }
            })
        }
    });

</script>