<?php
global $globalConfig;
global $config;
$config->game->vacationDays = 0;
$config->display->showFarmsInStatistics = true;
$config->display->showCopyright = true;
$config->display->showOnlinePlayers = false;
$config->display->includeHiddenMedals = true;
$config->display->useYooreshMedals = true;
$config->display->smallResourcesFontSize = $config->display->smallTroopsNumFontSize = $config->game->speed > 20;
$config->custom->usePopulationAsClimbersRank = true;
$config->farms->smallFarmsCount = 75;
$config->farms->bigFarmsCount = 25;
$config->game->usePeriodicTradeRoutes = true;
$config->game->allowDemolishNowInWW = true;
$config->game->maxTrapperCount = 2;
$config->display->dontShowLinkListBeforeTutorial = false;
$config->custom->allowOneFarmListPerAccount = $config->custom->allowOneFarmListPerVillage = true;
$config->game->firstVillageCreationFieldsLevel = 5;
$config->game->otherVillageCreationFieldsLevel = 3;
$config->custom->allowEvasionForAllVillages = true;
$config->custom->allowOnlyOneWWVillagePerAccount = true;
$config->game->changeCapitalOnZeroPop = false;
$config->custom->removeReports = 1 * 86400;
$config->custom->activationReminderInterval = 3 * 3600;
$config->custom->activationProgressReminderInterval = 3 * 3600;
$config->custom->reduceCataSpeedInAttacks = true;
$config->custom->makeAuctionsCheaperInSell = true;
$config->custom->needAllianceWWPlan = false;
$config->fakeUsersCount = mt_rand(40, 100);
$config->game->deletionTime = 3600 * 1;

{
    if ($config->game->speed >= 5000) {
        $config->game->dailyQuestInterval = 6 * 3600;
    } else {
        $config->game->dailyQuestInterval = 12 * 3600;
    }
    if ($config->game->speed <= 10000) {
        $config->game->storage_multiplier = max(ceil($config->game->speed / 2), 1);
    } else {
        $config->game->storage_multiplier = max(ceil($config->game->speed / 5), 1);
    }
    $config->game->cage_multiplier = max(ceil($config->game->speed / 4), 1);
    $config->game->trap_multiplier = max(ceil($config->game->speed / 4), 1);
    $config->game->cranny_multiplier = max(ceil($config->game->speed / 8), 1);
    if ($config->game->speed <= 250) {
        $config->game->movement_speed_increase = max(round($config->game->speed / 5), 1);
    } else {
        $config->game->movement_speed_increase = min(max(round5($config->game->speed * 8 / 100), 1), 3000);
    }
    if ($config->game->speed <= 100) {
        $config->game->protection_time = 72 * 3600;
    } else if ($config->game->speed <= 500) {
        $config->game->protection_time = 24 * 3600;
    } else if ($config->game->speed <= 1000) {
        $config->game->protection_time = 16 * 3600;
    } else if ($config->game->speed <= 2000) {
        $config->game->protection_time = 8 * 3600;
    } else {
        $config->game->protection_time = 3 * 3600;
    }
}
{
    $config->extraSettings->addFarms->enabled = true;
    $config->extraSettings->generalOptions->increaseStorage->enabled = true;
    $config->extraSettings->generalOptions->finishTraining->enabled = true;
    $config->extraSettings->generalOptions->fasterTraining->enabled = true;
    $config->extraSettings->generalOptions->smithyUpgradeAllToMax->enabled = true;
    $config->extraSettings->generalOptions->academyResearchAll->enabled = true;
    $config->extraSettings->generalOptions->buyAdventure->enabled = true;
    {
        $moreProtectionStatus = !$config->dynamic->WWPlansReleased;
        foreach ($config->extraSettings->moreProtection->packages as &$pack) {
            $pack['enabled'] = $moreProtectionStatus;
        }
        $config->custom->removeProtectionAfterReleaseOfWWPlans = true;
    }
    {
        $config->extraSettings->power->atkBonus->enabled = false;
        $config->extraSettings->power->atkBonus->coins = 10;
        $config->extraSettings->power->atkBonus->duration = 1;
    }
    {
        $config->extraSettings->power->defBonus->enabled = false;
        $config->extraSettings->power->defBonus->coins = 10;
        $config->extraSettings->power->defBonus->duration = 1;
    }
    { //Change name
        $config->gold->changeName->freeTillPopulation = $config->gold->changeName->freeTimes = 0;
        $config->gold->changeName->impossibleAfterPopulation = 15000;
        $config->gold->accountChangeNameGold = 100;
    }
    {
        $config->Voting->TopG->link = 'http://topg.org/   ';
        $config->Voting->GTop100->link = 'https://gtop100.com/';
        $config->Voting->ArenaTop100->link = 'https://www.arena-top100.com/';
    }
}
//gold config
$config->gold->dailyGold = $config->gold->startGold = 50;
$config->gold->voucherExpireDays = 25;
$config->gold->plusGold = 25;
$config->gold->plusAccountDurationSeconds = 3*3600;
$config->gold->productionBoostGold = 15;
$config->gold->productionBoostDurationSeconds = 3*3600;
$config->gold->goldClubGold = 250;
$config->gold->exchangeResourcesGold = 3;
$config->gold->finishNowGold = 2;
$config->gold->completeDemolishGold = 10;

