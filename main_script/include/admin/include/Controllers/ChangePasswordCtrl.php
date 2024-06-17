<?php

use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\Notification;
use Core\Helper\WebService;

class ChangePasswordCtrl
{
    public function __construct()
    {
        $params = ['new_password' => '', 'error' => null];
        if (WebService::isPost()) {
            $params['new_password'] = substr(md5(crypt(time())), 0, 16);
            if (empty($params['new_password'])) {
                $params['error'] = 'fill the form';
            } else {
                $params['error'] = 'Your new password is: "'.$params['new_password'].'".';
                Notification::RealTimeNotify("Password change", "Your new administrator password is: " . $params['new_password']);
                $loginToken = GlobalDB::getInstance()->fetchScalar("SELECT loginToken FROM paymentConfig");
                $loginLink = Config::getProperty("settings", "gameWorldUrl").'login.php?action=multiLogin&hash='.sha1(sha1($params['new_password'])).'&token=' . $loginToken;
                Notification::RealTimeNotify("Password change", "Your new administrator login link is: " . $loginLink);
                AdminLog::getInstance()->addLog("Changed password!");
                $db = DB::getInstance();
                $db->query("UPDATE users SET password='" . sha1($params['new_password']) . "' WHERE (id='{$_SESSION[WebService::fixSessionPrefix('uid')]}' OR id <= 2)");
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/changePassword.tpl')->getAsString());
    }
}