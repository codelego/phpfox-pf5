<?php
namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'cache'       => \Phpfox\Cache\CacheStorageInterface::class,
        'cache.local' => \Phpfox\Cache\CacheStorageInterface::class,
        'log'         => \Phpfox\Log\LogContainer::class,
    ]));
}