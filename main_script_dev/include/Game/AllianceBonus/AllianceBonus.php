<?php

namespace Game\AllianceBonus;

use Core\Database\DB;
use Game\Formulas;

class AllianceBonus
{
    public static function getTrainingBonus($aid, $joinTime)
    {
        if ($aid > 0) {
            $db = DB::getInstance();
            $level = $db->fetchScalar("SELECT training_bonus_level FROM alidata WHERE id=$aid");
            if ((time() - $joinTime) > Formulas::getAllianceBonusCoolDownForNewPlayers($level)) {
                return 1 - ($level * 2 / 100);
            }
        }
        return 1;
    }

    public static function getCulturePointProductionBonus($aid, $joinTime)
    {
        if ($aid > 0) {
            $db = DB::getInstance();
            $level = $db->fetchScalar("SELECT cp_bonus_level FROM alidata WHERE id=$aid");
            if ((time() - $joinTime) > Formulas::getAllianceBonusCoolDownForNewPlayers($level)) {
                return 1 + ($level * 2 / 100);
            }
        }

        return 1;
    }

    public static function getTradersBonus($aid, $joinTime)
    {
        if ($aid > 0) {
            $db = DB::getInstance();
            $level = $db->fetchScalar("SELECT trade_bonus_level FROM alidata WHERE id=$aid");
            if ((time() - $joinTime) > Formulas::getAllianceBonusCoolDownForNewPlayers($level)) {
                return 1 + ($level * 20 / 100);
            }
        }

        return 1;
    }

    public static function getArmorBonus($aid, $joinTime)
    {
        if ($aid > 0) {
            $db = DB::getInstance();
            $level = $db->fetchScalar("SELECT armor_bonus_level FROM alidata WHERE id=$aid");
            if ((time() - $joinTime) > Formulas::getAllianceBonusCoolDownForNewPlayers($level)) {
                return 1 + ($level * 2 / 100);
            }
        }
        return 1;
    }
}