<?php
namespace Controller\Ajax;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Database\ServerDB;
use Core\Helper\TimezoneHelper;
use Core\Session;
use resources\View\PHPBatchView;
class paymentWizardAdvertisedPersons extends AjaxBase
{
    public function dispatch()
    {
        $memcache = Caching::getInstance();
        $result = $memcache->get("paymentWizardAdvertisedPersons" . Session::getInstance()->getPlayerId());
        if($result) {
            $this->response['data']['html'] = $result;
            return;
        }
        $view = new PHPBatchView("payment/paymentWizardAdvertisedPersons");
        $view->vars['content'] = '';
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM player_references WHERE rewardGiven!=2 AND ref_uid=" . Session::getInstance()->getPlayerId());
        $x = 0;
        while($row = $result->fetch_assoc()) {
            ++$x;
            $info = $db->query("SELECT id, signupTime, total_pop, total_villages FROM users WHERE id={$row['uid']}");
            if($info->num_rows) {
                $info = $info->fetch_assoc();
                $info['worldId'] = Config::getInstance()->settings->worldId;
            } else {
                --$x;
                $db->query("DELETE FROM player_references WHERE id={$row['id']}");
                continue;
            }
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= '<td>' . $info['worldId'] . '</td>';
            $view->vars['content'] .= '<td>' . $info['id'] . '</td>';
            $view->vars['content'] .= '<td>' . TimezoneHelper::autoDate($info['signupTime']) . '</td>';
            $view->vars['content'] .= '<td>' . $info['total_pop'] . '</td>';
            $view->vars['content'] .= '<td>' . $info['total_villages'] . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if(!$x) {
            $view->vars['content'] .= '<tr><td class="noData" colspan="5">' . T("PaymentWizard", "No saved golds") . '</td></tr>';
        }
        $this->response['data']['html'] = $view->output();
        $memcache->add("paymentWizardAdvertisedPersons" . Session::getInstance()->getPlayerId(), $this->response['data']['html'], 5 * 60);
    }
}