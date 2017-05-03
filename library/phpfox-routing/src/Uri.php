<?php

namespace Phpfox\Routing;

class Uri
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var array
     */
    protected $query = [];

    public function __toString()
    {
        return '';
    }
}