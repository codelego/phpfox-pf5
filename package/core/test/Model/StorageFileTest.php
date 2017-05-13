<?php

namespace Neutron\Core\Model;

class StorageFileTest extends \PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $obj = new StorageFile();

        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame('', $obj->getFileId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getFileSize());
        $this->assertSame('', $obj->getUserId());
        $this->assertSame('', $obj->getFileMime());
        $this->assertSame('', $obj->getPaths());
        $this->assertSame('', $obj->getCreatedAt());
    }

    public function testParameters()
    {
        $obj = new StorageFile();

        // set data
        $obj->setFileId('');
        $obj->setAdapterId('');
        $obj->setFileSize('');
        $obj->setUserId('');
        $obj->setFileMime('');
        $obj->setPaths('');
        $obj->setCreatedAt('');
        // assert same data
        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame('', $obj->getFileId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getFileSize());
        $this->assertSame('', $obj->getUserId());
        $this->assertSame('', $obj->getFileMime());
        $this->assertSame('', $obj->getPaths());
        $this->assertSame('', $obj->getCreatedAt());
    }

    public function testSave()
    {
        $obj = new StorageFile();

        $obj->save();

        /** @var StorageFile $obj */
        $obj = _model('storage_file')
            ->select()->where('file_id=?', '')->first();

        $this->assertSame('storage_file', $obj->getModelId());
        $this->assertSame('', $obj->getFileId());
        $this->assertSame('', $obj->getAdapterId());
        $this->assertSame('', $obj->getFileSize());
        $this->assertSame('', $obj->getUserId());
        $this->assertSame('', $obj->getFileMime());
        $this->assertSame('', $obj->getPaths());
        $this->assertSame('', $obj->getCreatedAt());
    }

    public static function setUpBeforeClass()
    {
        _model('storage_file')
            ->delete()->where('file_id=?', '')->execute();
    }

    public static function tearDownAfterClass()
    {
        _model('storage_file')
            ->delete()->where('file_id=?', '')->execute();
    }
}