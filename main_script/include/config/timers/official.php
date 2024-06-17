<?php
global $config, $globalConfig;
if($config->game->speed == 50){
    $config->timers->ArtifactsReleaseTime = $config->game->start_time + 7 * 86400;
    $config->timers->wwPlansReleaseTime = $config->game->start_time + 14 * 86400;
    $config->timers->WWConstructStartTime = $config->game->start_time + 18 * 86400;
    $config->timers->WWUpLvlInterval = 2592;
    $config->timers->AutoFinishTime = ceil($config->timers->WWConstructStartTime + 100 * $config->timers->WWUpLvlInterval);
} else {
    $config->timers->ArtifactsReleaseTime = $config->game->start_time + ceil(100 / $config->game->speed * 86400);
    $config->timers->wwPlansReleaseTime = $config->game->start_time + ceil(200 / $config->game->speed * 86400);
    $config->timers->WWConstructStartTime = $config->game->start_time + ceil(250 / $config->game->speed * 86400);
    $config->timers->WWUpLvlInterval = ceil(86400 / $config->game->speed);
    $config->timers->AutoFinishTime = ceil($config->timers->WWConstructStartTime + 100 * $config->timers->WWUpLvlInterval);
}