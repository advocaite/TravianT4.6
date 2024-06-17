<?php

namespace Game;

use Core\Database\DB;
use Model\VillageModel;
use const SORT_DESC;
use function getGame;
use function getGameSpeed;
use function nrToUnitId;

class Starvation
{
    private $villageRow = [];
    private $userRow = [];
    private $villageChildren = [];
    private $db;
    private $kid;
    private $currentCrop = 0;
    private $maxCrop = 0;
    private $rowLimit = 20;

    public function __construct($kid)
    {
        if (!getGame("starvation")) {
            return;
        }
        $this->kid = $kid;
        $this->db = DB::getInstance();
        $this->villageRow = $this->getVillage();
        if ($this->villageRow === FALSE) {
            return;
        }
        //  Disable for Natars
        if (!($this->villageRow['owner'] > 2)) {
            return;
        }
        $this->userRow = $this->getUser($this->villageRow['owner']);
        if ($this->userRow === FALSE) {
            return;
        }
        $this->maxCrop = $this->villageRow['maxcrop'];
        $now = miliseconds();
        $elapsedTime = ($now - $this->villageRow['lastmupdate']);
        $cropProduction = $this->villageRow['cropp'] - $this->villageRow['pop'] - $this->villageRow['upkeep'];
        $this->currentCrop = $this->villageRow['crop'] + $elapsedTime * ($cropProduction / 3600000);
        if ($this->currentCrop >= 0) {
            return;
        }
        if($this->userRow['vacationActiveTil'] > time()){
            // vacation
            $crop = -$this->currentCrop + 1000;
            $this->db->query("UPDATE vdata SET crop=crop+$crop WHERE kid={$this->kid}");
            return;
        }
        $truce = TruceDay::isActive() || (TruceDay::getTo() + 86400) > time();
        if ($truce || $this->userRow['access'] == 0 || $this->userRow['id'] == 1) {
            if ($truce || $this->userRow['access'] == 0) {
                //no starvation while banned
                $this->db->query("UPDATE vdata SET crop=0 WHERE kid={$this->kid}");
            } else {
                $crop = -$this->currentCrop + 1000;
                $this->db->query("UPDATE vdata SET crop=crop+$crop WHERE kid={$this->kid}");
            }
            return;
        }
        $this->villageChildren = $this->getVillageChildren();
        $this->starveForeignEnforcements();
        $this->starveLocalEnforcements();
        $this->starveTrappedTroops();
        $this->starveInactiveTroops();
        $this->starveAfootTroops();

        $crop = $this->currentCrop - $this->villageRow['crop'];

        $wood = $elapsedTime * ($this->villageRow['woodp'] / 3600000);
        $clay = $elapsedTime * ($this->villageRow['clayp'] / 3600000);
        $iron = $elapsedTime * ($this->villageRow['ironp'] / 3600000);

        $this->db->query("UPDATE vdata SET lastmupdate=$now, wood=wood+$wood, clay=clay+$clay, iron=iron+$iron, crop=crop+$crop WHERE kid={$this->kid}");

        $hdp = VillageModel::getHDP($this->kid, $this->villageRow['owner']);
        ResourcesHelper::updateVillageUpkeep($this->villageRow['owner'], $this->kid, $this->villageRow['isWW'] == 1, $hdp);

        unset($this->userRow);
        unset($this->villageRow);
        unset($this->currentCrop);
        unset($this->villageChildren);
        unset($this->db);
    }

    private function getVillage()
    {
        $stmt = $this->db->query("SELECT kid, maxcrop, owner, woodp, clayp, ironp, cropp, crop, upkeep, pop, lastmupdate, isWW, isFarm FROM vdata WHERE kid={$this->kid} AND owner>1");
        if ($stmt->num_rows) {
            return $stmt->fetch_assoc();
        }
        return false;
    }

    private function getUser($uid)
    {
        $stmt = $this->db->query("SELECT id, race, access, vacationActiveTil FROM users WHERE id=$uid");
        if ($stmt->num_rows) {
            return $stmt->fetch_assoc();
        }
        return false;
    }

    private function getVillageChildren()
    {
        $oases = $this->db->query("SELECT kid FROM odata WHERE did={$this->kid} LIMIT 3");
        $oases_array = [];
        while ($row = $oases->fetch_assoc()) {
            $oases_array[] = $row['kid'];
        }
        $oases_array[] = $this->kid;
        return $oases_array;
    }

    private function starveForeignEnforcements()
    {
        if ($this->currentCrop >= 0) {
            return;
        }
        $stmt = $this->db->query("SELECT *, (u1+u2+u3+u4+u5+u6+u7+u8+u9+u10+u11) as `total_sum` FROM enforcement WHERE uid>0 AND uid != {$this->villageRow['owner']} AND to_kid IN(" . implode(",", $this->villageChildren) . ") ORDER BY `total_sum` DESC LIMIT {$this->rowLimit}");
        while ($this->currentCrop < 0 && ($row = $stmt->fetch_assoc())) {
            $this->starveRow($row, true, false, false, false);
        }
    }

