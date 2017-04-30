<?php

namespace Phpfox\Breadcrumb;


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
        $this->data = $item;
        return $this;
    }

    /**
     * @param array $item
     * @param bool  $clear value = false, true
     *
     * @return $this
     */
    public function add($item, $clear = false)
    {
        if ($clear) {
            $this->data = [];
        }
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

    public function clear()
    {
        $this->data = [];
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->data);
    }
}