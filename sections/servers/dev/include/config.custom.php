<?php
global $globalConfig, $config;
$config->gold->startGold = 0;
$config->extraSettings->buyTroops['enabled'] = true;
$config->extraSettings->buyAnimal['enabled'] = true;
$config->extraSettings->buyResources['enabled'] = true;
$config->extraSettings->buyTroops['buyInterval'] = 0;
$config->extraSettings->buyResources['buyInterval'] = 0;
$config->extraSettings->buyAnimal['buyInterval'] = 0;
$config->display->showPlusSupportTab = true;
$config->display->showVouchersTab = true;


$config->game->protection_time = 1 * 3600;
$config->extraSettings->generalOptions->finishTraining->enabled = true;
$config->extraSettings->generalOptions->buyAdventure->enabled = true;