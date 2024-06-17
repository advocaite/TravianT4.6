<style type="text/css">
    #paymentWizard table.vouchers td {
        font-size: 11px;
    }
</style>
<div id="paymentWizard" style="width: 100%;min-height: 1px!important;">
    <h4 class="round"><?= T("PaymentWizard", "Your voucher(s)"); ?></h4>
    <table class="vouchers" id="brought_in" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th></th>
            <th><?= T("PaymentWizard", "Voucher ID"); ?></th>
            <th><?= T("PaymentWizard", "Gold"); ?></th>
            <th><?= T("PaymentWizard", "Reason"); ?></th>
            <th><?= T("PaymentWizard", "Date"); ?></th>
            <th><?= T("PaymentWizard", "Action"); ?></th>
        </tr>
        </thead>
        <tbody>
        <?= $vars['content']; ?>
        </tbody>
    </table>
    <?= $vars['navigator']; ?>
    <script type="text/javascript">
        jQuery(function() {
            <?php
            if (isset($vars['js'])) {
                echo $vars['js'];
            };
            ?>
            <?php if(isset($vars['errorMsg'])):?>
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