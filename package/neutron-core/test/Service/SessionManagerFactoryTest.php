<?php

namespace Neutron\Core\Service;


class SessionManagerFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testFactory()
    {
        \Phpfox::get('session')->start();
    }
}
