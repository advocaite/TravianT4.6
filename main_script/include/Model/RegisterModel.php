<?php

namespace Model;

use function array_values;
use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\Helpers\CulturePointsHelper;
use Game\Hero\HeroFace;
use Game\Map\Map;
use Game\ResourcesHelper;
use function getGame;
use function getGameElapsedSeconds;
use function getGameSpeed;
use function is_array;
use const MAP_SIZE;

class RegisterModel
{
    public function userExistsWithId($uid)
    {
        $db = DB::getInstance();
        $uid = (int)$uid;
        $stmt = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE id=$uid");
        return (int)$stmt >= 1;
    }

    public function addFakeUser($names)
    {
        $db = DB::getInstance();
        $m = new OptionModel();
        $k = 0;
        if (is_array($names)) {
            $array = $names;
        } else {
            $array = explode(',', $names);
        }
        foreach ($array as $name) {
            $name = substr(trim($name), 0, 15);
            if (empty($name)) {
                continue;
            }
            if ($m->nameExists($name) || $m->isNameBlackListed($name)) {
                continue;
            }
            $kid = $this->generateBase('rand', 3);
            if (empty($kid)) {
                continue;
            }
            if (getGame("allowNewTribes")) {
                $race = [1, 2, 3, 6, 7][mt_rand(0, 4)];
            } else {
                $race = [1, 2, 3][mt_rand(0, 2)];
            }
            $uid = $this->addUser($name, sha1(get_random_string(mt_rand(1, 11))), '', $race, $kid, 3);
            $this->createBaseVillage($uid, $name, $race, $kid);
            $db->query("UPDATE users SET last_login_time=" . (time() - mt_rand(1, 7200)) . " WHERE id=$uid");
            $countryFlag = AutomationModel::getRandomCountryFlag();
            $db->query("UPDATE users SET countryFlag='$countryFlag', lastCountryFlagCheck=" . time() . " WHERE id=$uid");
            $this->populateUserRank($uid);
            ++$k;
        }
        return $k;
    }

    public function generateBase($sector, $fieldType = 3, $occupy = true, $tries = 0)
    {
        $minDistance = Formulas::getMapMinDistanceFromCenter();
        $maxDistance = $minDistance + 10 * ($tries + 3);
        if (getGameElapsedSeconds() <= 7200) {
            $minDistance = max($minDistance, 23);
            $maxDistance = ($minDistance + 10) + 10 * $tries;
        }
        $db = DB::getInstance();
        switch ($sector) {
            case 'ne':
            case 'no':
                $angle = [0, 90];
                break;
            case 'se':
            case 'so':
                $angle = [270, 360];
                break;
            case 'nw':
                $angle = [90, 180];
                break;
            case 'sw':
                $angle = [180, 270];
                break;
            default:
                $angle = [0, 360];
                break;
        }
        $conditions = [];
        $conditions[] = 'occupied=0';
        $conditions[] = "fieldtype=$fieldType";
        $conditions[] = "(angle >= {$angle[0]} AND angle <= {$angle[1]})";
        $conditions[] = "(r > 25 AND r >= $minDistance AND r <= $maxDistance)";
        $nearby = '(SELECT COUNT(av.kid) FROM available_villages av WHERE av.occupied=1 AND ABS(av.r-a.r) <= 6 AND ABS(av.angle-a.angle) <= 8)';
        $conditions[] = "$nearby < 3";
        $conditions = implode(" AND ", $conditions);
        $q = "SELECT a.kid FROM available_villages a WHERE " . $conditions . " ORDER BY RAND() LIMIT 1";
        $kid = $db->fetchScalar($q);
        if ($kid !== false) {
            if($occupy){
                $db->query("UPDATE available_villages SET occupied=1 WHERE kid=$kid");
            }
            return (int)$kid;
        }
        if ($tries < 16) {
            return $this->generateBase($sector, $fieldType, $occupy, ++$tries);
        }
        return false;
    }

