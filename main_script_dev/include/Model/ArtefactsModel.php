<?php

namespace Model;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\Formulas;
use function array_push;
use function array_values;
use Game\ResourcesHelper;
use function getGameSpeed;
use function is_null;
use function logError;
use function shuffle;
use const IS_DEV;
use const MAP_SIZE;

class ArtefactsModel
{
    const ARTIFACT_INCREASE_BUILDINGS_STABILITY = 2;
    const ARTIFACT_INCREASE_SPEED = 4;
    const ARTIFACT_SPY = 5;
    const ARTIFACT_DIET = 6;
    const ARTIFACT_CRANNY = 10;
    const ARTIFACT_INCREASE_TRAINING_SPEED = 8;
    const ARTIFACT_GREAT_STORE = 9;
    const ART_FOOL = 11;
    const WW_PLAN = 12;

    public static function getArtifactActivationTime()
    {
        $rate = getGameSpeed();
        if ($rate <= 1) {
            return 86400;
        } else if ($rate <= 2) {
            return 86400 * 2 / 3;
        } else if ($rate <= 3) {
            return 86400 * 1 / 2;
        } else if ($rate <= 5) {
            return 8 * 3600;
        }
        return max(86400 / $rate, 600);
    }

    public static function getFoolArtifactChangeEffectInterval()
    {
        $rate = getGameSpeed();
        if ($rate <= 1) {
            return 86400;
        } else if ($rate <= 2) {
            return 86400 * 2 / 3;
        } else if ($rate <= 3) {
            return 86400 * 1 / 2;
        }
        return max(86400 / $rate, 1800);
    }

    public function activateArtifact(array $row)
    {
        $db = DB::getInstance();
        $db->query("UPDATE artefacts SET active=1 WHERE id={$row['id']}");
        if ($row['effecttype'] == ArtefactsModel::ARTIFACT_DIET || $row['type'] == ArtefactsModel::ARTIFACT_DIET) {
            if ($row['size'] > 1) {
                $stmt = $db->query("SELECT owner, kid, isWW FROM vdata WHERE owner={$row['uid']}");
                while ($vi = $stmt->fetch_assoc()) {
                    ResourcesHelper::updateVillageUpkeep($vi['owner'], $vi['kid'], $vi['isWW'] == 1);
                }
            } else {
                ResourcesHelper::updateVillageUpkeep(-1, $row['kid']);
            }
        }
    }

    public static function getArtifactEffectByType($uid, $kid, $type)
    {
        switch ($type) {
            case self::ARTIFACT_CRANNY:
            case self::ARTIFACT_DIET:
            case self::ARTIFACT_INCREASE_BUILDINGS_STABILITY:
            case self::ARTIFACT_INCREASE_SPEED:
            case self::ARTIFACT_INCREASE_TRAINING_SPEED:
                $effect = 1;
                if (($artEffect = self::getActiveArtifactInVillage($uid, $kid, $type)) > 0) {
                    $effect = $artEffect;
                }
                break;
            case self::ARTIFACT_SPY:
                $effect = 1;
                if (($artEffect = self::getActiveArtifactInVillage($uid, $kid, $type)) > 0) {
                    $effect = $artEffect;
                }
                break;
            case self::ARTIFACT_GREAT_STORE:
                $effect = 0;
                if (($artEffect = self::getActiveArtifactInVillage($uid, $kid, $type)) <> 0) {
                    $effect = 1;
                }
                break;
            default:
                return 0;
        }

        return $effect;
    }

    private static function getActiveArtifactInVillage($uid, $kid, $type)
    {
        if (!self::artifactsReleased()) {
            return 0;
        }
        $db = DB::getInstance();
        if ($uid == 0) {
            $uid = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
        }
        return $db->fetchScalar("SELECT effect FROM artefacts a WHERE uid=$uid AND status=1 AND active=1 AND effecttype=$type AND ((aoe=1 AND kid=$kid) OR aoe>1) ORDER BY size ASC LIMIT 1", [], 0);
    }

