<?php
use Core\Database\DB;

$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT * FROM fdata");
while ($rw = $stmt->fetch_assoc()) {
    for ($i = 19; $i <= 40; ++$i) {
        if ($rw['f' . $i . 't'] > 0 && $rw['f' . $i] == 0) {
            $tasks = $db->query("SELECT COUNT(id) FROM building_upgrade WHERE kid={$rw['kid']} AND building_field={$i}")->fetch_row()[0];
            if ($tasks == 0) {
                $db->query("UPDATE fdata SET f{$i}t=0 WHERE kid={$rw['kid']}");
            }
        }
    }
}
if (!$isInternal) {
    echo 'Patch done.', time();
}