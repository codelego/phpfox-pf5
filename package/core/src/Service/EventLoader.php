<?php

namespace Neutron\Core\Service;

use Phpfox\Event\EventLoaderInterface;

class EventLoader implements EventLoaderInterface
{
    public function load()
    {
        $rows = \Phpfox::db()
            ->select('*')
            ->from(':core_event')
            ->where('1')
            ->order('event_name', 'priority')
            ->execute()
            ->all();

        $result = [];
        foreach ($rows as $row) {
            $name = $row['event_name'];

            if (!isset($result[$name])) {
                $result[$name] = [];
            }

            $result[$name][] = $row['listener_name'];
        }

        return $result;
    }
}