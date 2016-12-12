<?php

namespace Phpfox\Mvc;

class MvcDispatch
{
    /**
     * Forward loop max
     */
    const FORWARD_LIMIT = 3;

    /**
     * @var bool
     */
    protected $completed = false;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var \Exception
     * Last exception
     */
    protected $lastException;

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
        $runCounter = 0;
        $lastResult = null;

        $mvcRequest = \Phpfox::get('mvc.request');
        $router = \Phpfox::get('router');

        $parameters = $router->run($mvcRequest->getUri(),
            $mvcRequest->getHost(),
            $mvcRequest->getMethod(), $mvcRequest->getProtocol());

        $this->controller = $parameters->get('controller');
        $this->action = $parameters->get('action');

        if (empty($this->controller) || empty($this->action)) {
            $this->controller = 'core.error';
            $this->action = '404';
        } else {
            $mvcRequest->addParams($parameters->all());
        }

        do {
            try {
                $this->completed = true;

                $lastResult = $this->createController()
                    ->run($this->action);

                // continue if forward
                if (!$this->completed) {
                    continue;
                }

                \Phpfox::get('mvc.response')
                    ->setData($lastResult)
                    ->terminate();

            } catch (\Exception $exception) {
                $this->lastException = $exception;
                $this->forward('core.error', 'index');
            }
        } while (!$this->completed and ++$runCounter < self::FORWARD_LIMIT);

        if (!$this->completed) {
            exit("Can not pass thought");
        }

        return true;
    }

    /**
     * @ignore
     * @return MvcController
     */
    protected function createController()
    {
        $class = \Phpfox::get('controller.provider')
            ->get($this->controller);

        if (null == $class) {
            throw new \InvalidArgumentException("Unexpected controller '{$this->controller}'");
        }

        return new $class;
    }

    public function forward($controller, $action)
    {
        $this->completed = false;

        if (null != $controller) {
            $this->controller = $controller;
        }

        $this->action = $action;

        return true;
    }

    public function getLastException()
    {
        return $this->lastException;
    }
}