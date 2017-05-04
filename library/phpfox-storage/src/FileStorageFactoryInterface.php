<?php

namespace Phpfox\Storage;

interface FileStorageFactoryInterface
{
    /**
     * @param string $id
     *
     * @return FileStorageInterface
     * @throws FileStorageException
     */
    public function factory($id);
}