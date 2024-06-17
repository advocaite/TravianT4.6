<style type="text/css">
    #paymentWizard table td, #paymentWizard table th, table td, table td {
        font-size: 11px;
    }
</style>
<div id="paymentWizard" style="width: 100%;min-height: 1px!important;">
    <h4 class="round"><?= T("PaymentWizard", "History"); ?></h4>
    <table id="brought_in" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <td></td>
            <td><?= T("PaymentWizard", "Voucher ID"); ?></td>
            <td><?= T("PaymentWizard", "Gold"); ?></td>
            <td><?= T("PaymentWizard", "Reason"); ?></td>
            <td><?= T("PaymentWizard", "Date"); ?></td>
            <td><?= T("PaymentWizard", "Action"); ?></td>
        </tr>
        </thead>
        <tbody>
        <?= $vars['content']; ?>
        </tbody>
    </table>
    <?= $vars['navigator']; ?>
</div>