<?php

namespace Controller;

use Core\Session;
use const DIRECTORY_SEPARATOR;

function response($response)
{
    header("Content-Type: application/json; charset=UTF-8;");
    $response = json_encode($response, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_QUOT);
    echo $response;
    exit(0);
}



class AjaxCtrl extends AnyCtrl
{
    public function __construct()
    {
        parent::__construct();
        $response = ["response" => ['error' => FALSE, 'errorMsg' => NULL, 'data' => [],],];
        if (isset($_GET['cmd'])) {
            $cmd = filter_var($_GET['cmd'], FILTER_SANITIZE_STRING);
            $response = ["response" => ['error' => FALSE, 'errorMsg' => NULL, 'data' => [],],];
            if (!in_array($cmd, ['news', 'configuration'])) {
                $this->checkAjaxToken($response);
            }
            if (!file_exists(__DIR__ . DIRECTORY_SEPARATOR . "Ajax" . DIRECTORY_SEPARATOR . $cmd . ".php")) {
                $response['response']['error'] = TRUE;
                $response['response']['errorMsg'] = "Parameter \"$cmd\" (ajax.php) is not valid in \"cmd\".";
                $response['response']['data'] = [];
                response($response);
            }
            $cmd = '\\Controller\\Ajax\\' . $cmd;
            $dispatcher = new $cmd($response['response']);
            if (method_exists($dispatcher, "dispatch")) {
                $dispatcher->dispatch();
            }
            response($response);
        } else {
            $response['response']['error'] = TRUE;
            $response['response']['errorMsg'] = "Parameter \"cmd\" can not be empty or null.";
            $response['response']['data'] = [];
            response($response);
        }
    }
    function checkAjaxToken(&$response)
    {
        return true;
        if (!isset($_POST['ajaxToken']) || filter_var($_POST['ajaxToken'],
                FILTER_SANITIZE_STRING) != $this->session->getAjaxToken()) {
            $response['ajaxToken'] = NULL;
            $response['response']['error'] = TRUE;
            $response['response']['errorMsg'] = 'Invalid token.';
            response($response);
        }
        return TRUE;
    }
}