<?php

namespace Neutron\Cms;

return [
    'psr4'        => [
        'Neutron\\Cms\\' => [
            'package/neutron-cms/src',
            'package/neutron-cms/test',
        ],
    ],
    'services' => [
        'cms.callback' => [null, EventListener::class],
    ],
];