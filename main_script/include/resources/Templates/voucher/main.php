<?php

use Core\Session;

?>
<div id="paymentWizard" style="width: 100%;min-height: 1px!important;">
    <h4 class="round"><?= T("PaymentWizard", "Use voucher"); ?></h4>
    <p>
        <?= sprintf(T("Options",
            "You have Gold %s pieces of gold, %s pieces can be transferred after deleting your account!"),
            Session::getInstance()->getGold() . ' <img class="gold" src="img/x.gif">',
            Session::getInstance()->getTransferGold() . ' <img class="gold" src="img/x.gif">'); ?>
    </p>
    <p>
        <?= sprintf(T("PaymentWizard", "You have %s golds in your vouchers"),
            $vars['total_gold'] . ' <img class="gold" src="img/x.gif">') ?>
    </p>
    <table id="brought_in" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td colspan="2"><?= T("PaymentWizard", "Use voucher with code"); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <form action="voucher.php" method="GET">
                    <input type="hidden" name="c" value="<?= Session::getInstance()->getChecker(); ?>">
                    <?= T("PaymentWizard", "Voucher code"); ?>:
                    <input type="text" class="text" value="<?= $vars['voucherCode']; ?>" style="width: 50%"
                           name="voucherCode">
                    <?=
                    getButton([
                        "type"  => "submit",
                        "class" => "gold",
                    ],
                        [
                            "data" => [
                                "type"  => "submit",
                                "class" => "gold",
                            ],
                        ],
                        T("PaymentWizard", "Use")); ?>
                </form>
            </td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <td colspan="2"><?= T("PaymentWizard", "Redeem gold by gold number"); ?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <form action="voucher.php" method="GET">
                    <input type="hidden" name="c" value="<?= Session::getInstance()->getChecker(); ?>">
                    <?= T("PaymentWizard", "Gold num"); ?>:
                    <input type="number" class="text" min="20" value="<?= $vars['goldNum']; ?>" style="width: 50%"
                           name="goldNum">
                    <?=
                    getButton([
                        "type"  => "submit",
                        "class" => "gold",
                    ],
                        [
                            "data" => [
                                "type"  => "submit",
                                "class" => "gold",
                            ],
                        ],
                        T("PaymentWizard", "Use")); ?>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
    <br/>
    <h4 class="round"><?= T("PaymentWizard", "Voucher rules"); ?></h4>
    <ol>
        <?php
        foreach (T("PaymentWizard", "voucherRules") as $rule) {
            echo '<li>' . $rule . '</li>';
        }
        ?>
    </ol>
    <script type="text/javascript">
        jQuery(function () {
            <?php
            if (isset($vars['js'])) {
                echo $vars['js'];
            };
            if(isset($vars['errorMsg'])):?>
            var dialog = new Travian.Dialog.Dialog(
                {
                    preventFormSubmit: true
                }
            );
            dialog.setContent('<?=$vars['errorMsg'];?>');
            dialog.show();
            <?php endif;?>
        });
    </script>
</div>