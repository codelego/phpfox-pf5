<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam
 * lacinia accumsan. Etiam sed turpis ac ipsum condimentum fringilla. Maecenas
 * magna. Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque
 * sagittis ligula eget metus. Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Phpfox\Mvc;


/**
 * Class PhpTemplate
 *
 * @package Phpfox\Mvc
 */
class PhpTemplate implements ViewRenderInterface
{
    /**
     * @var array
     */
    protected $map = [];

    public function render($__name_, $__vars_)
    {
        $__template_ = $this->load($__name_);

        if (!$__template_) {
            return '';
        }

        ob_start();

        extract($__vars_);

        unset($__vars_);

        include $__template_;

        return ob_get_clean();
    }

    public function load($name)
    {
        if (!isset($this->map[$name])) {
            throw new ViewException("Can not resolve path of '{$name}'");
        }

        return PHPFOX_DIR . DS . $this->map[$name];
    }
}