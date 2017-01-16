<?php

namespace Neutron\Core;


class GlobalFunctionTest extends \PHPUnit_Framework_TestCase
{

    public function testGetViewMaps()
    {
        $maps = _view_map('neutron-core/view');

        $this->assertArrayHasKey('default/core.error.404', $maps);
    }
}