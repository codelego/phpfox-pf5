<?php

namespace Neutron\User\Model;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new User([
            'user_id'       => 1,
            'role_id'       => 1,
            'user_photo_id' => 0,
            'gender_id'     => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'namnv',
            'fullname'      => 'Nam Nguyen',
            'email'         => 'vanlk@younetco.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created_at'    => '2016-10-25 12:03:28',
        ]);

        $this->assertSame('user', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getRoleId());
        $this->assertSame(0, $obj->getUserPhotoId());
        $this->assertSame(0, $obj->getGenderId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->getViewId());
        $this->assertSame('namnv', $obj->getUsername());
        $this->assertSame('Nam Nguyen', $obj->getFullname());
        $this->assertSame('vanlk@younetco.com', $obj->getEmail());
        $this->assertSame('en_US', $obj->getLocaleId());
        $this->assertSame('GMT+7', $obj->getTimezone());
        $this->assertSame('2016-10-25 12:03:28', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new User();

        // set data
        $obj->setId(1);
        $obj->setRoleId(1);
        $obj->setUserPhotoId(0);
        $obj->setGenderId(0);
        $obj->setStatusId(0);
        $obj->setViewId(0);
        $obj->setUsername('namnv');
        $obj->setFullname('Nam Nguyen');
        $obj->setEmail('vanlk@younetco.com');
        $obj->setLocaleId('en_US');
        $obj->setTimezone('GMT+7');
        $obj->setCreatedAt('2016-10-25 12:03:28');

        // assert same data
        $this->assertSame('user', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getRoleId());
        $this->assertSame(0, $obj->getUserPhotoId());
        $this->assertSame(0, $obj->getGenderId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->getViewId());
        $this->assertSame('namnv', $obj->getUsername());
        $this->assertSame('Nam Nguyen', $obj->getFullname());
        $this->assertSame('vanlk@younetco.com', $obj->getEmail());
        $this->assertSame('en_US', $obj->getLocaleId());
        $this->assertSame('GMT+7', $obj->getTimezone());
        $this->assertSame('2016-10-25 12:03:28', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new User([
            'user_id'       => 1,
            'role_id'       => 1,
            'user_photo_id' => 0,
            'gender_id'     => 0,
            'status_id'     => 0,
            'view_id'       => 0,
            'username'      => 'namnv',
            'fullname'      => 'Nam Nguyen',
            'email'         => 'unitest@younetco.com',
            'locale_id'     => 'en_US',
            'timezone'      => 'GMT+7',
            'created_at'    => '2016-10-25 12:03:28',
        ]);

        $obj->save();

        /** @var User $obj */
        $obj = \Phpfox::with('user')
            ->select()
            ->where('user_id=?', 1)
            ->first();

        $this->assertSame('user', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(1, $obj->getRoleId());
        $this->assertSame(0, $obj->getUserPhotoId());
        $this->assertSame(0, $obj->getGenderId());
        $this->assertSame(0, $obj->getStatusId());
        $this->assertSame(0, $obj->getViewId());
        $this->assertSame('namnv', $obj->getUsername());
        $this->assertSame('Nam Nguyen', $obj->getFullname());
        $this->assertSame('vanlk@younetco.com', $obj->getEmail());
        $this->assertSame('en_US', $obj->getLocaleId());
        $this->assertSame('GMT+7', $obj->getTimezone());
        $this->assertSame('2016-10-25 12:03:28', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('user')
            ->delete()
            ->where('user_id=?', 1)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('user')
            ->delete()
            ->where('user_id=?', 1)
            ->execute();
    }
}