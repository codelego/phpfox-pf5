<?php

namespace Neutron\Core\Model;

class CorePackageTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new CorePackage(['id'             => 1,
                                'type_id'        => 'app',
                                'is_required'    => 1,
                                'is_active'      => 1,
                                'theme_id'       => null,
                                'priority'       => 1,
                                'title'          => 'Core',
                                'version'        => '5.0.1',
                                'latest_version' => null,
                                'author'         => 'phpFox',
                                'description'    => null,
                                'apps_icon'      => '',
                                'name'           => 'core',
                                'path'           => 'package/core',
        ]);

        $this->assertSame('core_package', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('app', $obj->getTypeId());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getThemeId());
        $this->assertSame(1, $obj->getPriority());
        $this->assertSame('Core', $obj->getTitle());
        $this->assertSame('5.0.1', $obj->getVersion());
        $this->assertSame('', $obj->getLatestVersion());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getAppsIcon());
        $this->assertSame('core', $obj->getName());
        $this->assertSame('package/core', $obj->getPath());
    }

    public function testParameters()
    {
        $obj = new CorePackage();

        // set data
        $obj->setId(1);
        $obj->setTypeId('app');
        $obj->setRequired(1);
        $obj->setActive(1);
        $obj->setThemeId('');
        $obj->setPriority(1);
        $obj->setTitle('Core');
        $obj->setVersion('5.0.1');
        $obj->setLatestVersion('');
        $obj->setAuthor('phpFox');
        $obj->setDescription('');
        $obj->setAppsIcon('');
        $obj->setName('core');
        $obj->setPath('package/core');

        // assert same data
        $this->assertSame('core_package', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('app', $obj->getTypeId());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getThemeId());
        $this->assertSame(1, $obj->getPriority());
        $this->assertSame('Core', $obj->getTitle());
        $this->assertSame('5.0.1', $obj->getVersion());
        $this->assertSame('', $obj->getLatestVersion());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getAppsIcon());
        $this->assertSame('core', $obj->getName());
        $this->assertSame('package/core', $obj->getPath());
    }

    public function testSave()
    {
        $obj = new CorePackage(['id'             => 1,
                                'type_id'        => 'app',
                                'is_required'    => 1,
                                'is_active'      => 1,
                                'theme_id'       => null,
                                'priority'       => 1,
                                'title'          => 'Core',
                                'version'        => '5.0.1',
                                'latest_version' => null,
                                'author'         => 'phpFox',
                                'description'    => null,
                                'apps_icon'      => '',
                                'name'           => 'core',
                                'path'           => 'package/core',
        ]);

        $obj->save();

        /** @var CorePackage $obj */
        $obj = \Phpfox::with('core_package')
            ->select()->where('id=?', 1)->first();

        $this->assertSame('core_package', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame('app', $obj->getTypeId());
        $this->assertSame(1, $obj->isRequired());
        $this->assertSame(1, $obj->isActive());
        $this->assertSame('', $obj->getThemeId());
        $this->assertSame(1, $obj->getPriority());
        $this->assertSame('Core', $obj->getTitle());
        $this->assertSame('5.0.1', $obj->getVersion());
        $this->assertSame('', $obj->getLatestVersion());
        $this->assertSame('phpFox', $obj->getAuthor());
        $this->assertSame('', $obj->getDescription());
        $this->assertSame('', $obj->getAppsIcon());
        $this->assertSame('core', $obj->getName());
        $this->assertSame('package/core', $obj->getPath());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('core_package')
            ->delete()->where('id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('core_package')
            ->delete()->where('id=?', 1)->execute();
    }
}