<?php

use Core\Helper\WebService;
use Core\Session;

class BlackListEmailCtrl
{
    public function __construct()
    {
        $params = [
            'emails' => isset($_POST['emails']) ? trim(filter_var($_POST['emails'])) : null
        ];
        $globalDB = \Core\Database\GlobalDB::getInstance();
        if(!isServerFinished() && WebService::isPost() && Session::validateChecker()){
            if(!empty($params['emails'])){
                $batchAdd = [];
                foreach(explode(PHP_EOL, $params['emails']) as $email){
                    $email = trim(strtolower($email));
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $batchAdd[] = sprintf("('%s', '%s')", trim($email), time());
                    }
                }
                $globalDB->query("INSERT IGNORE INTO `email_blacklist` (`email`, `time`) VALUES " . implode(",", $batchAdd));
                $params['error'] = 'Emails were blacklisted.';
            } else {
                $params['error'] = 'no emails to blacklist!';
            }
        } else {
            if(!isServerFinished() && isset($_GET['del']) && Session::validateChecker()){
                $_GET['del'] = (int)$_GET['del'];
                $globalDB->query("DELETE FROM `email_blacklist` WHERE id={$_GET['del']}");
            }
        }
        $params['content'] = $globalDB->query("SELECT * FROM email_blacklist");
        $params['total'] = $params['content']->num_rows;
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/blacklistedEmails.tpl')->getAsString());
    }
}