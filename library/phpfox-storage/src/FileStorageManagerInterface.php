<?php

namespace Phpfox\Storage;

interface FileStorageManagerInterface
{
    /**
     * @param string $id
     * @param string $name
     *
     * @return string
     */
    public function mapPath($id, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function mapUrl($id, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function mapCdnUrl($id, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Filename
     *
     * @return string
     */
    public function getUrl($id, $name);

    /**
     * @param string $id
     *
     * @return FileStorageInterface
     * @throws FileStorageException
     */
    public function get($id);

    /**
     * @param string               $id
     * @param FileStorageInterface $service
     *
     * @return mixed
     */
    public function set($id, FileStorageInterface $service);

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
     * @throws FileStorageException
     */
    public function putFile($id, $local, $name);

    /**
     * @param string $id    Service Id
     * @param string $local Local source filename (full path)
     * @param string $name
     *
     * @return bool
     * @throws FileStorageException
     */
    public function getFile($id, $local, $name);

    /**
     * @param string $id   Service Id
     * @param string $name Relative path
     *
     * @return bool
     * @throws FileStorageException
     */
    public function deleteFile($id, $name);

}