<?php

namespace Neutron\Core\Model;


class CorePackageTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testParameters()
    {
        $obj = new CorePackage([
            'id'           => 14,
            'is_app'       => 1,
            'is_theme'     => 0,
            'is_library'   => 0,
            'is_core'      => 0,
            'is_active'    => 0,
            'theme_id'     => 0,
            'is_language'  => 0,
            'priority'     => 12,
            'var_name'     => 1,
            'version'      => '[example version]',
            'author'       => '[example author]',
            'description'  => '[example package description]',
            'apps_icon'    => '[example icon]',
            'package_name' => '[example name]',
            'path'         => '[example path]',
            'package_type' => 16,
        ]);

        $this->assertEquals('core_package', $obj->getModelId());

        $this->assertEquals(1, $obj->isApp());
        $this->assertEquals(0, $obj->isTheme());
        $this->assertEquals(0, $obj->isLibrary());
        $this->assertEquals(0, $obj->isLanguage());
        $this->assertEquals(0, $obj->isCore());
        $this->assertEquals(0, $obj->isActive());
        $this->assertEquals(12, $obj->getPriority());
        $this->assertEquals(0, $obj->getName());
        $this->assertEquals(0, $obj->getTitle());
        $this->assertEquals('[example path]', $obj->getPath());
        $this->assertEquals('[example icon]', $obj->getIcon());
        $this->assertEquals('[example author]', $obj->getAuthor());
        $this->assertEquals('[example version]', $obj->getVersion());
        $this->assertEquals(0, $obj->getThemeId());
        $this->assertEquals(16, $obj->getPackageType());
        $this->assertEquals(14, $obj->getId());
        $this->assertEquals('[example package description]',
            $obj->getDescription());
    }
}