    public static function artifactsReleased()
    {
        if (php_sapi_name() == 'cli') {
            $db = DB::getInstance();
            return $db->fetchScalar("SELECT ArtifactsReleased FROM config LIMIT 1") == 1;
        }
        return Config::getInstance()->dynamic->ArtifactsReleased;
    }

    public static function wwPlansReleased()
    {
        if (php_sapi_name() == 'cli') {
            $db = DB::getInstance();
            return $db->fetchScalar("SELECT WWPlansReleased FROM config LIMIT 1") == 1;
        }
        return Config::getInstance()->dynamic->WWPlansReleased;
    }


    /**
     * @param $size
     * @param $atkUid
     * @param $atkKid
     * @param $attackerBuildings
     * @param $defBuildings
     * @return bool|int
     *
     * -1 => NoFreeAttackerTreasurySpace
     * -2 => maxArtifactReached
     * -3 => TreasuryExists
     */
    public function canClaimArtifact($type, $size, $atkUid, $defUid, $atkKid, $attackerBuildings, $defBuildings)
    {
        $db = DB::getInstance();
        if ($db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE kid=$atkKid") >= 1) {
            return -1;
        }
        if (!($atkUid == $defUid) && $atkUid <> 1) {
            if ($size > 1 && $db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE size=$size AND uid=$atkUid") >= 1) {
                return -2;
            }
            if ($db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE uid=$atkUid") >= 3) {
                return -2;
            }
        }
        for ($i = 19; $i <= 38; $i++) {
            if ($defBuildings[$i]['item_id'] == 27 && $defBuildings[$i]['level'] > 0) {
                return -3;
            }
        }
        $attackerTreasuryLevel = $attackerBuildings[27];
        $needTreasury = $size == 1 ? 10 : 20;
        if ($attackerTreasuryLevel >= $needTreasury) {
            return true;
        }
        return -1;
    }

    public function getOwnArtefactInfo($kid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM artefacts WHERE kid = " . $kid);
    }

    public function getArtefactDetails($id)
    {
        $db = DB::getInstance();
        $state = $db->query("SELECT * FROM artefacts WHERE id = " . $id);
        if ($state->num_rows) {
            return $state->fetch_assoc();
        }
        return null;
    }

