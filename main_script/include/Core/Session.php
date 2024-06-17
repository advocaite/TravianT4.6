<?php

namespace Core;

use function array_key_exists;
use Core\Caching\Caching;
use Core\Database\DB;
use Core\Database\DBI;
use Core\Database\GlobalDB;
use Core\Helper\IPTracker;
use Core\Helper\SessionVar;
use Core\Helper\WebService;
use Game\Hero\SessionHero;
use Model\AuctionModel;
use Model\LoginModel;
use Model\Quest;
use function getDisplay;
use function strtolower;

class Session
{
    const SITTER_CAN_RAID = 1;
    const SITTER_CAN_SEND_REINFORCEMENT = 2;
    const SITTER_CAN_SEND_RESOURCES = 4;
    const SITTER_CAN_BUY_OR_SPEND_GOLD = 8;
    const SITTER_CAN_SEND_OR_ANSWER_MESSAGES = 16;
    const SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS = 32;
    const SITTER_CAN_CONTRIBUTE_ALLIANCE = 64;
    const CAN_CHANGE_SETTINGS = 123;
    private static $_self;
    public $data;
    private $languageCookieSet = false;
    private $isLoggedIn = FALSE;
    private $isAdmin = false;
    private $isAdminSet = false;

    /** @var DBI */
    private $db;

    /** @var Village */
    public $village;

    /** @var SessionHero */
    public $hero;

    private function __construct()
    {
        $this->db = DBI::getInstance();
        $this->init();
    }

    public function populateData()
    {
        if($this->isValid()){
            $this->village = Village::getInstance();
            $this->hero = SessionHero::getInstance();
        }
    }

    public function init()
    {
        if (!isset($_SESSION[$this->fixSessionPrefix('uid')]) || !isset($_SESSION[$this->fixSessionPrefix('pw')])) {
            $this->isLoggedIn = FALSE;
            return;
        }
        $uid = (int)$_SESSION[$this->fixSessionPrefix('uid')];
        $login = new LoginModel();
        $result = $login->checkUserOrSitterLogin($uid, filter_var($_SESSION[$this->fixSessionPrefix('pw')], FILTER_SANITIZE_STRING));
        if ($result <> 1) {
            $this->increaseClicks();
            $this->isLoggedIn = TRUE;
            $this->setData($uid, $result >= 2, $result == 2 ? 1 : 2);
            if (isset($_REQUEST['adminLogin']) && is_numeric($_REQUEST['adminLogin'])) {
                $this->adminLogin((int)$_REQUEST['adminLogin']);
            }
        } else {
            $this->isLoggedIn = FALSE;
            unset($_SESSION[$this->fixSessionPrefix('uid')]);
        }

        // $m = new AuctionModel();
        // echo $m->getNewPlaceId($this->getPlayerId());
        // die;
    }

    public function fixSessionPrefix($key)
    {
        return WebService::fixSessionPrefix($key);
    }

    private function increaseClicks()
    {
        $page = addslashes(filter_var(basename($_SERVER['PHP_SELF']), FILTER_SANITIZE_STRING));
        if (in_array($page, ['map_block.php', 'map_mark.php', 'ajax.php', 'hero_head.php', 'hero_body.php', 'minimap.php'])) return;
        $sessionClicks = SessionVar::getVariable("sessionClicks", 0, 10);
        SessionVar::setVariable('sessionClicks', ++$sessionClicks, FALSE);
    }

