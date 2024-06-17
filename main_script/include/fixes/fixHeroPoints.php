<?php
use Core\Database\DB;
use Game\Formulas;
$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT * FROM hero");
while ($row = $stmt->fetch_assoc()) {
    $lvl = Formulas::heroLevel($row['exp']);
    $points = ($lvl >= 100 ? 100 : $lvl) * 4;
    if ($lvl < 100) {
        $points += 4;
    }
    $available = $points - ($row['power'] + $row['offBonus'] + $row['defBonus'] + $row['production']);
    if ($available >= 0) continue;
    $min = floor($points / 4);
    $db->query("UPDATE hero SET power=$min, offBonus=$min, defBonus=$min, production=$min WHERE uid={$row['uid']}");
}
if (!$isInternal) {
    echo 'Patch done.', time();
}