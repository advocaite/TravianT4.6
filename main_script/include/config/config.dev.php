<?php
global $globalConfig;
global $config;
$config->game->speed = 50;
//custom
$config->custom->serverIsFreeGold = true;
////timers
$config->fakeUsersCount = 0;
$config->timers->ArtifactsReleaseTime = 600;
$config->timers->wwPlansReleaseTime = 900;
$config->timers->WWConstructStartTime = 0;
$config->timers->WWUpLvlInterval = 60;
$config->timers->AutoFinishTime = 0;
$config->custom->delayAuctions = false;

$config->extraSettings->generalOptions->buyAdventure->enabled = true;

//$config->extraSettings->buyResources['enabled'] = true;
//$config->extraSettings->buyAnimal['enabled'] = true;
//$config->extraSettings->buyTroops['enabled'] = true;
//$config->custom->protectFarmsTill = 0;
//$config->bonus->top10->topAttacker = (object) [
//    'enabled' => true,
//    'ranks' => [
//        1 => 100,
//        2 => 75,
//        3 => 50
//    ],
//];
//
//$config->bonus->top10->topDefender = (object) [
//    'enabled' => true,
//    'ranks' => [
//        1 => 100,
//        2 => 75,
//        3 => 50
//    ],
//];
//
//$config->bonus->top10->topClimber = (object) [
//    'enabled' => true,
//    'ranks' => [
//        1 => 100,
//        2 => 75,
//        3 => 50,
//        4 => 20,
//    ],
//];
//
//$config->bonus->top10->topRaider = (object) [
//    'enabled' => true,
//    'ranks' => [
//        1 => 100,
//        2 => 75,
//        3 => 50
//    ],
//];
//$config->extraSettings->upgradeToMaxLevel->enabled = true;
//$config->extraSettings->upgradeStorageToMaxLevel->enabled = true;
//$config->timers->ArtifactsReleaseTime -= 4 * 3600;
//$config->game->ignoreMoralPointsInAttacks = false;
//
//$config->game->disallowAllianceInviteAfterWWRelease = false;
//$config->game->disallowAllianceKickAfterWWRelease = false;
