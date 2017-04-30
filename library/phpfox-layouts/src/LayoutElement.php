<?php

namespace Phpfox\Layout;

use Phpfox\View\ViewModel;

class LayoutElement
{
    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutElement constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function render()
    {
        $cls = $this->get('block_class');

        if (!class_exists($cls)) {
            return '';
        }

        /** @var LayoutBlock $block */
        $block = new $cls($this->params);

        $result = $block->run();

        if (is_string($result)) {
            return $result;
        } else {
            if ($result instanceof ViewModel) {
                return $result->render();
            }
        }
        return '';
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->params;
    }

}