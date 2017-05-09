<?php

namespace Neutron\Core\Process;


use Phpfox\View\ViewModel;

interface ProcessInterface
{
    /**
     * @return ViewModel
     */
    public function process();
}