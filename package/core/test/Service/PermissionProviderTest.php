<?php

namespace Neutron\Core\Service;

use Phpfox\Authorization\PermissionData;

class PermissionProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testSuper()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.1');

        $obj = new PermissionProvider();

        $result = $obj->load(1);

        $this->assertTrue($result instanceof PermissionData);
    }

    public function testAdmin()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.2');

        $obj = new PermissionProvider();

        $result = $obj->load(2);

        $this->assertTrue($result instanceof PermissionData);
    }

    public function testRegistered()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.5');

        $obj = new PermissionProvider();

        $result = $obj->load(5);

        $this->assertTrue($result instanceof PermissionData);
    }

    public function testBanned()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.6');

        $obj = new PermissionProvider();

        $result = $obj->load(6);

        $this->assertTrue($result instanceof PermissionData);
    }

    public function testGuest()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.7');

        $obj = new PermissionProvider();

        $result = $obj->load(7);

        $this->assertTrue($result instanceof PermissionData);
    }

    public function testNoRole()
    {

        // clear cache
        \Phpfox::get('cache.local')
            ->deleteItem('permission_provider.-1');

        $obj = new PermissionProvider();

        $result = $obj->load(-1);

        $this->assertTrue($result instanceof PermissionData);
    }
}
