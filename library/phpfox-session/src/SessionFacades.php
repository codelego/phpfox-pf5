<?php

namespace Phpfox\Session;

class SessionFacades
{
    protected $started = false;

    public function __construct()
    {
        $this->start();
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
        if ($this->started) {
            return false;
        }

        $this->started = true;

        $parameter = _get('package.loader')->getSessionParameter('');

        $class = $parameter->get('driver');

        /** @var SessionInterface $handler */
        $handler = new $class($parameter->get('params', []));

        $handler->register();

        $php_ini = (bool)$parameter->get('php_ini');

        if (!$php_ini) {
            $name = $parameter->get('name');
            $lifetime = (int)$parameter->get('cookie_lifetime');
            $max_lifetime = (int)$parameter->get('gc_maxlifetime');
            $path = $parameter->get('cookie_path');
            $domain = $parameter->get('cookie_domain');
            $httponly = (bool)$parameter->get('cookie_httponly');
            $secure = (bool)$parameter->get('cookie_secure');

            if (!$name) {
                $name = 'PHPSESSID';
            }

            if ($max_lifetime < 60) {
                $max_lifetime = 14440;
            }

            if ($lifetime < 0) {
                $lifetime = 0;
            }

            $path = str_replace('//', '/', '/' . trim($path, '/') . '/');

            if (!$domain) {
                $domain = null;
            }

            // can not share the same cookie name between http and https
            // let's append `_http` to original name to allow login via http://
            // this is a browser feature not a bugs.
            if ($secure and !PHPFOX_IS_HTTPS) {
                $secure = false;
                $name = $name . '_http';
            }

            session_name($name);
            ini_set('session.gc_maxlifetime', $max_lifetime);
            session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
        }


        if (!session_id() and !headers_sent()) {
            @session_start();
        }

        return true;
    }

    /**
     * @see session_destroy
     */
    public function destroy()
    {
        if (session_id()) {
            session_destroy();
        }
    }

    /**
     * call session_commit
     *
     * @see session_commit
     */
    public function close()
    {
        if (session_id()) {
            session_commit();
        }
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function delete($key)
    {
        if (isset($_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    public function remember()
    {
        // how to implement remember me ?
    }
}