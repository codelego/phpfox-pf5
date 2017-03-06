<?php

namespace Neutron\Core\Model;

class ThemeParamsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new ThemeParams(array (  'params_id' => 3,  'theme_id' => 'galaxy',  'params' => '[]',));

        $this->assertSame('theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testParameters()
    {
        $obj = new ThemeParams();

        // set data
        $obj->setId(3);
        $obj->setThemeId('galaxy');
        $obj->setParams('[]');

        // assert same data
        $this->assertSame('theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public function testSave()
    {
        $obj = new ThemeParams(array (  'params_id' => 3,  'theme_id' => 'galaxy',  'params' => '[]',));

        $obj->save();

        /** @var ThemeParams $obj */
        $obj = \Phpfox::with('theme_params')
            ->select()->where('params_id=?',3)->first();

        $this->assertSame('theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('theme_params')
            ->delete()->where('params_id=?',3)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('theme_params')
            ->delete()->where('params_id=?',3)->execute();
    }
}