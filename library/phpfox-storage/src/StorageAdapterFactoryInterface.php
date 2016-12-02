<?php
namespace Phpfox\Storage;

interface StorageAdapterFactoryInterface
{
    /**
     * @param array $options
     *
     * @throws StorageException
     */
    public function factory($options);
}