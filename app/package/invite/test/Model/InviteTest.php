<?php

namespace Neutron\Invite\Model;

class InviteTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Invite([
            'id'          => 'tad',
            'user_id'     => 2,
            'recipient'   => 'lallow',
            'new_user_id' => 25,
            'type_id'     => 'user_invite',
            'created_at'  => '2015-11-22 00:00:00',
            'expires_at'  => '2016-11-12 00:00:00',
            'message'     => '[example message]',
        ]);

        $this->assertSame('invite', $obj->getModelId());
        $this->assertSame('tad', $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('lallow', $obj->getRecipient());
        $this->assertSame(25, $obj->getNewUserId());
        $this->assertSame('user_invite', $obj->getTypeId());
        $this->assertSame('2015-11-22 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2016-11-12 00:00:00', $obj->getExpiresAt());
        $this->assertSame('[example message]', $obj->getMessage());
    }

    public function testParameters()
    {
        $obj = new Invite();

        // set data
        $obj->setId('tad');
        $obj->setUserId(2);
        $obj->setRecipient('lallow');
        $obj->setNewUserId(25);
        $obj->setTypeId('user_invite');
        $obj->setCreatedAt('2015-11-22 00:00:00');
        $obj->setExpiresAt('2016-11-12 00:00:00');
        $obj->setMessage('[example message]');

        // assert same data
        $this->assertSame('invite', $obj->getModelId());
        $this->assertSame('tad', $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('lallow', $obj->getRecipient());
        $this->assertSame(25, $obj->getNewUserId());
        $this->assertSame('user_invite', $obj->getTypeId());
        $this->assertSame('2015-11-22 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2016-11-12 00:00:00', $obj->getExpiresAt());
        $this->assertSame('[example message]', $obj->getMessage());
    }

    public function testSave()
    {
        $obj = new Invite([
            'id'          => 'tad',
            'user_id'     => 2,
            'recipient'   => 'lallow',
            'new_user_id' => 25,
            'type_id'     => 'user_invite',
            'created_at'  => '2015-11-22 00:00:00',
            'expires_at'  => '2016-11-12 00:00:00',
            'message'     => '[example message]',
        ]);

        $obj->save();

        /** @var Invite $obj */
        $obj = \Phpfox::model('invite')
            ->select()->where('id=?', 'tad')->first();

        $this->assertSame('invite', $obj->getModelId());
        $this->assertSame('tad', $obj->getId());
        $this->assertSame(2, $obj->getUserId());
        $this->assertSame('lallow', $obj->getRecipient());
        $this->assertSame(25, $obj->getNewUserId());
        $this->assertSame('user_invite', $obj->getTypeId());
        $this->assertSame('2015-11-22 00:00:00', $obj->getCreatedAt());
        $this->assertSame('2016-11-12 00:00:00', $obj->getExpiresAt());
        $this->assertSame('[example message]', $obj->getMessage());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('invite')
            ->delete()->where('id=?', 'tad')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('invite')
            ->delete()->where('id=?', 'tad')->execute();
    }
}