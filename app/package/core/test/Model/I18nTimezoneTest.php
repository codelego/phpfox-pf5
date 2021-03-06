<?php

namespace Neutron\Core\Model;

class I18nTimezoneTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new I18nTimezone(['timezone_id'       => 'UTC-1',
                                 'timezone_location' => 'Azores, Cape Verde Is.',
                                 'is_active'         => 1,
                                 'ordering'          => 12,
                                 'timezone_code'     => 'Atlantic/Azores',
                                 'timezone_offset'   => 'UTC-1',
                                 'is_default'        => 0,
        ]);

        $this->assertSame('i18n_timezone', $obj->getModelId());
        $this->assertSame('UTC-1', $obj->getTimezoneId());
        $this->assertSame('Azores, Cape Verde Is.', $obj->getTimezoneLocation());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(12, $obj->getOrdering());
        $this->assertSame('Atlantic/Azores', $obj->getTimezoneCode());
        $this->assertSame('UTC-1', $obj->getTimezoneOffset());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testParameters()
    {
        $obj = new I18nTimezone();

        // set data
        $obj->setTimezoneId('UTC-1');
        $obj->setTimezoneLocation('Azores, Cape Verde Is.');
        $obj->setActive(1);
        $obj->setOrdering(12);
        $obj->setTimezoneCode('Atlantic/Azores');
        $obj->setTimezoneOffset('UTC-1');
        $obj->setDefault(0);
        // assert same data
        $this->assertSame('i18n_timezone', $obj->getModelId());
        $this->assertSame('UTC-1', $obj->getTimezoneId());
        $this->assertSame('Azores, Cape Verde Is.', $obj->getTimezoneLocation());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(12, $obj->getOrdering());
        $this->assertSame('Atlantic/Azores', $obj->getTimezoneCode());
        $this->assertSame('UTC-1', $obj->getTimezoneOffset());
        $this->assertSame(0, $obj->isDefault());
    }

    public function testSave()
    {
        $obj = new I18nTimezone(['timezone_id'       => 'UTC-1',
                                 'timezone_location' => 'Azores, Cape Verde Is.',
                                 'is_active'         => 1,
                                 'ordering'          => 12,
                                 'timezone_code'     => 'Atlantic/Azores',
                                 'timezone_offset'   => 'UTC-1',
                                 'is_default'        => 0,
        ]);

        $obj->save();

        /** @var I18nTimezone $obj */
        $obj = \Phpfox::model('i18n_timezone')
            ->select()->where('timezone_id=?', 'UTC-1')->first();

        $this->assertSame('i18n_timezone', $obj->getModelId());
        $this->assertSame('UTC-1', $obj->getTimezoneId());
        $this->assertSame('Azores, Cape Verde Is.', $obj->getTimezoneLocation());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(12, $obj->getOrdering());
        $this->assertSame('Atlantic/Azores', $obj->getTimezoneCode());
        $this->assertSame('UTC-1', $obj->getTimezoneOffset());
        $this->assertSame(0, $obj->isDefault());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('i18n_timezone')
            ->delete()->where('timezone_id=?', 'UTC-1')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('i18n_timezone')
            ->delete()->where('timezone_id=?', 'UTC-1')->execute();
    }
}