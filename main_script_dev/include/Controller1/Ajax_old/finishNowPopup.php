<?php
namespace Controller\Ajax;

use Core\Config;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Core\Locale;
use resources\View\PHPBatchView;

class finishNowPopup extends AjaxBase
{
    public function dispatch()
    {
        //check if the user is valid or not
        $session = Session::getInstance();
        if(!$session->isValid()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You are not logged in.';
            return;
        }
        $village = Village::getInstance();
        if($village->isWW()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'Complete building is disabled in WW villages.';
            return;
        }
        if(!$session->checkSitterPermission(Session::SITTER_CAN_BUY_OR_SPEND_GOLD)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You don\'t have access to here as a sitter.';
            return;
        }
        //get the language file
        //get the button.
        $x['buildingOrder'] = FALSE;
        $x['academy'] = FALSE;
        $x['smithy'] = FALSE;
        $x['demolish'] = FALSE;
        $totalPossible = 0;
        $totalImPossible = 0;
        if(sizeof($village->onLoadBuildings['normal'])) {
            //load language
            $x['buildingOrder'] = TRUE;
            $tmp = [];
            $x['buildingOrders'] = [];
            foreach($village->onLoadBuildings['normal'] as $onload) {
                //ignore residence and palace here.
                if(!isset($tmp[$onload['building_field']])) {
                    $tmp[$onload['building_field']] = 0;
                }
                $level = $village->getField($onload['building_field'])['level'] + ++$tmp[$onload['building_field']];
                $possible = !($village->getField($onload['building_field'])['item_id'] == 25 || $village->getField($onload['building_field'])['item_id'] == 26);
                if($possible) {
                    $totalPossible++;
                } else {
                    $totalImPossible++;
                }
                $x['buildingOrders'][] = ["itemId" => $village->getField($onload['building_field'])['item_id'], 'lvl' => $level, 'possible' => $possible,];
            }
            $x['buildingOrder'] = sizeof($x['buildingOrders']);
        }
        if($village->getOnDemolishBuildingFieldId()) {
            $x['demolish'] = TRUE;
            $x['demolishs'][] = ["itemId" => $village->getField($village->getOnDemolishBuildingFieldId())['item_id'], 'lvl' => $village->getField($village->getOnDemolishBuildingFieldId())['level'] - 1,];
        }
        $db = DB::getInstance();
        $researching = $db->query("SELECT nr, mode FROM research WHERE kid={$village->getKid()}");
        if($researching->num_rows) {
            $tmp = [];
            while($row = $researching->fetch_assoc()) {
                if($row['mode'] == 1) {
                    $x['academy'] = TRUE;
                    $x['academys'][] = nrToUnitId($row['nr'], $session->getRace());
                } else {
                    if (!isset($tmp[$row['nr']])){
                        $tmp[$row['nr']] = 0;
                    }
                    ++$tmp[$row['nr']];
                    $smithy = $db->query("SELECT * FROM smithy WHERE kid={$village->getKid()}")->fetch_assoc();
                    $x['smithy'] = TRUE;
                    $x['smithys'][] = ["unitId" => nrToUnitId($row['nr'], $session->getRace()), "lvl" => $tmp[$row['nr']] + $smithy['u' . $row['nr']],];
                }
            }
        }
        $buttonDisabled = FALSE;
        if(!$x['demolish'] && !$x['academy'] && !$x['smithy']) {
            $buttonDisabled = $totalPossible == 0;
        }
        if($buttonDisabled) {
            $data = ["value" => T("finishNowPopup", "Redeem"), 'name' => '', "class" => "gold disabled", "title" => T("finishNowPopup", "No construction orders or research that could be completed instantly"), "confirm" => "", "onclick" => "if($(this).hasClass(\\u0027disabled\\u0027)){(new DOMEvent(event)).stop(); return false;} else {}", "onFocus" => "jQuery(\\u0027button\\u0027, \\u0027input[type!=hidden]\\u0027, \\u0027select\\u0027).set(\\u0027focus\\u0027, true); (new DOMEvent(event)).stop(); return false;",];
        } else {
            $data = ["value" => T("finishNowPopup", "Redeem"), 'name' => '', "class" => "gold ", "confirm" => "", "onclick" => "", "wayOfPayment" => ["featureKey" => "finishNow", "context" => "finishNow",],];
        }
        $x['button'] = getButton(["type" => "submit", "value" => T("finishNowPopup", "Redeem"), "class" => "gold " . ($buttonDisabled ? 'disabled' : ''), "title" => $buttonDisabled ? T("finishNowPopup", "No construction orders or research that could be completed instantly") : T("finishNowPopup", "title"), "coins" => Config::getInstance()->gold->finishNowGold,], ['data' => $data], T("finishNowPopup", "Redeem"));
        $this->response['data']['html'] = PHPBatchView::render('ajax/finishNowPopup', $x);
    }
}