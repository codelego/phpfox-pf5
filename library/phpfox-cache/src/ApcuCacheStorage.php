<?php

namespace Phpfox\Cache;


class ApcuCacheStorage implements CacheStorageInterface
{
    public function saveItem(CacheItem $item)
    {
        apcu_store($item->key, $item, $item->ttl);
        return true;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        return $this->saveItem(new CacheItem($key, $value, $ttl));
    }

    public function setItems($keyValues, $ttl = 0)
    {
        foreach ($keyValues as $k => $v) {
            $this->saveItem(new CacheItem($k, $v, $ttl));
        }
        return true;

    }

    public function getItems($keys = [])
    {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $this->getItem($key);
        }
        return $result;
    }

    public function getItem($key)
    {
        $success = false;
        $data = apcu_fetch((string)$key, $success);

        if (!$success) {
            return null;
        }

        return $data;
    }

    public function hasItem($key)
    {
        return apcu_exists($key);
    }

    /**
     * Always return TRUE
     *
     * @return bool
     */
    public function flush()
    {
        return apcu_clear_cache();
    }

    public function deleteItem($key)
    {
        apcu_delete($key);
        return true;
    }

    public function deleteItems($keys)
    {
        apcu_delete($keys);
        return true;
    }

}