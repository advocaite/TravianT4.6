<?php
use Core\Database\GlobalDB;
use Core\PaymentHelper;
global $paymentConfig;
$globalConfigFileLocation = dirname(__DIR__, 2) . '/globalConfig.php';
if (!is_file($globalConfigFileLocation)) {
    die("Wrong configuration!");
}
global $globalConfig;
require($globalConfigFileLocation);
use Core\Travian;
$db = GlobalDB::getInstance();
$find = $db->query("SELECT * FROM paymentConfig LIMIT 1");
if(!$find || !$find->num_rows){
    die("Installation is not completed.");
}
global $globalConfig;
$config = $find->fetch_assoc();
$paymentConfig = [
    'OfferTime' => $config['offer'],
    'active' => $config['active'],
    'Offer' => $config['offer'] >= time(),
    'default_payment_location' => $globalConfig['staticParameters']['default_payment_location'],
    'globalConfig' => $globalConfig,
];
Travian::Locale()->setLocaleLanguage(PaymentHelper::getProviderLocationLanguage($paymentConfig["default_payment_location"]));