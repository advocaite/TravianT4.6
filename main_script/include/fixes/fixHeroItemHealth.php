<?php
use Core\Database\DB;
use Game\Formulas;
use Game\Helpers\CulturePointsHelper;
use Game\Helpers\HeroHealthHelper;
use Model\AutomationModel;
use Model\VillageModel;
$isInternal = defined("ROOT_PATH");
if(!$isInternal){
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$stmt = $db->query("SELECT uid FROM hero");
while($row = $stmt->fetch_assoc()){
    $itemHealth = (int) HeroHealthHelper::getHeroItemHealth($row['uid']);
    $db->query("UPDATE hero SET itemHealth=$itemHealth WHERE uid={$row['uid']}");
}
if(!$isInternal){
    echo 'Patch done.', time();
}