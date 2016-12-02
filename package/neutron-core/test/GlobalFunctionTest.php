<?php

namespace Neutron\Core;


class GlobalFunctionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetViewMaps()
    {
        $maps = _get_view_map([
            'core'    => 'neutron-core/view',
            'galaxy@' => 'neutron-theme-galaxy/view',
        ]);

        $this->assertArrayHasKey('core.error.404', $maps);
        $this->assertArrayHasKey('galaxy@core.error.404', $maps);
    }
}