<?php
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("INCLUDE_PATH", ROOT_PATH . "include" . DIRECTORY_SEPARATOR);
require(__DIR__ . '/vendor/autoload.php');
require ROOT_PATH . "include" . DIRECTORY_SEPARATOR . 'config.inc.php';
require(__DIR__ . '/functions.general.php');