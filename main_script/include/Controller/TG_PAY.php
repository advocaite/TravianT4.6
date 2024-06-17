<?php

namespace Controller;

use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\WebService;
use Core\Locale;
use Core\Session;
use Game\EmailVerification;
use Model\OptionModel;
use resources\View\GameView;

class TG_PAY extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();

        $this->view = new GameView();
        //$this->view->vars['titleInHeader'] = 'Travian <font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font>';
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'plus';
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->view->vars['content'] .= '<h4 class="round">' . T("PaymentWizard",
                    "The payment system is not available") . '</h4>';
            $this->view->vars['content'] .= '<p>' . T("PaymentWizard",
                    "An error occurred The payment system is not available at the moment Please try again later") . '</p>';
            return;
        }
        if (Session::getInstance()->banned() && Session::getInstance()->getPlayerId() > 2) {
            $this->innerRedirect("InGameBannedPage");
        } else if (Config::getInstance()->dynamic->serverFinished) {
            $this->innerRedirect("InGameWinnerPage");
        }
        $m = new OptionModel();
        if ($m->isDeletion(Session::getInstance()->getPlayerId())) {
            $this->view->vars['content'] = '<div class="helpInfoBlock helpInfoLinkLess"><p class="helpText">' . T("PaymentWizard",
                    "AccountDeletionErr") . '</p></div>';
            return;
        }
        $providerId = isset($_GET['provider']) ? (int)$_GET['provider'] : 0;
        $productId = isset($_GET['provider']) ? (int)$_GET['product'] : 0;
        $isActive = 0 < GlobalDB::getInstance()->fetchScalar("SELECT active FROM paymentConfig");
        $isActive = $isActive && getCustom("paymentWizardBuyGoldEnabled");
        if (!$isActive) {
            $this->view->vars['content'] .= '<h4 class="round">' . T("PaymentWizard",
                    "The payment system is not available") . '</h4>';
            $this->view->vars['content'] .= '<p>' . T("PaymentWizard",
                    "An error occurred The payment system is not available at the moment Please try again later") . '</p>';
            return;
        }
        if (!$this->checkProviderAndProduct($providerId, $productId)) {
            $this->view->vars['content'] .= '<h4 class="round">' . T("PaymentWizard",
                    "The payment system is not available") . '</h4>';
            $this->view->vars['content'] .= '<p>' . T("PaymentWizard",
                    "An error occurred The payment system is not available at the moment Please try again later") . '</p>';

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
            //Edit if url is broken.
            $redirectLocation = 'http://' . WebService::getJustDomain() . '/payment/process/index.php?METHOD=loadProvider&ORDER=' . $order;
        } else {
            $redirectLocation = WebService::getPaymentUrl() . 'process/index.php?METHOD=loadProvider&ORDER=' . $order;
        }
        redirect($redirectLocation);
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