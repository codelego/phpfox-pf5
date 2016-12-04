<?php
namespace Phpfox\Session;


/**
 * Class SessionManager
 *
 * @package Phpfox\Session
 */
class SessionManager
{
    /**
     * @see session_destroy
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * call session_commit
     *
     * @see session_commit
     */
    public function close()
    {
        session_commit();
    }

    /**
     * Start session manager
     *
     * @see session_start
     *
     * @return bool
     */
    public function start()
    {
        if (session_id()) {
            return false;
        }

        \Phpfox::get('session.save_handler')->register();

        @session_start();

        return true;
    }
}