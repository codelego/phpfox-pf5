<?php

namespace Phpfox\Router;

/**
 * Class NullAwareFilter
 *
 * @package Phpfox\Router
 */
class NullAwareFilter implements FilterInterface
{
    public function filter($result)
    {
        return true;
    }
}