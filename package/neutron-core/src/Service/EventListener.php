<?php

namespace Neutron\Core\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{
    public function onRouteAdminFilter(&$params)
    {
        if (empty($params)) {
            $params['controller'] = 'core.admin-dashboard';
            $params['action'] = 'index';
        }

        $retain = isset($params['retain']) ? $params['retain'] : null;

        $arr = explode('/', $retain);

        if (empty($arr[0])) {
            $id = 'core.admin-dashboard';
        } elseif (!empty($arr[1])) {
            $id = $arr[0] . '.admin-' . $arr[1];
        } else {
            $id = $arr[0] . '.admin-index';
        }

        if (\Phpfox::get('controller.provider')->get($id)) {
            $params['controller'] = $id;
            if (!empty($arr[2])) {
                $params['action'] = $arr[2];
            } else {
                $params['action'] = 'index';
            }

        }

        if (!isset($params['controller'])) {
            $params['controller'] = 'core.admin-dashboard';
            $params['action'] = 'index';
        }

        return true;
    }

    /**
     * @param $params
     *
     * @return bool
     * getUrl(':admincp',['core/dashboard'])
     */
    public function onRouteAdminCompile(&$params)
    {
        if (isset($params[0])) {
            return 'admincp/' . $params[0];
        }

        return true;
    }

    public function __call($name, $arguments)
    {
        // do nothing
    }
}