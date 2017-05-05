<?php

namespace Neutron\Core\Service;


use Phpfox\Session\SessionFactoryInterface;

class SessionFactory implements SessionFactoryInterface
{
    public function factory()
    {
        $ref = $this->getConfigs();

        $class = _param('session.drivers', $ref['driver']);

        return new $class($ref['configs']);
    }

    /**
     * @return array
     * @ignore
     */
    protected function getConfigs()
    {
        $row = _service('db')->select('*')
            ->from(':session_driver')
            ->where('is_default=?', 1)
            ->limit(1, 0)
            ->execute()
            ->first();

        $params = [];

        if (!empty($row['params'])) {
            $params = json_decode($row['params'], true);
        }

        $driver = $row['driver_id'];

        return [
            'driver'  => $driver,
            'configs' => $params,
        ];
    }
}