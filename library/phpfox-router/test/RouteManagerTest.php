<?php

namespace Phpfox\Router;


class RouteManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testService()
    {
        $routing = \Phpfox::get('router');

        $this->assertNotNull($routing, 'Can not init routing service');
    }

    public function testLogin()
    {
        $routing = \Phpfox::get('router');

        $result = $routing->resolve('login', null, null, null);

        $this->assertNotNull($result);

    }

    public function testProfile()
    {
        $routing = \Phpfox::get('router');

        \Phpfox::get('router.filters')->get('@profile')->cache('nam.ngvan', true);

        echo \Phpfox::get('router')->getUrl('profile/members',
            ['name' => 'nam.ngvan']);

        $result = $routing->resolve('nam.ngvan/members', null, null, null);

        $this->assertEquals('User\Controller\IndexController',
            $result->getControllerName());
    }
}
