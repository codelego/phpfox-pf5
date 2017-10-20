<?php

namespace Neutron\Pages\Model;

class PagesTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new Pages([
            'page_id'        => 3,
            'is_featured'    => 0,
            'is_sponsor'     => 0,
            'type_id'        => 5,
            'category_id'    => 145,
            'user_id'        => 39,
            'profile_name'   => null,
            'title'          => 'Quaerat ea voluptatibus atque eos.',
            'photo_id'       => 0,
            'cover_photo_id' => 0,
            'like_count'     => 1,
            'comment_count'  => 0,
            'created_at'     => '2014-10-02 10:10:10',
        ]);

        $this->assertSame('pages', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(145, $obj->getCategoryId());
        $this->assertSame(39, $obj->getUserId());
        $this->assertSame('', $obj->getProfileName());
        $this->assertSame('Quaerat ea voluptatibus atque eos.',
            $obj->getTitle());
        $this->assertSame(0, $obj->getPhotoId());
        $this->assertSame(0, $obj->getCoverPhotoId());
        $this->assertSame(1, $obj->getLikeCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame('2014-10-02 10:10:10', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new Pages();

        // set data
        $obj->setId(3);
        $obj->setFeatured(0);
        $obj->setSponsor(0);
        $obj->setTypeId(5);
        $obj->setCategoryId(145);
        $obj->setUserId(39);
        $obj->setProfileName('');
        $obj->setTitle('Quaerat ea voluptatibus atque eos.');
        $obj->setPhotoId(0);
        $obj->setCoverPhotoId(0);
        $obj->setLikeCount(1);
        $obj->setCommentCount(0);
        $obj->setCreatedAt('2014-10-02 10:10:10');

        // assert same data
        $this->assertSame('pages', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(145, $obj->getCategoryId());
        $this->assertSame(39, $obj->getUserId());
        $this->assertSame('', $obj->getProfileName());
        $this->assertSame('Quaerat ea voluptatibus atque eos.',
            $obj->getTitle());
        $this->assertSame(0, $obj->getPhotoId());
        $this->assertSame(0, $obj->getCoverPhotoId());
        $this->assertSame(1, $obj->getLikeCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame('2014-10-02 10:10:10', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new Pages([
            'page_id'        => 3,
            'is_featured'    => 0,
            'is_sponsor'     => 0,
            'type_id'        => 5,
            'category_id'    => 145,
            'user_id'        => 39,
            'profile_name'   => null,
            'title'          => 'Quaerat ea voluptatibus atque eos.',
            'photo_id'       => 0,
            'cover_photo_id' => 0,
            'like_count'     => 1,
            'comment_count'  => 0,
            'created_at'     => '2014-10-02 10:10:10',
        ]);

        $obj->save();

        /** @var Pages $obj */
        $obj = _model('pages')
            ->select()->where('page_id=?', 3)->first();

        $this->assertSame('pages', $obj->getModelId());
        $this->assertSame(3, $obj->getId());
        $this->assertSame(0, $obj->isFeatured());
        $this->assertSame(0, $obj->isSponsor());
        $this->assertSame(5, $obj->getTypeId());
        $this->assertSame(145, $obj->getCategoryId());
        $this->assertSame(39, $obj->getUserId());
        $this->assertSame('', $obj->getProfileName());
        $this->assertSame('Quaerat ea voluptatibus atque eos.',
            $obj->getTitle());
        $this->assertSame(0, $obj->getPhotoId());
        $this->assertSame(0, $obj->getCoverPhotoId());
        $this->assertSame(1, $obj->getLikeCount());
        $this->assertSame(0, $obj->getCommentCount());
        $this->assertSame('2014-10-02 10:10:10', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _model('pages')
            ->delete()->where('page_id=?', 3)->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('pages')
            ->delete()->where('page_id=?', 3)->execute();
    }
}