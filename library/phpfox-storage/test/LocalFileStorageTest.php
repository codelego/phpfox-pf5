<?php

namespace Phpfox\Storage;


class LocalFileStorageTest extends \PHPUnit_Framework_TestCase
{
    public function provideConstructor()
    {
        return [
            [1],
            [2],
            [3],
        ];
    }

    /**
     *
     * @dataProvider provideConstructor
     *
     * @param mixed $id
     */
    public function testConstructor($id)
    {
        $fileStorage = \Phpfox::get('storage.manager')->get($id);
        $this->assertEquals(PHPFOX_BASE_URL . 'public/path/to/url.png',
            $fileStorage->mapUrl('public/path/to/url.png'));

        $this->assertEquals('http:///example.max-cdn.com/public/path/to/url.png',
            $fileStorage->mapCdnUrl('public/path/to/url.png'));

        $this->assertEquals($fileStorage->getUrl('test.jpg'),
            $fileStorage->mapCdnUrl('test.jpg'));

        $local = PHPFOX_DIR . 'data/temp/temp.txt';

        if (file_exists($local)) {
            unlink($local);
        }

        file_put_contents($local, '200 0k' . PHP_EOL . get_class($fileStorage));

        $name = \Phpfox::get('storage.file_name')
            ->createName(null, null, '.txt');

        $fileStorage->putFile($local, $name);

        unlink($local);

        $this->assertFileNotExists($local);

        $fileStorage->getFile($local . '.backup', $name);

        $this->assertFileExists($local . '.backup');

        $fileStorage->deleteFile($name);
    }
}
