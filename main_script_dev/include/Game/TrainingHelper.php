<?php

namespace Game;

use Core\Caching\Caching;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use Model\Quest;
use Model\villageOverviewModel;

class TrainingHelper
{
    private function getMaxTraps()
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $totalTraps = 0;
        for ($i = 19; $i <= 38; $i++) {
            if ($village->getField($i)['item_id'] == 36) {
                $totalTraps += Formulas::getTrapperValueByLevel($village->getField($i)['level']);
            }
        }
        $totalTraps -= $db->fetchScalar("SELECT u99 FROM units WHERE kid={$village->getKid()} LIMIT 1");
        $totalTraps -= $db->fetchScalar("SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND item_id=36");
        $cost = Formulas::uTrainingCost(99);
        $can = [];
        foreach ($village->getCurrentResources(-1, TRUE) as $r => $v) {
            $can[$r] = floor($v / $cost[$r]);
            if ($can[$r] > $totalTraps) {
                $can[$r] = $totalTraps;
            }
        }
        return min($can);
    }

    private function getMaxTraps2()
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $totalTraps = 0;
        for ($i = 19; $i <= 38; $i++) {
            if ($village->getField($i)['item_id'] == 36) {
                $totalTraps += Formulas::getTrapperValueByLevel($village->getField($i)['level']);
            }
        }
        $totalTraps -= $db->fetchScalar("SELECT u99 FROM units WHERE kid={$village->getKid()} LIMIT 1");
        $totalTraps -= $db->fetchScalar("SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND item_id=36");
        $cost = Formulas::uTrainingCost(99);
        $can = floor(array_sum($village->getCurrentResources(-1, TRUE)) / array_sum($cost));
        return min($can, $totalTraps);
    }

    public function getExpansionUnits($kid)
    {
        $db = DB::getInstance();

        list($chiefs, $settlers) = $db->query("SELECT u9, u10 FROM units WHERE kid=$kid")->fetch_row();

        $onTheWay = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM movement WHERE (kid={$kid} AND mode=0)")->fetch_assoc();
        $settlers += $onTheWay['settlers'];
        $chiefs += $onTheWay['chiefs'];

        $onTheWay = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM movement WHERE (to_kid=$kid AND mode=1)")->fetch_assoc();
        $settlers += $onTheWay['settlers'];
        $chiefs += $onTheWay['chiefs'];


        $trapped = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM trapped WHERE kid=$kid")->fetch_assoc();
        $settlers += $trapped['settlers'];
        $chiefs += $trapped['chiefs'];
        $enforcement = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM enforcement WHERE kid=$kid")->fetch_assoc();
        $settlers += $enforcement['settlers'];
        $chiefs += $enforcement['chiefs'];
        $onTrain = $db->query("
        SELECT
        (SELECT SUM(num) FROM training WHERE kid=$kid AND nr=10 AND item_id IN(25,26)) AS `settlers`,
        (SELECT SUM(num) FROM training WHERE kid=$kid AND nr=9 AND item_id IN(25,26)) AS `chiefs`
        ")->fetch_assoc();
        $settlers += $onTrain['settlers'];
        $chiefs += $onTrain['chiefs'];

        return ['settlers' => $settlers, 'chiefs' => $chiefs];
    }

    public function getSlots($kid)
    {
        $m = new villageOverviewModel();
        $residencePalace = $m->getResidencePalaceLevel($kid);
        $db = DB::getInstance();
        $filledSlots = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE expandedfrom=$kid LIMIT 3");
        $residence = $residencePalace['item_id'] == 25 ? $residencePalace['level'] : 0;
        $maxslots = 0;
        if ($residence) {
            if ($residence >= 10) {
                $maxslots++;
            }
            if ($residence == 20) {
                $maxslots++;
            }
        } else {
            $palace = $residencePalace['item_id'] == 26 ? $residencePalace['level'] : 0;
            if ($palace >= 10) {
                $maxslots++;
            }
            if ($palace >= 15) {
                $maxslots++;
            }
            if ($palace == 20) {
                $maxslots++;
            }
        }
        return [
            'maxSlots'    => $maxslots,
            'filledSlots' => $filledSlots,
            'freeSlots'   => $maxslots - $filledSlots,
        ];
    }

    public function getAvailableExpansionTraining($nr, $calc = FALSE)
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $filledSlots = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE expandedfrom={$village->getKid()} LIMIT 3");
        $residence = max($village->getTypeLevel(25));
        $maxslots = 0;
        if ($residence) {
            if ($residence >= 10) {
                $maxslots++;
            }
            if ($residence == 20) {
                $maxslots++;
            }
        } else if (($commandCenter = max($village->getTypeLevel(44)))) {
            if ($commandCenter >= 10) {
                $maxslots++;
            }
            if ($commandCenter >= 15) {
                $maxslots++;
            }
            if ($commandCenter == 20) {
                $maxslots++;
            }
        } else {
            $palace = max($village->getTypeLevel(26));
            if ($palace >= 10) {
                $maxslots++;
            }
            if ($palace >= 15) {
                $maxslots++;
            }
            if ($palace == 20) {
                $maxslots++;
            }
        }
        $maxslots -= $filledSlots;
        list($chiefs, $settlers) = $db->query("SELECT u9, u10 FROM units WHERE kid=" . $village->getKid())->fetch_row();
        $onTheWay = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM movement WHERE (mode=1 AND to_kid={$village->getKid()}) OR (mode=0 AND kid={$village->getKid()})")->fetch_assoc();
        $settlers += $onTheWay['settlers'];
        $chiefs += $onTheWay['chiefs'];
        $trapped = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM trapped WHERE kid={$village->getKid()}")->fetch_assoc();
        $settlers += $trapped['settlers'];
        $chiefs += $trapped['chiefs'];
        $enforcement = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM enforcement WHERE kid={$village->getKid()}")->fetch_assoc();
        $settlers += $enforcement['settlers'];
        $chiefs += $enforcement['chiefs'];
        $onTrain = $db->query("
        SELECT
        (SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND nr=10 AND item_id IN(25,26,44)) AS settlers,
        (SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND nr=9 AND item_id IN(25,26,44)) AS chiefs
        ")->fetch_assoc();
        $settlers += $onTrain['settlers'];
        $chiefs += $onTrain['chiefs'];
        if ($settlers >= 3) {
            Quest::getInstance()->setQuestBitwise('world', 15, 1);
        }
        // trapped settlers/chiefs calculation required
        $settlerslots = ($maxslots * 3) - $settlers - ($chiefs * 3);
        $chiefslots = $maxslots - $chiefs - floor(($settlers + 2) / 3);
        $cost = Formulas::uTrainingCost(nrToUnitId(10, Session::getInstance()->getRace()));
        $can = [];
        foreach ($village->getCurrentResources(-1, TRUE) as $r => $v) {
            $can[$r] = floor($v / $cost[$r]);
            if ($can[$r] > $settlerslots) {
                $can[$r] = $settlerslots;
            }
        }
        if ($nr == 10) {
            return $calc ? $settlerslots : min($can);
        }
        $cost = Formulas::uTrainingCost(nrToUnitId(9, Session::getInstance()->getRace()));
        $can = [];
        foreach ($village->getCurrentResources(-1, TRUE) as $r => $v) {
            $can[$r] = floor($v / $cost[$r]);
            if ($can[$r] > $chiefslots) {
                $can[$r] = $chiefslots;
            }
        }
        if ($nr == 9) {
            return $calc ? $chiefslots : min($can);
        }
        if ($nr == 0) {
            return [$settlerslots, $chiefslots];
        }

        return $chiefslots;
    }

    public function getAvailableExpansionTraining2($nr, $calc = FALSE)
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $filledSlots = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE expandedfrom={$village->getKid()}");
        $residence = max($village->getTypeLevel(25));
        $maxslots = 0;
        if ($residence) {
            if ($residence >= 10) {
                $maxslots++;
            }
            if ($residence == 20) {
                $maxslots++;
            }
        } else if (($commandCenter = max($village->getTypeLevel(44)))) {
            if ($commandCenter >= 10) {
                $maxslots++;
            }
            if ($commandCenter >= 15) {
                $maxslots++;
            }
            if ($commandCenter == 20) {
                $maxslots++;
            }
        } else {
            $palace = max($village->getTypeLevel(26));
            if ($palace >= 10) {
                $maxslots++;
            }
            if ($palace >= 15) {
                $maxslots++;
            }
            if ($palace == 20) {
                $maxslots++;
            }
        }
        $maxslots -= $filledSlots;
        list($chiefs, $settlers) = $db->query("SELECT u9, u10 FROM units WHERE kid=" . $village->getKid())->fetch_row();
        $onTheWay = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM movement WHERE (mode=1 AND to_kid={$village->getKid()}) OR (mode=0 AND kid={$village->getKid()})")->fetch_assoc();
        $settlers += $onTheWay['settlers'];
        $chiefs += $onTheWay['chiefs'];
        $trapped = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM trapped WHERE kid={$village->getKid()}")->fetch_assoc();
        $settlers += $trapped['settlers'];
        $chiefs += $trapped['chiefs'];
        $enforcement = $db->query("SELECT SUM(u10) AS `settlers`, SUM(u9) AS `chiefs` FROM enforcement WHERE kid={$village->getKid()}")->fetch_assoc();
        $settlers += $enforcement['settlers'];
        $chiefs += $enforcement['chiefs'];
        $onTrain = $db->query("
        SELECT
        (SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND nr=10 AND item_id IN(25,26,44)) AS settlers,
        (SELECT SUM(num) FROM training WHERE kid={$village->getKid()} AND nr=9 AND item_id IN(25,26,44)) AS chiefs
        ")->fetch_assoc();
        $settlers += $onTrain['settlers'];
        $chiefs += $onTrain['chiefs'];
        if ($settlers >= 3) {
            Quest::getInstance()->setQuestBitwise('world', 15, 1);
        }
        // trapped settlers/chiefs calculation required
        $settlerslots = ($maxslots * 3) - $settlers - ($chiefs * 3);
        $chiefslots = $maxslots - $chiefs - floor(($settlers + 2) / 3);
        $cost = Formulas::uTrainingCost(nrToUnitId(10, Session::getInstance()->getRace()));
        $can = min(floor(array_sum($village->getCurrentResources(-1, TRUE)) / array_sum($cost)), $settlerslots);
        if ($nr == 10) {
            return $calc ? $settlerslots : (is_array($can) ? min($can) : $can);
        }
        $cost = Formulas::uTrainingCost(nrToUnitId(9, Session::getInstance()->getRace()));
        $can = min(floor(array_sum($village->getCurrentResources()) / array_sum($cost)), $chiefslots);
        if ($nr == 9) {
            return $calc ? $chiefslots : (is_array($can) ? min($can) : $can);
        }
        if ($nr == 0) {
            return [$settlerslots, $chiefslots];
        }
        return $chiefslots;
    }

    private function maxUnits2($nr, $great)
    {
        $session = Session::getInstance();
        $village = Village::getInstance();
        $cost = Formulas::uTrainingCost(nrToUnitId($nr, $session->getRace()), $great);
        return floor(array_sum($village->getCurrentResources()) / array_sum($cost));
    }

    private function maxUnits($nr, $great)
    {
        $session = Session::getInstance();
        $village = Village::getInstance();
        $cost = Formulas::uTrainingCost(nrToUnitId($nr, $session->getRace()), $great);
        $can = [];
        foreach ($village->getCurrentResources(-1, TRUE) as $r => $v) {
            $can[$r] = floor($v / $cost[$r]);
        }
        return min($can);
    }

    public function getMaxUnitByNr($nr, $great = FALSE)
    {
        if ($nr == 99) {
            return $this->getMaxTraps();
        }
        if ($nr >= 9) {
            return $this->getAvailableExpansionTraining($nr, FALSE);
        }
        return $this->maxUnits($nr, $great);
    }

    public function getMaxUnitByNr2($nr, $great = FALSE)
    {
        if ($nr == 99) {
            return $this->getMaxTraps2();
        }
        if ($nr >= 9) {
            return $this->getAvailableExpansionTraining2($nr, FALSE);
        }
        return $this->maxUnits2($nr, $great);
    }
}