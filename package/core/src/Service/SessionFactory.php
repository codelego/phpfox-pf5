<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreAdapter;
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

        $identity = _param('core.default_session_id');
        $adapter = _get('core.adapter')->getAdapterById($identity);
        $driverId = 'files';
        $configs = [];

        if ($adapter instanceof CoreAdapter) {
            $driverId = $adapter->getDriverId();
            $configs = (array)json_decode($adapter->getParams(), true);
        }

        return [
            'driver'  => $driverId,
            'configs' => $configs,
        ];
    }
}