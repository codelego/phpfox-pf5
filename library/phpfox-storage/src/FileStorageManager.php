<?php

namespace Phpfox\Storage;


class FileStorageManager implements FileStorageManagerInterface
{
    /**
     * @var FileStorageInterface[]
     */
    protected $container = [];

    public function set($id, FileStorageInterface $service)
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

    public function get($id)
    {
        if (!$id) {
            $id = 'default';
        }

        return isset($this->container[$id])
            ? $this->container[$id]
            : $this->container[$id] = \Phpfox::get('storage.factory')
                ->factory($id);
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