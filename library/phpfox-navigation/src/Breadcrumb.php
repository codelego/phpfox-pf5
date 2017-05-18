<?php

namespace Phpfox\Navigation;


use Phpfox\View\ViewModel;

class Breadcrumb
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param array $item
     *
     * @return $this
     */
    public function set($item)
    {
        $this->data = [$item];
        return $this;
    }

    /**
     * @param array $item
     *
     * @return $this
     */
    public function add($item)
    {
        $this->data[] = $item;
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return (new ViewModel(['items' => $this->data],
            'layout/breadcrumb'))->render();
    }

    /**
     * Clear data
     *
     * @return $this
     */
    public function clear()
    {
        $this->data = [];
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
}