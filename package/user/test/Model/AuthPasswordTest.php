<?php

namespace Neutron\User\Model;

class AuthPasswordTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AuthPassword([
            'id'          => 4,
            'user_id'     => 5,
            'hashed'      => '$2y$10$6hycyQ.UaRCtz1k8yQ1rHeOQtndnBHR8rV5Ap1KWHPqOwX33vM6Am',
            'salt'        => '07W',
            'static_salt' => 'ddd',
            'source_id'   => 'pf4',
            'created_at'     => '2016-10-25 12:09:34',
        ]);

        $this->assertEquals('auth_password', $obj->getModelId());
        $this->assertEquals(4, $obj->getId());
        $this->assertSame(5, $obj->getUserId());
        $this->assertSame('07W', $obj->getSalt());
        $this->assertSame('$2y$10$6hycyQ.UaRCtz1k8yQ1rHeOQtndnBHR8rV5Ap1KWHPqOwX33vM6Am',
            $obj->getHashed());

        $this->assertSame('ddd', $obj->getStaticSalt());
        $this->assertSame('pf4', $obj->getSourceId());
        $this->assertSame('2016-10-25 12:09:34', $obj->getCreatedAt());
    }


    public function testSave()
    {

        $obj = new AuthPassword([
            'user_id'     => 5,
            'hashed'      => '$2y$10$6hycyQ.UaRCtz1k8yQ1rHeOQtndnBHR8rV5Ap1KWHPqOwX33vM6Am',
            'salt'        => '07W',
            'static_salt' => 'ddd',
            'source_id'   => 'test',
            'created_at'     => '2016-10-25 12:09:34',
        ]);

        $obj->save();

        /** @var AuthPassword $obj */
        $obj = \Phpfox::with('auth_password')
            ->select()
            ->where('source_id=?', 'test')
            ->first();

        $this->assertNotNull($obj);
        $this->assertEquals('auth_password', $obj->getModelId());
        $this->assertSame('5', $obj->getUserId());
        $this->assertSame('07W', $obj->getSalt());
        $this->assertSame('$2y$10$6hycyQ.UaRCtz1k8yQ1rHeOQtndnBHR8rV5Ap1KWHPqOwX33vM6Am',
            $obj->getHashed());

        $this->assertSame('ddd', $obj->getStaticSalt());
        $this->assertSame('test', $obj->getSourceId());
        $this->assertSame('2016-10-25 12:09:34', $obj->getCreatedAt());

        $obj->delete();
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_password')
            ->where('source_id=?', 'test')
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':auth_password')
            ->where('source_id=?', 'test')
            ->execute();
    }

    public function testSetter()
    {
        $obj = new AuthPassword([
            'user_id'     => 5,
            'salt'        => '07W',
            'static_salt' => 'ddd',
            'source_id'   => 'pf4',
            'created_at'     => '2016-10-25 12:09:34',
        ]);

        $obj->setUserId(5);
        $obj->setHashed('example hashed');
        $obj->setSalt('07W');
        $obj->setStaticSalt('ddd');
        $obj->setSourceId('pf4');
        $obj->setCreatedAt('2016-10-25 12:09:34');

        $this->assertEquals('auth_password', $obj->getModelId());
        $this->assertSame(5, $obj->getUserId());
        $this->assertSame('07W', $obj->getSalt());
        $this->assertSame('example hashed',
            $obj->getHashed());

        $this->assertSame('ddd', $obj->getStaticSalt());
        $this->assertSame('pf4', $obj->getSourceId());
        $this->assertSame('2016-10-25 12:09:34', $obj->getCreatedAt());
    }
}
