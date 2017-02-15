<?php

namespace Neutron\Core\Model;

class ThemeSettingTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ThemeSetting([
            'setting_id' => 2,
            'theme_id'   => 'galaxy',
            'params'     => '[]',
        ]);

        $this->assertSame('theme_setting', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new ThemeSetting();

        // set data
        $obj->setId(2);
        $obj->setThemeId('galaxy');
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('theme_setting', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new ThemeSetting([
            'setting_id' => 2,
            'theme_id'   => 'galaxy',
            'params'     => '[]',
        ]);

        $obj->save();

        /** @var ThemeSetting $obj */
        $obj = \Phpfox::with('theme_setting')
            ->select()->where('setting_id=?', 2)->first();

        $this->assertSame('theme_setting', $obj->getModelId());
        $this->assertSame(2, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('theme_setting')
            ->delete()->where('setting_id=?', 2)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('theme_setting')
            ->delete()->where('setting_id=?', 2)->execute();
    }
}