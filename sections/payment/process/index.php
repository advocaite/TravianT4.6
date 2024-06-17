<?php

namespace Process;

use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Enums\ProviderEnum;
use Core\Providers\PayPalV2;
use Core\Templates\HTMLResponse;
use Core\PaymentHelper;
use Core\Travian;
use Core\Providers\Arianpal;
use Core\Providers\PayGol;
use Core\Providers\Voucher;
use Core\Providers\Zarinpal;

if (isset($_REQUEST['goIPN'])) {
    require("ipn.php");
    exit;
}
require dirname(__DIR__) . '/include/bootstrap.php';
if (!C("active")) {
    echo 'Payment Not available.';
    return;
}
if (!isset($_REQUEST['METHOD'], $_REQUEST['ORDER'])) {
    echo 'Insufficient parameters.';
    return;
}
$order = filter_var($_REQUEST['ORDER'], FILTER_SANITIZE_STRING);
$method = filter_var($_REQUEST['METHOD'], FILTER_SANITIZE_STRING);
list($orderId, $orderSecureId) = explode('-', filter_var($_REQUEST['ORDER'], FILTER_SANITIZE_STRING));
$paymentLog = PaymentHelper::getOrder($orderId, $orderSecureId);
if ($paymentLog === FALSE) {
    echo 'Unknown order.';
    return;
}
$productData = PaymentHelper::getProductData($paymentLog['productId']);
$providerData = PaymentHelper::getProviderData($paymentLog['paymentProvider']);
Travian::Locale()->setLocaleLanguage(PaymentHelper::getProviderLocationLanguage($productData['goldProductLocation']));
if ($method == 'loadProvider') {
    if ($paymentLog['status'] != 0) {
        echo 'Transaction is pending.';
        return;
    }
    $packageInfo = PaymentHelper::getPackageInfo(
        $paymentLog['id'],
        $paymentLog['worldUniqueId'],
        $productData['goldProductName'],
        $paymentLog['uid']
    );
    PaymentHelper::setPaymentStatus($paymentLog['id'], 4);
    if ($providerData['providerType'] == ProviderEnum::ZARINPAL) {
        Zarinpal::request($providerData, $productData, $paymentLog);
    } else if ($providerData['providerType'] == ProviderEnum::PAYPAL) {
        $paypal = new PayPalV2($providerData['connectInfo']);
        $paypal->loadProvider($packageInfo, $productData['goldProductPrice'], $productData['goldProductMoneyUnit'], $order, $paymentLog);
    } else if ($providerData['providerType'] == ProviderEnum::ARIANPAL) {
        Arianpal::request($providerData, $productData, $paymentLog);
    } else if ($providerData['providerType'] == ProviderEnum::PAYGOL) {
        (new PayGol($providerData['connectInfo']))
            ->submitPOST($packageInfo,
                $productData['goldProductPrice'],
                $productData['goldProductMoneyUnit'],
                $order
            );
        //(new PayGol( $providerData['connectInfo']))->loadProvider($packageInfo, $productData['goldProductPrice'], $productData['goldProductMoneyUnit'], $order, $paymentLog);
        return;
    }
} else if ($method == 'onProviderReturn') {
    $action = filter_var($_REQUEST['result'] ?? null, FILTER_SANITIZE_STRING);
    if ($paymentLog['status'] <> 4 && $paymentLog['status'] <> 3) {
        echo 'Payment is not ready for this stage.';
        return;
    }
    if ($action != 'cancel') {
        if ($providerData['providerType'] == ProviderEnum::ARIANPAL) {
            $result = Arianpal::verify($providerData, $paymentLog);
        } else if ($providerData['providerType'] == ProviderEnum::ZARINPAL) {
            $result = Zarinpal::verify($providerData, $productData, $paymentLog);
        } else if ($providerData['providerType'] == ProviderEnum::PAYPAL) {
            $paypal = new PayPalV2($providerData['connectInfo']);
            $result = $paypal->verify($paymentLog);
        }
        if ($result) {
            $server = GlobalDB::getGameServer($paymentLog['worldUniqueId']);
            echo HTMLResponse::renderErrMessageDialog(
                T("Main", 'Transmission Completed'),
                T("Main", "Transmission Completed") . '<br /><br /><a href="' . $server['gameWorldUrl'] . '/dorf1.php">' . T("Main", "Continue to server") . '...</a>'
            );
            if (!is_array($server) || $server['finished']) {
                PaymentHelper::notifyPayment('Server not found', $providerData, $productData, $paymentLog);
                PaymentHelper::setPaymentStatus($paymentLog['id'], 2);
                Voucher::addVoucher($paymentLog['email'], $productData['goldProductGold']);
                return;
            }
            $serverDB = ServerDB::getInstance($server['configFileLocation']);
            PaymentHelper::notifyPayment(
                PaymentHelper::getPlayerName($serverDB, $paymentLog['uid']),
                $providerData,
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
            return;
        }
    }
    if ($action == 'success') {
        $server = GlobalDB::getGameServer($paymentLog['worldUniqueId']);
        if ($server !== false) {
            echo HTMLResponse::renderErrMessageDialog(
                T("Main", 'Transmission Completed'),
                T("Main", "Transmission Completed") . '<br /><br /><a href="' . $server['gameWorldUrl'] . '/dorf1.php">' . T("Main", "Continue to server") . '...</a>'
            );
        }
        return;
    } else {
        if ($paymentLog['status'] <> 4) return;
        PaymentHelper::setPaymentStatus($paymentLog['id'], 3);
        echo HTMLResponse::renderErrMessageDialog(
            T("Main", 'Process Cancelled'),
            T("Main", "Payment transmission process cancelled")
        );
        return;
    }
}