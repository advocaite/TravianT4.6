<?php

use Core\Database\DB;

$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT uid FROM hero");
while ($row = $stmt->fetch_assoc()) {
    $items = $db->query("SELECT * FROM items WHERE uid={$row['uid']}");
    $placeId = 0;
    while ($item = $items->fetch_assoc()) {
        $placeId++;
        $db->query("UPDATE items SET placeId=$placeId WHERE id={$item['id']}");
    }
}
if (!$isInternal) {
    echo 'Patch done.', time();
}