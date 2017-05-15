<?php

namespace Phpfox\Support;


use Phpfox\View\ViewModel;

interface ProcessInterface
{
    /**
     * @return ViewModel
     */
    public function process();
}