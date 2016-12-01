<?php

namespace Phpfox\Mvc;

use Phpfox\Router\RouteManager;
use Phpfox\Router\RouteResult;

class Dispatch
{
    /**
     * Forward loop max
     */
    const FORWARD_LIMIT = 3;

    /**
     * @var bool
     */
    protected $dispatched = false;

    /**
     * @var string
     */
    protected $controller = '';

    /**
     * @var string
     */
    protected $action = 'index';

    /**
     * @var \Exception
     */
    protected $lastException;

    public function isDispatched()
    {
        return $this->dispatched;
    }

    public function setDispatched($flag)
    {
        $this->dispatched = (bool)$flag;
        return $this;
    }

    public function getFullActionName()
    {
        return preg_replace('/\W+/', '_', _deflect(str_replace('Controller', '',
            $this->getController() . '.' . $this->getAction())));
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @ignore
     */
    protected function createController()
    {
        $class = \Phpfox::getConfig('controller.map', $this->controller);

        if (null == $class) {
            throw new \InvalidArgumentException("There are no controller object");
        }

        return new $class();
    }

    public function forward($controller, $action)
    {
        $this->setController($controller)->setAction($action);

        return false;
    }

    public function run()
    {
        $loop = self::FORWARD_LIMIT;
        $lastDispatchResult = null;

        /** @var Request $request */
        $request = \Phpfox::get('mvc.request');

        /** @var RouteManager $router */
        $router = \Phpfox::get('router');

        /** @var RouteResult $routeResult */
        $routeResult = $router->resolve($request->getUri(), $request->getHost(),
            $request->getMethod(), $request->getProtocol());

        $routeResult->ensure();

        $this->setController($routeResult->getController());
        $this->setAction($routeResult->getAction());
        $request->addParams($routeResult->getParams());

        do {
            try {
                $this->dispatched = true;

                $lastDispatchResult = $this->createController()
                    ->resolve($this->action);

                // continue if forward
                if(!$this->dispatched)
                    continue;

                \Phpfox::get('mvc.response')
                    ->setData($lastDispatchResult)
                    ->terminate();

            } catch (\Exception $exception) {
                var_dump($exception);
                $this->lastException = $exception;
                $this->forward('core.error', 'error');
            }
        } while ($this->dispatched == false and --$loop > 0);

        if(!$this->dispatched){
            exit("Can not pass thought");
        }

        return true;
    }

    public function getLastException()
    {
        return $this->lastException;
    }

    public function setLastException($lastException)
    {
        $this->lastException = $lastException;
    }
}