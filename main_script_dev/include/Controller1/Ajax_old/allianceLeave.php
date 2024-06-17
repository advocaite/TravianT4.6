<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Model\AllianceModel;
use resources\View\PHPBatchView;

class allianceLeave extends AjaxBase
{
    public function dispatch()
    {
        if (!Session::getInstance()->isValid() || !Session::getInstance()->getAllianceId()) {
            return;
        }
        if(Session::getInstance()->banned()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
        } else if(Config::getInstance()->dynamic->serverFinished) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
        } else if(Session::getInstance()->isInVacationMode()) {
            $this->response['redirectTo'] = 'options.php?s=4';
            return;
        }
        if (isset($_REQUEST['allianceId'])) {
            if (isset($_REQUEST['action'])) {
                if ($_REQUEST['action'] == 'popup') {
                    $view = new PHPBatchView("ajax/allianceLeaveCheck");
                    $view->vars['aid'] = Session::getInstance()->getAllianceId();
                    $this->response['data']['html'] = $view->output();
                } else if ($_REQUEST['action'] == 'leave') {
                    if (isset($_REQUEST['pass'])) {
                        if (sha1($_REQUEST['pass']) == $_SESSION[Session::getInstance()->fixSessionPrefix('pw')]) {
                            $m = new AllianceModel();
                            $m->leaveAlliance(Session::getInstance()->getPlayerId(), Session::getInstance()->getAllianceId());
                            $this->response['reload'] = true;
                        } else {
                            $this->response['error'] = true;
                            $this->response['errorMsg'] = T("Embassy", "The password is wrong");
                            $view = new PHPBatchView("ajax/allianceLeaveCheck");
                            $view->vars['aid'] = Session::getInstance()->getAllianceId();
                            $view->vars['passwordIsWrong'] = true;
                            $this->response['data']['html'] = $view->output();
                        }
                    }
                }
            }
        }
    }
}
