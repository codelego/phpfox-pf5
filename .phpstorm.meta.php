<?php
namespace PHPSTORM_META {

    use Phpfox\Cache\CacheStorageInterface;

    override(\Phpfox::get(0), map([
        '' => '@',


        'cache' => CacheStorageInterface::class,
    ]));
}