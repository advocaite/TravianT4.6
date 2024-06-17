<?php

namespace Controller;

use Core\Database\DB;
use Core\Session;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;
use const FILTER_SANITIZE_STRING;

class EmailVerificationUrlCtrl extends OutOfGameCtrl
{
    private $db, $model;

    public function __construct()
    {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new \Model\EmailVerification();
        $this->view = new OutOfGameView();
        $this->view->vars['titleInHeader'] = T("EVerify", "Email verification");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'activate';
        $view = new PHPBatchView("verify/verify-url");
        if (!isset($_GET['code']) || empty($_GET['code'])) {
            $view->vars['codeEmpty'] = true;
        } else {
            list($verifyId, $verifyCode) = explode("-", filter_var(trim($_GET['code']), FILTER_SANITIZE_STRING));
            $result = $this->model->getVerificationById((int)$verifyId);
            if ($result->num_rows) {
                $row = $result->fetch_assoc();
                if ($row['activationCode'] != $verifyCode) {
                    $view->vars['invalidCode'] = true;
                } else {
                    if ($this->model->emailExists($row['email'])) {
                        $view->vars['emailExists'] = true;
                    } else if ($this->model->emailBlackListed($row['email'])) {
                        $view->vars['emailBlacklisted'] = true;
                    } else {
                        $this->model->removeVerificationById($row['id']);
                        $this->model->setEmailAsVerified($row['uid'], $row['email']);
                        $view->vars['success'] = true;
                    }
                }
            } else {
                $view->vars['notFound'] = true;
            }
        }
        $this->view->vars['content'] .= $view->output();
    }
}