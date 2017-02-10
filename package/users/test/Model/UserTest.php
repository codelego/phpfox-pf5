<?php

namespace Neutron\User\Model;


class UserTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new User([
            'user_id'       => 11,
            'role_id'       => 2,
            'user_photo_id' => 0,
            'gender_id'     => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'profile-11',
            'fullname'      => 'Jessie Bernhard',
            'email'         => 'gChamplin@hotmail.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created'       => 1477390174,
        ]);

        $this->assertSame('user', $obj->getModelId());
        $this->assertSame(11, $obj->getUserId());
        $this->assertSame(11, $obj->getId());
        $this->assertSame(2, $obj->getRoleId());
        $this->assertSame(0, $obj->getGenderId());
        $this->assertSame('profile-11', $obj->getUsername());
        $this->assertSame('Jessie Bernhard', $obj->getName());
        $this->assertSame('Jessie Bernhard', $obj->getFullname());
        $this->assertSame('gChamplin@hotmail.com', $obj->getEmail());
        $this->assertSame('en_US', $obj->getLocaleId());
        $this->assertSame('GMT+7', $obj->getTimezone());
        $this->assertSame(1477390174, $obj->getCreated());
    }
}
