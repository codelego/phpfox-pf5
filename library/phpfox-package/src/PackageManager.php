<?php
namespace Phpfox\Package;

class PackageManager
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool
     */
    protected $initialized = false;

    /**
     * @return array
     */
    public function all()
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return $this->data;
    }

    protected function initialize()
    {
        $this->initialized = true;

        $this->data = \Phpfox::get('package.loader')->load();
    }

    public function get($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    public function has($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }
        return isset($this->data[$id]);
    }

    public function import($zip)
    {
        if (!class_exists('ZipArchive')) {
            throw new \InvalidArgumentException("Oops! ZipArchive extension is required.");
        }

    }

    public function export($id)
    {
        if (!class_exists('ZipArchive')) {
            throw new \InvalidArgumentException("Oops! ZipArchive extension is required.");
        }
    }
}