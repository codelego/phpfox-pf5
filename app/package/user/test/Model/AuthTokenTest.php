<?php

namespace Neutron\User\Model;

class AuthTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj
            = new AuthToken([
            'id'         => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'    => 727,
            'created_at' => '2015-11-11 10:10:10',
            'expires_at' => '2015-11-11 10:10:20',
        ]);

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            $obj->getId());
        $this->assertSame(727, $obj->getUserId());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
        $this->assertSame('2015-11-11 10:10:20', $obj->getExpiresAt());
    }

    public function testParameters()
    {
        $obj = new AuthToken();

        // set data
        $obj->setId('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e');
        $obj->setUserId(727);
        $obj->setCreatedAt('2015-11-11 10:10:10');
        $obj->setExpiresAt('2015-11-11 10:10:20');

        // assert same data
        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            $obj->getId());
        $this->assertSame(727, $obj->getUserId());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
        $this->assertSame('2015-11-11 10:10:20', $obj->getExpiresAt());
    }

    public function testSave()
    {
        $obj
            = new AuthToken([
            'id'         => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'    => 727,
            'created_at' => '2015-11-11 10:10:10',
            'expires_at' => '2015-11-11 10:10:20',
        ]);

        $obj->save();

        /** @var AuthToken $obj */
        $obj = \Phpfox::model('auth_token')
            ->select()->where('id=?',
                '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
            ->first();

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            $obj->getId());
        $this->assertSame(727, $obj->getUserId());
        $this->assertSame('2015-11-11 10:10:10', $obj->getCreatedAt());
        $this->assertSame('2015-11-11 10:10:20', $obj->getExpiresAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('auth_token')
            ->delete()->where('id=?',
                '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('auth_token')
            ->delete()->where('id=?',
                '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e')
            ->execute();
    }
}