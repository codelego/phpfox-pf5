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

        return [
            'driver'  => 'database',
            'configs' => [],
        ];
    }
}