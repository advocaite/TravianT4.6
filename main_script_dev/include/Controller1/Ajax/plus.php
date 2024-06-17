<?php
namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Game\GoldHelper;
use function getCustom;
use resources\View\PHPBatchView;

class plus extends AjaxBase
{
	
	public function dispatch()
    { 
		$this->response = array();
		$view = new PHPBatchView("ajax/plusPopup");
        $helper = new GoldHelper();
        $view->vars['gold'] = (getCustom("serverIsFreeGold") ? T("Global", "Unlimited") : Session::getInstance()->getAvailableGold());
        
		$view->vars['subHeadLine'] = T("plusPopup", "subHeadLine");
        $view->vars['plusPopupButtonExtraFeatures'] = T("plusPopup", "plusPopupButtonExtraFeatures");
        $view->vars['buttonSubtitle'] = T("plusPopup", "Bonus duration in days:") . ' <span class="bold">' . $this->getTime(Config::getInstance()->gold->plusAccountDurationSeconds) . '</span>';
        $view->vars['goldButton'] = $helper->getPlusButton();
        $view->vars['features'] = T("plusPopup", "features");
		$view->vars['furtherInfos'] = sprintf(T("plusPopup", "furtherInfos"),$this->getTime(Config::getInstance()->gold->plusAccountDurationSeconds));
		$view->vars['title'] = T("plusPopup", "title");		
		$this->response['title'] = T("plusPopup", "title");
		$this->response['html'] = $view->output();
	}

    function getTime($time)
    {
        if($time >= 86400) {
            return '<span class="bold">' . round($time / 86400, 1) . '</span> ' . T("PaymentWizard", "Days");
        }
        return '<span class="bold">' . round($time / 3600, 1) . '</span> ' . T("PaymentWizard", "hour");
    }
}
?>
