<?php

namespace Phpfox\Navigation;

class NavigationManager
{
    /**
     * define max level to load
     */
    CONST MAX_LEVEL = 4;

    /**
     * @param Navigation $navigation
     * @param string     $decorator
     * @param array      $context
     *
     * @return mixed
     */
    public function show(Navigation $navigation, $decorator, $context = [])
    {
        $class = \Phpfox::getParam('navigation.decorators', $decorator);

        /** @var DecoratorInterface $decorator */
        $decorator = new $class;

        return $decorator->render($navigation, $context);
    }

    /**
     * @param string $decorator
     * @param string $menu
     * @param string $section
     * @param array  $context
     *
     * @return string
     */
    public function render(
        $decorator,
        $menu,
        $section = null,
        $context = []
    ) {
        $class = \Phpfox::getParam('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        return (new Navigation($menu, $section))->render($decorator, $context);
    }

}