<?php

namespace Neutron\User\Service;


class AuthHistoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCleanup()
    {
        $obj = new AuthHistory();

        $this->assertTrue($obj->cleanup()->isValid());
    }
}
