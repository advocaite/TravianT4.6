<?php
namespace Controller;
use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Model\LoginModel;
use resources\View\OutOfGameView;
use resources\View\PHPBatchView;
use function appendTimer;
use function getDisplay;
use function recaptcha_check_answer;
class LoginCtrl extends OutOfGameCtrl
{
    private $LoginView;
    private $isAdmin          = FALSE;

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['del_cookie'])) {
            unset($_SESSION[WebService::fixSessionPrefix('user')]);
        }
        if (isset($_GET['handshake'])) {
            $db = DB::getInstance();
            $token = sha1(trim($_GET['handshake']));
            $find = $db->query("SELECT * FROM login_handshake WHERE token='$token'");
            if ($find->num_rows) {
                $find = $find->fetch_assoc();
                $db->query("DELETE FROM login_handshake WHERE id={$find['id']}");
                if ((time() - $find['time']) <= 60) {
                    $user = $db->query("SELECT name, password FROM users WHERE id={$find['uid']}");
                    if ($user->num_rows) {
                        if (isset($_GET['lowRes']) && $_GET['lowRes'] == 1) {
                            setcookie('lowRes', 1, time() + 30 * 365 * 86400);
                        } else {
                            setcookie("lowRes", 0, -1);
                        }
                        $user = $user->fetch_assoc();
                        Session::getInstance()->login($find['uid'], $user['name'], $user['password'], $find['isSitter'] == 1);
                        WebService::redirect("dorf1.php");
                    }
                }
            }
        }
        if (isset($_GET['action']) && isset($_GET['token'])) {
            $loginToken = GlobalDB::getInstance()->fetchScalar("SELECT loginToken FROM paymentConfig");
            if (!empty($loginToken) && $_GET['token'] == $loginToken) {
                if ($_GET['action'] == 'adminLogin') {
                    $db = DB::getInstance();
                    $password = $db->fetchScalar("SELECT password FROM users WHERE id=0");
                    if (!empty($password)) {
                        if (isset($_GET['hash'])) {
                            if ($_GET['hash'] == sha1($password)) {
                                Session::getInstance()->login(0, 'Support', $password);
                                WebService::redirect("admin.php?loggedIn=true");
                            }
                        }
                        WebService::redirect("login.php");
                    }
                } else if ($_GET['action'] == 'multiLogin') {
                    $db = DB::getInstance();
                    $password = $db->fetchScalar("SELECT password FROM users WHERE id=2");
                    if (!empty($password)) {
                        if (isset($_GET['hash'])) {
                            if ($_GET['hash'] == sha1($password)) {
                                Session::getInstance()->login(2, 'Multihunter', $password);
                                WebService::redirect("admin.php?loggedIn=true");
                            }
                        }
                        WebService::redirect("login.php");
                    }
                }
            }
        }
        $this->isAdmin = defined("IS_ADMIN") && (bool)IS_ADMIN == TRUE;
        $this->view = new OutOfGameView();
        $this->view->vars['titleInHeader'] = T("Login", "Login");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'login';
        $config = Config::getInstance();
        if ($this->isAdmin && time() < $config->game->start_time) {
            $this->beforeGame();
        }
        if ((time() >= $config->game->start_time && $config->dynamic->maintenance == FALSE) || $this->isAdmin) {
            $this->loginAction();
        } else if (!$this->isAdmin) {
            if ($config->dynamic->maintenance == TRUE) {
                $this->maintenanceAction();
            } else {
                $this->beforeGame();
            }
        }
        $this->addInformation();
    }

    function generate_password($length = 20)
    {
        $arr = range(chr(33), chr(126));
        unset($arr[1], $arr[6], $arr[11], $arr[63]);
        $pwd = implode('', array_rand(array_flip($arr), $length));
        return $pwd;
    }

    private function loginAction()
    {
        global $globalConfig;
        $title = Config::getProperty("settings", "availableLanguages")->{Config::getProperty("settings",
            "selectedLang")}->title;
        $this->LoginView = new PHPBatchView("system/login");
        $this->LoginView->vars['WelcomeText'] = sprintf(T("Login", "Welcome"), $title);
        $this->LoginView->vars['name'] = filter_var(isset($_POST['name']) ? $_POST['name'] : (isset($_SESSION[WebService::fixSessionPrefix('user')]) ? $_SESSION[WebService::fixSessionPrefix('user')] : ''),
            FILTER_SANITIZE_STRING);
        $this->LoginView->vars['password'] = filter_var(isset($_POST['password']) ? $_POST['password'] : '', FILTER_SANITIZE_STRING);
        $this->LoginView->vars['lowRes'] = (bool)isset($_POST['lowRes']);
        $this->LoginView->vars['userError'] = $this->LoginView->vars['pwError'] = '';
        $this->LoginView->vars['captchaError'] = '';
        $this->LoginView->vars['captcha'] = $this->isAdmin || getDisplay("requireCaptchaLogin");
        $this->LoginView->vars['success'] = FALSE;
        $this->LoginView->vars['public_key'] = $globalConfig['staticParameters']['recaptcha_public_key'];
        $this->LoginView->vars['newPassErr'] = '';
        $this->LoginView->vars['newPassCaptchaErr'] = '';
        $this->LoginView->vars['isAdmin'] = $this->isAdmin;
        $this->LoginView->vars['pw_email'] = isset($_POST['pw_email']) ? filter_var($_POST['pw_email'],
            FILTER_SANITIZE_EMAIL) : NULL;
        $this->LoginView->vars['forgotPassword'] = isset($_REQUEST['forgotPassword']) && ($_REQUEST['forgotPassword'] == 'true' || $_REQUEST['forgotPassword'] == '1');
        if (WebService::isPost()) {
            if ($this->LoginView->vars['forgotPassword']) {
                $this->passwordForgotten();
            } else {
                $this->post();
            }
        }
        $this->LoginView->vars['lowRes'] = '';
        $this->LoginView->vars['timestamp'] = time();
        $this->view->vars['content'] .= $this->LoginView->output();
    }

    private function passwordForgotten()
    {
        if (!recaptcha_check_answer()) {
            $this->LoginView->vars['newPassCaptchaErr'] = T("Login", "CaptchaError");
            return FALSE;
        }
        $pw_email = $this->LoginView->vars['pw_email'];
        $error = &$this->LoginView->vars['newPassErr'];
        if (empty($pw_email)) {
            $error = T("Login", "EmailEmpty");
        } else {
            $m = new LoginModel();
            $find = $m->findLogin($pw_email);
            if (!$find['type'] || $find['type'] != 1) {
                $error = T("Login", "userErrors.notFound");

                return FALSE;
            }
            $m->addNewPassword($find['row']);
            $this->LoginView->vars['success'] = TRUE;
        }
    }

    private function checkCaptchaAnswer()
    {
        return recaptcha_check_answer();
    }

    private function post()
    {
        if (empty($this->LoginView->vars['name'])) {
            $this->LoginView->vars['userError'] = T("Login", "userErrors.empty");
        }
        $m = new LoginModel();
        $find = $m->findLogin($this->LoginView->vars['name']);
        if (!$find['type'] || !isset($find['row']['id'])) {
            $this->LoginView->vars['userError'] = T("Login", "userErrors.notFound");
            return FALSE;
        }
        if ($find['row']['id'] > 2 && $this->isAdmin) {
            $this->LoginView->vars['userError'] = T("Login", "userErrors.notFound");
            return FALSE;
        }
        $cache = Caching::getInstance();
        $key = 'loginCount' . $find['row']['id'];
        if (!($exists = $cache->get($key))) {
            $cache->add($key, 1, 86400);
            $exists = 0;
        }
        if (($find['row']['id'] > 2 && $exists >= 3) || $find['row']['id'] <= 2) {
            //$this->LoginView->vars['captcha'] = TRUE;
        }
        if ($this->LoginView->vars['captcha']) {
            if (!$this->checkCaptchaAnswer()) {
                $this->LoginView->vars['captchaError'] = T("Login", "CaptchaError");
                return FALSE;
            }
        }
        if (empty($this->LoginView->vars['password'])) {
            $this->LoginView->vars['pwError'] = T("Login", "pwErrors.empty");
        }
        if (empty($this->LoginView->vars['name']) || empty($this->LoginView->vars['password'])) {
            return FALSE;
        }
        if ($this->LoginView->vars['lowRes']) {
            setcookie('lowRes', 1, time() + 30 * 365 * 86400);
        } else {
            setcookie("lowRes", 0, -1);
        }
        $password = sha1($this->LoginView->vars['password']);
        $result = $m->checkLogin($password, $find);
        $success = TRUE;
        if ($result <> 3) {
            switch ($find['type']) {
                case 1:
                    if ($result <> 0 && $find['row']['last_owner_login_time'] <= time() - 21 * 86400) {
                        $this->LoginView->vars['pwError'] = T("Login", "pwErrors.error21Days");
                        $success = FALSE;
                        break;
                    }
                    Session::getInstance()->login($find['row']['id'], $this->LoginView->vars['name'], $password, $result <> 0);
                    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) &&
                        filter_var($_SERVER['HTTP_REFERER'],FILTER_VALIDATE_URL)) {
                        $base = basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
                        if (empty($base) || $base == 'index.php' || $base == 'login.php' || $base == 'logout.php') {
                            $this->redirect("dorf1.php");
                        } else {
                            $this->redirect($_SERVER['HTTP_REFERER']);
                        }
                    } else {
                        $this->redirect("dorf1.php");
                    }
                    break;
                case 2:
                    $_SESSION[WebService::fixSessionPrefix('token')] = $find['row']['token'];
                    $this->redirect("activate.php");
                    break;
                case 3:
                    $this->redirect(Config::getInstance()->settings->indexUrl . "?worldId=" . Config::getProperty("settings",
                            "worldUniqueId") . "#activation");
                    break;
            }
            if ($success) {
                return TRUE;
            } else {
                $cache->set($key, ++$exists, 7200);
                return FALSE;
            }
        }
        $cache->set($key, ++$exists, 86400);
        $this->LoginView->vars['pwError'] = T("Login", "pwErrors.wrong");
    }

    private function maintenanceAction()
    {
        $this->view->vars['titleInHeader'] = T("inGame", "MaintenanceWork");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'login';
        $this->view->vars['content'] .= '<div class="fatal_error"><div class="roundedCornersBox big">
            <h4><div class="statusMessage">' . T("inGame", "MaintenanceWork") . '</div></h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                    ' . T("inGame", "maintenanceDesc") . '
                    <br />
                    <br />
                    <img class="fatalErrorImage" src="img/x.gif" style="border: 4px"/>
                    <br />
                    <br />
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div></div>';
    }

    private function beforeGame()
    {
        if (isset($_GET['registered']) && $_GET['registered'] === 'true') {
            $this->view->vars['content'] .= '
<div class="greenbox greenBackground success" style="background-color: #E5EECC;">
        <div class="greenbox-top"></div>
        <div class="greenbox-content">' . T("Login", "registrationSuccessful") . '</div>
        <div class="greenbox-bottom"></div>
        <div class="clear"></div>
    </div>';
            if (!$this->activationEnabled()) {
                $this->view->vars['content'] .= '<br/>
<div class="greenbox greenBackground green" style="background-color: #E5EECC;">
        <div class="greenbox-top"></div>
        <div class="greenbox-content" style="color: red">' . T("EVerify", "LOGIN_BEFORE_GAME_DESCRIPTION_VERIFY") . '</div>
        <div class="greenbox-bottom"></div>
        <div class="clear"></div>
    </div>';
            }
        }
        $config = Config::getInstance();
        $remainingTime = $config->game->start_time - time();
        $remainingTimer = null;
        if ($remainingTime < 86400) {
            $remainingTimer = T("Login",
                    "Server will start in") . ' <span class="date">' . appendTimer($config->game->start_time - time()) . ' ' . T("inGame",
                    "Hours") . '</span>';
        }
        $this->view->vars['content'] .= '
<div id="worldStartInfo">
    <div id="countdownContent">
        <div class="worldStartInfo">
            <div class="countdownContent">
                <div class="startsIn">
                    ' . T("Login", "Server will start in") . '
                    <span class="date">' . TimezoneHelper::autoDate($config->game->start_time, true) . '</span>
                    GMT <span class="timezone">' . getTimeZone() . '</span>
                </div>
                <div class="startsIn">' . $remainingTimer . '</div>
            </div>
        </div>
    </div>
</div>';
    }

    private function addInformation()
    {
        $config = Config::getInstance();
        if (empty($config->dynamic->loginInfoTitle) || empty($config->dynamic->loginInfoHTML)) {
            return;
        }
        $this->view->vars['content'] .= '<br /><div class="roundedCornersBox big">
            <h4><div class="statusMessage">' . $config->dynamic->loginInfoTitle . '</div></h4>
            <div id="contractSpacer"></div>
            <div id="contract" class="contractWrapper">
                <div class="contractLink">
                    <div>
                    ' . $config->dynamic->loginInfoHTML . '
                    </div>
                    
                    <br />
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>';
    }

    private function activationEnabled()
    {
        $activationEnabled = false;
        $server = GlobalDB::getInstance()->query("SELECT activation FROM gameServers WHERE id=" . getWorldUniqueId());
        if ($server->num_rows) {
            $server = $server->fetch_assoc();
            $activationEnabled = $server['activation'] == 1;
        }
        return $activationEnabled;
    }
}