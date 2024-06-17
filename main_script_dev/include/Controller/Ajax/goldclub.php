<?php
namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Game\GoldHelper;
use function getCustom;
use resources\View\PHPBatchView;

class goldclub extends AjaxBase
{
	
	public function dispatch()
    { 
		$this->response = array();
		$view = new PHPBatchView("ajax/goldClub");
        $helper = new GoldHelper();
        $view->vars['gold'] = (getCustom("serverIsFreeGold") ? T("Global", "Unlimited") : Session::getInstance()->getAvailableGold());
        $view->vars['subHeadLine'] = T("goldClubPopup", "In order to use this feature, you need to activate the Gold club!");
        $view->vars['goldclubPopupButtonExtraFeatures'] = T("goldClubPopup", "Additionally, you will have access to the following features:");
        $view->vars['buttonSubtitle'] = T("goldClubPopup", "Bonus duration") . ': <b>' . T("goldClubPopup", "whole game round") . '</b>';
        $view->vars['goldButton'] = $helper->getGoldClubButton();
        $view->vars['features']['troopEscape'] = T("goldClubPopup", "troopEscape");
        $view->vars['features']['raidList'] = T("goldClubPopup", "raidList");
        $view->vars['features']['tradeThreeTimes'] = T("goldClubPopup", "tradeThreeTimes");
        $view->vars['features']['tradeRoute'] = T("goldClubPopup", "tradeRoute");
        $view->vars['features']['cropFinder'] = T("goldClubPopup", "cropFinder");
        $view->vars['features']['messageArchive'] = T("goldClubPopup", "messageArchive");
        $view->vars['furtherInfos'] = T("goldClubPopup", "furtherInfos");
		$view->vars['title'] = T("goldClubPopup", "title");
		$this->response['title'] = T("goldClubPopup", "title");
		$this->response['html'] = $view->output();
	}
} 
?>
