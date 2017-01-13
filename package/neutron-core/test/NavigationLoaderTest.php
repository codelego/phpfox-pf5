<?php

namespace Neutron\Core\Service;


use Phpfox\Navigation\NavigationItem;

class NavigationLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function testLoadCoreMini()
    {
        $loader = new NavigationLoader();

        $data = $loader->load('admin');

        $this->assertTrue($data['dashboard'] instanceof NavigationItem);
        $this->assertEquals('dashboard', $data['dashboard']->name);
        $this->assertEquals('core', $data['dashboard']->package_id);
        $this->assertEquals('Dashboard', $data['dashboard']->label);
        $this->assertEquals('route', $data['dashboard']->type);

        $this->assertTrue($data['packages'] instanceof NavigationItem);
        $this->assertEquals('packages', $data['packages']->name);
        $this->assertEquals('core', $data['packages']->package_id);
        $this->assertEquals('Packages', $data['packages']->label);
        $this->assertEquals('route', $data['packages']->type);

        $this->assertTrue($data['packages'] instanceof NavigationItem);
        $this->assertEquals('members', $data['members']->name);
        $this->assertEquals('core', $data['members']->package_id);
        $this->assertEquals('Members', $data['members']->label);
        $this->assertEquals('route', $data['members']->type);

        $this->assertTrue($data['settings'] instanceof NavigationItem);
        $this->assertEquals('settings', $data['settings']->name);
        $this->assertEquals('core', $data['settings']->package_id);
        $this->assertEquals('Settings', $data['settings']->label);
        $this->assertEquals('route', $data['settings']->type);
    }
}
