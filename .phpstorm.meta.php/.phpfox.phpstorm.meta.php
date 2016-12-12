<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'assets'               => \Phpfox\Assets\AssetsFacades::class,
        'commands'             => \Phpfox\Command\CommandManager::class,
        'router'               => \Phpfox\Router\Router::class,
        'router.filters'       => \Phpfox\Router\FilterContainer::class,
        'session'              => \Phpfox\Session\SessionManager::class,
        'session.save_handler' => \Phpfox\Session\SessionInterface::class,
        'mvc.response'         => \Phpfox\Mvc\MvcResponse::class,
        'mvc.request'          => \Phpfox\Mvc\MvcRequest::class,
        'mvc.dispatch'         => \Phpfox\Mvc\MvcDispatch::class,
        'mvc.events'           => \Phpfox\Mvc\MvcEventManager::class,
        'mvc.events.loader'    => \Phpfox\Mvc\MvcEventLoaderInterface::class,
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
        'auth'                 => \Phpfox\Authentication\AuthFacades::class,
        'auth.factory'         => \Phpfox\Authentication\AuthFactoryInterface::class,
        'form.render'          => \Phpfox\Form\FormFacades::class,
        'form.factory'         => \Phpfox\Form\FormFactory::class,

        'view.template' => \Phpfox\View\PhpTemplate::class,
        'view.layout'   => \Phpfox\View\ViewLayout::class,

        'controller.provider' => \Phpfox\Mvc\ControllerProviderInterface::class,
        // package
        'package.loader'      => \Phpfox\Package\PackageLoaderInterface::class,

        // log section
        'main.log'            => \Phpfox\Logger\LogContainer::class,
        'dev.log'             => \Phpfox\Logger\LogContainer::class,
        'db'                  => \Phpfox\Db\DbAdapterInterface::class,

        'image' => \Intervention\Image\ImageManager::class,

        // user
        'user.verify_email'   => \Neutron\User\Service\VerifyEmail::class,
        'user.browse'         => \Neutron\User\Service\Browse::class,
    ]));

    override(\Phpfox::build(0), map([
        'assets'               => \Phpfox\Assets\AssetsFacades::class,
        'commands'             => \Phpfox\Command\CommandManager::class,
        'router'               => \Phpfox\Router\Router::class,
        'session'              => \Phpfox\Session\SessionManager::class,
        'session.save_handler' => \Phpfox\Session\SessionInterface::class,
        'mvc.response'         => \Phpfox\Mvc\MvcResponse::class,
        'mvc.request'          => \Phpfox\Mvc\MvcRequest::class,
        'mvc.dispatch'         => \Phpfox\Mvc\MvcDispatch::class,
        'mvc.events'           => \Phpfox\Event\EventManager::class,
        'mvc.events.loader'    => \Phpfox\Event\EventLoaderInterface::class,
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
        'auth'                 => \Phpfox\Authentication\AuthFacades::class,
        'auth.factory'         => \Phpfox\Authentication\AuthFactoryInterface::class,
        'form.render'          => \Phpfox\Form\FormFacades::class,
        'form.factory'         => \Phpfox\Form\FormFactory::class,

        // log section
        'main.log'             => \Phpfox\Logger\LogContainer::class,
        'dev.log'              => \Phpfox\Logger\LogContainer::class,

        // user
        'user.verify_email'    => \Neutron\User\Service\VerifyEmail::class,
        'user.browse'          => \Neutron\User\Service\Browse::class,
    ]));
}