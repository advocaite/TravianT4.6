<?php

namespace Core\Helper;

use Core\Caching\GlobalCaching;
use Core\Session;

class BadWordsFilter
{
    private $badWords;

    public function __construct()
    {
        $cache = GlobalCaching::getInstance();
        if (!($this->badWords = $cache->get("badWordsFilterCache"))) {
            $this->badWords = explode(",", file_get_contents(FILTERING_PATH . "badWordsFilter.txt"));
            $cache->set("badWordsFilterCache", $this->badWords, 2 * 86400);
        }
    }

    public function containsBadWords($string, $mainString)
    {
        return $this->censorString($string, $mainString);
    }

    public function censorString($string, $mainString)
    {
        foreach ($this->badWords as $link) {
            if (!empty($string) && strpos($string, $link) !== FALSE) {
                Notification::notify("bad words detected!",
                    "Player " . Session::getInstance()->getName() . " is trying to use bad words $link.");
                return false;
            }
        }
        return true;
    }
}