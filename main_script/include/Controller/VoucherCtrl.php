<?php

namespace Controller;

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

class VoucherCtrl extends GameCtrl
{
    private $pageSize = 20;

    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("PaymentWizard", "Gold bank");
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'messages';
        $worldId = Config::getProperty("settings", "worldUniqueId");
        if (isServerFinished()) {
            $this->view->vars['content'] = '<span class="warning">' . T("PaymentWizard", "This feature is disabled") . '</span>';
            return;
        }

        $selectedTab = isset($_GET['t']) && in_array($_GET['t'], [0, 1, 2, 3]) ? (int)$_GET['t'] : 0;
        $this->view->vars['content'] .= (new PHPBatchView("voucher/menu"))->output([
            'selectedTab' => $selectedTab,
            'enabled' => Config::getAdvancedProperty("voucherEnabled")
        ]);

        if (!Config::getAdvancedProperty("voucherEnabled")) {
            $this->view->vars['titleInHeader'] = T("TransferGold", "title");
        }

        if ($selectedTab == 3) {
            $this->transferGold();
            return;
        }

        if (!Config::getAdvancedProperty("voucherEnabled")) {
            WebService::redirect('voucher.php?t=3');
            return;
        }
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->redirect("dorf1.php");
        }

        if ($selectedTab === 0) {
            $view = new PHPBatchView("voucher/main");
            if (isset($_GET['goldNum']) && isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker()) {
                Session::getInstance()->changeChecker();
                $goldNum = abs((int)$_GET['goldNum']);
                $totalVouchersGold = Voucher::getTotalGoldInVoucher(Session::getInstance()->getEmail());
                if ($goldNum < 20) {
                    $view->vars['errorMsg'] = T("PaymentWizard", "Gold number must be 20 or more");
                } else if ($goldNum > $totalVouchersGold) {
                    $view->vars['errorMsg'] = T("PaymentWizard", "You don`t have enough gold in your bank");
                } else {
                    $email = Session::getInstance()->getEmail();
                    $voucherUsed = Voucher::useSomeGold($goldNum,
                        $email,
                        Session::getInstance()->getPlayerId(),
                        Session::getInstance()->getName());
                    if ($voucherUsed !== FALSE) {
                        Session::getInstance()->data['bought_gold'] += $voucherUsed;
                        $view->vars['errorMsg'] = sprintf(T("PaymentWizard", "%s golds was added to your account"),
                            $voucherUsed);
                        $_REQUEST['goldNum'] = null;
                    } else {
                        $view->vars['errorMsg'] = T("PaymentWizard", "Unable to use voucher");
                    }
                }
            } else if (isset($_GET['voucherCode']) && isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker()) {
                $voucherCode = filter_var(strip_tags(htmlspecialchars($_GET['voucherCode'], ENT_QUOTES)),
                    FILTER_SANITIZE_STRING);
                $voucherDetails = Voucher::getVoucherWithCode($voucherCode, Session::getInstance()->getEmail());
                if ($voucherDetails->num_rows) {
                    $voucherDetails = $voucherDetails->fetch_assoc();
                    if (isset($_GET['action']) && $_GET['action'] == 'use') {
                        Session::getInstance()->changeChecker();
                        $email = Session::getInstance()->getEmail();
                        $voucherUsed = Voucher::useVoucher($voucherDetails['id'],
                            $voucherDetails['voucherCode'],
                            $email,
                            Session::getInstance()->getPlayerId(),
                            Session::getInstance()->getName());
                        if ($voucherUsed !== FALSE) {
                            Session::getInstance()->data['bought_gold'] += $voucherUsed;
                            $view->vars['errorMsg'] = sprintf(T("PaymentWizard", "%s golds was added to your account"),
                                $voucherUsed);
                        }
                        $_REQUEST['voucherCode'] = null;
                    } else {
                        $details = [
                            'id' => $voucherDetails['id'],
                            'gold' => $voucherDetails['gold'],
                            'voucherCode' => $voucherDetails['voucherCode'],
                            'player' => $voucherDetails['player'],
                            'worldId' => $voucherDetails['worldId'],
                            'reason' => T("PaymentWizard", "VoucherReasons.{$voucherDetails['reason']}"),
                            'time' => TimezoneHelper::autoDateString($voucherDetails['time']),
                        ];

                        $view->vars['js'] = 'goldBankUI.useVoucher2(' . json_encode($details) . ');';
                    }
                } else {
                    $view->vars['errorMsg'] = T("PaymentWizard", "Invalid voucher code");
                }
            }
            $view->vars['total_gold'] = Voucher::getTotalGoldInVoucher(Session::getInstance()->getEmail());
            $view->vars['voucherCode'] = isset($_REQUEST['voucherCode']) ? $_REQUEST['voucherCode'] : null;
            $view->vars['goldNum'] = isset($_REQUEST['goldNum']) ? $_REQUEST['goldNum'] : null;
            $this->view->vars['content'] .= $view->output();
        } else if ($selectedTab == 1) {
            $view = new PHPBatchView("voucher/history");
            $vouchers = $this->renderUsedVouchers(isset($_GET['page']) ? abs((int)$_GET['page']) : 1);
            $view->vars['content'] = $vouchers['html'];
            $view->vars['navigator'] = $vouchers['navigator'];
            $this->view->vars['content'] .= $view->output();
        } else if ($selectedTab == 2) {
            $view = new PHPBatchView("voucher/vouchers");
            if (isset($_GET['voucherId']) && isset($_GET['c']) && $_GET['c'] == Session::getInstance()->getChecker()) {
                Session::getInstance()->changeChecker();
                $voucherId = (int)$_GET['voucherId'];
                $voucher = Voucher::getVoucherWithId($voucherId);
                if ($voucher->num_rows) {
                    $voucher = $voucher->fetch_assoc();
                    if (strtolower($voucher['email']) == strtolower(Session::getInstance()->getEmail())) {
                        $voucherCode = $voucher['voucherCode'];
                        $email = Session::getInstance()->getEmail();
                        $voucherUsed = Voucher::useVoucher($voucherId,
                            $voucherCode,
                            $email,
                            Session::getInstance()->getPlayerId(),
                            Session::getInstance()->getName());
                        if ($voucherUsed !== FALSE) {
                            Session::getInstance()->data['bought_gold'] += $voucherUsed;
                            $view->vars['errorMsg'] = sprintf(T("PaymentWizard", "%s golds was added to your account"), $voucherUsed);
                        }
                        $_REQUEST['voucherId'] = null;
                    } else {
                        $view->vars['errorMsg'] = T("PaymentWizard", "Unable to use voucher");
                    }
                } else {
                    $view->vars['errorMsg'] = T("PaymentWizard", "Unable to use voucher");
                }
            }
            $vouchers = $this->renderVouchers(isset($_GET['page']) ? abs((int)$_GET['page']) : 1);
            $view->vars['content'] = $vouchers['html'];
            $view->vars['navigator'] = $vouchers['navigator'];
            $this->view->vars['content'] .= $view->output();
        }
    }

    private function renderUsedVouchers($page)
    {
        $HTML = null;
        $db = GlobalDB::getInstance();
        $x = ($page - 1) * 10;
        $result = $db->query("SELECT * FROM paymentVoucher WHERE used=1 AND email='" . Session::getInstance()->getEmail() . "' ORDER BY usedTime DESC LIMIT " . (($page - 1) * $this->pageSize) . ", {$this->pageSize}");
        while ($row = $result->fetch_assoc()) {
            $HTML .= '<tr>';
            $HTML .= '<td>' . (++$x) . '</td>';
            $HTML .= '<td>' . sprintf('[%s]-%s', $row['id'], $row['worldId']) . '</td>';
            $HTML .= '<td>' . $row['gold'] . ' <img src="img/x.gif" class="gold"></td>';
            $HTML .= '<td>' . T("PaymentWizard", "VoucherReasons.{$row['reason']}") . '</td>';
            $HTML .= '<td>' . TimezoneHelper::autoDateString($row['usedTime']) . '</td>';
            $HTML .= '<td>';
            $voucherDetails = [
                'id' => $row['id'],
                'gold' => $row['gold'],
                'voucherCode' => $row['voucherCode'],
                'worldId' => $row['worldId'],
                'player' => $row['player'],
                'reason' => T("PaymentWizard", "VoucherReasons.{$row['reason']}"),
                'time' => TimezoneHelper::autoDateString($row['time']),
                'usedWorldId' => $row['usedWorldId'],
                'usedPlayer' => $row['usedPlayer'],
                'usedEmail' => $row['usedEmail'],
                'usedTime' => TimezoneHelper::autoDateString($row['usedTime']),
            ];
            $HTML .= '<a class="arrow" id="show" onclick="goldBankUI.showVoucher(' . htmlspecialchars(json_encode($voucherDetails)) . ');">' . T("PaymentWizard",
                    "Show") . '</a>&nbsp;';
            $HTML .= '</td>';
            $HTML .= '</tr>';
        }
        if (!$x) {
            $HTML .= '<tr><td class="noData" colspan="6">' . T("PaymentWizard",
                    "You have no voucher codes") . '</td></tr>';
        }
        $totalSize = (int)$db->fetchScalar("SELECT COUNT(id) FROM paymentVoucher WHERE used=1 AND email='" . $db->real_escape_string(Session::getInstance()->getEmail()) . "'");
        $nav = new PageNavigator($page, $totalSize, $this->pageSize, ['t' => 1], 'voucher.php');
        return [
            'html' => $HTML,
            'navigator' => '
        <div class="footer">
           ' . $nav->get() . '<div class="clear"></div>
        </div>'
        ];
    }

    private function renderVouchers($page)
    {
        $HTML = null;
        $db = GlobalDB::getInstance();
        $x = ($page - 1) * 10;
        $result = $db->query("SELECT * FROM paymentVoucher WHERE used=0 AND email='" . Session::getInstance()->getEmail() . "' ORDER BY time ASC LIMIT " . (($page - 1) * $this->pageSize) . ", {$this->pageSize}");
        while ($row = $result->fetch_assoc()) {
            $HTML .= '<tr>';
            $HTML .= '<td>' . (++$x) . '</td>';
            $HTML .= '<td>' . sprintf('[%s]-%s', $row['id'], $row['worldId']) . '</td>';
            $HTML .= '<td>' . $row['gold'] . ' <img src="img/x.gif" class="gold"></td>';
            $HTML .= '<td>' . T("PaymentWizard", "VoucherReasons.{$row['reason']}") . '</td>';
            $HTML .= '<td>' . TimezoneHelper::autoDateString($row['time']) . '</td>';
            $HTML .= '<td>';
            if (!Session::getInstance()->isSitter()) {
                $voucherDetails = [
                    'id' => $row['id'],
                    'gold' => $row['gold'],
                    'player' => $row['player'],
                    'voucherCode' => $row['voucherCode'],
                    'worldId' => $row['worldId'],
                    'reason' => T("PaymentWizard", "VoucherReasons.{$row['reason']}"),
                    'time' => TimezoneHelper::autoDateString($row['time']),
                ];
                $HTML .= '<a class="arrow" id="show" onclick="goldBankUI.showVoucher(' . htmlspecialchars(json_encode($voucherDetails)) . ');">' . T("PaymentWizard",
                        "Show") . '</a>&nbsp;';
            }
            $HTML .= '<a class="arrow" id="use" onclick="goldBankUI.useVoucher(' . htmlspecialchars(json_encode([
                    'id' => $row['id'],
                    'uid' => Session::getInstance()->getPlayerId()
                ])) . ');">' . T("PaymentWizard", "Use") . '</a></td>';
            $HTML .= '</tr>';
        }
        if (!$x) {
            $HTML .= '<tr><td class="noData" colspan="6">' . T("PaymentWizard",
                    "You have no voucher codes") . '</td></tr>';
        }
        $totalSize = (int)$db->fetchScalar("SELECT COUNT(id) FROM paymentVoucher WHERE used=0 AND email='" . Session::getInstance()->getEmail() . "'");
        $nav = new PageNavigator($page, $totalSize, $this->pageSize, [], 'voucher.php');
        return [
            'html' => $HTML,
            'navigator' => '
        <div class="footer">
           ' . $nav->get() . '<div class="clear"></div>
        </div>'
        ];
    }

    public function transferGold()
    {
        $model = new TransferGoldModel();
        $view = new PHPBatchView('voucher/transfer-gold');
        $view->vars['errors'] = [];
        $view->vars['success'] = null;
        $view->vars['goldAmount'] = isset($_REQUEST['gold_amount']) ? (int)$_REQUEST['gold_amount'] : 30;
        $view->vars['targetPlayer'] = isset($_REQUEST['target_player']) ? $_REQUEST['target_player'] : null;
        $view->vars['fromPlayerEmail'] = isset($_REQUEST['fromPlayerEmail']) ? $_REQUEST['fromPlayerEmail'] : null;

        $recipients = array_unique(array_map("trim", explode(";", $view->vars['targetPlayer'])));
        if (WebService::isPost() && $_REQUEST['c'] == $this->session->getChecker()) {
            if ((time() - $_REQUEST['c2']) > 5) {
                $this->session->changeChecker();
                if($view->vars['fromPlayerEmail'] != $this->session->getEmail()){
                    $view->vars['errors'][] = T("TransferGold", "InvalidAccountEmail");
                } else if ($view->vars['goldAmount'] < 30) {
                    $view->vars['errors'][] = T("TransferGold", "InvalidGoldAmount");
                } else if ($view->vars['goldAmount'] > $this->session->getBoughtGold()) {
                    $view->vars['errors'][] = T("TransferGold", "YouDoNotHaveEnoughGold");
                } else if (!$view->vars['targetPlayer'] || sizeof($recipients) > 1 || sizeof($recipients) == 0) {
                    $view->vars['errors'][] = T("TransferGold", "TargetPlayerUnknown");
                } else {
                    $uid = $model->getPlayerIdByName($recipients[0]);
                    if ($uid > 2) {
                        if (GoldHelper::decreaseGold($this->session->getPlayerId(), $view->vars['goldAmount'])) {

                            $this->session->data['bought_gold'] -= $view->vars['goldAmount'];

                            $cost = ceil($view->vars['goldAmount'] * 0.05);
                            $model->addGold($uid, $view->vars['goldAmount'] - $cost);

                            $view->vars['success'] = sprintf(
                                T("TransferGold", "transfer_success_msg"),
                                $view->vars['goldAmount'],
                                $recipients[0]
                            );

                            $logId = $model->addLog($this->session->getPlayerId(), $uid, $view->vars['goldAmount']);

                            $m = new MessageModel();
                            $m->sendMessage(0, $uid, '', serialize([
                                'logId' => $logId,
                                'amount' => $view->vars['goldAmount'] - $cost,
                            ]), 6);

                        } else {
                            $view->vars['errors'][] = 'Failed to reduce gold.';
                        }
                    } else {
                        $view->vars['errors'][] = T("TransferGold", "TargetPlayerNotFound");
                    }
                }
            }
        }
        $view->vars['recent_transfers'] = [];

        $page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;
        $page_size = 10;

        $transfers = $model->getLogs($this->session->getPlayerId(), $page, $page_size);
        while ($row = $transfers->fetch_assoc()) {
            $view->vars['recent_transfers'][] = [
                'id' => $row['id'],
                'amount' => $row['amount'],
                'to_uid' => $row['to_uid'],
                'player' => $model->getPlayerName($row['to_uid']),
                'date' => TimezoneHelper::autoDateString($row['time'], true, true),
            ];
        }
        $p = new PageNavigator($page, $model->getLogsCount($this->session->getPlayerId()), $page_size, ['t' => 3], 'voucher.php');
        $view->vars['pagination'] = $p->get();
        $view->vars['availableGold'] = $this->session->getBoughtGold();
        $view->vars['checker'] = $this->session->getChecker();
        $this->view->vars['content'] .= $view->output();
    }
}