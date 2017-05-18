<?php

namespace Phpfox\Storage;


class StorageFacades
{
    /**
     * @var StorageInterface[]
     */
    protected $container = [];

    public function set($id, StorageInterface $service)
    {
        $this->container[$id] = $service;
        return $this;
    }

    public function has($id)
    {
        return isset($this->container[$id]);
    }

    public function mapUrl($id, $name)
    {
        return $this->get($id)->mapUrl($name);
    }

    /**
     * @param $id
     *
     * @return StorageInterface
     * @throws FileStorageException
     */
    private function make($id)
    {
        $parameter = _get('storage.params')->getStorageParameter($id);
        $class = _param('storage_drivers', $parameter->get('driver'));

        if (!$class) {
            throw new FileStorageException("Can not create storage with id [$id]");
        }

        return $this->container[$id] = new $class($parameter->get('params'));

    }

    public function get($id)
    {
        if (!$id) {
            $id = 'default';
        }

        return isset($this->container[$id])
            ? $this->container[$id]
            : $this->make($id);
    }

    public function mapCdnUrl($id, $name)
    {
        return $this->get($id)->mapCdnUrl($name);
    }

    public function getUrl($id, $name)
    {
        return $this->get($id)->getUrl($name);
    }

    public function mapPath($id, $name)
    {
        return $this->get($id)->mapPath($name);
    }

    public function putFile($id, $local, $name)
    {
        return $this->get($id)->putFile($local, $name);
    }

    public function getFile($id, $local, $name)
    {
        return $this->get($id)->getFile($local, $name);
    }

    public function deleteFile($id, $name)
    {
        return $this->get($id)->deleteFile($name);
    }


    public function __sleep()
    {
        return ['map', 'default', 'factory'];
    }
}