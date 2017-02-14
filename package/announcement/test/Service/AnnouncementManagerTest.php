<?php

namespace Neutron\Announcement\Service;


class AnnouncementManagerTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AnnouncementManager();

        $this->assertEmpty($obj->findByUser(1));
    }
}
