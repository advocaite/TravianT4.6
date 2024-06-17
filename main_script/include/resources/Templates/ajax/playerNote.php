<div id="playerNotePopup">
    <span class="error" id="playerNotePopupError"></span>
    <form method="post" action="" id="playerNoteForm">
        <label for="playerNoteText"><?=T("Profile", "NoteDescription");?></label>
        <p></p>
        <textarea id="playerNoteText" maxlength="500" name="playerNoteText" cols="60" rows="8"><?=$vars['note'];?></textarea>
        <div class="buttonWrapper buttons">
            <button type="submit" value="<?=T("Global", "General.save");?>" id="<?=($button_id = get_button_id());?>" class="green " title="<?=T("Global", "General.save");?>">
                <div class="button-container addHoverClick">
                    <div class="button-background">
                        <div class="buttonStart">
                            <div class="buttonEnd">
                                <div class="buttonMiddle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button-content"><?=T("Global", "General.save");?></div>
                </div>
            </button>
            <script type="text/javascript" id="<?=$button_id;?>_script">
                jQuery(function() {
                        jQuery('#<?=$button_id;?>').click(function() {
                            jQuery(window).trigger('buttonClicked', [this, {
                                "type": "submit",
                                "value": "<?=T("Global", "General.save");?>",
                                "name": "",
                                "id": "<?=$button_id;?>",
                                "class": "green ",
                                "title": "<?=T("Global", "General.save");?>",
                                "confirm": "",
                                "onclick": ""
                            }]);
                        });
                });
            </script>
        </div>
    </form>
</div>