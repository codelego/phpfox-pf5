<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'commands'          => \Phpfox\Command\CommandManager::class,
        'mvc.response'      => \Phpfox\Mvc\MvcResponse::class,
        'mvc.request'       => \Phpfox\Mvc\MvcRequest::class,
        'mvc.dispatch'      => \Phpfox\Mvc\MvcDispatch::class,
        'cache'             => \Phpfox\Cache\CacheStorageInterface::class,
        'cache.local'       => \Phpfox\Cache\FilesCacheStorage::class,
        'cache.memcache'    => \Phpfox\Cache\MemcacheCacheStorage::class,
        'cache.memcached'   => \Phpfox\Cache\MemcachedCacheStorage::class,
        'storage.manager'   => \Phpfox\Storage\FileStorageManagerInterface::class,
        'storage.file_name' => \Phpfox\Storage\FileNameSupport::class,
        'storage.local'     => \Phpfox\Storage\LocalFileStorage::class,
        'storage.ftp'       => \Phpfox\Storage\FtpFileStorage::class,
        'storage.ssh2'      => \Phpfox\Storage\Ssh2FileStorage::class,
        // log section
        'main.log'          => \Phpfox\Logger\LogContainer::class,
        'dev.log'           => \Phpfox\Logger\LogContainer::class,
    ]));
}