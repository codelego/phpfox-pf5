<?php
namespace Phpfox\Model;

return [
    'psr4'     => [
        'Phpfox\\Model\\' => [
            'library/phpfox-models/src',
            'library/phpfox-models/test',
        ],
    ],
    'services' => [
        'models' => [null, GatewayManager::class],
    ],
];