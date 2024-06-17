<?php
namespace Controller\Ajax;
use function appendTimer;
use Core\Config;
use Core\Helper\TimezoneHelper;
use Core\Session;
use Game\GoldHelper;
use Core\Locale;
use Model\AutoExtendModel;

class productionBoostPopup extends AjaxBase
{
    public function dispatch()
    {
        $session = Session::getInstance();
        if(!$session->isValid()) {
            return NULL;
        }
        $helper = new GoldHelper();
        $subtitles = [1 => '', '', '', ''];
        $subtitleClassExtension = [1 => '', '', '', ''];
        for($i = 1; $i <= 4; ++$i) {
            $this->getProductionBoostEnd($i, $subtitles, $subtitleClassExtension);
        }
        $this->response['data'] = ['title' => T('productionBoostPopup', 'Production bonus'), 'gold' => T("inGame", "goldShort") . ': <img src="img/x.gif" class="gold" alt="' . T("inGame", "goldShort") . '"/> <span class="bold">' . $session->getGold() . '</span>', 'productionBoostChooseText' => T("productionBoostPopup", "Select which resources production you would like to increase:"), 'features' => ['productionBoostWood' => ['title' => T("productionBoostPopup", "+25%‎ lumber production"), 'subtitle' => $subtitles[1], 'subtitleClassExtension' => $subtitleClassExtension[1], 'button' => $helper->getProductionBoostButton(1), 'buttonSubtitle' => $this->getAutoExtendSubtitle(1),], 'productionBoostClay' => ['title' => T("productionBoostPopup", "+25%‎ clay production"), 'subtitle' => $subtitles[2], 'subtitleClassExtension' => $subtitleClassExtension[2], 'button' => $helper->getProductionBoostButton(2), 'buttonSubtitle' => $this->getAutoExtendSubtitle(2),], 'productionBoostIron' => ['title' => T("productionBoostPopup", "+25%‎ iron production"), 'subtitle' => $subtitles[3], 'subtitleClassExtension' => $subtitleClassExtension[3], 'button' => $helper->getProductionBoostButton(3), 'buttonSubtitle' => $this->getAutoExtendSubtitle(3),], 'productionBoostCrop' => ['title' => T("productionBoostPopup", "+25%‎ crop production"), 'subtitle' => $subtitles[4], 'subtitleClassExtension' => $subtitleClassExtension[4], 'button' => $helper->getProductionBoostButton(4), 'buttonSubtitle' => $this->getAutoExtendSubtitle(4),],], 'furtherInfos' => sprintf(T("productionBoostPopup", "furtherInfos"), $this->getTime(Config::getInstance()->gold->productionBoostDurationSeconds)),];
    }

    function getTime($time)
    {
        if($time >= 86400) {
            return '<span class="bold">' . round($time / 86400, 1) . '</span> ' . T("PaymentWizard", "Days");
        }
        return '<span class="bold">' . round($time / 3600, 1) . '</span> ' . T("PaymentWizard", "hour");
    }

    private function getProductionBoostEnd($resourceId, &$subtitles, &$subtitleClassExtension)
    {
        $session = Session::getInstance();
        if(!$session->hasProductionBoost($resourceId)) {
            $subtitles[$resourceId] = '';
            $subtitleClassExtension[$resourceId] = $this->getClass($resourceId);
            return;
        }
        if(($session->productionBoostTill($resourceId) - time()) > 86400) {
            $subtitles[$resourceId] = sprintf(T("inGame", "productionBoost.remainingTime"), round(($session->productionBoostTill($resourceId) - time()) / 86400, 1), TimezoneHelper::date('H:i:s', $session->productionBoostTill($resourceId)));
            $subtitleClassExtension[$resourceId] = '';
        } else {
            $subtitles[$resourceId] = sprintf(T("PaymentWizard", "EndsAtX"), appendTimer($session->productionBoostTill($resourceId)-time()));
            $subtitleClassExtension[$resourceId] = $this->getClass($resourceId);
        }
    }

    private function getClass($resourceId)
    {
        $m = new AutoExtendModel();
        $session = Session::getInstance();
        return  $m->hasAutoExtend($session->getPlayerId(), $resourceId+1) ? 'renewalActive' : 'bonusEndsSoon';
    }

    private function getAutoExtendSubtitle($resourceId)
    {
        $session = Session::getInstance();
        $m = new AutoExtendModel();
        if($session->hasProductionBoost($resourceId)) {
            $index = [1 => 'Wood', 'Clay', 'Iron', 'Crop'][$resourceId];
            $subtitle = T("PaymentWizard", "Extend automatically");
            $checked = $m->hasAutoExtend($session->getPlayerId(), $resourceId+1) ? 'checked="checked"' : '';
            return <<<HTML_ENTITIES
<input type="checkbox" id="productionboost{$index}"
		       name="productionboost{$index}[]"
		       class="enumerableElements check checkbox prolongProductionboost{$index}"
		       style="" $checked
		       value="1" title="">
		<label for="productionboost{$index}"
		       class="enumerableElementsCheckboxLabel prolongProductionboost{$index}"
		       style="">{$subtitle}</label>
HTML_ENTITIES;
        }
        return T("productionBoostPopup", "Bonus duration in days:") . $this->getTime(Config::getInstance()->gold->productionBoostDurationSeconds);
    }
}