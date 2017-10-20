<?php

namespace Phpfox\Kernel;

class ServiceContainer
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
        $this->container['manager'] = $this;
    }

    /**
     * Has service associate with "id"?
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return \Phpfox::param('services', $key) != null;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->container[$key]) ? $this->container[$key]
            : $this->container[$key] = $this->build($key);
    }

    /**
     * @param string $key
     * @param object $value
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function build($id)
    {
        $ref = \Phpfox::param('services', $id);
        $service = null;

        if (!$ref) {
            throw new \InvalidArgumentException("Unexpected '{$id}'");
        }

        if (is_string($ref)) {
            $service = new $ref();
        } else {
            $factory = array_shift($ref);

            if (is_string($factory)) {
                $service = call_user_func_array([new $factory(), 'factory',], $ref);
            } else {

                $class = array_shift($ref);

                if (empty($ref)) {
                    $service = new $class();
                } else {
                    $service = (new \ReflectionClass($class))->newInstanceArgs($ref);
                }
            }
        }
        return $service;
    }

    /**
     * @link http://php.net/manual/en/language.oop5.magic.php#object.sleep
     * @return array
     * Do not storage data to serialization, all service will be re-init
     * @codeCoverageIgnore
     */
    public function __sleep()
    {
        return [];
    }

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function __debugInfo()
    {
        return array_keys($this->container);
    }
}