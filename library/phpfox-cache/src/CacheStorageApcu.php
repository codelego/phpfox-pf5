<?php
namespace Phpfox\Cache;


class CacheStorageApcu implements CacheStorageInterface
{
    public function setItem($key, $value, $ttl = 0)
    {
        apcu_store($key, $value, $ttl);
        return true;
    }

    public function getItems($keyValues = [])
    {
        $success = false;
        $data = apcu_fetch($keyValues, $success);

        if (!$success) {
            return null;
        }
        return $data;
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
    public function clear()
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