<?php

namespace Phpfox\Db;

return [
    'services' => [
        'db'            => [DbAdapterFactory::class, null, 'default'],
        'table_factory' => [null, DbTableGatewayFactory::class],
    ],
];