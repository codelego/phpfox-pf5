<?php

namespace Phpfox\Mysqli {

    return [
        'autoload.psr4' => [
            'Phpfox\\Mysqli\\' => [
                'library\phpfox-mysqli\src',
                'library\phpfox-mysqli\test',
            ],
        ],
        'db.drivers'    => [
            'mysqli' => MysqliAdapter::class,
        ],
    ];
}
