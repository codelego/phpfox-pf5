<?php

namespace Phpfox\Mvc;

class ServiceManager
{
    /**
     * @var array
     */
    protected $container = [];

    /**
     * ServiceManager constructor.
     */
    public function __construct()
    {
        $this->container['self'] = $this;
    }

    /**
     * @param string $id
     * @param mixed  $service
     *
     * @return $this
     */
    public function set($id, $service)
    {
        $this->container[$id] = $service;

        return $this;
    }

    /**
     * Has service associate with "id"?
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return \Phpfox::getParam('services', $id) != null;
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return isset($this->container[$id]) ? $this->container[$id]
            : $this->container[$id] = $this->factory($id);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function factory($id)
    {
        $ref = \Phpfox::getParam('services', $id);

        if (!$ref) {
            throw new \InvalidArgumentException("There are no service identity '{$id}'");
        }

        if (is_string($ref)) {
            return new $ref();
        }

        $factory = array_shift($ref);

        if (is_string($factory)) {
            return call_user_func_array([
                new $factory(),
                'factory',
            ], $ref);
        }

        $class = array_shift($ref);

        if (empty($ref)) {
            return new $class();
        }

        return (new \ReflectionClass($class))->newInstanceArgs($ref);
    }

    /**
     * @link http://php.net/manual/en/language.oop5.magic.php#object.sleep
     * @return array
     */
    public function __sleep()
    {
        return ['configs'];
    }

    /**
     * Support magic way to call $service($id) as $service->get($id)
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __invoke($id)
    {
        return isset($this->container[$id]) ? $this->container[$id]
            : $this->container[$id] = $this->factory($id);
    }
}