<?php

namespace Phpfox\Image;

use Intervention\Image\ImageManager;

class InterventionFactory
{
    public function factory()
    {
        return new ImageManager();

    }
}