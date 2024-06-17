<?php

namespace Game\Map;

use Core\Caching\Caching;
use function http_response_code;

class ImageMapCache
{
    public static function checkCache($filename, $fileType, $content = NULL)
    {
        $memcache = Caching::getInstance();
        $cachedContent = $memcache->get($filename);
        if (!$cachedContent && is_null($content)) return;
        if (!is_null($content)) {
            $cachedContent = [
                'content' => $content,
                'time'    => time(),
                'length'  => strlen($content),
            ];
            $memcache->set($filename, $cachedContent, 86400);
        }
        $eTag = self::getETag($filename, $cachedContent['time']);
        $headers = self::getRequestHeaders();
        if (isset($headers['If-None-Match'])) {
            if (0 === strcmp(str_replace('"', null, $headers['If-None-Match']), $eTag)) {
                header(sprintf("Date: %s", date(DATE_RFC822, $cachedContent['time'])));
                http_response_code(304);
                exit;
            }
        }
        header("Content-Type: image/$fileType");
        header(sprintf("Date: %s", date(DATE_RFC822, $cachedContent['time'])));
        if (strpos($filename, 'minimap') !== FALSE) {
            header("Cache-Control: max-age=7200");
            header(sprintf("Expires: %s", date(DATE_RFC822, $cachedContent['time'] + 7200)));
            header("Pragma: public");
        } else if (strpos($filename, 'map_mark') !== FALSE) {
            header("Cache-Control: private");
            header(sprintf('ETag: "%s"', $eTag));
            header("Pragma: private");
        } else if(strpos($filename, 'map_block') !== FALSE) {
            header("Cache-Control: public, max-age=604800");
//            header(sprintf("Content-Length: %s", $cachedContent['length']));
            header(sprintf("Expires: %s", date(DATE_RFC822, $cachedContent['time']+604800)));
        } else if(strpos($filename, 'hero_image') !== FALSE || strpos($filename, 'hero_body') !== FALSE){
            header("Cache-Control: private, max-age=86400");
//            header(sprintf("Content-Length: %s", $cachedContent['length']));
            header(sprintf("Expires: %s", date(DATE_RFC822, $cachedContent['time'] + 86400)));
            header("Pragma: private");
        } else if(strpos($filename, 'stats_6') == FALSE){
            header("Cache-Control: private, max-age=86400");
//            header(sprintf("Content-Length: %s", $cachedContent['length']));
            header(sprintf("Expires: %s", date(DATE_RFC822, $cachedContent['time'] + 86400)));
            header("Pragma: private");
        }
        echo $cachedContent['content'];
        exit();
    }

    private static function getRequestHeaders()
    {
        $headers = [];
        // Grab the IF_MODIFIED_SINCE header
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $headers['If-Modified-Since'] = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
        }
        if (isset($_SERVER['HTTP_IF_NONE_MATCH'])) {
            $headers['If-None-Match'] = $_SERVER['HTTP_IF_NONE_MATCH'];
        }
        return $headers;
    }

    private static function getETag($filename, $lastModifiedTime)
    {
        return md5($filename . $lastModifiedTime);
    }
} 