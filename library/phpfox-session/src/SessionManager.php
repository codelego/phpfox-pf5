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
     * @var SaveHandlerInterface
     */
    private $saveHandler = "files";

    public function __construct($configs)
    {
        if (session_id()) {
            return;
        }

        // skip session storage
        if (PHP_SAPI == 'cli' || PHPFOX_NO_SESSION) {
            $this->saveHandler = new NullSaveHandler();
            return;
        }

        $this->saveHandler = $configs['handler'];
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
     * Start session manager
     *
     * @return bool always true.
     */
    public function start()
    {
        if (session_id()) {
            return false;
        }

        session_set_save_handler($this->saveHandler);

        @session_start();

        return true;
    }
}