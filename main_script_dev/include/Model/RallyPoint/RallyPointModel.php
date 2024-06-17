<?php

namespace Model\RallyPoint;

use Core\Caching\Caching;
use Core\Database\DB;
use Core\Session;
use Core\Village;
use function getCustom;
use function miliseconds;
use Model\MovementsModel;

class RallyPointStaticData
{
    private static $instance;
    public $oases = null;

    public static function Singleton()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

class RallyPointModel
{
    private $oases;

    public function __construct()
    {
        if (!is_array(RallyPointStaticData::Singleton()->oases)) {
            RallyPointStaticData::Singleton()->oases = [];
            $session = Session::getInstance();
            $oases = DB::getInstance()->query("SELECT kid FROM odata WHERE did={$session->getKid()}");
            while ($row = $oases->fetch_assoc()) {
                RallyPointStaticData::Singleton()->oases[] = $row['kid'];
            }
        }
        $this->oases = RallyPointStaticData::Singleton()->oases;
    }
    ## Filters :
    # 1 => incoming
    # 2 => out going
    # 3 => in village
    # 4 => in other villages
    ## SubFilters
    ## Incoming
    # 1 => incoming attacks/raids
    # 2 => returning troops
    # 3 => incoming reinforcements
    ## OutGoing
    # 4 => Outgoing attacks/raids
    # 5 => Out going reinforcements
    # 6 => All Outgoing Troops | Settlers
    public function getOutgoingMovementsCount($subFilters = [4 => 1, 5 => 1, 6 => 0])
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        //incoming...
        $other = [];
        if ($subFilters[4]) {
            $other[] = '(mode=0 AND attack_type!=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        if ($subFilters[5]) {
            $other[] = '(mode=0 AND attack_type=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        if ($subFilters[6]) {
            $other[] = '(mode=0)';
        }
        $other = sizeof($other) ? 'AND (' . implode(' OR ', $other) . ')' : null;
        return $db->query("SELECT COUNT(id) FROM movement WHERE kid={$session->getKid()} $other")->fetch_assoc()['COUNT(id)'];
    }

    public function cancelTask($taskId)
    {
        $miliseconds = miliseconds();
        $db = DB::getInstance();
        $village = Village::getInstance();
        $taskId = (int)$taskId;
        $task = $db->query("SELECT kid, to_kid, attack_type, mode, start_time, end_time FROM movement WHERE kid={$village->getKid()} AND id={$taskId}");
        if (!$task->num_rows) {
            return;
        }
        $task = $task->fetch_assoc();

        if (getCustom("realCancelAttack")) {
            $abort = ($miliseconds - $task['start_time']) <= 90 * 1000;
        } else {
            $abort = ($miliseconds - $task['start_time']) <= (round(($task['end_time'] - $task['start_time'])) / 3);
        }
        if ($abort || $task['attack_type'] == MovementsModel::ATTACKTYPE_EVASION) {
            $db->query("UPDATE movement SET kid={$task['to_kid']}, to_kid={$task['kid']}, mode=1, end_time=(" . (2 * $miliseconds) . "-start_time), start_time=" . $miliseconds . " WHERE id={$taskId}");
            if ($task['attack_type'] == MovementsModel::ATTACKTYPE_RAID || $task['attack_type'] == MovementsModel::ATTACKTYPE_NORMAL) {
                Caching::getInstance()->delete("attacks" . $task['to_kid']);
            }
        }

        if ($task['attack_type'] == MovementsModel::ATTACKTYPE_SETTLERS && $task['mode'] == 0) {
            // Add resources
            $db->query("UPDATE vdata SET wood=wood+750, clay=clay+750, iron=iron+750, crop=crop+750 WHERE kid={$task['kid']}");
        }
    }

