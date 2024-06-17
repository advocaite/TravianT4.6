<?php

namespace Controller\Ajax;

use Core\Config;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Game\GoldHelper;
use Model\AllianceBonusModel;
use Model\DailyQuestModel;
use resources\View\PHPBatchView;
use function array_key_exists;
use function array_keys;

class donateResources extends AjaxBase
{
    private $types = [
        'TroopProductionSpeed' => AllianceBonusModel::TYPE_TRAINING,
        'CPProduction' => AllianceBonusModel::TYPE_CP,
        'SmithyPower' => AllianceBonusModel::TYPE_ARMOR,
        'MerchantCapacity' => AllianceBonusModel::TYPE_TRADE,
    ];

    public function dispatch()
    {
        if (!Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_CONTRIBUTE_ALLIANCE)) {
            return;
        }
        $this->response['data'] = [
            'html' => '',
            'responseText' => '',
            'success' => false,
            'reload' => false,
            'newTotal' => 0,
            'limitReached' => false,
            'goldChanged' => false,
            'resourcesChanged' => false,
            'limit' => 0,
        ];
        if (!isset($_POST['params']) || !is_array($_POST['params'])){
            $this->setError('Invalid Params.');
            return;
        }
        $params = (array)$_POST['params'];
        if ($params['did'] != Village::getInstance()->getKid()) {
            $this->setError(T("AllianceBonus", "Your active village was changed"));
            return;
        }
        if (!array_key_exists('bid', $params) || !in_array($params['bid'], array_keys($this->types))) return;
        if ($_POST['action'] == 'donate_gold' || $_POST['action'] == 'donate_gold_confirm') {
            $this->handleGoldenDonate($params, $_POST['action'] == 'donate_gold_confirm');
            return;
        } else if ($_POST['action'] == 'donate_green') {
            $this->donate($params);
            return;
        }
        $this->setError('Nothing to do.');
        return;
    }

    private function setError($error)
    {
        $prefix = T("AllianceBonus", "Contribution failed:") . ' ';
        $this->response['error'] = true;
        $this->response['data']['responseText'] = $this->response['errorMsg'] = $prefix . $error;
    }

    private function handleGoldenDonate($params, $confirm)
    {
        if ($confirm) {
            $this->donate($params, true);
            return;
        }
        $session = Session::getInstance();
        $m = new AllianceBonusModel();
        $limitPerDay = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
        $bonus = $m->getAllianceBonusTypeParams($session->getAllianceId(), $this->types[$params['bid']]);
        $maximumDonation = min(
            $limitPerDay - $session->getAllianceContribution(),
            Formulas::getAllianceBonusContributesNeededForLevel($bonus['level'] + 1) - $bonus['contributions']
        );
        $maximumDonation = floor($maximumDonation / 3);
        $resources = $this->getNewResourcesBasedOnLimit($maximumDonation, [
            abs((int)$params['r1']),
            abs((int)$params['r2']),
            abs((int)$params['r3']),
            abs((int)$params['r4']),
        ]);
        $view = new PHPBatchView("alliance/bonuses/donateWithGold");
        $view->vars['goldIsAvailable'] = $session->getAvailableGold() >= Config::getProperty("gold", "allianceBonus3xGold");
        $view->vars['resources'] = $resources;
        $this->response['data'] = [
            'html' => $view->output(),
            'responseText' => '',
            'success' => false,
            'reload' => false,
            'newTotal' => $session->getAllianceContribution(),
            'limitReached' => false,
            'goldChanged' => false,
            'resourcesChanged' => false,
            'limit' => $limitPerDay,
        ];;
    }

    private function donate($params, $golden = false)
    {
        $config = Config::getInstance();
        $session = Session::getInstance();
        $m = new AllianceBonusModel();
        if ($m->isUnlockingNextLevel($session->getAllianceId(), $this->types[$params['bid']])) {
            $this->setError(T("AllianceBonus", "You can`t contribute when next level is unlocking"));
            return;
        }
        $goldNeeded = $config->gold->allianceBonus3xGold;
        $limitPerDay = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
        $bonus = $m->getAllianceBonusTypeParams($session->getAllianceId(), $this->types[$params['bid']]);
        if ($bonus['level'] >= 5) {
            $this->setError('Max level reached.');
            return;
        }
        $maximumDonation = min(
            $limitPerDay - $session->getAllianceContribution(),
            Formulas::getAllianceBonusContributesNeededForLevel($bonus['level'] + 1) - $bonus['contributions']
        );
        if($golden){
            $maximumDonation = floor($maximumDonation / 3);
        }
        $resources = $this->getNewResourcesBasedOnLimit($maximumDonation, [
            abs((int)$params['r1']),
            abs((int)$params['r2']),
            abs((int)$params['r3']),
            abs((int)$params['r4']),
        ]);
        $contribution = ($golden ? 3 : 1) * array_sum($resources);
        if ($session->getAllianceContribution() >= $limitPerDay) {
            $this->setError(T("AllianceBonus", "Contribution limit for today is reached"));
            return;
        }
        if (array_sum($resources) == 0) {
            $this->setError(T("AllianceBonus", "Invalid resources entered"));
            return;
        }
        $village = Village::getInstance();
        if (!$village->isResourcesAvailable($resources)) {
            $this->setError(T("AllianceBonus", "Not enough are not available"));
            return;
        }
        if ($golden && $session->getAvailableGold() < $goldNeeded) {
            $this->setError(T("AllianceBonus", "The amount of gold could not be subtracted from your account"));
            return;
        }
        if (!$golden || GoldHelper::decreaseGold($session->getPlayerId(), $goldNeeded)) {
            if ($village->modifyResources($resources)) {
                $session->increaseAllianceContribution($contribution);
                $m->contribute(
                    $session->getAllianceId(),
                    $session->getPlayerId(),
                    $this->types[$params['bid']],
                    $contribution
                );
                $dailyQuest = new DailyQuestModel();
                $steps = min(3, floor($dailyQuest->getAllianceContribution($session->getPlayerId()) / DailyQuestModel::getAllianceContributionNeededForQuest()));
                $dailyQuest->setQuestAsStep($session->getPlayerId(), 11, $steps);
                $allianceBonusParams = $m->getAllianceBonusTypeParams($session->getAllianceId(), $this->types[$params['bid']]);
                if ($allianceBonusParams['level'] < Formulas::getAllianceBonusLevel($allianceBonusParams['contributions'])) {
                    $m->unlockNextLevel($session->getAllianceId(), $this->types[$params['bid']], $allianceBonusParams['level']);
                }
                $this->response['data']['success'] = true;
                $this->response['data']['reload'] = true;
                $this->response['data']['responseText'] = T("AllianceBonus", "Contribution successful");
                $this->response['data']['newTotal'] = $session->getAllianceContribution();
                $this->response['data']['limitReached'] = $session->getAllianceContribution();
                $this->response['data']['goldChanged'] = $golden;
                $this->response['data']['resourcesChanged'] = true;
                $this->response['data']['limit'] = Formulas::getAllianceBonusDonationLimit($m->getMaxAllianceBonusLevel($session->getAllianceId()));
                return;
            }
            $this->setError("Failed to modify resources");
            return;
        }
        $this->setError("Failed to contribute");
    }

    private function getNewResourcesBasedOnLimit($canContribute, array $resources)
    {
        $contribute_resources = [0, 0, 0, 0];
        $x = 0;
        $divFactor = 4;
        while ($canContribute > 0) {
            ++$x;
            $curTotalRes = 0;
            $div = floor($canContribute / $divFactor);
            for ($i = 0; $i <= 3; ++$i) {
                $resources[$i] = max($resources[$i], 0);
                $take = min($div, $resources[$i], $canContribute);
                $canContribute -= $take;
                $resources[$i] -= $take;
                $curTotalRes += $take;
                $contribute_resources[$i] += $take;
            }
            if ($curTotalRes <= 0 && $divFactor == 1) {
                break;
            }
            $divFactor = 1;
        }
        return $contribute_resources;
    }
}