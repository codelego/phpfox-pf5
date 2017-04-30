<?php

namespace Phpfox\Navigation;


interface NavigationLoaderInterface
{
    /**
     * @param string $menu
     *
     * @return array
     */
    public function load($menu);
}