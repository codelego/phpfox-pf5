<?php

namespace Phpfox\Router;


interface FilterInterface
{
    /**
     * @param Result $result
     *
     * @return bool
     */
    public function filter($result);
}