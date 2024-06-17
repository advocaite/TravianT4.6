<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\EmailVerification;
use const FILTER_SANITIZE_EMAIL;
use const FILTER_SANITIZE_STRING;

class verify extends AjaxBase
{
    /** @var \Model\EmailVerification */
    private $model;

    public function dispatch()
    {
        $this->model = new \Model\EmailVerification();
        if (EmailVerification::isEmailVerified()) return;
        if (isset($_REQUEST['action'])) {
            switch ($_REQUEST['action']) {
                case 'newProgress':
                    $this->newProgress();
                    break;
                case 'verify':
                    $this->verify();
                    break;
            }
        }
    }

    private function newProgress()
    {
        $db = DB::getInstance();
        if ($this->model->isVerificationInProgress(Session::getInstance()->getPlayerId())) {
            $this->setError("alreadyInProgress");
            return;
        }
        if (!recaptcha_check_answer()) {
            $this->setError("invalidCaptcha");
            return;
        }
        if (isset($_REQUEST['email'])) {
            $email = $db->real_escape_string(filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL));
            if (empty($email)) {
                $this->setError("emptyEmail");
            } else if (filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE) {
                if (($error = $this->checkEmail($email)) !== TRUE) {
                    $this->setError($error);
                    return;
                }
                EmailVerification::sendVerificationEmail(Session::getInstance()->getPlayerId(), $email);
                $this->response['data']['verifyResult'] = true;
            } else {
                $this->setError("invalidEmail");
            }
        } else {
            $this->setError("emptyEmail");
        }
    }

    private function setError($err)
    {
        $this->response['data']['verifyResult'] = false;
        $this->response['data']['verifyError'] = $err;
    }

    public function checkEmail($email)
    {
        if ($this->model->emailExists($email)) {
            return 'emailAlreadyExists';
        }
        if ($this->model->emailBlackListed($email)) {
            return 'emailBlacklisted';
        }
        return true;
    }

    private function verify()
    {
        $db = DB::getInstance();
        if (!$this->model->isVerificationInProgress(Session::getInstance()->getPlayerId())) {
            $this->setError("noVerificationInProgress");
            return;
        }
        if (isset($_REQUEST['code'])) {
            $code = filter_var($_REQUEST['code'], FILTER_SANITIZE_STRING);
            if (empty($code)) {
                $this->setError("emptyCode");
            } else {
                $code = explode("-", $code);
                if (sizeof($code) <> 2) {
                    $this->setError("invalidCode");
                } else {
                    list($verifyId, $verifyCode) = $code;
                    $verificationRow = $this->model->getVerificationById((int)$verifyId);
                    if ($verificationRow->num_rows) {
                        $verificationRow = $verificationRow->fetch_assoc();
                        if ($verificationRow['uid'] == Session::getInstance()->getPlayerId()) {
                            if (strtolower($verificationRow['activationCode']) == strtolower($verifyCode)) {
                                $this->model->removeVerificationById($verificationRow['id']);
                                $email = $db->real_escape_string(filter_var($verificationRow['email'], FILTER_SANITIZE_EMAIL));
                                if (($error = $this->checkEmail($email)) !== TRUE) {
                                    $this->setError($error);
                                    return;
                                }
                                $this->model->setEmailAsVerified($verificationRow['uid'], $email);
                                $this->response['data']['verifyResult'] = true;
                            } else {
                                $this->setError("invalidCode");
                            }
                        } else {
                            $this->setError("invalidCode");
                        }
                    } else {
                        $this->setError("invalidCode");
                    }
                }
            }
        } else {
            $this->setError("emptyCode");
        }
    }
}