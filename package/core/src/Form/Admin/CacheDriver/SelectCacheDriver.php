<?php

namespace Neutron\Core\Form\Admin\CacheDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectCacheDriver extends SelectCoreDriver
{
    protected $driverType = 'cache';

    protected $cancelUrl = 'admin.core.cache';
}