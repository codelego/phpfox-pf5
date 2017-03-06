<?php

namespace Phpfox\Layout;

class LayoutPage
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var LayoutLocation[]
     */
    protected $location = [];

    /**
     * @var array
     */
    protected $locationData = [];

    /**
     * prepare content
     */
    public function prepare()
    {
        $this->locationData = [];
        foreach ($this->location as $key => $location) {
            $this->locationData[$key] = $location->render();
        }
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return !empty($this->locationData[$key]);
    }

    /**
     * @return string
     */
    public function render()
    {
        return '';
    }
}