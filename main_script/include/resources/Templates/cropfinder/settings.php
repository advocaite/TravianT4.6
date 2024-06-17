<form method="post" action="cropfinder.php">
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
            <table class="transparent">
                <tbody>
                <tr>
                    <td>
                        <span class="coordInputLabel"><?= T("cropFinder", "Start position:"); ?></span>

                        <div class="coordinatesInput">
                            <div class="xCoord">
                                <label for="xCoordInput">X:</label>
                                <input maxlength="4" value="<?= $vars['x']; ?>" name="x" id="xCoordInput"
                                       class="text coordinates x "/>
                            </div>
                            <div class="yCoord">
                                <label for="yCoordInput">Y:</label>
                                <input maxlength="4" value="<?= $vars['y']; ?>" name="y" id="yCoordInput"
                                       class="text coordinates y "/>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <span class="clear"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= T("cropFinder", "Type"); ?>: <span class="type">
						<input type="radio" class="radio" name="typ"
                               value="15"<?= $vars['typ'] == "15" ? ' checked="checked"' : ''; ?> />15 <?= T("cropFinder",
                                "cropper"); ?>					</span>
                        <span class="type">
		    			<input type="radio" class="radio" name="typ"
                               value="9"<?= $vars['typ'] == "9" ? ' checked="checked"' : ''; ?> />9 <?= T("cropFinder",
                                "cropper"); ?>		    		</span>
                        <span class="type">
		    			<input type="radio" class="radio" name="typ"
                               value="all"<?= $vars['typ'] == "all" ? ' checked="checked"' : ''; ?>/><?= T("cropFinder",
                                "both"); ?>		    		</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= T("cropFinder", "Oasis crop bonus (at least)"); ?>:
                        <select class="dropdown" name="bonus_getreide">
                            <option value="all" <?= $vars['bonus_getreide'] == "all" ? 'selected' : ''; ?>><?= T("cropFinder",
                                    "any"); ?></option>
                            <option value="25" <?= $vars['bonus_getreide'] == "25" ? 'selected' : ''; ?>>+25%</option>
                            <option value="50" <?= $vars['bonus_getreide'] == "50" ? 'selected' : ''; ?>>+50%</option>
                            <option value="75" <?= $vars['bonus_getreide'] == "75" ? 'selected' : ''; ?>>+75%</option>
                            <option value="100" <?= $vars['bonus_getreide'] == "100" ? 'selected' : ''; ?>>+100%
                            </option>
                            <option value="125" <?= $vars['bonus_getreide'] == "125" ? 'selected' : ''; ?>>+125%
                            </option>
                            <option value="150" <?= $vars['bonus_getreide'] == "150" ? 'selected' : ''; ?>>+150%
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="only_free" name="only_free"
                               value="1" <?= $vars['only_free'] ? 'checked="checked"' : ''; ?>
                               class="check"/>
                        <?= T("cropFinder", "only show unoccupied"); ?>                </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button type="submit" value="search" name="suchen" id="suchen" class="green ">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?= T("cropFinder", "search"); ?></div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function () {
            if (jQuery('#suchen').length > 0) {
                jQuery('#suchen').click(function (event) {
                    jQuery(window).trigger('buttonClicked', [this, {
                        "type": "submit",
                        "value": "<?=T("cropFinder", "search");?>",
                        "name": "suchen",
                        "id": "suchen",
                        "class": "green ",
                        "title": "",
                        "confirm": "",
                        "onclick": ""
                    }]);
                });
            }
        });
    </script>
    <div class="spacer"></div>
</form>