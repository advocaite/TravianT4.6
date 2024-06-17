<?php
use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Core\Helper\Notification;
use Game\NoticeHelper;
use Model\InfoBoxModel;
use Game\Formulas;
require_once __DIR__ . DIRECTORY_SEPARATOR . "bootstrap.php";
define("PATCH_VERSION", 99);
define("FORCE_PATCH", false);
define("IS_UPDATE", true);
set_time_limit(0);
ignore_user_abort(true);
ini_set("memory_limit", -1);
ErrorHandler::getInstance()->setAsCGI();
$db = DB::getInstance();
$config = Config::getInstance();
$isInstall = false;
if (in_array("--goToMaintenance", $argv)) {
    $db->query("UPDATE config SET maintenance=1");
    return;
}
if (in_array("--backFromMaintenance", $argv)) {
    $db->query("UPDATE config SET maintenance=0");
    return;
}
//no need to update when it's up to date.
if (in_array("--new-installation", $argv)) {
    $isInstall = true;
    goto patchDone;
}
//checking version
$currentVersion = (int)$db->fetchScalar("SELECT patchVersion FROM config");
if ($currentVersion >= PATCH_VERSION && !FORCE_PATCH) return;
/***************************** PATCHES START **********************************/
if ($currentVersion <= 45) {
    require __DIR__ . "/fixes/fixAllResources.php";
    require __DIR__ . "/fixes/fixStorages.php";
    require __DIR__ . "/fixes/fixPopCp.php";
}
if ($currentVersion <= 46) {
    $db->query("ALTER TABLE `login_handshake` ADD `isSitter` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `token`;");
}
if ($currentVersion <= 47) {
    $db->query("ALTER TABLE `vdata` CHANGE `upkeep` `upkeep` BIGINT(50) UNSIGNED NOT NULL DEFAULT '0';");
}
if ($currentVersion <= 48) {
    $db->query("ALTER TABLE `users` ADD `lastHeroExpCheck` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `lastVillageExpand`;");
}
if ($currentVersion <= 50) {
    $db->query("UPDATE map_block SET version=version+1");
}
if ($currentVersion <= 51) {
    $db->query("ALTER TABLE `vdata` CHANGE `cp` `cp` INT(10) NOT NULL");
    $db->query("ALTER TABLE `vdata` CHANGE `pop` `pop` INT(10) NOT NULL");
    $db->query("ALTER TABLE `users` CHANGE `total_name_changes` `total_name_changes` TINYINT(3) NOT NULL DEFAULT '0'");
    $db->query("ALTER TABLE `users` CHANGE `total_pop` `total_pop` BIGINT(255) NOT NULL DEFAULT '0'");
    $db->query("ALTER TABLE `users` CHANGE `total_villages` `total_villages` INT(5) NOT NULL DEFAULT '0'");
    $db->query("ALTER TABLE `users` CHANGE `total_report_count` `total_report_count` BIGINT(100) NOT NULL DEFAULT '0'");
}
if ($currentVersion <= 53) {
    for ($i = 1; $i <= 11; ++$i) {
        $db->query("ALTER TABLE `units` CHANGE `u{$i}` `u{$i}` BIGINT(50) UNSIGNED NOT NULL DEFAULT '0'");
    }
    $db->query("ALTER TABLE `units` CHANGE `u99` `u99` BIGINT(50) UNSIGNED NOT NULL DEFAULT '0'");
}
if ($currentVersion <= 54) {
    require __DIR__ . "/fixes/fixStorages.php";
}
if ($currentVersion <= 56) {
    require __DIR__ . "/fixes/fixPopCp.php";
}
if ($currentVersion <= 57) {
    $db->query("ALTER TABLE `vdata` ADD `free_crop` BIGINT(50)  NOT NULL  DEFAULT '0' AFTER `cropp`;");
}
if ($currentVersion <= 59) {
    $db->query("ALTER TABLE `friendlist` CHANGE `accepted` `accepted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';");
}
if ($currentVersion <= 60) {
    $db->query("ALTER TABLE `users` CHANGE `cp_prod` `cp_prod` INT(11) NOT NULL DEFAULT '0'");
    $db->query("ALTER TABLE `users` CHANGE `alliance_contributions` `alliance_contributions` BIGINT(11) UNSIGNED NOT NULL DEFAULT '0'");
}
if ($currentVersion <= 61) {
    $db->query("ALTER TABLE `building_upgrade` ADD `start_time` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `isMaster`;");
    $db->query("UPDATE building_upgrade SET start_time=commence");
}
if ($currentVersion <= 62) {
    $db->query("ALTER TABLE `odata` DROP `woodp`");
    $db->query("ALTER TABLE `odata` DROP `clayp`");
    $db->query("ALTER TABLE `odata` DROP `ironp`");
    $db->query("ALTER TABLE `odata` DROP `cropp`");
    $db->query("ALTER TABLE `odata` DROP `maxstore`");
    $db->query("ALTER TABLE `odata` DROP `maxcrop`");
}
if ($currentVersion <= 64) {
    $db->query("ALTER TABLE `users` ADD `uuid` VARCHAR(50) NULL AFTER `id`, ADD UNIQUE (`uuid`)");
    $db->query("UPDATE users SET uuid=UUID()");
}
if ($currentVersion <= 65) {
    $db->query("ALTER TABLE `odata` CHANGE `totalTrainCycles` `lastfarmed` INT(11) NOT NULL DEFAULT '0'");
    $db->query("UPDATE odata SET lastfarmed=0, lasttrain=0");
}
if ($currentVersion <= 66) {
    $db->query("ALTER TABLE `odata` CHANGE `wood` `wood` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `odata` CHANGE `clay` `clay` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `odata` CHANGE `iron` `iron` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `odata` CHANGE `crop` `crop` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");


    $db->query("ALTER TABLE `vdata` CHANGE `wood` `wood` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `vdata` CHANGE `clay` `clay` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `vdata` CHANGE `iron` `iron` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
    $db->query("ALTER TABLE `vdata` CHANGE `crop` `crop` DOUBLE(50,4) NOT NULL DEFAULT '0.0000';");
}
if ($currentVersion <= 67) {
    $db->query("UPDATE items SET placeId=0");
    $stmt = $db->query("SELECT id FROM users");
    while ($row = $stmt->fetch_assoc()) {
        $items = $db->query("SELECT * FROM items WHERE uid={$row['id']}");
        $placeId = 1;
        while ($item = $items->fetch_assoc()) {
            $db->query("UPDATE items SET placeId=$placeId WHERE id={$item['id']}");
            ++$placeId;
        }
    }
}
if ($currentVersion <= 68) {
    $db->query("ALTER TABLE `training` ADD INDEX(`kid`);");
    $db->query("ALTER TABLE `enforcement` ADD INDEX(`kid`);");
    $db->query("ALTER TABLE `enforcement` ADD INDEX(`to_kid`);");
    $db->query("ALTER TABLE `trapped` ADD INDEX(`kid`);");
    $db->query("ALTER TABLE `trapped` ADD INDEX(`to_kid`);");
    $db->query("ALTER TABLE `items` ADD INDEX(`uid`);");
    $db->query("ALTER TABLE `mdata` ADD INDEX(`uid`);");
    $db->query("ALTER TABLE `mdata` ADD INDEX(`to_uid`);");
}
if ($currentVersion <= 69) {
    //Skipped
}
if ($currentVersion <= 70) {
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`kid`);");
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`size`);");
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`conquered`);");
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`status`);");
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`type`);");
    $db->query("ALTER TABLE `artefacts` ADD INDEX(`effecttype`);");
}
if ($currentVersion <= 71) {
    require __DIR__ . "/fixes/fixAllResources.php";
    require __DIR__ . "/fixes/fixPopCp.php";
    require __DIR__ . "/fixes/fixStorages.php";
}
if ($currentVersion <= 72) {
    $db->query("ALTER TABLE `vdata` CHANGE `upkeep` `upkeep` BIGINT(50) NOT NULL DEFAULT '0'");
}
if ($currentVersion <= 73) {
    require __DIR__ . "/fixes/fixAllResources.php";
    require __DIR__ . "/fixes/fixPopCp.php";
    require __DIR__ . "/fixes/fixStorages.php";
    require __DIR__ . "/fixes/fixUpkeeps.php";

    $stmt = $db->query("SELECT id, type, data from ndata");
    while ($row = $stmt->fetch_assoc()) {
        try {
            $str = $db->real_escape_string(NoticeHelper::convertReport($row['type'], unserialize($row['data'])));
            $db->query("UPDATE ndata SET data='$str' WHERE id={$row['id']}");
        } catch (\Exception $e) {

        }
    }
}
if ($currentVersion <= 74) {
    $db->query("ALTER TABLE `vdata` DROP `free_crop`;");
}
if ($currentVersion <= 75) {
//    $db->query("ALTER TABLE `movement` DROP INDEX `start_time`, ADD INDEX `start_time` (`start_time`) USING BTREE;");
//    $db->query("ALTER TABLE `movement` DROP INDEX `start_time`;");
//    $db->query("ALTER TABLE `movement` ADD INDEX(`end_time`);");
}
if ($currentVersion <= 76) {
    $stmt = $db->query("SELECT id, type, data from ndata");
    while ($row = $stmt->fetch_assoc()) {
        try {
            $str = $db->real_escape_string(NoticeHelper::convertReport($row['type'], NoticeHelper::parseReportX($row['type'], $row['data'])));
            $db->query("UPDATE ndata SET data='$str' WHERE id={$row['id']}");
        } catch (\Exception $e) {

        }
    }
}
if ($currentVersion <= 77) {
    $db->query("ALTER TABLE `vdata` DROP INDEX `findBy`");
    $db->query("ALTER TABLE `vdata` DROP INDEX `findBy1`");
    $db->query("ALTER TABLE `vdata` DROP INDEX `celebration`");
    $db->query("ALTER TABLE `vdata` ADD INDEX(`owner`);");
    $db->query("ALTER TABLE `vdata` ADD INDEX(`capital`);");
    $db->query("ALTER TABLE `vdata` ADD INDEX(`isWW`);");
}
if ($currentVersion <= 78) {
    $db->query("ALTER TABLE `vdata` DROP INDEX `update_timers`");
    $db->query("ALTER TABLE `vdata` DROP INDEX `statistics`");
}
if ($currentVersion <= 79) {
    $db->query("ALTER TABLE `adventure` DROP INDEX `uid`");
    $db->query("ALTER TABLE `adventure` ADD INDEX(`kid`);");
    $db->query("ALTER TABLE `adventure` ADD INDEX(`time`);");
}
if ($currentVersion <= 81) {
    $db->query("ALTER TABLE `ndata` ADD INDEX(`viewed`);");
}
if ($currentVersion <= 82) {
    $db->query("ALTER TABLE `adventure` ADD INDEX(`uid`);");
}
if ($currentVersion <= 83) {
    $db->query("ALTER TABLE `ndata` ADD `kid` INT(6) UNSIGNED NULL DEFAULT NULL AFTER `isEnforcement`;");
    $stmt = $db->query("SELECT id, type, data FROM ndata");
    while ($row = $stmt->fetch_assoc()) {
        $data = NoticeHelper::parseReport($row['type'], $row['data']);
        if (isset($data['sender']['kid'])) {
            $db->query("UPDATE ndata SET kid={$data['sender']['kid']} WHERE id={$row['id']}");
        } else if (isset($data['attacker']['kid'])) {
            $db->query("UPDATE ndata SET kid={$data['attacker']['kid']} WHERE id={$row['id']}");
        }
    }
}
if ($currentVersion <= 84) {
    $stmt = $db->query("SELECT id, type, data FROM ndata WHERE kid IS NULL");
    while ($row = $stmt->fetch_assoc()) {
        $data = NoticeHelper::parseReport($row['type'], $row['data']);
        if (isset($data['sender']['kid'])) {
            $db->query("UPDATE ndata SET kid={$data['sender']['kid']} WHERE id={$row['id']}");
        } else if (isset($data['attacker']['kid'])) {
            $db->query("UPDATE ndata SET kid={$data['attacker']['kid']} WHERE id={$row['id']}");
        }
    }
}
if ($currentVersion <= 85) {
    $db->query("ALTER TABLE `ndata` ADD INDEX(`time`);");
}
if ($currentVersion <= 86) {
    $db->query("ALTER TABLE `ndata` DROP INDEX `time`");
}
if ($currentVersion <= 87) {
    $db->query("ALTER TABLE `mdata` ADD INDEX( `uid`, `to_uid`, `viewed`, `delete_receiver`);");
}
if ($currentVersion <= 90) {
    $db->query("ALTER TABLE `alidata` ADD `week_pop_changes`  BIGINT(255) NOT NULL DEFAULT '0' AFTER `week_robber_points`;");
    $result = $db->query("SELECT id, tag, ((SELECT SUM(total_pop) FROM users WHERE alidata.id=users.aid)-alidata.oldPop) AS `points`
FROM alidata WHERE GREATEST(0, (SELECT SUM(total_pop) FROM users WHERE alidata.id=users.aid)-alidata.oldPop)>0 ORDER BY `points` DESC, id ASC");
    while ($row = $result->fetch_assoc()) {
        $db->query("UPDATE alidata SET week_pop_changes={$row['points']} WHERE id={$row['id']}");
    }
}
if ($currentVersion <= 91) {
    $db->query("CREATE TABLE `transfer_gold_log` (
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`      INT(11)             NOT NULL,
  `to_uid`      INT(11)             NOT NULL,
  `amount`     VARCHAR(50)         NOT NULL,
  `time`     INT(11)             NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;");
}
if($currentVersion <= 92){
    $db->query("ALTER TABLE `fdata` ADD `heroMansion` INT(2) UNSIGNED NULL DEFAULT '0' NULL AFTER `embassy`;");
    $stmt = $db->query("SELECT * FROM fdata");
    while($row = $stmt->fetch_assoc()){
        $heroMansion = 0;
        for($i = 19; $i <= 38; ++$i){
            if($row['f' . $i . 't'] == 37){
                $heroMansion = $row['f' . $i];
                break;
            }
        }
        $db->query("UPDATE fdata SET heroMansion=$heroMansion WHERE kid={$row['kid']}");
    }
}
if($currentVersion <= 93){
    $db->query("ALTER TABLE `summary` ADD `first_village_player_name` VARCHAR(255) NULL DEFAULT NULL AFTER `huns_players_count`;");
    $db->query("ALTER TABLE `summary` ADD `first_village_time` INT(11) NOT NULL DEFAULT '0' AFTER `first_village_player_name`;");

    $db->query("ALTER TABLE `summary` ADD `first_art_player_name` VARCHAR(255) NULL DEFAULT NULL AFTER `first_village_time`;");
    $db->query("ALTER TABLE `summary` ADD `first_art_time` INT(11) NOT NULL DEFAULT '0' AFTER `first_art_player_name`;");

    $db->query("ALTER TABLE `summary` ADD `first_ww_plan_player_name` VARCHAR(255) NULL DEFAULT NULL AFTER `first_art_time`;");
    $db->query("ALTER TABLE `summary` ADD `first_ww_plan_time` INT(11) NOT NULL DEFAULT '0' AFTER `first_ww_plan_player_name`;");

    $db->query("ALTER TABLE `summary` ADD `first_ww_player_name` VARCHAR(255) NULL DEFAULT NULL AFTER `first_ww_plan_time`;");
    $db->query("ALTER TABLE `summary` ADD `first_ww_time` INT(11) NOT NULL DEFAULT '0' AFTER `first_ww_player_name`;");
}
if($currentVersion <= 94){
    $db->query("CREATE TABLE `farmlist_last_reports`
(
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`  INT(11) UNSIGNED    NOT NULL,
  `kid`  INT(11) UNSIGNED    NOT NULL,
  `report_id`  INT(11) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`uid`, `kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4");
}
if($currentVersion <= 96){
    $m = new InfoBoxModel;
    $players = $db->query("SELECT * FROM users WHERE protection>".time());
    while($player = $players->fetch_assoc()){
        if(!$m->hasInfoByType($player['id'], 6)){
            $m->addInfo($player['id'], false, 6, '', 0, $player['protection']);
        }
    }
}
if($currentVersion <= 97){
    $players = $db->query("SELECT * FROM users WHERE protection>".time());
    while($player = $players->fetch_assoc()){
        $baseProtection = Formulas::getProtectionBasicTime($player['signupTime']);
        $db->query("UPDATE users SET protection=signupTime+{$baseProtection} WHERE id={$player['id']}");
    }
}
if($currentVersion <= 99){
    require __DIR__ . "/fixes/fixAllResources.php";
    require __DIR__ . "/fixes/fixPopCp.php";
    require __DIR__ . "/fixes/fixStorages.php";
}
//ALTER TABLE `ndata` ADD INDEX( `uid`, `to_kid`, `type`);
/***************************** PATCHES END **********************************/
patchDone:
if (!$isInstall) {
    Notification::notifyReal("Game world \"" . getWorldId() . "\" - \"" . Config::getProperty("settings", "serverName") . "\" was patched to version " . PATCH_VERSION);
}
$db->query("UPDATE config SET patchVersion=" . PATCH_VERSION);