    private function starveRow(array $row, $isEnforcement, $isTrapped, $isVillage, $isMovement)
    {
        $order = $this->getUnitKillOrder($row['race'], $row);
        $total_killed = 0;
        foreach ($order as $nr) {
            if ($row['u' . $nr] <= 0) continue;
            if ($this->currentCrop > 0) break;
            if ($nr == 11) {
                $res = Formulas::heroRegenerateCost(0, $row['race']); //TODO: get hero level
            } else {
                $res = Formulas::uTrainingCost(nrToUnitId($nr, $row['race']));
            }
            $maxNumByStorage = ceil(($this->maxCrop + abs($this->currentCrop)) / $res[3]);
            $killNum = min((int)ceil(abs($this->currentCrop * $this->getCropMultiplier() / $res[3])), $row['u' . $nr]);
            if ($killNum > $maxNumByStorage) {
                $killNum = $maxNumByStorage;
            }
            if ($killNum > 0) {
                $q = false;
                if ($isEnforcement) {
                    $q = $this->db->query("UPDATE enforcement SET u{$nr}=GREATEST(u{$nr}-$killNum, 0) WHERE id={$row['id']} AND u{$nr}>=$killNum");
                } else if ($isTrapped) {
                    $q = $this->db->query("UPDATE trapped SET u{$nr}=GREATEST(u{$nr}-$killNum, 0) WHERE id={$row['id']} AND u{$nr}>=$killNum");
                } else if ($isVillage) {
                    $q = $this->db->query("UPDATE units SET u{$nr}=GREATEST(u{$nr}-$killNum, 0) WHERE kid={$row['kid']} AND u{$nr}>=$killNum");
                } else if ($isMovement) {
                    $q = $this->db->query("UPDATE movement SET u{$nr}=GREATEST(u{$nr}-$killNum, 0) WHERE id={$row['id']} AND u{$nr}>=$killNum");
                }
                if ($q && $this->db->affectedRows()) {
                    if ($nr == 11) {
                        $this->db->query("UPDATE hero SET health=0 WHERE kid={$row['kid']}");
                    }
                    $this->currentCrop += $res[3] * $killNum;
                    $total_killed += $killNum;
                }
                if ($total_killed >= $row['total_sum']) break;
            }
        }
        if ($total_killed >= $row['total_sum']) {
            if ($isEnforcement) {
                $this->db->query("DELETE FROM enforcement WHERE id={$row['id']}");
            } else if ($isTrapped) {
                $this->db->query("DELETE FROM trapped WHERE id={$row['id']}");
            } else if ($isMovement) {
                $this->db->query("DELETE FROM movement WHERE id={$row['id']}");
            }
        }
        return $total_killed;
    }

    private function getUnitKillOrder($race, $unitsRow)
    {
        $order = array_fill(1, 11, 0);
        for ($i = 1; $i <= 11; ++$i) {
            $order[$i] = $unitsRow['u' . $i] * Formulas::uUpkeep(nrToUnitId($i, $race));
        }
        arsort($order, SORT_DESC);
        /*switch ($race) {
            case 1:
                $order = [8, 9, 6, 7, 5, 4, 3, 2, 1, 10, 11];
                break;
            case 2:
                $order = [8, 9, 7, 6, 5, 4, 3, 2, 1, 10, 11];
                break;
            case 3:
                $order = [8, 9, 7, 6, 5, 4, 3, 2, 1, 10, 11];
                break;
            case 6:
                $order = [8, 9, 7, 6, 5, 4, 3, 2, 1, 10, 11];
                break;
            case 7:
                $order = [8, 9, 7, 6, 5, 4, 3, 2, 1, 10, 11];
                break;
            default:
                $order = [8, 9, 7, 6, 5, 4, 3, 2, 1, 10, 11];
                break;
        }*/
        return array_keys($order);
    }

    private function getCropMultiplier()
    {
        if (getGameSpeed() <= 10) return 1;
        return min(getGameSpeed(), 10);
    }

    private function starveLocalEnforcements()
    {
        if ($this->currentCrop >= 0) {
            return;
        }
        $stmt = $this->db->query("SELECT *, (u1+u2+u3+u4+u5+u6+u7+u8+u9+u10+u11) as `total_sum` FROM enforcement WHERE uid>0 AND uid={$this->villageRow['owner']} AND to_kid IN(" . implode(",", $this->villageChildren) . ") ORDER BY `total_sum` DESC LIMIT {$this->rowLimit}");
        while ($this->currentCrop < 0 && ($row = $stmt->fetch_assoc())) {
            $this->starveRow($row, true, false, false, false);
        }
    }

    private function starveTrappedTroops()
    {
        if ($this->currentCrop >= 0) {
            return;
        }
        $stmt = $this->db->query("SELECT *, (u1+u2+u3+u4+u5+u6+u7+u8+u9+u10+u11) as `total_sum` FROM trapped WHERE kid={$this->kid} ORDER BY `total_sum` DESC LIMIT {$this->rowLimit}");
        while ($this->currentCrop < 0 && ($row = $stmt->fetch_assoc())) {
            $this->starveRow($row, false, true, false, false);
        }
    }

    private function starveInactiveTroops()
    {
        if ($this->currentCrop >= 0) {
            return;
        }
        $stmt = $this->db->query("SELECT *, (u1+u2+u3+u4+u5+u6+u7+u8+u9+u10+u11) as `total_sum` FROM units WHERE kid={$this->kid}");
        while ($this->currentCrop < 0 && ($row = $stmt->fetch_assoc())) {
            $this->starveRow($row, false, false, true, false);
        }
    }

    private function starveAfootTroops()
    {
        if ($this->currentCrop >= 0) {
            return;
        }
        $stmt = $this->db->query("SELECT *, (u1+u2+u3+u4+u5+u6+u7+u8+u9+u10+u11) as `total_sum` FROM movement WHERE race != 4 AND ((kid={$this->kid} AND mode=0) OR (to_kid={$this->kid} AND mode=1)) ORDER BY `total_sum` DESC LIMIT {$this->rowLimit}");
        while ($this->currentCrop < 0 && ($row = $stmt->fetch_assoc())) {
            $this->starveRow($row, false, false, false, true);
        }
    }
}