<?php

use Core\Database\GlobalDB;
use Core\Templates\HTMLResponse;
use Core\WebService;

require __DIR__ . '/include/bootstrap.php';
$db = GlobalDB::getInstance();
$config = $db->query("SELECT * FROM config")->fetch_assoc();

$Amount = $config['paymentAmount'];
$Amount += $Amount * 0.01 + ($Amount * 0.01 * 0.01);
if($config['expiretime'] > time()){
    echo HTMLResponse::renderErrMessageDialog("پرداخت ناموفق", sprintf('سرور تا تاریخ %s تمدید شده است.', date('Y-m-d H:i:s', $config['expiretime'])));
    die;
}
if (isset($_GET['pay']) && $_GET['pay'] == 1) {
    $client = new \SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));
    $result = $client->PaymentRequest(
        array(
            'MerchantID' => 'd6fc3b2a-b050-11e7-9d20-005056a205be',
            'Amount' => $Amount,
            'Description' => sprintf(
                'تمدید لایسنس (%s - %s)',
                date('Y-m-d', $config['expiretime']),
                date('Y-m-d', $config['expiretime'] + 30 * 86400)
            ),
            'Email' => null,
            'Mobile' => null,
            'CallbackURL' => WebService::get_real_base_url() . 'verifyOverdue.php?return=1'
        )
    );
    if ($result->Status == 100) {
        WebService::redirect("https://www.zarinpal.com/pg/StartPay/{$result->Authority}");
    }
} else if(isset($_GET['return']) && $_GET['return'] == 1){
    $Authority = $_GET['Authority'];
    if (!($_GET['Status'] == 'OK')) {
        echo HTMLResponse::renderErrMessageDialog("پرداخت ناموفق", 'پرداخت موفقیت آمیز نبود. مجددا امتحان کنید.');
        die;
    }
    $client = new \SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));
    $result = $client->PaymentVerification(
        array(
            'MerchantID' => 'd6fc3b2a-b050-11e7-9d20-005056a205be',
            'Authority' => $Authority,
            'Amount' => $Amount
        )
    );
    if($result->Status == 100){
        $db->query("UPDATE config SET expiretime=expiretime+2592000");
        echo HTMLResponse::renderErrMessageDialog(
            "پرداخت موفقیت آمیز",
            'پنل مدیریت هم اکنون فعال است.'
        );
        die;
    }
    echo HTMLResponse::renderErrMessageDialog("پرداخت ناموفق", 'پرداخت موفقیت آمیز نبود. مجددا امتحان کنید.');
    die;
}
