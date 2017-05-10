<?php

namespace Neutron\Core\Service;

use Phpfox\Storage\FileStorageFactoryInterface;

class FileStorageFactory implements FileStorageFactoryInterface
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var mixed
     */
    protected $fallback;

    /**
     * @var bool
     */
    protected $initialized = false;

    public function factory($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        if (!$id) {
            $id = $this->default;
        } elseif ($id == 'fallback') {
            $id = $this->default;
        } elseif ($id == 'default') {
            $id = $this->default;
        }

        if (!isset($this->map[$id])) {
            throw new \InvalidArgumentException("Can not initialize file storage '{$id}'");
        }

        $driver = $this->map[$id]['driver'];
        $class = _param('storage.drivers', $driver);

        return new $class($this->map[$id]['configs']);

    }

    protected function initialize()
    {
        $this->initialized = true;

        $rows = _service('db')
            ->select('*')
            ->from(':storage_adapter')
            ->where('is_active=1')
            ->all();

        $this->default = _param('core', 'storage_id');

        if (!$this->default) {
            $this->default = 1;
        }

        foreach ($rows as $row) {
            $configs = $row['params'];
            $id = $row['adapter_id'];

            if (!empty($configs)) {
                $configs = json_decode($configs, true);
            }

            $this->map[$id] = [
                'driver'  => $row['driver_id'],
                'configs' => $configs,
            ];
        }
    }
}