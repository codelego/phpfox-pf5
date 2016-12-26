<?php
namespace Phpfox\Storage;

interface FileStorageFactoryInterface
{
    /**
     * @param string $id
     *
     * @throws FileStorageException
     */
    public function factory($id);
}