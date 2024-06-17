<?php

namespace Core\Providers;

use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\PaymentHelper;
use Core\WebService;
use GuzzleHttp\Exception\GuzzleException;
use function is_null;

class PayGol
{
    private $serviceId, $secretKey;

    public function __construct($connectInfo = null)
    {
       if(!is_null($connectInfo)){
           list($this->serviceId, $this->secretKey) = explode(":::", $connectInfo);
       }
    }

    public function submitPOST($info, $price, $currency, $order)
    {
        $baseUrl = WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&ORDER=' . $order;
        echo '<form id="paymentSubmit" name="pg_frm" method="post" action="https://www.paygol.com/pay" >';
        echo '<input type="hidden" name="pg_serviceid" value="' . $this->serviceId . '">';
        echo '<input type="hidden" name="pg_currency" value="' . $currency . '">';
        echo '<input type="hidden" name="pg_name" value="' . $info . '">';
        echo '<input type="hidden" name="pg_custom" value="' . $order . '">';
        echo '<input type="hidden" name="pg_price" value="' . $price . '">';
        echo '<input type="hidden" name="pg_return_url" value="' . ($baseUrl . '&result=success') . '">';
        echo '<input type="hidden" name="pg_cancel_url" value="' . ($baseUrl . '&result=cancel') . '">';
        echo '</form>';
        echo '<script type="text/javascript">';
        echo 'document.getElementById("paymentSubmit").submit();';
        echo '</script>';
    }

    //not working.
    public function loadProvider($description, $price, $currency, $order, $paymentLog)
    {
        $baseUrl = WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&ORDER=' . $order;
        $client = new \GuzzleHttp\Client(['verify' => false]);
        try {
            $res = $client->request('POST', 'https://www.paygol.com/pay', [
                'form_params' => [
                    'pg_serviceid' => $this->serviceId,
                    'pg_currency' => $currency,
                    'pg_name' => $description,
                    'pg_custom' => $order,
                    'pg_price' => $price,
                    'pg_mode' => 'api',
                    'pg_format' => 'xml',
                    'pg_email' => $paymentLog['email'],
                    'pg_country' => 'WTF', //
                    'pg_language' => 'WTF', //
                    'pg_method' => 'WTF', //
                    'pg_ip' => 'WTF', //
                    'pg_first_name' => 'WTF', //
                    'pg_last_name' => 'WTF', //
                    'pg_personalid' => 'WTF', //
                    'pg_return_url' => $baseUrl,
                    'pg_cancel_url' => ($baseUrl . '&result=cancel'),
                ],
            ]);
        } catch (GuzzleException $e) {
            exit("Error connecting to paygol");
        }
    }

    public function processIpn()
    {
        list($orderId, $orderSecureId) = explode('-', filter_var($_REQUEST['custom'] ?? null, FILTER_SANITIZE_STRING));
        $paymentLog = PaymentHelper::getOrder($orderId, $orderSecureId);
        if ($paymentLog === FALSE) {
            return;
        }
        $productData = PaymentHelper::getProductData($paymentLog['productId']);
        if (($paymentLog['status'] <> 4 && $paymentLog['status'] <> 3)) {
            return;
        }
        $providerData = PaymentHelper::getProviderData($paymentLog['paymentProvider']);
        list($this->serviceId, $this->secretKey) = explode(":::", $providerData['connectInfo']);
        if ($this->secretKey != $_GET['key']) {
            die("Error: Unknown");
        }
        if ($providerData['providerType'] != 4) return;
        if (!($_GET['service_id'] == $this->serviceId)) {
            return;
        }
        $diff = $_GET['frmprice'] - $productData['goldProductPrice'];
        if (!($diff == 0 && strtolower(trim($_GET['frmcurrency'])) == strtolower(trim($productData['goldProductMoneyUnit'])))) {
            return;
        }
        $server = GlobalDB::getGameServer($paymentLog['worldUniqueId']);
        if ($server === false) {
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
        $result = completePaymentProcess($server, $productData, $serverDB, $paymentLog);
        if ($result) {
            $paymentLog['status'] = 1;
            PaymentHelper::setPaymentStatus($paymentLog['id'], $paymentLog['status']);
            return;
        }
        $paymentLog['status'] = 2;
        PaymentHelper::setPaymentStatus($paymentLog['id'], $paymentLog['status']);
        Voucher::addVoucher($paymentLog['email'], $productData['goldProductGold']);
    }
}