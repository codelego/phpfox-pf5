<?php

namespace Phpfox\Db;

return [
    'autoload.psr4' => [
        'Phpfox\\Db\\' => [
            'library\phpfox-db\src',
            'library\phpfox-db\test',
        ],
    ],
    'service.map'   => [
        'db' => [AdapterFactory::class, null, 'default'],
    ],
];