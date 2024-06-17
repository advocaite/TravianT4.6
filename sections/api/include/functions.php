<?php
use Core\Translator;
function T($name){
    return Translator::translate($name);
}
function get_random_string($length){
    // Character List to Pick from
    $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

// Minimum/Maximum times to repeat character List to seed from
    $chrRepeatMin = 1; // Minimum times to repeat the seed string
    $chrRepeatMax = 10; // Maximum times to repeat the seed string

// Length of Random String returned
    $chrRandomLength = $length;

// The ONE LINE random command with the above variables.
    return substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))),1,$chrRandomLength);
}
function generate_guid($trim = true)
{
    // Windows
    if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return trim(com_create_guid(), '{}');
        else
            return com_create_guid();
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace .
        substr($charid, 0, 8) . $hyphen .
        substr($charid, 8, 4) . $hyphen .
        substr($charid, 12, 4) . $hyphen .
        substr($charid, 16, 4) . $hyphen .
        substr($charid, 20, 12) .
        $rbrace;
    return $guidv4;
}