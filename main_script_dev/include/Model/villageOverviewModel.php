<?php

namespace Model;

use Core\Database\DB;

class villageOverviewModel
{
    public function getUnits($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM units WHERE kid=$kid")->fetch_assoc();
    }

    public function getGoingUnits($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM movement WHERE kid=$kid AND mode=0");
    }

    public function getVillageEnforcements($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM enforcement WHERE to_kid=$kid");
    }

    public function getVillageName($kid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT name FROM vdata WHERE kid=$kid");
    }

    public function getOutEnforcement($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM enforcement WHERE kid=$kid");
    }

    public function getOutTrappedUnits($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM trapped WHERE kid=$kid");
    }

    public function getReturningUnits($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM movement WHERE to_kid=$kid AND mode=1");
    }

    public function getVillageUpgradeBuildings($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT building_field FROM building_upgrade WHERE kid=$kid AND isMaster=0");
    }

    public function getFieldItemId($kid, $field)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT f{$field}t FROM fdata WHERE kid=$kid");
    }

    public function getPlayerVillagesCulturePointsData($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT kid, name, cp, celebration, type  FROM vdata WHERE owner=$uid ORDER BY name");
    }

    public function getArmory($kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM smithy WHERE kid=$kid")->fetch_assoc();
    }

    public function getArmoryProgress($kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM research WHERE kid=$kid AND mode=0");
    }

    public function getPlayerVillageResources($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT kid, name, wood, clay, iron, crop FROM vdata WHERE owner=$uid  ORDER BY name");
    }

    public function getPlayerVillageResourcesWarehouse($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT kid, name, wood, woodp, clay, clayp, iron, ironp, pop, upkeep, crop, cropp, maxstore, maxcrop FROM vdata WHERE owner=$uid ORDER BY name");
    }

    public function getVillageTroopsTraining($kid)
    {
        $db = DB::getInstance();
        $training = [];
        $result = $db->query("SELECT * FROM training WHERE kid=$kid AND item_id!=98 ORDER BY nr");
        while ($row = $result->fetch_assoc()) {
            if (!isset($training[$row['item_id']][$row['nr']])) {
                $training[$row['item_id']][$row['nr']] = [
                    'num' => 0,
                    'item_id' => 0,
                ];
            }
            $training[$row['item_id']][$row['nr']]['item_id'] = $row['item_id'];
            $training[$row['item_id']][$row['nr']]['num'] += $row['num'];
        }

        return $training;
    }

    public function getResidencePalaceTraining($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM training WHERE kid=$kid AND (item_id=25 OR item_id=26) ORDER BY nr");
    }

    public function getResidencePalaceLevel($capWref)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$capWref}");
        if (!$buildings->num_rows) {
            return FALSE;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 25 || $buildings['f' . $i . 't'] == 26) {
                return [
                    'item_id' => $buildings['f' . $i . 't'],
                    'level' => $buildings['f' . $i],
                ];
            }
        }
        return 0;
    }

    public function getTHLevel($capWref)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$capWref}");
        if (!$buildings->num_rows) {
            return FALSE;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 24) {
                return $buildings['f' . $i];
            }
        }

        return 0;
    }
}