<?php

namespace Phpfox\Action;


class ActionController
{
    public function __construct()
    {
        $this->initialize();

        $this->checkSiteSettings();

        $this->initialized();
    }

    /**
     * If result false, user is blocked in offline page.
     *
     * @return bool
     */
    protected function passOfflineMode()
    {

        if (_param('core.offline_mode')) {
            $code = isset($_SESSION['offline_code']) ? $_SESSION['offline_code'] : 'none';
            if ($code != _param('core.offline_code')) {
                return false;
            }
        }

        return true;
    }

    /**
     * If result false, user is blocked in login page.
     *
     * @return bool
     */
    protected function passPrivateMode()
    {
        if (false == _param('core.private_mode')
            and false == _get('auth')->isLoggedIn()
        ) {
            return false;
        }
        return true;
    }

    /**
     * @return bool|false
     */
    protected function checkSiteSettings()
    {
        if (!$this->passOfflineMode()) {
            return $this->forward('core.offline', 'offline');
        } elseif (!$this->passPrivateMode()) {
            return $this->forward('user.auth', 'login');
        }

        return true;
    }

    protected function initialized()
    {

    }

    protected function initialize()
    {
    }

    protected function beforeDispatch($action)
    {

    }

    protected function afterDispatch($action)
    {
    }

    public function dispatch($action)
    {
        $this->beforeDispatch($action);

        if (!method_exists($this, $method = 'action' . _inflect($action))) {
            return $this->forward('core.error', '404');
        }

        $result = $this->{$method}();

        $this->afterDispatch($action);

        return $result;
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return bool
     */
    public function forward($controller, $action)
    {
        _get('dispatcher')->forward($controller, $action);
        return false;
    }
}