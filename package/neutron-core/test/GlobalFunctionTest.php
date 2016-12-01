<?php

namespace Neutron\Core;


class GlobalFunctionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetViewMaps()
    {
        $array = [
            'core'    => 'neutron-core/view',
            'galaxy@' => 'neutron-theme-galaxy/view',
        ];
        $maps = [];

        _array_merge_recursive($maps, _get_view_map($array));

        $this->assertArrayHasKey('core.error.404', $maps);
        $this->assertArrayHasKey('galaxy@core.error.404', $maps);
        var_export($maps);
    }
}