    public function addUser($name, $password, $email, $race, $kid, $access = 1, $addHero = true, $installation = FALSE)
    {
        $name = substr($name, 0, 15);
        $lastupdate = time();
        $cp = ceil(500 / (getGameSpeed() > 8 ? 8 : getGameSpeed()));
        $protection = $lastupdate + Formulas::getProtectionBasicTime($lastupdate);
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        $gold = Config::getInstance()->gold->startGold;
        $uuid = $db->fetchScalar('SELECT UUID()');
        $db->query("INSERT INTO users (uuid, name, password, email, access, gift_gold, signupTime, protection, race, kid, cp, lastupdate, last_adventure_time, location, desc1, desc2, note) VALUES ('$uuid', '$name','$password', '$email', $access, $gold , $lastupdate,$protection, $race,'$kid',$cp, $lastupdate, $lastupdate, '', '', '', '')");
        $uid = $db->lastInsertId();
        if (in_array($race, [1, 2, 3, 6, 7])) {
            $m = new SummaryModel();
            $m->addPlayerToSummary($race);
        }
        if (!$installation) {
            $m = new InfoBoxModel();
            $m->addInfo($uid, FALSE, 6, '', 0, $protection);
            $m = new DailyQuestModel();
            $m->addDailyQuestRow($uid);
        }
        //$db->query("UPDATE users SET max_off_time=$lastupdate, max_def_time=$lastupdate WHERE id=$uid");
        if ($addHero && $uid) {
            $this->addHero($uid, $kid);
            $this->addHeroFace($uid);
            $this->addHeroInventory($uid);
        }
        return $uid;
    }

