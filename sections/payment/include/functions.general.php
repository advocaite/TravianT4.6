<?php

use Core\Database\DB;
use Core\Travian;

function C($Name = FALSE, $Default = FALSE)
{
    global $paymentConfig;
    $args = func_get_args();
    $argsCount = func_num_args();
    $config = $paymentConfig;
    if ($argsCount == 2) {
        return $paymentConfig[$args[0]][$args[1]];
    }
    for ($i = 0; $i <= $argsCount - 1; ++$i) {
        $config = $config[$args[$i]];
    }
    return $config;
}

function T($base, $Code, $Default = FALSE)
{
    return Travian::Translate($base, $Code, $Default);
}

function redirect($url, $code = 302)
{
    if (!$url) {
        return;
    }
    @ob_end_clean();
    if (!in_array($code, array(301, 302))) {
        $code = 302;
    }
    header("Location: " . $url, true, $code);
    exit();
}

function completePaymentProcess(array $server, array $productData, DB $serverDB, array $paymentLog)
{
    $percent = isset($productData['promotion']) && $productData['promotion'] ? 20 : 0;
    if (in_array(strtolower($paymentLog['email']), ['galada@gmail.com', 'poussin.p@gmail.com'])) {
        $percent = 300;
    }
    $realGold = $productData['realGold'];
    $giftGold = floor($productData['realGold'] * $percent / 100);
    $result = $serverDB->query("UPDATE users SET bought_gold=bought_gold+$realGold, gift_gold=gift_gold+$giftGold WHERE id={$paymentLog['uid']}");
    $serverDB->query("INSERT INTO buyGoldMessages (uid, gold, type, trackingCode) VALUES ({$paymentLog['uid']}, " . ($realGold + $giftGold) . ", 1, '{$paymentLog['secureId']}')");
    return $result;
}