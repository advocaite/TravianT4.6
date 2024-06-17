<?php

namespace Core\Helper;

use Core\Config;
use Core\Session;
use function date_default_timezone_get;
use function get_locale;
use function jalali_to_gregorian;
use function var_dump;

require_once INCLUDE_PATH . "jdf.php";

class TimezoneHelper
{
    private static $default_date_format = 'd.m.y';
    private static $default_time_format = 'H:i';

    public static function autoDateString($time = NULL, $hasHour = FALSE, $hasSecond = false, $relative = true)
    {
        $diffDays = self::getDifDays($time);
        if ($relative) {
            if (is_numeric($diffDays)) {
                switch ($diffDays) {
                    case 1:
                        return T("Global", "tomorrow") . " " . self::date(self::getTimeFormat($hasSecond), $time);
                        break;
                    case 0:
                        return T("Global", "today") . " " . self::date(self::getTimeFormat($hasSecond), $time);
                        break;
                    case -1:
                        return T("Global", "yesterday") . " " . self::date(self::getTimeFormat($hasSecond), $time);
                        break;
                    case -2:
                        return sprintf(T("Global", "x days past"),
                                abs($diffDays)) . " " . self::date(self::getTimeFormat($hasSecond), $time);
                        break;
                }
                if ($diffDays > 1) {
                    return sprintf(T("Global", "x days later"),
                            $diffDays) . " " . self::date(self::getTimeFormat($hasSecond), $time);
                }
            }
        }
        return self::date(self::getDateFormat() . ($hasHour ? ' ' . self::getTimeFormat($hasSecond) : ''), $time);
    }

    public static function getDifDays($time)
    {
        $today = new \DateTime(); // This object represents current date/time
        $today->setTime(0, 0, 0); // reset time part, to prevent partial comparison
        $match_date = \DateTime::createFromFormat("Y.m.d H:i", date("Y.m.d H:i", $time));
        $match_date->setTime(0, 0, 0); // reset time part, to prevent partial comparison
        $diff = $today->diff($match_date);
        return (integer)$diff->format("%R%a");
    }

    public static function strtotime($format, $dateFormat = 'Y-m-d H:i')
    {
        if (get_locale() == "fa-IR") {
            if ($dateFormat == 'Y-m-d H:i' || $dateFormat == 'Y-m-d H:i:s') {
                list($date, $time) = explode(" ", $format);
                $date = explode("-", $date);
                $time = explode(":", $time);
                $dateString = jalali_to_gregorian($date[0], $date[1], $date[2], '-');
                if ($dateFormat == 'Y-m-d H:i:s') {
                    return self::real_strtotime(sprintf("%s %s:%s:%s", $dateString, $time[0], $time[1], $time[2]));
                }
                return self::real_strtotime(sprintf("%s %s:%s", $dateString, $time[0], $time[1]));
            }
        }
        $date = new \DateTime($format, new \DateTimeZone(self::getTimezone()));
        return $date->getTimestamp();
    }

    public static function real_strtotime($format)
    {
        $date = new \DateTime($format, new \DateTimeZone(self::getTimezone()));
        return $date->getTimestamp();
    }

    public static function getTimezone()
    {
        $session = Session::getInstance();
        if (!$session->isValid()) {
            return date_default_timezone_get();
        }
        $config = Config::getInstance();
        if ($session->getTimezone()[0] == 0) {
            $timezone = date_default_timezone_get();
        } else if (isset($config->timezones['general'][$session->getTimezone()[0]])) {
            $timezone = $config->timezones['general'][$session->getTimezone()[0]];
        } else if (isset($config->timezones['local'][$session->getTimezone()[0]])) {
            $timezone = $config->timezones['local'][$session->getTimezone()[0]];
        } else {
            return date_default_timezone_get();
        }
        if ($session->getTimezone()[0] != 0 && strpos($timezone, 'UTC') !== FALSE && $timezone != 'UTC') {
            $timezone = 'Etc/' . str_replace('UTC', 'GMT', str_replace(' ', '', $timezone));
        }
        return $timezone;
    }

    public static function date($format, $timestamp = NULL, $real = false)
    {
        $date = new \DateTime('now', new \DateTimeZone(date_default_timezone_get()));
        if ($timestamp !== NULL) {
            $date->setTimestamp($timestamp);
        }
        $date->setTimezone(new \DateTimeZone(self::getTimezone()));
        if (!$real && get_locale() == "fa-IR") {
            $timestamp = is_null($timestamp) ? time() : $timestamp;
            if (strpos($format, 'M') !== FALSE) {
                $format = str_replace('M', 'F', $format);
                $format = str_replace('.', ' ', $format);
            }
            return jdate($format, $timestamp, null, self::getTimezone());
        }
        return $date->format($format);
    }

    public static function getDateFormat()
    {
        $session = Session::getInstance();
        if (!$session->isValid()) {
            return self::$default_date_format;
        }
        if ($session->getTimezone()[1] == 0) {
            return 'd.m.y';
        } else if ($session->getTimezone()[1] == 1) {
            return 'm.d.y';
        } else if ($session->getTimezone()[1] == 2) {
            return 'd.m.y';
        } else {
            return 'y.m.d';
        }
    }

    public static function getTimeFormat($hasSecond = TRUE)
    {
        $session = Session::getInstance();
        if (!$session->isValid()) {
            $format = self::$default_time_format;
        } else {
            $format = ($session->getTimezone()[1] == 1 || $session->getTimezone()[1] == 2 ? 'h:i' : 'H:i');
        }
        return $format . ($hasSecond ? ':s' : '');
    }

    public static function getIntervalUnit($seconds, $round = true)
    {
        $unit = 'second(s)';
        if ($seconds >= 86400) {
            $unit = 'day(s)';
            $seconds /= 86400;
        } else if ($seconds >= 3600) {
            $unit = 'hour(s)';
            $seconds /= 3600;
        } else if ($seconds >= 60) {
            $unit = 'minute(s)';
            $seconds /= 60;
        }
        if ($unit == 'day(s)') {
            $unit = T("inGame", "Days");
        } else if ($unit == 'hour(s)') {
            $unit = T("inGame", "Hours");
        } else if ($unit == 'minute(s)') {
            $unit = T("inGame", "Minutes");
        } else if ($unit == 'second(s)') {
            $unit = T("inGame", "Seconds");
        }
        if ($round) {
            $seconds = round($seconds, 1);
        }
        return ['unit' => $unit, 'time' => $seconds];
    }

    public static function autoDate($time = NULL, $hasHour = FALSE, $hasSecond = false)
    {
        return self::date(self::getDateFormat() . ($hasHour ? ', ' . self::getTimeFormat($hasSecond) : ''), $time);
    }
}