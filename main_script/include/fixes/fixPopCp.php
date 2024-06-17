<?php

use Core\Database\DB;
use Core\Village;
use Game\Formulas;
use Game\Helpers\CulturePointsHelper;
use Model\RegisterModel;
use Model\VillageModel;

$isInternal = defined("ROOT_PATH");
if (!$isInternal) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
$db = DB::getInstance();
$result = $db->query("SELECT kid, isWW FROM vdata");
$m = new VillageModel();
$natars_cap = Formulas::xy2kid(0, 0);
while ($row = $result->fetch_assoc()) {
    $cpPop = VillageModel::calculateVillageCulturePointsAndPopulation($row['kid'], $row['isWW'] == 1);
    if ($row['kid'] == $natars_cap) {
        $cpPop['pop'] = 781;
    }
    $db->query("UPDATE vdata SET pop={$cpPop['pop']}, cp={$cpPop['cp']} WHERE kid={$row['kid']}");
}
$result = $db->query("SELECT id FROM users");
while ($row = $result->fetch_assoc()) {
    $total_villages = (int)$db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE owner={$row['id']}");
    $total_pop = (int)$db->fetchScalar("SELECT SUM(pop) FROM vdata WHERE owner={$row['id']}");
    $cp = (int)CulturePointsHelper::getHeroCPProduction($row['id']);
    $cp += (int)$db->fetchScalar("SELECT SUM(cp) FROM vdata WHERE owner={$row['id']}");
    $db->query("UPDATE users SET total_villages=$total_villages, total_pop=$total_pop, cp_prod=$cp WHERE id={$row['id']}");
}
if (!$isInternal) {
    echo 'Patch done.', time();
}
