<?php

namespace Phpfox\RequireJs;


/**
 * Class RequireJsFactory
 *
 * @package Phpfox\RequireJs
 */
class RequireJsFactory
{
    /**
     * @return RequireJs
     */
    public function factory()
    {
        return new RequireJs();
    }

    /**
     * @return bool
     */
    public function shouldCache()
    {
        return false;
    }
}