<?php

namespace Neutron\User\Service;

class EventListener
{
    public function onSiteStatistics()
    {
        $totalUser = _model('user')
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