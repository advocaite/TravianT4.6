<?php
namespace Controller\Ajax;
use Core\Session;

class getGoldAmount extends AjaxBase
{
    public function dispatch()
    {
        $this->response['data']['goldAmount'] = Session::getInstance()->getAvailableGold();
    }
}