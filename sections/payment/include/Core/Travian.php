<?php
namespace Core;

use Core\Database\DB;

class Travian
{
    /**
     * Get a reference to the default database object.
     * @return \Core\Database\DB
     */
    private static $db;

    public static function Database()
    {
        if (!(self::$db instanceof DB)) {
            self::$db = new DB();
        }
        return self::$db;
    }

    /**
     * @return \Core\Locale
     */
    private static $locale;

    public static function Locale()
    {
        if (!(self::$locale instanceof Locale)) {
            self::$locale = new Locale();
        }
        return self::$locale;
    }

    /**
     * Translates a code into the selected locale's definition.
     *
     * @param string $Code The code related to the language-specific definition.
     * @param string $Default The default value to be displayed if the translation code is not found.
     * @return string The translated string or $Code if there is no value in $Default.
     */
    public static function Translate($base, $Code, $Default = FALSE)
    {
        $Locale = self::Locale();
        if ($Locale)
            return $Locale->Translate($base, $Code, $Default);
        else
            return $Default;
    }
}