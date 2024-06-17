<?php

namespace Controller\Ajax\paynet;
use Controller\Ajax\AjaxBase;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\PageNavigator;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Core\Voucher;
use Game\GoldHelper;
use Model\MessageModel;
use Model\TransferGoldModel;
use resources\View\GameView;
use resources\View\PHPBatchView;
use function isServerFinished;

class redeemVoucher extends AjaxBase
{

    public function dispatch()
    {
		$this->response = array();
        if (isServerFinished() || !Config::getAdvancedProperty("voucherEnabled")) {
            $this->response['error'] = TRUE;
			$this->response['code'] = 4001;
            $this->response['message'] = T("PaymentWizard", "This feature is disabled");
            return;
        }
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->response['error'] = TRUE;
			$this->response['code'] = 4002;
            $this->response['message'] = T("PaymentWizard", "paymentUnAvailable");
            return;
        }

		if (isset($_POST['code'])) {
			$voucherCode = $_POST['code'];
			$voucher = Voucher::getVoucherWithCode($voucherCode, Session::getInstance()->getEmail());
			if ($voucher->num_rows) {
				$voucher = $voucher->fetch_assoc();
				$voucherId = $voucher['id'];
				$voucherCode = $voucher['voucherCode'];
				$email = Session::getInstance()->getEmail();
				$voucherUsed = Voucher::useVoucher($voucherId,
					$voucherCode,
					$email,
					Session::getInstance()->getPlayerId(),
					Session::getInstance()->getName());
				if ($voucherUsed !== FALSE) {
					Session::getInstance()->data['bought_gold'] += $voucherUsed;
					$this->response['data']['value'] = $voucherUsed;
					$this->response['data']['message'] = sprintf(T("PaymentWizard", "%s golds was added to your account"), $voucherUsed);
					return;
				}
			} else {
				$this->response['error'] = TRUE;
				$this->response['code'] = 4003;
				$this->response['message'] = T("PaymentWizard", "Unable to use this voucher");
				return;
			}
		}
    }
}