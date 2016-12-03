<?php

namespace Phpfox\Db;

return [
    'psr4' => [
        'Phpfox\\Db\\' => [
            'library/phpfox-db/src',
            'library/phpfox-db/test',
        ],
    ],
    'service.map'   => [
        'db' => [DbAdapterFactory::class, null, 'default'],
    ],
];