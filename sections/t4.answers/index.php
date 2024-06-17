<?php
ini_set("display_errors", 1);
global $globalConfig;
require(dirname(__DIR__, 2) . '/globalConfig.php');
global $proxy_main_url, $filter_domain;
$proxy_main_url = $globalConfig['staticParameters']['answersUrl'];
$filter_domain = '';
if (isset($_GET['lang'])) {
    setLanguage($_GET['lang']);
} else if (isset($_COOKIE['answers_lang'])) {
    setLanguage($_COOKIE['answers_lang']);
} else {
    setLanguage($globalConfig['staticParameters']['default_language']);
}
function setLanguage($lang)
{
    global $filter_domain;
    $languages = [
        'en' => 'com',
        'ir' => 'ir',
        'ae' => 'ae',
        'gr' => 'gr',
        'tr' => 'com.tr',
    ];
    if (isset($languages[$lang])) {
        $filter_domain = 'travian.' . $languages[$lang];
        setcookie("answers_lang", $lang, time() + 365 * 86400);
    }
}

$proxy_main_url = 'http://t4.answers.' . $filter_domain;
function requestWithAjax($url)
{
    global $proxy_main_url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $proxy_main_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function getRealDomain()
{
    global $globalConfig;
    return preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", $globalConfig['staticParameters']['indexUrl']);
}

function get_gpack_cdn_url()
{
    global $globalConfig;
    $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https://' : 'http://';
    $gpack_version = $globalConfig['staticParameters']['gpack_version'];
    return $http . 'gpack' . '.' . getRealDomain() . $gpack_version . '/img/';
}

$query = $_SERVER["QUERY_STRING"];
$query = filter_var($query, FILTER_SANITIZE_STRING);
$query = str_replace(['ssl', 'http', 'https', 'ftp', 'cpanel', 'bash', '.com', '.ir', '.org'], '', $query);
if ((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
    $file = requestWithAjax("$proxy_main_url/?$query");
} else {
    $file = file_get_contents("$proxy_main_url/?$query");
}
$file = str_replace($filter_domain, substr(getRealDomain(), 0, -1), $file);
$file = str_replace('t4.answers.', 't4answers.', $file);
$file = str_replace("images/gp/g/big", 'images/gp/g', $file);
$file = preg_replace("|images/gp/|", get_gpack_cdn_url(), $file);
echo $file;
