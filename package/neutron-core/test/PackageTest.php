<?php

namespace Neutron\Core;


use Phpfox\Router\RouteResult;

class PackageTest extends \PHPUnit_Framework_TestCase
{

    public function provideRoute()
    {
        return [
            ['/', 'core.index', 'index'],
            ['admincp/core/settings', 'core.admin-settings', 'index'],
            ['admincp/core/settings/mail', 'core.admin-settings', 'mail'],
            [
                'admincp/core/settings/message',
                'core.admin-settings',
                'message',
            ],
        ];
    }


    /**
     * @param $url
     * @param $controller
     * @param $action
     *
     * @dataProvider provideRoute
     */
    public function testRoute($url, $controller, $action)
    {
        /** @var RouteResult $result */
        $result = \Phpfox::get('router')->resolve($url, null, null, null);

        $this->assertEquals($result->getController(), $controller);
        $this->assertEquals($result->getAction(), $action);
    }
}
