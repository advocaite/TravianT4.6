<button type="submit" value="<?= T("MarketPlace", "prepare"); ?>"
        id="enabledButton"
        class="green prepare"
        onclick="if(jQuery(this).hasClass('disabled')){event.stopPropagation(); return false;} else {}"
        tabindex="10"
        onfocus="jQuery('button', 'input[type!=hidden]', 'select').focus(); event.stopPropagation(); return false;">
    <div class="button-container addHoverClick">
        <div class="button-background">
            <div class="buttonStart">
                <div class="buttonEnd">
                    <div class="buttonMiddle"></div>
                </div>
            </div>
        </div>
        <div class="button-content"><?= T("MarketPlace", "prepare"); ?></div>
    </div>
</button>
<script type="text/javascript">
    jQuery(function () {
        jQuery('#enabledButton').click(function (event) {
            jQuery(window).trigger('buttonClicked', [this, {
                "type": "submit",
                "value": "<?=T("MarketPlace", "prepare");?>",
                "name": "",
                "id": "enabledButton",
                "class": "green prepare",
                "title": "",
                "confirm": "",
                "onclick": "if($(this).hasClass(\u0027disabled\u0027)){(new DOMEvent(event)).stop(); return false;} else {}",
                "tabindex": 10,
                "onfocus": "jQuery(\u0027button\u0027, \u0027input[type!=hidden]\u0027, \u0027select\u0027).set(\u0027focus\u0027, true); (new DOMEvent(event)).stop(); return false;"
            }]);
        });
    });
</script>