<?php

use Core\Database\GlobalDB;
use Core\Helper\Notification;
use Core\Helper\WebService;
use Core\Session;
use Model\AutomationModel;

class PaymentVouchersCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        if(!getCustom('allowInterruptionInGame')){
            $dispatcher->appendContent("<hr><p class='error center'>Disabled by admin.</p><hr>");
            return;
        }
        if (isset($_REQUEST['method'])) {
            if (!isServerFinished() && $_REQUEST['method'] == 'addVoucher') {
                $this->addVoucherForEmail();
            } else if ($_REQUEST['method'] == 'showVoucher') {
                $this->showVouchersForEmail();
            } else if (!isServerFinished() && $_REQUEST['method'] == 'deleteVoucher') {
                $this->deleteVoucher();
            }
        }
        $dispatcher->appendContent(Template::getInstance()->load(['method' => isset($_REQUEST['method']) ? $_REQUEST['method'] : null], 'tpl/paymentVoucherOptions.tpl')->getAsString());
    }

    private function addVoucherForEmail()
    {
        $params = ['method' => $_REQUEST['method'], 'gold' => '', 'email' => '', 'error' => ''];
        if (isset($_REQUEST['email'])) {
            $params['email'] = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
        }
        if (WebService::isPost() && Session::validateChecker()) {
            $params['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $params['gold'] = (int)$_POST['gold'];
            if ($params['gold'] > 0 && filter_var($params['email'], FILTER_VALIDATE_EMAIL) !== FALSE) {
                $m = new AutomationModel();
                $m->addVoucher($params['email'], $params['gold']);
                Notification::RealTimeNotify("Voucher added", "A voucher which contained {$params['gold']} gold has been manually added to email {$params['email']}.");
                $params['error'] = 'successful.';
            } else {
                $params['error'] = 'Something is wrong!';
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentAddVoucher.tpl')->getAsString());
    }

    private function deleteVoucher()
    {
        $voucherId = (int)$_REQUEST['voucherId'];
        $db = GlobalDB::getInstance();
        $db->query("DELETE FROM paymentVoucher WHERE id=$voucherId");
        $this->showVouchersForEmail($_REQUEST['email']);
    }

    private function showVouchersForEmail($email = null)
    {
        $params = ['content' => '', 'email' => $email, 'method' => $_REQUEST['method']];
        if ((isset($_REQUEST['email']) && !empty($_REQUEST['email'])) || ((WebService::isPost() && !empty($_REQUEST['email'])) || !empty($email))) {
            $params['totalGold'] = 0;
            if (is_null($params['email'])) {
                $params['email'] = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
            }
            $db = GlobalDB::getInstance();
            $result = $db->query("SELECT * FROM paymentVoucher WHERE email='{$params['email']}' AND used=0");
            while ($row = $result->fetch_assoc()) {
                $params['totalGold'] += $row['gold'];
                $params['content'] .= '<tr>';
                $params['content'] .= '<td>' . $row['id'] . '</td>';
                $params['content'] .= '<td>' . $row['gold'] . '</td>';
                $params['content'] .= '<td>' . $row['voucherCode'] . '</td>';
                $params['content'] .= '<td><a href="?action=paymentVouchers&method=deleteVoucher&email=' . $params['email'] . '&voucherId=' . $row['id'] . '"><img src="img/x.gif" class="del"></a></td>';
                $params['content'] .= '</tr>';
            }
            if (!$result->num_rows) {
                $params['content'] .= '<tr><td colspan="4"><span class="errorMessage">No voucher(s)!</span></td></tr>';
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/paymentShowVouchers.tpl')->getAsString());
    }
}