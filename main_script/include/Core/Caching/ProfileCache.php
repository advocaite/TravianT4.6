<?php
namespace Core\Caching;
use Core\Database\DB;
use Model\ProfileModel;
class ProfileCache
{
    const PROFILE_VILLAGES_CACHE_KEY = 'P:V:%s:%s';
    const PROFILE_VILLAGES_BY_NAME_CACHE_KEY = 'P:V:SN:%s:%s';
    const PROFILE_VILLAGES_EDIT_CACHE_KEY = 'P:V:E:%s:%s';
    const PROFILE_MEDALS_CACHE_KEY = 'P:M:%s:%s';
    private $cache;
    private $version;

    public function __construct($version)
    {
        $this->version = $version;
        $this->cache = Caching::getInstance();
    }

    public function getProfileVillages($uid)
    {
        if ($cache = $this->cache->get($this->getKey($uid, self::PROFILE_VILLAGES_CACHE_KEY))) {
            return $cache;
        }
        $villages = (new ProfileModel())->getPlayerVillages($uid)->fetch_all(MYSQLI_ASSOC);
        $this->cache->set($this->getKey($uid, self::PROFILE_VILLAGES_CACHE_KEY), $villages, 300);
        return $villages;
    }

    public function getProfileVillagesSortedByName($uid)
    {
        if ($cache = $this->cache->get($this->getKey($uid, self::PROFILE_VILLAGES_BY_NAME_CACHE_KEY))) {
            return $cache;
        }
        $villages = (new ProfileModel())->getPlayerVillages($uid, true)->fetch_all(MYSQLI_ASSOC);
        $this->cache->set($this->getKey($uid, self::PROFILE_VILLAGES_BY_NAME_CACHE_KEY), $villages, 300);
        return $villages;
    }
    public function getKey($uid, $type)
    {
        return sprintf($type, $uid, $this->version);
    }
    public function getProfileMedals($uid)
    {
        if ($cache = $this->cache->get($this->getKey($uid, self::PROFILE_MEDALS_CACHE_KEY))) {
            return $cache;
        }
        return FALSE;
    }
    public function setProfileMedals($uid, $HTML)
    {
        $this->cache->set($this->getKey($uid, self::PROFILE_MEDALS_CACHE_KEY), $HTML, 300);
    }
    public function getProfileEditVillages($uid)
    {
        if ($cache = $this->cache->get($this->getKey($uid, self::PROFILE_VILLAGES_EDIT_CACHE_KEY))) {
            return $cache;
        }
        $villages = (new ProfileModel())->getPlayerVillages($uid)->fetch_all(MYSQLI_ASSOC);
        $this->setProfileEditVillages($uid, $villages, sizeof($villages));
        return $villages;
    }
    public function reValidateProfileVillages($uid)
    {
        $this->cache->delete($this->getKey($uid, self::PROFILE_VILLAGES_CACHE_KEY));
        $this->cache->delete($this->getKey($uid, self::PROFILE_VILLAGES_BY_NAME_CACHE_KEY));
        $this->cache->delete($this->getKey($uid, self::PROFILE_VILLAGES_EDIT_CACHE_KEY));

        $db = DB::getInstance();
        $db->query("UPDATE users SET profileCacheVersion=profileCacheVersion+1 WHERE id=$uid");
        $this->version++;
    }
    public function setProfileEditVillages($uid, $HTML, $count)
    {
        $this->cache->set($this->getKey($uid, self::PROFILE_VILLAGES_EDIT_CACHE_KEY), $HTML, 300);
    }
    public function __call($name, $args)
    {
        return call_user_func_array([$this, $name], $args);
    }
}