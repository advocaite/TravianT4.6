<?php
namespace Controller\Ajax;
use Controller\HeroAuctionCtrl;
class heroAuctionContent extends AjaxBase
{
    public function dispatch()
    {
        $view = new HeroAuctionCtrl(true);
        $this->response['data']['html'] = $view->returnContent();
    }
}