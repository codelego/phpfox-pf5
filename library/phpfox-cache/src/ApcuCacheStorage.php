<?php
namespace Phpfox\Cache;


class ApcuCacheStorage implements CacheStorageInterface
{
    public function setItem($key, $value, $ttl = 0)
    {
        $this->save(new CacheItem($key, $value, $ttl));
    }

    public function save(CacheItemInterface $item)
    {
        apcu_store($item->key(), serialize($item), $item->ttl());
    }

    public function getItems($keys = [])
    {
        $result = [];
        foreach ($keys as $k => $v) {
            $result[$k] = $this->getItem($v);
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

        if (!$data) {
            return null;
        }

        $data = unserialize($data);

        if (!$data instanceof CacheItemInterface) {
            return null;
        }

        if (!$data->isValid()) {
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