<?php

namespace Phpfox\Support;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class InterventionImageManager extends ImageManager
{
    public function createThumbnail()
    {

    }

    /**
     * Initiates an Image instance from different input types
     *
     * @param  mixed $source
     *
     * @return \Intervention\Image\Image
     */
    public function make($source)
    {
        if (is_string($source) and (substr($source, 0, 7) == 'http://'
                or substr($source,
                    0, 8) == 'https://')
        ) {
            $source = _service('curl')->factory($source)->getString();
        }

        return parent::make($source);
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public function chop($string)
    {
        $array = preg_split('/\s+/', trim($string));

        $size = array_shift($array);
        $constraint = array_shift($array);

        list($width, $height) = explode('x', $size);

        $width = intval($width);
        $height = intval($height);

        if (!$width) {
            $width = null;
        }

        if (!$height) {
            $height = null;
        }

        $constraint = strtolower((string)$constraint);

        return [$width, $height, $constraint];
    }

    /**
     * @param Image  $image
     * @param string $path
     * @param array  $sizes
     *
     * @return array
     */
    public function thumbs($image, $path, $sizes)
    {
        $files = [];
        try {
            foreach ($sizes as $key => $value) {
                list($width, $height, $constraint) = $this->chop($value);

                $destination = _sprintf($path, ['size' => $key]);

                switch ($constraint) {
                    case 'upsize':
                        $image->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->save($destination, null);
                        break;
                    case 'resize':
                        $image->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($destination, null);
                        break;
                    case 'fit':
                    default:
                        $image->fit($width, $height)->save($destination, null);
                        break;
                }

                $files[$key] = $destination;
            }
            return $files;
        } catch (\Exception $ex) {
            $this->removeFiles($files);
        }
    }

    public function removeFiles($files)
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }
    }
}