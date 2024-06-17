<?php
namespace Controller\Ajax;

use resources\View\PHPBatchView;

class convertGoldPopup extends AjaxBase
{
    public function dispatch()
    {
        $view = new PHPBatchView("ajax/convertGoldPopup");
        $view->vars['goldAmount'] = (int)$_POST['goldAmount'];
        $view->vars['silverAmount'] = (int)$_POST['goldAmount'] * 100;
        $this->response['data']['html'] = $view->output();
    }
}