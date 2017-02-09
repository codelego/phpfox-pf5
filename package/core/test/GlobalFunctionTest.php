<?php

namespace Neutron\Core;


class GlobalFunctionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetViewMaps()
    {
        $maps = _view_map([
            'default' => [
                'core'   => 'package/core/view',
                'layout' => 'package/core/layout/default',
            ],
            'admin'   => ['layout' => 'package/core/layout/admin'],
        ]);

        $this->assertArrayHasKey('default:core/error/404', $maps);
    }
}