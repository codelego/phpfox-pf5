<?php

namespace Neutron\Core\Model;

class CoreEventTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CoreEvent([
            'id'            => 1,
            'event_name'    => 'onBeforeJavascriptRender',
            'listener_name' => 'theme_galaxy.listener',
            'priority'      => 10,
        ]);

        $this->assertSame('core_event', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('onBeforeJavascriptRender', $obj->getEventName());
        $this->assertSame('theme_galaxy.listener', $obj->getListenerName());
        $this->assertSame(10, $obj->getPriority());
    }

    public function testParameters()
    {
        $obj = new CoreEvent();

        // set data
        $obj->setId(1);
        $obj->setEventName('onBeforeJavascriptRender');
        $obj->setListenerName('theme_galaxy.listener');
        $obj->setPriority(10);
        // assert same data
        $this->assertSame('core_event', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('onBeforeJavascriptRender', $obj->getEventName());
        $this->assertSame('theme_galaxy.listener', $obj->getListenerName());
        $this->assertSame(10, $obj->getPriority());
    }

    public function testSave()
    {
        $obj = new CoreEvent([
            'id'            => 1,
            'event_name'    => 'onBeforeJavascriptRender',
            'listener_name' => 'theme_galaxy.listener',
            'priority'      => 10,
        ]);

        $obj->save();

        /** @var CoreEvent $obj */
        $obj = _model('core_event')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('core_event', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('onBeforeJavascriptRender', $obj->getEventName());
        $this->assertSame('theme_galaxy.listener', $obj->getListenerName());
        $this->assertSame(10, $obj->getPriority());
    }

    public static function setUpBeforeClass()
    {
        _model('core_event')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('core_event')
            ->delete()->where('id=?', 1)->execute();
    }
}