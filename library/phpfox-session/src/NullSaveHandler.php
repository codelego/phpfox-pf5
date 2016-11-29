<?php

namespace Phpfox\Session;


class NullSaveHandler implements SaveHandlerInterface
{
    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        return true;
    }

    public function gc($maxlifetime)
    {
        return true;
    }

    public function open($save_path, $name)
    {
        return true;
    }

    public function read($session_id)
    {
        return '';
    }

    public function write($session_id, $session_data)
    {
        return true;
    }

}