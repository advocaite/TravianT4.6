<?php
global $globalConfig;
global $config;
function handleBadHourReleaseTime($releaseTime, $badHours = [23, 00, 1, 2, 3, 4, 5, 6, 7, 8])
{
    $good = array_values(array_diff(range(0, 23), $badHours));
    $releaseHour = date("H", $releaseTime);
    if (in_array($releaseHour, $badHours)) {
        //it's a bad hour (we need to find first good hour after that
        if (in_array($releaseHour, [23, 00])) {
            $hour = $good[sizeof($good) - 1]; // last hour
            $releaseTime -= (($releaseHour == 00 ? 24 : $releaseHour) - $hour) * 3600;
        } else {
            $hour = $good[0]; // first hour after that time
            $releaseTime += ($hour - $releaseHour) * 3600;
        }
    }
    return $releaseTime;
}

if ($config->game->speed <= 20 || $config->game->round_length == 'auto') {
    require_once __DIR__ . "/timers/official.php";
} else {
    if($config->game->speed > 500){
        require_once __DIR__ . "/timers/unofficial_method_2.php";
    } else {
        require_once __DIR__ . "/timers/official.php";
    }
}
$config->game->round_length_real = ceil(($config->timers->wwPlansReleaseTime - $config->game->start_time) / 86400);
$config->heroConfig->resourcesMultiplier = getGameSpeed();
if (strpos($globalConfig['staticParameters']['indexUrl'], "example.com") !== false) {
    require __DIR__ . "/config.username.php";
} else {
    die("No valid configuration found.");
}
$customConfigFile = dirname(GLOBAL_CONFIG_FILE) . "/config.custom.php";
if (is_file($customConfigFile)) {
    require $customConfigFile;
}
$config->heroConfig->heroItemsSettings->heroArtWorkRate = $config->game->speed >= 3 ? 2 : 1;
$config->game->useMilSeconds = $config->game->speed > 20;
$config->game->useNanoseconds = $config->game->speed > 20000;
$config->heroConfig->heroItemsSettings->heroIncreaseSpeed = $config->game->movement_speed_increase;
$config->heroConfig->waterBucketsPerDay = $config->game->movement_speed_increase;
if ($config->timers->AutoFinishTime == 0) {
    $config->game->round_length = ($config->timers->wwPlansReleaseTime - $config->game->start_time) / 86400;
} else {
    $config->game->round_length = ($config->timers->AutoFinishTime - $config->game->start_time) / 86400;
}

if ($config->game->speed <= 20) {
    $config->game->round_length = round(350 / $config->game->speed);
}
if ($config->game->speed > 20) {
    $config->game->auction_package_multiplier *= min(ceil($config->game->speed / 100), 1000);
}
$config->auction->auctionTime = ceil(max(1, 24 / $config->game->speed)) * 3600;
function multiply_for_other_servers()
{
    global $config;
    if (property_exists($config->settings, 'multiplyCalled')) {
        return;
    }
    /*if ($config->game->speed <> 5000) {
        multiply_packages(getGameSpeed() / 5000);
    }*/
}

if (property_exists($config->dynamic, 'delayTime')) {
    $config->timers->ArtifactsReleaseTime += $config->dynamic->delayTime;
    $config->timers->wwPlansReleaseTime += $config->dynamic->delayTime;
    if ($config->timers->WWConstructStartTime > 0) {
        $config->timers->WWConstructStartTime += $config->dynamic->delayTime;
        $config->timers->AutoFinishTime += $config->dynamic->delayTime;
    }
}
if (in_array($config->settings->worldId, ['dev'])) {
    require __DIR__ . "/config.dev.php";
}
if (defined("CONFIG_CUSTOM_FILE") && is_file(CONFIG_CUSTOM_FILE)) {
    require(CONFIG_CUSTOM_FILE);
}
$config->timers->ArtifactsReleaseTime = max($config->timers->ArtifactsReleaseTime, $config->dynamic->installationTime + 60);
$config->timers->wwPlansReleaseTime = max($config->timers->wwPlansReleaseTime, $config->dynamic->installationTime + 300);
multiply_for_other_servers();

if (function_exists('set_config_after')) {
    set_config_after();
}
