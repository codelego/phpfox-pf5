<?php

namespace Neutron\Announcement\Model;

class AnnouncementExcludeTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new AnnouncementExclude([
            'exclude_id'      => 1,
            'announcement_id' => 3,
            'exclude_type'    => 'level_id',
            'exclude_value'   => 2,
        ]);

        $this->assertSame('announcement_exclude', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(3, $obj->getAnnouncementId());
        $this->assertSame('level_id', $obj->getExcludeType());
        $this->assertSame(2, $obj->getExcludeValue());
    }

    public function testParameters()
    {
        $obj = new AnnouncementExclude();

        // set data
        $obj->setId(1);
        $obj->setAnnouncementId(3);
        $obj->setExcludeType('level_id');
        $obj->setExcludeValue(2);

        // assert same data
        $this->assertSame('announcement_exclude', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(3, $obj->getAnnouncementId());
        $this->assertSame('level_id', $obj->getExcludeType());
        $this->assertSame(2, $obj->getExcludeValue());
    }

    public function testSave()
    {
        $obj = new AnnouncementExclude([
            'exclude_id'      => 1,
            'announcement_id' => 3,
            'exclude_type'    => 'level_id',
            'exclude_value'   => 2,
        ]);

        $obj->save();

        /** @var AnnouncementExclude $obj */
        $obj = _with('announcement_exclude')
            ->select()->where('exclude_id=?', 1)->first();

        $this->assertSame('announcement_exclude', $obj->getModelId());
        $this->assertSame(1, $obj->getId());
        $this->assertSame(3, $obj->getAnnouncementId());
        $this->assertSame('level_id', $obj->getExcludeType());
        $this->assertSame(2, $obj->getExcludeValue());
    }

    public static function setUpBeforeClass()
    {
        _with('announcement_exclude')
            ->delete()->where('exclude_id=?', 1)->execute();
    }

    public static function tearDownAfterClass()
    {
        _with('announcement_exclude')
            ->delete()->where('exclude_id=?', 1)->execute();
    }
}