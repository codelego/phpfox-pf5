<?php

namespace Neutron\Core\Model;


class MailAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $obj = new MailAdapter();

        $this->assertEquals('mail_adapter', $obj->getModelId());

        $obj->setName('[example adapter name]');
        $this->assertEquals('[example adapter name]', $obj->getName());
        $this->assertEquals('[example adapter name]', $obj->getTitle());

        $obj->setActive(false);
        $this->assertEquals(0, $obj->isActive());
        $obj->setActive(true);
        $this->assertEquals(1, $obj->isActive());
        $obj->setActive(null);
        $this->assertEquals(0, $obj->isActive());

        $obj->setTitle('[example adapter title]');
        $this->assertEquals('[example adapter title]', $obj->getName());
        $this->assertEquals('[example adapter title]', $obj->getTitle());


        $obj->setDefault(false);
        $this->assertEquals(0, $obj->isDefault());
        $obj->setDefault(true);
        $this->assertEquals(1, $obj->isDefault());
        $obj->setDefault(null);
        $this->assertEquals(0, $obj->isDefault());

        $obj->setFallback(false);
        $this->assertEquals(0, $obj->isFallback());
        $obj->setFallback(true);
        $this->assertEquals(1, $obj->isFallback());
        $obj->setFallback(null);
        $this->assertEquals(0, $obj->isFallback());

        $obj->setParams('[]');
        $this->assertEquals('[]', $obj->getParams());

        $obj->setDriverId('[example driver id]');
        $this->assertEquals('[example driver id]', $obj->getDriverId());

        $obj->setDescription('[example description]');
        $this->assertEquals('[example description]', $obj->getDescription());
    }

    public function testSave()
    {
        $obj = new MailAdapter([
            'is_active'   => false,
            'is_fallback' => false,
            'description' => '[example description]',
            'name'        => '[example name]',
            'driver_id'   => 'test',
            'params'      => '[]',
        ]);

        $obj->save();

        $this->assertNotEmpty($obj->getId());
        $this->assertNotEmpty($obj->getDriverId());

        /** @var MailAdapter $entry */
        $entry = \Phpfox::get('db')
            ->select('*')
            ->from(':mail_adapter')
            ->where('adapter_id=?', $obj->getId())
            ->setPrototype(MailAdapter::class)
            ->first();

        $this->assertEquals($obj->getId(), $entry->getId());
        $this->assertEquals('0', $entry->isActive());
        $this->assertEquals('0', $entry->isFallback());
        $this->assertEquals('0', $entry->isDefault());
        $this->assertEquals('[example description]', $entry->getDescription());
        $this->assertEquals('[example name]', $entry->getName());
        $this->assertEquals('[example name]', $entry->getTitle());
        $this->assertEquals('[]', $entry->getParams());

        $entry->delete();

        /** @var MailAdapter $entry */
        $entry = \Phpfox::get('db')
            ->select('*')
            ->from(':mail_adapter')
            ->where('adapter_id=?', $obj->getId())
            ->setPrototype(MailAdapter::class)
            ->first();

        $this->assertNull($entry);
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':mail_adapter')
            ->where('driver_id=?', 'test')
            ->execute();
    }
}
