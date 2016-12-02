<?php

namespace Phpfox\Navigation;


class NavigationManager
{
    /**
     * define max level to load
     */
    CONST MAX_LEVEL = 4;

    /**
     * @param string $decorator
     * @param string $menu
     * @param string $parentId
     * @param array  $active
     * @param int    $level
     * @param array  $context
     *
     * @return string
     */
    public function render(
        $decorator,
        $menu,
        $parentId = null,
        $active = [],
        $level = 1,
        $context = []
    ) {
        $class = \Phpfox::getConfig('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        return (new \ReflectionClass($class))->newInstanceArgs(func_get_args())
            ->render();

    }

}