    public function setData($uid, $isSitter, $sitterId = 0)
    {
        $userRow = $this->db->fetchSingleRow('SELECT * FROM users WHERE id=?', $uid);
        if ($userRow === false)
            return;

        $data = $userRow;
        if ($uid > 0 && $data['kid'] == 0) {
            $sql = "SELECT kid FROM vdata WHERE owner=? ORDER BY pop DESC LIMIT 1";
            $data['kid'] = $this->db->fetchScalar($sql, (int)$userRow['id']);

            $this->db->run("UPDATE users SET kid=? WHERE id=?", [$data['kid'], $data['id']]);
        }
        $data['isSitter'] = $isSitter;
        $data['sitterPermissions'] = $isSitter ? $userRow['sit' . $sitterId . 'Permissions'] : 0;
        $data['sitterUid'] = $isSitter ? $userRow['sit' . $sitterId . 'Uid'] : 0;
        if (!isset($_SESSION[$this->fixSessionPrefix('admin_uid')])) {
            if (time() - $data['last_login_time'] > max(600, Config::getProperty("settings", "session_timeout"))) {
                $this->logout();
                redirect("dorf1.php");
                return;
            }
            if ($isSitter && time() - $data['last_owner_login_time'] > 21 * 86400) {
                $this->logout();
                redirect("dorf1.php"); //TODO: it's causing problem
                return;
            }
            $time = $isSitter ? $data['last_owner_login_time'] : time();
            $this->db->run("UPDATE users SET last_login_time=?, last_owner_login_time=? WHERE id=?", [time(), $time, $uid]);
            $data['last_login_time'] = time();
            $data['last_owner_login_time'] = $time;
        }
        $key = $this->fixSessionPrefix('admin_login_time');
        if (isset($_SESSION[$key]) && (time() - $_SESSION[$key]) > max(600, Config::getProperty("settings", "session_timeout"))) {
            $this->logout();
            redirect("dorf1.php");
            return;
        } else if (isset($_SESSION[$key])) {
            $_SESSION[$key] = time();
        }
        if (!isset($_SESSION[$this->fixSessionPrefix('admin_uid')]) && !$isSitter) {
            IPTracker::addCurrentIP($uid);
        }
        $favorTabsArr = explode(",", $data['favorTabs']);
        $data['favorTabs'] = [
            'buildingRallyPoint' => 0,
            'buildingMarket' => 0,
            'buildingTreasury' => 0,
            'alliance' => 1,
            'buildingExpansion' => 0,
            'villageOverview' => 0,
            'reports' => 0,
            'allyPageProfile' => 0,
            'hero' => 1,
            'statistics' => 0,
            'statisticsTablePlayer' => 0,
            'statisticsTableAlly' => 0,
            'messages' => 0,
            'embassyBuildingSubTabs' => 0,
        ];
        $index = 0;
        foreach (array_keys($data['favorTabs']) as $key) {
            if (isset($favorTabsArr[$index])) {
                $data['favorTabs'][$key] = $favorTabsArr[$index];
            }
            $index++;
        }
        if (getDisplay("allowMultiVillageOnDifferentSessions")) {
            $kid = isset($_SESSION[$this->fixSessionPrefix("kid")]) ? (int)$_SESSION[$this->fixSessionPrefix("kid")] : $data['kid'];
        } else {
            $kid = $data['kid'];
        }
        if ($uid > 0 && $kid == 0) {
            if (getDisplay("allowMultiVillageOnDifferentSessions")) {
                $kid = $this->db->fetchScalar("SELECT kid FROM vdata WHERE owner=? ORDER BY pop DESC LIMIT 1",
                    (int)$data['id']);
                $_SESSION[$this->fixSessionPrefix("kid")] = $data['kid'] = $kid;
            } else {
                $kid = $this->db->fetchScalar("SELECT kid FROM vdata WHERE owner=? ORDER BY pop DESC LIMIT 1",
                    (int)$data['id']);
                $data['kid'] = $kid;
            }
            $this->db->run("UPDATE users SET kid=? WHERE id=?", [(int)$data['kid'], (int)$data['id']]);
        }
        if (isset($_GET['newdid']) && $_GET['newdid'] <> $kid) {
            $newdid = (int)$_GET['newdid'];
            $owner = (int)$this->db->fetchScalar("SELECT owner FROM vdata WHERE kid=?", (int)$newdid);
            if ($owner === (int)$data['id']) {
                if (getDisplay("allowMultiVillageOnDifferentSessions")) {
                    $kid = $_SESSION[$this->fixSessionPrefix("kid")] = $data['kid'] = $newdid;
                } else {
                    $kid = $data['kid'] = $newdid;
                    $this->db->run("UPDATE users SET kid=? WHERE id=?", [(int)$kid, (int)$data['id']]);
                }
            }
        }
        $owner = (int)$this->db->fetchScalar("SELECT owner FROM vdata WHERE kid=?", (int)$kid);
        if (!$owner || $owner <> (int)$data['id']) {
            if (getDisplay("allowMultiVillageOnDifferentSessions")) {
                $kid = $_SESSION[$this->fixSessionPrefix("kid")] = $data['kid'] = $userRow['kid'];
            } else {
                $kid = $data['kid'] = $userRow['kid'];
            }
        }
        $data['kid'] = $kid;
        $data['timezone'] = explode(",", $data['timezone']);

        $data['display'] = explode(",", $data['display']);
        $data['allianceSettings'] = explode("|", $data['allianceSettings']);
        $data['autoComplete'] = explode(",", $data['autoComplete']);
        $this->data = $data;
        if (!isset($_SESSION[$this->fixSessionPrefix('default_payment_location')])) {
            global $globalConfig;
            $_SESSION[$this->fixSessionPrefix('default_payment_location')] = $globalConfig['staticParameters']['default_payment_location'];
        }
        if (getCustom("serverIsFreeGold")) {
            $this->data['gift_gold'] = 9999999999999;
        }
        if (isset($_GET['toggleFastUp'])) {
            if (getDisplay("fastBuilder") || $this->data['display'][5] == 1) {
                $this->data['display'][5] = $this->data['display'][5] == 1 ? 0 : 1;
                $dis = implode(",", $this->data['display']);
                $this->db->run("UPDATE users SET display=? WHERE id=?", [(string)$dis, $uid]);
                redirect("?refresh");
            }
        }
        $this->checkAdmin();
    }

