<?php

namespace Neutron\Group\Model;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Group([
            'group_id'     => 33,
            'user_id'      => 25,
            'title'        => '[title]',
            'description'  => '[description]',
            'category_id'  => 24,
            'location_id'  => 15,
            'invite_id'    => 1,
            'is_approval'  => 1,
            'is_featured'  => 1,
            'is_sponsor'   => 0,
            'parent_id'    => 24,
            'parent_type'  => 'pages',
            'photo_id'     => 45,
            'cover_id'     => 55,
            'created_at'   => '2014-10-10 00:10:44',
            'updated_at'   => '2014-09-10 00:10:44',
            'member_count' => 44,
            'view_count'   => 12,
            'poster_id'    => 5,
            'poster_type'  => 'user',
        ]);

        $this->assertSame('group', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(25, $obj->getUserId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(24, $obj->getCategoryId());
        $this->assertSame(15, $obj->getLocationId());
        $this->assertSame(1, $obj->getInviteId());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(24, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(45, $obj->getPhotoId());
        $this->assertSame(55, $obj->getCoverId());
        $this->assertSame('2014-10-10 00:10:44', $obj->getCreatedAt());
        $this->assertSame('2014-09-10 00:10:44', $obj->getUpdatedAt());
        $this->assertSame(44, $obj->getMemberCount());
        $this->assertSame(12, $obj->getViewCount());
        $this->assertSame(5, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
    }

    public function testParameters()
    {
        $obj = new Group();

        // set data
        $obj->setId(33);
        $obj->setUserId(25);
        $obj->setTitle('[title]');
        $obj->setDescription('[description]');
        $obj->setCategoryId(24);
        $obj->setLocationId(15);
        $obj->setInviteId(1);
        $obj->setApproval(1);
        $obj->setFeatured(1);
        $obj->setSponsor(0);
        $obj->setParentId(24);
        $obj->setParentType('pages');
        $obj->setPhotoId(45);
        $obj->setCoverId(55);
        $obj->setCreatedAt('2014-10-10 00:10:44');
        $obj->setUpdatedAt('2014-09-10 00:10:44');
        $obj->setMemberCount(44);
        $obj->setViewCount(12);
        $obj->setPosterId(5);
        $obj->setPosterType('user');

        // assert same data
        $this->assertSame('group', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(25, $obj->getUserId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(24, $obj->getCategoryId());
        $this->assertSame(15, $obj->getLocationId());
        $this->assertSame(1, $obj->getInviteId());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(24, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(45, $obj->getPhotoId());
        $this->assertSame(55, $obj->getCoverId());
        $this->assertSame('2014-10-10 00:10:44', $obj->getCreatedAt());
        $this->assertSame('2014-09-10 00:10:44', $obj->getUpdatedAt());
        $this->assertSame(44, $obj->getMemberCount());
        $this->assertSame(12, $obj->getViewCount());
        $this->assertSame(5, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
    }

    public function testSave()
    {
        $obj = new Group([
            'group_id'     => 33,
            'user_id'      => 25,
            'title'        => '[title]',
            'description'  => '[description]',
            'category_id'  => 24,
            'location_id'  => 15,
            'invite_id'    => 1,
            'is_approval'  => 1,
            'is_featured'  => 1,
            'is_sponsor'   => 0,
            'parent_id'    => 24,
            'parent_type'  => 'pages',
            'photo_id'     => 45,
            'cover_id'     => 55,
            'created_at'   => '2014-10-10 00:10:44',
            'updated_at'   => '2014-09-10 00:10:44',
            'member_count' => 44,
            'view_count'   => 12,
            'poster_id'    => 5,
            'poster_type'  => 'user',
        ]);

        $obj->save();

        /** @var Group $obj */
        $obj = _model('group')
            ->select()
            ->where('group_id=?', 33)
            ->first();

        $this->assertSame('group', $obj->getModelId());
        $this->assertSame(33, $obj->getId());
        $this->assertSame(25, $obj->getUserId());
        $this->assertSame('[title]', $obj->getTitle());
        $this->assertSame('[description]', $obj->getDescription());
        $this->assertSame(24, $obj->getCategoryId());
        $this->assertSame(15, $obj->getLocationId());
        $this->assertSame(1, $obj->getInviteId());
        $this->assertSame(1, $obj->isApproval());
        $this->assertSame(1, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(24, $obj->getParentId());
        $this->assertSame('pages', $obj->getParentType());
        $this->assertSame(45, $obj->getPhotoId());
        $this->assertSame(55, $obj->getCoverId());
        $this->assertSame('2014-10-10 00:10:44', $obj->getCreatedAt());
        $this->assertSame('2014-09-10 00:10:44', $obj->getUpdatedAt());
        $this->assertSame(44, $obj->getMemberCount());
        $this->assertSame(12, $obj->getViewCount());
        $this->assertSame(5, $obj->getPosterId());
        $this->assertSame('user', $obj->getPosterType());
    }

    public static function setUpBeforeClass()
    {
        _model('group')
            ->delete()
            ->where('group_id=?', 33)
            ->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('group')
            ->delete()
            ->where('group_id=?', 33)
            ->execute();
    }
}