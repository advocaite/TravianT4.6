<?php
namespace Core\Caching;
use Core\Config;
use function getWorldUniqueId;
use Redis;

class Caching
{
    private static $instance;
    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    /**
     * @return Redis
     */
    public static function singleton($key = null)
    {
        global $globalConfig;
        $config = Config::getInstance();
        if (!(self::$instance instanceof Redis)) {
            if(is_null($key)){
                $key = trim(getWorldUniqueId() . explode(".", $config->settings->indexUrl)[1] . ':');
            }
            try {
                $redis = new Redis();
                $redis->connect("127.0.0.1");
                $redis->setOption(Redis::OPT_PREFIX, $key);
                self::$instance = $redis;
            } catch (\Exception $e) {
                die("Server unavailable. Please try again in a few minutes.");
            }
        }
        return self::$instance;
    }

    public function add($key, $value, $expiration = null)
    {
        self::singleton()->setex($key, $expiration, serialize($value));
    }

    public function lock($key)
    {
        $key = 'lock_' . $key;
        return self::singleton()->setnx($key, true);
    }

    public function unlock($key)
    {
        $key = 'lock_' . $key;
        return self::singleton()->del($key);
    }

    public function returnCacheWithCallBack($key, $expire, $vars, callable $callBack)
    {
        if ($this->exists($key)) {
            return $this->get($key);
        }
        $this->set($key, call_user_func_array($callBack, $vars), $expire);
    }

    public function set($key, $value, $expiration = null)
    {
        self::singleton()->setex($key, $expiration, serialize($value));
    }

    public function delete($key)
    {
        if (!is_array($key)) {
            self::singleton()->del([$key]);
        } else {
            self::singleton()->del($key);
        }
    }

    public function keys($pattern)
    {
        return self::singleton()->keys($pattern);
    }
    public function deleteByPattern($pattern)
    {
        $this->delete(self::singleton()->keys($pattern));
    }
    public function get($key)
    {
        if (!self::singleton()->exists($key)) {
            return false;
        }
        return unserialize(self::singleton()->get($key));
    }

    public function exists($key)
    {
        return self::singleton()->exists($key);
    }
}