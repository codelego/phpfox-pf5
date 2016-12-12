<?php

namespace Phpfox\Mvc;


class MvcController
{
    public function run($action)
    {
        if (!method_exists($this, $method = 'action' . _inflect($action))) {
            return $this->forward('core.error', '404');
        }
        return $this->{$method}();
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return false
     */
    public function forward($controller, $action)
    {
        return \Phpfox::get('mvc.dispatch')->forward($controller, $action);
    }

    function __call($name, $arguments)
    {
    }
}