<?php

namespace Neutron\User;


class Callback
{

    /**
     * @param array $params
     *
     * @return bool
     */
    public function checkProfileName(&$params)
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