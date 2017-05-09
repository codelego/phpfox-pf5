<?php

namespace Phpfox\Navigation;


interface DecoratorInterface
{
    /**
     * @param Navigation $navigation
     *
     * @return string
     */
    public function render(Navigation $navigation);
}