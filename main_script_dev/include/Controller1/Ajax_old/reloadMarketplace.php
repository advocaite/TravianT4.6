<?php

namespace Controller\Ajax;

use Core\Session;
use Core\Village;
use Game\AllianceBonus\AllianceBonus;
use Game\Formulas;
use Core\Locale;
use Model\MarketModel;

class reloadMarketplace extends AjaxBase
{
    public function dispatch()
    {
        if (!Village::getInstance()->hasMarketPlace()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = "Abuse! There's no marketplace in village!";
            return;
        }
        $merchantsOnTheWay = '';
        $m = new MarketModel();
        $return = $m->getReturningMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $merchantsOnTheWay .= '<h4 class="spacer">' . T("MarketPlace", "onReturnMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $merchantsOnTheWay .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $return = $m->getIncomingMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $merchantsOnTheWay .= '<h4 class="spacer">' . T("MarketPlace", "onComingMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $merchantsOnTheWay .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $return = $m->getOutGoingMerchants(Village::getInstance()->getKid());
        if ($return->num_rows) {
            $merchantsOnTheWay .= '<h4 class="spacer">' . T("MarketPlace", "onGoingMerchants") . ':</h4>';
            while ($row = $return->fetch_assoc()) {
                $merchantsOnTheWay .= $m->renderMovement(Village::getInstance()->getKid(), $row);
            }
        }
        $resources = Village::getInstance()->getCurrentResources(-1, TRUE);
        $session = Session::getInstance();
        $alliance_bonus = 1;
        if ($session->getAllianceId() > 0) {
            $alliance_bonus = AllianceBonus::getTradersBonus($session->getAllianceId(),
                $session->getAllianceJoinTime());
        }
        $merchant_cap = Formulas::merchantCAP(Session::getInstance()->getRace(),
            max(Village::getInstance()->getTypeLevel(28)),
            $alliance_bonus);
        $this->response['data'] = array_merge($this->response['data'],
            [
                "merchantsAvailable" => Village::getInstance()->hasMarketPlace() - $m->getOnTheWayMerchantsCount(Session::getInstance()->getKid(),
                        $merchant_cap) - $m->getOfferingMerchantsCount(Session::getInstance()->getKid(), $merchant_cap),
                "merchantsOnTheWay" => $merchantsOnTheWay,
                "storage" => [
                    "l1" => $resources[0],
                    "l2" => $resources[1],
                    "l3" => $resources[2],
                    "l4" => $resources[3],
                ],
            ]);
    }
} 