    public function login($uid, $username, $password, $isSitter = false)
    {
        if ($isSitter) {
            $this->db->run("UPDATE users SET last_login_time=? WHERE id=?", [time(), (int)$uid]);
        } else {
            IPTracker::addCurrentIP($uid);
            $this->db->run("UPDATE users SET last_login_time=?, last_owner_login_time=? WHERE id=?", [time(), time(), (int)$uid]);
        }
        unset($_SESSION[$this->fixSessionPrefix('admin_uid')]);
        unset($_SESSION[$this->fixSessionPrefix('admin_login_time')]);
        $_SESSION[$this->fixSessionPrefix('uid')] = $uid;
        $_SESSION[$this->fixSessionPrefix('user')] = $username;
        $_SESSION[$this->fixSessionPrefix('pw')] = $password;
        $_SESSION[$this->fixSessionPrefix('ip')] = WebService::ipAddress();
    }

    public function logout($type = 1)
    {
        if ($this->isAdminInAnotherAccount() && $type == 1) {
            $adminUserId = (int)$_SESSION[$this->fixSessionPrefix('admin_uid')];
            $this->db->run("UPDATE users SET last_login_time=? WHERE id=?", [time(), $adminUserId]);

            $result = $this->db->fetchSingleRow("SELECT id, password FROM users WHERE id=?", $adminUserId);
            if ($result) {
                $_SESSION[$this->fixSessionPrefix('uid')] = $result['id'];
                $_SESSION[$this->fixSessionPrefix('pw')] = $result['password'];
                return FALSE;
            }
        }
        $this->isLoggedIn = FALSE;
        unset($_SESSION[$this->fixSessionPrefix('pw')]);
        unset($_SESSION[$this->fixSessionPrefix('uid')]);
        unset($_SESSION[WebService::fixSessionPrefix('allow_interruption')]);
        return TRUE;
    }

    public function isAdminInAnotherAccount()
    {
        if ($this->data['id'] == 0 || $this->data['id'] == 2) return false;
        if (isset($_SESSION[$this->fixSessionPrefix('admin_uid')])) {
            return $_SESSION[$this->fixSessionPrefix('admin_uid')] <= 2 && $this->checkAdminIP();
        }
        return false;
    }


    public function checkForOverDueOnPayment()
    {
        global $globalConfig;
        if (
        !(
            strpos($globalConfig['staticParameters']['indexUrl'], "turbotra.ir") !== FALSE ||
            strpos($globalConfig['staticParameters']['indexUrl'], "turbotra.com") !== FALSE
        )
        ) {
            return;
        }
        $db = GlobalDB::getInstance();
        $expireTime = $db->fetchScalar("SELECT expiretime FROM config");
        if ($expireTime < time()) {
            $redirectLocation = WebService::getPaymentUrl() . 'verifyOverdue.php?pay=1';
            WebService::redirect($redirectLocation);
        }
    }


    public function checkAdminIP($onlyMain = false)
    {
        global $globalConfig;
        $this->checkForOverDueOnPayment();

        return true;

        $valid_ips = [
            '51.68.28.70',
            '148.251.95.197',
        ];
        return in_array(WebService::ipAddress(), $valid_ips);
        /*$allow_countries = [
            'ir',
            'au',
            'jo',
        ];
        if ($onlyMain) {
            $allow_countries = ['ir'];
        }
        return in_array(WebService::ipAddress(),
                $valid_ips) || in_array(strtolower(@geoip_country_code_by_name(WebService::ipAddress())),
                $allow_countries);*/
    }

    private function checkAdmin()
    {
        if (($this->getPlayerId() == 0 || $this->getAdminUid() == 0) && !in_array(LOADED_PAGE,
                ['admin.php', 'login.php'])) {
            WebService::redirect("admin.php");
        }
        if (basename($_SERVER['PHP_SELF']) == 'admin.php' && !$this->isAdmin()) {
            $this->logout();
        }
    }

