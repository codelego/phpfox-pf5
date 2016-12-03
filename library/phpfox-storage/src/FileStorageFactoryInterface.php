<?php
namespace Phpfox\Storage;

interface FileStorageFactoryInterface
{
    /**
     * @param array $options
     *
     * @throws FileStorageException
     */
    public function factory($options);
}