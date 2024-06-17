<?php
namespace Controller\Ajax;
use resources\View\PHPBatchView;

class donationLimitBar extends AjaxBase
{
    public function dispatch()
    {
        $this->response['data']['limitBar'] = PHPBatchView::render("alliance/bonuses/myDailyContributionLimit");
    }
}