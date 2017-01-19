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
     * @param string $section
     * @param array  $active
     * @param int    $level
     * @param array  $context
     *
     * @return string
     */
    public function render(
        $decorator,
        $menu,
        $section = null,
        $active = [],
        $level = 1,
        $context = []
    ) {
        $class = \Phpfox::getParam('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        $arguments = func_get_args();
        array_shift($arguments);

        return (new \ReflectionClass($class))->newInstanceArgs($arguments)
            ->render();

    }

}