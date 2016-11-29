<?php

namespace Phpfox\Cache;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Simple filesystem cache on local.
 * implement FilesystemCacheStorage
 *
 * @package Phpfox\Cache
 */
class FilesystemCacheStorage implements CacheStorageInterface
{

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * @var string
     */
    protected $directory;

    public function __construct($configs)
    {
        $configs = array_merge([
            'directory' => 'cache',
            'debug'     => false,
        ], (array)$configs);

        $this->directory = PHPFOX_DIR . '/data/' . $configs['directory'];
        $this->debug = (bool)$configs['debug'];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getFilename($name)
    {
        $path = md5($name);
        $path = substr($path, 0, 3) . DIRECTORY_SEPARATOR . $path;
        return $this->directory . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    private function ensureFilename($filename)
    {
        $dir = dirname($filename);
        if (!is_dir($dir) && !@mkdir($dir, 0777, true)) {
            return false;
        }
        return true;
    }

    public function getItems($keys = [])
    {
        return array_map(function ($v) {
            return $this->getItem($v);
        }, $keys);
    }

    public function save(CacheItemInterface $item)
    {
        $filename = $this->getFilename($item->key());

        if (!$this->ensureFilename($filename)) {
            return false;
        }
        if (!file_put_contents($filename, serialize($item))) {
            return false;
        }
        return true;
    }

    public function getItem($key)
    {
        $filename = $this->getFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        $data = unserialize(file_get_contents($filename));

        if (!$data instanceof CacheItem || !$data->isValid()) {
            return null;
        }

        return $data;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        $this->save(new CacheItem($key, $value, $ttl));
    }


    public function hasItem($key)
    {
        return file_exists($this->getFilename($key));
    }

    public function clear()
    {
        $files
            = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory,
            RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $splInfo) {
            if ($splInfo->isDir()) {
                rmdir($splInfo->getRealpath());
            }

            if ($splInfo->isFile()) {
                unlink($splInfo->getRealpath());
            }
        }
    }

    public function deleteItems($keys)
    {
        array_walk($keys, function ($v) {
            $this->deleteItem($v);
        });

        return true;
    }

    public function deleteItem($key)
    {
        if (file_exists($filename = $this->getFilename((string)$key))) {
            if (@unlink($filename)) {
                return true;
            }
            if (!$this->debug) {
                return false;
            } else {
                throw new InvalidArgumentException("Can not delete item '{$key}'");
            }
        }

        return true;
    }
}