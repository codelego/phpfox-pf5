<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'user.verify_email' => \Neutron\User\Service\VerifyEmail::class,
    ]));

    override(\Phpfox::get(0), map([
        'commands'             => \Phpfox\Command\CommandManager::class,
        'session'              => \Phpfox\Session\SessionManager::class,
        'session.save_handler' => \Phpfox\Session\SessionHandlerInterface::class,
        'mvc.response'         => \Phpfox\Mvc\MvcResponse::class,
        'mvc.request'          => \Phpfox\Mvc\MvcRequest::class,
        'mvc.dispatch'         => \Phpfox\Mvc\MvcDispatch::class,
        'cache'                => \Phpfox\Cache\CacheStorageInterface::class,
        'cache.local'          => \Phpfox\Cache\FilesCacheStorage::class,
        'cache.memcache'       => \Phpfox\Cache\MemcacheCacheStorage::class,
        'cache.memcached'      => \Phpfox\Cache\MemcachedCacheStorage::class,
        'storage.manager'      => \Phpfox\Storage\FileStorageManagerInterface::class,
        'storage.file_name'    => \Phpfox\Storage\FileNameSupport::class,
        'storage.local'        => \Phpfox\Storage\LocalFileStorage::class,
        'storage.ftp'          => \Phpfox\Storage\FtpFileStorage::class,
        'storage.ssh2'         => \Phpfox\Storage\Ssh2FileStorage::class,
        'storage.factory'      => \Phpfox\Storage\FileStorageFactoryInterface::class,
        'mailer'               => \Phpfox\Mailer\MailFacades::class,
        'mailer.factory'       => \Phpfox\Mailer\MailTransportFactoryInterface::class,
        'models'               => \Phpfox\Model\GatewayManager::class,
        'models.factory'       => \Phpfox\Db\DbTableGatewayFactory::class,
        'package.loader'       => \Phpfox\Package\PackageLoaderInterface::class,
        'package'              => \Phpfox\Package\PackageManager::class,
        // log section
        'main.log'             => \Phpfox\Logger\LogContainer::class,
        'dev.log'              => \Phpfox\Logger\LogContainer::class,

        // user
        'user.verify_email'    => \Neutron\User\Service\VerifyEmail::class,
        'user.browse'          => \Neutron\User\Service\BrowseUser::class,
    ]));
}