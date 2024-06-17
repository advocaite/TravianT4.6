<?php
ini_set("error_log", __DIR__ . "/voting.log");
$globalConfigFileLocation = dirname(__DIR__, 2) . '/globalConfig.php';
if (!is_file($globalConfigFileLocation)) {
    die("Wrong configuration!");
}
global $globalConfig;
require($globalConfigFileLocation);
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/functions.php";
