<form method="post" action="messages.php">
    <div class="paper notices">
        <div class="layout">
            <div class="paperTop">
                <div class="paperContent">
                    <input type="hidden" name="t" value="4">
                    <input type="hidden" name="speichern" value="1">

                    <div id="bbEditor">
                        <div id="notepad_container" class="bbEditor">
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
                                    <div id="notepad_toolbar" class="bbToolbar">
                                        <button type="button" class="icon bbButton bbBold bbType{d} bbTag{b}"
                                                title="bold"><img src="img/x.gif" class="bbBold" alt="bbBold"/></button>
                                        <button type="button" class="icon bbButton bbItalic bbType{d} bbTag{i}"
                                                title="italic"><img src="img/x.gif" class="bbItalic" alt="bbItalic"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbUnderscore bbType{d} bbTag{u}"
                                                title="underline"><img src="img/x.gif" class="bbUnderscore"
                                                                       alt="bbUnderscore"/></button>
                                        <button type="button" class="icon bbButton bbAlliance bbType{d} bbTag{alliance}"
                                                title="alliance"><img src="img/x.gif" class="bbAlliance"
                                                                      alt="bbAlliance"/></button>
                                        <button type="button" class="icon bbButton bbPlayer bbType{d} bbTag{player}"
                                                title="player"><img src="img/x.gif" class="bbPlayer" alt="bbPlayer"/>
                                        </button>
                                        <button type="button" class="icon bbButton bbCoordinate bbType{d} bbTag{x|y}"
                                                title="coordinates"><img src="img/x.gif" class="bbCoordinate"
                                                                         alt="bbCoordinate"/></button>
                                        <button type="button" class="icon bbButton bbReport bbType{d} bbTag{report}"
                                                title="report"><img src="img/x.gif" class="bbReport" alt="bbReport"/>
                                        </button>
                                        <button type="button" id="notepad_resourceButton"
                                                class="icon bbWin{resources} bbButton bbResource" title="resources"><img
                                                    src="img/x.gif" class="bbResource" alt="bbResource"/></button>
                                        <button type="button" id="notepad_smilieButton"
                                                class="icon bbWin{smilies} bbButton bbSmilies" title="smilies"><img
                                                    src="img/x.gif" class="bbSmilies" alt="bbSmilies"/></button>
                                        <button type="button" id="notepad_troopButton"
                                                class="icon bbWin{troops} bbButton bbTroops" title="troops"><img
                                                    src="img/x.gif" class="bbTroops" alt="bbTroops"/></button>
                                        <button type="button" id="notepad_previewButton" class="icon bbButton bbPreview"
                                                title="preview"><img src="img/x.gif" class="bbPreview" alt="bbPreview"/>
                                        </button>
                                        <div class="clear"></div>
                                        <div id="notepad_toolbarWindows" class="bbToolbarWindow">
                                            <div id="notepad_resources">
                                                <a href="#" class="bbType{o} bbTag{l}">
                                                    <img src="img/x.gif" class="r1"
                                                         title="<?=T("inGame", "resources.r1");?>"
                                                         alt="<?=T("inGame", "resources.r1");?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{cl}">
                                                    <img src="img/x.gif" class="r2"
                                                         title="<?=T("inGame", "resources.r2");?>"
                                                         alt="<?=T("inGame", "resources.r2");?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{c}">
                                                    <img src="img/x.gif" class="r4"
                                                         title="<?=T("inGame", "resources.r3");?>"
                                                         alt="<?=T("inGame", "resources.r3");?>"/>
                                                </a>
                                                <a href="#" class="bbType{o} bbTag{ir}">
                                                    <img src="img/x.gif" class="r3"
                                                         title="<?=T("inGame", "resources.r4");?>"
                                                         alt="<?=T("inGame", "resources.r4");?>"/>
                                                </a>
                                            </div>
                                            <div id="notepad_smilies"><a href="#" class="bbType{s} bbTag{*aha*}"><img
                                                            class="smiley aha" src="img/x.gif" alt="*aha*"
                                                            title="*aha*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*angry*}"><img
                                                            class="smiley angry" src="img/x.gif" alt="*angry*"
                                                            title="*angry*"/></a><a href="#"
                                                                                    class="bbType{s} bbTag{*cool*}"><img
                                                            class="smiley cool" src="img/x.gif" alt="*cool*"
                                                            title="*cool*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*cry*}"><img
                                                            class="smiley cry" src="img/x.gif" alt="*cry*"
                                                            title="*cry*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*cute*}"><img
                                                            class="smiley cute" src="img/x.gif" alt="*cute*"
                                                            title="*cute*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*depressed*}"><img
                                                            class="smiley depressed" src="img/x.gif" alt="*depressed*"
                                                            title="*depressed*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{*eek*}"><img
                                                            class="smiley eek" src="img/x.gif" alt="*eek*"
                                                            title="*eek*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*ehem*}"><img
                                                            class="smiley ehem" src="img/x.gif" alt="*ehem*"
                                                            title="*ehem*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*emotional*}"><img
                                                            class="smiley emotional" src="img/x.gif" alt="*emotional*"
                                                            title="*emotional*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{:D}"><img
                                                            class="smiley grin" src="img/x.gif" alt=":D"
                                                            title=":D"/></a><a href="#" class="bbType{s} bbTag{:)}"><img
                                                            class="smiley happy" src="img/x.gif" alt=":)"
                                                            title=":)"/></a><a href="#"
                                                                               class="bbType{s} bbTag{*hit*}"><img
                                                            class="smiley hit" src="img/x.gif" alt="*hit*"
                                                            title="*hit*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*hmm*}"><img
                                                            class="smiley hmm" src="img/x.gif" alt="*hmm*"
                                                            title="*hmm*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*hmpf*}"><img
                                                            class="smiley hmpf" src="img/x.gif" alt="*hmpf*"
                                                            title="*hmpf*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*hrhr*}"><img
                                                            class="smiley hrhr" src="img/x.gif" alt="*hrhr*"
                                                            title="*hrhr*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*huh*}"><img
                                                            class="smiley huh" src="img/x.gif" alt="*huh*"
                                                            title="*huh*"/></a><a href="#"
                                                                                  class="bbType{s} bbTag{*lazy*}"><img
                                                            class="smiley lazy" src="img/x.gif" alt="*lazy*"
                                                            title="*lazy*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*love*}"><img
                                                            class="smiley love" src="img/x.gif" alt="*love*"
                                                            title="*love*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*nocomment*}"><img
                                                            class="smiley nocomment" src="img/x.gif" alt="*nocomment*"
                                                            title="*nocomment*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{*noemotion*}"><img
                                                            class="smiley noemotion" src="img/x.gif" alt="*noemotion*"
                                                            title="*noemotion*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{*notamused*}"><img
                                                            class="smiley notamused" src="img/x.gif" alt="*notamused*"
                                                            title="*notamused*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{*pout*}"><img
                                                            class="smiley pout" src="img/x.gif" alt="*pout*"
                                                            title="*pout*"/></a><a href="#"
                                                                                   class="bbType{s} bbTag{*redface*}"><img
                                                            class="smiley redface" src="img/x.gif" alt="*redface*"
                                                            title="*redface*"/></a><a href="#"
                                                                                      class="bbType{s} bbTag{*rolleyes*}"><img
                                                            class="smiley rolleyes" src="img/x.gif" alt="*rolleyes*"
                                                            title="*rolleyes*"/></a><a href="#"
                                                                                       class="bbType{s} bbTag{:(}"><img
                                                            class="smiley sad" src="img/x.gif" alt=":(" title=":("/></a><a
                                                        href="#" class="bbType{s} bbTag{*shy*}"><img class="smiley shy"
                                                                                                     src="img/x.gif"
                                                                                                     alt="*shy*"
                                                                                                     title="*shy*"/></a><a
                                                        href="#" class="bbType{s} bbTag{*smile*}"><img
                                                            class="smiley smile" src="img/x.gif" alt="*smile*"
                                                            title="*smile*"/></a><a href="#"
                                                                                    class="bbType{s} bbTag{*tongue*}"><img
                                                            class="smiley tongue" src="img/x.gif" alt="*tongue*"
                                                            title="*tongue*"/></a><a href="#"
                                                                                     class="bbType{s} bbTag{*veryangry*}"><img
                                                            class="smiley veryangry" src="img/x.gif" alt="*veryangry*"
                                                            title="*veryangry*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{*veryhappy*}"><img
                                                            class="smiley veryhappy" src="img/x.gif" alt="*veryhappy*"
                                                            title="*veryhappy*"/></a><a href="#"
                                                                                        class="bbType{s} bbTag{;)}"><img
                                                            class="smiley wink" src="img/x.gif" alt=";)"
                                                            title=";)"/></a></div>
                                            <div id="notepad_troops">
                                                <?php for($i = 1; $i <= 50; ++$i):?>
                                                    <a href="#" class="bbType{o} bbTag{tid<?=$i;?>}">
                                                        <img class="unit u<?=$i;?>" src="img/x.gif"
                                                             title="<?=T("Troops", $i . ".title");?>"
                                                             alt="<?=T("Troops", $i . ".title");?>"/>
                                                    </a>
                                                <?php endfor;?>
                                                <a href="#" class="bbType{o} bbTag{hero}">
                                                    <img class="unit uhero" src="img/x.gif"
                                                         title="<?=T("Troops", "98.title");?>"
                                                         alt="<?=T("Troops", "98.title");?>"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line bbLine"></div>
                            <textarea name="notepad" id="notepad" class="messageEditor" rows=""
                                      cols=""><?=$vars['note'];?></textarea>

                            <div id="notepad_preview" class="messageEditor hide"></div>
                        </div>
                        <script type="text/javascript">
                            jQuery(function() {
                                new Travian.Game.BBEditor("notepad", <?=empty($vars['note']) ? 'false' : 'true';?>);
                            });
                        </script>
                    </div>
                    <div class="btn" id="send">
                        <button type="submit" value="save" name="s1" id="s1" class="green ">
                            <div class="button-container addHoverClick">
                                <div class="button-background">
                                    <div class="buttonStart">
                                        <div class="buttonEnd">
                                            <div class="buttonMiddle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-content"><?=T("Global", "General.ok");?></div>
                            </div>
                        </button>
                        <script type="text/javascript">
                            jQuery(function() {
                                if (jQuery('#s1')) {
                                    jQuery('#s1').click(function (event) {
                                        jQuery(window).trigger('buttonClicked', [this, {
                                            "type": "submit",
                                            "value": "save",
                                            "name": "s1",
                                            "id": "s1",
                                            "class": "green ",
                                            "title": "",
                                            "confirm": "",
                                            "onclick": ""
                                        }]);
                                    });
                                }
                            });
                        </script>
                    </div>
                    <div class="notepad info"><?=$vars['info'];?></div>
                </div>
            </div>
            <div class="paperBottom"></div>
        </div>
    </div>
</form>
<script type="text/javascript">
    jQuery(function() {

        Travian.Translation.add({
            'nachrichten.notice_too_long': '<?=T("Messages", "Your note is too long!");?>'
        });

        var notice = new Travian.Game.Notice('10000', jQuery('#notepad'));
    });

</script>