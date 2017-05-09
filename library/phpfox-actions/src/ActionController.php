<?php

namespace Phpfox\Action;


class ActionController
{
    public function __construct()
    {
        $this->initialize();

        $this->initialized();
    }

    protected function initialized()
    {

    }

    protected function initialize()
    {
    }

    protected function startDispatch($action)
    {

    }

    protected function postDispatch($action)
    {
//        if (in_array($action, ['index'])) {
//            _service('menu.admin.buttons')->load('admin.core.i18n.currency.buttons');
//        }
    }

    public function run($action)
    {
        if (!method_exists($this, $method = 'action' . _inflect($action))) {
            return $this->forward('core.error', '404');
        }

        $this->startDispatch($action);
        $result = $this->{$method}();

        $this->postDispatch($action);

        return $result;
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return false
     */
    public function forward($controller, $action)
    {
        return _service('dispatcher')->forward($controller, $action);
    }
}