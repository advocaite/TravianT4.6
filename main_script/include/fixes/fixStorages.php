<?php
use Core\Database\DB;
use Game\Formulas;
use Model\VillageModel;
$isInternal = defined("ROOT_PATH");
if(!$isInternal){
    require_once(__DIR__ . DIRECTORY_SEPARATOR . "include" . DIRECTORY_SEPARATOR . "bootstrap.php");
}
set_time_limit(0);
ignore_user_abort(true);
if(!function_exists("modify_total_village_store")){
    function modify_total_village_store($buildings, $kid)
    {
        $maxstore = 0;
        $maxcrop = 0;
        for($i = 19; $i <= 38; ++$i){
            if($buildings[$i]['item_id'] == 10) {
                $maxstore += Formulas::storeCAP($buildings[$i]['level']);
            } else if($buildings[$i]['item_id'] == 38) {
                $maxstore += Formulas::bigStoreCAP($buildings[$i]['level']);
            } else if($buildings[$i]['item_id'] == 11) {
                $maxcrop += Formulas::storeCAP($buildings[$i]['level']);
            } else if($buildings[$i]['item_id'] == 39) {
                $maxcrop += Formulas::bigStoreCAP($buildings[$i]['level']);
            }
        }
        if($maxstore == 0) $maxstore = Formulas::storeCAP(0);
        if($maxcrop == 0) $maxcrop = Formulas::storeCAP(0);
        $db = DB::getInstance();
        $result = $db->query("SELECT extraMaxstore, extraMaxcrop FROM vdata WHERE kid=$kid")->fetch_assoc();
        $maxstore += Formulas::storeCAP(20) * $result['extraMaxstore'];
        $maxcrop += Formulas::storeCAP(20) * $result['extraMaxcrop'];
        $db->query("UPDATE vdata SET maxstore=$maxstore, maxcrop=$maxcrop WHERE kid=$kid");
    }
}
$db = DB::getInstance();
$result = $db->query("SELECT kid FROM vdata");
$m = new VillageModel();
while($row = $result->fetch_assoc()){
    modify_total_village_store($m->getBuildingsAssoc($row['kid']), $row['kid']);
}
if(!$isInternal){
    echo 'Patch done.', time();
}