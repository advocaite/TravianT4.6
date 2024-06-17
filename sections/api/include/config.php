<?php
global $indexConfig;
global $globalConfig;
$path = dirname(__DIR__, 2) . "/globalConfig.php";
if (!is_file($path)) {
    die("Global config not found.");
}
require($path);
date_default_timezone_set($globalConfig['staticParameters']['default_timezone']);