<?php

namespace Phpfox\Session;


class SessionHandlerNull implements SessionHandlerInterface, \SessionHandlerInterface
{
    public function register()
    {
        session_set_save_handler($this);
    }

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        if ($session_id) {
            ;
        }
        return true;
    }

    public function gc($maxlifetime)
    {
        if ($maxlifetime) {
            ;
        }
        return true;
    }

    public function open($save_path, $name)
    {
        if ($save_path) {
            ;
        }

        if ($name) {
            ;
        }
        return true;
    }

    public function read($session_id)
    {
        if ($session_id) {
            ;
        }
        return '';
    }

    public function write($session_id, $session_data)
    {
        if ($session_id) {
            ;
        }
        if ($session_data) {
            ;
        }
        return true;
    }

}