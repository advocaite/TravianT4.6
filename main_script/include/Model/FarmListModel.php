<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\Log;
use Core\Session;
use Game\Formulas;
use Game\NoticeHelper;
use Game\SpeedCalculator;
use function getCustom;
use function ignore_user_abort;
use function miliseconds;
use function set_time_limit;

class FarmListModel
{
    public function addUniqueFarms($uid, $kid, $count)
    {
        $db = DB::getInstance();
        $farms = $db->query("SELECT v.* FROM vdata v WHERE v.owner=1 AND v.isWW=0 AND (SELECT COUNT(a.id) FROM artefacts a WHERE a.kid=v.kid)=0 AND (SELECT COUNT(r.id) FROM raidlist r WHERE r.kid=v.kid AND (SELECT f.owner FROM farmlist f WHERE f.id=r.lid AND f.kid=$kid)=$uid)=0 LIMIT $count");
        $batch = [];
        if ($farms->num_rows) {
            $lid = $this->addFarmList($uid, $kid, 'Auto Added farms');
            while ($row = $farms->fetch_assoc()) {
                $distance = Formulas::getDistance($kid, $row['kid']);
                $batch[] = '(' . $lid . ', ' . $row['kid'] . ', ' . $distance . ', 50000,0,0,0,0,0,0,0,0,0)';
            }
            $query = 'INSERT INTO raidlist(lid, kid, distance, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ' . implode(",",
                    $batch);
            $db->query($query);
        }
        return $farms->num_rows;
    }

    public function entryExists($listId, $kid, $uid){
        $db = DB::getInstance();
        return 0 < $db->fetchScalar("SELECT COUNT(r.id) FROM raidlist r, farmlist f WHERE f.id=$listId AND r.lid=f.id AND f.owner=$uid AND r.kid=$kid");
    }

    public function addNearbyFarms($uid, $kid, $distance)
    {
        set_time_limit(0);
        ignore_user_abort(true);
        $xy = Formulas::kid2xy($kid);
        $totalCoordinate = 1 + (2 * MAP_SIZE);
        $totalCoordinate2 = 1 + (3 * MAP_SIZE);
        $dist = "SQRT(POW(((w.x-{$xy['x']}+{$totalCoordinate2})%{$totalCoordinate} -" . MAP_SIZE . "), 2) + POW(((w.y-{$xy['y']}+{$totalCoordinate2})%{$totalCoordinate} -" . MAP_SIZE . "), 2))";
        $db = DB::getInstance();
        $farms = $db->query("SELECT v.kid FROM vdata v, wdata w WHERE v.kid=w.id AND v.owner=1 AND v.isWW=0 AND (SELECT COUNT(a.id) FROM artefacts a WHERE a.kid=v.kid)=0 AND $dist <= $distance");
        $batch = [];
        if ($farms->num_rows) {
            $i = 0;
            $lid = $this->addFarmList($uid, $kid, 'AUTO 1');
            $listCount = 0;
            while ($row = $farms->fetch_assoc()) {
                $distance = Formulas::getDistance($kid, $row['kid']);
                $batch[] = '(' . $lid . ', ' . $row['kid'] . ', ' . $distance . ', 500000,0,0,0,0,0,0,0,0,0)';
                if (sizeof($batch) >= 100) {
                    $query = 'INSERT INTO raidlist(lid, kid, distance, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ' . implode(",",
                            $batch);
                    $db->query($query);
                    $batch = [];
                }
                if ($listCount == 100) {
                    $lid = $this->addFarmList($uid, $kid, 'AUTO ' . $i);
                    $i++;
                    $listCount = 0;
                }
            }
            $query = 'INSERT INTO raidlist(lid, kid, distance, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ' . implode(",",
                    $batch);
            $db->query($query);
        }
        return $farms->num_rows;
    }

    public function getMyFarmLists($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM farmlist WHERE owner=$uid");
    }

    public function getWhereIsKidInFarmList($kid, $uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT farmlist.id, farmlist.name, raidlist.id slotId FROM farmlist, raidlist WHERE farmlist.owner=$uid AND raidlist.kid=$kid AND raidlist.lid=farmlist.id LIMIT 1");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }
        return FALSE;
    }

    public function getVillageFarmList($kid, $uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT id FROM farmlist WHERE kid=$kid AND owner=$uid");
    }

    public function slotExistsByKid($kid, $lid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT id FROM raidlist WHERE lid=$lid AND kid=$kid");
        if ($find->num_rows) {
            return $find->fetch_assoc()['id'];
        }
        return FALSE;
    }

