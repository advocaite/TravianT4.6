<?php

namespace Model;

use Core\Database\DB;
use Game\AllianceBonus\AllianceBonus;

class BattleNew
{
    public function __construct($row)
    {

        $data = [];
        $data['is_normal'] = $row['attack_type'] == MovementsModel::ATTACKTYPE_RAID;
        {
            {
                $data['attacker']['info'] = [];
                $data['attacker']['info']['pop'] = 0;
                if ($data['is_normal']) {
                    $data['attacker']['info']['big_party'] = false;
                }
                $data['attacker']['info']['brewery_lvl'] = false;
            }
            {
                $data['attacker']['waves'] = [];
                $wave = &$data['attacker']['waves'][];

                $wave['units'] = array_filter_units($row);
                $wave['lvl'] = $this->getSmithy($row['kid']);
                if ($wave['units'][11]) {
                    $wave['hero'] = [];
                }
                $wave['metallurgy_eff'] = AllianceBonus::getArmorBonus(0, 0);
                $wave['scout_art_eff'] = ArtefactsModel::getArtifactEffectByType($row['uid'], $row['kid'], ArtefactsModel::ARTIFACT_SPY);
            }
        }
        {
            {
                $data['defender']['info'] = [];
                $data['defender']['info']['pop'] = 0;
                if ($data['is_normal']) {
                    $data['defender']['info']['big_party'] = false;
                }
                $wave['scout_art_eff'] = ArtefactsModel::getArtifactEffectByType($row['uid'], $row['kid'], ArtefactsModel::ARTIFACT_SPY);
            }
            {
                $data['defender']['waves'] = [];

                $wave = &$data['attacker']['waves'][];
                $wave['units'] = $this->getUnits($row['to_kid']);
                $wave['lvl'] = $this->getSmithy($row['to_kid']);
                if ($wave['units'][11]) {
                    $wave['hero'] = [];
                }
                $wave['metallurgy_eff'] = AllianceBonus::getArmorBonus(0, 0);
            }
        }

        if ($data['is_normal']) {
            //Cata, rAM, Cheif
        }
    }

    private function getUnits($kid)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM units WHERE kid=$kid");
        if ($stmt->num_rows) {
            return array_filter_units($stmt->fetch_assoc());
        }
        return [1 => 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }
    private function getSmithy($kid)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM smithy WHERE kid=$kid");
        if ($stmt->num_rows) {
            $stmt = $stmt->fetch_assoc();
            $result = [];
            for ($i = 1; $i <= 8; ++$i) {
                $result[$i] = (int)min(20, $stmt['u' . $i]);
            }
            return $result;
        }
        return [1 => 0, 0, 0, 0, 0, 0, 0, 0];
    }
}