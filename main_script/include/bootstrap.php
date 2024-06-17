<?php
use Core\Caching\Caching;
use Core\Caching\GlobalCaching;
use Core\Config;
use Core\Database\DB;
use Core\Database\GlobalDB;
use Core\Helper\WebService;
if (!function_exists("geoip_country_code_by_name")) {
    die("Geoip extension not available.");
}
if (!extension_loaded("redis")) {
    die("Redis extension not available.");
}
$start_time = microtime(true);
if (php_sapi_name() != 'cli') {
    set_time_limit(120);
    ob_start();
    if (!session_start()) {
        logError("Could not start session.");
        die("Couldn't start session.");
    }
}
define("GLOBAL_CACHING_KEY", get_current_user());
define("ROOT_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("PUBLIC_INTERNAL_PATH", dirname(__DIR__) . "copyable/public/");
define("INCLUDE_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("RESOURCES_PATH", INCLUDE_PATH . "resources" . DIRECTORY_SEPARATOR);
define("LOCALE_PATH", RESOURCES_PATH . "Translation" . DIRECTORY_SEPARATOR);
define("TEMPLATES_PATH", RESOURCES_PATH . "Templates" . DIRECTORY_SEPARATOR);
require_once INCLUDE_PATH . "Core" . DIRECTORY_SEPARATOR . 'Autoloader.php';
require_once INCLUDE_PATH . "functions.general.php";
global $config;
$cache = Caching::getInstance();
$config = Config::getInstance();
if (!property_exists($config, 'db')) {
    die("Installation is not completed.");
}
$db = DB::getInstance();
{
    if (true || php_sapi_name() == 'cli') {
        $result = $db->query("SELECT * FROM config");
        if (!$result->num_rows) {
            logError("No config row found.");
            exit("We are having issues, please try again in a moment. E1");
        }
        $config->dynamic = (object)$result->fetch_assoc();
    } else {
        if (($_cache = $cache->get("WorldConfig"))) {
            $config->dynamic = $_cache;
        } else {
            $result = $db->query("SELECT * FROM config");
            if (!$result->num_rows) {
                logError("No config row found.");
                exit("We are having issues, please try again in a moment. E1");
            }
            $cache->set('WorldConfig', (object)$result->fetch_assoc(), 300);
        }
    }
    if (property_exists($config, 'startTime')) {
        logError("No column found in config row.");
        exit("We are having issues, please try again in a moment. E2");
    }
    $config->game->start_time = $config->dynamic->startTime;
    $config->settings->worldUniqueId = $config->dynamic->worldUniqueId;
    define("MAP_SIZE", $config->dynamic->map_size);
}
if (property_exists($config->dynamic, 'isRestore') && $config->dynamic->isRestore && !defined("IS_UPDATE")) {
    exit("We are having issues, please try again in a moment. E3");
}
require(INCLUDE_PATH . "config/config.after.php");
if (!$config->dynamic->installed) {
    $config->dynamic->maintenance = true;
}
function check_ip_access()
{
    $ip = WebService::ipAddress();
    if (!empty($ip)) {
        $ip = ip2long($ip);
        $cache = GlobalCaching::getInstance();
        if (!($banned = $cache->get("IPCheck:$ip"))) {
            $banned = GlobalDB::getInstance()->query("SELECT * FROM banIP WHERE ip='$ip' AND (blockTill=0 OR blockTill > " . time() . ")");
            $cache->set("IPCheck:$ip", $banned->num_rows ? $banned->fetch_assoc() : [], 1440);
        }
        if (is_array($banned) && sizeof($banned) > 1) {
            exit("You are not allowed to access here.");
        }
    }
}

if (php_sapi_name() != 'cli') {
    Caching::getInstance();
    check_ip_access();
}
