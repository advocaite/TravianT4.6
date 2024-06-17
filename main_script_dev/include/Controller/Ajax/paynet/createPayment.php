<?php

namespace Controller\Ajax\paynet;

use Controller\Ajax\AjaxBase;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\Locale;
use Core\Session;
use Game\EmailVerification;
use Model\OptionModel;
use resources\View\GameView;
use Core\Helper\PreferencesHelper;

class createPayment extends AjaxBase
{
	public function dispatch()
    {
		if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->response['message'] = T("PaymentWizard","The payment system is not available");
            $this->response['error'] = true;
            return;
        }        
        $providerId = isset($_POST['paymentMethodCode']) ? (int)$_POST['paymentMethodCode'] : 0;
		$productId = PreferencesHelper::getPreference('lastProductID');
		PreferencesHelper::setPreference('lastUsedPaymentMethod', $providerId);
        $isActive = 0 < GlobalDB::getInstance()->fetchScalar("SELECT active FROM paymentConfig");
        //$isActive = $isActive && getCustom("paymentWizardBuyGoldEnabled");
        if (!$isActive) {
            $this->response['message'] = T("PaymentWizard","The payment system is not available".$providerId.$productId);
            $this->response['error'] = true;
            return;
        }
        if (!$this->checkProviderAndProduct($providerId, $productId)) {
            $this->response['message'] = T("PaymentWizard","The payment system is not available".$providerId.$productId);
            $this->response['error'] = true;
            return;
        }
        $providerType = $this->getProviderType($providerId);
        /*if($providerType == 2){
            $this->view->vars['content'] .= '<h4 class="round">' . T("PaymentWizard", "The payment system is not available") . '</h4>';
            $this->view->vars['content'] .= '<p>Purchases currently disabled.</p>';
            return;
        }*/
        $email = Session::getInstance()->isSitter() ? Session::getInstance()->getSitterEmail() : Session::getInstance()->getEmail();
        $product = GlobalDB::getInstance()->query("SELECT goldProductPrice FROM goldProducts WHERE goldProductId=$productId")->fetch_assoc();
        $order = $this->addOrder(
            Config::getProperty("settings", "worldUniqueId"),
            Session::getInstance()->getPlayerId(),
            $email,
            $providerId,
            $productId,
            $product['goldProductPrice']
        );
        if ($providerType == 9) {
            //fix for arianpal
            $redirectLocation = 'http://' . WebService::getJustDomain() . '/payment/process/index.php?METHOD=loadProvider&ORDER=' . $order;
        } else {
            $redirectLocation = WebService::getPaymentUrl() . 'process/index.php?METHOD=loadProvider&ORDER=' . $order;
        }
		$this->response['url'] = $redirectLocation;
	}
	
	function checkProviderAndProduct($providerId, $productId)
    {
        if (!$this->doesProviderExists($providerId)) return FALSE;
        $providerDetails = GlobalDB::getInstance()->query("SELECT location, providerType FROM paymentProviders WHERE providerId=$providerId");
        if (!$providerDetails->num_rows) return FALSE;
        $providerDetails = $providerDetails->fetch_assoc();
        if (/*!Config::getAdvancedProperty("voucherEnabled") && */
            $providerDetails['providerType'] == 3
        ) return FALSE;
        $location = $providerDetails['location'];
        return 0 < GlobalDB::getInstance()->fetchScalar("SELECT COUNT(goldProductId) FROM goldProducts WHERE goldProductLocation=$location AND goldProductId=$productId");
    }

    function addOrder($worldUniqueId, $uid, $email, $paymentProvider, $productId, $payPrice)
    {
        $secureId = substr(sha1(time() + mt_rand()) . sha1(microtime()), mt_rand(0, 32 - 6), mt_rand(16, 32));
        GlobalDB::getInstance()->query("INSERT INTO paymentLog(worldUniqueId, uid, email, secureId, paymentProvider, productId, payPrice, time) VALUES ('$worldUniqueId','$uid','$email','$secureId','$paymentProvider','$productId', $payPrice, '" . time() . "')");
        return GlobalDB::getInstance()->lastInsertId() . '-' . $secureId;
    }

    function getProviderType($providerId)
    {
        return GlobalDB::getInstance()->fetchScalar("SELECT providerType FROM paymentProviders WHERE providerId=$providerId");
    }

    function doesProviderExists($providerId)
    {
        return 0 < GlobalDB::getInstance()->fetchScalar("SELECT COUNT(providerId) FROM paymentProviders WHERE providerId=$providerId");
    }
}

