<?php

namespace Core\Providers;

use Core\PaymentHelper;
use Core\WebService;

class Zarinpal
{
    const soapUrl = 'https://de.zarinpal.com/pg/services/WebGate/wsdl';
    const devSoapUrl = 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl';
    const SANDBOX_MODE = false;

    public static function request(array $providerData, array $productData, array $paymentLog)
    {
        $client = new \SoapClient(self::SANDBOX_MODE ? self::devSoapUrl : self::soapUrl, ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest(
            [
                'MerchantID' => $providerData['connectInfo'],
                'Amount' => ceil(($productData['goldProductPrice'] / 10) * 1.01),
                'Description' => PaymentHelper::getPackageInfo($paymentLog['id'], $paymentLog['worldUniqueId'], $productData['goldProductName'], $paymentLog['uid']),
                'Email' => null,
                'Mobile' => null,
                'CallbackURL' => WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&ORDER=' . filter_var($_REQUEST['ORDER'], FILTER_SANITIZE_STRING),
            ]
        );
        if ($result->Status == 100) {
            if (self::SANDBOX_MODE) {
                WebService::redirect("https://sandbox.zarinpal.com/pg/StartPay/" . $result->Authority);
            } else {
                WebService::redirect("https://www.zarinpal.com/pg/StartPay/" . $result->Authority);
            }
        } else {
            echo 'ERR: ' . $result->Status;
        }
        exit();
    }

    public static function verifyStandalone(array $providerData, $Authority, $Amount)
    {
        $MerchantID = $providerData['connectInfo'];
        $client = new \SoapClient(self::SANDBOX_MODE ? self::devSoapUrl : self::soapUrl, ['encoding' => 'UTF-8']);
        $result = $client->PaymentVerification(
            [
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]
        );
        return $result;
    }

    public static function verify(array $providerData, array $productData, array $paymentLog, $Authority = null)
    {
        $MerchantID = $providerData['connectInfo'];
        $AmountWithoutTax = ceil(($productData['goldProductPrice'] / 10)); //Amount will be based on Toman
        $Amount = ceil($AmountWithoutTax * 1.01); //Amount will be based on Toman
        if(is_null($Authority)){
            $Authority = $_GET['Authority'];
            if (!($_GET['Status'] == 'OK')) {
                return false;
            }
        }
        // URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
        $client = new \SoapClient(self::SANDBOX_MODE ? self::devSoapUrl : self::soapUrl, ['encoding' => 'UTF-8']);
        $result = $client->PaymentVerification(
            [
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
            ]
        );
        $alreadyPurchased = $paymentLog['status'] == 1 || $paymentLog['status'] == 2;
        return $result->Status == 100 && !$alreadyPurchased;
    }

    public static function getUnverifiedTransactions(array $providerData)
    {
        $MerchantID = $providerData['connectInfo'];
        $client = new \SoapClient(self::SANDBOX_MODE ? self::devSoapUrl : self::soapUrl, [
            'encoding' => 'UTF-8',
            'trace' => true,
            'connection_timeout' => 5000,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
        ]);
        $result = $client->GetUnverifiedTransactions([
            'MerchantID' => $MerchantID,
        ]);
        return $result;
    }
}