<?php
global $indexConfig;
global $globalConfig;
$path = '/home/travian/'.WORKING_USER.'/globalConfig.php';
require($path);
date_default_timezone_set($globalConfig['staticParameters']['default_timezone']);
$indexConfig = [
    'db' => [
        'host' => $globalConfig['dataSources']['globalDB']['hostname'],
        'user' => $globalConfig['dataSources']['globalDB']['username'],
        'pass' => $globalConfig['dataSources']['globalDB']['password'],
        'name' => $globalConfig['dataSources']['globalDB']['database'],
        'charset' => $globalConfig['dataSources']['globalDB']['charset'],
    ],
    'recaptcha' => [
        'site_key' => $globalConfig['staticParameters']['recaptcha_public_key'],
        'secret' => $globalConfig['staticParameters']['recaptcha_private_key'],
    ],
    'settings' => [
        'defaultLocaleName' => $globalConfig['staticParameters']['default_language'] == 'en' ? 'international' : $globalConfig['staticParameters']['default_language']
    ],
    'mail' => [
    ],
];
