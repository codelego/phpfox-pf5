<?php

namespace Phpfox\Widget;


/**
 * Class StandardWidgetFactory
 *
 * @package Phpfox\WidgetManager
 */
class StandardWidgetFactory
{
    public function factory(
        $name,
        $options = []
    ) {
        return new $name($options);
    }

    public function shouldCache()
    {
        return true;
    }
}