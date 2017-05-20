<?php
namespace Neutron\Core\Model;

class AclLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AclLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Super',  'item_count' => 0,  'is_special' => 1,  'is_super' => 1,  'is_admin' => 1,  'is_moderator' => 1,  'is_staff' => 1,  'is_registered' => 1,  'is_banned' => 0,  'is_guest' => 0,));

        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isSpecial());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());    }

    public function testParameters()
    {
        $obj = new AclLevel();

        // set data
        $obj->setLevelId(1);
        $obj->setInheritId(0);
        $obj->setTitle('Super');
        $obj->setItemCount(0);
        $obj->setSpecial(1);
        $obj->setSuper(1);
        $obj->setAdmin(1);
        $obj->setModerator(1);
        $obj->setStaff(1);
        $obj->setRegistered(1);
        $obj->setBanned(0);
        $obj->setGuest(0);
        // assert same data
        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isSpecial());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());    }

    public function testSave()
    {
        $obj = new AclLevel(array (  'level_id' => 1,  'inherit_id' => 0,  'title' => 'Super',  'item_count' => 0,  'is_special' => 1,  'is_super' => 1,  'is_admin' => 1,  'is_moderator' => 1,  'is_staff' => 1,  'is_registered' => 1,  'is_banned' => 0,  'is_guest' => 0,));

        $obj->save();

        /** @var AclLevel $obj */
        $obj = _model('acl_level')
            ->select()->where('level_id=?',1)->first();

        $this->assertSame('acl_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isSpecial());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());    }

    public static function setUpBeforeClass()
    {
        _model('acl_level')
            ->delete()->where('level_id=?',1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('acl_level')
            ->delete()->where('level_id=?',1)->execute();
    }
}