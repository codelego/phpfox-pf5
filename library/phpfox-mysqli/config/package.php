<?php

namespace Phpfox\Mysqli {

    return [
        'psr4' => [
            'Phpfox\\Mysqli\\' => [
                'library/phpfox-mysqli/src',
                'library/phpfox-mysqli/test',
            ],
        ],
        'db.drivers'    => [
            'mysqli' => MysqliDbAdapter::class,
        ],
    ];
}
