<?php

use Core\Session;

?>
<div class="contentNavi subNavi ">
    <?php if ($vars['enabled']): ?>
        <div title="" class="container <?= ($vars['selectedTab'] == 0 ? 'active' : 'normal'); ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content">
                <a id="<?= ($button_id = get_button_id()); ?>" href="voucher.php?t=0" class="tabItem">
                    <?= T("PaymentWizard", "Use voucher"); ?>                                                        </a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['selectedTab'] == 0 ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "voucher.php?t=0",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("PaymentWizard", "Use voucher");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);
                });
            }
        </script>
        <div title="" class="container <?= ($vars['selectedTab'] == 2 ? 'active' : 'normal'); ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content">
                <a id="<?= ($button_id = get_button_id()); ?>" href="voucher.php?t=2" class="tabItem">
                    <?= T("PaymentWizard", "Vouchers"); ?>                                                        </a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['selectedTab'] == 2 ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "voucher.php?t=0",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("PaymentWizard", "Vouchers");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>
        <div title="" class="container <?= ($vars['selectedTab'] == 1 ? 'active' : 'normal'); ?>">
            <div class="background-start">&nbsp;</div>
            <div class="background-end">&nbsp;</div>
            <div class="content">

                <a id="<?= ($button_id = get_button_id()); ?>" href="voucher.php?t=1" class="tabItem">
                    <?= T("PaymentWizard", "History"); ?>                                                </a>
            </div>
        </div>
        <script type="text/javascript">
            if (jQuery('#<?=$button_id;?>')) {
                jQuery('#<?=$button_id;?>').click(function (event) {
                    jQuery(window).trigger('tabClicked', [this, {
                        "class": "<?=($vars['selectedTab'] == 1 ? 'active' : 'normal');?>",
                        "title": false,
                        "target": false,
                        "id": "<?=$button_id;?>",
                        "href": "voucher.php?t=1",
                        "onclick": false,
                        "enabled": true,
                        "text": "<?=T("PaymentWizard", "History");?>",
                        "dialog": false,
                        "plusDialog": false,
                        "goldclubDialog": false,
                        "containerId": "",
                        "buttonIdentifier": "<?=$button_id;?>"
                    }]);

                });
            }
        </script>
    <?php endif; ?>
    <div title="" class="container <?= ($vars['selectedTab'] == 3 ? 'active' : 'normal'); ?>">
        <div class="background-start">&nbsp;</div>
        <div class="background-end">&nbsp;</div>
        <div class="content">

            <a id="<?= ($button_id = get_button_id()); ?>" href="voucher.php?t=3" class="tabItem">
                <?= T("TransferGold", "title"); ?></a>
        </div>
    </div>
    <script type="text/javascript">
        if (jQuery('#<?=$button_id;?>')) {
            jQuery('#<?=$button_id;?>').click(function (event) {
                jQuery(window).trigger('tabClicked', [this, {
                    "class": "<?=($vars['selectedTab'] == 3 ? 'active' : 'normal');?>",
                    "title": false,
                    "target": false,
                    "id": "<?=$button_id;?>",
                    "href": "voucher.php?t=1",
                    "onclick": false,
                    "enabled": true,
                    "text": "<?=T("TransferGold", "title");?>",
                    "dialog": false,
                    "plusDialog": false,
                    "goldclubDialog": false,
                    "containerId": "",
                    "buttonIdentifier": "<?=$button_id;?>"
                }]);

            });
        }
    </script>
    <div class="clear"></div>
