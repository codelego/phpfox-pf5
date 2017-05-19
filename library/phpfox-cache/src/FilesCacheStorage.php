<?php

namespace Phpfox\Cache;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FilesCacheStorage implements CacheStorageInterface
{

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var int
     */
    private $directoryPermission = 0777;

    /**
     * @var int
     */
    private $filePermission = 0777;

    /**
     * FilesCacheStorage constructor.
     *
     * @param array $configs
     */
    public function __construct($configs = [])
    {
        $configs = array_merge([
            'directory' => 'cache',
            'debug'     => false,
        ], (array)$configs);

        $this->directory = PHPFOX_DATA_DIR . $configs['directory'];
        $this->debug = (bool)$configs['debug'];
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
        $filename = $this->getFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        /** @var CacheItem $item */
        $item = unserialize(file_get_contents($filename));

        if ($item === false) {
            return null;
        }

        if ($item->ttl == 0 || $item->ttl > time()) {
            return $item;
        }

        return null;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getFilename($name)
    {
        $path = md5($name);
        $path = substr($path, 0, 3) . DIRECTORY_SEPARATOR . $path . '.cache';
        return $this->directory . DIRECTORY_SEPARATOR . $path;
    }

    public function saveItem(CacheItem $item)
    {
        $filename = $this->getFilename($item->key);

        if (!$this->ensureFilename($filename)) {
            return false;
        }

        if (!file_put_contents($filename, serialize($item))
        ) {
            return false;
        }

        @chmod($filename, $this->filePermission);

        return true;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        return $this->saveItem(new CacheItem($key, $value, $ttl));
    }

    public function setItems($keyValues, $ttl = 0)
    {
        foreach ($keyValues as $key => $value) {
            $this->setItem($key, $value, $ttl);
        }
        return true;
    }

    /**
     * @param string $filename
     *
     * @return bool
     */
    private function ensureFilename($filename)
    {
        $dir = dirname($filename);
        if (!is_dir($dir)) {
            if (!@mkdir($dir, $this->directoryPermission, true)) {
                return false;
            }
            @chmod($dir, $this->directoryPermission);
        }
        return true;
    }

    public function hasItem($key)
    {
        return file_exists($this->getFilename($key));
    }

    public function flush()
    {
        $files
            = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory,
            RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($files as $splInfo) {
            if ($splInfo->isDir()) {
                @rmdir($splInfo->getRealpath());
            }

            if ($splInfo->isFile()) {
                @unlink($splInfo->getRealpath());
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
            return false;
        }

        return true;
    }
}