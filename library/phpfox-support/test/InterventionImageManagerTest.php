<?php

namespace Phpfox\Support;


use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class InterventionImageManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $manager = new InterventionImageManager();

        $this->assertTrue($manager instanceof ImageManager);
    }

    public function testMakeLocal()
    {
        $manager = new InterventionImageManager();

        $image = $manager->make(realpath(__DIR__
            . '/assets/img_300x300.jpeg'));

        $this->assertTrue($image instanceof Image);
    }

    public function testMakeFromRemote()
    {
        $manager = new InterventionImageManager();

        $destination = __DIR__ . '/assets/result_300x300.jpg';

        $image
            = $manager->make('http://www.rockpapershotgun.com/images/16/mar/foxerheader.jpg');

        $this->assertTrue($image instanceof Image);

        $image->blur(10)->save($destination);

        $this->assertTrue(file_exists($destination));

        @unlink($destination);
    }

    public function testFitResizeLarge()
    {

        $manager = new InterventionImageManager();

        $source = __DIR__ . '/assets/img_1280x720.jpg';
        $path = __DIR__ . '/assets/fit_resize_1280x720_{size}.jpg';

        $image = $manager->make($source);

        $sizes = [
            'origin' => '1024x720',
            'md'     => '860x600',
            'sm'     => '640x400',
            'xs'     => '320x320',
            'n'      => '100x100',
            'q'      => '50x50',
        ];

        $result = $manager->thumbs($image, $path, $sizes);

        $size = getimagesize($result['origin']);

        $this->assertEquals('1024', $size[0]);
        $this->assertEquals('720', $size[1]);

        $size = getimagesize($result['q']);

        $this->assertEquals('50', $size[0]);
        $this->assertEquals('50', $size[1]);

        $this->removeFiles($result);
    }

    private function removeFiles($files)
    {
        foreach ($files as $file) {
            unlink($file);
        }
    }

    public function testFitResizeSmall()
    {

        $manager = new InterventionImageManager();

        $source = __DIR__ . '/assets/img_300x300.jpeg';
        $path = __DIR__ . '/assets/fit_resize_300x300_{size}.jpg';

        $image = $manager->make($source);

        $sizes = [
            'origin' => '1024x720 resize',
            'md'     => '860x600 resize',
            'sm'     => '640x400 resize',
            'xs'     => '220x220 fit',
            'n'      => '100x100 fit',
            'q'      => '50x50 fit',
        ];

        $result = $manager->thumbs($image, $path, $sizes);


        $size = getimagesize($result['origin']);

        $this->assertEquals('720', $size[0]);
        $this->assertEquals('720', $size[1]);

        $size = getimagesize($result['q']);

        $this->assertEquals('50', $size[0]);
        $this->assertEquals('50', $size[1]);

        $this->removeFiles($result);
    }
}
