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
        $class = \Phpfox::getParam('mailer.transports', $driver);

        return new $class($this->map[$id]['configs']);
    }

    private function initialize()
    {
        $this->initialized = true;


        $rows = \Phpfox::db()->select('*')->from(':mail_transport')
            ->where('is_active=?', 1)
            ->execute()->all();

        foreach ($rows as $row) {
            $configs = $row['params'];

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