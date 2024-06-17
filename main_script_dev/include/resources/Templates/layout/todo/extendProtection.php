<br/>
<button type="button" value="<?= T("inGame", "extend"); ?>"
        id="<?= $button_id = get_button_id(); ?>"
        class="green " onclick="return (function() {
        (new Travian.Dialog.Dialog({
        preventFormSubmit: true,
        onOkay: function(dialog, contentElement) {window.location.href = '/options.php?cmd=extendBeginnersProtection'}}))
        .setContent('<?= T("inGame",
    "You cannot send resources to other players, attack them or be attacked by them while in beginners protection"); ?><br><?= T("inGame",
    "Are you sure you want to extend your beginners protection?"); ?>')
        .show();
        return false;
        })()">
    <div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content"><?= T("inGame", "extend"); ?></div>
    </div>
</button>
<script type="text/javascript">
    jQuery(function () {
        jQuery('#<?=$button_id;?>').click(function (event) {
            jQuery(window).trigger('buttonClicked', [this, {
                "type": "button",
                "value": "<?=T("inGame", "extend");?>",
                "name": "",
                "id": "<?=$button_id;?>",
                "class": "green ",
                "title": ""
            }]);
        });
    });
</script>