<?php
global $config, $globalConfig;
if($config->game->speed <= 50){
    $x = $config->game->round_length / (200 / 350);
} else {
    $x = $config->game->round_length;
}
$rate_1 = 100 / 350 * $x * 86400;
$rate_2 = 200 / 350 * $x * 86400;
$rate_3 = 250 / 350 * $x * 86400;

$config->timers->ArtifactsReleaseTime = $config->game->start_time + ceil($rate_1);
$config->timers->wwPlansReleaseTime = $config->game->start_time + ceil($rate_2);
$config->timers->WWConstructStartTime = $config->game->start_time + ceil($rate_3);
$config->timers->WWUpLvlInterval = max(ceil(86400 / $config->game->speed), 600);
$config->timers->AutoFinishTime = ceil($config->timers->WWConstructStartTime + 100 * $config->timers->WWUpLvlInterval);
$config->timers->ArtifactsReleaseTime = handleBadHourReleaseTime($config->timers->ArtifactsReleaseTime);