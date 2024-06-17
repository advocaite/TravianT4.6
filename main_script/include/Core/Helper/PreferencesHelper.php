<?php

namespace Core\Helper;

use Core\Caching\Caching;
use Core\Config;
use Core\Session;
use function json_decode;
use function json_encode;

class PreferencesHelper
{
    private static $populated = false;
    private static $currentPreferences = [
        'highlightsToggle' => true,
        'firstTutorialClosed' => false,
        'QuestDialogAchievementPosition' => -1,
        'QuestDialogPosition' => -1,
        'travian_toggle_hero' => 'expanded',
        'travian_toggle_infobox' => 'expanded',
        'travian_toggle_villagelist' => 'collapsed',
        'travian_toggle_alliance' => 'expanded',
        'allianceBonusesOverview' => [
            'bonusInfo0' => false,
            'bonusInfo1' => false,
            'bonusInfo2' => false,
            'bonusInfo3' => false
        ],
        'WMBlueprints' => "[]",
    ];
    private static $preferences = [
        'highlightsToggle' => true,
        'travian_toggle_hero' => 'expanded',
        'travian_toggle_infobox' => 'expanded',
        'travian_toggle_villagelist' => 'collapsed',
        'travian_toggle_alliance' => 'expanded',
        'allianceBonusesOverview' => [
            'bonusInfo0' => false,
            'bonusInfo1' => false,
            'bonusInfo2' => false,
            'bonusInfo3' => false
        ],
        'WMBlueprints' => "[]",
    ];

    public static function setPreference($key, $value)
    {
        self::getPreferences();
        $session_cookie_value = &self::$currentPreferences;
        switch ($key) {
            case 'allianceBonusesOverview':
                $value = json_decode($value, true);
                $session_cookie_value[$key] = [
                    'bonusInfo0' => isset($value['bonusInfo0']) && $value['bonusInfo0'],
                    'bonusInfo1' => isset($value['bonusInfo1']) && $value['bonusInfo1'],
                    'bonusInfo2' => isset($value['bonusInfo2']) && $value['bonusInfo2'],
                    'bonusInfo3' => isset($value['bonusInfo3']) && $value['bonusInfo3'],
                ];
                break;
            case 'tradeRoutesOrder':
                if (in_array($value, ['1a', '1d', '2a', '2d', '3a', '3d'])) {
                    $session_cookie_value[$key] = (string)$value;
                }
                break;
            case 'highlightsToggle':
            case 'firstTutorialClosed':
                $session_cookie_value[$key] = (string)$value == 'true' ? 'true' : 'false';
                break;
            case 't4level':
                if (empty($value) || $value == "null") {
                    unset($session_cookie_value[$key]);
                } else {
                    $session_cookie_value[$key] = 1;
                }
                break;
            case 'QuestDialogAchievementPosition':
            case 'QuestDialogPosition':
            case 'WMBlueprints':
                if (self::isJSON($value)) {
                    $session_cookie_value[$key] = (string)json_encode(json_decode($value, JSON_OBJECT_AS_ARRAY),
                        JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
                }
                break;
            case 'reports_tab0':
            case 'reports_tab1':
            case 'reports_tab2':
            case 'reports_tab3':
            case 'reports_tab6':
                //$session_cookie_value[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                break;
            case 'travian_toggle_hero':
            case 'travian_toggle_infobox':
            case 'travian_toggle_villagelist':
            case 'travian_toggle_alliance':
                $session_cookie_value[$key] = (string)$value == 'expanded' ? 'expanded' : 'collapsed';
                break;
        }
        Caching::getInstance()->set("preferences:" . self::getCacheKey(), $session_cookie_value, 86400);
    }

    public static function getPreferences()
    {
        if (!Session::getInstance()->isValid()) {
            return self::$preferences;
        }
        if (!self::$populated) {
            self::$populated = true;
            if ($cache = Caching::getInstance()->get("preferences:" . self::getCacheKey())) {
                self::$currentPreferences = $cache;
            } else {
                self::reSetT3E();
                self::$currentPreferences = self::$preferences;
                Caching::getInstance()->set("preferences:" . self::getCacheKey(), self::$currentPreferences, 3 * 86400);
            }
        }
        return self::$currentPreferences;
    }

    private static function getCacheKey()
    {
        return Session::getInstance()->getPlayerId() . ':' . self::getRandKey();
    }

    public static function getRandKey()
    {
        if (!isset($_COOKIE[self::getKey()])) {
            $_COOKIE[self::getKey()] = mt_rand(1111111, 9999999);
            setcookie(self::getKey(), $_COOKIE[self::getKey()], time() + 3 * 86400);
        }
        $int = (int)$_COOKIE[self::getKey()];
        if ($int > 9999999 || $int < 1111111) {
            unset($_COOKIE[self::getKey()]);
            return self::getRandKey();
        }
        return $int;
    }

    private static function getKey()
    {
        return WebService::fixSessionPrefix("T3E");
    }

    public static function reSetT3E()
    {
        Caching::getInstance()->delete("preferences:" . self::getCacheKey());
        Caching::getInstance()->set("preferences:" . self::getCacheKey(), self::$preferences, 3 * 86400);
    }

    public static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

    public static function getPreference($key)
    {
        self::getPreferences();
        if ($key == 'highlightsToggle' && !isset(self::$currentPreferences[$key])) {
            return 'true';
        }
        if ($key == 't4level' && !isset(self::$currentPreferences[$key])) {
            return 0;
        }
        if($key == 'tradeRoutesOrder' && !isset(self::$currentPreferences[$key])){
            return '2d';
        }
        return self::$currentPreferences[$key];
    }
}