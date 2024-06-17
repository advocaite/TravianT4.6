<?php

namespace Game\Buildings;

use Core\Database\DB;
use Game\Formulas;
use Model\VillageModel;

class AutoUpgrade
{
    private $buildings = [];
    private $capital   = false;
    private $kid;
    private $race      = 5;

    public function getBuildings()
    {
        $this->buildings = (new VillageModel())->getBuildingsAssoc($this->kid);
    }

    public function __construct($kid, $race = 5)
    {
        $this->setKid($kid);
        $this->race = $race;
        $this->getBuildings();
    }

    public function setKid($kid)
    {
        $this->kid = $kid;
    }

    public function isCapital()
    {
        $this->capital = true;
    }

    public function newBuilding($rand_field)
    {
        $db = DB::getInstance();
        $helper = new BuildingHelper();
        if ($rand_field == 39) {
            if ($helper->canCreateNewBuild($this->capital, 5, 16, $this->buildings) == 1) {
                if (!$this->buildings[$rand_field]['item_id']) {
                    $this->buildings[$rand_field]['item_id'] = 16;
                    $db->query("UPDATE fdata SET f{$rand_field}t=16 WHERE kid=" . $this->kid);
                    $this->addUpgrade($rand_field);
                }
                return;
            }
            return;
        }
        if ($rand_field == 40) {
            $buildingGID = Formulas::getWallID($this->race);
            if ($helper->canCreateNewBuild($this->capital, 5, $buildingGID, $this->buildings) == 1) {
                if (!$this->buildings[$rand_field]['item_id']) {
                    $this->buildings[$rand_field]['item_id'] = $buildingGID;
                    $db->query("UPDATE fdata SET f{$rand_field}t=$buildingGID WHERE kid=" . $this->kid);
                    $this->addUpgrade($rand_field);
                }
                return;
            }
            return;
        }
        $rand_arr = [
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23, /*more crannies*/
            23,
            23,
            23,
            23,
            23,
            23,/*more crannies*/
            24,
            25, /*26, */
            27,
            28,/*29, 30,*/
            34,
            35,
            36,
            37,
            // 38,
            // 39,
            44,
            45
        ];
        shuffle($rand_arr);
        foreach ($rand_arr as $gid) {
            if ($gid == 16 && $rand_field != 39) {
                continue;
            }
            if ($helper->checkArtifactDependencies(0,
                    1,
                    $this->kid,
                    $gid,
                    false,
                    0) == 0 && $helper->canCreateNewBuild($this->capital, 5, $gid, $this->buildings) == 1) {
                if (!$this->buildings[$rand_field]['item_id']) {
                    $this->buildings[$rand_field]['item_id'] = $gid;
                    $db->query("UPDATE fdata SET f{$rand_field}t=$gid WHERE kid=" . $this->kid);
                    $this->addUpgrade($rand_field);
                }
                return;
            }
        }
    }

    public function addUpgrade($field)
    {
        $this->buildings[$field]['level']++;
        BuildingAction::upgrade($this->kid, $field);
    }

    public function upgrade()
    {
        $rand_field = mt_rand(1, 10) <= 6 ? mt_rand(1, 18) : mt_rand(19, 40);

        if ($this->buildings[$rand_field]['item_id'] <= 0) {
            $this->newBuilding($rand_field);
        } else {
            $max = Formulas::buildingMaxLvl($this->buildings[$rand_field]['item_id'], $this->capital, false);
            if ($this->buildings[$rand_field]['level'] < $max) {
                $this->addUpgrade($rand_field);
            }
        }
    }
}