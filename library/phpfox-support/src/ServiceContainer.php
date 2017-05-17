<?php

namespace Phpfox\Support;

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
        return _param('services', $key) != null;
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
        $ref = _param('services', $id);

        if (!$ref) {
            throw new \InvalidArgumentException("Unexpected '{$id}'");
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