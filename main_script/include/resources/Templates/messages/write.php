<?php if (isset($vars['error']) and $vars['error']): ?>
    <p class="error"><?= $vars['error']; ?></p>
<?php endif; ?>
<div id="messageNavigation">
    <div id="backToInbox">
        <a href="messages.php"><?= T("Messages", "back to the inbox"); ?></a>
    </div>
    <div class="clear"></div>
</div>
<form method="post" action="messages.php?t=1">
    <div class="paper">
        <div class="layout">
            <div class="paperTop">
                <div class="paperContent">

                    <div id="recipient">
                        <div class="header label">
                            <?= T("Messages", "Recipient"); ?>:
                        </div>
                        <div class="header text">
                            <input tabindex="1" id="receiver" class="text" type="text" name="an" maxlength="50"
                                   value="<?= $vars['receiver']; ?>"/>
                            <button type="button" id="adbook" class="icon " title="<?= T("Messages", "Addressbook"); ?>"
                                    onclick="Travian.Game.Messages.showAddressBook('adressbook');" tabindex="5">
                                <img src="img/x.gif" class="adbook" alt="adbook"/></button>
                            <button type="button" id="ally" class="icon " title="Alliance" tabindex="6" onclick="Travian.Game.Messages.addRecipient('[ally]')">
                                <img
                                        src="img/x.gif" class="ally" alt="ally"/></button>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div id="subject">
                        <div class="header label">
                            <?= T("Messages", "Subject"); ?>:
                        </div>
                        <div class="header text">
                            <input tabindex="2" class="text" type="text" name="be" value="<?= $vars['subject']; ?>"/>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div id="bbEditor">

                        <div id="message_container" class="bbEditor">
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
                                    <div id="message_toolbar" class="bbToolbar">
                                        <button type="button" class="icon bbButton bbBold bbType{d} bbTag{b}"
                                                title="bold">
                                            <img src="img/x.gif" class="bbBold" alt="bbBold"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbItalic bbType{d} bbTag{i}"
                                                title="italic">
                                            <img src="img/x.gif" class="bbItalic" alt="bbItalic"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbUnderscore bbType{d} bbTag{u}"
                                                title="underline">
                                            <img src="img/x.gif" class="bbUnderscore" alt="bbUnderscore"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbAlliance bbType{d} bbTag{alliance}"
                                                title="<?= T("Messages", "Alliance"); ?>">
                                            <img src="img/x.gif" class="bbAlliance" alt="bbAlliance"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbPlayer bbType{d} bbTag{player}"
                                                title="<?= T("Messages", "Player"); ?>">
                                            <img src="img/x.gif" class="bbPlayer" alt="bbPlayer"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbCoordinate bbType{d} bbTag{x|y}"
                                                title="<?= T("Messages", "Coordinates"); ?>">
                                            <img src="img/x.gif" class="bbCoordinate" alt="bbCoordinate"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbReport bbType{d} bbTag{report}"
                                                title="<?= T("Messages", "report"); ?>">
                                            <img src="img/x.gif" class="bbReport" alt="bbReport"/>
                                        </button>
                                        <button type="button" id="message_resourceButton"
                                                class="icon bbWin{resources} bbButton bbResource"
                                                title="<?= T("inGame", "resources.resources"); ?>">
                                            <img src="img/x.gif" class="bbResource" alt="bbResource"/>
                                        </button>
                                        <button type="button" id="message_smilieButton"
                                                class="icon bbWin{smilies} bbButton bbSmilies" title="smilies">
                                            <img src="img/x.gif" class="bbSmilies" alt="bbSmilies"/>
                                        </button>
                                        <button type="button" id="message_troopButton"
                                                class="icon bbWin{troops} bbButton bbTroops"
                                                title="<?= T("Messages", "Troops"); ?>">
                                            <img src="img/x.gif" class="bbTroops" alt="bbTroops"/>
                                        </button>
                                        <button type="button" id="message_previewButton" class="icon bbButton bbPreview"
                                                title="<?= T("Messages", "preview"); ?>">
                                            <img src="img/x.gif" class="bbPreview" alt="bbPreview"/>
                                        </button>
                                        <div class="clear"></div>
                                        <div id="message_toolbarWindows" class="bbToolbarWindow">
                                            <div id="message_resources">
                                                <a href="#" class="bbType{o} bbTag{l}">
                                                    <img src="img/x.gif" class="r1"
                                                         title="<?= T("inGame", "resources.r1"); ?>"
                                                         alt="<?= T("inGame", "resources.r1"); ?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{cl}">
                                                    <img src="img/x.gif" class="r2"
                                                         title="<?= T("inGame", "resources.r2"); ?>"
                                                         alt="<?= T("inGame", "resources.r2"); ?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{c}">
                                                    <img src="img/x.gif" class="r4"
                                                         title="<?= T("inGame", "resources.r3"); ?>"
                                                         alt="<?= T("inGame", "resources.r3"); ?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{ir}">
                                                    <img src="img/x.gif" class="r3"
                                                         title="<?= T("inGame", "resources.r4"); ?>"
                                                         alt="<?= T("inGame", "resources.r4"); ?>"/>
                                                </a>
                                            </div>
                                            <div id="message_smilies">
                                                <a href="#" class="bbType{s} bbTag{*aha*}">
                                                    <img class="smiley aha" src="img/x.gif" alt="*aha*" title="*aha*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*angry*}">
                                                    <img class="smiley angry" src="img/x.gif" alt="*angry*"
                                                         title="*angry*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cool*}">
                                                    <img class="smiley cool" src="img/x.gif" alt="*cool*"
                                                         title="*cool*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cry*}">
                                                    <img class="smiley cry" src="img/x.gif" alt="*cry*" title="*cry*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*cute*}">
                                                    <img class="smiley cute" src="img/x.gif" alt="*cute*"
                                                         title="*cute*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*depressed*}">
                                                    <img class="smiley depressed" src="img/x.gif" alt="*depressed*"
                                                         title="*depressed*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*eek*}">
                                                    <img class="smiley eek" src="img/x.gif" alt="*eek*" title="*eek*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*ehem*}">
                                                    <img class="smiley ehem" src="img/x.gif" alt="*ehem*"
                                                         title="*ehem*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*emotional*}">
                                                    <img class="smiley emotional" src="img/x.gif" alt="*emotional*"
                                                         title="*emotional*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:D}">
                                                    <img class="smiley grin" src="img/x.gif" alt=":D" title=":D"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:)}">
                                                    <img class="smiley happy" src="img/x.gif" alt=":)" title=":)"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hit*}">
                                                    <img class="smiley hit" src="img/x.gif" alt="*hit*" title="*hit*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hmm*}">
                                                    <img class="smiley hmm" src="img/x.gif" alt="*hmm*" title="*hmm*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hmpf*}">
                                                    <img class="smiley hmpf" src="img/x.gif" alt="*hmpf*"
                                                         title="*hmpf*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*hrhr*}">
                                                    <img class="smiley hrhr" src="img/x.gif" alt="*hrhr*"
                                                         title="*hrhr*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*huh*}">
                                                    <img class="smiley huh" src="img/x.gif" alt="*huh*" title="*huh*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*lazy*}">
                                                    <img class="smiley lazy" src="img/x.gif" alt="*lazy*"
                                                         title="*lazy*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*love*}">
                                                    <img class="smiley love" src="img/x.gif" alt="*love*"
                                                         title="*love*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*nocomment*}">
                                                    <img class="smiley nocomment" src="img/x.gif" alt="*nocomment*"
                                                         title="*nocomment*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*noemotion*}">
                                                    <img class="smiley noemotion" src="img/x.gif" alt="*noemotion*"
                                                         title="*noemotion*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*notamused*}">
                                                    <img class="smiley notamused" src="img/x.gif" alt="*notamused*"
                                                         title="*notamused*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*pout*}">
                                                    <img class="smiley pout" src="img/x.gif" alt="*pout*"
                                                         title="*pout*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*redface*}">
                                                    <img class="smiley redface" src="img/x.gif" alt="*redface*"
                                                         title="*redface*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*rolleyes*}">
                                                    <img class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*"
                                                         title="*rolleyes*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{:(}">
                                                    <img class="smiley sad" src="img/x.gif" alt=":(" title=":("/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*shy*}">
                                                    <img class="smiley shy" src="img/x.gif" alt="*shy*" title="*shy*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*smile*}">
                                                    <img class="smiley smile" src="img/x.gif" alt="*smile*"
                                                         title="*smile*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*tongue*}">
                                                    <img class="smiley tongue" src="img/x.gif" alt="*tongue*"
                                                         title="*tongue*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*veryangry*}">
                                                    <img class="smiley veryangry" src="img/x.gif" alt="*veryangry*"
                                                         title="*veryangry*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{*veryhappy*}">
                                                    <img class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*"
                                                         title="*veryhappy*"/>
                                                </a>
                                                <a href="#" class="bbType{s} bbTag{;)}">
                                                    <img class="smiley wink" src="img/x.gif" alt=";)" title=";)"/>
                                                </a>
                                            </div>
                                            <div id="message_troops">
                                                <?php for ($i = 1; $i <= 50; ++$i): ?>
                                                    <a href="#" class="bbType{o} bbTag{tid<?= $i; ?>}">
                                                        <img class="unit u<?= $i; ?>" src="img/x.gif"
                                                             title="<?= T("Troops", $i . ".title"); ?>"
                                                             alt="<?= T("Troops", $i . ".title"); ?>"/>
                                                    </a>
                                                <?php endfor; ?>
                                                <a href="#" class="bbType{o} bbTag{hero}">
                                                    <img class="unit uhero" src="img/x.gif"
                                                         title="<?= T("Troops", "98.title"); ?>"
                                                         alt="<?= T("Troops", "98.title"); ?>"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line bbLine"></div>
                            <textarea id="message" name="message" class="messageEditor" tabindex="3" cols="1"
                                      rows="1"><?= $vars['message']; ?></textarea>

                            <div id="message_preview" class="messageEditor"></div>
                        </div>

                        <script type="text/javascript">
                            jQuery(function()
                            {
                                new Travian.Game.BBEditor("message", false);
                            });
                        </script>
                    </div>

                    <div id="send">
                        <script type="text/javascript">
                            MessageSendButtonDoubleClickPreventer = new Travian.DoubleClickPreventer();
                            MessageSendButtonDoubleClickPreventer.timeout = 2000;
                        </script>
                        <button type="submit" value="send" name="s1" id="s1" class="green " tabindex="4" onclick="return MessageSendButtonDoubleClickPreventer.check();">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?= T("Messages", "send"); ?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                            jQuery(function () {
                                if (jQuery('#s1')) {
                                    jQuery('#s1').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "submit",
                                            "value": "send",
                                            "name": "s1",
                                            "id": "s1",
                                            "class": "green ",
                                            "title": "",
                                            "confirm": "",
                                            "onclick": "",
                                            "tabindex": "4"
                                        }]);
                                    });
                                }
                            });
                        </script>
                        <input type="hidden" name="c" value="<?= $vars['checker']; ?>"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="paperBottom"></div>
        </div>
    </div>
