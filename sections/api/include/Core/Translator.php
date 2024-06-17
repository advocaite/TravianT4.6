<?php
namespace Core;
use Exceptions\ErrorException;
use function strtolower;
use function strtoupper;

class Translator
{
    public static $locale = 'en-US';
    private static $locales = [
        'en-US' => [
            "hrefLang" => "international",
            "direction" => "ltr",
        ],
        'fa-IR' => [
            "hrefLang" => "ir",
            "direction" => "rtl",
        ],
    ];
    private static $translation = [];

    public static function translate($name)
    {
        if (isset(self::$translation[$name])) {
            return self::$translation[$name];
        }
        return $name;
    }

    public static function getDirection()
    {
        return Translator::$locales[self::$locale]['direction'];
    }

    public static function getLocale()
    {
        return self::$locale;
    }

    public static function getHrefLang()
    {
        return Translator::$locales[self::$locale]['hrefLang'];
    }

    public static function setLanguage($locale, $restoreDefault = false)
    {
        $locale = explode("-", $locale);
        if(sizeof($locale) <> 2){
            throw new ErrorException("Invalid locale \"$locale\"");
        }
        list($language, $country) = $locale;
        $language = strtolower($language);
        $country = strtoupper($country);
        $locale = sprintf('%s-%s', $language, $country);
        $loc = dirname(__DIR__) . "/locale/" . $locale . '.php';
        if (!is_file($loc)) {
            if ($restoreDefault) {
                $locale = self::$locale;
                $loc = dirname(__DIR__) . "/locale/" . $locale . '.php';
            } else {
                throw new ErrorException("Locale $locale not found.");
            }
        }
        self::$locale = $locale;
        self::$translation = require($loc);
    }
}