    public function reSpawnArtifact(array $row)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM artefacts WHERE id={$row['id']}");
        if ($row['release_kid']) {
            $row['release_kid'] = (int)$row['release_kid'];
            $occupied = 1 == $db->fetchScalar("SELECT occupied FROM wdata WHERE id={$row['release_kid']}");
            if (!$occupied) {
                $this->Artifact($row['type'], $row['size'], $row['num'], $row['effect'], $row['release_kid']);
                return;
            }
        }
        $this->Artifact($row['type'], $row['size'], $row['num'], $row['effect']);
    }

    public function clearArtifactFromVillage(array $row)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM artefacts WHERE id={$row['id']}");
        $this->fixArtifactOrderForPlayer($row['uid']);
        if ($row['release_kid']) {
            $row['release_kid'] = (int)$row['release_kid'];
            $occupied = 1 == $db->fetchScalar("SELECT occupied FROM wdata WHERE id={$row['release_kid']}");
            if (!$occupied) {
                $this->Artifact($row['type'], $row['size'], $row['num'], $row['effect'], $row['release_kid']);
                return;
            }
        }
        $this->Artifact($row['type'], $row['size'], $row['num'], $row['effect']);
        $this->fixArtifactOrderForPlayer($row['uid']);
    }

    public function Artifact($type, $size, $num, $effect, $kid = false, $units = null)
    {
        $db = DB::getInstance();
        $db->begin_transaction();
        if (!$kid) {
            $min_r = ceil(MAP_SIZE / 8);
            $max_r = Formulas::getMapMinDistanceFromCenter() + 15;
            $tries = 0;
            $found = false;
            while (!$found && $tries <= 10) {
                $max_r -= $tries * 3;
                $find = $db->fetchScalar("SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype=3 AND r >= $min_r AND r <= $max_r ORDER BY rand LIMIT 1");
                $found = $find > 0;
                $tries++;
            }

            if (!$found) {
                logError("Unable to find a suitable village to create artifact on.");
                return false;
            }

            $kid = $find;
        }
        if (is_null($units)) {
            $units = $this->getArtifactUnits()[$size == 1 ? 'small' : ($size == 2 ? 'big' : 'unique')];
        }
        $register = new RegisterModel();
        if ($register->createArtifactVillage($kid, $type, $size, $units)) {
            $query = [
                'uid' => 1,
                'type' => $type,
                'kid' => $kid,
                'release_kid' => $kid,
                'size' => $size,
                'conquered' => time(),
                'num' => $num,
                'effecttype' => $type,
                'effect' => $effect,
                'aoe' => $size,
            ];
            $db->query("INSERT INTO artefacts (" . implode(",", array_keys($query)) . ") VALUES (" . implode(",", array_values($query)) . ")");
            $db->commit();
        } else {
            $db->rollback();
        }
        return $kid;
    }


    public function getArtifactUnits()
    {
        if (getGameSpeed() <= 10) {
            $speed = getGameSpeed();
            if ($speed <= 5) $speed = 2;
            else if ($speed <= 10) $speed = 5;
        } else {
            $speed = ceil(getGameSpeed() / (isInstantFinishEnabled() ? 40 : 50));
        }
        $units = [
            1 => mt_rand(3000, 5000),
            mt_rand(1000, 3000),
            mt_rand(2000, 5000),
            mt_rand(70, 160),
            mt_rand(1500, 2500),
            mt_rand(1500, 2500),
            mt_rand(850, 2000),
            mt_rand(300, 800),
            1,
            1,
        ];
        $rate = 1 * $speed;
        $result = [
            'small' => $units,
            'big' => $units,
            'unique' => $units,
        ];
        for ($i = 1; $i <= 8; ++$i) {
            $result['small'][$i] = round($result['small'][$i] * $rate);
            $result['big'][$i] = round($result['big'][$i] * $rate * 1.5389380530973451327433628318584);
            $result['unique'][$i] = round($result['unique'][$i] * $rate * 2.3079646017699115044247787610619);
        }
        return $result;
    }

    public function arteIsMine($id, $kid, $new_uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE artefacts SET uid = " . $new_uid . " WHERE id = " . $id);
        $this->captureArtefact($id, $kid, $new_uid);
    }

    public function captureArtefact($currentArtifact, $kid, $uid)
    {
        $db = DB::getInstance();
        if (is_numeric($currentArtifact)) {
            $currentArtifact = $db->query("SELECT * FROM artefacts WHERE id=$currentArtifact");
            if (!$currentArtifact->num_rows) {
                return;
            }
            $currentArtifact = $currentArtifact->fetch_assoc();
        }
        $playerName = $db->real_escape_string((string)$db->fetchScalar("SELECT name FROM users WHERE id={$uid}"));

        if($currentArtifact['type'] == 12){
            (new SummaryModel())->setFirstWWPlanUser($playerName);
        } else {
            (new SummaryModel())->setFirstArtifactUser($playerName);
        }

        $db->query("INSERT INTO artlog (artId, uid, name, kid, time) VALUES ({$currentArtifact['id']}, $uid, '$playerName', $kid, " . time() . ")");
        $time = time();
        if ($currentArtifact['type'] != 12) {
            $db->query("UPDATE artefacts SET kid=$kid, uid=$uid, conquered=$time, active=0 WHERE id={$currentArtifact['id']}");
            $this->fixArtifactOrderForPlayer($uid);
            $this->fixArtifactOrderForPlayer($currentArtifact['uid']);
        } else {
            $db->query("UPDATE artefacts SET status=2 WHERE type=12 AND uid=$uid");
            $db->query("UPDATE artefacts SET kid=$kid, uid=$uid, conquered=$time, status=1, active=0 WHERE id={$currentArtifact['id']}");
        }
//        if (($currentArtifact['uid'] == $uid && $currentArtifact['active'] == 1) ||
//            (getCustom("activateWWPlanOnCapture") && $currentArtifact['type'] == 12)) {
//            $db->query("UPDATE artefacts SET active=1 WHERE id={$currentArtifact['id']}");
//        }
        if (self::ART_FOOL == $currentArtifact['type']) {
            $this->updateFoolArtifact($currentArtifact['id']);
        }
        $find = $db->query("SELECT kid FROM vdata WHERE (owner={$currentArtifact['uid']} OR owner=$uid)");
        while ($row = $find->fetch_assoc()) {
            ResourcesHelper::updateVillageResources($row['kid'], false);
        }

    }

    public function fixArtifactOrderForPlayer($uid)
    {
        $db = DB::getInstance();
        //disable all artifacts of two accounts
        $db->query("UPDATE artefacts SET status=2 WHERE uid=$uid");

        //activate the last small artifact
        $db->query("UPDATE artefacts SET status=1 WHERE size=1 AND uid=$uid ORDER BY conquered DESC LIMIT 1");

        //activate first big or unique artifact
        $db->query("UPDATE artefacts SET status=1 WHERE uid=$uid AND size>1 ORDER BY conquered ASC LIMIT 1");

        //activating other small artifacts
        $left = 3 - (int)$db->fetchScalar("SELECT COUNT(id) FROM artefacts WHERE status=1 AND uid=$uid");
        if ($left > 0) {
            $db->query("UPDATE artefacts SET status=1 WHERE uid=$uid AND status=2 AND size=1 ORDER BY conquered ASC LIMIT $left");
        }
    }

    public function releaseArtifacts()
    {
        $conf = Config::getInstance();
        $conf->dynamic->ArtifactsReleased = $automationSettings['ArtifactsReleased'] = 1;
        $db = DB::getInstance();
        $db->query("UPDATE config SET ArtifactsReleased=1");
        //adding whole server artifacts.
        $art = [
            self::ARTIFACT_INCREASE_BUILDINGS_STABILITY,
            self::ARTIFACT_INCREASE_SPEED,
            self::ARTIFACT_SPY,
            self::ARTIFACT_DIET,
            self::ARTIFACT_INCREASE_TRAINING_SPEED,
            self::ARTIFACT_GREAT_STORE,
            self::ARTIFACT_CRANNY,
            self::ART_FOOL,
        ];
        $eff = [
            ['small' => '4', 'big' => '3', 'unique' => '5'],
            ['small' => '2', 'big' => '1.5', 'unique' => '2'],
            ['small' => '5', 'big' => '3', 'unique' => '10'],
            ['small' => '1/2', 'big' => '3/4', 'unique' => '1/2'],
            ['small' => '1/2', 'big' => '3/4', 'unique' => '1/2'],
            ['small' => '1', 'big' => '1', 'unique' => '1'], //store no x!
            ['small' => '200', 'big' => '100', 'unique' => '500'],
            ['small' => '0', 'big' => '0', 'unique' => '0'],
            //fool artefact is random!
        ];
        $stmt = $db->query("SELECT kid FROM artefacts WHERE uid=1");
        while ($row = $stmt->fetch_assoc()) {
            (new AccountDeleter())->deleteVillage($row['kid'], false, false);
        }
        $db->query("TRUNCATE TABLE artefacts");
        $units = [];
        foreach ($art as $type) {
            $units[$type] = $this->getArtifactUnits();
        }
        $scale = MAP_SIZE / 100;
        $min = 10 * $scale;

        /* $this->releaseSmallArtifacts($min + 12 * $scale + (7 * $scale * 3), $scale * 2.5, $units); //far
        $this->releaseBigArtifacts($min + 8 * $scale, $scale * 2.5, $units); //near
        $this->releaseUniqueArtifacts($min, $units); //nearest*/

        $this->releaseSmallArtifacts($min + 6 * $scale + (3 * $scale * 2), $scale * 2, $units); //far
        $this->releaseBigArtifacts($min + 4 * $scale, $scale * 2, $units); //near
        $this->releaseUniqueArtifacts($min, $units); //nearest


        /*foreach ($art as $key => $type) {
            $end = $type == self::ARTIFACT_GREAT_STORE ? 10 : 11;
            $big = 4;
            if ($type == self::ART_FOOL) {
                for ($i = 1; $i <= $end; ++$i) {
                    if ($i == $end) {
                        $this->Artefact($type, 3, $i, $eff[$key]['unique']);
                    } else {
                        $this->Artefact($type, 1, $i, $eff[$key]['small']);
                    }
                }
            } else {
                for ($i = 1; $i <= $end; ++$i) {
                    if ($i <= $big) {
                        $this->Artefact($type, 2, $i, $eff[$key]['big']);
                    } else if ($i == $end && $type != self::ARTIFACT_GREAT_STORE) {
                        $this->Artefact($type, 3, $i, $eff[$key]['unique']);
                    } else {
                        $this->Artefact($type, 1, $i, $eff[$key]['small']);
                    }
                }
            }
        }*/
        $this->updateFoolArtes();
        $m = new PublicMsgModel();
        $m->haveNewMessage('[ArtifactsReleaseMessage]');
        (new InfoBoxModel())->deleteInfoByTypeInServer(8);
    }

    private function releaseSmallArtifacts($r, $scalePart, $units)
    {
        $types = [
            self::ARTIFACT_INCREASE_BUILDINGS_STABILITY => '4',
            self::ARTIFACT_INCREASE_SPEED => '2',
            self::ARTIFACT_SPY => '5',
            self::ARTIFACT_DIET => '1/2',
            self::ARTIFACT_INCREASE_TRAINING_SPEED => '1/2',
            self::ARTIFACT_GREAT_STORE => '1',
            self::ARTIFACT_CRANNY => '200',
            self::ART_FOOL => 0,
        ];
        $types = shuffle_assoc($types);
        $x = 0;
        foreach ($types as $type => $effect) {
            $total = $type == self::ART_FOOL ? 10 : 6;
            //$baseAngle = (360 / ((7 * 6) + 10)) * $x++;
            $baseAngle = (360 / 8) * $x++;
            for ($i = 1; $i <= $total; ++$i) {
                $angle = $baseAngle + ($i - 1) * (360 / $total);
                while ($angle >= 360) $angle -= 360;
                if (($kid = $this->findArtifactVillageWithDegree($r, $angle))) {
                    $this->Artifact($type, 1, $i, $effect, $kid, $units[$type]['small']);
                } else {
                    logError("Failed to find a spot for artifact (small) at angle $angle and radii $r.");
                }
            }
            $r += $scalePart;
        }
    }

    private function findArtifactVillageWithDegree($r, $degree)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype=3 ORDER BY (ABS($r-r)+ABS(angle-$degree)) ASC LIMIT 1");
    }

    private function releaseBigArtifacts($r, $scalePart, $units)
    {
        $types = [
            self::ARTIFACT_INCREASE_BUILDINGS_STABILITY => '3',
            self::ARTIFACT_INCREASE_SPEED => '1.5',
            self::ARTIFACT_SPY => '3',
            self::ARTIFACT_DIET => '3/4',
            self::ARTIFACT_INCREASE_TRAINING_SPEED => '3/4',
            self::ARTIFACT_GREAT_STORE => '1',
            self::ARTIFACT_CRANNY => '100',
        ];
        $types = shuffle_assoc($types);
        $x = 0;
        foreach ($types as $type => $effect) {
            $baseAngle = 360 / 7 * $x++;
            for ($i = 1; $i <= 4; ++$i) {
                $angle = $baseAngle + ($i - 1) * 90;
                while ($angle >= 360) $angle -= 360;
                if (($kid = $this->findArtifactVillageWithDegree($r, $angle))) {
                    $this->Artifact($type, 2, $i, $effect, $kid, $units[$type]['big']);
                } else {
                    logError("Failed to find a spot for artifact (big) at angle $angle and radii $r.");
                }
            }
            $r += $scalePart;
        }
    }

    private function releaseUniqueArtifacts($r, $units)
    {
        $types = [
            self::ARTIFACT_INCREASE_BUILDINGS_STABILITY => '5',
            self::ARTIFACT_INCREASE_SPEED => '2',
            self::ARTIFACT_SPY => '10',
            self::ARTIFACT_DIET => '1/2',
            self::ARTIFACT_INCREASE_TRAINING_SPEED => '1/2',
            self::ARTIFACT_CRANNY => '500',
            self::ART_FOOL => '0',
        ];
        $types = shuffle_assoc($types);
        $angles = $this->getRandomAngles(7);
        $x = 0;
        foreach ($types as $type => $effect) {
            $angle = $angles[$x++];
            if (($kid = $this->findArtifactVillageWithDegree($r, $angle))) {
                $this->Artifact($type, 3, 0, $effect, $kid, $units[$type]['unique']);
            } else {
                logError("Failed to find a spot for artifact (unique) at angle $angle and radii $r.");
            }
        }
    }

    private function getRandomAngles($count)
    {
        $interval = 360 / $count;
        $startAngle = mt_rand(0, 360);
        $angles = [$startAngle];
        for ($i = 1; $i <= ($count - 1); ++$i) {
            $angle = $startAngle + $interval * $i;
            while ($angle >= 360) {
                $angle -= 360;
            }
            array_push($angles, $angle);
        }
        shuffle($angles);
        return $angles;
    }

    public function updateFoolArtes()
    {
        $db = DB::getInstance();
        $activationTime = self::getArtifactActivationTime();
        $changeInterval = self::getFoolArtifactChangeEffectInterval();
        $time = time() - $changeInterval;
        $find = $db->query("SELECT * FROM artefacts WHERE type=" . self::ART_FOOL . " AND status=1 AND (lastupdate=0 OR GREATEST(lastupdate, conquered+$changeInterval+$activationTime) <= $time)");
        while ($row = $find->fetch_assoc()) {
            $this->updateFoolArtifact($row);
        }
    }

    public function reSpawnMissingArtifacts()
    {
        $db = DB::getInstance();
        $artifacts = $db->query("SELECT a.* FROM artefacts a WHERE (SELECT COUNT(v.kid) FROM vdata v WHERE v.kid=a.kid)=0");
        while ($row = $artifacts->fetch_assoc()) {
            $this->reSpawnArtifact($row);
        }
    }

    public function updateFoolArtifact($row)
    {
        $time = time();
        $db = DB::getInstance();
        if (is_numeric($row)) {
            $row = $db->query("SELECT * FROM artefacts WHERE id={$row}");
            if ($row->num_rows) {
                $row = $row->fetch_assoc();
            } else {
                return;
            }
        }
        $effect_arr = [
            self::ARTIFACT_INCREASE_BUILDINGS_STABILITY,
            self::ARTIFACT_INCREASE_SPEED,
            self::ARTIFACT_SPY,
            self::ARTIFACT_DIET,
            self::ARTIFACT_CRANNY,
            self::ARTIFACT_INCREASE_TRAINING_SPEED,
        ];
        shuffle($effect_arr);
        $effecttype = $effect_arr[mt_rand(0, 5)];
        $aoerand = mt_rand(1, 100);
        $aoe = $aoerand <= 60 ? 1 : 2;
        if($row['size'] == 3){
            $aoe = 3;
        }
        $negative = $row['size'] == 1 && mt_rand(1, 3) == 3;
        switch ($effecttype) {
            case self::ARTIFACT_INCREASE_BUILDINGS_STABILITY:
                $effect = [2, 3, 4][mt_rand(0, 2)];
                if ($negative) {
                    $effect = [1 / 2, 1 / 3, 1 / 4][mt_rand(0, 2)];
                }
                break;
            case self::ARTIFACT_INCREASE_SPEED:
                $effect = [3 / 2, 1 / 2][mt_rand(0, 1)];
                if ($negative) {
                    $effect = [2 / 3, 2][mt_rand(0, 1)];
                }
                break;
            case self::ARTIFACT_SPY:
                $effect = [3, 5, 10][mt_rand(0, 2)];
                if ($negative) {
                    $effect = [1 / 3, 1 / 5, 1 / 10][mt_rand(0, 2)];
                }
                break;
            case self::ARTIFACT_DIET:
                $effect = [3 / 4, 1 / 2][mt_rand(0, 1)];
                if ($negative) {
                    $effect = [4 / 3, 2, 3][mt_rand(0, 2)];
                }
                break;
            case self::ARTIFACT_CRANNY:
                $effect = mt_rand(100, 500);
                if ($negative) {
                    $effect = [3 / 4, 1 / 2, 1 / 4, 1 / 10][mt_rand(0, 3)];
                }
                break;
            case self::ARTIFACT_INCREASE_TRAINING_SPEED:
                $effect = [1 / 2, 3 / 4][mt_rand(0, 1)];
                if ($negative) {
                    $effect = [3 / 2, 2, 4 / 3][mt_rand(0, 2)];
                }
                break;
        }
        if (isset($effect)) {
            $row['id'] = (int)$row['id'];
            $db->query("UPDATE artefacts SET lastupdate=$time, effecttype=$effecttype, effect=$effect, aoe=$aoe WHERE id={$row['id']}");
            if ($effecttype == self::ARTIFACT_DIET || $row['effecttype'] == self::ARTIFACT_DIET) {
                if ($row['size'] == 1 && $aoe == 1) {
                    ResourcesHelper::updateVillageResources($row['kid'], false);
                } else {
                    $stmt = $db->query("SELECT owner, kid, isWW FROM vdata WHERE owner={$row['uid']}");
                    while ($vi = $stmt->fetch_assoc()) {
                        ResourcesHelper::updateVillageUpkeep($vi['owner'], $vi['kid'], $vi['isWW'] == 1);
                    }
                }
            }
        }
    }

    public function releaseWWPlans()
    {
        $conf = Config::getInstance();
        $conf->dynamic->WWPlansReleased = 1;
        $db = DB::getInstance();
        $db->query("UPDATE config SET WWPlansReleased=1");
        $count = Config::getProperty("custom", "wwCount");
        if (Config::getProperty("custom", "wwPlansEnabled")) {
            $positions = (new WonderOfTheWorldModel())->findPositionsForWWPlan($count);
            foreach ($positions as $kid) {
                $this->Artifact(12, 1, 0, 0, $kid);
            }
        }
        $find = $db->query("SELECT kid, isWW, owner FROM vdata WHERE isWW=1");
        while ($row = $find->fetch_assoc()) {
            $hdp = VillageModel::getHDP($row['kid']);
            ResourcesHelper::updateVillageUpkeep($row['owner'], $row['kid'], $row['isWW'] == 1, $hdp);
        }
        $m = new PublicMsgModel();
        if (Config::getProperty("custom", "wwPlansEnabled")) {
            $m->haveNewMessage('[WWPlansReleaseMessage]');
        } else {
            $m->haveNewMessage('[WWConstructStart]');
        }
        (new InfoBoxModel())->deleteInfoByTypeInServer(9);
        if (Config::getProperty("custom", "removeProtectionAfterReleaseOfWWPlans")) {
            $db->query("UPDATE users SET protection=" . time() . " WHERE protection > " . time());
            (new InfoBoxModel())->deleteInfoByTypeInServer(6);
        }
    }
}