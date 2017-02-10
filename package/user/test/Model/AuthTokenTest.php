<?php

namespace Neutron\User\Model;

class AuthTokenTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AuthToken([
            'id'       => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'  => 495,
            'created_at'  => '2017-01-18 08:48:26',
            'expires_at' => '2017-01-18 08:48:29',
        ]);

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            $obj->getId());
        $this->assertSame(495, $obj->getUserId());
        $this->assertSame('2017-01-18 08:48:26', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());
    }

    public function testSetter()
    {
        $obj = new AuthToken();

        $obj->setId('example token');
        $obj->setUserId('496');
        $obj->setCreatedAt('2017-01-18 08:48:26');
        $obj->setExpiresAt('2017-01-18 08:48:29');

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('example token',
            $obj->getId());
        $this->assertSame(496, $obj->getUserId());
        $this->assertSame('2017-01-18 08:48:26', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());
    }

    public function testSave()
    {
        $obj = new AuthToken([
            'id'       => '[example_token]',
            'user_id'  => 495,
            'created_at'  => '2017-01-18 08:48:26',
            'expires_at' => '2017-01-18 08:48:29',
        ]);

        $obj->save();

        /** @var AuthToken $obj */
        $obj = \Phpfox::with('auth_token')
            ->findById('[example_token]');

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('[example_token]',
            $obj->getId());
        $this->assertSame(495, $obj->getUserId());
        $this->assertSame('2017-01-18 08:48:26', $obj->getCreatedAt());
        $this->assertSame('2017-01-18 08:48:29', $obj->getExpiresAt());

    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_token')
            ->where('id=?', '[example_token]')
            ->execute();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_token')
            ->where('id=?', '[example_token]')
            ->execute();
    }
}
