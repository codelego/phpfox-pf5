<?php

namespace Neutron\Core\Form\Admin\StorageDriver;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;

class SelectStorageDriver extends SelectCoreDriver
{
    protected $driverType = 'storage';

    protected $cancelUrl = 'admin.core.storage';
}