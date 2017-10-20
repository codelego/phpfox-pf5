<?php

namespace Neutron\Dev;


class AbstractGenerator
{
    protected function putContents($filename, $data)
    {
        $errors = $this->ensureWritable([
            $filename,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        $filename = PHPFOX_DIR . $filename;

        file_put_contents($filename, $data);

        if (file_exists($filename)) {
            @chmod($filename, 0777);
        }
    }


    /**
     * Ensure filename is writable
     *
     * @param array $files
     *
     * @return string
     */
    public function ensureWritable($files)
    {
        $errors = [];

        foreach ($files as $filename) {
            if (!is_dir($dir = dirname(PHPFOX_DIR . $filename))) {
                if (!@mkdir($dir, 0777, true)) {
                    $errors[] = 'mkdir -p ' . $dir;
                } else {
                    @chmod($dir, 0777);
                }
            }
            if (!is_writable($dir = dirname(PHPFOX_DIR . $filename))) {
                $errors[] = 'chmod 777 ' . $dir;
            }

            if (file_exists($filename = PHPFOX_DIR . $filename) and !is_writeable($filename)) {
                $errors[] = 'chmod 777 ' . $filename;
            }
        }
        return implode('<br />', $errors);
    }

}