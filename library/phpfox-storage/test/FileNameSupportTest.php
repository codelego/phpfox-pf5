<?php

namespace Phpfox\Storage;


class FileNameSupportTest extends \PHPUnit_Framework_TestCase
{
    public function testMethods()
    {
        $fileName = \Phpfox::get('storage.file_name');
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
        echo $fileName->createName(null, null, '.txt'), PHP_EOL;
        echo $fileName->createName('profile', null, '.JPG'), PHP_EOL;
        echo $fileName->createName('profile', '{0}x{1}x{2}', '.png'), PHP_EOL;
    }
}
