<?php

namespace Phpfox\Layout;

interface LayoutLoaderInterface
{
    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return LayoutPage
     */
    public function loadForRender($pageId, $themeId);
}