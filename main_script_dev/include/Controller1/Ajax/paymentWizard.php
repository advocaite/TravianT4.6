<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Database\GlobalDB;
use Core\Session;
use function getCustom;
use function getDisplay;
use Model\Quest;
use resources\View\PHPBatchView;
use Core\Helper\WebService;

class paymentWizard extends AjaxBase
{
    public function dispatch()
    {
        if ((Session::getInstance()->banned() && Session::getInstance()->getPlayerId() > 2)/* || Config::getInstance()->dynamic->serverFinished*/) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("inGame", 'bannedSmallPage');
            return;
        }
		
		if(WebService::isPost()){
			Quest::getInstance()->setQuestBitwise('world', 7, 1);
			$this->view = new PHPBatchView("payment/paymentWizardLayout");
			$_POST['activeTab'] = in_array($_POST['activeTab'],
				[
					'buyGold',
					'pros',
					'plusSupport',
					'earnGold',
					'paymentFeatures',
					'openOrders',
					'vouchers'
				]) ? $_POST['activeTab'] : 'buyGold';

			$this->view->vars['answerId'] = 368;
			$this->view->vars['plusFeaturesEnabled'] = $this->getEnabledPlusFeatures()['available'];

			if ($_POST['activeTab'] == 'paymentFeatures' && !$this->view->vars['plusFeaturesEnabled']) {
				$_POST['activeTab'] = 'buyGold';
			}
			$this->view->vars['class'] = $_POST['activeTab'];
			$this->view->vars['content'] = NULL;
			$this->view->vars['callInit'] = $this->callInit;
			$this->view->vars['gold'] = (getCustom("serverIsFreeGold") ? T("Global", "Unlimited") : Session::getInstance()->getAvailableGold());
					
			$isActive = GlobalDB::getInstance()->fetchScalar("SELECT active FROM paymentConfig") && !Config::getInstance()->dynamic->serverFinished;
			$isActive = $isActive && getCustom("paymentWizardBuyGoldEnabled");
			if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD) || (!$isActive && $_POST['activeTab'] == 'buyGold')) {
				$this->response['error'] = true;
				$this->response['message'] = T("PaymentWizard", "paymentUnAvailable");

				return;
			}
			switch ($_POST['activeTab']) {
				case 'buyGold':
					$this->view->vars['initMethod'] = 'shopUIV4.initialize(1);';
					break;
				case 'pros':
					$this->renderPros();
					break;
				case 'plusSupport':
					$this->renderPlusSupport();
					break;
				case 'earnGold':
					$this->renderEarnGold();
					//$this->view->vars['initMethod'] = 'Travian.Game.PaymentWizard.initializeEarnGoldTab();';
					break;
				case 'paymentFeatures':
					$this->renderPaymentFeatures();
					break;
				case 'vouchers':
					$this->renderVoucher();
					break;
			}
			$this->response['html'] = $this->view->output() . '<div class="clear">&nbsp;</div>';
		}
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

        if (isset($_POST['location']) && $_POST['location'] == 'earnGoldMailSend') {
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
        $view->vars['trId'] = Session::getInstance()->getRace();
        $this->view->vars['content'] .= $view->output();
    }

    private function renderPros()
    {
        $view = new PHPBatchView("payment/pros");
        $this->view->vars['content'] .= $view->output();
    }
	
    private function renderVoucher()
    {
        $view = new PHPBatchView("payment/vouchers");
        $this->view->vars['content'] .= $view->output();
    }
}