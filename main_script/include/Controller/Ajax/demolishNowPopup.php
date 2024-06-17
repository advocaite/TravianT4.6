<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Session;
use Core\Village;
use resources\View\PHPBatchView;
class demolishNowPopup extends AjaxBase
{
    public function dispatch()
    {
        //check if the user is valid or not
        $session = Session::getInstance();
        if(!$session->isValid()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You are not logged in.';

            return TRUE;
        }
        $village = Village::getInstance();
        if($village->isWW() && !getGame('allowDemolishNowInWW')) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'Complete demolish is disabled in WW villages.';
            return FALSE;
        }
        if(!$session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You don\'t have access to here as a sitter.';

            return FALSE;
        }
        if($village->getOnDemolishBuildingFieldId()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'A demolition is already running.';

            return FALSE;
        }
        //get the language file
        //get the button.
        $x['button'] = getButton(["type" => "submit", "value" => T("demolishNowPopup", "Redeem"), "class" => "gold ", "title" => T("demolishNowPopup", "desc"), "coins" => Config::getInstance()->gold->completeDemolishGold,], ['data' => ["value" => T("demolishNowPopup", "Redeem"), 'name' => '', "class" => "gold ", "confirm" => "", "onclick" => "", "wayOfPayment" => ["featureKey" => "demolishNow", "context" => "demolishNow", "dataCallback" => "getGid",],],], T("demolishNowPopup", "Redeem"));
        $this->response['data']['html'] = PHPBatchView::render('ajax/demolishNowPopup', $x);
    }
}