<?php

namespace Phpfox\Storage;


class LocalFileStorage implements FileStorageInterface
{
    use FileStorageTrait;


    /**
     * LocalStorageService constructor.
     *
     * Params array contain
     * - basePath: string, required
     * - baseUrl: string, required
     * - baseCdnUrl: string, optional, default = baseUrl
     *
     * @param array $params
     */
    public function __construct($params)
    {
        if (isset($params['basePath'])) {
            $this->basePath = $params['basePath'];
        }

        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }

        if (isset($params['baseCdnUrl'])) {
            $this->baseCdnUrl = $params['baseCdnUrl'];
        }

        if (null == $this->baseUrl) {
            $this->baseUrl = PHPFOX_BASE_URL;
        }

        if (null == $this->basePath) {
            $this->basePath = PHPFOX_BASE_DIR;
        }

        if (null == $this->baseCdnUrl) {
            $this->baseCdnUrl = PHPFOX_BASE_URL;
        }

        $this->basePath = rtrim($this->basePath, '/') . '/';
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
        $this->baseCdnUrl = rtrim($this->baseCdnUrl, '/') . '/';
    }

    public function getObject($name)
    {
        return @file_get_contents($this->mapPath($name));
    }

    function putObject($data, $name)
    {
        $path = $this->mapPath($name);

        if (!file_put_contents($path, $data)) {
            throw new FileStorageException("File exists");
        }

        @chmod($path, 0644);

        return true;
    }

    public function putFile($local, $name)
    {
        $path = $this->mapPath($name);
        $this->ensure($path);

        if (!file_exists($local)) {
            _get('dev.log')
                ->error('File not found {0}, {1}', [$local, __CLASS__]);
        }

        if (!@copy($local, $path)) {
            throw new FileStorageException("Could not put file from '{$local}' to '{$path}'.");
        }
        return true;
    }

    protected function ensure($path)
    {
        if (!is_dir($dir = dirname($path))
            && !mkdir($dir, $this->directoryPermission, true)
        ) {
            throw new FileStorageException("Oops! Unable create directory '{$path}'.");
        }

        return true;
    }

    public function getFile($local, $name)
    {
        $path = $this->mapPath($name);
        $this->ensure($path);

        if (!copy($path, $local)) {
            throw new FileStorageException("Could not put file from '$path' to '{$local}'.");
        }

        return true;
    }

    public function deleteFile($name)
    {
        $path = $this->mapPath($name);

        if (file_exists($path)) {
            @unlink($path);
        }
        return true;
    }

    public function release()
    {
        // no resource to release
    }

    /**
     * @return array
     * @ignore
     */
    public function __sleep()
    {
        return [
            'basePath',
            'baseUrl',
            'baseCdn',
        ];
    }
}