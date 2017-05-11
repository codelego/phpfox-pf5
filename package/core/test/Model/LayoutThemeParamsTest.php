<?php
namespace Neutron\Core\Model;

class LayoutThemeParamsTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutThemeParams(array (  'params_id' => 3,  'theme_id' => 'galaxy',  'params' => '[]',));

        $this->assertSame('layout_theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getparams_id());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());    }

    public function testParameters()
    {
        $obj = new LayoutThemeParams();

        // set data
        $obj->setparams_id(3);
        $obj->setId(3);
        $obj->setThemeId('galaxy');
        $obj->setParams('[]');
        // assert same data
        $this->assertSame('layout_theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getparams_id());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());    }

    public function testSave()
    {
        $obj = new LayoutThemeParams(array (  'params_id' => 3,  'theme_id' => 'galaxy',  'params' => '[]',));

        $obj->save();

        /** @var LayoutThemeParams $obj */
        $obj = _model('layout_theme_params')
            ->select()->where('params_id=?',3)->first();

        $this->assertSame('layout_theme_params', $obj->getModelId());
        $this->assertSame(3, $obj->getparams_id());
        $this->assertSame(3, $obj->getId());
        $this->assertSame('galaxy', $obj->getThemeId());
        $this->assertSame('[]', $obj->getParams());    }

    public static function setUpBeforeClass()
    {
        _model('layout_theme_params')
            ->delete()->where('params_id=?',3)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('layout_theme_params')
            ->delete()->where('params_id=?',3)->execute();
    }
}