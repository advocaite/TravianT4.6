<?php
namespace Controller\Ajax;
use Game\Formulas;

class mapLowRes extends AjaxBase
{
    public function dispatch()
    {
        $map = \Game\Map\MapLowRes::render(Formulas::coordinateFixer($_POST['data']['x']), Formulas::coordinateFixer($_POST['data']['y']), floor($_POST['data']['width'] / 60), floor($_POST['data']['height'] / 60));
        $this->response['data']['html'] = $map['HTML'];
        $this->response['data']['isCache'] = $map['isCache'];
    }
}