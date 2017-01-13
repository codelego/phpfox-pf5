<?php

namespace Phpfox\View;

class ViewModel
{
    /**
     * @var string
     */
    public $template;

    /**
     * @var array
     */
    public $data = [];

    /**
     * ViewModel constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param array $variables
     */
    public function assign($variables)
    {
        foreach ($variables as $name => $value) {
            $this->data[$name] = $value;
        }
    }

    public function render()
    {
        if (null == $this->template) {
            return '';
        }

        return \Phpfox::getTemplate()
            ->render($this->template, $this->data);
    }

    /**
     * @return void
     */
    public function terminate()
    {
    }
}