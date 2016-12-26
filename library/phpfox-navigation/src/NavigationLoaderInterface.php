<?php

namespace Phpfox\Navigation;


interface NavigationLoaderInterface
{
    /**
     * @param string $menu
     *
     * @return mixed
     */
    public function load($menu);
}