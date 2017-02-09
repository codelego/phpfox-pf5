<?php
namespace Phpfox\Session;

class FilesSession implements SessionInterface
{
    public function register()
    {
        if (!is_dir($save_path = PHPFOX_DIR . '/data/session')
            && mkdir($save_path, true, 0777)
        ) {
            @chmod($save_path, 0777);
        }
        $save_path = PHPFOX_DIR . 'data/session';

        ini_set('session.save_handler', 'files');
        ini_set('session.save_path', $save_path);

        return true;
    }
}