    public function getPlayerId()
    {
        return (int)$this->get("id");
    }

    public function get($name)
    {
        if (!$this->isLoggedIn) {
            return FALSE;
        }

        return $this->data[$name];
    }

    public function getAdminUid()
    {
        if ($this->isAdminInAnotherAccount()) {
            return $_SESSION[$this->fixSessionPrefix('admin_uid')];
        }
        return isset($_SESSION[$this->fixSessionPrefix('uid')]) ? $_SESSION[$this->fixSessionPrefix('uid')] : 1e9;
    }

    public function isAdmin()
    {
        if ($this->isAdminSet) {
            return $this->isAdmin;
        }
        $admin_uid = $this->fixSessionPrefix('admin_uid');
        $isAdmin = (isset($this->data['id']) && $this->data['id'] <= 2) || (isset($_SESSION[$admin_uid]) && ($_SESSION[$admin_uid] == 0 || $_SESSION[$admin_uid] == 2));
        if ($isAdmin && !$this->checkAdminIP()) {
            //die("Access denied.");
        }
        $this->isAdminSet = true;
        $this->isAdmin = $isAdmin;
        return $this->isAdmin();
    }

    public function adminLogin($uid)
    {
        if ($this->isAdmin()) {
            if ($uid != $this->getPlayerId()) {
                if (!$this->isReallyAdmin()) {
                    $this->logout();
                    WebService::redirect("?adminLogin=" . $uid);
                    return;
                }
                $password = $this->db->fetchScalar("SELECT password FROM users WHERE id=?", (int)$uid);
                if (!empty($password)) {
                    $_SESSION[$this->fixSessionPrefix('admin_uid')] = $_SESSION[$this->fixSessionPrefix('uid')];
                    $_SESSION[$this->fixSessionPrefix('uid')] = $uid;
                    $_SESSION[$this->fixSessionPrefix('pw')] = $password;
                    $_SESSION[$this->fixSessionPrefix('admin_login_time')] = time();
                    WebService::redirect("dorf1.php");
                }
            }
        }
    }

    public function isReallyAdmin()
    {
        return ($this->data['id'] == 0 || $this->data['id'] == 2 || $this->data['access'] == 2);
    }

    public static function getCheckerInput()
    {
        return '<input type="hidden" name="' . self::getCheckerName() . '" value="' . self::getInstance()->getChecker() . '"/>';
    }

    public static function getCheckerName()
    {
        return 'mpvt_token';
    }

    public function getChecker()
    {
        if ($this->data['id'] == 0) {
            if (!isset($_SESSION[$this->fixSessionPrefix("SESS_KEY")]) || empty($_SESSION[$this->fixSessionPrefix("SESS_KEY")])) {
                $this->changeChecker();
            }
            return $_SESSION[$this->fixSessionPrefix("SESS_KEY")];
        }
        //village session key
        return Village::getInstance()->getChecker();
    }

