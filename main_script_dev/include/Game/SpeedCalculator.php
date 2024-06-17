<?php

namespace Game;

use Core\Config;
use Core\Database\DB;
use Game\Hero\HeroItems;
use Model\ArtefactsModel;
use Model\WonderOfTheWorldModel;
use function getCustom;
use function unitIdToNr;
use function unitIdToTribe;

class SpeedCalculator
{
    private $isOwn           = FALSE;
    private $isReturn        = FALSE;
    private $isAlliance      = FALSE;
    private $hasHero         = FALSE;
    private $minSpeed        = 1;
    private $leftHand        = [];
    private $shoes           = [];
    private $tournamentSqLvl = 0;
    private $artefactEffect  = 1;

    private $from;
    private $to;

    public function isOwn()
    {
        $this->isOwn = TRUE;
    }

    public function isReturn()
    {
        $this->isReturn = TRUE;
    }

    public function isAlliance()
    {
        $this->isAlliance = TRUE;
    }

    public function hasHero()
    {
        $this->hasHero = TRUE;
    }

    public function isCavalryOnly($unitsId, $allowOnlyHero = false)
    {
        $is_cavalary = [
            1 => [4 => 1, 5 => 1, 6 => 1],
            2 => [4 => 1, 5 => 1, 6 => 1],
            3 => [3 => 1, 4 => 1, 5 => 1, 6 => 1],
            4 => [],
            5 => [5 => 1, 6 => 1],
            6 => [4 => 1, 5 => 1, 6 => 1],
            7 => [4 => 1, 5 => 1, 6 => 1],
        ];
        $isCavalryOnly = true;
        foreach ($unitsId as $k) {
            $race = unitIdToTribe($k);
            if (!isset($is_cavalary[$race][unitIdToNr($k)])) {
                return false;
            }
        }
        return $isCavalryOnly;
    }

    public function setArtefactEffect($effect)
    {
        $this->artefactEffect = $effect;
    }

    public function setTournamentSqLvl($lvl)
    {
        if ($lvl <= 0) {
            return;
        }
        $this->tournamentSqLvl = $lvl;
    }

    //kid or x|y
    public function setFrom($kid)
    {
        $this->from = $kid;
    }

    //kid or x|y
    public function setTo($kid)
    {
        $this->to = $kid;
    }

    public function setMinSpeed($minSpeed)
    {
        if (is_array($minSpeed)) {
            if (sizeof($minSpeed) == 0) {
                $minSpeed = 1;
            } else {
                $minSpeed = min($minSpeed);
            }
        }
        if ($minSpeed < 1) {
            $minSpeed = 1;
        }
        $this->minSpeed = $minSpeed;
    }

    public function setLeftHand($params)
    {
        $this->leftHand = $this->procInput($params);
    }

    public function procInput($id)
    {
        if (is_array($id)) {
            return $id;
        }
        if (!$id) {
            return NULL;
        }
        $db = DB::getInstance();
        return $db->query("SELECT * FROM items WHERE id={$id}")->fetch_assoc();
    }

    public function setShoes($params)
    {
        $this->shoes = $this->procInput($params);
    }

    public function hasCata($result = true)
    {
        $this->hasCata = $result;
    }

    public $hasCata           = false;
    public $troopsAreWithHero = false;

    public function troopsWithHero()
    {
        $this->troopsAreWithHero = true;
    }


    public function calc()
    {
        $minSpeed = $this->minSpeed;
        $distance = Formulas::getDistance($this->from, $this->to);
        if ($this->hasHero) {
            $heroItems = new HeroItems();
            if (is_array($this->leftHand) && $this->leftHand['btype'] == 3) {
                if ($this->isReturn
                    && in_array($this->leftHand['type'],
                        [
                            61,
                            62,
                            63,
                        ])
                ) {
                    $item = $heroItems->getHeroItemProperties($this->leftHand['btype'], $this->leftHand['type']);
                    $minSpeed *= 1 + $item['return_speed'] / 100;
                }
                if ($this->isOwn
                    && in_array($this->leftHand['type'],
                        [
                            64,
                            65,
                            66,
                        ])
                ) {
                    $item = $heroItems->getHeroItemProperties($this->leftHand['btype'], $this->leftHand['type']);
                    $minSpeed *= 1 + $item['speed_own'] / 100;
                }
                if ($this->isAlliance
                    && in_array($this->leftHand['type'],
                        [
                            67,
                            68,
                            69,
                        ])
                ) {
                    $item = $heroItems->getHeroItemProperties($this->leftHand['btype'], $this->leftHand['type']);
                    $minSpeed *= 1 + $item['speed_alliance'] / 100;
                }
            }
            if (is_array($this->shoes) && $this->shoes['btype'] == 5
                && in_array($this->shoes['type'],
                    [
                        97,
                        98,
                        99,
                    ])
            ) {
                $item = $heroItems->getHeroItemProperties($this->shoes['btype'], $this->shoes['type']);
                if ($distance > $item['min_distance']) {
                    if($this->troopsAreWithHero)
                        $minSpeed *= 1 + $item['speed_distance'] / 100;
                }
            }
        }

        //artefact effect.
        if ($this->artefactEffect <> 1) {
            $minSpeed *= $this->artefactEffect;
        }
        if ($this->hasCata) {
            if (getCustom("reduceCataSpeedInAttacks") && Config::getProperty("game", "speed") > 500) {
                $rate = getCustom("cataSpeedLowerRate");
                if (ArtefactsModel::artifactsReleased()) {
                    $rate = getCustom("cataSpeedLowerRateAfterArtifactsRelease");
                }
                if (ArtefactsModel::wwPlansReleased()) {
                    $rate = getCustom("cataSpeedLowerRateAfterWWPlanRelease");
                }
                if ($this->isNatars($this->to) || $this->isNatars($this->from)) {
                    if (getCustom("reduceCataSpeedInNatarAttacks")) {
                        $minSpeed /= $rate;
                    }
                } else if ($this->isWW($this->to) || $this->isWW($this->from)) {
                    //do nothing
                } else {
                    $minSpeed /= $rate;
                }
            }
        }
        if ($this->tournamentSqLvl > 0 && $distance > 20) {
            $tournamentSquireEffect = Formulas::TournamentSqValue($this->tournamentSqLvl) / 100;
            $time = (20 / $minSpeed) * 3600;
            $time += (($distance - 20) / ($minSpeed * $tournamentSquireEffect)) * 3600;
            return round($time);
        }
        return round(($distance / $minSpeed) * 3600);
    }

    public function isNatars($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid") == 1;
    }

    public function isWW($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT isWW FROM vdata WHERE kid=$kid") == 1;
    }
}