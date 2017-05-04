<?php

namespace Neutron\Core\Model;

class LayoutPageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutPage(['page_id'   => 1,
                               'action_id' => 'default',
                               'theme_id'  => 'default',
                               'is_active' => 1,
                               'params'    => '["grid":"3"]',
        ]);

        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new LayoutPage();

        // set data
        $obj->setId(1);
        $obj->setActionId('default');
        $obj->setThemeId('default');
        $obj->setActive(1);
        $obj->setParams('["grid":"3"]');

        // assert same data
        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new LayoutPage(['page_id'   => 1,
                               'action_id' => 'default',
                               'theme_id'  => 'default',
                               'is_active' => 1,
                               'params'    => '["grid":"3"]',
        ]);

        $obj->save();

        /** @var LayoutPage $obj */
        $obj = \Phpfox::with('layout_page')
            ->select()->where('page_id=?', 1)->first();

        $this->assertSame('layout_page', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('default', $obj->getActionId());
        $this->assertSame('default', $obj->getThemeId());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('["grid":"3"]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('layout_page')
            ->delete()->where('page_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('layout_page')
            ->delete()->where('page_id=?', 1)->execute();
    }
}