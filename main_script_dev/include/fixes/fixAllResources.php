<?php
use Core\Database\DB;
use Game\ResourcesHelper;
use Model\VillageModel;
$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT owner, kid, isWW FROM vdata");
while($row = $stmt->fetch_assoc()){
    ResourcesHelper::updateVillageResources($row['kid'], FALSE);
    ResourcesHelper::updateVillageUpkeep($row['owner'], $row['kid'], $row['isWW']);
}
if (!$isInternal) {
    echo 'Patch done.', time();
}