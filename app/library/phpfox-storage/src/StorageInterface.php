<?php

namespace Phpfox\Storage;

interface StorageInterface
{

    /**
     * @param string $name
     *
     * @return string
     */
    public function mapPath($name);

    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function mapUrl($name);

    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function mapCdnUrl($name);

    /**
     * @param string $name Filename
     *
     * @return mixed
     */
    public function getUrl($name);

    /**
     * @param  string $name
     *
     * @return mixed
     * @throws FileStorageException
     */
    public function getObject($name);

    /**
     * @param $data
     * @param $name
     *
     * @return bool
     * @throws FileStorageException
     */
    public function putObject($data, $name);

    /**
     * Copy from local to file service path.
     *
     * @param string $local local source filename (full path)
     * @param string $name  Relative path
     *
     * @return bool
     * @throws FileStorageException
     */
    public function putFile($local, $name);

    /**
     * @param string $local Local source filename (full path)
     * @param string $name
     *
     * @return bool
     * @throws FileStorageException
     */
    public function getFile($local, $name);

    /**
     * @param string $name Relative path
     *
     * @return bool
     * @throws FileStorageException
     */
    public function deleteFile($name);


    /**
     * Force release resource, this method is very helpful when you are using a
     * file for a short time when your process is running longer, Do not forget
     * call this method whenever you put/get/delete remote resource.
     *
     * Connection resource to remote service.
     */
    public function release();

}