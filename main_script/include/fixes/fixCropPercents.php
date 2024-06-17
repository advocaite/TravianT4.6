<?php

use Core\Database\DB;
use Model\OasesModel;

$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT id FROM wdata WHERE (fieldtype=1 OR fieldtype=6)");
while ($row = $stmt->fetch_assoc()) {
    $percent = OasesModel::getNearByFieldCropPercent($row['id']);
    $db->query("UPDATE wdata SET crop_percent=$percent WHERE id={$row['id']}");
}
if (!$isInternal) {
    echo 'Patch done.', time();
}