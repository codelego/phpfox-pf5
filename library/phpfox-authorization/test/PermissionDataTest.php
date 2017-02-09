<?php

namespace Phpfox\Authorization;


class PermissionDataTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $data = new PermissionData(1, [
            'is_admin'      => 1,
            'is_staff'      => 0,
            'is_registered' => 12,
        ]);

        $this->assertEquals(1, $data->getRoleId());
        $this->assertEquals(1, $data->get('is_admin'));
        $this->assertEquals(0, $data->get('is_staff'));
        $this->assertEquals(12, $data->get('is_registered'));
    }
}
