<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'commands'     => \Phpfox\Command\CommandManager::class,
        'mvc.response' => \Phpfox\Mvc\MvcResponse::class,
        'mvc.request'  => \Phpfox\Mvc\MvcRequest::class,
        'cache'        => \Phpfox\Cache\CacheStorageInterface::class,
        'cache.local'  => \Phpfox\Cache\CacheStorageInterface::class,
        'file_storage' => \Phpfox\Storage\FileStorageManagerInterface::class,
        // log section
        'main.log'     => \Phpfox\Logger\LogContainer::class,
        'dev.log'      => \Phpfox\Logger\LogContainer::class,
    ]));
}