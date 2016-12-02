<?php

namespace Phpfox\Navigation;


interface NavigationLoaderInterface
{
    /**
     * @param string $menu
     * @param string  $section
     *
     * @return mixed
     */
    public function load($menu, $section);
}