<?php

namespace Neutron\User\Service;


class AuthHistoryManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testCleanup()
    {
        $obj = new AuthHistoryManager();

        $this->assertTrue($obj->cleanup()->isValid());
    }

}