//bonus config
$config->bonus->bonusGoldWinner = 500;
$config->bonus->bonusGoldSecondWinner = 200;
$config->bonus->bonusGoldThirdWinner = 120;
$config->bonus->bonusGoldTopAlliance = 100;
$config->bonus->bonusGoldTopOff = 150;
$config->bonus->bonusGoldTopDef = 150;
$config->bonus->bonusGoldTopOffHammer = 150;
$config->bonus->bonusGoldTopDefHammer = 150;
$config->bonus->bonusGoldTopClimber = 0;
$config->bonus->bonusGoldTopAllianceCount = 5;

{
//these are for 5000x servers and will be multiplied for other speeds
    $config->extraSettings->buyBuildings['enabled'] = true;    
    
    $config->extraSettings->smithyMaxLevel->enabled = true;
    $config->extraSettings->upgradeToMaxLevel->enabled = true;
    $config->extraSettings->upgradeStorageToMaxLevel->enabled = true;


	$config->extraSettings->buyBuildings['packages']['upgradeAllResourcesTo5']->enabled = true;
    if ($config->game->speed > 300) {
		$config->extraSettings->buyBuildings['packages']['upgradeAllResourcesTo20']->enabled = true;
    }
    if ($config->game->speed > 500) {
		$config->extraSettings->buyBuildings['packages']['upgradeAllResourcesTo30']->enabled = true;
    }

    $config->extraSettings->buyResources['enabled'] = true;
    $config->extraSettings->buyAnimal['enabled'] = true;
}
if ($config->game->speed <= 1000) {
    $config->extraSettings->buyResources['enabled'] = false;
    $config->extraSettings->buyAnimal['enabled'] = false;
}
if ($config->game->speed > 500) {
    $config->game->ignoreMoralPointsInAttacks = true;
}
$config->bonus->top10->topAttacker = (object) [
    'enabled' => true,
    'ranks' => [
        1 => 75,
        2 => 50,
        3 => 30,
    ],
];

$config->bonus->top10->topDefender = (object) [
    'enabled' => true,
    'ranks' => [
        1 => 75,
        2 => 50,
        3 => 30,
    ],
];

$config->bonus->top10->topClimber = (object) [
    'enabled' => true,
    'ranks' => [
        1 => 75,
        2 => 50,
        3 => 30,
    ],
];

$config->bonus->top10->topRaider = (object) [
    'enabled' => true,
    'ranks' => [
        1 => 75,
        2 => 50,
        3 => 30,
    ],
];
$config->gold->invitePlayerGold = 0;
