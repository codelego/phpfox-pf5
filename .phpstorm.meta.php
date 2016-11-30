<?php
namespace PHPSTORM_META {

    use Phpfox\Cache\CacheStorageInterface;
    use Phpfox\Log\LogContainer;

    override(\Phpfox::getService(0), map([
        '' => '@',

        'cache'       => CacheStorageInterface::class,
        'cache.local' => CacheStorageInterface::class,
        'log'         => LogContainer::class,
    ]));
}