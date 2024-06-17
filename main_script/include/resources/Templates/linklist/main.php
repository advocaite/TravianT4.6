<div class="boxes boxesColor gray recommendedLinks">
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
            <div class="openedClosedSwitch switchOpened"
                 id="linkRecommendationsToggle"><?= T("links", "Recommended links"); ?></div>
            <div class="clear"></div>
        </div>
        <div id="linkRecommendations" class="">
            <?= T("links", "These links are found helpful by many players Add them to your personal link list"); ?>
            <table class="transparent" cellpadding="1" cellspacing="1" id="recommendedLinks">
                <tbody>
                <?= $vars['recommend_html']; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<p class="linklistDescription">
    <?= T("links",
        "Define often-used pages as direct links Place a * at the end of the link and it will be opened in a new tab"); ?>
</p>
<form name="linklist" id="settings" action="linklist.php" method="post">
    <input type="hidden" name="s" value="1"/>
    <input type="hidden" name="e" value="1"/>
    <table class="transparent" cellpadding="1" cellspacing="1" id="links">
        <thead>
        <tr>
            <td><?= T("links", "No"); ?>.</td>
            <td><?= T("links", "Link Name"); ?></td>
            <td><?= T("links", "Link Target"); ?></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($vars['links'] as $key => $link): ?>
            <tr>
                <td class="nr">
                    <input class="text" type="text" name="nr<?= $link['id']; ?>" value="<?= $key; ?>" size="1"
                           maxlength="3"/>
                </td>
                <td class="nam">
                    <input class="text" type="text" name="linkname<?= $link['id']; ?>" value="<?= $link['name']; ?>"
                           maxlength="30"/>
                </td>
                <td class="link">
                    <input class="text" type="text" name="linkziel<?= $link['id']; ?>" value="<?= $link['url']; ?>"
                           maxlength="255"/>
                </td>
                <td class="remove">
                    <button type="button" class="removeLine removeElement"
                            onclick="jQuery(this).closest('tr').hide().find('.link input').val('');"
                            title="<?= T("links", "Delete entry"); ?>"></button>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="addLine templateElement insertElement">
            <td class="nr">
                <input class="text" type="text" name="nrNew[]" value="<?= $vars['lastNumber']; ?>" size="1"
                       maxlength="3"/>
            </td>
            <td class="nam">
                <input class="text" type="text" name="linknameNew[]" value="" maxlength="30"/>
            </td>
            <td class="link">
                <input class="text" type="text" name="linkzielNew[]" value="" maxlength="255"/>
            </td>
            <td class="add">
                <button type="button" class="removeLine removeElement hide" title="<?= T("links", "Delete entry"); ?>"
                        onclick="jQuery(this).closest('tr').hide().find('.link input').val('');"></button>
                <button type="button" class="addLine addElement" title="<?= T("links", "add entry"); ?>"></button>
            </td>
        </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        jQuery(function() {
            var lastNumber = <?=$vars['lastNumber'];?>;
            new Travian.Game.AddLine({
                entryCount: 1,
                elements: {
                    table: jQuery('#links')
                },
                onInsertInputBefore: function(_, newInsertElement, newInputElement) {
                    if (newInputElement.name.indexOf('nrNew[]') === 0) {
                        newInputElement.value = ++lastNumber;
                    }
                },
                onInsertAfter:  function(newInsertElement) {
                    var button = newInsertElement.prev('tr').find('button.removeElement').removeClass('hide');
                    button.attr('title', '<?=T("links", "Delete entry");?>');
                    jQuery('#recommendedLinks .nr input').val(lastNumber + 1);

                    // Bind all the events to the new element
                    Travian.addMouseEvents(button, button);
                }
            });
        });
    </script>
    <div id="hiddenRecommendedLinks">
        <input class="textNr" type="text" name="nrNew[]" value="" size="1" maxlength="3"/>
        <input class="textName" type="text" name="linknameNew[]" value="" maxlength="30"/>
        <input class="textTarget" type="text" name="linkzielNew[]" value="" maxlength="255"/>
        <input type="radio" name="usedRecommended" id="usedRecommended" value="yes"/>
    </div>
    <div class="submitButtonContainer">
        <button type="submit" value="<?= T("Global", "General.save"); ?>" name="s1" id="btn_ok" class="green ">
            <div class="button-container addHoverClick">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div class="button-content"><?= T("Global", "General.save"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                if (jQuery('#btn_ok')) {
                    jQuery('#btn_ok').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "<?=T("Global", "General.save");?>",
                            "name": "s1",
                            "id": "btn_ok",
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
    <script type="text/javascript">
        jQuery(function () {

            var linkRecommendationsToggle = jQuery('#linkRecommendationsToggle');
            if (linkRecommendationsToggle !== null) {
                linkRecommendationsToggle.on('click', function () {
                    Travian.toggleSwitch(jQuery('#linkRecommendations'), linkRecommendationsToggle);
                });
            }
        });

        function takeOverRecommendedLink(linkID) {
            if (jQuery('#recommendedLinksRow' + linkID).length > 0) {
                // Write the recommended link data in the hidden input fields

                var linkNumber = jQuery('#recommendedLinksRow' + linkID + ' .nr .text').val();
                var linkName = jQuery('#recommendedLinksRow' + linkID + ' .nam .text').val();
                var linkTarget = jQuery('#recommendedLinksRow' + linkID + ' .link .text').val();

                jQuery('#hiddenRecommendedLinks .textNr').val(linkNumber);
                jQuery('#hiddenRecommendedLinks .textName').val(linkName);
                jQuery('#hiddenRecommendedLinks .textTarget').val(linkTarget);

                // Set the usedRecommended parameter
                jQuery('#usedRecommended').prop('checked', 'checked');

                // Submit the form to save the changes
                jQuery('#settings').submit();
            }
        }
    </script>
</form>
