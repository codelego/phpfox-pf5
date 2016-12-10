<?php

namespace Phpfox\Command;

return [
    'psr4'        => [
        'Phpfox\\Command\\' => [
            'library/phpfox-command/src',
            'library/phpfox-command/test',
        ],
    ],
    'commands'    => [
        'update-package-info' => UpdatePackageInformation::class,
    ],
    'services' => [
        'commands' => [null, CommandManager::class,],
    ],
];