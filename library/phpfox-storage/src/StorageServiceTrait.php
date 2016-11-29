<?php

namespace Phpfox\Storage;

Trait StorageServiceTrait
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
    protected $baseCdn;

    /**
     * @var int
     */
    protected $directoryPermission = 0755;

    /**
     * @var int
     */
    protected $filePermission = 0644;

    public function getUrl($name)
    {
        return $this->baseUrl . $name;
    }

    public function getPath($name)
    {
        return $this->basePath . $name;
    }

    public function cdnUrl($name)
    {
        return $this->baseCdn . $name;
    }

    public function url($name)
    {
        return $this->baseCdn . $name;
    }
}