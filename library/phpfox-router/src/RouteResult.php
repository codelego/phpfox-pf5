<?php
namespace Phpfox\Router;

/**
 * Class RouteResult
 *
 * @package Phpfox\Router
 */
class RouteResult
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->getParam('action');
    }

    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed|null
     */
    public function getParam($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * This method clear old params and set by new params.
     *
     * @param array $params
     *
     * @return $this
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * Reset old data
     */
    public function reset()
    {
        $this->params = [];
    }

    public function ensure()
    {
        if (null == $this->getControllerName()) {
            $this->setControllerName('Core\Controller\ErrorController');
            $this->setActionName('404');
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->getParam('controller');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setControllerName($value)
    {
        $this->params['controller'] = $value;
        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setActionName($value)
    {
        $this->params['action'] = $value;
        return $this;
    }
}