<?php

namespace Controller\Ajax;

use Core\Session;
use function http_response_code;

abstract class AjaxBase
{
    protected $response;
    protected $session;

    public function __construct(&$response)
    {
        $this->response =& $response;
        $this->session = Session::getInstance();
    }

    abstract function dispatch();

    protected function error($errorMsg, $status = 400)
    {
        http_response_code($status);
        $this->response['error'] = true;
        $this->response['errorMsg'] = $errorMsg;
        return true;
    }
}