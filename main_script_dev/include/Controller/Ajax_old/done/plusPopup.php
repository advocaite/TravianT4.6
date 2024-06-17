<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Session;
use Game\GoldHelper;
use Core\Locale;
class plusPopup extends AjaxBase
{
    public function dispatch()
    {
        $helper = new GoldHelper();
        $this->response['data'] = ['title' => T("plusPopup", "title"), 'gold' => T("inGame", "goldShort") . ': <img src="img/x.gif" class="gold" alt="' . T("inGame", "goldShort") . '"/> <span class="bold">' . (getCustom("serverIsFreeGold") ? T("Global", "Unlimited") : Session::getInstance()->getGold()) . '</span>', 'subHeadLine' => T("plusPopup", "subHeadLine"), 'goldButton' => $helper->getPlusButton(), 'buttonSubtitle' => T("plusPopup", "Bonus duration in days:") . ' <span class="bold">' . $this->getTime(Config::getInstance()->gold->plusAccountDurationSeconds) . '</span>', 'plusPopupButtonExtraFeatures' => T("plusPopup", "plusPopupButtonExtraFeatures"), 'features' => T("plusPopup", "features"), 'furtherInfos' => sprintf(T("plusPopup", "furtherInfos"), $this->getTime(Config::getInstance()->gold->plusAccountDurationSeconds)),];
    }

    function getTime($time)
    {
        if($time >= 86400) {
            return '<span class="bold">' . round($time / 86400, 1) . '</span> ' . T("PaymentWizard", "Days");
        }
        return '<span class="bold">' . round($time / 3600, 1) . '</span> ' . T("PaymentWizard", "hour");
    }
}