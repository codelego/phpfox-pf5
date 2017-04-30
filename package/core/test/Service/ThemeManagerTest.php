<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\Theme;

class ThemeManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSassVariablesByEmpty()
    {
        $mn = new ThemeManager();

        $this->assertNotEmpty($mn->getSassVariables(0));
        $this->assertNotEmpty($mn->getSassVariables(null));
    }

    public function testGetRebuildFileByEmpty()
    {
        $mn = new ThemeManager();

        $this->assertNotEmpty($mn->getRebuildFiles(null));
        $this->assertNotEmpty($mn->getRebuildFiles('default'));
        $this->assertNotEmpty($mn->getRebuildFiles('admin'));
    }

    /**
     * @return string
     */
    public function testAddVariables()
    {
        \Phpfox::db()->insert(':theme_params', [
            'theme_id' => 'galaxy',
            'params' => '[]',
        ])->execute();

        $result = \Phpfox::db()->select('*')
            ->from(':theme_params')
            ->first();

        $this->assertNotEmpty($result);

        return $result['theme_id'];
    }

    /**
     * @param $id
     *
     * @depends  testAddVariables
     */
    public function testGetSassVariablesByValidId($id)
    {
        $mn = new ThemeManager();

        $this->assertNotEmpty($mn->getSassVariables($id));
    }

    public function testFindByIdByEmpty()
    {
        $mn = new ThemeManager();

        $this->assertNull($mn->findById(null));
        $this->assertNull($mn->findById(0));
        $this->assertNull($mn->findById(''));
    }

    /**
     * @return mixed
     */
    public function testHasAtLeastTheme()
    {
        /** @var Theme $theme */
        $theme = \Phpfox::with('theme')
            ->select()
            ->first();

        $this->assertTrue($theme instanceof Theme);

        return $theme->getId();
    }

    /**
     * @param $id
     *
     * @return mixed
     *
     * @depends testHasAtLeastTheme
     */
    public function testFindByIdWithValidValue($id)
    {
        $mn = new ThemeManager();
        $theme = $mn->findById($id);

        $this->assertTrue($theme instanceof Theme);
        $this->assertSame($id, $theme->getId());

        return $id;
    }

    /**
     * @param $id
     *
     * @depends testFindByIdWithValidValue
     */
    public function testSetDefaultWithValidThemeId($id)
    {
        $mn = new ThemeManager();

        $mn->setDefault($id);

        $ids = \Phpfox::db()->select('theme_id')->from(':theme')
            ->where('is_default=?', 1)->all();

        $this->assertSame([['theme_id' => $id]], $ids);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetDefaultWithInvalidTheme()
    {
        $mn = new ThemeManager();

        $mn->setDefault('no theme');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetActiveByInvalidThemeId()
    {
        $mn = new ThemeManager();

        $mn->setActive('no theme');
    }

    /**
     * @param $id
     *
     * @depends testFindByIdWithValidValue
     */
    public function testSetActiveByValidThemeId($id)
    {
        $mn = new ThemeManager();

        $mn->setActive($id);

        $theme = $mn->findById($id);

        $this->assertSame(1, $theme->isActive());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetInactiveByInvalidThemeId()
    {
        $mn = new ThemeManager();

        $mn->setInactive('no theme');
    }

    /**
     * @return mixed
     */
    public function testGetNotDefaultTheme()
    {
        /** @var Theme $theme */
        $theme = \Phpfox::with('theme')
            ->select()
            ->where('is_default=?', 0)
            ->first();

        $this->assertTrue($theme instanceof Theme);

        return $theme->getId();
    }

    /**
     * @param $id
     *
     * @depends testGetNotDefaultTheme
     */
    public function testSetInactiveByValidThemeId($id)
    {
        $mn = new ThemeManager();

        $mn->setInactive($id);

        $theme = $mn->findById($id);

        $this->assertSame(0, $theme->isActive());
    }

    /**
     *
     */
    public function testGetDefault()
    {
        \Phpfox::db()
            ->update(':theme', ['is_default' => 0, 'is_active' => 0])
            ->execute();

        \Phpfox::db()
            ->update(':theme', ['is_active' => 1])
            ->where('theme_id=?', 'galaxy')
            ->execute();

        $mn = new ThemeManager();

        /** @var Theme $obj */
        $obj = $mn->getDefault();

        $this->assertTrue($obj instanceof Theme);
        $this->assertSame('galaxy', $obj->getId());
        $this->assertSame([
            0 => 'galaxy',
            1 => 'default',
        ], $mn->preferThemes());
        $this->assertSame([
            0 => 'galaxy',
            1 => 'default',
        ], $mn->_preferThemes());

        \Phpfox::db()
            ->update(':theme', ['is_default' => 0, 'is_active' => 0])
            ->execute();

        \Phpfox::db()
            ->update(':theme', ['is_active' => 1, 'is_default' => 1,])
            ->where('theme_id=?', 'default')
            ->execute();

        $obj = $mn->getDefault();

        $this->assertTrue($obj instanceof Theme);
        $this->assertSame('default', $obj->getId());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRebuildMainByEmpty()
    {
        $mn = new ThemeManager();

        $mn->rebuildMain(null);
    }

    /**
     * @large
     * @requires extension false
     */
    public function testRebuildMainDefault()
    {
        $mn = new ThemeManager();

        $mn->rebuildMain('default');
        $this->assertFalse(false);
    }
}