<?php
namespace Phpfox\Authorization;


class AuthorizationManagerTest extends \PHPUnit_Framework_TestCase
{


    public function testBase()
    {
        $mn = new AuthorizationManager();

        $this->assertNull($mn->hasPermission(1, 'any'));
    }
}
