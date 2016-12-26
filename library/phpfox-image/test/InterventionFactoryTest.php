<?php

namespace Phpfox\Image;


use Intervention\Image\ImageManager;

class InterventionFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBase()
    {
        $result = (new InterventionFactory())->factory();

        $this->assertTrue($result instanceof ImageManager);
    }
}
