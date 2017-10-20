<?php

namespace Phpfox\Storage;


class FileNameSupportTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $fileName = _get('storage.file_name');
        $this->assertEquals('.txt', $fileName->getExtension('\ext\test.txt'));
        $this->assertEquals('.txt', $fileName->getExtension('/ext/test.txt'));
        $this->assertEquals('', $fileName->getExtension('/ext/test'));
        $this->assertEquals('test.txt',
            $fileName->getBaseName('/abc\ext/test.txt'));
        $this->assertEquals('test.txt',
            $fileName->getBaseName('/any/path\ext\test.txt'));
        $this->assertEquals('abc-test.txt',
            $fileName->getBaseName('abc-test.txt'));
        $this->assertEquals('abc-test',
            $fileName->getBaseName('abc-test/abc-test/abc-test'));

        $this->assertNotNull($fileName->createName(null, null, '.txt'));
        $this->assertNotNull($fileName->createName('profile', null, '.JPG'));
        $this->assertNotNull($fileName->createName('profile', '{0}x{1}x{2}',
            '.png'));
    }
}
