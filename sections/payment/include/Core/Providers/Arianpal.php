<?php
namespace Core\Providers;
use Core\PaymentHelper;
use Core\WebService;
use SoapClient;
class Arianpal
{
    public static function request(array $providerData, array $productData, array $paymentLog)
    {
        $client = new SoapClient('http://merchant.arianpal.com/WebService.asmx?wsdl');
        if (sizeof(explode(":", $providerData['connectInfo'])) <> 2) {
            return;
        }
        list($merchantID, $password) = explode(":", $providerData['connectInfo']);
        $result = $client->RequestPayment(
            [
                "MerchantID" => $merchantID,
                "Password" => $password,
                "Price" => ceil(($paymentLog['payPrice'] / 10)),
                "ReturnPath" => WebService::getProtocol() . WebService::getJustDomain() . '/payment/process/index.php?METHOD=onProviderReturn&ORDER=' . filter_var($_REQUEST['ORDER'], FILTER_SANITIZE_STRING),
                "ResNumber" => sprintf("%s-%s", $paymentLog['id'], $paymentLog['secureId']),
                "Description" => PaymentHelper::getPackageInfo($paymentLog['id'], $paymentLog['worldUniqueId'], $productData['goldProductName'], $paymentLog['uid']),
                "Paymenter" => "WID: {$paymentLog['worldUniqueId']} | UID: {$paymentLog['uid']}",
                "Email" => $paymentLog['email'],
                "Mobile" => null
            ]
        );
        $PayPath = $result->RequestPaymentResult->PaymentPath;
        $Status = $result->RequestPaymentResult->ResultStatus;
        if ($Status === 'Succeed') {
            WebService::redirect($PayPath);
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }

    public static function verify(array $providerData, array $paymentLog)
    {
        if (sizeof(explode(":", $providerData['connectInfo'])) <> 2) {
            return false;
        }
        list($merchantID, $password) = explode(":", $providerData['connectInfo']);
        if (!(isset($_POST['status']) && $_POST['status'] == 100)) {
            return false;
        }
        $alreadyPurchased = $paymentLog['status'] == 1 || $paymentLog['status'] == 2;
        if ($alreadyPurchased) {
            return false;
        }
        $Status = $_POST['status'];
        $RefNumber = $_POST['refnumber'];
        $ResNumber = $_POST['resnumber'];
        $client = new SoapClient('http://merchant.arianpal.com/WebService.asmx?wsdl');
        $result = $client->VerifyPayment(
            [
                "MerchantID" => $merchantID,
                "Password" => $password,
                "Price" => ceil(($paymentLog['payPrice'] / 10)),
                "RefNum" => $RefNumber
            ]
        );
        $Status = $result->verifyPaymentResult->ResultStatus;
        $PayPrice = $result->verifyPaymentResult->PayementedPrice;
        if ($Status === 'Success') {
            return true;
        }
        return false;
    }
}