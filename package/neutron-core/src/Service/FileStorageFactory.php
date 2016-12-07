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
            $id = $this->fallback;
        } elseif ($id == 'default') {
            $id = $this->default;
        }

        if (!isset($this->map[$id])) {
            throw new \InvalidArgumentException("Can not initialize file storage '{$id}'");
        }

        $driver = $this->map[$id]['driver'];
        $class = \Phpfox::getParam('storage.drivers', $driver);

        return new $class($this->map[$id]['configs']);

    }

    protected function initialize()
    {
        $this->initialized = true;

        $rows = \Phpfox::getDb()->select('*')->from(':core_storage_driver')
            ->where('is_active=?', 1)->execute()->all();

        foreach ($rows as $row) {
            $configs = $row['json_configs'];

            $id = $row['id'];

            if (!empty($configs)) {
                $configs = json_decode($configs, true);
            }

            if ($row['is_default']) {
                $this->default = $row['id'];
            }

            if ($row['is_fallback']) {
                $this->fallback = $row['id'];
            }

            $this->map[$id] = [
                'driver'  => $row['driver'],
                'configs' => $configs,
            ];
        }
    }
}