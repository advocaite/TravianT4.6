<?php

namespace Core\Providers;

use Core\PaymentHelper;
use Core\WebService;
use function json_decode;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPalV2
{
    private $apiContext;

    public function __construct($connectInfo)
    {
        list($clientID, $clientSecret) = explode(":::", $connectInfo);
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $clientID,     // ClientID
                $clientSecret      // ClientSecret
            )
        );
        $this->apiContext->setConfig(
            array(
                'mode' => 'live',
            )
        );
    }

    public function loadProvider($description, $price, $currency, $order, $paymentLog)
    {
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($price);
        $amount->setCurrency($currency);

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($description);

        $returnUrl = WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&ORDER=' . $order;
        $cancelUrl = WebService::get_real_base_url() . 'process/index.php?METHOD=onProviderReturn&action=cancel&ORDER=' . $order;

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls
            ->setReturnUrl($returnUrl)
            ->setCancelUrl($cancelUrl);

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            PaymentHelper::updateLogData($paymentLog['id'], ['paymentId' => $payment->getId()]);
            WebService::redirect($payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
//            echo $ex->getData();
        }
        exit("Couldn't connect to paypal");
    }

    public function verify(array $paymentLog)
    {
        if (!isset($_GET["paymentId"], $_GET["PayerID"])) {
            return false;
        }
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $payment = Payment::get($paymentId, $this->apiContext);
        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);
        $data = json_decode($paymentLog['data'], true);
        //Invalid payment ID!
        if($data['paymentId'] != $paymentId){
            return false;
        }
        try {
            $result = $payment->execute($execute, $this->apiContext);
            return true;
        } catch (\Exception $e) {
//            $data = json_decode($e->getData());
//            var_dump($data->message);
//            die();
            return false;
        }
    }
}