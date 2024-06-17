<?php

namespace Model\Movements;

use Core\Config;
use Core\Database\DB;
use Core\ErrorHandler;
use Core\Helper\WebService;
use Game\Buildings\BuildingAction;
use Game\Formulas;
use Game\Helpers\CulturePointsHelper;
use Game\NoticeHelper;
use Game\SpeedCalculator;
use Model\AllianceModel;
use Model\ArtefactsModel;
use Model\AutomationModel;
use Model\BattleModel;
use Model\MovementsModel;
use Model\NatarsModel;
use Model\RegisterModel;
use Model\SummaryModel;
use function serialize;

class SettlersProcessor
{
    public function __construct($row)
    {
        $row['start_time_seconds'] = ceil($row['start_time'] / 1000);
        $row['end_time_seconds'] = ceil($row['end_time'] / 1000);

        $db = DB::getInstance();
        $wdata = $db->query("SELECT occupied, fieldtype FROM wdata WHERE id={$row['to_kid']}")->fetch_assoc();
        $owner = $db->fetchScalar("SELECT owner FROM vdata WHERE kid={$row['kid']}");
        if ($owner === false) {
            return;
        }
        if ($wdata['occupied']) {
            $this->returnSettlers($row, $owner);
            return;
        }
        $race = $db->fetchScalar("SELECT race FROM users WHERE id=$owner");
        if ($race === false) {
            return;
        }
        $exists = $db->fetchScalar("SELECT COUNT(kid) FROM vdata WHERE kid={$row['to_kid']}") >= 1;
        if ($exists) {
            $this->returnSettlers($row, $owner);
            return;
        }
        //maybe they're killed on the way.
        if ($row['u10'] < 3) {
            $this->returnSettlers($row, $owner);
            return;
        }
        CulturePointsHelper::updateUserCP($owner);
        list($cp, $total_villages, $aid, $name) = $db->query("SELECT cp, total_villages, aid, name FROM users WHERE id=$owner")->fetch_row();
        if ($cp < Formulas::newVillageCP($total_villages + 1)) {
            $this->returnSettlers($row, $owner);
            return;
        }
        $register = new RegisterModel();
        $register->createNewVillage($owner, $race, $row['to_kid'], $row['kid']);

        (new SummaryModel())->setFirstVillageUser($name);

        $xy = Formulas::kid2xy($row['to_kid']);
        NoticeHelper::addSurrounding($xy['x'],
            $xy['y'],
            NoticeHelper::SURROUNDING_VILLAGE_FOUND,
            [
                $owner,
                $db->fetchScalar("SELECT name FROM users WHERE id=$owner"),
                $row['to_kid'],
            ],
            $row['end_time_seconds']);
        if ($aid) {
            (new AllianceModel())->addLog($aid,
                [AllianceModel::LOG_NEW_VILLAGE, $owner, $name],
                $row['end_time_seconds']);
        }
        NoticeHelper::addNotice($aid,
            $owner,
            $row['kid'],
            $row['to_kid'],
            NoticeHelper::TYPE_NEW_VILLAGE,
            null,
            ['kid' => $row['kid']],
            $row['end_time_seconds']);
    }

    private function returnSettlers($row, $owner)
    {
        $calc = new SpeedCalculator();
        $calc->setFrom($row['to_kid']);
        $calc->setTo($row['kid']);
        $calc->isReturn();
        $calc->setMinSpeed(Formulas::uSpeed(nrToUnitId(10, $row['race'])));
        $db = DB::getInstance();
        $buildings = $db->query("SELECT * FROM fdata WHERE kid={$row['kid']}")->fetch_assoc();
        for ($i = 18; $i <= 38; ++$i) {
            if ($buildings['f' . $i . 't'] == 14) {
                $calc->setTournamentSqLvl($buildings['f' . $i]);
                break;
            }
        }
        $calc->setArtefactEffect(ArtefactsModel::getArtifactEffectByType($owner, $row['to_kid'], ArtefactsModel::ARTIFACT_INCREASE_SPEED));
        $units = array_fill(1, 11, 0);
        $units[10] = 3;
        $move = new MovementsModel();
        $move->addMovement($row['to_kid'], $row['kid'], $row['race'], $units, 0, 0, 0, 0, 1, $row['attack_type'], $row['end_time'], $row['end_time'] + 1000 * $calc->calc());
        $db->query("UPDATE vdata SET wood=wood+750, clay=clay+750, iron=iron+750, crop=crop+750 WHERE kid={$row['kid']}");
    }
}