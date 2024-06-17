<?php

use Core\Helper\WebService;
use Model\AuctionModel;

class HeroAuctionCtrl
{
    public function __construct()
    {
        $result = false;
        if (!isServerFinished() && WebService::isPost()) {
            list($btype, $type) = explode(":", $_POST['item']);
            $package_amount = abs((int)$_POST['package_amount']);
            $repeat = abs((int)$_POST['repeat']);
            $time = abs((int)$_POST['time']);
            $silver = abs((int)$_POST['silver']);
            if ($time > 60 && $time < 86400) {
                $m = new AuctionModel();
                for ($i = 1; $i <= $repeat; ++$i) {
                    $m->addAuction(false, 0, $btype, $type, $package_amount, time() + $time, $silver);
                    $result = true;
                }
            }
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load(['result' => $result],
            'tpl/heroAuctionAdd.tpl')->getAsString());
    }
}