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
     * @var SessionHandlerInterface
     */
    private $handler;

    public function __construct()
    {
        if (session_id()) {
            return;
        }

        // skip session storage
        if (PHP_SAPI == 'cli' || PHPFOX_NO_SESSION) {
            $this->handler = new NullSessionHandler();
            return;
        }

        $this->handler = \Phpfox::get('session.save_handler');
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return @$_SESSION[$id];
    }

    /**
     * @param string $id
     * @param string $value
     *
     * @return $this
     */
    public function set($id, $value)
    {
        $_SESSION[$id] = $value;
        return $this;
    }

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
     */
    public function start()
    {
        if (session_id()) {
            return false;
        }

        $this->handler->register();

        @session_start();

        return true;
    }
}