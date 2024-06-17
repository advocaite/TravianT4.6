<?php
namespace Controller\Ajax;
use Core\Village;
use Model\MarketModel;
class toggleTradeRoutes extends AjaxBase
{
    public function dispatch()
    {
        $m = new MarketModel();
        $m->toggleTradeRoute(Village::getInstance()->getKid(), (int)$_POST['routeId'], (int)$_POST['enabled']);
    }
} 