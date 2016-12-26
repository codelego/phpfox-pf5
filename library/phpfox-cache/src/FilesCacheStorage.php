<?php

namespace Phpfox\Cache;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FilesCacheStorage implements CacheStorageInterface
{

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * @var string
     */
    protected $directory;

    protected $directoryPermission = 0777;

    protected $filePermission = 0777;

    public function __construct($configs = [])
    {
        $configs = array_merge([
            'directory' => 'cache',
            'debug'     => false,
        ], (array)$configs);

        $this->directory = PHPFOX_DIR . 'data/' . $configs['directory'];
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

        $data = unserialize(file_get_contents($filename));

        if ($data['lifetime'] == 0 || $data['lifetime'] > time()) {
            return $data['val'];
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
        $path = substr($path, 0, 3) . DIRECTORY_SEPARATOR . $path;
        return $this->directory . DIRECTORY_SEPARATOR . $path;
    }

    public function setItem($key, $value, $ttl = 0)
    {
        $filename = $this->getFilename($key);

        if (!$this->ensureFilename($filename)) {
            return false;
        }
        if (!file_put_contents($filename, serialize([
            'val'      => $value,
            'lifetime' => $ttl > 0 ? $ttl + time() : 0,
        ]))
        ) {
            return false;
        }

        @chmod($filename,$this->filePermission);

        return true;
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
        if (!is_dir($dir) && !@mkdir($dir, $this->directoryPermission, true)) {
            return false;
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
                rmdir($splInfo->getRealpath());
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