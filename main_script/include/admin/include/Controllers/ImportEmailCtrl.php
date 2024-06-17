<?php

use Core\Database\GlobalDB;
use Core\Helper\Notification;
use Core\Helper\WebService;
use Core\Session;

class ImportEmailCtrl
{
    public function __construct()
    {
        $params['newsletterType'] = 'normal';
        $params['html'] = isset($_POST['html']) ? $_POST['html'] : null;
        $params['result'] = false;
        if(!isServerFinished() && WebService::isPost() && Session::validateChecker()){
            $batchAdd = [];
            foreach(explode(PHP_EOL, $params['html']) as $email){
                $email = trim($email);
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $key = substr(sha1(time() . $email), 0, 11);
                    $batchAdd[] = sprintf("('%s', '%s')", trim($email), $key);
                }
            }
            $db = GlobalDB::getInstance();
            $db->query("INSERT IGNORE INTO `newsletter` (`email`, `private_key`) VALUES " . implode(",", $batchAdd));
            $params['result'] = sizeof($batchAdd);
            $batchAdd = null;
            Notification::notify("Emails added", "{$params['result']} added to newsletter.");
        }
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/importEmail.tpl')->getAsString());
    }
}