</form>

<div class="hide" id="adressbook">
    <input type="hidden" name="a" value="<?= $vars['checker']; ?>"/>
    <input type="hidden" name="t" value="1"/>
    <input type="hidden" name="sbmtype" value="default"/>
    <input type="hidden" name="sbmvalue" value=""/>

    <div class="friendListContainer">
        <table cellpadding="1" cellspacing="1" class="friendlist friendlist1">
            <tbody>

            <tr>
                <?= $vars['addressBook'][0]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][2]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][4]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][6]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][8]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][10]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][12]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][14]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][16]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][18]; ?>
            </tr>
            </tbody>
        </table>
        <table cellpadding="1" cellspacing="1" class="friendlist friendlist2">
            <tbody>

            <tr>
                <?= $vars['addressBook'][1]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][3]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][5]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][7]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][9]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][11]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][13]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][15]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][17]; ?>
            </tr>
            <tr>
                <?= $vars['addressBook'][19]; ?>
            </tr>

            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    Travian.Translation.add(
        {
            'nachrichten.adressbuch': '<?=T("Messages", "Addressbook");?>',
            'allgemein.save': '<?=T("Global", "General.save");?>'
        });


    jQuery(function() {
        var form = jQuery('#messageForm');
        form.on('submit', function(e) {
            if (Travian.Game.Messages.recipients_checked) {
                return true;
            }
            e.stopPropagation();
            var recepients = jQuery('#receiver').val().split(';').map(function(entry) {
                return entry.trim()
            });
            Travian.Game.Messages.checkRecipients(recepients, form);
            return false;
        });
        var recieverAutocompleter = new Travian.Game.AutoCompleter.UserName(jQuery('input#receiver'));

        <?php if($vars['showAddressBook']):?>
        Travian.Game.Messages.showAddressBook('adressbook');
        <?php endif;?>
        <?php if(isset($vars['InadmissibleMessage']) and $vars['InadmissibleMessage']):?>
        var dialog = new Travian.Dialog.Dialog(
            {
                buttonTextOk: '<?=T("Global", "General.ok");?>',
                preventFormSubmit: true
            }
        );
        dialog.setContent('<?=T("Messages", "Inadmissible message");?>');
        dialog.show();
        <?php endif;?>
    });
</script>
