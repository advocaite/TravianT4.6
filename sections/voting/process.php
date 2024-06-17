<?php
use Core\Types;
use Core\WebService;
require __DIR__ . "/include/bootstrap.php";
$type = strtolower($_GET['type']) ?? null;
if (!isset($_REQUEST['token']) || strcmp($_REQUEST['token'], 'A731mYCG') !== 0) {
    exit("Invalid token!");
}
error_log('Voting received.');
if ($type == 'topg') {
    error_log('TopG Received: ' . print_r($_REQUEST, true));
    //check if response is coming from TopG
    if (!(WebService::ipAddress() == gethostbyname("monitor.topg.org")))
        die("Invalid IP address.");
    $p = preg_replace('/[^A-Za-z0-9\_]+/', '', $_GET['p_resp']);
    $user_ip = preg_replace('/[^0-9\.]+/', '', $_GET['ip']);
    list($worldUniqueId, $playerId) = explode("_", $p);
    add_gold(Types::TOP_G, $user_ip, (int) $worldUniqueId, (int) $playerId, 'TopG');
} else if ($type == 'gtop100') {
    error_log('GTop100 Received: ' . print_r($_REQUEST, true));
    $authorized = array("198.148.82.98", "198.148.82.99"); // authorized ips to prevent exploitation
    if (!in_array(WebService::ipAddress(), $authorized))
        die("Invalid IP address.");
    $voterIP = $_POST["VoterIP"]; // voter ip address
    $success = abs($_POST["Successful"]); // 1 for error, 0 for successful
    $reason = $_POST["Reason"]; // log reason the vote failed
    $pingUsername = $_POST["pingUsername"];
    if (empty($voterIP) || intval($success) === 1) {
        die("Error");
    }
    list($worldUniqueId, $playerId) = explode("_", $pingUsername);
    add_gold(Types::G_TOP_100, $voterIP, (int) $worldUniqueId, (int) $playerId, 'GTop100');
} else if ($type == 'arenatop100') {
    error_log('AreaTop100 Received: ' . print_r($_REQUEST, true));
    $userId = isset($_REQUEST['userid']) ? $_REQUEST['userid'] : null;
    $userIp = isset($_REQUEST['userip']) ? $_REQUEST['userip'] : null;
    $valid = isset($_REQUEST['voted']) ? intval($_REQUEST['voted']) : 0;
    $at_refc = isset($_REQUEST['at_refc']) ? $_REQUEST['at_refc'] : null;
    if (is_null($userId) || is_null($userIp) || !$valid) {
        return;
    }
    list($worldUniqueId, $playerId) = explode("_", $userId);
    add_gold(Types::ARENA_TOP_100, $userIp, (int) $worldUniqueId, (int) $playerId, 'ArenaTop100');
}