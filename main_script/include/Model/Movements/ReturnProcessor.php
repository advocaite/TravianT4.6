<?php

namespace Model\Movements;

use Core\Database\DB;
use Model\MasterBuilder;
use Game\ResourcesHelper;

class ReturnProcessor
{
    public function __construct($row)
    {
        $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
        $row['end_time_seconds'] = ceil($row['end_time'] / 1000);

        if ($row['race'] == 5) {
            return;
        } else {
            $db = DB::getInstance();
            $modify = [];
            for ($i = 1; $i <= 11; ++$i) {
                if ($row['u' . $i] < 0) {
                    return; //There is a bug certainly
                }
                if ($row['u' . $i]) {
                    $modify[] = "u{$i}=u{$i}+" . $row['u' . $i];
                }
            }
            if (sizeof($modify)) {
                $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid={$row['to_kid']}");
                if ($row['kid'] != 0) {
                    $db->query("UPDATE vdata SET lastReturn=" . $row['end_time_seconds'] . " WHERE kid={$row['to_kid']}");
                }
            }
            if ($row['data'] == '') {
                return;
            }
            $carryAndLoot = explode(",", $row['data']);
            if (!isset($carryAndLoot[4])) {
                return;
            }
            $db->query("UPDATE vdata SET wood=wood+$carryAndLoot[0], 
                                                clay=clay+$carryAndLoot[1], 
                                                iron=iron+$carryAndLoot[2], 
                                                crop=crop+$carryAndLoot[3] WHERE kid={$row['to_kid']}");
            if(($carryAndLoot[0]+$carryAndLoot[1]+$carryAndLoot[2]+$carryAndLoot[3]) > 0){
                ResourcesHelper::updateVillageResources($row['to_kid']);
            }
            // $master = new MasterBuilder();
            // $master->updateCommence($row['to_kid'], true, true);
        }
    }
}