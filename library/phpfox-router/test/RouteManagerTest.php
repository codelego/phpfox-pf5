<?php

namespace Phpfox\Router;


class RouteManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testService()
    {
        $routing = service('router');

        $this->assertNotNull($routing, 'Can not init routing service');
    }

    public function testLogin()
    {
        $routing = service('router');

        $result = $routing->resolve('login', null, null, null);

        $this->assertNotNull($result);

    }

    public function testProfile()
    {
        $routing = service('router');

        service('router.filters')->get('@profile')->cache('nam.ngvan', true);

        echo service('router')->getUrl('profile/members',
            ['name' => 'nam.ngvan']);

        $result = $routing->resolve('nam.ngvan/members', null, null, null);

        $this->assertEquals('User\Controller\IndexController',
            $result->getControllerName());
    }
}
