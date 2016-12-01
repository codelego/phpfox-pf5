<?php
namespace Phpfox\View;

return [
    'autoload.psr4' => [
        'Phpfox\\View\\' => [
            'library/phpfox-view/src',
            'library/phpfox-view/test',
        ],
    ],
    'service.map'   => [
        'view.render' => [null, PhpTemplate::class],
        'view.layout' => [null, ViewLayout::class],
    ],
];