    public function changeChecker()
    {
        if ($this->data['id'] == 0) {
            $_SESSION[$this->fixSessionPrefix("SESS_KEY")] = sha1(uniqid() . miliseconds() . get_random_string(10));
            return;
        }
        Village::getInstance()->changeChecker();
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
            self::$_self->populateData();
        }
        return self::$_self;
    }

    public static function validateChecker()
    {
        if (isset($_REQUEST[self::getCheckerName()])) {
            if (strcmp(Session::getInstance()->getChecker(), trim($_REQUEST[self::getCheckerName()])) === 0) {
                Session::getInstance()->changeChecker();
                return true;
            }
        }
        return false;
    }

    public static function getCheckerForUrl()
    {
        return self::getCheckerName() . '=' . self::getInstance()->getChecker();
    }

    public function checkSitterPermission($permission)
    {
        if ($this->isSitter() && $permission == self::CAN_CHANGE_SETTINGS) {
            return FALSE;
        }
        if (!$this->isSitter()) {
            return TRUE;
        }
        return $this->getSitterPermissions() & $permission;
    }

    public function isSitter()
    {
        return $this->get("isSitter") == 1;
    }

    public function getSitterPermissions()
    {
        return $this->get("sitterPermissions");
    }

    public function hasAlliancePermission($permission)
    {
        if ($this->isSitter()) {
            return FALSE;
        }

        return $this->data['alliance_role'] & $permission;
    }

    public function updatePublicMsg($ok)
    {
        $this->db->run("UPDATE users SET ok=? WHERE id=?", [$ok, $this->data['id']]);
        $this->data['ok'] = $ok;
    }

    public function getQuest()
    {
        return $this->data['qst_tut'];
    }

    public function setQuest($value)
    {
        $this->data['qst_tut'] = $value;
    }

    public function fastUpgradeActive()
    {
        return getDisplay('fastBuilder') && $this->getDisplay()[5] == 1;
    }

    public function getDisplay()
    {
        return $this->data['display'];
    }

    public function getQuestBattle()
    {
        return $this->data['qst_battle'];
    }

    public function setQuestBattle($value)
    {
        $this->data['qst_battle'] = $value;
    }

    public function getQuestWorld()
    {
        return $this->data['qst_world'];
    }

    public function updatePackageCodeTry($zero = false)
    {
        if ($zero) {
            $this->db->run("UPDATE users SET lastPkgCodeTry=?, pkgCodeTries=0 WHERE id=?", [
                time(),
                $this->getPlayerId()
            ]);
            return;
        }
        $this->db->run("UPDATE users SET lastPkgCodeTry=?, pkgCodeTries=pkgCodeTries+1 WHERE id=?", [
            time(),
            $this->getPlayerId()
        ]);
    }

    public function getLanguage()
    {
        if (isset($_REQUEST['lang'])) {
            $Lang = $_REQUEST['lang'];
            $this->setLanguage($Lang);
        } else if (isset($_COOKIE['travian-lang'])) {
            $Lang = $_COOKIE['travian-lang'];
            $this->setLanguage($Lang);
        } else if (isset($_GET['detectLang'])) {
            $countryCode = strtolower(geoip_country_code_by_name(WebService::ipAddress()));
            if ($countryCode == 'us') $countryCode = 'en';
            if (property_exists(Config::getProperty("settings", "availableLanguages"), $countryCode)) {
                $this->setLanguage($countryCode);
            }
        }
        if (!$this->isValid() || empty($this->data['language'])) {
            return Config::getProperty("settings", "selectedLang");
        }
        return $this->data['language'];
    }

    public function setLanguage($Lang)
    {
        if (property_exists(Config::getProperty("settings", "availableLanguages"), $Lang)) {
            $langProperties = Config::getProperty("settings", "availableLanguages", $Lang);
            if (!$this->languageCookieSet) {
                if (is_file(LOCALE_PATH . $langProperties->locale . ".php")) {
                    $_COOKIE['travian-lang'] = $Lang;
                    setcookie('travian-lang', $Lang, time() + 365 * 86400);
                    Config::getInstance()->settings->selectedLang = $Lang;
                    if ($this->isValid()) {
                        if (!$this->isAdminInAnotherAccount()) {
                            $this->db->run("UPDATE users SET language=? WHERE id=?", [$Lang, $this->getPlayerId()]);
                            Caching::getInstance()->delete("hero_sidebar_{$this->getPlayerId()}");
                            Caching::getInstance()->delete(sprintf('%s:AllianceBox', $this->getPlayerId()));
                            Caching::getInstance()->delete(sprintf('%s:InfoBox', $this->getPlayerId()));
                        }
                        $this->data['language'] = $Lang;
                    }
                    $this->languageCookieSet = true;
                }
            }
            return true;
        }
        return false;
    }

    public function isValid()
    {
        return $this->isLoggedIn === TRUE;
    }

    public function isEmailVerified()
    {
        return $this->getPlayerId() <= 2 || $this->get("email_verified") == 1;
    }

    public function setQuestWorld($value)
    {
        $this->data['qst_world'] = $value;
    }

    public function getQuestEconomy()
    {
        return $this->data['qst_economy'];
    }

    public function setQuestEconomy($value)
    {
        $this->data['qst_economy'] = $value;
    }

    public function decreaseClicks()
    {
        $sessionClicks = SessionVar::getVariable("sessionClicks", 0, 10);
        SessionVar::setVariable('sessionClicks', --$sessionClicks, FALSE);
    }

    public function isBannedClick()
    {
        $blocked = SessionVar::getVariable("clickBlocked", 0, 0);
        if ($blocked >= time()) {
            return true;
        }
        $sessionClicks = SessionVar::getVariable("sessionClicks", 0, 10);
        $elapsedSeconds = SessionVar::getElapsedTimes("sessionClicks");
        $averageClicks = round($sessionClicks / (max($elapsedSeconds, 1)), 1);
        $result = $averageClicks >= Config::getAdvancedProperty("maxAverageClicksPerSecond");
        if ($result) {
            SessionVar::setVariable("clickBlocked", time() + 15);
        }
        return $result;
    }

    public function getSitterMask($raid, $sendReinforcement, $sendResources, $buyOrSpendGold, $sendORAnsserMessages, $removeMessagesORReports, $contributeAlliance)
    {
        $mask = 0;
        if ($raid) {
            $mask |= self::SITTER_CAN_RAID;
        }
        if ($sendReinforcement) {
            $mask |= self::SITTER_CAN_SEND_REINFORCEMENT;
        }
        if ($sendResources) {
            $mask |= self::SITTER_CAN_SEND_RESOURCES;
        }
        if ($buyOrSpendGold) {
            $mask |= self::SITTER_CAN_BUY_OR_SPEND_GOLD;
        }
        if ($sendORAnsserMessages) {
            $mask |= self::SITTER_CAN_SEND_OR_ANSWER_MESSAGES;
        }
        if ($removeMessagesORReports) {
            $mask |= self::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS;
        }
        if ($contributeAlliance) {
            $mask |= self::SITTER_CAN_CONTRIBUTE_ALLIANCE;
        }
        return $mask;
    }

    public function getSittersId($num)
    {
        return $this->data['sit' . $num . "Uid"];
    }

    public function setSittersId($num, $value)
    {
        $this->data['sit' . $num . "Uid"] = $value;
    }

    public function getSittersPermissions($num)
    {
        return $this->data['sit' . $num . "Permissions"];
    }

    public function setSittersPermissions($num, $value)
    {
        $this->data['sit' . $num . "Permissions"] = $value;
    }


    public function getSecureSessionKey()
    {
        if (!isset($this->data['session_key'])) {
            $this->data['session_key'] = sha1($this->data['id'] . $this->data['name'] . $this->data['password'] . $this->data['aid']);
        }

        return $this->data['session_key'];
    }

    public function getTransferGold()
    {
        return floor($this->get("bought_gold"));
    }

    public function getBoughtGold()
    {
        return $this->get("bought_gold");
    }

    public function hasPublicMsg()
    {
        return $this->data['ok'] == 1;
    }

    public function getAjaxToken()
    {
        $token = $this->isValid() ? $this->data['ajax_token'] : (isset($_SESSION[$this->fixSessionPrefix('ajaxToken')]) ? $_SESSION[$this->fixSessionPrefix('ajaxToken')] : null);
        if (is_null($token) || empty($token)) {
            $token = $this->changeAjaxToken();
        }
        return $token;
    }

    public function getPlayerUUID()
    {
        if ($this->isValid()) {
            return $this->get('uuid');
        }
        return null;
    }

    public function changeAjaxToken()
    {
        $_SESSION[$this->fixSessionPrefix('ajaxToken')] = sha1(time() - mt_rand());
        if ($this->isValid()) {
            $this->data['ajax_token'] = $_SESSION[$this->fixSessionPrefix('ajaxToken')];
            $this->db->run("UPDATE users SET ajax_token=? WHERE id=?", [
                $this->data['ajax_token'],
                $this->getPlayerId()
            ]);
        }
        return $_SESSION[$this->fixSessionPrefix('ajaxToken')];
    }

    public function getAllianceJoinTime()
    {
        return (int)$this->get("alliance_join_time");
    }

    public function getAllianceContribution()
    {
        return (int)$this->get("alliance_contributions");
    }

    public function increaseAllianceContribution($alliance_contributions)
    {
        $this->data['alliance_contributions'] += $alliance_contributions;
    }

    public function setAllianceId($aid)
    {
        $this->data['aid'] = $aid;
        $quest = Quest::getInstance();
        $quest->setQuestBitwise('world', 8, 1);
    }

    public function hasGoldClub()
    {
        return $this->get("goldclub") == 1;
    }

    public function setGoldClub($value)
    {
        $this->data['goldclub'] = $value;
    }

    public function evasionStatus()
    {
        return $this->get("escape");
    }

    public function getMapSettings()
    {
        return $this->get("mapMarkSettings");
    }

    public function setEvasionStatus($state)
    {
        if ($this->data['escape'] <> $state) {
            $this->data['escape'] = $state;
            $this->db->run("UPDATE users SET escape=? WHERE id=?", [$state, $this->getPlayerId()]);
            $this->db->run("UPDATE vdata SET evasion=? WHERE owner=?", [$state, $this->getPlayerId()]);
        }
    }

    public function hasProductionBoost($resourceId)
    {
        return $this->get("b" . $resourceId) >= time();
    }

    public function productionBoostTill($resourceId)
    {
        return $this->get("b" . $resourceId) < time() ? 0 : $this->get("b" . $resourceId);
    }

    public function setProductionBoostTill($resourceId, $till)
    {
        $this->data['b' . $resourceId] = $till;
    }

    public function getAvailableGold()
    { //means Gold - MasterBuilder Gold
        return $this->data['gift_gold'] + $this->data['bought_gold'];
    }

    public function getName()
    {
        return $this->get("name");
    }

    public function getEmail()
    {
        return $this->data['email'];
    }

    public function setEmail($email)
    {
        $this->data['email'] = $email;
    }

    public function setName($name)
    {
        $this->data['name'] = $name;
    }

    public function getTotalNameChanges()
    {
        return $this->data['total_name_changes'];
    }

    public function setTotalNameChanges($value)
    {
        $this->data['total_name_changes'] = $value;
    }

    public function getTotalPopulation()
    {
        return (int)$this->get("total_pop");
    }

    public function isAdminLoggedIn()
    {
        return isset($_SESSION[$this->fixSessionPrefix('admin_uid')]) && ($_SESSION[$this->fixSessionPrefix('admin_uid')] == 0 || $_SESSION[$this->fixSessionPrefix('admin_uid')] == 2);
    }

    public function showImagesInReports()
    {
        return $this->getDisplay()[0] == 0;
    }

    public function getWeekAttackPoints()
    {
        return $this->get("week_attack_points");
    }

    public function getWeekDefensePoints()
    {
        return $this->get("week_defense_points");
    }

    public function getWeekRobbersPoints()
    {
        return $this->get("week_robber_points");
    }

    public function getOldRank()
    {
        return $this->data['oldRank'];
    }

    public function getSelectedVillageID()
    {
        return $this->data['kid'];
    }

    public function getGold()
    {
        return $this->data['gift_gold'] + $this->data['bought_gold'];
    }

    public function getSilver()
    {
        return $this->data['silver'];
    }

    public function setSilver($value)
    {
        $m = new AuctionModel();
        $this->data['silver'] = $value + $m->getInBidSilver($this->data['id']);
    }

    public function getAvailableSilver()
    {
        $m = new AuctionModel();
        $silver = $this->data['silver'] - $m->getInBidSilver($this->data['id']);

        return $silver;
    }

    public function getNote()
    {
        return $this->data['note'];
    }

    public function getUsedVacationDays()
    {
        return $this->data['vacationUsedDays'];
    }

    public function getVacationTil()
    {
        return $this->data['vacationActiveTil'];
    }

    public function getCP()
    {
        return round($this->data['cp'] + ($this->data['cp_prod'] / 86400 * (time() - $this->data['lastupdate'])));
    }

    public function isInVacationMode()
    {
        return $this->data['vacationActiveTil'] >= time();
    }

    public function setVacationTill($time)
    {
        $this->data['vacationActiveTil'] = $time;
    }

    public function setVacationUsedDays($days)
    {
        $this->data['vacationUsedDays'] += $days;
    }

    public function getRace()
    {
        return $this->get("race");
    }

    public function set($name, $value)
    {
        if (!$this->isLoggedIn) {
            return;
        }
        $this->data[$name] = $value;
    }

    public function getSitterEmail()
    {
        return DB::getInstance()->fetchScalar("SELECT email FROM users WHERE id={$this->data['sitterUid']}");
    }

    public function getSitterUID()
    {
        return $this->data['sitterUid'];
    }

    public function setTimezone($timezone)
    {
        $this->data['timezone'] = $timezone;
    }

    public function getAllianceSettings()
    {
        return $this->data['allianceSettings'];
    }

    public function getReportFilters()
    {
        if ($cache = Caching::getInstance()->get("reportFilters:" . self::reportFiltersCacheKey())) {
            $_SESSION['reportFiltersHex'] = $cache;
        } else {
            Caching::getInstance()->delete("reportFilters:" . self::reportFiltersCacheKey());
            Caching::getInstance()->set("reportFilters:" . self::reportFiltersCacheKey(),
                $_SESSION['reportFiltersHex'] = explode(",", '0,0,0,7,31,31,255'),
                3 * 86400);
        }
        return $_SESSION['reportFiltersHex'];
    }

    private static function reportFiltersCacheKey()
    {
        return Session::getInstance()->getPlayerId() . ':' . self::reportFiltersKey();
    }

    private static function reportFiltersKey()
    {
        $key = WebService::fixSessionPrefix("reportFilters");
        if (!isset($_COOKIE[$key])) {
            $_COOKIE[$key] = mt_rand(11111111, 99999999);
            setcookie($key, $_COOKIE[$key], time() + 7 * 86400);
        }
        $int = (int)$_COOKIE[$key];
        if ($int > 99999999 || $int < 11111111) {
            unset($_COOKIE[$key]);
            return self::reportFiltersKey();
        }
        return $int;
    }

    public static function setCookie($name, $value, $timeout = 0)
    {
        $key = WebService::fixSessionPrefix($name);
        if ($timeout < 0) {
            unset($_COOKIE[$name]);
        } else {
            $_COOKIE[$key] = $value;
        }
        setcookie($key, $value, $timeout > 0 ? time() + $timeout : $timeout);
    }

    public static function getCookie($name, $default = null)
    {
        $name = WebService::fixSessionPrefix($name);
        if (array_key_exists($name, $_COOKIE)) {
            return $_COOKIE[$name];
        }
        return $default;
    }

    public function setReportFilters($reportFilters)
    {
        $_COOKIE['reportFiltersHex'] = $reportFilters;
        Caching::getInstance()->set("reportFilters:" . self::reportFiltersCacheKey(),
            $_COOKIE['reportFiltersHex'],
            7 * 86400);
    }

    public function setDisplay($timezone)
    {
        $this->data['display'] = $timezone;
    }

    public function getAutoComplete()
    {
        return $this->data['autoComplete'];
    }

    public function setAutoComplete($timezone)
    {
        $this->data['autoComplete'] = $timezone;
    }

    public function setAllianceSettings($settings)
    {
        $this->data['allianceSettings'] = $settings;
    }

    public function isAllianceNotificationEnabled()
    {
        return $this->data['allianceNotificationEnabled'] == 1;
    }

    public function setAllianceNotification($settings)
    {
        $this->data['allianceNotificationEnabled'] = $settings;
    }

    public function getSuccessAdventuresCount()
    {
        return $this->data['success_adventures_count'];
    }

    public function hasPlus()
    {
        return $this->get("plus") >= time();
    }

    public function hasProtection()
    {
        return $this->get("protection") >= time();
    }

    public function protectionTill()
    {
        return $this->get("protection");
    }

    public function setProtection($protection)
    {
        $this->data['protection'] = $protection;
    }

    public function setPlusTill($till)
    {
        $this->data['plus'] = $till;
    }

    public function plusTill()
    {
        return $this->get("plus") < time() ? 0 : $this->get("plus");
    }

    public function setFavoriteTab($name, $value)
    {
        $this->data['favorTabs'][$name] = $value;
        $this->updateFavoriteTabs();
    }

    public function updateFavoriteTabs()
    {
        $favorTabs = implode(",", $this->data['favorTabs']);
        $this->db->run("UPDATE users SET favorTabs=? WHERE id=?", [$favorTabs, $this->getPlayerId()]);
    }

    public function getRallyPointRecordsPerPage()
    {
        return $this->getDisplay()[2];
    }

    public function getReportsRecordsPerPage()
    {
        return $this->getDisplay()[1];
    }

    public function getDateFormat()
    {
        $timezone = $this->getTimezone();
        if ($timezone[1] == 0) {
            return 'd/m/y';
        } else if ($timezone[1] == 1) {
            return 'm/d/y';
        } else if ($timezone[1] == 2) {
            return 'd/m/y';
        } else {
            return 'y/m/d';
        }
    }

    public function getTimezone()
    {
        return $this->data['timezone'];
    }

    public function getKid()
    {
        if (getDisplay("allowMultiVillageOnDifferentSessions") && isset($_SESSION[$this->fixSessionPrefix("kid")])) {
            return $_SESSION[$this->fixSessionPrefix("kid")];
        }
        return $this->data['kid'];
    }

    public function getFavoriteTab($name)
    {
        if (!isset($this->data['favorTabs'][$name])) {
            return FALSE;
        }
        if ($name == 'embassyBuildingSubTabs') {
            $tab = ['find', 'join', 'found', 'info', 'leave'][$this->data['favorTabs'][$name]];
            if (in_array($tab, ['find', 'join', 'found']) && $this->getAllianceId()) {
                $tab = 'info';
            } else if (in_array($tab, ['info', 'leave']) && !$this->getAllianceId()) {
                $tab = 'find';
            }
            return $tab;
        }
        return $this->data['favorTabs'][$name];
    }

    public function getAllianceId()
    {
        return (int)$this->get("aid");
    }

    public function hasNewMessage()
    {
        return $this->get("ok") == 1;
    }

    public function banned()
    {
        return $this->get("access") == 0;
    }

    public function needValidation()
    {
        return SessionVar::getVariable("reCaptchaValidation", true, 1200) == FALSE;
    }

    public function setValidationStatus($status)
    {
        SessionVar::setVariable('reCaptchaValidation', $status);
    }
}