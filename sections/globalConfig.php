<?php
global $globalConfig;
$globalConfig = [];
$globalConfig['staticParameters'] = [];
$globalConfig['staticParameters']['default_language'] = 'us';
$globalConfig['staticParameters']['default_timezone'] = 'Australia/Sydney';
$globalConfig['staticParameters']['default_direction'] = 'LTR';
$globalConfig['staticParameters']['default_dateFormat'] = 'y.m.d';
$globalConfig['staticParameters']['default_timeFormat'] = 'H:i';
$globalConfig['staticParameters']['indexUrl'] = 'https://www.YOUR_DOMAIN.com/';
$globalConfig['staticParameters']['forumUrl'] = 'https://forum.YOUR_DOMAIN.com/';
$globalConfig['staticParameters']['answersUrl'] = 'https://answers.travian.com/index.php';
$globalConfig['staticParameters']['helpUrl'] = 'https://help.YOUR_DOMAIN.com/';
$globalConfig['staticParameters']['adminEmail'] = '';
$globalConfig['staticParameters']['session_timeout'] = 6*3600;
$globalConfig['staticParameters']['default_payment_location'] = 2;
$globalConfig['staticParameters']['global_css_class'] = 'USERNAME_HERE';
$globalConfig['staticParameters']['gpacks'] = require("/travian/sections/gpack/gpack.php");
$globalConfig['staticParameters']['recaptcha_public_key'] = '';
$globalConfig['staticParameters']['recaptcha_private_key'] = '';
$globalConfig['cachingServers'] = ['memcached' => [['127.0.0.1', 11211],],];
$globalConfig['dataSources'] = [];
//static global database
$globalConfig['dataSources']['globalDB']['hostname'] = 'localhost';
$globalConfig['dataSources']['globalDB']['username'] = 'root';
$globalConfig['dataSources']['globalDB']['password'] = '';
$globalConfig['dataSources']['globalDB']['database'] = 'main';
$globalConfig['dataSources']['globalDB']['charset'] = 'utf8mb4';


