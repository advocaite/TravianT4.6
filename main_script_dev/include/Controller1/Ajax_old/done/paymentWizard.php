<?php

namespace Controller\Ajax;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use function getDisplay;
use Model\Quest;
use resources\View\PHPBatchView;

class paymentWizard extends AjaxBase
{
    private $view;

    public function dispatch()
    {
        if ((Session::getInstance()->banned() && Session::getInstance()->getPlayerId() > 2)/* || Config::getInstance()->dynamic->serverFinished*/) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
            return;
        }
        Quest::getInstance()->setQuestBitwise('world', 7, 1);
        $this->view = new PHPBatchView("payment/paymentWizardLayout");
        $_REQUEST['activeTab'] = in_array($_REQUEST['activeTab'],
            [
                'buyGold',
                'pros',
                'plusSupport',
                'earnGold',
                'paymentFeatures',
                'openOrders'
            ]) ? $_REQUEST['activeTab'] : 'buyGold';

        $this->view->vars['plusFeaturesEnabled'] = $this->getEnabledPlusFeatures()['available'];

        if ($_REQUEST['activeTab'] == 'paymentFeatures' && !$this->view->vars['plusFeaturesEnabled']) {
            $_REQUEST['activeTab'] = 'buyGold';
        }
        $this->view->vars['class'] = $_REQUEST['activeTab'];
        $this->view->vars['content'] = NULL;
        $isActive = GlobalDB::getInstance()->fetchScalar("SELECT active FROM paymentConfig") && !Config::getInstance()->dynamic->serverFinished;
        $isActive = $isActive && getCustom("paymentWizardBuyGoldEnabled");
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD) || (!$isActive && $_REQUEST['activeTab'] == 'buyGold')) {
            $view = new PHPBatchView("payment/buyGoldDisabled");
            $this->view->vars['content'] .= $view->output();
            $this->response['data']['html'] = $this->view->output();

            return;
        }
        switch ($_REQUEST['activeTab']) {
            case 'buyGold':
                $this->renderBuyGold();
                break;
            case 'pros':
                $this->renderPros();
                break;
            case 'plusSupport':
                $this->renderPlusSupport();
                break;
            case 'earnGold':
                $this->renderEarnGold();
                break;
            case 'paymentFeatures':
                $this->renderPaymentFeatures();
                break;
            case 'openOrders':
                $this->renderOpenOrders();
                break;
        }
        $this->response['data']['html'] = $this->view->output() . '<div class="clear">&nbsp;</div>';
    }

    public function sendMail($Subject, $to, $html)
    {
        Mailer::sendEmail($to, $Subject, $html);
    }

    private function getEnabledPlusFeatures()
    {
        $config = Config::getInstance();
        $powerAvailable = $moreProtectionAvailable = $generalOptionsAvailable = false;
        foreach (get_object_vars($config->extraSettings->generalOptions) as $var) {
            if ($var->enabled) {
                $generalOptionsAvailable = true;
                break;
            }
        }
        foreach ($config->extraSettings->moreProtection->packages as $var) {
            if ($var['enabled']) {
                $moreProtectionAvailable = true;
                break;
            }
        }
        foreach (get_object_vars($config->extraSettings->power) as $var) {
            if ($var->enabled) {
                $powerAvailable = true;
                break;
            }
        }
        return [
            'available' => $generalOptionsAvailable || $moreProtectionAvailable || $powerAvailable || $config->extraSettings->buyAnimal['enabled'] || $config->extraSettings->buyTroops['enabled'] || $config->extraSettings->buyResources['enabled'],
            'features'  => [
                'general'        => $generalOptionsAvailable,
                'moreProtection' => $moreProtectionAvailable,
                'extraPower'     => $powerAvailable,
                'buyAnimal'      => $config->extraSettings->buyAnimal['enabled'],
                'buyTroops'      => $config->extraSettings->buyTroops['enabled'],
                'buyResources'   => $config->extraSettings->buyResources['enabled'],
                'buyBuildings'   => $config->extraSettings->buyBuildings['enabled'],
            ],
        ];
    }

    private function renderPaymentFeatures()
    {
        $view = new PHPBatchView("payment/paymentFeatures");
        $view->vars['enabledFeatures'] = $this->getEnabledPlusFeatures()['features'];
        $this->view->vars['content'] .= $view->output();
    }

    private function renderEarnGold()
    {
        $view = new PHPBatchView("payment/earnGold");
        $view->vars['messageLine'] = NULL;
        $view->vars['invitationStatus'] = !isServerFinished() && !GlobalDB::getInstance()->fetchScalar("SELECT registerClosed FROM gameServers WHERE id=" . Config::getProperty("settings",
                    "worldUniqueId"));
        $view->vars['voucherEnabled'] = Config::getAdvancedProperty("voucherEnabled");
        $view->vars['inviteLink'] = WebService::getProtocol() . WebService::getJustDomain() . '/?uc=' . getWorldId() . '_' . Session::getInstance()->getPlayerId() . '#register';

        if (isset($_REQUEST['location']) && $_REQUEST['location'] == 'earnGoldMailSend') {
            $success_num = 0;
            $worldId = Config::getInstance()->settings->worldId;
            $subject = str_replace('[PLAYERNAME]',
                Session::getInstance()->getName(),
                T('PaymentWizard', 'INVITE_EMAIL_SUBJECT'));
            $message = str_replace('[PLAYERNAME]',
                Session::getInstance()->getName(),
                T('PaymentWizard', 'INVITE_EMAIL_MESSAGE'));
            $message = str_replace('[PLAYEREMAIL]', Session::getInstance()->getEmail(), $message);
            $message = str_replace('[GAMEWORLD]', $worldId, $message);
            $message = str_replace('[TRIBE]', T("Global", "races." . Session::getInstance()->getRace()), $message);
            $message = str_replace('[CUSTOM_MESSAGE]',
                filter_var($_POST['formData']['message'], FILTER_SANITIZE_STRING),
                $message);
            $message = str_replace('[INVITE_LINK]', $view->vars['inviteLink'], $message);
            $x = 0;
            foreach ($_POST['formData']['receiver'] as $value) {
                $x++;
                if (filter_var($value, FILTER_VALIDATE_EMAIL) !== FALSE) {
                    $this->sendMail($subject, $value, nl2br($message));
                    ++$success_num;
                }
                if ($x >= 6) {
                    break;
                }
            }
            $view->vars['messageLine'] = '<div class="error">' . sprintf(T("PaymentWizard",
                    "Number of successfully sent invitations: x"),
                    $success_num) . '</div>';
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function renderPlusSupport()
    {
        $trName = '';
        if (Session::getInstance()->getRace() == 2) {
            $trName = 'germanen';
        } elseif (Session::getInstance()->getRace() == 3) {
            $trName = 'gallier';
        }
        $view = new PHPBatchView("payment/plusSupport");
        $view->vars['trName'] = $trName;
        $this->view->vars['content'] .= $view->output();
    }

    private function renderPros()
    {
        $view = new PHPBatchView("payment/pros");
        $this->view->vars['content'] .= $view->output();
    }

    private function renderBuyGold()
    {
        $this->renderPackages();
    }

    private function renderPackages()
    {
        $result = GlobalDB::getInstance()->query("SELECT * FROM locations");
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[$row['id']] = $row;
        }
        $selectedLocation = isset($_REQUEST['goldProductLocation']) && !empty($_REQUEST['goldProductLocation']) ? (int)$_REQUEST['goldProductLocation'] : $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')];
        $view = new PHPBatchView("payment/buyGold");
        $Found = FALSE;
        $LocationData = [];
        foreach ($locations as $location) {
            if ($location['id'] == $selectedLocation) {
                $Found = TRUE;
                $LocationData = $location;
            }
        }
        if (!$Found) {
            $selectedLocation = Config::getInstance()->dynamic->default_payment_location;
            foreach ($locations as $location) {
                if ($location['id'] == $selectedLocation) {
                    $LocationData = $location;
                }
            }
        }
        $_SESSION[Session::getInstance()->fixSessionPrefix('default_payment_location')] = $selectedLocation;
        $view->vars['locations'] = $locations;
        $view->vars['selectedLocation'] = $selectedLocation;
        $view->vars['locationName'] = $LocationData['location'];
        $view->vars['goldProductId'] = isset($_POST['goldProductId']) ? (int)$_POST['goldProductId'] : -1;
        $view->vars['packages'] = $this->getLocationProducts($selectedLocation);
        $this->view->vars['content'] .= $view->output();
    }

    public function getLocationProducts($locationId)
    {
        if(empty($locationId)){
            return [];
        }
        $result = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductLocation=$locationId ORDER BY goldProductGold DESC");
        $locations = [];
        if(!$result){
            return $locations;
        }
        $offer = GlobalDB::getInstance()->fetchScalar("SELECT offer FROM paymentConfig") >= time();
        while ($row = $result->fetch_assoc()) {
            if ($offer && $row['goldProductHasOffer'] && !in_array($row['goldProductImageName'],
                    ['Travian_Facelift_voucher.png', 'Travian_Facelift_SMS.png', 'Travian_Facelift_Festnetz.png'])) {
                $row['goldProductGold'] = ceil($row['goldProductGold'] * 1.2);
                $split = explode(".", $row['goldProductImageName']);
                $row['goldProductImageName'] = $split[0] . '-20.' . $split[1];
            }
            $locations[] = $row;
        }
        return $locations;
    }

    function getLocationProviders($locationId)
    {
        $result = GlobalDB::getInstance()->query("SELECT * FROM paymentProviders WHERE location=$locationId AND hidden=0 ORDER by posId");
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[$row['providerId']] = $row;
        }
        return $locations;
    }

    public function getOpenOrders($worldUniqueId, $uid)
    {
        $db = GlobalDB::getInstance();
        $result = $db->query("SELECT * FROM paymentLog WHERE worldUniqueId={$worldUniqueId} AND uid={$uid} AND status>0");
        $locations = [];
        while ($row = $result->fetch_assoc()) {
            $locations[] = $row;
        }
        return $locations;
    }

    private function renderOpenOrders()
    {
        $memcache = Caching::getInstance();
        $result = $memcache->get("paymentWizardOpenOffers" . Session::getInstance()->getPlayerId());
        if ($result && !Session::getInstance()->isAdmin()) {
            $output = $result;
            goto output;
        }
        $view = new PHPBatchView("payment/paymentWizardOpenOffers");
        $view->vars['content'] = NULL;
        $x = 0;
        foreach ($this->getOpenOrders(Config::getProperty("settings", "worldUniqueId"),
            Session::getInstance()->getPlayerId()) as $bill) {
            $status = ['Pending', 'Success', 'Success2', 'Cancelled', 'Pending'][$bill['status']];
            if (!Session::getInstance()->isAdmin() && in_array($status, ['Pending'])) continue;
            $x++;
            $providerData = GlobalDB::getInstance()->query("SELECT * FROM paymentProviders WHERE providerId={$bill['paymentProvider']}")->fetch_assoc();
            if ($providerData['providerType'] == 3) {
                $x--;
                continue;
            }
            $paymentId = $bill['id'] . '-' . $bill['secureId'];
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td>' . TimezoneHelper::autoDate($bill['time'], TRUE) . '</td>';
            $view->vars['content'] .= '<td title="' . $paymentId . '"><a href="dorf1.php?checkPayment=' . $paymentId . '">' . T("PaymentWizard",
                    $status) . '</a></td>';
            $view->vars['content'] .= '<td>' . T("PaymentWizard",
                    (($bill['status'] == 1 || $bill['status'] == 2) ? 'booked' : 'not booked')) . '</td>';
            $view->vars['content'] .= '<td>' . (empty($providerData['name']) ? '-' : $providerData['name']) . '</td>';
            $productData = GlobalDB::getInstance()->query("SELECT * FROM goldProducts WHERE goldProductId={$bill['productId']}")->fetch_assoc();
            $view->vars['content'] .= '<td>' . $productData['goldProductGold'] . '</td>';
            $view->vars['content'] .= '<td>' . ($bill['payPrice'] . '' . $productData['goldProductMoneyUnit']) . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (!$x) {
            $view->vars['content'] .= '<td colspan="6" class="noData">' . T("PaymentWizard",
                    "no Open Orders") . '</td>';
        }
        $this->response['data']['noResult'] = FALSE;
        $output = $view->output();
        $memcache->add("paymentWizardOpenOffers" . Session::getInstance()->getPlayerId(), $output, 2 * 60);
        output:
        $this->view->vars['content'] .= '<div class="buyGoldContainer"><div id="openOrders">' . $output . '</div></div>';
    }
}