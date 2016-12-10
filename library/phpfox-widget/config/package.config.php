<?php
namespace Phpfox\Widget {

    return [
        'psr4' => [
            'Phpfox\\Widget\\' => [
                'library/phpfox-widget/src',
                'library/phpfox-widget/test',
            ],
        ],
        'services'   => [
            'widgets' => [null, WidgetManager::class,],
        ],
    ];
}
