<?php

namespace Neutron\Core\Service;

use Phpfox\Mailer\MailTransportFactoryInterface;

class MailTransportFactory implements MailTransportFactoryInterface
{
    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var mixed
     */
    protected $fallback;

    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var bool
     */
    protected $initialized = false;

    public function factory($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        if (!$id || $id == 'default') {
            $id = $this->default;
        } elseif ($id == 'fallback') {
            $id = $this->fallback;
        }

        if (!isset($this->map[$id])) {
            throw new \InvalidArgumentException("Can not initialize mail transport '{$id}'");
        }

        $driver = $this->map[$id]['driver'];
        $class = _param('mailer.transports', $driver);

        return new $class($this->map[$id]['configs']);
    }

    private function initialize()
    {
        $this->initialized = true;


        $rows = _get('db')->select('*')->from(':mail_adapter')
            ->where('is_active=?', 1)
            ->execute()->all();

        foreach ($rows as $row) {
            $configs = $row['params'];

            $id = $row['adapter_id'];

            if (!empty($configs)) {
                $configs = json_decode($configs, true);
            }

            if ($row['is_default']) {
                $this->default = $row['adapter_id'];
            }

            if ($row['is_fallback']) {
                $this->fallback = $row['adapter_id'];
            }

            $this->map[$id] = [
                'driver'  => $row['driver_id'],
                'configs' => $configs,
            ];
        }
    }
}