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
        $class = \Phpfox::param('navigation.decorators', $decorator);

        /** @var DecoratorInterface $decorator */
        $decorator = new $class($context);

        return $decorator->render($navigation);
    }

    /**
     * @param string $decorator
     * @param string $menu
     * @param array  $params
     *
     * @return string
     */
    public function render($decorator, $menu, $params = [])
    {
        $class = \Phpfox::param('navigation.decorators', $decorator);

        if (!$class) {
            throw new \InvalidArgumentException("Oops! Navigation decorator '{$decorator}' does not exists.");
        }

        return (new Navigation($menu))->render($decorator, $params);
    }

}