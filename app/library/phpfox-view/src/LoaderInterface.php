<?php

namespace Phpfox\View;

interface LoaderInterface
{
    /**
     * @param string $pageId
     * @param string $themeId
     *
     * @return LayoutContent
     */
    public function loadForRender($pageId, $themeId);
}