<?php

namespace Phpfox\Cache;


class ApcuStorage implements StorageInterface
{
    public function saveItem(CacheItem $item)
    {
        apcu_store($item->key, $item, $item->ttl);
    }

    public function set($key, $value, $ttl = 0)
    {
        apcu_store($key, $value, $ttl ? $ttl * 60 + time() : 0);
    }

    public function get($key)
    {
        $data = apcu_fetch($key, $success);

        if (!$success) {
            return null;
        }

        return $data;
    }

    public function has($key)
    {
        return apcu_exists($key);
    }

    public function flush()
    {
        return apcu_clear_cache();
    }

    public function delete($key)
    {
        apcu_delete($key);
    }

    public function deleteItems($keys)
    {
        apcu_delete($keys);
    }

}