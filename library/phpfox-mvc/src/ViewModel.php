<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

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
        return service('template')->parital($this->template, $this->variables);
    }

    public function terminate()
    {
    }
}