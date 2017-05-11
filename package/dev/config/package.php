<?php

namespace Neutron\Dev;


return [
    'templates' => _view_map([
        'default' => [
            'dev' => 'package/dev/view',
        ],
    ]),
    'services'  => [
        'dev.code_generator' => [null, Service\CodeGenerator::class],
    ],
];