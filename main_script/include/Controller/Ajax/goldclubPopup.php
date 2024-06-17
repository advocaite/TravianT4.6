<?php
namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Game\GoldHelper;
use function getCustom;

class goldclubPopup extends AjaxBase
{
    public function dispatch()
    {
        $helper = new GoldHelper();
        $this->response['data']['title'] = T("goldClubPopup", "title");
        $this->response['data']['gold'] = T("goldClubPopup", "gold") . ': <img src="img\/x.gif" class="gold" alt="' . T("goldClubPopup", "gold") . '" /> <span class="bold">' . (getCustom("serverIsFreeGold") ? T("Global", "Unlimited") : Session::getInstance()->getAvailableGold()) . '</span>';
        $this->response['data']['subHeadLine'] = T("goldClubPopup", "In order to use this feature, you need to activate the Gold club!");
        $this->response['data']['goldButton'] = $helper->getGoldClubButton();
        $this->response['data']['buttonSubtitle'] = T("goldClubPopup", "Bonus duration") . ': <b>' . T("goldClubPopup", "whole game round") . '</br>';
        $this->response['data']['goldclubPopupButtonExtraFeatures'] = T("goldClubPopup", "Additionally, you will have access to the following features:");
        $this->response['data']['features']['troopEscape'] = T("goldClubPopup", "troopEscape");
        $this->response['data']['features']['raidList'] = T("goldClubPopup", "raidList");
        $this->response['data']['features']['tradeThreeTimes'] = T("goldClubPopup", "tradeThreeTimes");
        $this->response['data']['features']['cropFinder'] = T("goldClubPopup", "cropFinder");
        $this->response['data']['features']['messageArchive'] = T("goldClubPopup", "messageArchive");
        $this->response['data']['furtherInfos'] = T("goldClubPopup", "furtherInfos");
    }
} 