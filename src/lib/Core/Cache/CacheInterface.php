<?php

namespace Core\Cache;

/**
 * Interface CacheInterface
 *
 * @package Core\Cache
 */
interface CacheInterface {

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set($key, $value);

}