    public function addHero($uid, $kid)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO hero (uid, kid, lastupdate) VALUES ($uid, $kid, " . time() . ")");
    }

    public function addHeroFace($uid)
    {
        $f = new HeroFace();
        $face = $f->decodeAttribute($f->getRandomHeroFace("male"));
        $db = DB::getInstance();
        $db->query(vsprintf("INSERT INTO face (uid, headProfile, hairColor, hairStyle, ears, eyebrow, eyes, nose, mouth, beard, gender, lastupdate) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,'%s',%s)",
            [
                $uid,
                $face['headProfile'],
                $face['hairColor'],
                $face['hairStyle'],
                $face['ears'],
                $face['eyebrow'],
                $face['eyes'],
                $face['nose'],
                $face['mouth'],
                $face['beard'],
                $face['gender'],
                time(),
            ]));
    }

    public function addHeroInventory($uid)
    {
        $time = time();
        $db = DB::getInstance();
        $db->query("INSERT INTO inventory (uid, lastupdate) VALUES ($uid, $time)");
    }

    public function createBaseVillage($uid, $playerName, $race, $kid)
    {
        $village_name = sprintf(T("Global", "playerVillageName"), $playerName);
        $result = $this->_createVillage(
            $uid,
            $race,
            $kid,
            $village_name,
            1,
            0,
            0,
            false
        );
        if (!$result) return false;
        $db = DB::getInstance();
        $db->query("UPDATE units SET u11=1 WHERE kid=$kid");
        $this->addResourceFields($kid);
        if ($uid <> 2) {
            $this->populateBuildingLevels($kid, getGame("firstVillageCreationFieldsLevel"));
        }
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, false);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP($uid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->addAdventures($uid);
        ResourcesHelper::updateVillageResources($kid, false);
        return true;
    }

    private function _createVillage($uid, $race, $kid, $village_name, $capital, $expandedFrom, $isWW, $isArtifact)
    {
        $db = DB::getInstance();
        $db->query("UPDATE available_villages SET occupied=1 WHERE kid=$kid");
        CulturePointsHelper::updateUserCP($uid);
        $village_name = $db->real_escape_string(str_replace("'", '`', $village_name));
        $maxRes = 800 * getGame("storage_multiplier");
        $minRes = ceil($maxRes * 0.9375);
        $fieldType = $db->fetchScalar("SELECT fieldtype FROM wdata WHERE id=$kid");
        $row = vsprintf("'%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'",
            [
                $kid,
                $uid,
                $fieldType,
                $village_name,
                $capital ? 1 : 0,
                0,
                0,
                $minRes,
                $minRes,
                $minRes,
                $minRes,
                $maxRes,
                $maxRes,
                time(),
                miliseconds(),
                time(),
                $isWW ? 1 : 0,
                $expandedFrom,
                $isArtifact ? 1 : 0,
            ]);
        $db->query("UPDATE wdata SET occupied=1 WHERE id=$kid");
        $db->begin_transaction();
        $good = $db->query("INSERT INTO vdata (kid, owner, fieldtype, name, capital, pop, cp, wood, clay, iron, crop, maxstore, maxcrop, last_loyalty_update, lastmupdate, created, isWW, expandedfrom, lastVillageCheck) VALUES ($row)");
        if (!$good || !$db->affectedRows()) {
            $db->query("UPDATE available_villages SET occupied=0 WHERE kid=$kid");
            $db->query("UPDATE wdata SET occupied=0 WHERE id=$kid");
            $db->rollback();
            return false;
        }
        $db->commit();
        $this->addUnits($kid, $race);
        $this->addTech($kid);
        $this->addSmithy($kid);
        Map::villageDestroyOrCaptureOrNewVillageUpdate($kid);
        return true;
    }

    public function addUnits($kid, $race, $hasHero = FALSE)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM units WHERE kid=$kid");
        $db->query("INSERT INTO units (kid, race, u11) VALUES ($kid, $race, " . ($hasHero ? 1 : 0) . ")");
    }

    public function addTech($kid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM tdata WHERE kid=$kid");
        $db->query("INSERT INTO tdata (kid) values ($kid)");
    }

    public function addSmithy($kid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM smithy WHERE kid=$kid");
        $db->query("INSERT INTO smithy (kid) values ($kid)");
    }

    public function addResourceFields($kid)
    {
        $db = DB::getInstance();
        $fieldsArr = Formulas::getFieldTypeResourceMap($this->getVillageFieldType($kid));
        $queryArr = ['kid' => $kid];
        for ($i = 1; $i <= 18; ++$i) {
            $queryArr["f{$i}t"] = $fieldsArr[$i - 1];
        }
        $queryArr['f26'] = 1;
        $queryArr['f26t'] = 15;
        $db->query("DELETE FROM fdata WHERE kid=$kid");
        $state = $db->query("INSERT INTO fdata (" . implode(",", array_keys($queryArr)) . ") VALUES (" . implode(",", array_values($queryArr)) . ")");
        return $state && $db->affectedRows();
    }

    private function getVillageFieldType($kid)
    {
        $db = DB::getInstance();
        return (int)$db->fetchScalar("SELECT fieldtype FROM wdata WHERE id=$kid");
    }

    private function populateBuildingLevels($kid, $level)
    {
        if ($level > 0) {
            for ($i = 1; $i <= 18; ++$i) {
                BuildingAction::upgrade($kid, $i, $level, false, false);
            }
        }
    }

    private function setVillageCPPOP($kid, $pop, $cp)
    {
        $db = DB::getInstance();
        $db->query("UPDATE vdata SET cp=$cp, pop=$pop WHERE kid=$kid");
    }

    private function increaseUserPopCP($uid, $pop, $cp)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1, total_villages=total_villages+1, total_pop=total_pop+$pop, cp_prod=cp_prod+$cp WHERE id=$uid");

        $aid = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");

        if ($aid) {
            $db->query("UPDATE alidata SET week_pop_changes=week_pop_changes+{$pop} WHERE id=$aid");
        }
    }

    public function populateUserRank($id)
    {
        $db = DB::getInstance();
        if (getCustom("usePopulationAsClimbersRank")) {
            $db->query("UPDATE users SET oldRank=cast(total_pop as SIGNED) WHERE id=$id");
            return;
        }
        $statistics = new StatisticsModel();
        $rank = $statistics->getPlayerRankById($id);
        $db->query("UPDATE users SET oldRank=$rank WHERE id=$id");
    }

    public function addAdventures($uid)
    {
        $m = new AdventureModel();
        $m->addNewUserAdventures($uid);
    }

    public function getBestPosition($kid, $fieldType = 3)
    {
        $db = DB::getInstance();
        $xy = Formulas::kid2xy($kid);
        $distance = "(SQRT(POW(w.x-{$xy['x']}, 2)+POW(w.y-{$xy['y']}, 2)))";
        if ($fieldType) {
            $result = $db->fetchScalar("SELECT kid FROM wdata w, available_villages a WHERE w.occupied=0 AND w.fieldtype=$fieldType AND a.kid=w.id ORDER BY $distance ASC, a.rand LIMIT 1");
        } else {
            $result = $db->fetchScalar("SELECT kid FROM wdata w, available_villages a WHERE w.occupied=0 AND w.fieldtype>0 AND a.kid=w.id ORDER BY $distance ASC, a.rand LIMIT 1");
        }
        return $result;
    }

    public function generateFakeUserVillage($count = 1, $isMain = false)
    {
        $db = DB::getInstance();
        if ($isMain) {
            $result = $db->fetchScalar("SELECT GROUP_CONCAT(kid) FROM (SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype=3 AND r>25 ORDER BY rand ASC, r ASC LIMIT $count) as x");
        } else {
            $result = $db->fetchScalar("SELECT GROUP_CONCAT(kid) FROM (SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype>0 AND r>25 ORDER BY rand ASC, r ASC LIMIT $count) as x");
        }
        return rtrim($result, ',');
    }

    public function createNewVillage($uid, $race, $kid, $expandedFrom = 0)
    {
        $village_name = T("Global", "newVillageName");
        $result = $this->_createVillage(
            $uid,
            $race,
            $kid,
            $village_name,
            0,
            $expandedFrom,
            0,
            false
        );
        if (!$result) return false;
        $this->addResourceFields($kid);
        $this->populateBuildingLevels($kid, getGame("otherVillageCreationFieldsLevel"));
        if (Formulas::isGrayArea($kid)) {
            $m = new NatarsModel();
            $m->attackNewVillage($kid);
        }
        $db = DB::getInstance();
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, false);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP($uid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        ResourcesHelper::updateVillageResources($kid, false);
        $db->query("UPDATE users SET kid=$kid WHERE id=$uid");
        return true;
    }

    public function createNewNatarVillage($kid, $isCapital = false)
    {
        $xy = Formulas::kid2xy($kid);
        $village_name = T("Global", "NatarsName") . " " . (implode("|", $xy));
        $result = $this->_createVillage(
            1,
            5,
            $kid,
            $village_name,
            $isCapital,
            0,
            0,
            false
        );
        if (!$result) return false;
        $this->addResourceFields($kid);
        $this->populateBuildingLevels($kid, getGame("otherVillageCreationFieldsLevel"));
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, false);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP(1, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        ResourcesHelper::updateVillageResources($kid, false);
        return true;
    }

    public function createNewFarmVillage($kid, $n, $isCapital = false)
    {
        $db = DB::getInstance();
        $village_name = T("Global", "Farm") . ' - ' . $n;
        $result = $this->_createVillage(1, 5, $kid, $village_name, $isCapital, 0, 0, false);
        if (!$result) return false;
        $level = Config::getProperty("farms", $isCapital ? "bigFarmsResourcesLevel" : 'smallFarmsResourcesLevel');
        $this->addResourceFields($kid);
        $this->populateBuildingLevels($kid, $level);
        $countStorage = $isCapital ? Config::getProperty("farms", "bigFarmsStorageCount") : Config::getProperty("farms",
            "smallFarmsStorageCount");
        $storage = Formulas::storeCAP(20) * $countStorage;
        $db->query("UPDATE vdata SET isFarm=1, extraMaxcrop=extraMaxcrop+$countStorage, maxcrop=maxcrop+$storage, extraMaxstore=extraMaxstore+$countStorage, maxstore=maxstore+$storage WHERE kid=$kid");
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, false);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP(1, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        ResourcesHelper::updateVillageResources($kid, false);
        return true;
    }

    public function createNatarsBaseVillage($kid)
    {
        $db = DB::getInstance();
        $village_name = T("Global", "NatarsName");
        $result = $this->_createVillage(1, 5, $kid, $village_name, 1, 0, 1, false);
        if (!$result) return false;
        $this->addWWVillageFields($kid);
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, true);
        $this->setVillageCPPOP($kid, 781, $calculatedCPPOP['cp']);
        $this->increaseUserPopCP(1, 781, $calculatedCPPOP['cp']);
        $db->query("UPDATE units SET u11=1 WHERE kid=$kid");
        ResourcesHelper::updateVillageResources($kid, false);
        return true;
    }

    private function addWWVillageFields($kid)
    {
        $fieldsArr = Formulas::getFieldTypeResourceMap($this->getVillageFieldType($kid));
        $queryArr = ['kid' => $kid];
        for ($i = 1; $i <= 18; ++$i) {
            $type = $fieldsArr[$i - 1];
            if ($type <= 3) {
                $level = 5;
            } else {
                $level = 6;
            }
            $queryArr["f{$i}"] = $level;
            $queryArr["f{$i}t"] = $type;
        }
        $queryArr = array_merge($queryArr,
            [
                'f99t' => 40,
                'f19'  => 20,
                'f19t' => 10,
                'f20'  => 10,
                'f20t' => 10,
                'f22'  => 15,
                'f22t' => 15,
                'f23'  => 20,
                'f23t' => 11,
                'f27'  => 10,
                'f27t' => 11,
                'f36'  => 1,
                'f36t' => 17,
                'f38'  => 5,
                'f38t' => 23,
                'f39'  => 20,
                'f39t' => 16,
            ]);
        $store = Formulas::storeCAP(20) + Formulas::storeCAP(10);
        $db = DB::getInstance();
        $db->query("INSERT INTO fdata (" . implode(",", array_keys($queryArr)) . ") VALUES (" . implode(",",
                array_values($queryArr)) . ")");
        $db->query("UPDATE vdata SET maxstore=$store, maxcrop=$store WHERE kid=$kid");
    }

    public function createArtifactVillage($kid, $type, $size, $units)
    {
        if ($type == 12) {
            $name = T("Artefacts", $type . ".name");
        } else {
            if ($size == 3) {
                $name = T("Artefacts", $type . ".names." . $size);
            } else {
                $name = sprintf(T("Artefacts", $type . ".names." . $size), '');
            }
        }
        $db = DB::getInstance();
        $result = $this->_createVillage(1, 5, $kid, $name, 0, 0, 0, true);
        if (!$result) {
            return false;
        }
        $this->addArtifactVillageFields($kid, $size);
        $modify = [];
        for ($i = 1; $i <= 10; ++$i) {
            if (!isset($units[$i])) continue;
            $modify[] = "u{$i}=" . $units[$i];
        }
        $store = Formulas::storeCAP(10);
        $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid=$kid");
        $db->query("UPDATE vdata SET maxstore=$store, maxcrop=$store WHERE kid=$kid");
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, false);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP(1, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        ResourcesHelper::updateVillageResources($kid, false);
        return $result;
    }

    private function addArtifactVillageFields($kid, $size)
    {
        $fieldsArr = Formulas::getFieldTypeResourceMap($this->getVillageFieldType($kid));
        $queryArr = ['kid' => $kid];
        for ($i = 1; $i <= 18; ++$i) {
            $queryArr["f{$i}t"] = $fieldsArr[$i - 1];
        }
        if ($size == 1) {
            $queryArr = array_merge($queryArr,
                [
                    'f1'   => 3,
                    'f2'   => 0,
                    'f3'   => 3,
                    'f4'   => 3,
                    'f5'   => 1,
                    'f6'   => 1,
                    'f7'   => 4,
                    'f8'   => 0,
                    'f9'   => 0,
                    'f10'  => 3,
                    'f11'  => 3,
                    'f12'  => 1,
                    'f13'  => 1,
                    'f14'  => 2,
                    'f15'  => 0,
                    'f16'  => 1,
                    'f17'  => 3,
                    'f18'  => 1,
                    'f22'  => 10,
                    'f22t' => 27,
                    'f24'  => 10,
                    'f24t' => 17,
                    'f26'  => 10,
                    'f26t' => 15,
                    'f27'  => 10,
                    'f27t' => 23,
                    'f28'  => 10,
                    'f28t' => 23,
                    'f30'  => 10,
                    'f30t' => 11,
                    'f31'  => 10,
                    'f31t' => 10,
                    'f39'  => 10,
                    'f39t' => 16,
                ]);
        } else if ($size == 2 || $size == 3) {
            $queryArr = array_merge($queryArr,
                [
                    'f1'   => 0,
                    'f2'   => 0,
                    'f3'   => 1,
                    'f4'   => 3,
                    'f5'   => 1,
                    'f6'   => 1, //
                    'f7'   => 3,
                    'f8'   => 0,
                    'f9'   => 0, //
                    'f10'  => 3,
                    'f11'  => 3,
                    'f12'  => 1,
                    'f13'  => 1, //
                    'f14'  => 2,
                    'f15'  => 0, //
                    'f16'  => 1, //
                    'f17'  => 3, //
                    'f18'  => 1, //
                    'f22'  => 20,
                    'f22t' => 27,
                    'f24'  => 10,
                    'f24t' => 17,
                    'f26'  => 10,
                    'f26t' => 15,
                    'f27'  => 10,
                    'f27t' => 23,
                    'f28'  => 10,
                    'f28t' => 23,
                    'f30'  => 10,
                    'f30t' => 11,
                    'f31'  => 10,
                    'f31t' => 10,
                    'f39'  => 10,
                    'f39t' => 16,
                ]);
        }
        $db = DB::getInstance();
        $db->query("INSERT INTO fdata (" . implode(",", array_keys($queryArr)) . ") VALUES (" . implode(",",
                array_values($queryArr)) . ")");
        $store = Formulas::storeCAP(10);
        $db->query("UPDATE vdata SET maxstore=$store, maxcrop=$store WHERE kid=$kid");
    }

    public function createWWVillage($kid)
    {
        $db = DB::getInstance();
        $name = T("Global", "wwName");
        $result = $this->_createVillage(1, 5, $kid, $name, 0, 0, true, false);
        if (!$result) return false;
        $this->addWWVillageFields($kid);
        $units = WonderOfTheWorldModel::getWWTroops(Formulas::isGrayArea($kid));
        $modify = [];
        for ($i = 1; $i <= 10; ++$i) {
            $modify[] = "u{$i}=" . $units[$i];
        }
        $db->query("UPDATE units SET " . implode(",", $modify) . " WHERE kid=$kid");
        $calculatedCPPOP = VillageModel::calculateVillageCulturePointsAndPopulation($kid, true);
        $this->setVillageCPPOP($kid, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $this->increaseUserPopCP(1, $calculatedCPPOP['pop'], $calculatedCPPOP['cp']);
        $store = Formulas::storeCAP(20) + Formulas::storeCAP(10);
        $db->query("UPDATE vdata SET maxstore=$store, maxcrop=$store WHERE kid=$kid");
        ResourcesHelper::updateVillageResources($kid, false);
        return $result;
    }

    public function findInPolarSystem($plus, $area = 'ne', $nonNatar = TRUE)
    {
        switch ($area) {
            case 'ne':
                $angle = mt_rand(0, 90);
                break;
            case 'se':
                $angle = mt_rand(270, 360);
                break;
            case 'nw':
                $angle = mt_rand(90, 180);
                break;
            case 'sw':
                $angle = mt_rand(180, 270);
                break;
            default:
                $angle = mt_rand(0, 360);//all around break;
        }
        $radius = ((time() - Config::getInstance()->game->start_time) / 86400) + $plus;
        if ($nonNatar) {
            if ($radius < 22) {
                $radius += 22;
            }
        } else {
            $radius = mt_rand(1, 375);
        }
        if ($radius > 375) {
            $radius = 375;
        }
        $radians = deg2rad($angle);
        $x = round($radius * cos($radians));
        $y = round($radius * sin($radians));

        return ['x' => $x, 'y' => $y];
    }

    public function generateNatarsVillage($count = 1, $distance = 9000)
    {
        $db = DB::getInstance();
        $result = $db->fetchScalar("SELECT GROUP_CONCAT(kid) FROM (SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype>0 AND r <= $distance ORDER BY rand ASC, r ASC LIMIT $count) as x");
        return rtrim($result, ',');
    }

    public function generateNatarsVillageInSide($sector, $count = 1, $distance = 9000)
    {
        switch ($sector) {
            case 'ne':
            case 'no':
                $angle = [0, 90];
                break;
            case 'se':
            case 'so':
                $angle = [270, 360];
                break;
            case 'nw':
                $angle = [90, 180];
                break;
            case 'sw':
                $angle = [180, 270];
                break;
            default:
                $angle = [0, 360];
                break;
        }
        $db = DB::getInstance();
        $result = $db->fetchScalar("SELECT GROUP_CONCAT(kid) FROM (SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype>0 AND (angle BETWEEN {$angle[0]} AND $angle[1]) AND r > 15 AND r <= $distance ORDER BY rand ASC LIMIT $count) as villages");
        return rtrim($result, ',');

    }

    public function generateWWNatarsVillage()
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT kid FROM available_villages WHERE occupied=0 AND fieldtype=3 ORDER BY rand ASC, r ASC LIMIT 1");
    }
}