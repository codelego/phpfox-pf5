<?php

namespace Phpfox\Db;


class ExampleTestModel extends DbModel
{
    public function getModelId()
    {
        return 'example';
    }

}

class DbModelTest extends \PHPUnit_Framework_TestCase
{
    function testBase()
    {
        $m = new ExampleTestModel();

        $this->assertEmpty($m->isSaved());
        $this->assertEquals('example', $m->getModelId());
        $this->assertEmpty($m->getChanged());
        $m->markSaved();
        $this->assertTrue($m->isSaved());
        $this->assertEmpty($m->toArray());

        $m->exchangeArray(['id' => 1]);

        $this->assertEquals(['id' => 1], $m->toArray());

        $this->assertEquals(1, $m['id']);
        $this->assertNull($m['name']);
        $this->assertNull($m['value']);
        $m['value'] = 2;
        $this->assertEquals(2, $m['value']);

        $this->assertEquals(['value' => 2], $m->getChanged());
    }

    /**
     * @expectedException \Phpfox\Model\GatewayException
     */
    public function testBase2()
    {
        $m = new ExampleTestModel();

        $m->save();
    }


}
