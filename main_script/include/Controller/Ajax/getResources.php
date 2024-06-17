<?php

namespace Controller\Ajax;

use Core\Village;

class getResources extends AjaxBase
{
    public function dispatch()
    {
        $resources = Village::getInstance()->getCurrentResources(-1, false);
        $this->response['data'] = [
            'l1' => $resources[0],
            'l2' => $resources[1],
            'l3' => $resources[2],
            'l4' => $resources[3],
        ];
    }
} 