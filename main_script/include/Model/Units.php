<?php

namespace Model;

use Core\Database\DB;

class Units
{
    public static function modifyUnits($kid, $units)
    {
        $db = DB::getInstance();
        $modify = [];
        for ($i = 1; $i <= 11; $i++) {
            if (isset($units[$i]) && $units[$i] > 0) {
                $modify[] = "u{$i}=u{$i}-" . $units[$i];
            }
        }
        $db->query("SELECT * FROM units WHERE kid=$kid FOR UPDATE");
        $query = $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid=$kid");
        return $query && $db->affectedRows() > 0;
    }
}