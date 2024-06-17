<?php

namespace Core;

use Core\Caching\Caching;
use Core\Helper\Notification;
use function get_locale;
use function logError;
use function property_exists;

class Locale
{
    public static $translation_preloaded = [
        'fa-IR' => ['days' => 'روز', 'hours' => 'ساعت', 'minutes' => 'دقیقه'],
        'en-US' => ['days' => 'day(s)', 'hours' => 'hour(s)', 'minutes' => 'min(s)'],
        'ar-AE' => ['days' => 'الأيام', 'hours' => 'ساعات', 'minutes' => 'الدقائق'],
        'el-GR' => ['days' => 'ημέρα(ες)', 'hours' => 'ώρα(ες)', 'minutes' => 'λεπτό(α)'],
        'tr-TR' => ['days' => 'günler', 'hours' => 'saat', 'minutes' => 'dakika'],
    ];
    private static $_self;
    public $Locale = [];

    public function __construct()
    {
        $this->populate();
    }

    private function populate()
    {
        $locale = get_locale();
        $filename = LOCALE_PATH . $locale . ".php";
        if (!file_exists($filename)) {
            Session::getInstance()->setLanguage(Config::getProperty("settings", "default_language"));
            Notification::notify("Locale not found!", $filename);
            $this->populate();
            return;
        }
        if (!($this->Locale = Caching::getInstance()->get("Language:$locale"))) {
            $this->Locale = require $filename;
            $this->Locale['filemtime'] = filemtime($filename);
            //Caching::getInstance()->set("Language:$Language", $this->Locale, 2*3600);
        }
        //if ($this->Locale['filemtime'] <> filemtime($filename)) {
        //Caching::getInstance()->delete("Language:$Language");
        //}
    }

    public function Translate($base, $Code, $Default = FALSE)
    {
        $self = self::getInstance();
        if ($Default === FALSE) {
            $Default = $Code;
        }
        $Code = trim($Code);
        // Shortcut, get the whole config
        if ($Code == '.') {
            return $self->Locale[$base];
        }
        $Keys = explode('.', $Code);
        $KeyCount = count($Keys);
        $Value = $self->Locale[$base];
        $locale = get_locale();
        for ($i = 0; $i < $KeyCount; ++$i) {
            if (is_array($Value) && array_key_exists($Keys[$i], $Value)) {
                $Value = $Value[$Keys[$i]];
            } else {
                logError("Translation not found: Language: $locale | Section: $base | Key: $Code");
                return $Default;
            }
        }
        return $Value;
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function Cleanup()
    {
        unset(self::getInstance()->Locale);
    }
}