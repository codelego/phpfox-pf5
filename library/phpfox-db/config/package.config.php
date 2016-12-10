<?php

namespace Phpfox\Db;

return [
    'psr4'     => [
        'Phpfox\\Db\\' => [
            'library/phpfox-db/src',
            'library/phpfox-db/test',
        ],
    ],
    'services' => [
        'db'            => [DbAdapterFactory::class, null, 'default'],
        'table_factory' => [null, DbTableGatewayFactory::class],
    ],
];