<?php

namespace Neutron\Core\Model;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Session([
            'id'       => '099trcj7e3dp',
            'name'     => '',
            'modified' => 1487114469,
            'lifetime' => 3600,
            'data'     => 'example data',
        ]);

        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('099trcj7e3dp', $obj->getId());
        $this->assertSame('', $obj->getName());
        $this->assertSame(1487114469, $obj->getModified());
        $this->assertSame(3600, $obj->getLifetime());
        $this->assertSame('example data', $obj->getData());
    }

    public function testParameters()
    {
        $obj = new Session();

        // set data
        $obj->setId('099trcj7e3dp');
        $obj->setName('');
        $obj->setModified(1487114469);
        $obj->setLifetime(3600);
        $obj->setData('example data');
        // assert same data
        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('099trcj7e3dp', $obj->getId());
        $this->assertSame('', $obj->getName());
        $this->assertSame(1487114469, $obj->getModified());
        $this->assertSame(3600, $obj->getLifetime());
        $this->assertSame('example data', $obj->getData());
    }

    public function testSave()
    {
        $obj = new Session([
            'id'       => '099trcj7e3dp',
            'name'     => '',
            'modified' => 1487114469,
            'lifetime' => 3600,
            'data'     => 'example data',
        ]);

        $obj->save();

        /** @var Session $obj */
        $obj = _model('session')
            ->select()->where('id=?', '099trcj7e3dp')->first();

        $this->assertSame('session', $obj->getModelId());
        $this->assertSame('099trcj7e3dp', $obj->getId());
        $this->assertSame('', $obj->getName());
        $this->assertSame(1487114469, $obj->getModified());
        $this->assertSame(3600, $obj->getLifetime());
        $this->assertSame('example data', $obj->getData());
    }

    public static function setUpBeforeClass()
    {
        _model('session')
            ->delete()->where('id=?', '099trcj7e3dp')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('session')
            ->delete()->where('id=?', '099trcj7e3dp')->execute();
    }
}