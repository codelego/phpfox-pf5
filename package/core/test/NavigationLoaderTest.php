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

        $this->assertTrue($data['settings'] instanceof NavigationItem);
        $this->assertEquals('settings', $data['settings']->name);
        $this->assertEquals('core', $data['settings']->package_id);
        $this->assertEquals('Settings', $data['settings']->label);
        $this->assertEquals('route', $data['settings']->type);
    }
}
