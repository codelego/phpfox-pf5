<?php

namespace Neutron\User\Service;


use Phpfox\Auth\AuthInterface;

class AuthFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AuthFactory();

        $this->assertTrue($obj->factory(0) instanceof AuthInterface);
        $this->assertTrue($obj->factory(1) instanceof AuthInterface);
    }
}
