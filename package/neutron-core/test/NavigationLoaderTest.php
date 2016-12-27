<?php

namespace Neutron\Core\Service;


class NavigationLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function testLoadCoreMini()
    {
        $loader = new NavigationLoader();

        $data = $loader->load('mini');
        $this->assertArrayHasKey('core_mini_admin', $data);
        $this->assertArrayHasKey('core_mini_profile', $data);
        $this->assertArrayHasKey('core_mini_settings', $data);
        $this->assertArrayHasKey('core_mini_auth', $data);
        $this->assertArrayHasKey('core_mini_signup', $data);
    }

    public function testLoadCoreMain()
    {
        $loader = new NavigationLoader();

        $data = $loader->load('main');

        $this->assertArrayHasKey('core_main_home', $data);
        $this->assertArrayHasKey('core_main_user', $data);
        $this->assertArrayHasKey('core_main_invite', $data);
    }

    public function testLoadCoreAdminMain()
    {
        $loader = new NavigationLoader();

        $data = $loader->load('admin');

        $this->assertArrayHasKey('core_admin_main_home', $data);
        $this->assertArrayHasKey('core_admin_main_home', $data);
        $this->assertArrayHasKey('core_admin_main_settings', $data);
    }
}
