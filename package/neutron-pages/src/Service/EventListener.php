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
    public function onMatchProfileName(&$params)
    {
        $id = isset($params['name']) ? $params['name'] : null;

        $item = \Phpfox::findById('pages', $id);

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