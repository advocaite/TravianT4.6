<?php

namespace Model\Movements;

use Core\Database\DB;
use Game\Formulas;
use Game\Hero\HeroHelper;
use Game\NoticeHelper;
use Game\ResourcesHelper;
use Game\SpeedCalculator;
use Model\AutomationModel;
use Model\ArtefactsModel;
use Model\MovementsModel;
use Model\MultiAccount;
use Model\OasesModel;
use Model\VillageModel;

class ReinforcementProcessor
{
    public function __construct($row)
    {
        $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
        $row['end_time_seconds'] = ceil($row['end_time'] / 1000);

        $m = new AutomationModel();
        $db = DB::getInstance();
        if (!$this->getVillageState($row['to_kid'])) {
            if ($row['race'] <> 5) {
                $this->returnTroops($row);
            }
            return true;
        }
        $oasesModel = new OasesModel();
        $isOasis = $oasesModel->isOasis($row['to_kid']);
        $redeployHero = false;
        $uid = $row['race'] == 4 ? 0 : $m->getVillage($row['kid'], 'owner')['owner'];
        $to_uid = ($isOasis ? $db->query("SELECT owner FROM odata WHERE kid={$row['to_kid']}")->fetch_assoc() : $m->getVillage($row['to_kid'], 'owner'));
        $to_uid = $to_uid['owner'];
        if ($to_uid == 1) {
            return $this->returnTroops($row);
        } else if ($to_uid <= 10) {
            if ($m->getUser($to_uid, "hidden")['hidden'] == 1) {
                return $this->returnTroops($row);
            }
        }
        if ($uid <> $to_uid) {
            MultiAccount::addMultiAccountLog($uid, $to_uid, 2);
        }
        if ($row['redeployHero'] && !$isOasis) {
            $redeployHero = $row['u11'] > 0 && (int)$uid === (int)$to_uid && $this->getRallyPoint($row['to_kid']) > 0;
        }
        $sum = 0;
        for ($i = 1; $i <= 11; ++$i) {
            $num = $row['u' . $i];
            if ($i == 11 && $redeployHero) {
                $num = 0;
            }
            $sum += $num;
        }
        if ($sum) {
            $move = new MovementsModel();
            $enforceId = false;
            if (!$isOasis && $row['race'] == 4) {
                //Oasis troops coming!
                $stmt = $db->query("SELECT e.id FROM enforcement e WHERE e.race=4 AND e.to_kid={$row['to_kid']} LIMIT 1");
                if ($stmt->num_rows) {
                    $enforceId = $stmt->fetch_row()[0];
                }
            }
            if ($enforceId || $enforceId = $move->isSameVillageReinforcementExists($row['kid'], $row['to_kid'])) {
                //other reinforce exists.
                //modify it.
                $modify = [];
                for ($i = 1; $i <= 10; ++$i) {
                    if ($row['u' . $i]) {
                        $modify[] = "u{$i}=u{$i}+" . $row['u' . $i];
                    }
                }
                if (!$redeployHero && $row['u11']) {
                    $modify[] = 'u11=u11+' . $row['u11'];
                }
                if (sizeof($modify)) {
                    $db->query("UPDATE enforcement SET " . implode(",", $modify) . " WHERE id=$enforceId");
                }
            } else {
                if (!$uid) {
                    $uid = 0;
                }
                $units = [];
                for ($i = 1; $i <= 11; ++$i) {
                    $units[$i] = $row['u' . $i];
                    if ($i == 11 && $redeployHero) {
                        $units[$i] = 0;
                    }
                }
                $move->addEnforce($uid, $row['kid'], $row['to_kid'], $row['race'], $units);
            }
        }
        if ($redeployHero) {
            $db->query("UPDATE hero SET kid={$row['to_kid']} WHERE uid={$uid}");
            $db->query("UPDATE units SET u11=1 WHERE kid={$row['to_kid']}");
            ResourcesHelper::updateVillageResources($row['kid'], false);
            ResourcesHelper::updateVillageResources($row['to_kid'], false);
        }
        //add report here.
        $reportType = NoticeHelper::TYPE_REINFORCEMENT;
        $consumption = 0;
        $units = [];
        for ($i = 1; $i <= 11; ++$i) {
            $units[$i] = $row['u' . $i];
            $consumption += $units[$i] * Formulas::uUpkeep(nrToUnitId($i, $row['race']));
            //here consumption doesn't include effect of artefact or horse drinking pool
        }
        if ($row['race'] != 4) {
            // Updating upkeep for receiver
            {
                $targetKid = $isOasis ? $oasesModel->getOasisCaptureKid($row['to_kid']) : $row['to_kid'];
                $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($targetKid, $row['race']));
                ResourcesHelper::modifyUpkeep($to_uid, $targetKid, $upkeep);
            }
            $upkeep = ResourcesHelper::getTotalCropConsumption($row['race'], $units, VillageModel::getHDP($row['kid'], $row['race']));
            ResourcesHelper::modifyUpkeep($uid, $row['kid'], $upkeep, 1);
        }