    public function getOutgoingMovementsByLimit($page, $subFilters = [4 => 1, 5 => 1, 6 => 0])
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $from = ($page - 1) * $session->getRallyPointRecordsPerPage();
        //incoming...
        $other = [];
        if ($subFilters[4]) {
            $other[] = '(mode=0 AND attack_type!=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        if ($subFilters[5]) {
            $other[] = '(mode=0 AND attack_type=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        if ($subFilters[6]) {
            $other[] = '(mode=0)';
        }
        $other = sizeof($other) ? 'AND (' . implode(' OR ', $other) . ')' : null;
        if ($subFilters[6]) {
            return $db->query("SELECT * FROM movement WHERE kid={$session->getKid()} $other ORDER BY end_time DESC LIMIT {$from}, {$session->getRallyPointRecordsPerPage()}");
        }
        return $db->query("SELECT * FROM movement WHERE kid={$session->getKid()} $other ORDER BY end_time ASC, id ASC LIMIT {$from}, {$session->getRallyPointRecordsPerPage()}");
    }

    public function getIncomingMovementsCount($subFilters = [1 => 1, 2 => 2, 3 => 1,])
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        //incoming...
        $other = [];
        if ($subFilters[1]) {
            $other[] = '(mode=0 AND (attack_type=' . MovementsModel::ATTACKTYPE_NORMAL . ' OR attack_type=' . MovementsModel::ATTACKTYPE_RAID . '))';
        }
        if ($subFilters[2]) {
            $other[] = '(mode=1)';
        }
        if ($subFilters[3]) {
            $other[] = '(mode=0 AND attack_type=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        $other = sizeof($other) ? 'AND (' . implode(' OR ', $other) . ')' : null;
        $o = $this->oases;
        $o[] = $session->getKid();
        $o = implode(",", $o);
        return $db->query("SELECT COUNT(id) FROM movement WHERE to_kid IN($o) $other")->fetch_assoc()['COUNT(id)'];
    }

    public function getIncomingMovementsByLimit($page, $subFilters = [1 => 1, 2 => 2, 3 => 1,])
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $from = ($page - 1) * $session->getRallyPointRecordsPerPage();
        //incoming...
        $other = [];
        if ($subFilters[1]) {
            $other[] = '(mode=0 AND (attack_type=' . MovementsModel::ATTACKTYPE_NORMAL . ' OR attack_type=' . MovementsModel::ATTACKTYPE_RAID . '))';
        }
        if ($subFilters[2]) {
            $other[] = '(mode=1)';
        }
        if ($subFilters[3]) {
            $other[] = '(mode=0 AND attack_type=' . MovementsModel::ATTACKTYPE_REINFORCEMENT . ')';
        }
        $other = sizeof($other) ? 'AND (' . implode(' OR ', $other) . ')' : null;
        $o = $this->oases;
        $o[] = $session->getKid();
        $o = implode(",", $o);
        return $db->query("SELECT * FROM movement WHERE to_kid IN($o) $other ORDER BY end_time ASC, id ASC LIMIT {$from}, {$session->getRallyPointRecordsPerPage()}");
    }

    public function getOasisEnforcesCount($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE to_kid=$kid");
    }

    public function getMyOasisEnforce($fromKid, $kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM enforcement WHERE kid=$fromKid AND to_kid=$kid");
    }

    public function getOasisEnforcesByLimit($myKid, $kid, $from, $free)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM enforcement WHERE kid!=$myKid AND to_kid=$kid LIMIT $from, $free");
    }

    public function getEnforcesCount($mode)
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $o = implode(",", [$session->getKid()]);
        if ($mode == 1) {
            return $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE kid={$session->getKid()} AND to_kid NOT IN($o)");
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE to_kid IN($o)");
    }

    public function getEnforcesByLimit($from, $free, $mode)
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        $o = implode(",", [$session->getKid()]);
        if ($mode == 1) {
            return $db->query("SELECT * FROM enforcement WHERE kid={$session->getKid()} AND to_kid NOT IN($o) LIMIT $from, $free");
        }
        return $db->query("SELECT * FROM enforcement WHERE to_kid IN($o) LIMIT $from, $free");
    }

    public function getTrappedCount($mode)
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        if ($mode == 1) {
            return $db->fetchScalar("SELECT COUNT(id) FROM trapped WHERE kid={$session->getKid()}");
        }
        return $db->fetchScalar("SELECT COUNT(id) FROM trapped WHERE to_kid={$session->getKid()}");
    }

    public function getTrappedByLimit($from, $size, $mode)
    {
        $db = DB::getInstance();
        $session = Session::getInstance();
        if ($mode == 1) {
            return $db->query("SELECT * FROM trapped WHERE kid={$session->getKid()} LIMIT $from, $size");
        }
        return $db->query("SELECT * FROM trapped WHERE to_kid={$session->getKid()} LIMIT $from, $size");
    }

    public function enforcementExists($id)
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $in = $this->oases;
        $in[] = $village->getKid();
        return 0 < $db->fetchScalar("SELECT COUNT(id) FROM enforcement WHERE (kid={$village->getKid()} OR to_kid IN(" . implode(",",
                    $in) . ")) AND id={$id}");
    }

    public function getEnforcement($id)
    {
        $village = Village::getInstance();
        $db = DB::getInstance();
        $in = $this->oases;
        $in[] = $village->getKid();
        $find = $db->query("SELECT * FROM enforcement WHERE (kid={$village->getKid()} OR to_kid IN(" . implode(",",
                $in) . ")) AND id={$id} LIMIT 1");
        if (!$find->num_rows) {
            return false;
        }
        return $find->fetch_assoc();
    }

    public function deleteEnforce($id)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM enforcement WHERE id=$id");
        return $db->affectedRows() > 0;
    }

    public function modifyEnforce(array $modify, $id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE enforcement SET " . implode(",", $modify) . " WHERE id=$id");
        return $db->affectedRows() > 0;
    }

    public function getUnits($kid)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM units WHERE kid=$kid");
        if (!$stmt->num_rows) {
            return false;
        }
        return $stmt->fetch_assoc();
    }

    public function checkMaxAttacks($kid)
    {
        if (sys_getloadavg()[0] < 3) {
//            return true;
        }
        $db = DB::getInstance();
        $stmt = $db->query("SELECT (SELECT COUNT(id) FROM movement WHERE mode=0 AND kid=$kid) as `outGoing`, (SELECT COUNT(id) FROM movement WHERE mode=1 AND to_kid=$kid) as `inComing`")->fetch_assoc();
        return ($stmt['inComing'] + $stmt['outGoing']) <= 10000;
    }
}