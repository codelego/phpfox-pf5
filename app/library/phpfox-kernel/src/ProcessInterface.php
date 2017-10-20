<?php

namespace Phpfox\Kernel;


use Phpfox\View\ViewModel;

interface ProcessInterface
{
    /**
     * @return ViewModel
     */
    public function process();
}