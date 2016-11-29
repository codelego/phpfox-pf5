<?php

namespace Phpfox\Storage;


class LocalStorageService implements StorageServiceInterface
{
    use StorageServiceTrait;


    /**
     * LocalStorageService constructor.
     *
     * @param $params
     */
    public function __construct($params)
    {
        if (isset($params['basePath'])) {
            $this->basePath = $params['basePath'];
        }

        if (isset($params['baseUrl'])) {
            $this->baseUrl = $params['baseUrl'];
        }

        if (isset($params['baseCdn'])) {
            $this->basePath = $params['baseCdn'];
        }

        if (null == $this->baseUrl) {
            $this->baseUrl = PHPFOX_BASE_URL;
        }

        if (null == $this->basePath) {
            $this->basePath = PHPFOX_BASE_DIR;
        }

        if (null == $this->baseCdn) {
            $this->baseCdn = PHPFOX_BASE_URL;
        }

        $this->basePath = rtrim($this->basePath, '/') . '/';
        $this->baseUrl = rtrim($this->baseUrl, '/') . '/';
        $this->baseCdn = rtrim($this->baseCdn, '/') . '/';
    }

    public function getObject($name)
    {
        return @file_get_contents($this->getPath($name));
    }

    function putObject($data, $name)
    {
        $path = $this->getPath($name);

        if (!file_put_contents($path, $data)) {
            throw new StorageServiceException("File exists");
        }

        @chmod($path, 0644);

        return true;
    }

    protected function ensure($path)
    {
        if (!is_dir($path)
            && !mkdir(dirname($path), $this->directoryPermission, true)
        ) {
            throw new StorageServiceException("Could not write to '{$path}'.");
        }

        if (file_exists($path)) {
            @unlink($path);
        }
        return true;
    }

    public function putFile($local, $name)
    {
        $path = $this->getPath($name);
        $this->ensure($path);

        if (!copy($local, $path)) {
            throw new StorageServiceException("Could not put file from '{$local}' to '{$path}'.");
        }
        return true;
    }

    public function getFile($local, $name)
    {
        $path = $this->getPath($name);
        $this->ensure($path);

        if (!copy($path, $local)) {
            throw new StorageServiceException("Could not put file from '$path' to '{$local}'.");
        }

        return true;
    }

    public function deleteFile($name)
    {
        $path = $this->getPath($name);

        if (file_exists($path)) {
            @unlink($path);
        }
        return true;
    }

    public function disconnect()
    {
        // do nothing, this method must be implemented to contract with interface.
    }

    public function __sleep()
    {
        return [
            'basePath',
            'baseUrl',
            'baseCdn',
        ];
    }
}