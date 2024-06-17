<?php
define("INCLUDE_PATH", __DIR__ . '/');
spl_autoload_register(function ($className) {
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    if(is_file($filePath)){
        include($filePath);
        return true;
    }
    return false;
});
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/ClouDNS_SDK.php";
require __DIR__ . "/functions.php";
define("PHP_BINARY_LOC", '/usr/bin/php');