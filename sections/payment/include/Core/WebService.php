<?php
namespace Core;
class WebService
{
    public static function isPost()
    {
        return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
    }

    public static function ipAddress()
    {
        $ip_keys = array(
            'HTTP_X_SUCURI_CLIENTIP',
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    // trim for safety measures
                    $ip = trim($ip);
                    // attempt to validate IP
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
                        continue;
                    }
                    return $ip;
                }
            }
        }
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
        return $ip;
    }

    /**
     * get request main url
     * @param bool $atRoot
     * @param bool $atCore
     * @param bool $parse
     * @return mixed|string
     */
    static function get_real_base_url($atRoot = TRUE, $atCore = FALSE, $parse = FALSE)
    {
        return self::getProtocol() . 'payment.' . self::getJustDomain() . '/';
    }

    public static function getJustDomain()
    {
        return str_replace(array(
            "http://",
            '/'
        ), '', preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", $_SERVER['HTTP_HOST']));
    }

    public static function getProtocol()
    {
        return self::is_ssl() ? 'https://' : 'http://';
    }

    public static function is_ssl()
    {
        if (isset($_SERVER['HTTPS'])) {
            if ('on' == strtolower($_SERVER['HTTPS']))
                return true;
            if ('1' == $_SERVER['HTTPS'])
                return true;
        } elseif (isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'])) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            return true;
        }
        return false;
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
}