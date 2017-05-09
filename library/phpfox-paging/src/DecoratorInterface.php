<?php

namespace Phpfox\Paging;


interface DecoratorInterface
{
    /**
     * @param PagingInterface $paging
     *
     * @return string
     */
    public function render(PagingInterface $paging);
}