<?php

namespace PHPSTORM_META {

    override(\Phpfox::get(0), map([
        'main.log'            => \Phpfox\Logger\LogContainer::class,
        'cache.local'         => \Phpfox\Cache\CacheStorageInterface::class,
        'mvc.dispatch'        => \Phpfox\Action\Dispatcher::class,
        'mvc.request'         => \Phpfox\Action\Request::class,
        'mvc.response'        => \Phpfox\Action\Response::class,
        'controller.provider' => \Phpfox\Package\ActionProvider::class,
        'db'                  => \Phpfox\Db\DbAdapterInterface::class,
        'manager'             => \Phpfox\Support\ServiceManager::class,
        'validator'           => \Phpfox\Validate\ValidateManager::class,
    ]));
}