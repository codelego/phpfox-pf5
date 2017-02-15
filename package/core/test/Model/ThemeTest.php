<?php

namespace Neutron\Core\Model;

class ThemeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Theme([
            'theme_id'   => '[admin]',
            'var_name'   => 'Theme Admin',
            'parent_id'  => null,
            'is_default' => 0,
            'is_active'  => 0,
            'author'     => 'phpFox',
            'version'    => '5.0.1',
        ]);

        $this->assertSame('theme', $obj->getModelId());
        $this->assertSame('[admin]', $obj->getId());
        $this->assertSame('Theme Admin', $obj->getVarName());
        $this->assertSame(_text('Theme Admin'), $obj->getName());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('5.0.1', $obj->getVersion());
    }

    public function testParameters()
    {
        $obj = new Theme();

        // set data
        $obj->setId('[admin]');
        $obj->setVarName('Theme Admin');
        $obj->setParentId('');
        $obj->setDefault(0);
        $obj->setActive(0);
        $obj->setAuthor('phpFox');
        $obj->setVersion('5.0.1');

        // assert same data
        $this->assertSame('theme', $obj->getModelId());
        $this->assertSame('[admin]', $obj->getId());
        $this->assertSame('Theme Admin', $obj->getVarName());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('5.0.1', $obj->getVersion());
    }

    public function testSave()
    {
        $obj = new Theme([
            'theme_id'   => '[admin]',
            'var_name'   => 'Theme Admin',
            'parent_id'  => null,
            'is_default' => 0,
            'is_active'  => 0,
            'author'     => 'phpFox',
            'version'    => '5.0.1',
        ]);

        $obj->save();

        /** @var Theme $obj */
        $obj = \Phpfox::with('theme')
            ->select()->where('theme_id=?', '[admin]')->first();

        $this->assertSame('theme', $obj->getModelId());
        $this->assertSame('[admin]', $obj->getId());
        $this->assertSame('Theme Admin', $obj->getVarName());
        $this->assertSame('', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(0, $obj->isActive());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('5.0.1', $obj->getVersion());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('theme')
            ->delete()->where('theme_id=?', '[admin]')->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('theme')
            ->delete()->where('theme_id=?', '[admin]')->execute();
    }
}