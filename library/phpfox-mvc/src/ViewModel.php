<?php

namespace Phpfox\Mvc;

class ViewModel
{
    /**
     * @var string
     */
    public $template = '';

    /**
     * @var array
     */
    public $variables = [];

    /**
     * ViewModel constructor.
     *
     * @param string $template
     * @param array  $variables
     */
    public function __construct($template = null, $variables = [])
    {
        $this->template = $template;
        $this->variables = $variables;
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
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param array $variables
     *
     * @return $this
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
        return $this;
    }

    /**
     * @param array $variables
     *
     * @return $this
     */
    public function assign($variables)
    {
        foreach ($variables as $name => $value) {
            $this->variables[$name] = $value;
        }
        return $this;
    }

    public function forge()
    {
        return \Phpfox::get('template')->parital($this->template, $this->variables);
    }

    public function terminate()
    {
    }
}