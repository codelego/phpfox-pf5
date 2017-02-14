<?php

namespace Neutron\Core\Model;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Session([
            'id'       => 'n9s5248m9ak1asrjk2ccjkmbc0',
            'name'     => 'PHPSESSID',
            'modified' => 1486957158,
            'lifetime' => 86400,
            'data'     => '',
        ]);

        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('n9s5248m9ak1asrjk2ccjkmbc0', $obj->getId());
        $this->assertSame('PHPSESSID', $obj->getName());
        $this->assertSame(1486957158, $obj->getModified());
        $this->assertSame(86400, $obj->getLifetime());
        $this->assertSame('', $obj->getData());
    }

    public function testParameters()
    {
        $obj = new Session();

        // set data
        $obj->setId('n9s5248m9ak1asrjk2ccjkmbc0');
        $obj->setName('PHPSESSID');
        $obj->setModified(1486957158);
        $obj->setLifetime(86400);
        $obj->setData('');

        // assert same data
        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('n9s5248m9ak1asrjk2ccjkmbc0', $obj->getId());
        $this->assertSame('PHPSESSID', $obj->getName());
        $this->assertSame(1486957158, $obj->getModified());
        $this->assertSame(86400, $obj->getLifetime());
        $this->assertSame('', $obj->getData());
    }

    public function testSave()
    {
        $obj = new Session([
            'id'       => 'n9s5248m9ak1asrjk2ccjkmbc0',
            'name'     => 'PHPSESSID',
            'modified' => 1486957158,
            'lifetime' => 86400,
            'data'     => '',
        ]);

        $obj->save();

        /** @var Session $obj */
        $obj = \Phpfox::with('session')
            ->select()->where('id=?', 'n9s5248m9ak1asrjk2ccjkmbc0')->first();

        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('n9s5248m9ak1asrjk2ccjkmbc0', $obj->getId());
        $this->assertSame('PHPSESSID', $obj->getName());
        $this->assertSame(1486957158, $obj->getModified());
        $this->assertSame(86400, $obj->getLifetime());
        $this->assertSame('', $obj->getData());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('session')
            ->delete()->where('id=?', 'n9s5248m9ak1asrjk2ccjkmbc0')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('session')
            ->delete()->where('id=?', 'n9s5248m9ak1asrjk2ccjkmbc0')->execute();
    }
}