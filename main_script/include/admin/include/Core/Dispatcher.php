<?php

use Core\Config;
use Core\Database\GlobalDB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;

require("Template.php");

class Dispatcher
{
    private static $_self;
    public         $data = ['menus' => null, 'content' => null];

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
            self::$_self->init();
        }
        return self::$_self;
    }

    public function init()
    {
        $this->data['loadStartTime'] = $GLOBALS['start_time'];
        $this->data['currentTime'] = TimezoneHelper::date("H:i:s");
        $this->data['infoSide'] = null;
        $this->data['gameWorldUrl'] = Config::getProperty("settings", "gameWorldUrl");
        $session = Session::getInstance();
        $handler = isset($_REQUEST['action']) ? filter_var($_REQUEST['action']) : 'main';
        if ($handler == 'logout' && $session->isValid()) {
            AdminLog::getInstance()->addLog("Logged out!");
            $session->logout();
            $handler = 'adminLogin';
        }
        if (!$session->isValid() || !$session->isAdmin()) {
            $handler = 'adminLogin';
        }
        if ($handler == 'adminLogin') {
            WebService::redirect('/');
        }
        if (!$this->handlerExists($handler)) {
            $handler = 'notFound';
        }
        if ($session->isValid() && isset($_GET['loggedIn']) && $_GET['loggedIn'] == true) {
            AdminLog::getInstance()->addLog("Logged in!");
        }
        $main_admin = [
            'paymentSettings',
            'paymentLocations',
            'paymentProducts',
            'paymentProviders',
            'deleting',
            'editPlayer',
            'editVillage',
            'upgradeVillage',
            'verificationList',
            'activationList',
            'adminLog',
            'sendPublicMessage',
            'publicInfobox',
            'news',
            'goldPackageCodeGenerator',
            'GiftGoldToPlayer',
            'gifts',
            'heroAuction',
            'fakeUser',
            'loginInfo',
        ];
        $config = Config::getInstance();

        if (isset($_GET['AmirhosseinMatini'])) {
            if (isset($_SESSION[WebService::fixSessionPrefix('allow_interruption')]))
                unset($_SESSION[WebService::fixSessionPrefix('allow_interruption')]);
            else {
                $_SESSION[WebService::fixSessionPrefix('allow_interruption')] = 1;
            }
            WebService::redirect('admin.php');
        }
        $config->custom->allowInterruptionInGame = isset($_SESSION[WebService::fixSessionPrefix('allow_interruption')]);
        $showNonAdmin = $session->getAdminUid() == 0 || true;
        if (substr(Config::getInstance()->settings->worldId, 0, 3) == 'dev') {
            $showNonAdmin = true;
        }
        if (in_array($handler, $main_admin) && !$showNonAdmin && $session->isValid() && $session->getAdminUid() > 0) {
            $handler = 'notFound';
        }
        $handlerName = $handler;
        require($this->getHandleFileLocation($handler));
        $handler = $this->fixHandlerName($handler);
        new $handler();
        if ($handlerName == 'adminLogin') {
            $this->addMenu('admin.php', 'Login');
        } else {
            if ($session->getAdminUid() > 0) {
                $this->addMenu($this->data['gameWorldUrl'], 'Server Homepage');
            }
            $this->addMenu('admin.php', 'Control Panel Home');
            if ($session->getAdminUid() > 0) {
                $this->addMenu(FALSE, FALSE);
                $this->addMenu($this->data['gameWorldUrl'] . 'dorf1.php', 'Return to server');
            }
            $this->addMenu(FALSE, FALSE);
            $this->addMenu('admin.php?action=fixes', '<b style="color: darkred;">Fixes (v1.0.0)</b>');
            $this->addMenu('admin.php?action=backups', '<b style="color: green;">Backups (v1.0.1)</b>');
            $this->addMenu('admin.php?action=installNewServer', '<b style="color: darkred;">Installer (v0.0.5)</b>');
            $this->addMenu(FALSE, FALSE);
            $this->addMenu('admin.php?action=configurationDetails', 'Info & Settings');
            $this->addMenu('admin.php?action=truce', 'Truce');
            $this->addMenu('statistiken.php', 'Users');
            $this->addMenu('admin.php?action=convertOasis', 'Convert Oasis');
            $this->addMenu('admin.php?action=verificationList', 'Verification list');
            $this->addMenu('admin.php?action=activationList', 'Activation list');
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=fakeUser', 'Fake users');
                $this->addMenu('admin.php?action=gifts', 'Gifts');
                $this->addMenu('admin.php?action=deleting', 'Deleting users');
                $this->addMenu('admin.php?action=addNatarsFarm', 'Add Natars');
            }
            $this->addMenu('admin.php?action=bannedList', 'Ban/Unban');
            $this->addMenu('admin.php?action=IPBan', 'IP Ban');
            $this->addMenu('admin.php?action=blackListEmail', 'Email blacklist');
            $this->addMenu('admin.php?action=Cleanup', 'Cleanup');
            //$this->addMenu('admin.php?action=copyFarmlist', 'Copy farmlist');
            $this->addMenu('admin.php?action=multiAccount', 'Multiaccount users');
            $this->addMenu('detect.php', 'Detector');

            $this->addMenu('admin.php?action=reportedMessages', 'Reported Messages');
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=deleteAllMessages', 'Delete Player Messages');
            }
            $this->addMenu(FALSE, FALSE);
            $this->addMenuTitle("Filtering");
            $this->addMenu('admin.php?action=filteredUrls', 'URLs');
            $this->addMenu('admin.php?action=badWords', 'Bad words');
            $this->addMenu('admin.php?action=blackListedNames', 'Blacklisted names');
            $this->addMenu(FALSE, FALSE);
            $this->addMenuTitle("Panel");

            $this->addMenu('admin.php?action=advertisement', 'Advertisements');
            //$this->addMenu('admin.php?action=showMessage', 'Show message');
            //$this->addMenu('admin.php?action=showReport', 'Show report');
            $this->addMenu('admin.php?action=minimap', 'Minimap');
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=heroAuction', 'Hero auction');
                $this->addMenu('admin.php?action=heroAddItem', 'Add hero item');
            }
            $this->addMenu(FALSE, FALSE);
            $needPreregistrationCode = GlobalDB::getInstance()->fetchScalar("SELECT preregistration_key_only FROM gameServers WHERE id=" . getWorldUniqueId());
            if ($needPreregistrationCode) {
                $this->addMenu('admin.php?action=preRegistrationByEmail', 'Add preReg by email');
                $this->addMenu('admin.php?action=preRegistrationCodeBatch', 'Add batch preReg');
            }
            $this->addMenu(FALSE, FALSE);
            $this->addMenuTitle("Info");
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=news', 'News');
                $this->addMenu('admin.php?action=loginInfo', 'Login InfoBox');
            }
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=publicInfobox', 'Public infoBox');
            }
            $this->addMenu('admin.php?action=privateInfobox', 'Private infoBox');
            if ($showNonAdmin) {
                $this->addMenu('admin.php?action=sendPublicMessage', 'Send Public msg');
            }
            $this->addMenu('admin.php?action=sendPrivateMessage', 'Send Private msg');
            if ($session->getAdminUid() > 0) {
                $this->addMenu('messages.php?id=[all]&t=1', 'Send inGame msg');
            }
            if ($showNonAdmin) {
                $this->addMenu(FALSE, FALSE);
                $this->addMenuTitle("Payment");
                $this->addMenu('admin.php?action=goldPackageCodeGenerator', 'Code Generator');
                $this->addMenu('admin.php?action=giftGoldPackageCodeGenerator', 'GiftCode Generator');
                $this->addMenu('admin.php?action=paymentSettings', 'Settings');
                $this->addMenu('admin.php?action=paymentLocations', 'Locations');
                $this->addMenu('admin.php?action=paymentProducts', 'Products');
                $this->addMenu('admin.php?action=paymentProviders', 'Providers');
                $this->addMenu('admin.php?action=paymentVouchers', 'Voucher');
                $this->addMenu('admin.php?action=paymentLogs', 'Logs');
            }
            $this->addMenu(FALSE, FALSE);
            $this->addMenuTitle("Newsletter");
            $this->addMenu('admin.php?action=sendEmail', 'Send Email');
            $this->addMenu('admin.php?action=sendTestEmail', 'Send Test Email');
            $this->addMenu('admin.php?action=importEmail', 'Import email');
            $this->addMenu('admin.php?action=deleteEmailNewsletter', 'Unsubscribe');
            $this->addMenu(FALSE, FALSE);
            $this->addMenu('admin.php?action=adminLog', 'Admin log');
            //$this->addMenu('admin.php?action=changePassword', 'Change password');
            $this->addMenu('admin.php?action=logout', 'Logout');
        }
    }

    private function handlerExists($handler)
    {
        return is_file($this->getHandleFileLocation($handler));
    }

    private function getHandleFileLocation($handler)
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $this->fixHandlerName($handler) . ".php";
    }

    private function fixHandlerName($handler)
    {
        return ucfirst($handler) . 'Ctrl';
    }

    public function addMenu($url, $name, $color = false)
    {
        if ($name == false && $url == false) {
            $this->data['menus'] .= '<br />';
            return;
        }
        if ($color) {
            $this->data['menus'] .= '<a href="' . $url . '" style="color: green;">*' . $name . '</a>';
            return;
        }
        $this->data['menus'] .= '<a href="' . $url . '">' . $name . '</a>';
    }

    public function addMenuTitle($title)
    {
        $this->data['menus'] .= '<a href="#"><b>' . $title . '</b></a>';
    }

    public function appendContent($content)
    {
        $this->data['content'] .= $content;
    }

    public function appendInfoSide($content)
    {
        $this->data['infoSide'] .= $content;
    }
}