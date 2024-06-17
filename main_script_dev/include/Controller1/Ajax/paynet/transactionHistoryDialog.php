<?php

namespace Controller\Ajax\paynet;

use Controller\Ajax\paymentWizard;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\Mailer;
use Core\Helper\TimezoneHelper;
use Core\Session;
use resources\View\PHPBatchView;

class transactionHistoryDialog extends paymentWizard
{
	public function dispatch()
    {
		$this->response = array();
	    
        $this->renderOpenOrders();
        $this->response['html'] = $this->view->vars['content'];
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
                    $status) . '</a></td>';//class="copyOrderCode" data-order-id="'.$paymentId.'"
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
        $this->response['noResult'] = FALSE;
        $output = $view->output();
        $memcache->add("paymentWizardOpenOffers" . Session::getInstance()->getPlayerId(), $output, 2 * 60);
        output:
        $this->view->vars['content'] .= $output;
    }
}

