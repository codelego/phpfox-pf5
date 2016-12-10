<?php

namespace Neutron\Message;

return [
    'psr4'     => [
        'Neutron\\Message\\' => [
            'library/neutron-messages/src',
            'library/neutron-messages/test',
        ],
    ],
    'services' => [
        'message.callback' => [null, Service\EventListener::class],
    ],
];