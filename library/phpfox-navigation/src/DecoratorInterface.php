<?php

namespace Phpfox\Navigation;


interface DecoratorInterface
{
    /**
     * @param Navigation $navigation
     * @param array      $context
     *
     * @return string
     */
    public function render(Navigation $navigation, $context = []);
}