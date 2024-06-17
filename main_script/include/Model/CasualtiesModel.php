<?php

namespace Model;

use Core\Database\DB;

class CasualtiesModel
{
    public function getLastDaysCasualties($days = 5)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM casualties ORDER BY id DESC LIMIT " . $days);
    }

    public function setTodayCasualties($casualties)
    {
        $db = DB::getInstance();
        $db->query("UPDATE casualties SET attacks=attacks+1, casualties=casualties+$casualties WHERE time=" . strtotime("today 00:00"));
        if (!$db->affectedRows()) {
            $db->query("INSERT INTO casualties (attacks, casualties, time) VALUES (0, 0, " . strtotime("today 00:00") . ")");
            $db->query("UPDATE casualties SET attacks=attacks+1, casualties=casualties+$casualties WHERE time=" . strtotime("today 00:00"));
        }
    }
}