<?php

namespace Core\Cache;

/**
 * Class ApiCache
 *
 * @package Core\Cache
 */
final class ApiCache implements CacheInterface {

    /** @var ApiCache */
    private static $obj;

    /** @var \Memcached */
    private $cache;

    /**
     * ApiCache constructor.
     */
    private function __construct() {
        $this->cache = new \Memcached();
        $this->cache->addServer('127.0.0.1', 11211);
    }

    /**
     * Clone
     */
    private function __clone() {}

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Serialize
     */
    private function __sleep() {}

    /** @noinspection PhpUnusedPrivateMethodInspection
     * Unserialize
     */
    private function __wakeup() {}

    /**
     * @return ApiCache
     */
    public static function instance() {
        if (null === self::$obj) {
            self::$obj = new ApiCache();
        }
        return self::$obj;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        return $this->cache->get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set($key, $value) {
        return $this->cache->set($key, $value);
    }

}