        $report = [
            'sender' => [
                'uid' => $uid,
                'kid' => $row['kid'],
                'uname' => $uid == 0 ? '' : $db->fetchScalar("SELECT name FROM users WHERE id=$uid"),
            ],
            'receiver' => [
                'uid' => $to_uid,
                'kid' => $row['to_kid'],
                'uname' => $to_uid ? $db->fetchScalar("SELECT name FROM users WHERE id=$to_uid LIMIT 1") : '',
            ],
            'units' => ['race' => $row['race'], 'num' => $units],
            'consumption' => $consumption,
            'timeTaken' => $row['end_time_seconds'] - $row['start_time_seconds'],
        ];
        NoticeHelper::addNotice(0, $uid, $row['kid'], $row['to_kid'], $reportType, null, $report, $row['end_time_seconds']);
        if ($uid <> $to_uid) {
            NoticeHelper::addNotice(0, $to_uid, $row['kid'], $row['to_kid'], $reportType, null, $report, $row['end_time_seconds']);
        }
        return true;
    }

    private function getVillageState($kid)
    {
        $db = DB::getInstance();
        $status = $db->query("SELECT fieldtype, oasistype, landscape, occupied FROM wdata WHERE id={$kid}");
        if (!$status->num_rows) {
            return false;
        }
        $status = $status->fetch_assoc();
        if ($status['occupied']) {
            return true;
        }
        return false;
    }

    private function returnTroops($row)
    {
        $db = DB::getInstance();
        $calculator = new SpeedCalculator();
        $calculator->setFrom($row['to_kid']);
        $calculator->setTo($row['kid']);
        $calculator->isReturn();
        $calculator->hasCata($row['u8'] > 0);
        $speeds = [];
        $units_id = [];
        $units = array_fill(1, 11, 0);
        for ($i = 1; $i <= 11; ++$i) {
            if (!$row['u' . $i]) {
                continue;
            }
            $units[$i] = $row['u' . $i];
            if ($i == 11) {
                continue;
            }
            $speeds[] = Formulas::uSpeed(nrToUnitId($i, $row['race']));
            $units_id[] = (nrToUnitId($i, $row['race']));
        }
        if ($row['u11']) {
            $calculator->hasHero();
            $heroHelper = new HeroHelper();
            $uid = $db->query("SELECT owner FROM vdata WHERE kid={$row['kid']}")->fetch_assoc()['owner'];
            $inventory = $db->query("SELECT * FROM inventory WHERE uid={$uid}")->fetch_assoc();
            $calculator->setLeftHand($inventory['leftHand']);
            $calculator->setShoes($inventory['shoes']);
            $speeds[] = $heroHelper->calcTotalSpeed($row['race'],
                $inventory['horse'],
                $inventory['shoes']);

            if (array_sum($units) > 1) {
                $calculator->troopsWithHero();
            }
        }
        $calculator->setMinSpeed(min($speeds));
        $calculator->setTournamentSqLvl($this->getTournamentSqLvl($row['kid']));
        $uid = $db->query("SELECT owner FROM vdata WHERE kid={$row['kid']}")->fetch_assoc()['owner'];
        $arts = new ArtefactsModel();
        $calculator->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($uid, $row['kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $move = new MovementsModel();
        $move->addMovement($row['to_kid'],
            $row['kid'],
            $row['race'],
            $units,
            0,
            0,
            0,
            0,
            1,
            $row['attack_type'],
            $row['end_time'],
            $row['end_time'] + 1000 * $calculator->calc());
        return true;
    }

    private function getTournamentSqLvl($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT f18t, f19, f19t, f20, f20t, f21, f21t, f22, f22t, f23, f23t, f24, f24t, f25, f25t, f26, f26t, f27, f27t, f28, f28t, f29, f29t, f30, f30t, f31, f31t, f32, f32t, f33, f33t, f34, f34t, f35, f35t, f36, f36t, f37, f37t, f38, f38t FROM fdata WHERE kid=$kid")->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 14) {
                return $buildings['f' . $i];
                break;
            }
        }

        return 0;
    }

    private function getRallyPoint($kid)
    {
        $db = DB::getInstance();
        $buildings = $db->query("SELECT f39, f39t FROM fdata WHERE kid=$kid")->fetch_assoc();
        if ($buildings['f39'] > 0) {
            return $buildings['f39'];
        }

        return 0;
    }
}