<?php

namespace Phpfox\Router;


class FilterContainer
{

    /**
     * @var FilterInterface[]
     */
    protected $elements = [];

    /**
     * @var array
     */
    protected $map = [];

    /**
     * FilterContainer constructor.
     */
    public function __construct()
    {
        $this->map = config('router.filters');
    }

    /**
     * @param string $id
     *
     * @return FilterInterface
     */
    public function get($id)
    {
        return isset($this->elements[$id]) ? $this->elements[$id]
            : $this->elements[$id] = $this->build($id);
    }

    public function set($id, $value)
    {
        $this->map[$id] = $value;
        return $this;
    }

    /**
     * @param string $id
     *
     * @return FilterInterface
     * @throws RouteException
     */
    public function build($id)
    {
        if (!isset($this->map[$id])) {
            return new NullAwareFilter();
        }

        $ref = $this->map[$id];

        $factory = array_shift($ref);

        if (is_string($factory)) {
            return call_user_func_array([
                new $factory(),
                'factory',
            ], $ref);
        }

        $class = array_shift($ref);

        return new $class();
    }
}