    public function getSlot($slotId)
    {
        $db = DB::getInstance();
        $stmt = $db->query("SELECT * FROM raidlist WHERE id=$slotId");
        if ($stmt->num_rows) {
            return $stmt->fetch_assoc();
        }
        return FALSE;
    }

    public function editSlot($slotId, $units)
    {
        $db = DB::getInstance();
        $db->query("UPDATE raidlist SET u1={$units[1]}, u2={$units[2]}, u3={$units[3]}, u4={$units[4]}, u5={$units[5]}, u6={$units[6]}, u7={$units[7]}, u8={$units[8]}, u9={$units[9]}, u10={$units[10]} WHERE id=$slotId");
    }

    public function addSlot($lid, $distance, $kid, $units)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO raidlist (lid, kid, distance, u1, u2, u3, u4, u5, u6, u7, u8, u9, u10) VALUES ($lid, $kid, $distance, {$units[1]}, {$units[2]}, {$units[3]}, {$units[4]}, {$units[5]}, {$units[6]}, {$units[7]}, {$units[8]}, {$units[9]}, {$units[10]})");
    }

    public function isThereAnyThing($kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM wdata WHERE id=$kid AND ((oasistype>0) OR (occupied=1 AND fieldtype>0))") > 0;
    }

    public function deleteSlot($slotId, $uid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM raidlist WHERE raidlist.id=$slotId AND (SELECT COUNT(id) FROM farmlist WHERE id=raidlist.lid AND owner=$uid)>0");
    }

    public function getKidOwnerAccess($kid)
    {
        $db = DB::getInstance();
        if ($this->isOasis($kid)) {
            $find = $db->fetchScalar("SELECT users.access FROM users, odata WHERE odata.kid=$kid AND users.id=odata.owner");
        } else {
            $find = $db->fetchScalar("SELECT users.access FROM users, vdata WHERE vdata.kid=$kid AND users.id=vdata.owner");
        }
        if (!$find) {
            return 1;
        }
        return $find;
    }

    public function checkToFarmListPermissions($kid, $hasProtection = false)
    {
        $db = DB::getInstance();
        if ($this->isOasis($kid)) {
            $find = $db->query("SELECT users.vacationActiveTil, users.access, users.protection, odata.owner FROM users, odata WHERE odata.kid=$kid AND users.id=odata.owner");
        } else {
            $find = $db->query("SELECT users.vacationActiveTil, users.access, users.protection, vdata.owner, vdata.isWW, vdata.isFarm FROM users, vdata WHERE vdata.kid=$kid AND users.id=vdata.owner");
        }
        if (!$find->num_rows) {
            return FALSE;
        }
        $row = $find->fetch_assoc();
        if($row['owner'] == 0){
            $row['protection'] = 0;
        }
        if ($row['vacationActiveTil'] > time()) return false;
        if ($row['protection'] > time()) return false;
        if (isset($row['isWW']) && $row['isWW'] == 1) {
            if (!getCustom("wwPlansEnabled")) {
                if (!Config::getInstance()->dynamic->WWPlansReleased) {
                    return false;
                }
            }
        }

        if (isset($row['isFarm']) && $row['isFarm'] && (time() <= getCustom("protectFarmsTill") || $hasProtection)) {
            return false;
        }
        if ($row['access'] == 0) return false;
        return true;
    }

    public function checkVillageVacation($kid)
    {
        $db = DB::getInstance();
        if ($this->isOasis($kid)) {
            $find = $db->fetchScalar("SELECT users.vacationActiveTil FROM users, odata WHERE odata.kid=$kid AND users.id=odata.owner");
        } else {
            $find = $db->fetchScalar("SELECT users.vacationActiveTil FROM users, vdata WHERE vdata.kid=$kid AND users.id=vdata.owner");
        }
        return $find >= time();
    }

    public function isNatarOrUnOccupiedOasis($kid)
    {
        $db = DB::getInstance();
        if ($this->isOasis($kid)) {
            return !$this->isOasisConqured($kid);
        }
        $owner = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid LIMIT 1");
        return $owner == 1;
    }

    public function getFarmListSlotsCount($lid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM raidlist WHERE lid=$lid");
    }

    public function getLastTargets($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT DISTINCT to_kid FROM ndata WHERE uid=$uid AND type IN(3, 4) ORDER BY time DESC");
    }

    public function isOasis($x)
    {
        $o = new OasesModel();
        return $o->isOasis($x);
    }

    public function isOasisConqured($x)
    {
        $o = new OasesModel();
        return $o->isOasisConqured($x);
    }

    public function isVillageMine($uid, $kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE kid=$kid AND owner=$uid") > 0;
    }

    public function getMyVillages($uid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT kid, name FROM vdata WHERE owner=$uid");
    }

    public function deleteFarmList($lid, $uid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM farmlist WHERE id=$lid AND owner=$uid");
        if ($db->affectedRows()) {
            $db->query("DELETE FROM raidlist WHERE lid=$lid");
        }
    }

    public function getMultiRaidList($slots, $lid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM raidlist WHERE id IN($slots) AND lid=$lid ORDER BY FIELD(id, " . $slots . ")");
    }

    public function getSingleRaidList($slotId, $lid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM raidlist WHERE id=$slotId AND lid=$lid");
        if (!$find->num_rows) {
            return FALSE;
        }
        return $find->fetch_assoc();
    }

    public function getVillage($kid, $columns)
    {
        $db = DB::getInstance();
        return $db->query("SELECT $columns FROM vdata WHERE kid=$kid")->fetch_assoc();
    }

    public function getVillageUnits($kid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM units WHERE kid=$kid")->fetch_assoc();
    }

    public function getMyFarmListById($id, $uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM farmlist WHERE id=$id AND owner=$uid");
        if (!$find->num_rows) {
            return FALSE;
        }
        $result = $find->fetch_assoc();
        return $result;
    }

    public function setLastRaid($id, $uid, $kid, $time)
    {
        $db = DB::getInstance();
        if (getCustom("allowOneFarmListPerAccount")) {
            $db->query("UPDATE farmlist f SET f.lastRaid=$time WHERE f.owner=$uid");
        } else if (getCustom("allowOneFarmListPerVillage")) {
            $db->query("UPDATE farmlist SET lastRaid=$time WHERE kid=$kid");
        } else {
            $db->query("UPDATE farmlist SET lastRaid=$time WHERE id=$id");
        }
    }

    public function getRaidList($lid)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM raidlist WHERE lid=$lid ORDER BY distance");
    }

    public function checkAttack($kid, $to_kid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT COUNT(id) FROM movement WHERE kid=$kid AND to_kid=$to_kid AND mode=0 AND attack_type=" . MovementsModel::ATTACKTYPE_RAID) > 0;
    }

    public function modifyUnits($kid, $units)
    {
        $db = DB::getInstance();
        $modify = [];
        foreach ($units as $m => $v) {
            $modify[] = "u{$m}=u{$m}-$v";
        }
        $query = $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid=$kid");
        return $query && $db->affectedRows() > 0;
    }

    public function getTournamentSqLvl($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT `f18t`, `f19`, `f19t`, `f20`, `f20t`, `f21`, `f21t`, `f22`, `f22t`, `f23`, `f23t`, `f24`, `f24t`, `f25`, `f25t`, `f26`, `f26t`, `f27`, `f27t`, `f28`, `f28t`, `f29`, `f29t`, `f30`, `f30t`, `f31`, `f31t`, `f32`, `f32t`, `f33`, `f33t`, `f34`, `f34t`, `f35`, `f35t`, `f36`, `f36t`, `f37`, `f37t`, `f38`, `f38t` FROM fdata WHERE kid={$kid}");
        if (!$buildings->num_rows) {
            return FALSE;
        }
        $buildings = $buildings->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 14) {
                return $buildings['f' . $i];
            }
        }
        return 0;
    }

    public function getLastReport($uid, $kid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT id, type, bounty, private_key, time FROM ndata WHERE id=(SELECT report_id FROM farmlist_last_reports WHERE uid=$uid AND kid=$kid)");
        if (!$find->num_rows) {
            return FALSE;
        }
        return $find->fetch_assoc();
    }

    public function isListNameUnique($name, $kid, $uid)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        return $db->fetchScalar("SELECT COUNT(id) FROM farmlist WHERE kid=$kid AND owner=$uid AND name='$name'") == 0;
    }

    public function addFarmList($uid, $kid, $name)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO farmlist (kid, owner, name) VALUES ($kid, $uid, '$name')");
        return $db->lastInsertId();
    }

    public function changeFarmListName($id, $name)
    {
        $db = DB::getInstance();
        $db->query("UPDATE farmlist SET name='$name' WHERE id=$id");
        return $db->affectedRows();
    }

    public function processAutoRaid()
    {
        if (!getCustom("autoRaidEnabled")) {
            return;
        }
        $db = DB::getInstance();
        $time = time();
        $result = $db->query("SELECT * FROM farmlist WHERE auto=1 AND (lastRaid+randSec) < {$time} LIMIT 20");
        $m = new AdventureModel();
        $randSec = Config::getInstance()->game->autoRaidInterval;
        while ($row = $result->fetch_assoc()) {
            $user = $db->query("SELECT access, last_login_time FROM users WHERE id={$row['owner']}")->fetch_assoc();
            $db->query("UPDATE farmlist SET lastRaid=" . time() . ", randSec=$randSec WHERE id={$row['id']}");
            if ($user['access'] == 0 || (time() - $user['last_login_time']) > 7200) {
                continue; //skip
            }
            if ($m->getHeroVillageRallyPoint($row['kid']) && $this->autoRaidFarmList($row['id'],
                    $row['owner'],
                    $row['kid']) > 0) {
                $silver = Config::getProperty("gold", "autoRaidSilver");
                $db->query("UPDATE users SET silver=silver-$silver WHERE id={$row['owner']}");
            }
        }
    }

    public function autoRaidFarmList($lid, $owner, $kid)
    {
        $miliseconds = miliseconds();
        $success = 0;
        $db = DB::getInstance();
        $calc = new SpeedCalculator();
        $calc->setTournamentSqLvl($this->getTournamentSqLvl($kid));
        $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($owner, $kid, ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $calc->setFrom($kid);
        $move = new MovementsModel();
        $slots = $db->query("SELECT * FROM raidlist WHERE lid=$lid");
        $user = $db->query("SELECT race, protection, access, vacationActiveTil, silver FROM users WHERE id=$owner");
        if (!$user->num_rows) return $success;
        $user = $user->fetch_assoc();
        $race = $user['race'];
        if ($user['silver'] < Config::getProperty("gold", "autoRaidSilver")) {
            return $success;
        }
        if ($user['vacationActiveTil'] > time()) {
            return $success;
        }
        Log::addLog($owner,
            "autoraid:before:$lid:$kid",
            sprintf("Troops: %s", implode(",", array_values(array_filter_units($this->getVillageUnits($kid))))));
        while ($row = $slots->fetch_assoc()) {
            $calc->hasCata($row['u8'] > 0);
            $canRaid = TRUE;
            $speeds = [];
            if (!$this->checkToFarmListPermissions($row['kid'], Session::getInstance()->hasProtection())) {
                continue;
            }
            if ($user['protection'] > time() && !$this->isNatarOrUnOccupiedOasis($row['kid'])) {
                continue;
            }
            $unitsToSend = array_fill(1, 11, 0);
            $units = $db->query("SELECT * FROM units WHERE kid=$kid")->fetch_assoc();
            for ($i = 1; $i <= 10; ++$i) {
                $v = $row['u' . $i];
                if ($units['u' . $i] < $v) {
                    $canRaid = FALSE;
                    break;
                }
            }
            if (!$canRaid) {
                continue;
            }
            $modified_units = [];
            for ($i = 1; $i <= 10; ++$i) {
                $v = abs((int)$row['u' . $i]);
                if (!$v) {
                    continue;
                }
                $unitsToSend[$i] = $v;
                $units['u' . $i] -= $v;
                if (!isset($modified_units[$i])) {
                    $modified_units[$i] = 0;
                }
                $modified_units[$i] += $v;
                $speeds[] = Formulas::uSpeed(nrToUnitId($i, $race));
            }
            ++$success;
            $calc->setTo($row['kid']);
            $calc->setMinSpeed($speeds);
            if ($result = Units::modifyUnits($kid, $modified_units)) {
                $result = $move->addMovement($kid,
                    $row['kid'],
                    $race,
                    $unitsToSend,
                    0,
                    0,
                    0,
                    0,
                    0,
                    MovementsModel::ATTACKTYPE_RAID,
                    $miliseconds,
                    $miliseconds + 1000 * $calc->calc());
            }
            if (!$result) {
                --$success;
            }
        }
        Log::addLog($owner,
            "autoraid:after:$lid:$kid",
            sprintf("Troops: %s, sent: %s",
                implode(",", array_values(array_filter_units($this->getVillageUnits($kid)))),
                $success));
        return $success;
    }
}