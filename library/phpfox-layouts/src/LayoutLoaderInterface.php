<?php

namespace Phpfox\Layout;

interface LayoutLoaderInterface
{
    /**
     * @param string $pageName
     * @param string $themeId
     */
    public function load($pageName, $themeId);
}