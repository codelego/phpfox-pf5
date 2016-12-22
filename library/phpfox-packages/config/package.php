<?php

namespace Phpfox\Package;

return [
    'services' => [
        'package'             => PackageManager::class,
        'package.loader'      => [null, PackageLoader::class],
        'controller.provider' => [null, ControllerProvider::class],
        'models.provider'     => [null, ModelProvider::class],
    ],
];