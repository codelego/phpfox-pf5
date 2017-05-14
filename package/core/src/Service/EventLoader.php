<?php

namespace Neutron\Core\Service;

use Phpfox\Event\EventLoaderInterface;

class EventLoader implements EventLoaderInterface
{
    public function load()
    {
        $rows = _get('db')
            ->select('*')
            ->from(':core_event')
            ->order('event_name, priority', 1);

        $result = [];
        foreach ($rows->all() as $row) {
            $name = $row['event_name'];
            if (!isset($result[$name])) {
                $result[$name] = [];
            }

            $result[$name][] = $row['listener_name'];
        }
        return $result;
    }
}