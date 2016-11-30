<?php

namespace Phpfox\RequireJs {

    return [
        'autoload.psr4' => [
            'Phpfox\\RequireJs\\' => [
                'library/phpfox-requirejs/src',
                'library/phpfox-requirejs/test',
            ],
        ],
        'service.map'   => [
            'requireJs' => [null, RequireJs::class,],
        ],
        'events'        => [
            'requireJs' => [
                'onAssetManagerGetHeader',
                'onAssetManagerGetFooter',
            ],
        ],
    ];
}
