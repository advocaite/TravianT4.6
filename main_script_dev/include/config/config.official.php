<?php
$config->game->vacationDays = 21;
$config->display->showCountryFlagsInGeneralStatistics = false;
$config->game->dailyQuestInterval = 86400;
$config->gold->invitePlayerGold = 50;
$config->custom->removeReports = 7 * 86400;
$config->custom->removeReportsBelow30Percent = false;
$config->game->deletionTime = 86400 * 3;
$config->custom->batchCelebration = false;
$config->custom->decreaseItemsPriceInAuction = false;
$config->custom->useSessionCheckerInsteadOfDB = false;
$config->display->smallResourcesFontSize = false;
$config->display->smallTroopsNumFontSize = false;
$config->display->showBonusTabInStatistics = false;
$config->display->allowAutoReloadSettingChange = true;
$config->display->fastBuilder = false;
$config->display->farmListHelperIconActions = true;
$config->custom->allowResourcesToGoToMaximumPossible = true;
$config->game->storage_multiplier = 1;
$config->game->cage_multiplier = $config->game->trap_multiplier = 1;
$config->gold->plusGold = 10;
$config->gold->invitePlayerGold = 50;
$config->gold->accountChangeNameGold = 50;
$config->gold->productionBoostGold = 5;
$config->settings->advanced->mimMessagePop = 50;
$config->display->disableSeasons = true;
$config->custom->startMedalsAtStartOfWeek = true;
$config->game->medals_interval = 7 * 86400;
$config->display->allowWWUnusualRename = false;
$config->game->allowNewTribes = false;
$config->game->checkLastReturnForEvasion = true;
$config->custom->autoRaidEnabled = false;
$config->custom->allowVouchersOnlyOnSameEmail = false;
$config->custom->skipProtectionOnAttack = false;
$config->display->showCopyright = false;
$config->display->topHammers = false;
$config->heroConfig->allowHeroTrainingHelmetsInAllVillages = false;
$config->custom->delayAuctions = true;
$config->fakeUsersCountryCodes = ['IR'];
$config->gold->masterBuilderGold = 0;
$config->masterBuilder->maxTasksInNoneWonder = 3;
$config->masterBuilder->maxTasksInWonder = 0;
$config->game->usePeriodicTradeRoutes = true;
$config->game->starvation = true;
$config->fakeUsersCount = 0;

if ($config->game->speed == 1) {
    $config->gold->goldClubGold = 100;
    $config->gold->plusAccountDurationSeconds = 7 * 86400;
    $config->gold->productionBoostDurationSeconds = 7 * 86400;
} else {
    $config->gold->goldClubGold = 50;
    $config->gold->plusAccountDurationSeconds = 3 * 86400;
    $config->gold->productionBoostDurationSeconds = 3 * 86400;
}

if ($config->game->speed == 2) {
    $config->heroConfig->heroItemsSettings->heroExtraCulturePointsRate = 2 / 3;
} else if ($config->game->speed >= 3) {
    $config->heroConfig->heroItemsSettings->heroExtraCulturePointsRate = 1 / 2;
}

if($config->game->speed == 1){
    $config->game->movement_speed_increase = 1;
} else if($config->game->speed <= 5){
    $config->game->movement_speed_increase = 2;
} else if($config->game->speed <= 10){
    $config->game->movement_speed_increase = 4;
} else if($config->game->speed <= 20){
    $config->game->movement_speed_increase = 8;
}

$config->custom->removeVillageFromFarmListOnCapture = true;

if($config->game->speed == 1){
    $config->game->protection_time = 14 * 86400;
} else if($config->game->speed == 2){
    $config->game->protection_time = 10 * 86400;
} else if($config->game->speed == 3){
    $config->game->protection_time = 6 * 86400;
} else if($config->game->speed == 5){
    $config->game->protection_time = 4 * 86400;
} else if($config->game->speed == 10){
    $config->game->protection_time = 2 * 86400;
} else if($config->game->speed == 20){
    $config->game->protection_time = 1 * 86400;
}