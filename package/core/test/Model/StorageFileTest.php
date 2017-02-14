<?php

namespace Neutron\Core\Model;

class StorageFileTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageFile(['file_id'    => 11,
                                'adapter_id' => 2,
                                'file_size'  => 8749484,
                                'user_id'    => 22,
                                'file_mime'  => 'image/jpeg',
                                'paths'      => '[]',
                                'created_at' => '2015-01-12 00:00:00',
        ]);

        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame(11, $obj->getId());
        $this->assertSame(2, $obj->getAdapterId());
        $this->assertSame(8749484, $obj->getFileSize());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('image/jpeg', $obj->getFileMime());
        $this->assertSame('[]', $obj->getPaths());
        $this->assertSame('2015-01-12 00:00:00', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new StorageFile();

        // set data
        $obj->setId(11);
        $obj->setAdapterId(2);
        $obj->setFileSize(8749484);
        $obj->setUserId(22);
        $obj->setFileMime('image/jpeg');
        $obj->setPaths('[]');
        $obj->setCreatedAt('2015-01-12 00:00:00');

        // assert same data
        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame(11, $obj->getId());
        $this->assertSame(2, $obj->getAdapterId());
        $this->assertSame(8749484, $obj->getFileSize());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('image/jpeg', $obj->getFileMime());
        $this->assertSame('[]', $obj->getPaths());
        $this->assertSame('2015-01-12 00:00:00', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new StorageFile(['file_id'    => 11,
                                'adapter_id' => 2,
                                'file_size'  => 8749484,
                                'user_id'    => 22,
                                'file_mime'  => 'image/jpeg',
                                'paths'      => '[]',
                                'created_at' => '2015-01-12 00:00:00',
        ]);

        $obj->save();

        /** @var StorageFile $obj */
        $obj = \Phpfox::with('storage_file')
            ->select()->where('file_id=?', 11)->first();

        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame(11, $obj->getId());
        $this->assertSame(2, $obj->getAdapterId());
        $this->assertSame(8749484, $obj->getFileSize());
        $this->assertSame(22, $obj->getUserId());
        $this->assertSame('image/jpeg', $obj->getFileMime());
        $this->assertSame('[]', $obj->getPaths());
        $this->assertSame('2015-01-12 00:00:00', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        \Phpfox::with('storage_file')
            ->delete()->where('file_id=?', 11)->execute();
    }

    public static function tearDownAfterClass()
    {
        \Phpfox::with('storage_file')
            ->delete()->where('file_id=?', 11)->execute();
    }
}