<?php
namespace Controller\Ajax;

use Core\PackageCode;
use Core\Session;
use const FILTER_SANITIZE_STRING;
use function getDisplay;
use function isServerFinished;

class redeemCode extends AjaxBase
{
    const LIMIT_TIME = 1200;
    public function dispatch()
    {
        $session = Session::getInstance();
        $tries = $session->get("pkgCodeTries");
        $lastTry = $session->get("lastPkgCodeTry");
        if(!isset($_SESSION['lastEnteredRedeemCode']) || !is_array($_SESSION['lastEnteredRedeemCode'])){
            $_SESSION['lastEnteredRedeemCode'] = [];
        }
        if((time() - $lastTry) > self::LIMIT_TIME){
            $session->updatePackageCodeTry(true);
            $_SESSION['lastEnteredRedeemCode'] = [];
            $lastTry = 0;
            $tries = 0;
        }
        $this->response['data']['result'] = false;
        $this->response['data']['errorMsg'] = 'invalidCode';
        if($tries >= 5){
            $this->response['data']['errorMsg'] = 'tooManyTries';
            return;
        }
        if(isServerFinished()) {
            $this->response['data']['errorMsg'] = 'unknownError';
            return;
        }
        if(isset($_POST['redeemCode'])){
            $redeemCode = filter_var(trim($_POST['redeemCode']), FILTER_SANITIZE_STRING);
            if(!PackageCode::doesCodeExists($redeemCode)){
                $this->response['data']['errorMsg'] = 'invalidCode';
            } else if(PackageCode::isCodeUsed($redeemCode)){
                $this->response['data']['errorMsg'] = 'codeIsUsed';
            } else if(PackageCode::useCode($session->getPlayerId(), $session->getName(), $session->getEmail(), $redeemCode)){
                $this->response['data']['result'] = true;
                unset($this->response['data']['errorMsg']);
            } else {
                $this->response['data']['errorMsg'] = 'unknownError';
            }
            if(!$this->response['data']['result'] && !empty($redeemCode) && !in_array($redeemCode, $_SESSION['lastEnteredRedeemCode'])){
                Session::getInstance()->changeAjaxToken();
                $this->response['data']['functionToCall'] = 'reloadUrl';
                $session->updatePackageCodeTry();
                $_SESSION['lastEnteredRedeemCode'][] = $redeemCode;
            }
        }
    }
}