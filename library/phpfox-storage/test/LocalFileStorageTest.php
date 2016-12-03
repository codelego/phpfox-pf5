<?php

namespace Phpfox\Storage;


class LocalFileStorageTest extends \PHPUnit_Framework_TestCase
{

    public function provideConstructor()
    {
        return [
            [
                LocalFileStorage::class,
                [
                    'basePath'   => PHPFOX_DIR . 'public',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                ],
            ],
            [
                FtpFileStorage::class,
                [
                    'basePath'   => PHPFOX_DIR . 'public',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                    'host'       => 'localhost',
                    'username'   => 'namnv',
                    'password'   => 'namnv123',
                    'port'       => 21,
                ],
            ],
            [
                Ssh2FileStorage::class,
                [
                    'basePath'   => '/var/www/html/namnv/',
                    'baseUrl'    => PHPFOX_BASE_URL,
                    'baseCdnUrl' => 'http:///example.max-cdn.com/',
                    'host'       => '103.53.198.181',
                    'username'   => 'root',
                    'password'   => 'Qc@FoX2016',
                    'port'       => 22,
                ],
            ],
        ];
    }

    /**
     * @param $class
     * @param $params
     *
     * @dataProvider provideConstructor
     */
    public function testConstructor($class, $params)
    {
        /** @var FileStorageInterface $fileStorage */
        $fileStorage = new $class($params);

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

        $name = (new FilePathGenerator())->generate('doc', '.txt');

        $fileStorage->putFile($local, $name);
    }
}
