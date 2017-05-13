<?php

namespace Neutron\Core\Model;

class LayoutThemeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new LayoutTheme([
            'theme_id'   => 'admin',
            'title'      => 'Theme Admin',
            'parent_id'  => 'default',
            'is_default' => 0,
            'is_active'  => 1,
            'is_editing' => 0,
            'is_admin'   => 1,
        ]);

        $this->assertSame('layout_theme', $obj->getModelId());
        $this->assertSame('admin', $obj->getThemeId());
        $this->assertSame('Theme Admin', $obj->getTitle());
        $this->assertSame('default', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isEditing());
        $this->assertSame(1, $obj->isAdmin());
    }

    public function testParameters()
    {
        $obj = new LayoutTheme();

        // set data
        $obj->setThemeId('admin');
        $obj->setTitle('Theme Admin');
        $obj->setParentId('default');
        $obj->setDefault(0);
        $obj->setActive(1);
        $obj->setEditing(0);
        $obj->setAdmin(1);
        // assert same data
        $this->assertSame('layout_theme', $obj->getModelId());
        $this->assertSame('admin', $obj->getThemeId());
        $this->assertSame('Theme Admin', $obj->getTitle());
        $this->assertSame('default', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isEditing());
        $this->assertSame(1, $obj->isAdmin());
    }

    public function testSave()
    {
        $obj = new LayoutTheme([
            'theme_id'   => 'admin',
            'title'      => 'Theme Admin',
            'parent_id'  => 'default',
            'is_default' => 0,
            'is_active'  => 1,
            'is_editing' => 0,
            'is_admin'   => 1,
        ]);

        $obj->save();

        /** @var LayoutTheme $obj */
        $obj = _model('layout_theme')
            ->select()->where('theme_id=?', 'admin')->first();

        $this->assertSame('layout_theme', $obj->getModelId());
        $this->assertSame('admin', $obj->getThemeId());
        $this->assertSame('Theme Admin', $obj->getTitle());
        $this->assertSame('default', $obj->getParentId());
        $this->assertSame(0, $obj->isDefault());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame(0, $obj->isEditing());
        $this->assertSame(1, $obj->isAdmin());
    }

    public static function setUpBeforeClass()
    {
        _model('layout_theme')
            ->delete()->where('theme_id=?', 'admin')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('layout_theme')
            ->delete()->where('theme_id=?', 'admin')->execute();
    }
}