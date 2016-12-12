<?php
namespace Neutron\Pages\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{

    /**
     * @param array $params
     *
     * @return bool
     */
    public function onRouteFilter(&$params)
    {
        $id = isset($params['name']) ? $params['name'] : null;


        // is digit
        $item = \Phpfox::get('pages.browse')->findById($id);

        if (!$item) {
            return false;
        }

        $params['controller'] = 'pages.profile';

        return true;
    }

    function __call($name, $arguments)
    {
        // do nothings
    }
}