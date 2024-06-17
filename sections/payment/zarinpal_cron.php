<?php
ini_set('display_errors', 1);
set_time_limit(0);
use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\PaymentHelper;
use Core\Providers\Voucher;
use Core\Providers\Zarinpal;
require __DIR__ . "/include/bootstrap.php";
ini_set('default_socket_timeout', 1200);
$db = GlobalDB::getInstance();
$stmt = $db->query("SELECT * FROM paymentProviders WHERE providerType=1");
if (!$stmt->num_rows) {
    echo 'Zarinpal provider not available.';
    return;
}
$providerInfo = $stmt->fetch_assoc();
$result = Zarinpal::getUnverifiedTransactions($providerInfo);
if(empty($result->Authorities)){
    return;
}
$authorities = json_decode($result->Authorities, true);
if(empty($authorities)){
    return;
}
$minDate = strtotime('first day of January');
foreach ($authorities as $authority) {
    parse_str(parse_url($authority['CallbackURL'])['query'], $parts);
    list($orderID, $orderSecureId) = explode("-", $parts['ORDER']);
    $paymentLog = PaymentHelper::getOrder($orderID, $orderSecureId);
    if (!$paymentLog) {
        echo 'payment log not found.';
        Zarinpal::verifyStandalone($providerInfo, $authority['Authority'], $authority['Amount']);
        continue;
    }
    $productData = PaymentHelper::getProductData($paymentLog['productId']);
    if (!Zarinpal::verify($providerInfo, $productData, $paymentLog, $authority['Authority'])) {
        echo 'verify failed';
        continue;
    }
    if (strtotime($authority['Date']) < $minDate) {
        continue;
    }
    try {
        $server = GlobalDB::getGameServer($paymentLog['worldUniqueId']);
        if (!is_array($server) || $server['finished']) {
            PaymentHelper::notifyPayment('Server not found', $providerInfo, $productData, $paymentLog);
            PaymentHelper::setPaymentStatus($paymentLog['id'], 2);
            Voucher::addVoucher($paymentLog['email'], $productData['goldProductGold']);
            return;
        }
        $serverDB = ServerDB::getInstance($server['configFileLocation']);
        PaymentHelper::notifyPayment(
            PaymentHelper::getPlayerName($serverDB, $paymentLog['uid']),
            $providerInfo,
            $productData,
            $paymentLog
        );
        PaymentHelper::setPaymentStatus($paymentLog['id'], 1);
        // Preset status to prevent dual
        $result = completePaymentProcess($server, $productData, $serverDB, $paymentLog);
        if ($result) {
            $paymentLog['status'] = 1;
            PaymentHelper::setPaymentStatus($paymentLog['id'], $paymentLog['status']);
        } else {
            $paymentLog['status'] = 2;
            PaymentHelper::setPaymentStatus($paymentLog['id'], $paymentLog['status']);
            Voucher::addVoucher($paymentLog['email'], $productData['goldProductGold']);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
