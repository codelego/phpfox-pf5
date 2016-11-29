<?php

namespace Phpfox\Storage;

interface StorageServiceInterface
{
    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function getUrl($name);

    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function cdnUrl($name);

    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function url($name);

    /**
     * @param  string $name
     *
     * @return mixed
     * @throws StorageServiceException
     */
    public function getObject($name);

    /**
     * @param $data
     * @param $name
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function putObject($data, $name);

    /**
     * @param string $name
     *
     * @return string
     */
    public function getPath($name);

    /**
     * Copy from local to file service path.
     *
     * @param string $local local source filename (full path)
     * @param string $name  Relative path
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function putFile($local, $name);

    /**
     * @param string $local Local source filename (full path)
     * @param string $name
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function getFile($local, $name);

    /**
     * @param string $name Relative path
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function deleteFile($name);


    /**
     * Force disconnect, this method is very helpful when you need to release
     * connection resource to remote service.
     */
    public function disconnect();
}