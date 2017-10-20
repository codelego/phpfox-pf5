<?php

namespace Phpfox\Cache;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FilesStorage implements StorageInterface
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

        $this->directory = PHPFOX_VAR_DIR . $configs['directory'];
        $this->debug = (bool)$configs['debug'];
    }

    public function get($key)
    {
        $filename = $this->getFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        $item = unserialize(file_get_contents($filename));

        if ($item === false) {
            return null;
        }

        if ($item[1] == 0 OR $item[1] > time()) {
            return $item[0];
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


    public function set($key, $value, $ttl = 0)
    {
        $filename = $this->getFilename($key);

        if ($this->ensureFilename($filename) and
            false !== file_put_contents($filename, serialize([$value, $ttl ? $ttl * 60 + time() : 0]))
        ) {
            @chmod($filename, $this->filePermission);
        }
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

    public function has($key)
    {
        return file_exists($this->getFilename($key));
    }

    public function flush()
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory,
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

    public function delete($key)
    {
        if (file_exists($filename = $this->getFilename((string)$key))) {
            @unlink($filename);
        }
    }
}