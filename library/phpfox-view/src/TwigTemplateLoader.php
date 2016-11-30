<?php

namespace Phpfox\View;


class TwigTemplateLoader implements \Twig_LoaderInterface
{
    /**
     * @var array
     */
    protected $map = [];

    public function getSource($name)
    {
        // TODO: Implement getSource() method.
    }

    public function getCacheKey($name)
    {
        // TODO: Implement getCacheKey() method.
    }

    public function isFresh($name, $time)
    {
        // TODO: Implement isFresh() method.
    }
}