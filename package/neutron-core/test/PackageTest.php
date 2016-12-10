<?php

namespace Neutron\Core;


use Phpfox\Router\Parameters;

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
        /** @var Parameters $result */
        $result = \Phpfox::get('router')->run($url, null, null, null);

        $this->assertEquals($result->get('controller'), $controller);
        $this->assertEquals($result->get('action'), $action);
    }
}
