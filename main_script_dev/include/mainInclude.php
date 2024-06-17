<?php
use Core\Config;
use Core\Database\GlobalDB;
use Core\Dispatcher;
use Core\Helper\WebService;
use Core\Session;
use Game\ResourcesHelper;
use Model\ArtefactsModel;

require __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php";
$uri = $_SERVER['REQUEST_URI'];
//die(print_r($uri));
$page = pathinfo(explode('?', $uri)[0], PATHINFO_BASENAME);
//basename($uri, '?' . $_SERVER['QUERY_STRING']);
if ($page == ('?' . $_SERVER['QUERY_STRING'])) {
    $page = '/';
}
/*$uriCheck = str_replace(['?'.$_SERVER['QUERY_STRING'], '/'], '', $uri) == $page;
if(!$uriCheck){
    $page = '404';
}
print_r($uri);
print_r($_SERVER['QUERY_STRING']);
die();*/

if (empty($page) || $page == '/') {
    $page = 'index.php';
}

define("LOADED_PAGE", $page);

if (isset($_GET['showTime'])) {
    echo time();
    die;
}
if (isset($_GET['summary'])) {
    require __DIR__ . "/report.php";
    exit;
}
if (isset($_GET['errors']) && Session::getInstance()->isAdmin()) {
    header("Content-Type: text/plain");
    echo file_get_contents(ERROR_LOG_FILE);
    exit;
}
if ($uri == '/register' || $page == 'anmelden.php') {
    $db = GlobalDB::getInstance();
    $server = $db->query("SELECT hidden FROM gameServers WHERE id=" . getWorldUniqueId());
    if ($server->num_rows) {
        $server = $server->fetch_assoc();
        if ($server['hidden']) {
            WebService::redirect(WebService::getProtocol() . WebService::getJustDomain() . '?server=' . getWorldId() . "&developer=1#register");
        } else {
            WebService::redirect(WebService::getProtocol() . WebService::getJustDomain() . '?server=' . getWorldId() . "#register");
        }
    }
}

if ($page == 'myInfo') {
    $session = Session::getInstance();
    header("Content-Type: application/json");
    if (isset($_GET['fix'])) {
        ResourcesHelper::updateVillageUpkeep(-1, $session->village->getKid());
    }
    echo json_encode([
        'pop' => $session->village->village['pop'],
        'upkeep' => $session->village->village['upkeep'],
        'cropp' => $session->village->village['cropp'],
    ]);
    return;
}

if ($uri == '/info') {
    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    if ($httpMethod == 'OPTIONS') {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
        http_response_code(200);
        return;
    }
    header("Content-Type: application/json");
    echo json_encode([
        'worldId' => getWorldId(),
        'worldUniqueId' => (int)getWorldUniqueId(),
        'name' => Config::getProperty('settings', 'serverName'),
        'speed' => getGame('speed'),
        'movement_speed_increase' => getGame('movement_speed_increase'),
        'storage_multiplier' => getGame('storage_multiplier'),
        'starvation' => getGame('starvation'),
        'map_size' => (int)MAP_SIZE,
        'start_time' => date('Y-m-d H:i:s', getGame('start_time')),
        'round_length' => getGame('round_length'),
        'ArtifactsReleaseTime' => date('Y-m-d H:i:s', $config->timers->ArtifactsReleaseTime),
        'WWPlansReleaseTime' => date('Y-m-d H:i:s', $config->timers->wwPlansReleaseTime),
        'WWConstructStartTime' => date('Y-m-d H:i:s', $config->timers->WWConstructStartTime),
        'WWUpLvlInterval' => $config->timers->WWUpLvlInterval,
        'AutoFinishTime' => date('Y-m-d H:i:s', $config->timers->AutoFinishTime),
        'finishTrainingEnabled' => Config::getProperty("extraSettings", "generalOptions", "finishTraining", "enabled")
    ]);
    return;
}
$pages = [
    'detect.php' => '!',
    '403.php' => 'PermissionDeniedCtrl',
    '404.php' => 'PageNotFoundCtrl',
    'activate.php' => 'ActivateCtrl',
    'voucher.php' => 'VoucherCtrl',
    'admin.php' => 'AdminCtrl',
    'ajax.php' => 'AjaxCtrl',
    'allianz.php' => 'AllianceCtrl',
    'reports.php' => 'BerichteCtrl',
    'build.php' => 'BuildCtrl',
    'cropfinder.php' => 'CropfinderCtrl',
    'dorf1.php' => 'Dorf1Ctrl',
    'dorf2.php' => 'Dorf2Ctrl',
    'dorf3.php' => 'Dorf3Ctrl',
    'help.php' => 'HelpCtrl',
    'hero.php' => 'HeroDivider',
    'support.php' => 'SupportCtrl',
    'support_form.php' => 'SupportFormCtrl',
    'hero_body.php' => 'HeroBodyCtrl',
    'hero_image.php' => 'Hero_imageCtrl',
    'silverExchange.php'=>'SilverExchange',
    // 'hero_head.php' => 'Hero_imageCtrl',
    'index.php' => 'LoginCtrl',
    'karte.php' => is_lowres() ? "KarteCtrlLowRes" : "KarteCtrl",
    'linklist.php' => 'LinkListCtrl',
    'login.php' => 'LoginCtrl',
    'logout.php' => 'LogoutCtrl',
    'manual.php' => 'ManualCtrl',
    'map_block.php' => 'Map_blockCtrl',
    'map_mark.php' => 'Map_markCtrl',
    'minimap.php' => 'MinimapCtrl',
    'messages.php' => 'NachrichtenCtrl',
    'options.php' => 'OptionCtrl',
    'password.php' => 'PasswordCtrl',
    'position_details.php' => 'PositionDetailsCtrl',
    'production.php' => 'ProductionCtrl',
    'spieler.php' => 'SpielerCtrl',
    'start_adventure.php' => 'StartAdventure',
    'statistiken.php' => 'StatistikenCtrl',
    'stats.php' => 'StatsCtrl',
    'tgpay.php' => 'TG_PAY',
    'credits.php' => 'CreditsCtrl',
    'verify.php' => 'EmailVerificationCtrl',
    'verify-url.php' => 'EmailVerificationUrlCtrl',
    'heroimageChangeCtrl.php'=>'heroimageChangeCtrl',
    'HeroAuctionCtrl.php'=>'HeroAuctionCtrl'
];

if (isset($pages[$page])) {
    if ($page == 'admin.php') {
        require(__DIR__ . "/admin/include/bootstrap.php");
        \Dispatcher::getInstance();
        return;
    } else if ($page == 'detect.php') {
        require(__DIR__ . "/detect.php");
        return;
    }
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch($pages[$page]);
} else {
    switch ($page) {
        default:
            $dispatcher = new Dispatcher();
            $dispatcher->dispatch($pages['404.php']);
            break;
    }
}