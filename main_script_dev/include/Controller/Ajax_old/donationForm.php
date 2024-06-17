<?php
namespace Controller\Ajax;
use resources\View\PHPBatchView;
class donationForm extends AjaxBase
{
    public function dispatch()
    {
        $this->response['data']['form'] = PHPBatchView::render("alliance/bonuses/donateForm");
    }
}