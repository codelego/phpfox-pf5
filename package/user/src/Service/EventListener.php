<?php

namespace Neutron\User\Service;

use Phpfox\Event\EventListenerInterface;

class EventListener implements EventListenerInterface
{
    public function onSiteStatistics()
    {
        $totalUser = _with('user')
            ->select()
            ->count();

        return [
            [
                'label' => _text('Total Member'),
                'value' => $totalUser,
            ],
        ];
    }
}