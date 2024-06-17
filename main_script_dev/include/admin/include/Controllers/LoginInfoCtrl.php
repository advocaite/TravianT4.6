<?php

use Core\Config;
use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;

class LoginInfoCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        $config = Config::getInstance();
        $params['subject'] = isset($_POST['subject']) ? $_POST['subject'] : $config->dynamic->loginInfoTitle;
        $params['message'] = isset($_POST['message']) ? $_POST['message'] : $config->dynamic->loginInfoHTML;
        $params['error'] = null;
        if (WebService::isPost()) {
            if (Session::validateChecker()) {
                $db = DB::getInstance();
                $config->dynamic->loginInfoTitle = $db->real_escape_string($params['subject']);
                $config->dynamic->loginInfoHTML = $db->real_escape_string($params['message']);
                $db->query("UPDATE config SET loginInfoTitle='{$config->dynamic->loginInfoTitle}', loginInfoHTML='{$config->dynamic->loginInfoHTML}'");
                $params['error'] = '-- Saved --';
            }
        } else if (WebService::isPost()) {
            $params['error'] = 'Please fill all inputs.';
        }
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/loginInfo.tpl')->getAsString());
    }
}