</div>
<script type="text/javascript">
    function GoldBankUIV1_5() {
        this.getVoucherHTML = function (data) {
            var html =
                '<div id="paymentWizard" style="width: 100%; height: 100%; min-height: 1px;">' +
                '<table id="brought_in" cellpadding="1" cellspacing="1">' +
                '<thead><tr><td colspan="2"><?=T("PaymentWizard", "Voucher details");?></td></tr></thead><tbody>' +
                '<tr><td><?=T("PaymentWizard", "Voucher ID"); ?></td><td>' + data.id + '</td></tr>' +
                '<tr><td><?=T("PaymentWizard", "World ID"); ?></td><td>' + data.worldId + '</td></tr>' +
                '<tr><td><?=T("PaymentWizard", "Voucher code");?></td><td>' + data.voucherCode + '</td></tr>';
            if (typeof(data.email) != "undefined") {
                html = html + '<tr><td><?=T("PaymentWizard", "Email"); ?></td><td>' + data.email + '</td></tr>';
            }
            if (typeof(data.player) != "undefined") {
                html = html + '<tr><td><?=T("PaymentWizard",
                    "Player"); ?></td><td>' + (data.player == null ? '-' : data.player) + '</td></tr>';
            }
            html = html +
                '<tr><td><?=T("PaymentWizard", "Gold"); ?></td><td>' + data.gold + '</td></tr>' +
                '<tr><td><?=T("PaymentWizard", "Reason"); ?></td><td>' + data.reason + '</td></tr>' +
                '<tr><td><?=T("PaymentWizard", "Date"); ?></td><td>' + data.time + '</td></tr>' +
                '</tbody>' +
                '</table>';

            if (typeof(data.usedWorldId) != "undefined") {
                html = html + '<br /><table id="brought_in" cellpadding="1" cellspacing="1">' +
                    '<thead><tr><td colspan="2"><?=T("PaymentWizard", "Use details");?></td></tr></thead>' +
                    '<tbody>' +
                    '<tr><td><?=T("PaymentWizard", "World ID"); ?></td><td>' + data.usedWorldId + '</td></tr>' +
                    '<tr><td><?=T("PaymentWizard", "Email"); ?></td><td>' + data.usedEmail + '</td></tr>' +
                    '<tr><td><?=T("PaymentWizard", "Player"); ?></td><td>' + data.usedPlayer + '</td></tr>' +
                    '<tr><td><?=T("PaymentWizard", "Date"); ?></td><td>' + data.usedTime + '</td></tr>' +
                    '</tbody>' +
                    '</table>';
            }
            html = html + '</div>';
            return html;
        };
        this.useVoucher2 = function (data) {
            var dialog = new Travian.Dialog.Dialog(
                {
                    buttonTextOk: '<?=T("PaymentWizard", "Use");?>',
                    preventFormSubmit: true,
                    onOkay: function (dialog, contentElement) {
                        ('<?=T("PaymentWizard", "Are you sure?");?>').dialog({
                            onOkay: function (dialog, contentElement) {
                                window.location.href = "voucher.php?voucherCode=" + data.voucherCode + "&action=use&c=<?=Session::getInstance()->getChecker();?>";
                            }, onShow: function () {
                                var button = jQuery('#use');
                                button.disabled = true;
                                button.disabled = false;
                            }
                        });
                    }
                }
            );
            dialog.setContent(this.getVoucherHTML(data));
            dialog.show();
        };
        this.showVoucher = function (data) {
            var dialog = new Travian.Dialog.Dialog(
                {
                    buttonOk: false,
                    preventFormSubmit: true
                }
            );
            dialog.setContent(this.getVoucherHTML(data));
            dialog.show();
        };
        this.useVoucher = function (data) {
            return (function (data) {
                var dialog = new Travian.Dialog.Dialog(
                    {
                        preventFormSubmit: true,
                        onOkay: function (dialog, contentElement) {
                            window.location.href = "voucher.php?t=2&voucherId=" + data.id + "&c=<?=Session::getInstance()->getChecker();?>";
                        }, onShow: function () {
                            var button = jQuery('#use');
                            button.disabled = true;
                            button.disabled = false;
                        }
                    }
                );
                dialog.setContent('<?=T("PaymentWizard", "Are you sure?");?>');
                dialog.show();
                return false;
            })(data);
        };
        this.initiate = function () {

        }
    }

    var goldBankUI = new GoldBankUIV1_5();
    goldBankUI.initiate();
</script>