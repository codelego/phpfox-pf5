<?php

namespace Phpfox\Navigation;


class NavigationFactory
{
    public function factory()
    {
        return (new \ReflectionClass(Navigation::class))->newInstanceArgs(func_get_args());
    }
}