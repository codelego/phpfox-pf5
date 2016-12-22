<?php

namespace Phpfox\Command;

return [
    'commands' => [
        'update-package-info' => UpdatePackageInformation::class,
    ],
    'services' => [
        'commands' => [null, CommandManager::class,],
    ],
];