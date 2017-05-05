<?php

namespace Phpfox\Action;

class Dispatcher
{
    /**
     * Forward loop max
     */
    const FORWARD_LIMIT = 4;

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

    /**
     * Get full action name
     *
     * @return string
     */
    public function getFullActionName()
    {
        return preg_replace('/\W+/', '_', _deflect(str_replace('Controller', '',
            $this->getController() . '.' . $this->getAction())));
    }

    /**
     * Get controller name
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set controller name
     *
     * @param $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action name
     *
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    public function run()
    {
        $runCounter = 0;
        $lastResult = null;

        $mvcRequest = _service('request');
        $router = _service('router');

        $parameters = $router->run($mvcRequest->getPath(),
            $mvcRequest->getHost(),
            $mvcRequest->getMethod(), $mvcRequest->getProtocol());


        $this->controller = $parameters->get('controller');
        $this->action = $parameters->get('action');

        if (empty($this->controller) || empty($this->action)) {
            $this->controller = 'core.error';
            $this->action = '404';
        } else {
            $mvcRequest->add($parameters->all());
        }

        do {
            try {
                $this->completed = true;

                $class = _service('controller.provider')
                    ->get($this->controller);

                if (null == $class || !class_exists($class)) {
                    exit("Unexpected controller '{$this->controller}'");
                }

                /** @var ActionController $controller */
                $controller = new $class();

                if (!$this->completed) {
                    continue;
                }

                $lastResult = $controller->run($this->action);

                // continue if forward
                if (!$this->completed) {
                    continue;
                }

                _service('response')
                    ->setData($lastResult)
                    ->terminate();

            } catch (\Exception $exception) {
                $this->lastException = $exception;
                $this->forward('core.error', 'index');
            }
        } while (!$this->completed and ++$runCounter < self::FORWARD_LIMIT);

        if (!$this->completed) {
            throw $this->lastException;
        }

        return true;
    }

    /**
     * @param string $controller
     * @param string $action
     *
     * @return bool
     */
    public function forward($controller, $action)
    {
        $this->completed = false;

        if (null != $controller) {
            $this->controller = $controller;
        }

        $this->action = $action;

        return false;
    }

    /**
     * @return \Exception|null
     */
    public function getLastException()
    {
        return $this->lastException;
    }
}