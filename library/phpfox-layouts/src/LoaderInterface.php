<?php

namespace Phpfox\Layout;

interface LoaderInterface
{
    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return Page
     */
    public function loadForRender($pageId, $themeId);
}