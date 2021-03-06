<?php

namespace Neutron\User\Model;

class UserLevelTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new UserLevel(['level_id'      => 1,
                              'inherit_id'    => 0,
                              'title'         => 'Super',
                              'item_count'    => 0,
                              'is_core'       => 1,
                              'is_super'      => 1,
                              'is_admin'      => 1,
                              'is_moderator'  => 1,
                              'is_staff'      => 1,
                              'is_registered' => 1,
                              'is_banned'     => 0,
                              'is_guest'      => 0,
        ]);

        $this->assertSame('user_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());
    }

    public function testParameters()
    {
        $obj = new UserLevel();

        // set data
        $obj->setLevelId(1);
        $obj->setInheritId(0);
        $obj->setTitle('Super');
        $obj->setItemCount(0);
        $obj->setCore(1);
        $obj->setSuper(1);
        $obj->setAdmin(1);
        $obj->setModerator(1);
        $obj->setStaff(1);
        $obj->setRegistered(1);
        $obj->setBanned(0);
        $obj->setGuest(0);
        // assert same data
        $this->assertSame('user_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());
    }

    public function testSave()
    {
        $obj = new UserLevel(['level_id'      => 1,
                              'inherit_id'    => 0,
                              'title'         => 'Super',
                              'item_count'    => 0,
                              'is_core'       => 1,
                              'is_super'      => 1,
                              'is_admin'      => 1,
                              'is_moderator'  => 1,
                              'is_staff'      => 1,
                              'is_registered' => 1,
                              'is_banned'     => 0,
                              'is_guest'      => 0,
        ]);

        $obj->save();

        /** @var UserLevel $obj */
        $obj = \Phpfox::model('user_level')
            ->select()->where('level_id=?', 1)->first();

        $this->assertSame('user_level', $obj->getModelId());
        $this->assertSame(1, $obj->getLevelId());
        $this->assertSame(0, $obj->getInheritId());
        $this->assertSame('Super', $obj->getTitle());
        $this->assertSame(0, $obj->getItemCount());
        $this->assertSame(1, $obj->isCore());
        $this->assertSame(1, $obj->isSuper());
        $this->assertSame(1, $obj->isAdmin());
        $this->assertSame(1, $obj->isModerator());
        $this->assertSame(1, $obj->isStaff());
        $this->assertSame(1, $obj->isRegistered());
        $this->assertSame(0, $obj->isBanned());
        $this->assertSame(0, $obj->isGuest());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::model('user_level')
            ->delete()->where('level_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::model('user_level')
            ->delete()->where('level_id=?', 1)->execute();
    }
}