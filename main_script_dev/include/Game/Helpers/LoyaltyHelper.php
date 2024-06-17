<?php

namespace Game\Helpers;

use Core\Database\DB;

class LoyaltyHelper
{
    const UPDATE_DELAY = 600;

    public static function updateVillageLoyalty($kid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid, loyalty, last_loyalty_update FROM vdata WHERE kid=$kid");
        while ($row = $result->fetch_assoc()) {
            if ($row['loyalty'] < 100) {
                //points per hour
                $points = self::getVillageExpansionBuildings($row['kid']);
                //points per second
                $points /= 3600;
                $elapsedSeconds = time() - $row['last_loyalty_update'];
                $points *= $elapsedSeconds;
                $loyalty = min(100, $row['loyalty'] + $points);
                $db->query("UPDATE vdata SET loyalty=$loyalty, last_loyalty_update=" . time() . " WHERE kid={$row['kid']}");
            }
        }
    }

    public static function getVillageExpansionBuildings($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid=$kid")->fetch_assoc();
        for ($i = 19; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 25 || $buildings['f' . $i . 't'] == 26 || $buildings['f' . $i . 't'] == 44) {
                return (int)$buildings['f' . $i];
                break;
            }
        }
        return 0;
    }

    public static function updateUserVillagesLoyalty($uid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid, loyalty, last_loyalty_update FROM vdata WHERE owner=$uid");
        while ($row = $result->fetch_assoc()) {
            $loyalty = $row['loyalty'];
            if ($loyalty < 100) {
                //points per hour
                $points = self::getVillageExpansionBuildings($row['kid']);
                //points per second
                $points /= 3600;
                $elapsedSeconds = time() - $row['last_loyalty_update'];
                $points *= $elapsedSeconds;
                $loyalty = min(100, $loyalty + $points);
            }
            $db->query("UPDATE vdata SET loyalty=$loyalty, last_loyalty_update=" . time() . " WHERE kid={$row['kid']}");
        }
    }

    public static function updateVillageOasesLoyalty($kid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid, did, loyalty, last_loyalty_update FROM odata WHERE owner>0 AND did=$kid");
        while ($row = $result->fetch_assoc()) {
            $loyalty = $row['loyalty'];
            if ($loyalty < 100) {
                //points per hour
                $points = self::getVillageExpansionBuildings($row['did']);
                //points per second
                $points /= 3600;
                $elapsedSeconds = time() - $row['last_loyalty_update'];
                $points *= $elapsedSeconds;
                $loyalty = min(100, $row['loyalty'] + $points);
            }
            $db->query("UPDATE odata SET loyalty=$loyalty, last_loyalty_update=" . time() . " WHERE kid={$row['kid']}");
        }
    }

    public static function updateOasisLoyalty($kid)
    {
        $db = DB::getInstance();
        $result = $db->query("SELECT kid, did, loyalty, last_loyalty_update FROM odata WHERE owner>0 AND kid=$kid");
        while ($row = $result->fetch_assoc()) {
            //points per hour
            $points = self::getVillageExpansionBuildings($row['did']);
            //points per second
            $points /= 3600;
            $elapsedSeconds = time() - $row['last_loyalty_update'];
            $points *= $elapsedSeconds;
            $loyalty = min(100, $row['loyalty'] + $points);
            $db->query("UPDATE odata SET loyalty=$loyalty, last_loyalty_update=" . time() . " WHERE kid={$row['kid']}");
        }
    }
}