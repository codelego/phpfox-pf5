<?php
namespace Phpfox\Storage;

interface StorageManagerInterface
{
    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function getUrl($id, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function cdnUrl($id, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function url($id, $name);

    /**
     * @param string $id
     * @param string $name
     *
     * @return string
     */
    public function getPath($id, $name);

    /**
     * @param string $id
     *
     * @return StorageServiceInterface
     * @trhows InvalidArgumentException
     */
    public function get($id);

    /**
     * @param string                  $id
     * @param StorageServiceInterface $service
     *
     * @return mixed
     */
    public function set($id, StorageServiceInterface $service);

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has($id);

    /**
     * Copy from local to file service path.
     *
     * @param string $id    Service Id
     * @param string $local local source filename (full path)
     * @param string $name  Relative path
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function putFile($id, $local, $name);

    /**
     * @param string $id    Service Id
     * @param string $local Local source filename (full path)
     * @param string $name
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function getFile($id, $local, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Relative path
     *
     * @return bool
     * @throws StorageServiceException
     */
    public function deleteFile($id, $name);

}