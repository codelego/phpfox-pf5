<?php

namespace Neutron\Core\Model;

class MailDriverTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $obj = new MailDriver();

        $this->assertEquals('mail_driver', $obj->getModelId());

        $obj->setName('[example name]');
        $this->assertEquals('[example name]', $obj->getName());
        $this->assertEquals('[example name]', $obj->getTitle());

        $obj->setName(null);
        $this->assertEquals('', $obj->getName());
        $this->assertEquals('', $obj->getTitle());

        $obj->setActive(false);
        $this->assertEquals(0, $obj->isActive());
        $obj->setActive(true);
        $this->assertEquals(1, $obj->isActive());
        $obj->setActive(null);
        $this->assertEquals(0, $obj->isActive());

        $obj->setDescription('[example description]');
        $this->assertEquals('[example description]', $obj->getDescription());

        $obj->setFormName('[example form name]');
        $this->assertEquals('[example form name]', $obj->getFormName());
    }

    public function testSave()
    {
        $obj = new MailDriver([
            'driver_id'   => 'test',
            'name'        => '[example name]',
            'description' => '[example description]',
            'is_active'   => 0,
            'form_name'   => '[example form name]',
        ]);

        $obj->save();

        /** @var MailDriver $entry */
        $entry = \Phpfox::get('db')
            ->select('*')
            ->from(':mail_driver')
            ->where('driver_id=?', 'test')
            ->setPrototype(MailDriver::class)
            ->first();

        $this->assertEquals(true, $entry instanceof MailDriver);

        $this->assertEquals('[example name]', $entry->getName());
        $this->assertEquals('[example name]', $entry->getTitle());
        $this->assertEquals('[example form name]', $entry->getFormName());
        $this->assertEquals(0, $entry->isActive());
        $this->assertEquals('[example description]', $entry->getDescription());

        $obj->delete();

        /** @var MailDriver $entry */
        $entry = \Phpfox::get('db')
            ->select('*')
            ->from(':mail_driver')
            ->where('driver_id=?', 'test')
            ->setPrototype(MailDriver::class)
            ->first();

        $this->assertNull($entry);
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::get('db')
            ->delete(':mail_driver')
            ->where('driver_id=?', 'test')
            ->execute();
    }

    protected function setUp()
    {
        \Phpfox::get('db')
            ->delete(':mail_driver')
            ->where('driver_id=?', 'test')
            ->execute();
    }
}
