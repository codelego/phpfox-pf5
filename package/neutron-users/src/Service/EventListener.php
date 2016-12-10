<?php

namespace Neutron\User\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    /**
     * @param array $params
     *
     * @return bool
     */
    public function onMatchProfileName(&$params)
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