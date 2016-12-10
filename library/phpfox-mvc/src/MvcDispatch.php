<?php

namespace Phpfox\Mvc;

use Phpfox\Router\Result;
use Phpfox\Router\Router;

class MvcDispatch
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

    public function run()
    {
        $loop = self::FORWARD_LIMIT;
        $lastDispatchResult = null;

        /** @var MvcRequest $request */
        $request = \Phpfox::get('mvc.request');

        /** @var Router $router */
        $router = \Phpfox::get('router');

        /** @var Result $parameters */
        $parameters = $router->run($request->getUri(), $request->getHost(),
            $request->getMethod(), $request->getProtocol());


        $parameters->ensure();

        $this->controller = $parameters->get('controller');
        $this->action = $parameters->get('action');

        $request->addParams($parameters->all());

        do {
            try {
                $this->dispatched = true;

                $lastDispatchResult = $this->createController()
                    ->resolve($this->action);

                // continue if forward
                if (!$this->dispatched) {
                    continue;
                }

                \Phpfox::get('mvc.response')
                    ->setData($lastDispatchResult)
                    ->terminate();

            } catch (\Exception $exception) {
                $this->lastException = $exception;
                $this->forward('core.error', 'index');
            }
        } while ($this->dispatched == false and --$loop > 0);

        if (!$this->dispatched) {
            exit("Can not pass thought");
        }

        return true;
    }

    /**
     * @ignore
     */
    protected function createController()
    {
        $class = \Phpfox::getParam('controllers', $this->controller);

        if (null == $class) {
            throw new \InvalidArgumentException("There are no controller object");
        }

        return new $class;
    }

    public function forward($controller, $action)
    {
        $this->dispatched = false;

        if (null != $controller) {
            $this->controller = $controller;
        }

        if (null != $action) {
            $this->action = $action;
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