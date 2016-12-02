<?php

namespace Phpfox\Navigation;


interface NavigationDecoratorInterface
{
    /**
     * NavigationRenderInterface constructor.
     *
     * @param string       $menu
     * @param string       $parentId
     * @param array|string $active
     * @param number       $level
     * @param array        $context
     */
    public function __construct(
        $menu,
        $parentId,
        $active,
        $level,
        $context
    );

    /**
     * @return string
     */
    public function render();
}