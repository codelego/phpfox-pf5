<?php
namespace Phpfox\Widget {

    return [
        'autoload.psr4' => [
            'Phpfox\\Widget\\' => [
                'library/phpfox-widget/src',
                'library/phpfox-widget/test',
            ],
        ],
        'service.map'   => [
            'widgets' => [null, WidgetManager::class,],
        ],
    ];
}
