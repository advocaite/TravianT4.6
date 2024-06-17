<?php

use Core\Database\DB;
use Core\Helper\Notification;
use Core\Helper\WebService;

class AdminLoginCtrl
{
    public function __construct()
    {
        $params['error'] = '';
        if (WebService::isPost() && isset($_POST['name'])) {
            $username = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['pw'], FILTER_SANITIZE_STRING);
            if (empty($username) || empty($username)) {
                $params['error'] = 'fill the form';
            } else if(recaptcha_check_answer()) {
                $password = sha1($password);
                $db = DB::getInstance();
                $username = $db->real_escape_string(htmlspecialchars($username, ENT_QUOTES));
                $find = $db->fetchScalar("SELECT id FROM users WHERE name='$username' AND password='$password' AND (access=2 OR (id=2 OR id=0))");
                if ($find) {
                    $ip = WebService::ipAddress();
                    $_SESSION[WebService::fixSessionPrefix('uid')] = (int) $find;
                    $_SESSION[WebService::fixSessionPrefix('user')] = $username;
                    $_SESSION[WebService::fixSessionPrefix('pw')] = $password;
                    $_SESSION[WebService::fixSessionPrefix('ip')] = $ip;
                    $db->query("UPDATE users SET last_login_time=" . time() . " WHERE id=" . $_SESSION[WebService::fixSessionPrefix('uid')]);
                    $db->query("INSERT INTO log_ip (uid, ip, time) VALUES ({$_SESSION[WebService::fixSessionPrefix('uid')]}, '".ip2long($ip)."', " . time() . ")");
                    WebService::redirect("admin.php?loggedIn=true");
                } else {
                    $ip = WebService::ipAddress();
                    Notification::notify("Administrator login notification", "IP: $ip tried to log in with username <u>$username</u> but access was denied!");
                    AdminLog::getInstance()->addLog("<font color=\"red\"><b>IP: $ip tried to log in with username <u>$username</u> but access was denied!</b></font>");
                    $params['error'] = 'unknown login';
                }
            }
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/login.tpl')->getAsString());
    }
}