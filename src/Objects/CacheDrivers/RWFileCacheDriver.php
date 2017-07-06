<?php
namespace RapidWeb\SimpleGoogleMaps\Objects\CacheDrivers;

use RapidWeb\SimpleGoogleMaps\Interfaces\CacheDriverInterface;
use rapidweb\RWFileCache\RWFileCache;

class RWFileCacheDriver implements CacheDriverInterface {

    private $cache = null;

    public function __construct()
    {
        $this->cache = new RWFileCache();
        $this->cache->changeConfig(
            array(
                "cacheDirectory" => __DIR__."/../../../cache/",
                "gzipCompression" => true
                )
            );
    }

    public function set($key, $value)
    {
        return $this->cache->set($key, $value, strtotime('+1 month'));
    }

    public function get($key)
    {
        return $this->cache->get($key);
    }

    public function delete($key)
    {
        return $this->cache->delete($key);
    }
}