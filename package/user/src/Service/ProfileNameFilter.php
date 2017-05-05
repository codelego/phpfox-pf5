<?php

namespace Neutron\User\Service;


class ProfileNameFilter
{
    public function onCompile(&$params)
    {
        if (empty($params['name'])) {
            return false;
        }

        return true;
    }

    /**
     * @param array $params
     *
     * @return bool
     */
    public function onMatch(&$params)
    {
        $name = isset($params['name']) ? $params['name'] : null;

        if (!$name) {
            return false;
        }


        $item = _service('user.browse')
            ->findByProfileName($name);

        if (!$item) {
            return false;
        }

        $params['controller'] = 'user.profile';

        return true;
    }
}