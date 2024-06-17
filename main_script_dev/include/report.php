<?php
/**
 * Created by PhpStorm.
 * User: Amirhossein Matini
 * Date: 10/21/2018
 * Time: 13:31
 */
use Game\Formulas;
use Model\RegisterModel;

$overHead = isset($_GET['overHead']) ? (int)$_GET['overHead'] : 0;

$time = time() + $overHead;
$microtime = miliseconds() + $overHead * 1000;

$outGoingMovements = (int)$db->fetchScalar("SELECT COUNT(id) FROM movement WHERE mode=0 AND end_time < {$microtime}");
$inComingMovements = (int)$db->fetchScalar("SELECT COUNT(id) FROM movement WHERE mode=1 AND end_time < {$microtime}");

$buildingUpgrades = (int)$db->fetchScalar("SELECT COUNT(id) FROM building_upgrade WHERE isMaster=0 AND commence < $time");
$buildingMaster = (int)$db->fetchScalar("SELECT COUNT(id) FROM building_upgrade WHERE isMaster=1 AND commence < $time");
$buildingDemolish = (int)$db->fetchScalar("SELECT COUNT(id) FROM demolition WHERE end_time < $time");

$trainingQueue = (int)$db->fetchScalar("SELECT COUNT(id) FROM training WHERE commence < $time");
$pendingAuctions = (int)$db->fetchScalar("SELECT COUNT(id) FROM auction WHERE time < $time AND finish=0");

$pendingOasisDeletion = (int)$db->fetchScalar("SELECT COUNT(id) FROM odelete WHERE end_time < $time");
$pendingMarketTransfers = (int)$db->fetchScalar("SELECT COUNT(id) FROM send WHERE end_time < $time");

$pendingVotingRewardQueue = (int)$db->fetchScalar("SELECT COUNT(id) FROM voting_reward_queue");
$pendingAllianceUpgradeBonus = (int)$db->fetchScalar("SELECT COUNT(id) FROM alliance_bonus_upgrade_queue WHERE time < $time");
$tasks = [
    'movements'                   => [
        'outGoing' => $outGoingMovements,
        'inComing' => $inComingMovements,
    ],
    'buildings'                   => [
        'upgrades'    => $buildingUpgrades,
        'masterQueue' => $buildingMaster,
        'demolishes'  => $buildingDemolish,
    ],
    'mapMinDistance'              => Formulas::getMapMinDistanceFromCenter(),
    'trainingQueue'               => $trainingQueue,
    'pendingAuctions'             => $pendingAuctions,
    'pendingOasisDeletion'        => $pendingOasisDeletion,
    'pendingMarketTransfers'      => $pendingMarketTransfers,
    'pendingAllianceUpgradeBonus' => $pendingAllianceUpgradeBonus,
    'pendingVotingRewardQueue'    => $pendingVotingRewardQueue,
];

$data = [
    'tasks'    => $tasks,
    'load_avg' => implode(" | ", sys_getloadavg()),
];

header("Content-Type: application/json");
echo json_encode($data, JSON_PRETTY_PRINT);

