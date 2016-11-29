<?php
namespace Phpfox\Storage;

interface StorageServiceFactoryInterface
{
    /**
     * @param array $options
     *
     * @throws StorageServiceException
     */
    public function factory($options);
}