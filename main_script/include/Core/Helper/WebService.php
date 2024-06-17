<?php

namespace Core\Helper;

use Core\Config;
use const IS_DEV;
use function session_cache_expire;
use function session_write_close;

class WebService
{
    private static $ipAddress = null;

    public static function isPost()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
    }

    public static function ipAddress()
    {
        if (!is_null(self::$ipAddress)) {
            return self::$ipAddress;
        }
        $ip_keys = [
            'HTTP_X_SUCURI_CLIENTIP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === TRUE) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    // trim for safety measures
                    $ip = trim($ip);
                    // attempt to validate IP
                    if (filter_var($ip,
                            FILTER_VALIDATE_IP,
                            FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === FALSE) {
                        continue;
                    }
                    return $ip;
                }
            }
        }
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : FALSE;
        return self::$ipAddress = $ip;
    }

    public static function get_real_base_url($atRoot = TRUE, $atCore = FALSE, $parse = FALSE)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $core = preg_split('@/@',
                str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))),
                NULL,
                PREG_SPLIT_NO_EMPTY);
            $core = $core[0];
            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf($tmplt, $http, $hostname, $end);
        } else {
            $base_url = 'http://localhost/';
        }
        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) {
                if ($base_url['path'] == '/') {
                    $base_url['path'] = '';
                }
            }
        }

        return $base_url;
    }

    public static function get_base_url()
    {
        return Config::getProperty("settings", "gameWorldUrl");
    }

    public static function fixSessionPrefix($key)
    {
        return Config::getProperty("settings", "worldUniqueId") . ':' . $key;
    }

    public static function getPaymentUrl()
    {
        return 'https://payment.' . WebService::getRealDomain();
    }

    public static function getRealDomain()
    {
        return preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", self::getIndexUrl());
    }

    public static function getIndexUrl()
    {
        global $globalConfig;
        return $globalConfig['staticParameters']['indexUrl'];
    }

    public static function redirect($url, $code = 302)
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

    public static function getJustDomain()
    {
        return str_replace([
            "http://",
            '/',
        ],
            '',
            preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", self::getIndexUrl()));
    }

    public static function getJustSubDomain()
    {
        return str_replace([
            "http://",
            '/',
        ],
            '',
            self::get_base_url());
    }

    public static function getProtocol()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol;
    }
} 