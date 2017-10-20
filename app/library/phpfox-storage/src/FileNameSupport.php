<?php

namespace Phpfox\Storage;


class FileNameSupport
{
    /**
     * filename length
     */
    const FILE_NAME_LENGTH = 4;

    /**
     * string to generate file name
     */
    const FILE_NAME_CHARACTERS = 'qwertyuiopasdfghjklzxcvbnm0123456789';

    public function createName($baseDir, $token, $extension)
    {
        if ($token) {
            $token = '-' . $token;
        }
        return $baseDir . date('/Y/m/d/aHis') . $this->uniqueName() . $token
            . strtolower($extension);
    }

    /**
     * @return string
     */
    private function uniqueName()
    {
        $name = '';
        $offset = strlen(self::FILE_NAME_CHARACTERS) - 1;
        for ($counter = 0; $counter < self::FILE_NAME_LENGTH; ++$counter) {
            $name .= substr(self::FILE_NAME_CHARACTERS, mt_rand(0, $offset), 1);
        }
        return $name;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getExtension($name)
    {
        if (false != ($pos = strrpos($name, '.'))) {
            return strtolower(substr($name, $pos));
        }
        return '';
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getBaseName($name)
    {
        if (preg_match('/([^\/\\\\]+)$/', $name, $matches)) {
            return $matches[0];
        }
        return '';
    }
}