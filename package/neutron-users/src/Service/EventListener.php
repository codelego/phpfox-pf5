<?php

namespace Neutron\User\Service;

use Neutron\User\Model\User;
use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    public function onRouteCompile(&$params)
    {
        if (!isset($params['profile'])) {
            return false;
        }

        if (!$params['profile'] instanceof User) {
            return false;
        }

//        $params['name'] = $params['profile']->getProfileName();

        $params['profile']->getProfileName();

        return true;
    }

    /**
     * @param array $params
     *
     * @return bool
     */
    public function onRouteFilter(&$params)
    {
        static $cached = [];

        $name = isset($params['name']) ? $params['name'] : null;


        $item = \Phpfox::get('user.browse')
            ->findByProfileName($name);

        if (!$item) {
            return $cached[$name] = false;
        }

        $params['controller'] = 'user.profile';

        return $cached[$name] = true;
    }

    public function __call($method, $args)
    {
        // do nothing
    }
}