<?php

namespace Phpfox\Storage;


class LocalFileStorageTest extends \PHPUnit_Framework_TestCase
{
    public function provideConstructor()
    {
        return [
            [
                new LocalFileStorage([
                    'basePath'   => PHPFOX_DIR . 'public',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                ]),
            ],
            [
                new FtpFileStorage([
                    'basePath'   => PHPFOX_DIR . 'public',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                    'host'       => 'localhost',
                    'username'   => 'namnv',
                    'password'   => 'namnv123',
                    'port'       => 21,
                ]),
            ],
            [
                new Ssh2FileStorage([
                    'basePath'   => '/var/www/html/namnv/',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                    'host'       => '103.53.198.181',
                    'username'   => 'root',
                    'password'   => 'Qc@FoX2016',
                    'port'       => 22,
                ]),
            ],
        ];
    }

    /**
     *
     * @dataProvider provideConstructor
     *
     * @param FileStorageInterface $fileStorage
     */
    public function testConstructor($fileStorage)
    {
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
