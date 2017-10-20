<?php

namespace Neutron\Announcement\Form;


class AddAnnouncementTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AddAnnouncement();

        $this->assertNotNull($obj->getElement('title'));
    }
}
