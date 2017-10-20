<?php

namespace Phpfox\Storage;

/**
 * Class FileStorageTrait
 *
 * Base trait attach to class implement FileStorageInterface
 *
 * <code>
 * class YourFileStorage{
 *     use FileStorageTrait;
 *
 *     function yourFunctionName(){
 *         $name =  'example_name';
 *         $path = $this->mapPath($name);
 *         ...
 *     }
 * }
 * </code>
 *
 * @link    http://php.net/manual/en/language.oop5.traits.php
 *
 * @package Phpfox\Storage
 */
Trait FileStorageTrait
{
    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string
     */
    protected $baseCdnUrl;

    /**
     * @var int
     */
    protected $directoryPermission = 0755;

    /**
     * @var int
     */
    protected $filePermission = 0644;

    public function mapUrl($name)
    {
        return $this->baseUrl . $name;
    }

    public function mapPath($name)
    {
        return $this->basePath . $name;
    }

    public function mapCdnUrl($name)
    {
        return $this->baseCdnUrl . $name;
    }

    public function getUrl($name)
    {
        return $this->baseCdnUrl . $name;
    }
}