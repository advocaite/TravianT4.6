<?php
define("IS_DEV", (bool) '%[IS_DEV]%');
define("PUBLIC_PATH", dirname(__DIR__) . "/public/");
define("CONNECTION_FILE", __DIR__ . '/connection.php');
define("CONFIG_CUSTOM_FILE", __DIR__ . '/config.custom.php');
define("ERROR_LOG_FILE", __DIR__ . '/error_log.log');
define("GLOBAL_CONFIG_FILE", dirname(__DIR__, 2) . '/globalConfig.php');
define("BACKUP_PATH", dirname(__DIR__) . '/backups/');
define("FILTERING_PATH", '/travian/filtering/');
