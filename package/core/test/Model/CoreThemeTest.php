<?php
namespace Neutron\Core\Model;


class CoreThemeTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $obj = new CoreTheme([
            'id'         => 'test_theme',
            'var_name'   => '[theme name]',
            'parent_id'  => 'default',
            'is_active'  => '0',
            'is_default' => '0',
            'author'     => '[test author]',
            'version'    => '[version]',
        ]);

        $this->assertSame('core_theme', $obj->getModelId());
        $this->assertSame('test_theme', $obj->getId());
        $this->assertSame('[theme name]', $obj->getName());
        $this->assertSame('[test author]', $obj->getAuthor());
        $this->assertSame('[version]', $obj->getVersion());
        $this->assertSame('default', $obj->getParentId());
        $this->assertSame('0', $obj->isActive());
        $this->assertSame('0', $obj->isDefault());

    }
}
