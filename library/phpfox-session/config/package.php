<?php

namespace Phpfox\Session {

    return [
        'autoload.psr4' => [
            'Phpfox\\Session\\' => [
                'library\phpfox-session\src',
                'library\phpfox-session\test',
            ],
        ],
        'service.map'   => [
            'session' => [SampleSessionFactory::class, null, null],
        ],
    ];
}
