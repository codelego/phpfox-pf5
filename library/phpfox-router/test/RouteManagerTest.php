<?php

namespace Phpfox\Router;


class RouteManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testService()
    {
        $routing = \Phpfox::getService('router');

        $this->assertNotNull($routing, 'Can not init routing service');
    }

    public function testLogin()
    {
        $routing = \Phpfox::getService('router');

        $result = $routing->resolve('login', null, null, null);

        $this->assertNotNull($result);

    }

    public function testProfile()
    {
        $routing = \Phpfox::getService('router');

        \Phpfox::getService('router.filters')->get('@profile')->cache('nam.ngvan', true);

        echo \Phpfox::getService('router')->getUrl('profile/members',
            ['name' => 'nam.ngvan']);

        $result = $routing->resolve('nam.ngvan/members', null, null, null);

        $this->assertEquals('User\Controller\IndexController',
            $result->getControllerName());
    }
}
