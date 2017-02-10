<?php

namespace Neutron\User\Model;

class AuthTokenTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new AuthToken([
            'id'       => '$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            'user_id'  => 495,
            'created'  => 1486648805,
            'lifetime' => 86400,
        ]);

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('$2y$10$eO/nRD4KPbvtzQJjE26d1OjjXYjQj96pfExn8Gpva5yD/36UsoG2e',
            $obj->getId());
        $this->assertSame(495, $obj->getUserId());
        $this->assertSame(1486648805, $obj->getCreated());
        $this->assertSame(86400, $obj->getLifetime());
    }

    public function testSetter()
    {
        $obj = new AuthToken();

        $obj->setId('example token');
        $obj->setUserId('496');
        $obj->setCreated(148664880);
        $obj->setLifetime(400);

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('example token',
            $obj->getId());
        $this->assertSame(496, $obj->getUserId());
        $this->assertSame(148664880, $obj->getCreated());
        $this->assertSame(400, $obj->getLifetime());
    }

    public function testSave()
    {
        $obj = new AuthToken([
            'id'       => '[example_token]',
            'user_id'  => 495,
            'created'  => 1486648805,
            'lifetime' => 86400,
        ]);

        $obj->save();

        /** @var AuthToken $obj */
        $obj = \Phpfox::with('auth_token')
            ->findById('[example_token]');

        $this->assertSame('auth_token', $obj->getModelId());
        $this->assertSame('[example_token]',
            $obj->getId());
        $this->assertSame(495, $obj->getUserId());
        $this->assertSame(1486648805, $obj->getCreated());
        $this->assertSame(86400, $obj->getLifetime());

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
