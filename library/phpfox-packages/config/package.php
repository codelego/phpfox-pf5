<?php

namespace Phpfox\Package;

return [
    'services' => [
        'package'             => PackageManager::class,
        'package.loader'      => [null, BootLoader::class],
        'controller.provider' => [null, ActionProvider::class],
        'models.provider'     => [null, ModelProvider::class],
        'router.provider'     => [null, RouterProvider::class],
    ],
];