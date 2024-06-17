<?php
ini_set("display_errors", true);
require "vendor/autoload.php";
if(!isset($argv[1])){
    die("No user.");
}
define("WORKING_USER", trim($argv[1]));
require "config.php";
define("BOT_TOKEN", trim(file_get_contents("/travian/telegram_bot.token")));
spl_autoload_register(function ($name) {
    $location = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $name) . '.php';
    if(is_file($location)){
        require($location);
    } else {
        throw new Exception("Couldn't load $name.");
    }
});