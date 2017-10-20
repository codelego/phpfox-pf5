<?php

namespace Phpfox\Session;

class FilesSession implements SessionInterface
{
    public function register()
    {
        $save_path = PHPFOX_SESSION_DIR;

        if (!is_dir($save_path) && mkdir($save_path, true, 0777)) {
            @chmod($save_path, 0777);
        }

        ini_set('session.save_handler', 'files');
        ini_set('session.save_path', $save_path);

        return true;
    }
}