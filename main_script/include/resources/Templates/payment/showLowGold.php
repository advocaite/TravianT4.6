<div id="smallestPackageDialog">
    <?php use Core\Helper\WebService;

    echo T("PaymentWizard", "notEnoughGoldForThisOption"); ?>
    <div id="smallestPackageData">
        <div class="package size1 hideForLoading" title="Choose package">
            <input type="hidden" class="goldProductId" value="<?= $vars['goldProductId']; ?>"/>
            <div class="goldProductTextWrapper">
                <div class="goldUnits"><?= $vars['goldNum']; ?></div>
                <div class="goldUnitsTypeText"><?= T("PaymentWizard", "Gold"); ?></div>
                <div class="footerLine"><span class="price"><?= $vars['Price']; ?> <?= $vars['goldProductMoneyUnit']; ?>
                        &nbsp;*</span></div>
            </div>
            <div class="goldProductImageWrapper"><img
                        src="<?= WebService::getPaymentUrl() . 'img/product/' . $vars['goldProductImageName']; ?>"
                        width="100"
                        height="114" alt="<?= $vars['goldProductName']; ?>"/></div>
        </div>
    </div>
    <span
            class="buyGoldQuestion"><?= T("PaymentWizard", "BuyNow"); ?></span>
    <div>
        <button type="submit"
                value="<?= T("PaymentWizard", "Buy gold"); ?>"
                id="<?= $button_id = get_button_id(); ?>" class="green "
                onclick="openPaymentWizard(true); return false;">
            <div class="button-container addHoverClick ">
                <div class="button-background">
                    <div class="buttonStart">
                        <div class="buttonEnd">
                            <div class="buttonMiddle"></div>
                        </div>
                    </div>
                </div>
                <div
                        class="button-content"><?= T("PaymentWizard", "Buy gold"); ?></div>
            </div>
        </button>
        <script type="text/javascript">
            jQuery(function () {
                if (jQuery('#<?=$button_id;?>').length > 0) {
                    jQuery('#<?=$button_id;?>').click(function (event) {
                        jQuery(window).trigger('buttonClicked', [this, {
                            "type": "submit",
                            "value": "Purchase gold",
                            "name": "",
                            "id": "<?=$button_id;?>",
                            "class": "green ",
                            "title": "<?=T("PaymentWizard", "Buy gold");?>",
                            "confirm": "",
                            "onclick": "openPaymentWizard(true); return false;"
                        }]);
                    });
                }
            });
        </script>
    </div>
    <a class="changeGoldPackage arrow" href="#"
       onclick="openPaymentWizard(false); return false;"><?= T("PaymentWizard", "ChooseAnotherPackage"); ?></a>
    <script>
        function openPaymentWizard(withPackage) {
            var options = {callback: 'openPaymentWizardWithProsTab'};
            if (withPackage) {
                options = Object.assign(options, {goldProductId: '<?=$vars['goldProductId'];?>'});
            }
            Travian.Game.WayOfPaymentEventListener.WayOfPaymentObject.openPaymentWizard(options);
        }
    </script>
</div>