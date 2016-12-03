<?php

namespace Phpfox\Storage;


class FilePathGenerator
{
    const FILE_NAME_LENGTH     = 16;
    const FILE_NAME_CHARACTERS = 'qwertyuiopasdfghjklzxcvbnm';

    public function generate($baseDir, $extension)
    {
        return $baseDir . date('/Y/m/d/') . $this->makeName()
            . strtolower($extension);
    }

    /**
     * @return string
     */
    private function makeName()
    {
        $name = '';
        $offset = strlen(self::FILE_NAME_CHARACTERS) - 1;
        for ($counter = 0; $counter < self::FILE_NAME_LENGTH; ++$counter) {
            $name .= substr(self::FILE_NAME_CHARACTERS, mt_rand(0, $offset), 1);
        }
        return $name;
    }

}