<?php

namespace Neutron\Message;

return [
    'psr4'        => [
        'Neutron\\Message\\' => [
            'library/neutron-message/src',
            'library/neutron-message/test',
        ],
    ],
    'services' => [
        'message.callback' => [null, EventListener::class],
    ],
];