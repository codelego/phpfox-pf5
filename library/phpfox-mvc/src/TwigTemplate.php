<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam
 * lacinia accumsan. Etiam sed turpis ac ipsum condimentum fringilla. Maecenas
 * magna. Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque
 * sagittis ligula eget metus. Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Phpfox\Mvc;


class TwigTemplate implements ViewRenderInterface
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $map;

    public function __construct()
    {
        $this->twig = new \Twig_Environment(service('view.loader'), []);
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return string
     */
    public function render($name, $data)
    {
        return $this->twig->render($name, $data);
    }
}