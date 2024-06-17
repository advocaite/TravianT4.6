<?= sprintf(T("inGame", "Are you sure you want to convert x gold to y silver?"),
    $vars['goldAmount'],
    $vars['silverAmount']); ?>
<div class="buttons">
    <button type="button" value="<?= T("inGame", "Exchange"); ?>"
            id="<?= $button_id = get_button_id(); ?>" class="gold "
            title="<?= sprintf(T("inGame", "Are you sure you want to convert x gold to y silver?"),
                $vars['goldAmount'],
                $vars['silverAmount']); ?>"
            coins="<?= $vars['goldAmount']; ?>">
        <div class="button-container addHoverClick">
            <div class="button-background">
                <div class="buttonStart">
                    <div class="buttonEnd">
                        <div class="buttonMiddle"></div>
                    </div>
                </div>
            </div>
            <div class="button-content"><?= T("inGame", "Exchange"); ?>
                <img src="img/x.gif" class="goldIcon"
                     alt=""/><span
                        class="goldValue"><?= $vars['goldAmount']; ?></span>
            </div>
        </div>
    </button>
    <script type="text/javascript">
        jQuery(function () {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('buttonClicked', [this, {
                    "type": "button",
                    "value": "<?=T("inGame", "Exchange");?>",
                    "name": "",
                    "id": "<?=$button_id;?>",
                    "class": "gold ",
                    "title": "<?=sprintf(T("inGame", "Are you sure you want to convert x gold to y silver?"),
                        $vars['goldAmount'],
                        $vars['silverAmount']);?>",
                    "confirm": "",
                    "onclick": "",
                    "coins": 1,
                    "wayOfPayment": {
                        "featureKey": "exchangeSilver",
                        "dataCallback": "getExchangeCoins"
                    }
                }]);
            });
        });
    </script>
</div>