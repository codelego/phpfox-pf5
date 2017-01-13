<?php

namespace Phpfox\Routing;

interface RouterProviderInterface
{
    /**
     * @return array
     */
    public function loadConfigs();
}